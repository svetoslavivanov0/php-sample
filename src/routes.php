<?php
// Routes
namespace App;

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\AuthMiddleware;
use App\Http\Middlewares\AuthorMiddleware;
use Tuupola\Middleware\JwtAuthentication;

$app->post('/register', RegisterController::class . ':store');
$app->post('/login', LoginController::class . ':login');

$app->group('/api', function () use ($app) {
    $app->post('/me', UserController::class . ':index');

    $app->get('/posts', PostController::class . ':index');
    $app->get('/posts/all', PostController::class . ':all');
    $app->post('/posts/create', PostController::class . ':store');
    $app->post('/posts/{id}/update', PostController::class . ':update')->add(new AuthorMiddleware());
    $app->get('/posts/{id}/edit', PostController::class . ':show')->add(new AuthorMiddleware());
    $app->get('/posts/{id}', PostController::class . ':show');
    $app->delete('/posts/{id}/delete', PostController::class . ':destroy')->add(new AuthorMiddleware());
});
