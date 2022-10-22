<?php

namespace App\Tests\Unit\Traits;

use Slim\Http\Environment;
use Slim\Http\Request;

trait PostRequestTrait
{
    protected function mockRequest(array $params)
    {
        $request = Request::createFromEnvironment(Environment::mock());
        return $request->withQueryParams([
            'content' => $params['content'] ?? null,
            'title' => $params['title'] ?? null
        ]);
    }
}