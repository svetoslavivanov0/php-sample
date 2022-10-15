<?php
// Routes
namespace App;

use App\Controllers\HomeController;
use App\Controllers\RegisterController;
use App\Middleware\AuthMiddleware;
use Psr\Container\ContainerInterface;


$app->get('/', HomeController::class .':show');

$app->post('/register', RegisterController::class . ':register');

$app->get('/{id}', HomeController::class . ':show');