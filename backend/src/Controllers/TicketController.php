<?php

namespace App\Controllers;

use App\Core\DB;
use App\Core\Request;
use App\Core\Response;

class TicketController
{
    private function ticketNo(int $id): string
    {
        return 'TKT-' . str_pad($id, 4, '0', STR_PAD_LEFT);
    }

    // GET /tickets
    public function index(Request $request): void
    {
        $userId = (int) $request->params['_user_id'];
        $role   = $request->params['_user_role'];

        $where = $role === 'admin'
            ? ''
            : 'WHERE (t.teacher_id = ' . $userId . ' OR t.teacher_id IS NULL)';

        $rows = DB::query(
            "SELECT t.id, t.title, t.category, t.status, t.created_at, t.updated_at,
                    u.id AS student_id, u.full_name AS student_name,
                    (SELECT tm.body FROM ticket_messages tm
                     WHERE tm.ticket_id = t.id ORDER BY tm.created_at DESC LIMIT 1) AS last_message,
                    (SELECT tm.created_at FROM ticket_messages tm
                     WHERE tm.ticket_id = t.id ORDER BY tm.created_at DESC LIMIT 1) AS last_message_at
             FROM support_tickets t
             JOIN users u ON u.id = t.student_id
             $where
             ORDER BY
               CASE t.status WHEN 'in_progress' THEN 1 WHEN 'open' THEN 2 ELSE 3 END,
               COALESCE(
                 (SELECT tm2.created_at FROM ticket_messages tm2
                  WHERE tm2.ticket_id = t.id ORDER BY tm2.created_at DESC LIMIT 1),
                 t.created_at
               ) DESC"
        )->fetchAll();

        $now = new \DateTimeImmutable();
        foreach ($rows as &$row) {
            $at            = new \DateTimeImmutable($row['last_message_at'] ?? $row['created_at']);
            $hours         = ($now->getTimestamp() - $at->getTimestamp()) / 3600;
            $row['id']     = (int) $row['id'];
            $row['ticket_no']  = $this->ticketNo($row['id']);
            $row['hours_ago']  = round($hours, 1);
        }
        unset($row);

        Response::success($rows);
    }

    // GET /tickets/{id}
    public function show(Request $request): void
    {
        $ticketId = (int) $request->params['id'];
        $userId   = (int) $request->params['_user_id'];

        $ticket = DB::query(
            'SELECT t.id, t.title, t.category, t.status, t.created_at, t.teacher_id,
                    u.id AS student_id, u.full_name AS student_name, u.email
             FROM support_tickets t
             JOIN users u ON u.id = t.student_id
             WHERE t.id = ?',
            [$ticketId]
        )->fetch();

        if (!$ticket) {
            Response::error('Ticket not found', 404);
            return;
        }

        $ticket['ticket_no'] = $this->ticketNo($ticket['id']);

        $messages = DB::query(
            'SELECT tm.id, tm.sender_id, tm.body, tm.created_at, u.full_name AS sender_name
             FROM ticket_messages tm
             JOIN users u ON u.id = tm.sender_id
             WHERE tm.ticket_id = ?
             ORDER BY tm.created_at ASC',
            [$ticketId]
        )->fetchAll();

        // Auto-assign to this teacher when first opened
        if (!$ticket['teacher_id']) {
            DB::query(
                'UPDATE support_tickets SET teacher_id = ?, updated_at = NOW() WHERE id = ?',
                [$userId, $ticketId]
            );
        }

        Response::success(array_merge($ticket, ['messages' => $messages]));
    }

    // POST /tickets/{id}/messages  { body }
    public function addMessage(Request $request): void
    {
        $ticketId = (int) $request->params['id'];
        $userId   = (int) $request->params['_user_id'];
        $body     = trim($request->input('body', ''));

        if (!$body) {
            Response::error('body is required', 422);
            return;
        }

        $ticket = DB::query(
            'SELECT id, status, teacher_id FROM support_tickets WHERE id = ?',
            [$ticketId]
        )->fetch();

        if (!$ticket) {
            Response::error('Ticket not found', 404);
            return;
        }

        // Auto-set in_progress when teacher first replies
        if ($ticket['status'] === 'open') {
            DB::query(
                'UPDATE support_tickets SET status = ?, teacher_id = ?, updated_at = NOW() WHERE id = ?',
                ['in_progress', $userId, $ticketId]
            );
        } else {
            DB::query('UPDATE support_tickets SET updated_at = NOW() WHERE id = ?', [$ticketId]);
        }

        $msg = DB::query(
            'INSERT INTO ticket_messages (ticket_id, sender_id, body)
             VALUES (?, ?, ?)
             RETURNING id, sender_id, body, created_at',
            [$ticketId, $userId, $body]
        )->fetch();

        Response::success($msg, 'Sent', 201);
    }

    // PATCH /tickets/{id}/status  { status }
    public function updateStatus(Request $request): void
    {
        $ticketId = (int) $request->params['id'];
        $status   = $request->input('status');

        if (!in_array($status, ['open', 'in_progress', 'resolved'])) {
            Response::error('Invalid status', 422);
            return;
        }

        DB::query(
            'UPDATE support_tickets SET status = ?, updated_at = NOW() WHERE id = ?',
            [$status, $ticketId]
        );

        Response::success(['id' => $ticketId, 'status' => $status]);
    }
}
