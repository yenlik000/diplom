<?php

namespace App\Middleware;

use App\Core\Request;
use App\Core\Response;

class TeacherMiddleware extends AuthMiddleware
{
    public function handle(Request $request): void
    {
        parent::handle($request);

        $role = $request->params['_user_role'] ?? '';
        if ($role !== 'teacher' && $role !== 'admin') {
            Response::error('Forbidden', 403);
        }
    }
}
