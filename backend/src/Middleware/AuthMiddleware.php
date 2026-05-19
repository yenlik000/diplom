<?php

namespace App\Middleware;

use App\Core\Request;
use App\Core\Response;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class AuthMiddleware
{
    public function handle(Request $request): void
    {
        $token = $request->bearerToken();
        if (!$token) {
            Response::error('Unauthorized', 401);
        }

        try {
            $payload = JWT::decode($token, new Key($_ENV['JWT_SECRET'], 'HS256'));
            $request->params['_user_id']   = $payload->sub;
            $request->params['_user_role'] = $payload->role;
        } catch (\Exception) {
            Response::error('Invalid or expired token', 401);
        }
    }
}
