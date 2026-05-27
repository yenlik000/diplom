<?php

namespace App\Controllers;

use App\Core\DB;
use App\Core\MinioStorage;
use App\Core\Request;
use App\Core\Response;

class MessageController
{
    // POST /messages/upload-image
    public function uploadImage(Request $request): void
    {
        $allowed = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
        $maxSize = 10 * 1024 * 1024; // 10 MB

        if (empty($_FILES['file']) || $_FILES['file']['error'] !== UPLOAD_ERR_OK) {
            Response::error('No valid file uploaded', 422);
            return;
        }

        $file = $_FILES['file'];

        if (!in_array($file['type'], $allowed, true)) {
            Response::error('Only JPEG, PNG, GIF and WebP images are allowed', 422);
            return;
        }
        if ($file['size'] > $maxSize) {
            Response::error('Image must be under 10 MB', 422);
            return;
        }

        $ext       = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION)) ?: 'jpg';
        $objectKey = 'messages/img_' . time() . '_' . bin2hex(random_bytes(4)) . '.' . $ext;

        try {
            $minio = new MinioStorage();
            $url   = $minio->upload($file['tmp_name'], $objectKey, $file['type']);
        } catch (\RuntimeException $e) {
            Response::error('Storage upload failed: ' . $e->getMessage(), 500);
            return;
        }

        Response::success(['url' => $url], 'Image uploaded', 201);
    }

    // GET /messages/contacts
    public function contacts(Request $request): void
    {
        $userId = (int) $request->params['_user_id'];
        $role   = $request->params['_user_role'];

        if ($role === 'admin') {
            // Admin sees ALL users except self
            $rows = DB::query(
                'SELECT id, full_name, email, role, avatar_url, NULL AS course_title
                 FROM users WHERE id <> ? ORDER BY full_name',
                [$userId]
            )->fetchAll();
        } elseif ($role === 'teacher') {
            // Teacher sees students enrolled in their courses
            $rows = DB::query(
                'SELECT DISTINCT u.id, u.full_name, u.email, u.role, u.avatar_url,
                        (SELECT c2.title FROM courses c2
                         JOIN enrollments e2 ON e2.course_id = c2.id
                         WHERE c2.teacher_id = ? AND e2.user_id = u.id
                         LIMIT 1) AS course_title
                 FROM users u
                 JOIN enrollments e ON e.user_id = u.id
                 JOIN courses c ON c.id = e.course_id
                 WHERE c.teacher_id = ?
                 UNION
                 SELECT DISTINCT u.id, u.full_name, u.email, u.role, u.avatar_url, NULL AS course_title
                 FROM users u
                 WHERE u.id IN (
                   SELECT from_user_id FROM messages WHERE to_user_id = ?
                   UNION
                   SELECT to_user_id   FROM messages WHERE from_user_id = ?
                 ) AND u.id <> ?',
                [$userId, $userId, $userId, $userId, $userId]
            )->fetchAll();
        } else {
            // Student sees teachers of enrolled courses
            $rows = DB::query(
                'SELECT DISTINCT u.id, u.full_name, u.email, u.role, u.avatar_url, NULL AS course_title
                 FROM users u
                 JOIN courses c ON c.teacher_id = u.id
                 JOIN enrollments e ON e.course_id = c.id
                 WHERE e.user_id = ?
                 UNION
                 SELECT DISTINCT u.id, u.full_name, u.email, u.role, u.avatar_url, NULL AS course_title
                 FROM users u
                 WHERE u.id IN (
                   SELECT from_user_id FROM messages WHERE to_user_id = ?
                   UNION
                   SELECT to_user_id   FROM messages WHERE from_user_id = ?
                 ) AND u.id <> ?',
                [$userId, $userId, $userId, $userId]
            )->fetchAll();
        }

        // Deduplicate by user id (UNION may return same user twice with different course_title)
        $seen   = [];
        $unique = [];
        foreach ($rows as $row) {
            $uid = (int) $row['id'];
            if (!isset($seen[$uid])) {
                $seen[$uid] = true;
                $unique[]   = $row;
            }
        }
        $rows = $unique;

        $result = [];
        foreach ($rows as $row) {
            $cid = (int) $row['id'];

            $last = DB::query(
                'SELECT body, created_at FROM messages
                 WHERE (from_user_id = ? AND to_user_id = ?)
                    OR (from_user_id = ? AND to_user_id = ?)
                 ORDER BY created_at DESC LIMIT 1',
                [$userId, $cid, $cid, $userId]
            )->fetch();

            $unread = DB::query(
                'SELECT COUNT(*) AS cnt FROM messages
                 WHERE from_user_id = ? AND to_user_id = ? AND is_read = FALSE',
                [$cid, $userId]
            )->fetch()['cnt'];

            $result[] = array_merge($row, [
                'last_message'    => $last['body']       ?? null,
                'last_message_at' => $last['created_at'] ?? null,
                'unread_count'    => (int) $unread,
            ]);
        }

        // Sort by last_message_at DESC, contacts with messages first
        usort($result, function ($a, $b) {
            if (!$a['last_message_at'] && !$b['last_message_at']) return 0;
            if (!$a['last_message_at']) return 1;
            if (!$b['last_message_at']) return -1;
            return strcmp($b['last_message_at'], $a['last_message_at']);
        });

        Response::success(array_values($result));
    }

    // GET /messages?with={userId}
    public function index(Request $request): void
    {
        $userId = (int) $request->params['_user_id'];
        $withId = (int) ($request->query['with'] ?? 0);

        if (!$withId) {
            Response::error('Missing required param: with', 422);
            return;
        }

        $rows = DB::query(
            'SELECT m.id, m.from_user_id AS sender_id, m.to_user_id, m.body, m.created_at,
                    u.full_name AS from_name
             FROM messages m
             JOIN users u ON u.id = m.from_user_id
             WHERE (m.from_user_id = ? AND m.to_user_id = ?)
                OR (m.from_user_id = ? AND m.to_user_id = ?)
             ORDER BY m.created_at ASC
             LIMIT 100',
            [$userId, $withId, $withId, $userId]
        )->fetchAll();

        // Mark incoming messages as read
        DB::query(
            'UPDATE messages SET is_read = TRUE
             WHERE to_user_id = ? AND from_user_id = ? AND is_read = FALSE',
            [$userId, $withId]
        );

        Response::success($rows);
    }

    // POST /messages  { to_user_id, body }
    public function store(Request $request): void
    {
        $fromId = (int) $request->params['_user_id'];
        $toId   = (int) $request->input('to_user_id', 0);
        $body   = trim($request->input('body', ''));

        if (!$toId) {
            Response::error('to_user_id is required', 422);
            return;
        }
        if (!$body) {
            Response::error('body is required', 422);
            return;
        }

        $row = DB::query(
            'INSERT INTO messages (from_user_id, to_user_id, body)
             VALUES (?, ?, ?)
             RETURNING id, from_user_id AS sender_id, to_user_id, body, created_at',
            [$fromId, $toId, $body]
        )->fetch();

        Response::success($row, 'Sent', 201);
    }
}
