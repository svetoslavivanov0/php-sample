<?php

namespace App\Middleware;

use Slim\Http\Request;
use Slim\Http\Response;
use Slim\Route;

class AuthMiddleware
{
    public function __invoke(Request $request, Response $response, Route $route)
    {
        if (!isset($_SESSION['user'])) {
            return $response->withStatus(401)->withJson(['message' => 'Not authorized']);
        }
        return $route($request, $response);
    }
}