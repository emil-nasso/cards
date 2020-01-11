<?php

namespace App\Sharp;

use Code16\Sharp\EntityList\EntityListFilter;
use Code16\Sharp\EntityList\EntityListMultipleFilter;
use App\Category;

class PostCategoryFilter implements EntityListFilter, EntityListMultipleFilter
{
    /**
     * @return array
     */
    public function values()
    {
        return Category::all()
            ->mapWithKeys(function ($category) {
                return [$category->id => $category->name];
            })
            ->all();
    }
}
