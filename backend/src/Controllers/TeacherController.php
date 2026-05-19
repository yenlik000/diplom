<?php

namespace App\Controllers;

use App\Core\DB;
use App\Core\Request;
use App\Core\Response;

class TeacherController
{
    // GET /teacher/courses  — own courses (incl. unpublished)
    public function myCourses(Request $request): void
    {
        $userId  = (int) $request->params['_user_id'];
        $role    = $request->params['_user_role'];

        // Admin sees all courses; teacher sees only own
        if ($role === 'admin') {
            $courses = DB::query(
                'SELECT c.*, u.name AS teacher_name
                 FROM courses c LEFT JOIN users u ON u.id = c.teacher_id
                 ORDER BY c.id'
            )->fetchAll();
        } else {
            $courses = DB::query(
                'SELECT * FROM courses WHERE teacher_id = ? ORDER BY id',
                [$userId]
            )->fetchAll();
        }

        Response::success($courses);
    }

    // GET /teacher/stats  — stats for own courses
    public function stats(Request $request): void
    {
        $userId = (int) $request->params['_user_id'];
        $role   = $request->params['_user_role'];

        if ($role === 'admin') {
            $courseCount = DB::query('SELECT COUNT(*) AS cnt FROM courses')->fetch()['cnt'];
            $enrolled    = DB::query('SELECT COUNT(*) AS cnt FROM enrollments')->fetch()['cnt'];
            $lessons     = DB::query('SELECT COUNT(*) AS cnt FROM lessons')->fetch()['cnt'];
        } else {
            $courseCount = DB::query(
                'SELECT COUNT(*) AS cnt FROM courses WHERE teacher_id = ?', [$userId]
            )->fetch()['cnt'];
            $enrolled = DB::query(
                'SELECT COUNT(*) AS cnt FROM enrollments e
                 JOIN courses c ON c.id = e.course_id WHERE c.teacher_id = ?',
                [$userId]
            )->fetch()['cnt'];
            $lessons = DB::query(
                'SELECT COUNT(*) AS cnt FROM lessons l
                 JOIN modules m ON m.id = l.module_id
                 JOIN courses c ON c.id = m.course_id
                 WHERE c.teacher_id = ?',
                [$userId]
            )->fetch()['cnt'];
        }

        Response::success([
            'total_courses'  => (int) $courseCount,
            'total_enrolled' => (int) $enrolled,
            'total_lessons'  => (int) $lessons,
        ]);
    }
}
