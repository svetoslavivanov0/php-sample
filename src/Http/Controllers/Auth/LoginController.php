<?php

namespace App\Http\Controllers\Auth;

use App\Domain\User\Models\User;
use Dotenv\Dotenv;
use Firebase\JWT\JWT;
use Slim\Http\Request;
use Slim\Http\Response;
use Valitron\Validator;

class LoginController
{
    /**
     * Loggin user
     * @param Request $request
     * @param Response $response
     * @return Response
     */
    public function login(Request $request, Response $response): Response
    {
        $dotenv = Dotenv::createImmutable(__DIR__ . '/../../../');
        $dotenv->load();

        $validRequest = $this->isValid($request);

        if ($validRequest['isValid']) {
            $payload = [
                'username' => $request->getParam('username'),
                'email' => $request->getParam('email')
            ];

            $token = JWT::encode($payload, $_ENV['JWT_SECRET']);

            return $response
                ->withJson([
                    'message' => 'Successfully logged in!',
                    'token' => $token
                ])
                ->withStatus(200);
        } else {
            return $response
                ->withStatus(422)
                ->withJson([
                    'message' => reset($validRequest['errors'])[0]
                ]);
        }
    }

    /**
     * Check if request is valid
     * @param Request $request
     * @return array
     */
    protected function isValid(Request $request): array
    {
        $email = $request->getParam('email') ?? null;
        $password = $request->getParam('password') ?? null;

        $validator = new Validator([
            'password' => $password,
            'email' => $email
        ]);

        $validator->addRule('userExists', function () use ($email, $password) {
            $existingUser = User::whereEmail($email)->first();

            if (!$existingUser) {
                return false;
            }

            return password_verify($password, $existingUser->password);
        }, 'Invalid email or password!');

        $validator
            ->rule('required', ['email', 'password'])
            ->rule('email', ['email'])
            ->rule('userExists', 'email');

        return [
            'isValid' => $validator->validate(),
            'errors' => $validator->errors()
        ];
    }
}