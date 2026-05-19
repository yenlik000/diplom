<?php

namespace App\Controllers;

use App\Core\DB;
use App\Core\Request;
use App\Core\Response;

/**
 * Groups CRUD — admin only.
 * GET    /groups
 * POST   /groups
 * PUT    /groups/{id}
 * DELETE /groups/{id}
 */
class GroupController
{
    public function index(Request $request): void
    {
        $groups = DB::query(
            'SELECT g.*, COUNT(sp.id) AS student_count
             FROM groups g
             LEFT JOIN student_profiles sp ON sp.group_id = g.id
             GROUP BY g.id
             ORDER BY g.name'
        )->fetchAll();

        Response::success($groups);
    }

    public function store(Request $request): void
    {
        $name = trim($request->input('name', ''));
        $desc = trim($request->input('description', ''));

        if (!$name) {
            Response::error('name is required');
        }

        $exists = DB::query('SELECT id FROM groups WHERE name = ?', [$name])->fetch();
        if ($exists) {
            Response::error("Group '{$name}' already exists", 409);
        }

        DB::query(
            'INSERT INTO groups (name, description) VALUES (?, ?)',
            [$name, $desc ?: null]
        );

        $group = DB::query('SELECT * FROM groups WHERE name = ?', [$name])->fetch();
        Response::success($group, 'Group created', 201);
    }

    public function update(Request $request): void
    {
        $id   = (int) $request->params['id'];
        $name = trim($request->input('name', ''));
        $desc = trim($request->input('description', ''));

        if (!$name) {
            Response::error('name is required');
        }

        $this->findOrFail($id);

        DB::query(
            'UPDATE groups SET name = ?, description = ? WHERE id = ?',
            [$name, $desc ?: null, $id]
        );

        $group = DB::query('SELECT * FROM groups WHERE id = ?', [$id])->fetch();
        Response::success($group);
    }

    public function destroy(Request $request): void
    {
        $id = (int) $request->params['id'];
        $this->findOrFail($id);

        DB::query('DELETE FROM groups WHERE id = ?', [$id]);
        Response::success(null, 'Group deleted');
    }

    // ── Private ───────────────────────────────────────────────

    private function findOrFail(int $id): array
    {
        $group = DB::query('SELECT * FROM groups WHERE id = ?', [$id])->fetch();
        if (!$group) {
            Response::error('Group not found', 404);
        }
        return $group;
    }
}
