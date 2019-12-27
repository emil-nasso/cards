<?php

namespace App\Sharp;

use Code16\Sharp\EntityList\EntityListFilter;
use Code16\Sharp\EntityList\EntityListMultipleFilter;

class PostPublishedFilter implements EntityListFilter, EntityListMultipleFilter
{
    /**
    * @return array
    */
    public function values()
    {
        return [0 => 'Draft', 1 => 'Published'];
    }
}
