<?php

namespace App\Controllers;

use App\Core\DB;
use App\Core\Request;
use App\Core\Response;
use Firebase\JWT\JWT;

class SocialAuthController
{
    // ── POST /auth/google ─────────────────────────────────────
    // Body: { access_token }  — OAuth2 access token from initTokenClient
    public function google(Request $request): void
    {
        $accessToken = trim($request->input('access_token', ''));
        if (!$accessToken) {
            Response::error('Google access_token required');
        }

        // Verify token by fetching user profile from Google's userinfo endpoint
        $info = $this->fetchJson(
            'https://www.googleapis.com/oauth2/v3/userinfo?access_token=' . urlencode($accessToken)
        );

        if (isset($info['error']) || empty($info['sub'])) {
            Response::error('Invalid Google token', 401);
        }

        $googleId = $info['sub'];
        $email    = $info['email']   ?? null;
        $name     = $info['name']    ?? ($info['given_name'] ?? 'User');
        $avatar   = $info['picture'] ?? null;

        $user = $this->findOrCreateSocialUser('google_id', $googleId, $email, $name, $avatar);
        Response::success(['user' => $user, 'token' => $this->issueToken($user)]);
    }

    // ── POST /auth/facebook ───────────────────────────────────
    // Body: { access_token, user_id }
    public function facebook(Request $request): void
    {
        $accessToken = trim($request->input('access_token', ''));
        $userId      = trim($request->input('user_id', ''));

        if (!$accessToken || !$userId) {
            Response::error('access_token and user_id required');
        }

        // Verify token with Facebook Graph API
        $profile = $this->fetchJson(
            'https://graph.facebook.com/me?access_token=' . urlencode($accessToken)
            . '&fields=id,name,email,picture.type(large)'
        );

        if (isset($profile['error'])) {
            Response::error('Invalid Facebook token', 401);
        }
        if ($profile['id'] !== $userId) {
            Response::error('user_id mismatch', 401);
        }

        $facebookId = $profile['id'];
        $email      = $profile['email']                     ?? null;
        $name       = $profile['name']                      ?? 'User';
        $avatar     = $profile['picture']['data']['url']    ?? null;

        $user = $this->findOrCreateSocialUser('facebook_id', $facebookId, $email, $name, $avatar);
        Response::success(['user' => $user, 'token' => $this->issueToken($user)]);
    }

    // ── POST /auth/register ───────────────────────────────────
    // Students can self-register via email. Role is always forced to 'student'.
    public function register(Request $request): void
    {
        $fullName = trim($request->input('full_name', ''));
        $email    = trim($request->input('email', ''));
        $password = $request->input('password', '');

        if (!$fullName || !$email || !$password) {
            Response::error('full_name, email and password are required');
        }
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            Response::error('Invalid email address');
        }
        if (strlen($password) < 8) {
            Response::error('Password must be at least 8 characters');
        }

        // Derive a unique username from the email prefix
        $base     = strtolower(preg_replace('/[^a-zA-Z0-9]/', '_', explode('@', $email)[0]));
        $username = $this->uniqueUsername($base);

        $exists = DB::query('SELECT id FROM users WHERE email = ?', [$email])->fetch();
        if ($exists) {
            Response::error('Email already registered', 409);
        }

        DB::query(
            'INSERT INTO users (full_name, username, name, email, password_hash, role)
             VALUES (?, ?, ?, ?, ?, ?)',
            [$fullName, $username, $fullName, $email,
             password_hash($password, PASSWORD_BCRYPT), 'student']
        );

        $user = DB::query(
            'SELECT id, full_name, username, name, email, role, avatar_url FROM users WHERE email = ?',
            [$email]
        )->fetch();

        // Auto-create student profile
        DB::query(
            'INSERT INTO student_profiles (user_id) VALUES (?) ON CONFLICT (user_id) DO NOTHING',
            [$user['id']]
        );

        Response::success(['user' => $user, 'token' => $this->issueToken($user)], 'Registered', 201);
    }

    // ── Helpers ───────────────────────────────────────────────

    private function findOrCreateSocialUser(
        string $providerCol,
        string $providerId,
        ?string $email,
        string $name,
        ?string $avatar
    ): array {
        // 1. Try finding by provider ID
        $user = DB::query(
            "SELECT id, full_name, username, name, email, role, avatar_url
             FROM users WHERE {$providerCol} = ?",
            [$providerId]
        )->fetch();

        // 2. Try finding by email (link existing account)
        if (!$user && $email) {
            $user = DB::query(
                "SELECT id, full_name, username, name, email, role, avatar_url
                 FROM users WHERE email = ?",
                [$email]
            )->fetch();

            if ($user) {
                DB::query(
                    "UPDATE users SET {$providerCol} = ?, avatar_url = COALESCE(avatar_url, ?) WHERE id = ?",
                    [$providerId, $avatar, $user['id']]
                );
            }
        }

        // 3. Create new student account
        if (!$user) {
            $base     = strtolower(preg_replace('/[^a-zA-Z0-9]/', '_', explode(' ', $name)[0]));
            $username = $this->uniqueUsername($base ?: 'user');
            $emailVal = $email ?? ($username . '@social.local');

            DB::query(
                "INSERT INTO users (full_name, username, name, email, {$providerCol}, avatar_url, role)
                 VALUES (?, ?, ?, ?, ?, ?, 'student')",
                [$name, $username, $name, $emailVal, $providerId, $avatar]
            );

            $user = DB::query(
                'SELECT id, full_name, username, name, email, role, avatar_url
                 FROM users WHERE username = ?',
                [$username]
            )->fetch();

            DB::query(
                'INSERT INTO student_profiles (user_id) VALUES (?) ON CONFLICT (user_id) DO NOTHING',
                [$user['id']]
            );
        }

        return $user;
    }

    private function uniqueUsername(string $base): string
    {
        $username = $base;
        $i        = 1;
        while (DB::query('SELECT id FROM users WHERE username = ?', [$username])->fetch()) {
            $username = $base . $i++;
        }
        return $username;
    }

    private function fetchJson(string $url): array
    {
        $ctx = stream_context_create(['http' => ['timeout' => 10]]);
        $raw = @file_get_contents($url, false, $ctx);
        if ($raw === false) {
            Response::error('External auth service unreachable', 502);
        }
        return json_decode($raw, true) ?? [];
    }

    private function issueToken(array $user): string
    {
        return JWT::encode([
            'sub'  => $user['id'],
            'role' => $user['role'],
            'iat'  => time(),
            'exp'  => time() + 60 * 60 * 24 * 7,
        ], $_ENV['JWT_SECRET'], 'HS256');
    }
}
