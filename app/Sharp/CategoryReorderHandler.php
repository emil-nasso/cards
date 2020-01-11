<?php

namespace App\Sharp;

use Code16\Sharp\EntityList\Commands\ReorderHandler;
use App\Category;

class CategoryReorderHandler implements ReorderHandler
{
    public function reorder(array $ids)
    {
        Category::whereIn('id', $ids)->get()->each(function ($category) use ($ids) {
            $category->order = array_search($category->id, $ids) + 1;
            $category->save();
        });
    }
}
