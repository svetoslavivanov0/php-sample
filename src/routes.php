<?php
// Routes
namespace App;

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\AuthMiddleware;
use Tuupola\Middleware\JwtAuthentication;

$app->post('/register', RegisterController::class . ':store');
$app->post('/login', LoginController::class . ':login');

$app->group('/api', function () use ($app) {
    $app->post('/me', UserController::class . ':index');
});
