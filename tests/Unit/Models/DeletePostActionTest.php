<?php

namespace Tests\Unit\Models;

use App\Tests\BaseApp;
use App\Tests\Unit\Traits\CreatePostTrait;
use App\Tests\Unit\Traits\CreateUserTrait;

class DeletePostActionTest extends BaseApp
{
    use CreateUserTrait, CreatePostTrait;

    /** @test */
    public function itDeletesPost()
    {

        $user = $this->createUser();

        $post = $this->createPost($user);

        $this->assertSame($user->posts()->count(), 1);

        $this->container->deletePostAction->handle($user, $post->id);
        $this->assertSame($user->posts()->count(), 0);
    }
}
