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

    // GET /teacher/courses/{id}  — full course with modules+lessons (incl. video_url)
    public function getCourse(Request $request): void
    {
        $courseId = (int) $request->params['id'];
        $userId   = (int) $request->params['_user_id'];
        $role     = $request->params['_user_role'];

        if ($role === 'admin') {
            $course = DB::query('SELECT * FROM courses WHERE id = ?', [$courseId])->fetch();
        } else {
            $course = DB::query(
                'SELECT * FROM courses WHERE id = ? AND teacher_id = ?',
                [$courseId, $userId]
            )->fetch();
        }

        if (!$course) {
            Response::error('Course not found', 404);
        }

        $modules = DB::query(
            'SELECT id, title, order_num FROM modules WHERE course_id = ? ORDER BY order_num',
            [$courseId]
        )->fetchAll();

        foreach ($modules as &$module) {
            $lessons = DB::query(
                'SELECT id, title, order_num, is_free_preview, duration_seconds, video_url, audio_url, text_content
                 FROM lessons WHERE module_id = ? ORDER BY order_num',
                [$module['id']]
            )->fetchAll();

            foreach ($lessons as &$lesson) {
                $hw = DB::query(
                    'SELECT id, title FROM homeworks WHERE lesson_id = ? LIMIT 1',
                    [$lesson['id']]
                )->fetch();
                $lesson['homework_id']    = $hw ? (int) $hw['id']  : null;
                $lesson['homework_title'] = $hw ? $hw['title']      : null;
            }

            $module['lessons'] = $lessons;
        }

        $course['modules'] = $modules;
        Response::success($course);
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

        // Pending gradings: homework submissions without a score for this teacher's courses
        $pendingGradings = DB::query(
            'SELECT COUNT(*) AS cnt
             FROM homework_submissions hs
             JOIN homeworks h      ON h.id  = hs.homework_id
             JOIN lessons l        ON l.id  = h.lesson_id
             JOIN modules m        ON m.id  = l.module_id
             JOIN courses c        ON c.id  = m.course_id
             WHERE c.teacher_id = ? AND hs.score IS NULL',
            [$userId]
        )->fetch()['cnt'];

        // Unread messages sent to this teacher
        $unreadMessages = DB::query(
            'SELECT COUNT(*) AS cnt FROM messages
             WHERE to_user_id = ? AND is_read = FALSE',
            [$userId]
        )->fetch()['cnt'];

        // Average lesson-completion % across all students enrolled in teacher's courses
        $avgRow = DB::query(
            'SELECT COALESCE(ROUND(AVG(
                CASE WHEN course_total = 0 THEN 0
                     ELSE 100.0 * completed / course_total
                END
             )), 0) AS avg_progress
             FROM (
               SELECT
                 e.user_id,
                 e.course_id,
                 (SELECT COUNT(*) FROM lessons l2
                  JOIN modules m2 ON m2.id = l2.module_id
                  WHERE m2.course_id = e.course_id) AS course_total,
                 (SELECT COUNT(*) FROM lesson_progress lp
                  JOIN lessons l3   ON l3.id  = lp.lesson_id
                  JOIN modules m3   ON m3.id  = l3.module_id
                  WHERE m3.course_id = e.course_id AND lp.user_id = e.user_id) AS completed
               FROM enrollments e
               JOIN courses c ON c.id = e.course_id
               WHERE c.teacher_id = ?
             ) sub',
            [$userId]
        )->fetch();

        Response::success([
            'total_courses'    => (int) $courseCount,
            'total_enrolled'   => (int) $enrolled,
            'total_lessons'    => (int) $lessons,
            'pending_gradings' => (int) $pendingGradings,
            'unread_messages'  => (int) $unreadMessages,
            'avg_progress'     => (int) ($avgRow['avg_progress'] ?? 0),
        ]);
    }

    // GET /teacher/submissions/{id}  — submission detail with answers
    public function submissionDetail(Request $request): void
    {
        $submissionId = (int) $request->params['id'];
        $userId       = (int) $request->params['_user_id'];
        $role         = $request->params['_user_role'];

        $sub = DB::query(
            'SELECT hs.id, hs.submitted_at, hs.score, hs.feedback, hs.status,
                    u.id AS student_id, u.full_name AS student_name, u.email,
                    h.title AS homework_title, h.max_score,
                    c.id AS course_id, c.title AS course_title, c.teacher_id,
                    (SELECT ROUND(AVG(hs2.score)) FROM homework_submissions hs2
                     JOIN homeworks h2 ON h2.id = hs2.homework_id
                     JOIN lessons l2 ON l2.id = h2.lesson_id
                     JOIN modules m2 ON m2.id = l2.module_id
                     WHERE m2.course_id = c.id AND hs2.score IS NOT NULL) AS avg_score
             FROM homework_submissions hs
             JOIN users     u ON u.id  = hs.user_id
             JOIN homeworks h ON h.id  = hs.homework_id
             JOIN lessons   l ON l.id  = h.lesson_id
             JOIN modules   m ON m.id  = l.module_id
             JOIN courses   c ON c.id  = m.course_id
             WHERE hs.id = ?',
            [$submissionId]
        )->fetch();

        if (!$sub) {
            Response::error('Submission not found', 404);
            return;
        }
        if ($role !== 'admin' && (int)$sub['teacher_id'] !== $userId) {
            Response::error('Forbidden', 403);
            return;
        }

        $answers = DB::query(
            'SELECT ha.id, ha.answer_text, ha.is_correct,
                    hq.question_text, hq.question_type,
                    ho.option_text AS selected_option
             FROM homework_answers ha
             JOIN homework_questions hq ON hq.id = ha.question_id
             LEFT JOIN homework_options ho ON ho.id = ha.selected_option_id
             WHERE ha.submission_id = ?
             ORDER BY hq.order_num',
            [$submissionId]
        )->fetchAll();

        $now      = new \DateTimeImmutable();
        $subTime  = new \DateTimeImmutable($sub['submitted_at']);
        $hoursAgo = ($now->getTimestamp() - $subTime->getTimestamp()) / 3600;

        Response::success(array_merge($sub, [
            'answers'   => $answers,
            'hours_ago' => round($hoursAgo, 1),
            'is_urgent' => $hoursAgo >= 24,
        ]));
    }

    // PATCH /teacher/submissions/{id}/grade  { score: 0-100, feedback?: string, status?: string }
    public function grade(Request $request): void
    {
        $submissionId = (int) $request->params['id'];
        $userId       = (int) $request->params['_user_id'];
        $role         = $request->params['_user_role'];
        $score        = $request->input('score');
        $feedback     = $request->input('feedback');
        $status       = $request->input('status') ?? 'graded';

        $allowedStatuses = ['graded', 'revision_requested'];
        if (!in_array($status, $allowedStatuses)) {
            $status = 'graded';
        }

        // Verify ownership and get max_score
        $sub = DB::query(
            'SELECT hs.id, c.teacher_id, h.max_score
             FROM homework_submissions hs
             JOIN homeworks h ON h.id = hs.homework_id
             JOIN lessons   l ON l.id = h.lesson_id
             JOIN modules   m ON m.id = l.module_id
             JOIN courses   c ON c.id = m.course_id
             WHERE hs.id = ?',
            [$submissionId]
        )->fetch();

        if (!$sub) {
            Response::error('Submission not found', 404);
            return;
        }
        if ($role !== 'admin' && (int)$sub['teacher_id'] !== $userId) {
            Response::error('Forbidden', 403);
            return;
        }

        $maxScore = (int) ($sub['max_score'] ?? 100);
        if ($score === null || !is_numeric($score) || $score < 0 || $score > $maxScore) {
            Response::error("Score must be a number between 0 and {$maxScore}", 422);
            return;
        }

        // For revision_requested keep score NULL so it stays in the pending list
        $finalScore = $status === 'revision_requested' ? null : (float)$score;

        DB::query(
            'UPDATE homework_submissions SET score = ?, feedback = ?, status = ?, graded_at = NOW() WHERE id = ?',
            [$finalScore, $feedback, $status, $submissionId]
        );

        Response::success(['id' => $submissionId, 'score' => $finalScore, 'status' => $status]);
    }

    // GET /teacher/students  — enrolled students with per-course progress
    public function students(Request $request): void
    {
        $userId = (int) $request->params['_user_id'];
        $role   = $request->params['_user_role'];

        $whereClause = $role === 'admin' ? '' : 'WHERE c.teacher_id = ' . $userId;

        $rows = DB::query(
            "SELECT
                u.id          AS student_id,
                u.full_name   AS student_name,
                u.email,
                u.avatar_url,
                c.id          AS course_id,
                c.title       AS course_title,
                e.enrolled_at,
                (SELECT COUNT(*) FROM lessons l2
                 JOIN modules m2 ON m2.id = l2.module_id
                 WHERE m2.course_id = c.id)                                    AS total_lessons,
                (SELECT COUNT(*) FROM lesson_progress lp
                 JOIN lessons l3   ON l3.id  = lp.lesson_id
                 JOIN modules m3   ON m3.id  = l3.module_id
                 WHERE m3.course_id = c.id AND lp.user_id = u.id)             AS completed_lessons
             FROM enrollments e
             JOIN users   u ON u.id  = e.user_id
             JOIN courses c ON c.id  = e.course_id
             $whereClause
             ORDER BY e.enrolled_at DESC"
        )->fetchAll();

        foreach ($rows as &$row) {
            $total               = (int) $row['total_lessons'];
            $done                = (int) $row['completed_lessons'];
            $row['progress']     = $total > 0 ? (int) round(100 * $done / $total) : 0;
        }
        unset($row);

        Response::success($rows);
    }

    // GET /teacher/efficiency  — grading queue efficiency (7-day chart + response time)
    public function efficiency(Request $request): void
    {
        $userId = (int) $request->params['_user_id'];
        $role   = $request->params['_user_role'];

        $join = '
            JOIN homeworks h ON h.id = hs.homework_id
            JOIN lessons   l ON l.id = h.lesson_id
            JOIN modules   m ON m.id = l.module_id
            JOIN courses   c ON c.id = m.course_id
        ';
        $teacherWhere = $role === 'admin' ? '' : 'AND c.teacher_id = ' . $userId;

        // Daily graded counts for the past 7 days (oldest → newest)
        $dailyGraded = [];
        for ($i = 6; $i >= 0; $i--) {
            $date  = date('Y-m-d', strtotime("-{$i} days"));
            $count = DB::query(
                "SELECT COUNT(*) AS cnt
                 FROM homework_submissions hs $join
                 WHERE hs.graded_at::date = '$date' $teacherWhere"
            )->fetch()['cnt'];
            $dailyGraded[] = (int) $count;
        }

        // Avg response hours this week vs last week
        $thisWeek = DB::query(
            "SELECT COALESCE(AVG(EXTRACT(EPOCH FROM (hs.graded_at - hs.submitted_at)) / 3600), 0) AS avg
             FROM homework_submissions hs $join
             WHERE hs.graded_at >= NOW() - INTERVAL '7 days'
             AND hs.graded_at IS NOT NULL $teacherWhere"
        )->fetch()['avg'];

        $lastWeek = DB::query(
            "SELECT COALESCE(AVG(EXTRACT(EPOCH FROM (hs.graded_at - hs.submitted_at)) / 3600), 0) AS avg
             FROM homework_submissions hs $join
             WHERE hs.graded_at >= NOW() - INTERVAL '14 days'
             AND hs.graded_at  <  NOW() - INTERVAL '7 days'
             AND hs.graded_at IS NOT NULL $teacherWhere"
        )->fetch()['avg'];

        $thisWeek = round((float) $thisWeek, 1);
        $lastWeek = round((float) $lastWeek, 1);

        // Positive = improved (response time went down)
        $improvementPct = 0;
        if ($lastWeek > 0 && $thisWeek > 0) {
            $improvementPct = (int) round(($lastWeek - $thisWeek) / $lastWeek * 100);
        }

        Response::success([
            'daily_graded'    => $dailyGraded,
            'avg_hours_this'  => $thisWeek,
            'avg_hours_last'  => $lastWeek,
            'improvement_pct' => $improvementPct,
        ]);
    }

    // GET /teacher/submissions  — homework submissions for own courses
    // ?all=1   → all submissions (for activity feed); default → only pending (ungraded)
    public function submissions(Request $request): void
    {
        $userId       = (int) $request->params['_user_id'];
        $role         = $request->params['_user_role'];
        $courseFilter = $request->query['course_id'] ?? null;
        $all          = ($request->query['all'] ?? '') === '1';

        $sql = '
            SELECT
                hs.id,
                hs.submitted_at,
                hs.score,
                hs.status,
                hs.graded_at,
                u.id        AS student_id,
                u.full_name AS student_name,
                h.title     AS homework_title,
                c.id        AS course_id,
                c.title     AS course_title
            FROM homework_submissions hs
            JOIN users     u ON u.id  = hs.user_id
            JOIN homeworks h ON h.id  = hs.homework_id
            JOIN lessons   l ON l.id  = h.lesson_id
            JOIN modules   m ON m.id  = l.module_id
            JOIN courses   c ON c.id  = m.course_id
            WHERE 1=1
        ';
        $params = [];

        if (!$all) {
            $sql .= ' AND hs.score IS NULL';
        }

        if ($role !== 'admin') {
            $sql     .= ' AND c.teacher_id = ?';
            $params[] = $userId;
        }
        if ($courseFilter) {
            $sql     .= ' AND c.id = ?';
            $params[] = (int) $courseFilter;
        }

        $sql .= ' ORDER BY hs.submitted_at DESC LIMIT 100';

        $rows = DB::query($sql, $params)->fetchAll();
        $now  = new \DateTimeImmutable();

        foreach ($rows as &$row) {
            $sub              = new \DateTimeImmutable($row['submitted_at']);
            $hours            = ($now->getTimestamp() - $sub->getTimestamp()) / 3600;
            $row['hours_ago'] = round($hours, 1);
            $row['is_urgent'] = $hours >= 24;
        }
        unset($row);

        Response::success($rows);
    }
}
