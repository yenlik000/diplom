<?php

namespace App\Controllers;

use App\Core\DB;
use App\Core\Request;
use App\Core\Response;

class ProgressController
{
    // GET /progress/courses/{courseId}
    public function course(Request $request): void
    {
        $courseId = (int) $request->params['courseId'];
        $userId   = (int) $request->params['_user_id'];

        $enrolled = DB::query(
            'SELECT id FROM enrollments WHERE user_id = ? AND course_id = ?',
            [$userId, $courseId]
        )->fetch();

        if (!$enrolled) {
            Response::error('Not enrolled in this course', 403);
        }

        $total = (int) DB::query(
            'SELECT COUNT(*) FROM lessons l
             JOIN modules m ON m.id = l.module_id
             WHERE m.course_id = ?',
            [$courseId]
        )->fetchColumn();

        $completed = (int) DB::query(
            'SELECT COUNT(*) FROM lesson_progress lp
             JOIN lessons l ON l.id = lp.lesson_id
             JOIN modules m ON m.id = l.module_id
             WHERE lp.user_id = ? AND m.course_id = ?',
            [$userId, $courseId]
        )->fetchColumn();

        $completedIds = DB::query(
            'SELECT lp.lesson_id FROM lesson_progress lp
             JOIN lessons l ON l.id = lp.lesson_id
             JOIN modules m ON m.id = l.module_id
             WHERE lp.user_id = ? AND m.course_id = ?',
            [$userId, $courseId]
        )->fetchAll(\PDO::FETCH_COLUMN);

        Response::success([
            'total_lessons'     => $total,
            'completed_lessons' => $completed,
            'percentage'        => $total > 0 ? round($completed / $total * 100) : 0,
            'completed_ids'     => $completedIds,
        ]);
    }

    // POST /progress/lessons/{lessonId}/complete
    public function complete(Request $request): void
    {
        $lessonId = (int) $request->params['lessonId'];
        $userId   = (int) $request->params['_user_id'];

        $lesson = DB::query(
            'SELECT l.id, m.course_id FROM lessons l
             JOIN modules m ON m.id = l.module_id
             WHERE l.id = ?',
            [$lessonId]
        )->fetch();

        if (!$lesson) {
            Response::error('Lesson not found', 404);
        }

        $enrolled = DB::query(
            'SELECT id FROM enrollments WHERE user_id = ? AND course_id = ?',
            [$userId, $lesson['course_id']]
        )->fetch();

        if (!$enrolled) {
            Response::error('Not enrolled in this course', 403);
        }

        DB::query(
            'INSERT INTO lesson_progress (user_id, lesson_id)
             VALUES (?, ?)
             ON CONFLICT (user_id, lesson_id) DO NOTHING',
            [$userId, $lessonId]
        );

        Response::success(null, 'Lesson marked as completed');
    }
}
