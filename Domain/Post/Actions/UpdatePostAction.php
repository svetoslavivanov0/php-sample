<?php

namespace App\Domain\Post\Actions;

use App\Domain\User\Models\User;
use Exception;
use Slim\Http\Request;

class UpdatePostAction
{
    /**
     * @param User $user
     * @param Request $request
     * @param int $postId
     * @return mixed
     * @throws Exception
     */
    public function handle(User $user, Request $request, int $postId)
    {

        $post = $user->posts()->find($postId);

        if (!$title = $request->getParam('title')) {
            throw new Exception('Title is required!');
        }

        if (!$content = $request->getParam('content')) {
            throw new Exception('Content is required!');
        }

        return tap($post->update([
            'title' => $title,
            'content' => $content
        ]));

    }
}