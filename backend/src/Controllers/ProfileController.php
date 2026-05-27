<?php

namespace App\Controllers;

use App\Core\DB;
use App\Core\Request;
use App\Core\Response;

class ProfileController
{
    // GET /profile
    public function show(Request $request): void
    {
        $userId = (int) $request->params['_user_id'];

        $user = DB::query(
            'SELECT u.id, u.full_name, u.email, u.role, u.avatar_url,
                    sp.phone, sp.bio,
                    sp.facebook_url, sp.twitter_url, sp.youtube_url, sp.linkedin_url,
                    sp.privacy_courses, sp.privacy_quizzes, sp.privacy_profile
             FROM users u
             LEFT JOIN student_profiles sp ON sp.user_id = u.id
             WHERE u.id = ?',
            [$userId]
        )->fetch();

        if (!$user) Response::error('User not found', 404);

        Response::success($user);
    }

    // PUT /profile
    public function update(Request $request): void
    {
        $userId = (int) $request->params['_user_id'];

        $fullName = trim($request->input('full_name', ''));
        $email    = trim($request->input('email', ''));
        $phone    = trim($request->input('phone', ''));
        $bio      = trim($request->input('bio', ''));
        $facebook = trim($request->input('facebook_url', ''));
        $twitter  = trim($request->input('twitter_url', ''));
        $youtube  = trim($request->input('youtube_url', ''));
        $linkedin = trim($request->input('linkedin_url', ''));

        if ($fullName) {
            DB::query(
                'UPDATE users SET full_name = ?, name = ?, email = ? WHERE id = ?',
                [$fullName, $fullName, $email ?: null, $userId]
            );
        }

        // Upsert student_profiles row
        DB::query(
            'INSERT INTO student_profiles (user_id, phone, bio, facebook_url, twitter_url, youtube_url, linkedin_url)
             VALUES (?, ?, ?, ?, ?, ?, ?)
             ON CONFLICT (user_id) DO UPDATE SET
               phone        = EXCLUDED.phone,
               bio          = EXCLUDED.bio,
               facebook_url = EXCLUDED.facebook_url,
               twitter_url  = EXCLUDED.twitter_url,
               youtube_url  = EXCLUDED.youtube_url,
               linkedin_url = EXCLUDED.linkedin_url',
            [$userId, $phone ?: null, $bio ?: null, $facebook ?: null,
             $twitter ?: null, $youtube ?: null, $linkedin ?: null]
        );

        Response::success(null, 'Profile updated');
    }

    // POST /profile/password
    public function changePassword(Request $request): void
    {
        $userId     = (int) $request->params['_user_id'];
        $currentPwd = $request->input('current_password', '');
        $newPwd     = $request->input('new_password', '');

        if (!$currentPwd || !$newPwd) {
            Response::error('current_password and new_password are required', 422);
        }
        if (strlen($newPwd) < 8) {
            Response::error('New password must be at least 8 characters', 422);
        }

        $user = DB::query('SELECT password_hash FROM users WHERE id = ?', [$userId])->fetch();

        if (!$user || !password_verify($currentPwd, $user['password_hash'])) {
            Response::error('Current password is incorrect', 401);
        }

        DB::query(
            'UPDATE users SET password_hash = ? WHERE id = ?',
            [password_hash($newPwd, PASSWORD_BCRYPT), $userId]
        );

        Response::success(null, 'Password changed');
    }

    // POST /profile/avatar  (multipart/form-data, field: avatar)
    public function uploadAvatar(Request $request): void
    {
        $userId = (int) $request->params['_user_id'];

        if (empty($_FILES['avatar']) || $_FILES['avatar']['error'] !== UPLOAD_ERR_OK) {
            Response::error('No valid file uploaded', 422);
        }

        $file    = $_FILES['avatar'];
        $allowed = ['image/jpeg', 'image/png', 'image/webp', 'image/gif'];

        if (!in_array($file['type'], $allowed, true)) {
            Response::error('Only JPG, PNG, WEBP or GIF images are allowed', 422);
        }
        if ($file['size'] > 2 * 1024 * 1024) {
            Response::error('File must be under 2 MB', 422);
        }

        $ext       = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        $filename  = 'avatar_' . $userId . '_' . time() . '.' . $ext;
        $uploadDir = BASE_PATH . '/public/uploads/avatars/';

        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }

        if (!move_uploaded_file($file['tmp_name'], $uploadDir . $filename)) {
            Response::error('Failed to save file', 500);
        }

        $url = '/uploads/avatars/' . $filename;
        DB::query('UPDATE users SET avatar_url = ? WHERE id = ?', [$url, $userId]);

        Response::success(['avatar_url' => $url], 'Avatar uploaded');
    }

    // PUT /profile/privacy
    public function updatePrivacy(Request $request): void
    {
        $userId  = (int) $request->params['_user_id'];
        $courses = (bool) $request->input('privacy_courses', false);
        $quizzes = (bool) $request->input('privacy_quizzes', true);
        $profile = (bool) $request->input('privacy_profile', false);

        DB::query(
            'INSERT INTO student_profiles (user_id, privacy_courses, privacy_quizzes, privacy_profile)
             VALUES (?, ?, ?, ?)
             ON CONFLICT (user_id) DO UPDATE SET
               privacy_courses = EXCLUDED.privacy_courses,
               privacy_quizzes = EXCLUDED.privacy_quizzes,
               privacy_profile = EXCLUDED.privacy_profile',
            [$userId, $courses, $quizzes, $profile]
        );

        Response::success(null, 'Privacy settings saved');
    }
}
