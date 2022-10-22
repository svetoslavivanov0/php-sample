<?php

namespace App\Domain\Post\Actions;

use App\Domain\Post\Models\Post;
use App\Domain\User\Models\User;
use Exception;
use Slim\Http\Request;

class CreatePostAction
{
    /**
     * @param User $user
     * @param array $data
     * @return mixed
     * @throws Exception
     */
    public function handle(User $user, Request $request): Post
    {
        if (!$title = $request->getParam('title')) {
            throw new Exception('Title is required!');
        }

        if (!$content = $request->getParam('content')) {
            throw new Exception('Content is required!');
        }

        $validator = new \Valitron\Validator([
            'title' => $request->getParam('title'),
            'content' => $request->getParam('content'),
        ]);

        $validator
            ->rule('required', ['title', 'content']);

        $validator->validate();

        if ($errors = $validator->errors()) {
            throw new Exception(reset($errors)[0]);
        }

        return $user->posts()->create([
            'title' => $title,
            'content' => $content
        ]);
    }
}