<?php

namespace App\Controllers;

use App\Core\DB;
use App\Core\Request;
use App\Core\Response;

class EnrollmentController
{
    // GET /enrollments  — user's purchased courses
    public function index(Request $request): void
    {
        $userId = (int) $request->params['_user_id'];

        $courses = DB::query(
            'SELECT c.id, c.title, c.description, c.cover_image, c.level, c.subject,
                    e.enrolled_at, e.expires_at
             FROM enrollments e
             JOIN courses c ON c.id = e.course_id
             WHERE e.user_id = ?
             ORDER BY e.enrolled_at DESC',
            [$userId]
        )->fetchAll();

        Response::success($courses);
    }

    // POST /enrollments
    public function store(Request $request): void
    {
        $userId   = (int) $request->params['_user_id'];
        $courseId = (int) $request->input('course_id', 0);

        if (!$courseId) {
            Response::error('course_id is required');
        }

        $course = DB::query(
            'SELECT id FROM courses WHERE id = ? AND is_published = TRUE',
            [$courseId]
        )->fetch();

        if (!$course) {
            Response::error('Course not found', 404);
        }

        $exists = DB::query(
            'SELECT id FROM enrollments WHERE user_id = ? AND course_id = ?',
            [$userId, $courseId]
        )->fetch();

        if ($exists) {
            Response::error('Already enrolled in this course', 409);
        }

        DB::query(
            'INSERT INTO enrollments (user_id, course_id) VALUES (?, ?)',
            [$userId, $courseId]
        );

        Response::success(null, 'Enrolled successfully', 201);
    }
}
