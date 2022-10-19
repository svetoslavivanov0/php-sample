<?php

namespace App\Domain\Post\Actions;

use App\Domain\User\Models\User;
use Exception;
use Slim\Http\Request;

class CreatePost
{
    /**
     * @param User $user
     * @param array $data
     * @return mixed
     * @throws Exception
     */
    public function handle(User $user, Request $request): mixed
    {
        if (!$title = $request->getParam('title')) {
            throw new Exception('Title is required!');
        }

        if (!$content = $request->getParam('content')) {
            throw new Exception('Content is required!');
        }

        return $user->posts()->create([
            'title' => $title,
            'content' => $content
        ]);
    }
}