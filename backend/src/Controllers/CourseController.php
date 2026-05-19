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
            'SELECT id, title, description, cover_image, price, level, subject
             FROM courses WHERE is_published = TRUE ORDER BY id'
        )->fetchAll();

        Response::success($courses);
    }

    // GET /courses/{id}
    public function show(Request $request): void
    {
        $id = (int) $request->params['id'];

        $course = DB::query(
            'SELECT * FROM courses WHERE id = ? AND is_published = TRUE',
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
                'SELECT id, title, order_num, is_free_preview
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
        $data   = $this->validated($request);

        DB::query(
            'INSERT INTO courses (title, description, cover_image, price, level, subject, is_published, teacher_id)
             VALUES (?, ?, ?, ?, ?, ?, ?, ?)',
            [...array_values($data), $userId]
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

        $rows = DB::query(
            'UPDATE courses
             SET title=?, description=?, cover_image=?, price=?, level=?, subject=?, is_published=?
             WHERE id=?',
            [...array_values($data), $id]
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

        return [
            'title'        => $title,
            'description'  => $request->input('description'),
            'cover_image'  => $request->input('cover_image'),
            'price'        => (float) $request->input('price', 0),
            'level'        => $request->input('level'),
            'subject'      => $request->input('subject'),
            'is_published' => $request->input('is_published', false) ? 'true' : 'false',
        ];
    }
}
