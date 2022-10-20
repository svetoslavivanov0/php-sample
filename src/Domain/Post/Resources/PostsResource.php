<?php

namespace App\Domain\Post\Resources;

use Illuminate\Database\Eloquent\Collection;

class PostsResource
{
    protected Collection $posts;

    public function __construct(Collection $posts)
    {
        $this->posts = $posts;
    }

    public function toArray()
    {
        $data = [];

        /** @var \App\Domain\Post\Models\Post $post */
        foreach ($this->posts as $post) {
            $data[] = [
                'id' => $post->id,
                'title' => $post->title,
                'content' => $post->content,
                'created_at' => date_format($post->created_at, 'm/d')
            ];
        }

        return $data;
    }
}