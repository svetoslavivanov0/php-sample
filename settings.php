<?php

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

return [
    'settings' => [
        // Monolog settings
        'logger' => [
            'name' => 'slim-Application',
            'path' => __DIR__ . '/../logs/app.log',
        ],

        'determineRouteBeforeAppMiddleware' => true,
        'displayErrorDetails' => false,
        'db' => [
            'driver' => 'mysql',
            'host' => $_ENV['DB_HOST'],
            'database' => $_ENV['DB_NAME'],
            'username' => $_ENV['DB_USER'],
            'password' => $_ENV['DB_PASSWORD'],
            'charset'   => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix'    => '',
        ]
    ],
];
