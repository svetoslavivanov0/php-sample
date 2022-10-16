<?php

namespace App\Http\Controllers;

use App\Domain\User\Models\User;
use Slim\Http\Request;
use Slim\Http\Response;

class UserController
{
    public function index(Request $request, Response $response, $args) {
        $payload = $request->getAttribute('jwt');
        $email = $payload['email'];

        $user = User::whereEmail($email)->firstOrFail();

        return $response->withJson([
            'email' => $payload['email'],
            'id' => $user->id
        ]);
    }
}