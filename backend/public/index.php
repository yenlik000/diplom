<?php

declare(strict_types=1);

define('BASE_PATH', dirname(__DIR__));

require BASE_PATH . '/vendor/autoload.php';

// Load .env
$env = file_exists(BASE_PATH . '/.env')
    ? parse_ini_file(BASE_PATH . '/.env')
    : [];
foreach ($env as $key => $value) {
    $_ENV[$key] = $value;
    putenv("{$key}={$value}");
}

// CORS
$origin = $_ENV['FRONTEND_URL'] ?? '*';
header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: ' . $origin);
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Authorization');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(204);
    exit;
}

require BASE_PATH . '/routes/api.php';
