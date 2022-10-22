<?php

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

return [
    'settings' => [
        // Monolog settings
        'logger' => [
            'name' => 'slim-Application',
            'path' => __DIR__ . '/../logs/test-app.log',
        ],

        'determineRouteBeforeAppMiddleware' => true,
        'displayErrorDetails' => true,
        'db' => [
            'driver' => 'mysql',
            'host' => $_ENV['TEST_DB_HOST'],
            'database' => $_ENV['TEST_DB_NAME'],
            'username' => $_ENV['TEST_DB_USER'],
            'password' => $_ENV['TEST_DB_PASSWORD'],
            'charset'   => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix'    => '',
        ]
    ],
];
