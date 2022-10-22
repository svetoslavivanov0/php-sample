<?php

namespace App\Domain\Post\Actions;

use App\Domain\User\Models\User;
use Exception;

class DeletePostAction
{
    /**
     * @param User $user
     * @param int $postId
     * @return mixed
     * @throws Exception
     */
    public function handle(User $user, int $postId)
    {
        $post = $user->posts()->find($postId);

        return tap($post->delete());
    }
}