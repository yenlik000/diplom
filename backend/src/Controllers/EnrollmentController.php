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
            'SELECT c.id, c.title, c.description, c.cover_image, c.price, c.level, c.subject,
                    e.enrolled_at, e.expires_at,
                    (SELECT u.full_name FROM users u WHERE u.id = c.teacher_id) AS teacher_name,
                    (SELECT COUNT(*)
                     FROM modules m2
                     JOIN lessons l2 ON l2.module_id = m2.id
                     WHERE m2.course_id = c.id) AS lessons_count,
                    (SELECT COALESCE(SUM(l2.duration_seconds), 0)
                     FROM modules m2
                     JOIN lessons l2 ON l2.module_id = m2.id
                     WHERE m2.course_id = c.id) AS total_duration_seconds,
                    (SELECT l.video_url
                     FROM modules m
                     JOIN lessons l ON l.module_id = m.id
                     WHERE m.course_id = c.id AND l.video_url IS NOT NULL AND l.video_url <> \'\'
                     ORDER BY m.order_num, l.order_num
                     LIMIT 1) AS first_video_url
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
