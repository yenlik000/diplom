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

        $completedRows = DB::query(
            'SELECT lp.lesson_id, lp.completed_at FROM lesson_progress lp
             JOIN lessons l ON l.id = lp.lesson_id
             JOIN modules m ON m.id = l.module_id
             WHERE lp.user_id = ? AND m.course_id = ?',
            [$userId, $courseId]
        )->fetchAll();

        $completedIds   = array_map('intval', array_column($completedRows, 'lesson_id'));
        $completedTimes = [];
        foreach ($completedRows as $row) {
            if ($row['completed_at']) {
                $completedTimes[(int) $row['lesson_id']] = date('H:i', strtotime($row['completed_at']));
            }
        }

        $totalQuizzes = (int) DB::query(
            'SELECT COUNT(*) FROM homeworks h
             JOIN lessons l ON l.id = h.lesson_id
             JOIN modules m ON m.id = l.module_id
             WHERE m.course_id = ?',
            [$courseId]
        )->fetchColumn();

        $completedQuizzes = (int) DB::query(
            'SELECT COUNT(*) FROM homework_submissions hs
             JOIN homeworks h ON h.id = hs.homework_id
             JOIN lessons l ON l.id = h.lesson_id
             JOIN modules m ON m.id = l.module_id
             WHERE hs.user_id = ? AND m.course_id = ?',
            [$userId, $courseId]
        )->fetchColumn();

        $avgScore = DB::query(
            'SELECT AVG(hs.score) FROM homework_submissions hs
             JOIN homeworks h ON h.id = hs.homework_id
             JOIN lessons l ON l.id = h.lesson_id
             JOIN modules m ON m.id = l.module_id
             WHERE hs.user_id = ? AND m.course_id = ? AND hs.score IS NOT NULL',
            [$userId, $courseId]
        )->fetchColumn();

        $quizDetails = DB::query(
            'SELECT h.title AS quiz_title, hs.score, hs.submitted_at
             FROM homework_submissions hs
             JOIN homeworks h ON h.id = hs.homework_id
             JOIN lessons l ON l.id = h.lesson_id
             JOIN modules m ON m.id = l.module_id
             WHERE hs.user_id = ? AND m.course_id = ?
             ORDER BY hs.submitted_at DESC',
            [$userId, $courseId]
        )->fetchAll();

        Response::success([
            'total_lessons'     => $total,
            'completed_lessons' => $completed,
            'percentage'        => $total > 0 ? round($completed / $total * 100) : 0,
            'completed_ids'     => $completedIds,
            'completed_times'   => $completedTimes,
            'total_quizzes'     => $totalQuizzes,
            'completed_quizzes' => $completedQuizzes,
            'avg_quiz_score'    => $avgScore !== null ? round((float)$avgScore, 1) : null,
            'quiz_details'      => $quizDetails,
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

        DB::query(
            'INSERT INTO lesson_progress (user_id, lesson_id)
             VALUES (?, ?)
             ON CONFLICT (user_id, lesson_id) DO NOTHING',
            [$userId, $lessonId]
        );

        Response::success(null, 'Lesson marked as completed');
    }
}
