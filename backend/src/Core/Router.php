<?php

namespace App\Core;

class Router
{
    private array $routes = [];

    public function get(string $path, array $handler, array $middleware = []): void
    {
        $this->routes[] = ['GET', $path, $handler, $middleware];
    }

    public function post(string $path, array $handler, array $middleware = []): void
    {
        $this->routes[] = ['POST', $path, $handler, $middleware];
    }

    public function put(string $path, array $handler, array $middleware = []): void
    {
        $this->routes[] = ['PUT', $path, $handler, $middleware];
    }

    public function delete(string $path, array $handler, array $middleware = []): void
    {
        $this->routes[] = ['DELETE', $path, $handler, $middleware];
    }

    public function dispatch(Request $request): void
    {
        foreach ($this->routes as [$method, $path, $handler, $middleware]) {
            if ($request->method !== $method) {
                continue;
            }

            $pattern = preg_replace('/\{(\w+)\}/', '(?P<$1>[^/]+)', $path);
            if (!preg_match('#^' . $pattern . '$#', $request->path, $matches)) {
                continue;
            }

            $request->params = array_filter($matches, 'is_string', ARRAY_FILTER_USE_KEY);

            foreach ($middleware as $mw) {
                (new $mw())->handle($request);
            }

            [$controllerClass, $action] = $handler;
            (new $controllerClass())->$action($request);
            return;
        }

        Response::error('Route not found', 404);
    }
}
