<?php

namespace App\Sharp;

use App\Post;
use Code16\Sharp\EntityList\Commands\EntityState;

class PostPublishedState extends EntityState
{
    /**
     * @return mixed
     */
    protected function buildStates()
    {
        $this->addState("1", "Published", self::PRIMARY_COLOR);
        $this->addState("0", "Draft", self::SECONDARY_COLOR);
    }

    protected function updateState($instanceId, $stateId)
    {
        Post::findOrFail($instanceId)->update(
            [
                'published' => $stateId,
            ]
        );

        return $this->refresh($instanceId);
    }
}
