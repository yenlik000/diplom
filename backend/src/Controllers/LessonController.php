<?php

namespace App\Controllers;

use App\Core\DB;
use App\Core\Request;
use App\Core\Response;

class LessonController
{
    // GET /lessons/{id}  — auth required; enrollment check skipped for teachers/admins
    public function show(Request $request): void
    {
        $id     = (int) $request->params['id'];
        $userId = (int) ($request->params['_user_id'] ?? 0);
        $role   = $request->params['_user_role'] ?? 'student';

        $lesson = DB::query(
            'SELECT l.*, m.course_id
             FROM lessons l JOIN modules m ON m.id = l.module_id
             WHERE l.id = ?',
            [$id]
        )->fetch();

        if (!$lesson) {
            Response::error('Lesson not found', 404);
        }

        if (!$lesson['is_free_preview'] && $role === 'student') {
            $enrolled = DB::query(
                'SELECT id FROM enrollments WHERE user_id = ? AND course_id = ?',
                [$userId, $lesson['course_id']]
            )->fetch();
            if (!$enrolled) {
                Response::error('Enroll in this course to access the lesson', 403);
            }
        }

        $lesson['materials'] = DB::query(
            'SELECT id, title, file_url, file_type FROM lesson_materials WHERE lesson_id = ?',
            [$id]
        )->fetchAll();

        $lesson['homework'] = DB::query(
            'SELECT id, title, description FROM homeworks WHERE lesson_id = ?',
            [$id]
        )->fetch() ?: null;

        Response::success($lesson);
    }

    // POST /modules/{moduleId}/lessons  — teacher (own course) / admin
    public function store(Request $request): void
    {
        $moduleId = (int) $request->params['moduleId'];
        $userId   = (int) $request->params['_user_id'];
        $role     = $request->params['_user_role'];
        $data     = $this->validated($request);

        $module = DB::query('SELECT id FROM modules WHERE id = ?', [$moduleId])->fetch();
        if (!$module) {
            Response::error('Module not found', 404);
        }

        $this->assertModuleOwnership($moduleId, $userId, $role);

        DB::query(
            'INSERT INTO lessons (module_id, title, video_url, text_content, order_num, is_free_preview)
             VALUES (?, ?, ?, ?, ?, ?)',
            [$moduleId, $data['title'], $data['video_url'], $data['text_content'],
             $data['order_num'], $data['is_free_preview']]
        );

        $lesson = DB::query('SELECT * FROM lessons WHERE id = lastval()')->fetch();
        Response::success($lesson, 'Lesson created', 201);
    }

    // PUT /lessons/{id}  — teacher (own course) / admin
    public function update(Request $request): void
    {
        $id     = (int) $request->params['id'];
        $userId = (int) $request->params['_user_id'];
        $role   = $request->params['_user_role'];
        $data   = $this->validated($request);

        $this->assertLessonOwnership($id, $userId, $role);

        $rows = DB::query(
            'UPDATE lessons
             SET title=?, video_url=?, text_content=?, order_num=?, is_free_preview=?
             WHERE id=?',
            [$data['title'], $data['video_url'], $data['text_content'],
             $data['order_num'], $data['is_free_preview'], $id]
        )->rowCount();

        if (!$rows) {
            Response::error('Lesson not found', 404);
        }

        Response::success(null, 'Lesson updated');
    }

    // DELETE /lessons/{id}  — teacher (own course) / admin
    public function destroy(Request $request): void
    {
        $id     = (int) $request->params['id'];
        $userId = (int) $request->params['_user_id'];
        $role   = $request->params['_user_role'];

        $this->assertLessonOwnership($id, $userId, $role);

        $rows = DB::query('DELETE FROM lessons WHERE id = ?', [$id])->rowCount();

        if (!$rows) {
            Response::error('Lesson not found', 404);
        }

        Response::success(null, 'Lesson deleted');
    }

    private function assertModuleOwnership(int $moduleId, int $userId, string $role): void
    {
        if ($role === 'admin') return;
        $row = DB::query(
            'SELECT c.teacher_id FROM modules m JOIN courses c ON c.id = m.course_id WHERE m.id = ?',
            [$moduleId]
        )->fetch();
        if (!$row || (int) $row['teacher_id'] !== $userId) {
            Response::error('Forbidden', 403);
        }
    }

    private function assertLessonOwnership(int $lessonId, int $userId, string $role): void
    {
        if ($role === 'admin') return;
        $row = DB::query(
            'SELECT c.teacher_id
             FROM lessons l
             JOIN modules m ON m.id = l.module_id
             JOIN courses c ON c.id = m.course_id
             WHERE l.id = ?',
            [$lessonId]
        )->fetch();
        if (!$row || (int) $row['teacher_id'] !== $userId) {
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
            'title'           => $title,
            'video_url'       => $request->input('video_url'),
            'text_content'    => $request->input('text_content'),
            'order_num'       => (int) $request->input('order_num', 1),
            'is_free_preview' => $request->input('is_free_preview', false) ? 'true' : 'false',
        ];
    }
}
