<?php

namespace App\Tests\Unit\Traits;

use App\Domain\User\Models\User;
use Faker\Factory;

trait CreateUserTrait
{
    protected function createUser()
    {
        $faker = Factory::create();

        $fakeUser = User::create([
            'username' => $faker->userName,
            'email' => $faker->email,
            'password' => password_hash($faker->password, 1)
        ]);

        return $fakeUser;
    }
}