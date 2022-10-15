<?php

namespace App\Controllers;

use App\Domain\User\Requests\RegisterRequest;
use Slim\Http\Request;

class RegisterController
{
    public function register(RegisterRequest $request) {
        $request->validate($request->getAttributes());
    }
}