<?php

namespace App\Middleware;

use App\Core\Request;
use App\Core\Response;

class AdminMiddleware extends AuthMiddleware
{
    public function handle(Request $request): void
    {
        parent::handle($request);

        if ($request->params['_user_role'] !== 'admin') {
            Response::error('Forbidden', 403);
        }
    }
}
