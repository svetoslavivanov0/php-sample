<?php

use Tuupola\Middleware\JwtAuthentication;

if (PHP_SAPI == 'cli-server') {
    // To help the built-in PHP dev server, check if the request was actually for
    // something which should probably be served as a static file
    $file = __DIR__ . $_SERVER['REQUEST_URI'];
    if (is_file($file)) {
        return false;
    }
}

require __DIR__ . '/../vendor/autoload.php';

session_start();

// Instantiate the app
$settings = require __DIR__ . '/../src/settings.php';
$env = __DIR__;
$app = new \Slim\App($settings);

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../src/');
$dotenv->load();

$app->add(new JwtAuthentication([
    'path' => '/api',
    'attribute' => 'jwt',
    'secret' => $_ENV['JWT_SECRET']
]));

// Set up dependencies
require __DIR__ . '/../src/dependencies.php';

// Register middleware
require __DIR__ . '/../src/middleware.php';

// Register routes
require __DIR__ . '/../src/routes.php';

// Run Application
$app->run();
