<?php

namespace App\Http\Controllers\Auth;

use App\Domain\User\Models\User;
use Slim\Http\Request;
use Slim\Http\Response;

class RegisterController
{
    /**
     * Register the user
     * @param Request $request
     * @param Response $response
     * @return Response
     */
    public function store(Request $request, Response $response): Response
    {
        // check if all required fields are valid
        $validatedRequst = $this->isValid($request);

        if (!$validatedRequst['is_valid']) {
            return $response
                ->withJson(422)
                ->withJson([
                    'message' => reset($validatedRequst['errors'])[0]
                ]);
        }

        // check if user exists
        if ($this->canRegister(
            $request->getParam('email')
        )) {
            return $response
                ->withStatus(401)
                ->withJson([
                    'message' => 'User already exists!'
                ]);
        } else {
            User::create([
                'username' => $request->getParam('username'),
                'email' => $request->getParam('email'),
                'password' => password_hash($request->getParam('password', PASSWORD_BCRYPT), 1)
            ]);

            return $response
                ->withStatus(200)
                ->withJson([
                    'message' => 'Successfully registered!'
                ]);
        }
    }

    /**
     * Check if user already exists
     * @param string $email
     * @return bool
     */
    protected function canRegister(string $email): bool
    {
        return !!User::where('email', $email)->count();
    }

    /**
     * Validates the data
     * @param Request $request
     * @return array
     */
    protected function isValid(Request $request): array
    {
        $validator = new \Valitron\Validator([
            'username' => $request->getParam('username') ?? null,
            'email' => $request->getParam('email') ?? null,
            'password' => $request->getParam('password') ?? null,
        ]);

        $validator
            ->rule('required', ['username', 'email', 'password'])
            ->rule('lengthMin', 'password', 7)
            ->rule('email', 'email');

        return [
            'is_valid' => $validator->validate(),
            'errors' => $validator->errors()
        ];
    }
}