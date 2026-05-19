<?php

namespace App\Controllers;

use App\Core\DB;
use App\Core\Request;
use App\Core\Response;

class AdminController
{
    // GET /admin/users
    public function users(Request $request): void
    {
        $users = DB::query(
            'SELECT id, full_name, username, role, created_at
             FROM users
             ORDER BY created_at DESC'
        )->fetchAll();

        Response::success($users);
    }

    // POST /admin/users
    public function createUser(Request $request): void
    {
        $fullName = trim($request->input('full_name', ''));
        $username = strtolower(trim($request->input('username', '')));
        $password = $request->input('password', '');
        $role     = trim($request->input('role', 'student'));

        if (!$fullName || !$username || !$password) {
            Response::error('full_name, username and password are required');
        }
        if (!preg_match('/^[a-z0-9_]{3,30}$/', $username)) {
            Response::error('Username must be 3–30 lowercase letters, digits or underscores');
        }
        if (strlen($password) < 8) {
            Response::error('Password must be at least 8 characters');
        }
        if (!in_array($role, ['student', 'teacher', 'admin'], true)) {
            Response::error('Invalid role');
        }

        $exists = DB::query('SELECT id FROM users WHERE username = ?', [$username])->fetch();
        if ($exists) {
            Response::error("Username '{$username}' is already taken", 409);
        }

        DB::query(
            'INSERT INTO users (full_name, username, name, email, password_hash, role)
             VALUES (?, ?, ?, ?, ?, ?)',
            [
                $fullName,
                $username,
                $fullName,
                $username . '@lms.local',
                password_hash($password, PASSWORD_BCRYPT),
                $role,
            ]
        );

        $user = DB::query(
            'SELECT id, full_name, username, role, created_at FROM users WHERE username = ?',
            [$username]
        )->fetch();

        // Auto-create role profile so dashboards always have a row
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

    // GET /admin/stats
    public function stats(Request $request): void
    {
        Response::success([
            'total_students' => (int) DB::query(
                'SELECT COUNT(*) FROM users WHERE role = ?', ['student']
            )->fetchColumn(),
            'total_teachers' => (int) DB::query(
                'SELECT COUNT(*) FROM users WHERE role = ?', ['teacher']
            )->fetchColumn(),
            'total_courses'  => (int) DB::query(
                'SELECT COUNT(*) FROM courses'
            )->fetchColumn(),
            'total_enrolled' => (int) DB::query(
                'SELECT COUNT(*) FROM enrollments'
            )->fetchColumn(),
            'total_lessons'  => (int) DB::query(
                'SELECT COUNT(*) FROM lessons'
            )->fetchColumn(),
            'total_groups'   => (int) DB::query(
                'SELECT COUNT(*) FROM groups'
            )->fetchColumn(),
        ]);
    }
}
