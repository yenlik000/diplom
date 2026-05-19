<?php

namespace App\Core;

class Response
{
    public static function json(mixed $data, int $status = 200): never
    {
        http_response_code($status);
        echo json_encode($data);
        exit;
    }

    public static function success(mixed $data = null, string $message = 'OK', int $status = 200): never
    {
        self::json(['success' => true, 'data' => $data, 'message' => $message], $status);
    }

    public static function error(string $message, int $status = 400): never
    {
        self::json(['success' => false, 'error' => $message], $status);
    }
}
