<?php

return [
    'host'     => $_ENV['DB_HOST']     ?? 'localhost',
    'port'     => $_ENV['DB_PORT']     ?? '5432',
    'dbname'   => $_ENV['DB_NAME']     ?? 'bridge_lms',
    'user'     => $_ENV['DB_USER']     ?? 'postgres',
    'password' => $_ENV['DB_PASSWORD'] ?? '',
];
