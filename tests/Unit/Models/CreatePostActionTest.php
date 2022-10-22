<?php

namespace Tests\Unit\Models;

use App\Tests\BaseApp;
use App\Tests\Unit\Traits\CreateUserTrait;
use App\Tests\Unit\Traits\PostRequestTrait;
use Faker\Factory;
use Faker\Generator;
use Psr\Log\InvalidArgumentException;

class CreatePostActionTest extends BaseApp
{
    use PostRequestTrait, CreateUserTrait;

    /** @test */
    public function itCanCreateAPostFromRequest()
    {
        $faker = $this->generateFaker();

        $user = $this->createUser();

        $this->assertSame($user->posts()->count(), 0);
        $request = $this->mockRequest([
            'title' => $faker->title,
            'content' => $faker->text
        ]);
        $this->container->createPostAction->handle($user, $request);

        $this->assertSame($user->posts()->count(), 1);

    }

    /** @test */
    public function itDoesNotCreatePost() {
        $this->expectException(InvalidArgumentException::class);
        $user = $this->createUser();

        $request = $this->mockRequest([]);
        $this->container->createPostAction->handle($user, $request);
        $this->assertSame($user->posts()->count(), 0);
    }

    protected function generateFaker(): Generator
    {
        return Factory::create();
    }
}
