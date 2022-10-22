<?php

namespace App\Domain\Post\Actions;

use App\Domain\Post\Models\Post;
use App\Domain\User\Models\User;
use Exception;
use Psr\Log\InvalidArgumentException;
use Slim\Http\Request;

class UpdatePostAction
{
    /**
     * @param User $user
     * @param Request $request
     * @param int $postId
     * @throws InvalidArgumentException
     */
    public function handle(User $user, Request $request, int $postId)
    {

        $post = $user->posts()->find($postId);

        if (!$title = $request->getParam('title')) {
            throw new InvalidArgumentException('Title is required!');
        }

        if (!$content = $request->getParam('content')) {
            throw new InvalidArgumentException('Content is required!');
        }

        $post->update([
            'title' => $title,
            'content' => $content
        ]);

        return $post;
    }
}