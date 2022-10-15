<?php

// load .env
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

return [
    'migration_dirs' => [
        'first' => __DIR__ . '/Application/database/migrations',
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
        'production' => [
            'adapter' => 'mysql',
            'host' => 'production_host',
            'port' => 3306, // optional
            'username' => 'user',
            'password' => 'pass',
            'db_name' => 'my_production_db',
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_general_ci', // optional, if not set default collation for utf8mb4 is used
        ],
    ],
    'default_environment' => 'local',
    'log_table_name' => 'phoenix_log',
];