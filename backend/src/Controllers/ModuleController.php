<?php

namespace App\Controllers;

use App\Core\DB;
use App\Core\Request;
use App\Core\Response;

class ModuleController
{
    // POST /courses/{courseId}/modules  — teacher (own) / admin
    public function store(Request $request): void
    {
        $courseId = (int) $request->params['courseId'];
        $userId   = (int) $request->params['_user_id'];
        $role     = $request->params['_user_role'];
        $title    = trim($request->input('title', ''));
        $orderNum = (int) $request->input('order_num', 1);

        if (!$title) {
            Response::error('title is required');
        }

        $course = DB::query('SELECT id, teacher_id FROM courses WHERE id = ?', [$courseId])->fetch();
        if (!$course) {
            Response::error('Course not found', 404);
        }

        $this->assertCourseOwnership($course, $userId, $role);

        DB::query(
            'INSERT INTO modules (course_id, title, order_num) VALUES (?, ?, ?)',
            [$courseId, $title, $orderNum]
        );

        $module = DB::query('SELECT * FROM modules WHERE id = lastval()')->fetch();
        Response::success($module, 'Module created', 201);
    }

    // PUT /modules/{id}  — teacher (own course) / admin
    public function update(Request $request): void
    {
        $id       = (int) $request->params['id'];
        $userId   = (int) $request->params['_user_id'];
        $role     = $request->params['_user_role'];
        $title    = trim($request->input('title', ''));
        $orderNum = (int) $request->input('order_num', 1);

        if (!$title) {
            Response::error('title is required');
        }

        $this->assertModuleOwnership($id, $userId, $role);

        $rows = DB::query(
            'UPDATE modules SET title = ?, order_num = ? WHERE id = ?',
            [$title, $orderNum, $id]
        )->rowCount();

        if (!$rows) {
            Response::error('Module not found', 404);
        }

        Response::success(null, 'Module updated');
    }

    // DELETE /modules/{id}  — teacher (own course) / admin
    public function destroy(Request $request): void
    {
        $id     = (int) $request->params['id'];
        $userId = (int) $request->params['_user_id'];
        $role   = $request->params['_user_role'];

        $this->assertModuleOwnership($id, $userId, $role);

        $rows = DB::query('DELETE FROM modules WHERE id = ?', [$id])->rowCount();

        if (!$rows) {
            Response::error('Module not found', 404);
        }

        Response::success(null, 'Module deleted');
    }

    private function assertCourseOwnership(array $course, int $userId, string $role): void
    {
        if ($role === 'admin') return;
        if ((int) $course['teacher_id'] !== $userId) {
            Response::error('Forbidden', 403);
        }
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
}
