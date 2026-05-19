<?php

namespace App\Controllers;

use App\Core\DB;
use App\Core\Request;
use App\Core\Response;

/**
 * Handles admin user-management endpoints.
 * POST /users/create  — admin creates a user account (student or teacher).
 */
class UserController
{
    /**
     * POST /users/create
     *
     * Body: { full_name, username, password, role }
     * Role must be: student | teacher | admin
     */
    public function create(Request $request): void
    {
        $fullName = trim($request->input('full_name', ''));
        $username = strtolower(trim($request->input('username', '')));
        $password = $request->input('password', '');
        $role     = trim($request->input('role', 'student'));

        // ── Validation ────────────────────────────────────────
        if (!$fullName || !$username || !$password) {
            Response::error('full_name, username and password are required');
        }
        if (!preg_match('/^[a-z0-9_]{3,30}$/', $username)) {
            Response::error('Username must be 3–30 characters: letters, digits, underscore only');
        }
        if (strlen($password) < 8) {
            Response::error('Password must be at least 8 characters');
        }
        if (!in_array($role, ['student', 'teacher', 'admin'], true)) {
            Response::error('Role must be student, teacher, or admin');
        }

        // ── Uniqueness check ──────────────────────────────────
        $exists = DB::query(
            'SELECT id FROM users WHERE username = ?', [$username]
        )->fetch();

        if ($exists) {
            Response::error("Username '{$username}' is already taken", 409);
        }

        // ── Insert user ───────────────────────────────────────
        $email = $username . '@lms.local'; // placeholder; no email login used

        DB::query(
            'INSERT INTO users (full_name, username, name, email, password_hash, role)
             VALUES (?, ?, ?, ?, ?, ?)',
            [
                $fullName,
                $username,
                $fullName,            // keep legacy `name` column in sync
                $email,
                password_hash($password, PASSWORD_BCRYPT),
                $role,
            ]
        );

        $user = DB::query(
            'SELECT id, full_name, username, role, created_at FROM users WHERE username = ?',
            [$username]
        )->fetch();

        // Auto-create role profile so dashboards always have a row to query
        if ($role === 'student') {
            DB::query(
                'INSERT INTO student_profiles (user_id) VALUES (?) ON CONFLICT (user_id) DO NOTHING',
                [$user['id']]
            );
        } elseif ($role === 'teacher') {
            DB::query(
                'INSERT INTO teacher_profiles (user_id) VALUES (?) ON CONFLICT (user_id) DO NOTHING',
                [$user['id']]
            );
        }

        Response::success($user, 'User created', 201);
    }
}
