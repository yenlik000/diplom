<?php

namespace App\Core;

class Request
{
    public string $method;
    public string $path;
    public array  $body;
    public array  $query;
    public array  $params = [];

    public function __construct()
    {
        $this->method = $_SERVER['REQUEST_METHOD'];
        $uri          = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $this->path   = '/' . trim(preg_replace('#^/api#', '', $uri), '/');
        $this->query  = $_GET;
        $this->body   = json_decode(file_get_contents('php://input'), true) ?? [];
    }

    public function input(string $key, mixed $default = null): mixed
    {
        return $this->body[$key] ?? $default;
    }

    public function bearerToken(): ?string
    {
        $header = $_SERVER['HTTP_AUTHORIZATION'] ?? '';
        if (str_starts_with($header, 'Bearer ')) {
            return substr($header, 7);
        }
        return null;
    }
}
