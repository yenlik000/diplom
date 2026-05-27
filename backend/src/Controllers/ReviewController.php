<?php

namespace App\Controllers;

use App\Core\DB;
use App\Core\Request;
use App\Core\Response;

class ReviewController
{
    // GET /reviews
    public function index(Request $request): void
    {
        $rows = DB::query(
            'SELECT id, author, title, body, rating, likes, dislikes, created_at
             FROM reviews ORDER BY created_at DESC'
        )->fetchAll();

        Response::success($rows);
    }

    // POST /reviews
    public function store(Request $request): void
    {
        $author = trim($request->input('author', ''));
        $title  = trim($request->input('title',  ''));
        $body   = trim($request->input('body',   ''));
        $rating = (int) $request->input('rating', 0);

        if (!$author || !$title || !$body) {
            Response::error('author, title and body are required', 422);
        }
        if ($rating < 1 || $rating > 5) {
            Response::error('rating must be between 1 and 5', 422);
        }

        $row = DB::query(
            'INSERT INTO reviews (author, title, body, rating)
             VALUES (?, ?, ?, ?)
             RETURNING id, author, title, body, rating, likes, dislikes, created_at',
            [$author, $title, $body, $rating]
        )->fetch();

        Response::success($row, 'Created', 201);
    }

    // PATCH /reviews/{id}/vote
    public function vote(Request $request): void
    {
        $id  = (int) $request->params['id'];
        $dir = $request->input('dir');      // 'up', 'down', or null
        $prev = $request->input('prev_dir'); // previous direction or null

        $review = DB::query(
            'SELECT id, likes, dislikes FROM reviews WHERE id = ?',
            [$id]
        )->fetch();

        if (!$review) {
            Response::error('Review not found', 404);
        }

        $likes    = (int) $review['likes'];
        $dislikes = (int) $review['dislikes'];

        // Undo previous vote
        if ($prev === 'up')   $likes    = max(0, $likes - 1);
        if ($prev === 'down') $dislikes = max(0, $dislikes - 1);

        // Apply new vote
        if ($dir === 'up')   $likes++;
        if ($dir === 'down') $dislikes++;

        $row = DB::query(
            'UPDATE reviews SET likes = ?, dislikes = ? WHERE id = ?
             RETURNING id, likes, dislikes',
            [$likes, $dislikes, $id]
        )->fetch();

        Response::success($row);
    }
}
