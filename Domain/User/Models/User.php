<?php

namespace App\Domain\User\Models;

use App\Domain\Post\Models\Post;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Model
{
    protected $table = 'users';
    protected $fillable = [
        'username',
        'email',
        'password'
    ];

    public function posts(): HasMany
    {
        return $this->hasMany(Post::class);
    }
}