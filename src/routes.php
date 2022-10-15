<?php
// Routes
namespace App;

use App\Controllers\HomeController;
use App\Middleware\AuthMiddleware;
use Psr\Container\ContainerInterface;


/** @var ContainerInterface $app */
$app->get('/', function ($request, $response, $args) {

});

$app->get('/{id}', HomeController::class . ':show');