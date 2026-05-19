<?php

namespace App\Controllers;

use App\Core\DB;
use App\Core\Request;
use App\Core\Response;
use Firebase\JWT\JWT;

class AuthController
{
    /**
     * POST /auth/login  |  POST /login
     *
     * Accepts { username, password }.
     * Falls back to email lookup for backward compatibility.
     */
    public function login(Request $request): void
    {
        $username = trim($request->input('username', ''));
        $password = $request->input('password', '');

        if (!$username || !$password) {
            Response::error('username and password are required');
        }

        // Try username first, then email (backward compat)
        $user = DB::query(
            'SELECT * FROM users WHERE username = ? OR email = ? LIMIT 1',
            [$username, $username]
        )->fetch();

        if (!$user || !$user['password_hash'] || !password_verify($password, $user['password_hash'])) {
            Response::error('Invalid credentials', 401);
        }

        unset($user['password_hash'], $user['google_id']);
        Response::success(['user' => $user, 'token' => $this->issueToken($user)]);
    }

    /**
     * GET /auth/me  |  GET /me
     *
     * Returns the authenticated user's profile.
     */
    public function me(Request $request): void
    {
        $userId = (int) $request->params['_user_id'];

        $user = DB::query(
            'SELECT id, full_name, username, name, email, role, avatar_url, created_at
             FROM users WHERE id = ?',
            [$userId]
        )->fetch();

        if (!$user) {
            Response::error('User not found', 404);
        }

        Response::success($user);
    }

    // ── Private ───────────────────────────────────────────────

    private function issueToken(array $user): string
    {
        return JWT::encode([
            'sub'  => $user['id'],
            'role' => $user['role'],
            'iat'  => time(),
            'exp'  => time() + 60 * 60 * 24 * 7, // 7 days
        ], $_ENV['JWT_SECRET'], 'HS256');
    }
}
