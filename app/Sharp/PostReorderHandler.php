<?php

namespace App\Sharp;

use App\Post;
use Code16\Sharp\EntityList\Commands\ReorderHandler;

class PostReorderHandler implements ReorderHandler
{
    public function reorder(array $ids)
    {
        Post::whereIn('id', $ids)->get()->each(function ($post) use ($ids) {
            $post->order = array_search($post->id, $ids) + 1;
            $post->save();
        });
    }
}
