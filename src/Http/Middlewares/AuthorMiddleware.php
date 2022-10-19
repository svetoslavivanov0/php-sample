<?php

namespace App\Http\Middlewares;

use App\Domain\User\Models\User;
use Slim\Http\Request;
use Slim\Http\Response;

class AuthorMiddleware
{
    public function __invoke(Request $request, Response $response, $next)
    {
        $payload = $request->getAttribute('jwt');
        $email = $payload['email'];

        $user = User::whereEmail($email)->first();

        if (!$user) {
            return $response
                ->withStatus(404);
        }

        $route = $request->getAttribute('route');

        if (!$postId = $route->getArgument('id')) {
            return $response
                ->withStatus(422)
                ->withJson([
                    'message' => 'Missing id'
                ]);
        }

        $post = $user->posts()->find($postId);

        if (!$post) {
            return $response
                ->withStatus(403)
                ->withJson([
                    'message' => 'Not an author!'
                ]);
        }

        return $next($request, $response);
    }
}