<?php

namespace App\Middleware;

use App\Core\Request;
use App\Core\Response;

/**
 * Allows only authenticated students.
 * Admins are intentionally NOT allowed through here
 * (they have their own AdminMiddleware).
 */
class StudentMiddleware extends AuthMiddleware
{
    public function handle(Request $request): void
    {
        parent::handle($request); // verify JWT first

        if ($request->params['_user_role'] !== 'student') {
            Response::error('Student access only', 403);
        }
    }
}
