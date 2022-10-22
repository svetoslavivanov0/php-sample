<?php

namespace Tests\Unit\Models;

use App\Tests\BaseApp;
use App\Tests\Unit\Traits\CreatePostTrait;
use App\Tests\Unit\Traits\CreateUserTrait;
use App\Tests\Unit\Traits\PostRequestTrait;
use Faker\Factory;
use Faker\Generator;
use Psr\Log\InvalidArgumentException;

class UpdatePostActionTest extends BaseApp
{
    use PostRequestTrait, CreateUserTrait, CreatePostTrait;

    /** @test */
    public function itUpdatesPost()
    {
        $faker = $this->generateFaker();

        $user = $this->createUser();

        $originalPost = $this->createPost($user);

        $this->assertSame($user->posts()->count(), 1);

        $updatedData = [
            'title' => $faker->title,
            'content' => $faker->text
        ];

        $request = $this->mockRequest([
            'title' => $updatedData['title'],
            'content' => $updatedData['content']
        ]);

        $updatedPost = $this->container->updatePostAction->handle($user, $request, $originalPost->id);
        $this->assertSame($user->posts()->count(), 1);
        $this->assertSame($updatedPost->title, $updatedData['title']);
        $this->assertSame($updatedPost->content, $updatedData['content']);

    }

    /** @test */
    public function itDoesNotUpdatePost()
    {
        $this->expectException(InvalidArgumentException::class);
        $user = $this->createUser();
        $post = $this->createPost($user);

        $request = $this->mockRequest([]);
        $this->container->updatePostAction->handle($user, $request, $post->id);
    }

    protected function generateFaker(): Generator
    {
        return Factory::create();
    }
}
