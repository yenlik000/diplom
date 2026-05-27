<?php

namespace App\Controllers;

use App\Core\DB;
use App\Core\Request;
use App\Core\Response;

class CourseController
{
    // GET /courses
    public function index(Request $request): void
    {
        $courses = DB::query(
            'SELECT c.id, c.title, c.description, c.cover_image, c.price, c.level, c.subject,
                    (SELECT COUNT(*)
                     FROM modules m2
                     JOIN lessons l2 ON l2.module_id = m2.id
                     WHERE m2.course_id = c.id) AS lessons_count,
                    (SELECT COALESCE(SUM(l2.duration_seconds), 0)
                     FROM modules m2
                     JOIN lessons l2 ON l2.module_id = m2.id
                     WHERE m2.course_id = c.id) AS total_duration_seconds,
                    (SELECT COUNT(*)
                     FROM enrollments e
                     WHERE e.course_id = c.id) AS students_count,
                    (SELECT l.video_url
                     FROM modules m
                     JOIN lessons l ON l.module_id = m.id
                     WHERE m.course_id = c.id AND l.video_url IS NOT NULL AND l.video_url <> \'\'
                     ORDER BY m.order_num, l.order_num
                     LIMIT 1) AS first_video_url
             FROM courses c WHERE c.is_published = TRUE ORDER BY c.id'
        )->fetchAll();

        Response::success($courses);
    }

    // GET /courses/{id}
    public function show(Request $request): void
    {
        $id = (int) $request->params['id'];

        $course = DB::query(
            'SELECT c.*,
                    (SELECT l.video_url
                     FROM modules m
                     JOIN lessons l ON l.module_id = m.id
                     WHERE m.course_id = c.id AND l.video_url IS NOT NULL AND l.video_url <> \'\'
                     ORDER BY m.order_num, l.order_num
                     LIMIT 1) AS first_video_url
             FROM courses c WHERE c.id = ?',
            [$id]
        )->fetch();

        if (!$course) {
            Response::error('Course not found', 404);
        }

        $modules = DB::query(
            'SELECT id, title, order_num FROM modules WHERE course_id = ? ORDER BY order_num',
            [$id]
        )->fetchAll();

        foreach ($modules as &$module) {
            $module['lessons'] = DB::query(
                'SELECT id, title, order_num, is_free_preview, duration_seconds
                 FROM lessons WHERE module_id = ? ORDER BY order_num',
                [$module['id']]
            )->fetchAll();
        }

        $course['modules'] = $modules;
        Response::success($course);
    }

    // POST /courses  — teacher/admin
    public function store(Request $request): void
    {
        $userId = (int) $request->params['_user_id'];
        $role   = $request->params['_user_role'];
        $data   = $this->validated($request);

        // Admin can assign a specific teacher; teacher always owns their own course
        $rawTeacherId = $request->input('teacher_id');
        $teacherId = ($role === 'admin' && $rawTeacherId)
            ? (int) $rawTeacherId
            : $userId;

        DB::query(
            'INSERT INTO courses (title, description, cover_image, price, original_price, level, subject, is_published, teacher_id)
             VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)',
            [...array_values($data), $teacherId]
        );

        $course = DB::query('SELECT * FROM courses WHERE id = lastval()')->fetch();
        Response::success($course, 'Course created', 201);
    }

    // PUT /courses/{id}  — teacher (own) / admin
    public function update(Request $request): void
    {
        $id     = (int) $request->params['id'];
        $userId = (int) $request->params['_user_id'];
        $role   = $request->params['_user_role'];
        $data   = $this->validated($request);

        $this->assertOwnership($id, $userId, $role);

        // Admin can reassign teacher
        $teacherIdSql = '';
        $teacherParam = [];
        if ($role === 'admin') {
            $rawTeacherId = $request->input('teacher_id');
            if ($rawTeacherId !== null) {
                $teacherIdSql = ', teacher_id=?';
                $teacherParam = [(int) $rawTeacherId];
            }
        }

        $rows = DB::query(
            "UPDATE courses
             SET title=?, description=?, cover_image=?, price=?, original_price=?, level=?, subject=?, is_published=?
             {$teacherIdSql}
             WHERE id=?",
            [...array_values($data), ...$teacherParam, $id]
        )->rowCount();

        if (!$rows) {
            Response::error('Course not found', 404);
        }

        Response::success(null, 'Course updated');
    }

    // DELETE /courses/{id}  — teacher (own) / admin
    public function destroy(Request $request): void
    {
        $id     = (int) $request->params['id'];
        $userId = (int) $request->params['_user_id'];
        $role   = $request->params['_user_role'];

        $this->assertOwnership($id, $userId, $role);

        $rows = DB::query('DELETE FROM courses WHERE id = ?', [$id])->rowCount();

        if (!$rows) {
            Response::error('Course not found', 404);
        }

        Response::success(null, 'Course deleted');
    }

    // POST /courses/{id}/upload-cover  (multipart, field: cover)
    public function uploadCover(Request $request): void
    {
        $id     = (int) $request->params['id'];
        $userId = (int) $request->params['_user_id'];
        $role   = $request->params['_user_role'];

        $this->assertOwnership($id, $userId, $role);

        if (empty($_FILES['cover']) || $_FILES['cover']['error'] !== UPLOAD_ERR_OK) {
            Response::error('No image uploaded', 422);
        }

        $file    = $_FILES['cover'];
        $allowed = ['image/jpeg', 'image/png', 'image/webp', 'image/gif'];
        if (!in_array($file['type'], $allowed, true)) {
            Response::error('Only JPG, PNG, WebP or GIF allowed', 422);
        }
        if ($file['size'] > 5 * 1024 * 1024) {
            Response::error('Image must be under 5 MB', 422);
        }

        $ext      = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION)) ?: 'jpg';
        $filename = 'cover_' . $id . '_' . time() . '.' . $ext;
        $dir      = BASE_PATH . '/public/uploads/covers/';

        if (!is_dir($dir)) {
            mkdir($dir, 0755, true);
        }

        if (!move_uploaded_file($file['tmp_name'], $dir . $filename)) {
            Response::error('Failed to save image', 500);
        }

        $url = '/uploads/covers/' . $filename;
        DB::query('UPDATE courses SET cover_image = ? WHERE id = ?', [$url, $id]);

        Response::success(['url' => $url], 'Cover uploaded');
    }

    private function assertOwnership(int $courseId, int $userId, string $role): void
    {
        if ($role === 'admin') return;
        $course = DB::query('SELECT teacher_id FROM courses WHERE id = ?', [$courseId])->fetch();
        if (!$course || (int) $course['teacher_id'] !== $userId) {
            Response::error('Forbidden', 403);
        }
    }

    private function validated(Request $request): array
    {
        $title = trim($request->input('title', ''));
        if (!$title) {
            Response::error('title is required');
        }

        $rawOrig = $request->input('original_price');
        return [
            'title'          => $title,
            'description'    => $request->input('description'),
            'cover_image'    => $request->input('cover_image'),
            'price'          => (float) $request->input('price', 0),
            'original_price' => ($rawOrig !== null && $rawOrig !== '') ? (float) $rawOrig : null,
            'level'          => $request->input('level'),
            'subject'        => $request->input('subject'),
            'is_published'   => $request->input('is_published', false) ? 'true' : 'false',
        ];
    }
}
