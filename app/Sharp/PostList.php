<?php

namespace App\Sharp;

use App\Post;
use Code16\Sharp\EntityList\Containers\EntityListDataContainer;
use Code16\Sharp\EntityList\EntityListQueryParams;
use Code16\Sharp\EntityList\SharpEntityList;

class PostList extends SharpEntityList
{
    /**
     * Build list containers using ->addDataContainer()
     *
     * @return void
     */
    public function buildListDataContainers()
    {
        $this->addDataContainer(
            EntityListDataContainer::make('title')
                ->setLabel('Title')
                ->setSortable()
        )->addDataContainer(
            EntityListDataContainer::make('created_at')
                ->setLabel('Created')
                ->setSortable()
        )->addDataContainer(
            EntityListDataContainer::make('category:name')
                ->setLabel('Category')
                ->setSortable()
        )->addDataContainer(
            EntityListDataContainer::make('published')
                ->setLabel('State')
                ->setSortable()
        )->addDataContainer(
            EntityListDataContainer::make('image')
                ->setLabel('Image')
        )
        ;
    }

    public function buildListLayout()
    {
        $this->addColumn('title', 5)
            ->addColumn('image', 2)
            ->addColumn('category:name', 2)
            ->addColumn('published', 1)
            ->addColumn('created_at', 2);
    }

    public function buildListConfig()
    {
        $this->setInstanceIdAttribute('id')
            ->setSearchable()
            ->setDefaultSort('order', 'asc')
            ->setPaginated()
            ->addFilter('State', PostPublishedFilter::class)
            ->addFilter('Category', PostCategoryFilter::class)
            // ->setEntityState('published', PostPublishedState::class)
            ->setReorderable(new PostReorderHandler());
    }

    public function getListData(EntityListQueryParams $params)
    {
        $posts = Post::query()->orderBy($params->sortedBy(), $params->sortedDir());

        if ($params->hasSearch()) {
            foreach ($params->searchWords() as $word) {
                $posts->where(function ($query) use ($word) {
                    $query->orWhere('title', 'like', $word)
                        ->orWhere('body', 'like', $word);
                });
            }
        }

        if (!is_null($params->filterFor("State"))) {
            $posts->where("published", $params->filterFor("State"));
        }

        if (!is_null($params->filterFor("Category"))) {
            $posts->where("category_id", $params->filterFor("Category"));
        }

        $this->setCustomTransformer(
            "image",
            function ($value, $post, $attribute) {
                if (is_null($post->image)) {
                    return "";
                }
                return "<img src='{$post->image->thumbnail(32)}'>";
            }
        );
        return $this->transform($posts->get());
    }
}
