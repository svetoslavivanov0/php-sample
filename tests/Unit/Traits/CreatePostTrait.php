<?php

namespace App\Tests\Unit\Traits;

use App\Domain\Post\Models\Post;
use App\Domain\User\Models\User;
use Faker\Factory;

trait CreatePostTrait
{
    protected function createPost(User $user)
    {
        $faker = Factory::create();

        $fakePost = $user->posts()->create([
           'title' => $faker->title,
           'content' => $faker->text,
        ]);

        return $fakePost;
    }
}