<?php

// load .env
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/');
$dotenv->load();

return [
    'migration_dirs' => [
        'local' => __DIR__ . '/database/migrations',
        'test' => __DIR__ . '/database/migrations',
    ],
    'environments' => [
        'local' => [
            'adapter' => 'mysql',
            'host' => $_ENV['DB_HOST'],
            'db_name' => $_ENV['DB_NAME'],
            'username' => $_ENV['DB_USER'],
            'password' => $_ENV['DB_PASSWORD'],
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_general_ci', // optional, if not set default collation for utf8mb4 is used
        ],
        'test' => [
            'adapter' => 'mysql',
            'host' => $_ENV['TEST_DB_HOST'],
            'db_name' => $_ENV['TEST_DB_NAME'],
            'username' => $_ENV['TEST_DB_USER'],
            'password' => $_ENV['TEST_DB_PASSWORD'],
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_general_ci', // optional, if not set default collation for utf8mb4 is used
        ],
    ],
    'default_environment' => 'local',
    'log_table_name' => 'phoenix_log',
];