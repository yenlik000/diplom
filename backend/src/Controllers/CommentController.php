<?php

namespace App\Controllers;

use App\Core\DB;
use App\Core\Request;
use App\Core\Response;

class CommentController
{
    // GET /comments
    public function index(Request $request): void
    {
        $rows = DB::query(
            'SELECT c.id, c.body, c.created_at, u.full_name AS author
             FROM comments c
             JOIN users u ON u.id = c.user_id
             ORDER BY c.created_at DESC'
        )->fetchAll();

        Response::success($rows);
    }

    // POST /comments  (requires auth)
    public function store(Request $request): void
    {
        $userId = $request->params['_user_id'];
        $body   = trim($request->input('body', ''));

        if (!$body) {
            Response::error('Comment body is required', 422);
        }

        $row = DB::query(
            'INSERT INTO comments (user_id, body)
             VALUES (?, ?)
             RETURNING id, body, created_at',
            [$userId, $body]
        )->fetch();

        $user = DB::query('SELECT full_name FROM users WHERE id = ?', [$userId])->fetch();
        $row['author'] = $user['full_name'] ?? 'Unknown';

        Response::success($row, 'Created', 201);
    }
}
