<?php

namespace App\Sharp;

use Code16\Sharp\EntityList\Containers\EntityListDataContainer;
use Code16\Sharp\EntityList\EntityListQueryParams;
use Code16\Sharp\EntityList\SharpEntityList;
use App\Category;

class CategoryList extends SharpEntityList
{
    /**
     * Build list containers using ->addDataContainer()
     *
     * @return void
     */
    public function buildListDataContainers()
    {
        $this->addDataContainer(
            EntityListDataContainer::make('name')
                ->setLabel('Name')
                ->setSortable()
        );
    }

    public function buildListLayout()
    {
        $this->addColumn('name', 12);
    }

    public function buildListConfig()
    {
        $this->setInstanceIdAttribute('id')
            ->setDefaultSort('order', 'asc')
            ->setReorderable(new CategoryReorderHandler());
    }

    public function getListData(EntityListQueryParams $params)
    {
        $categories = Category::query()->orderBy($params->sortedBy(), $params->sortedDir());
        return $this->transform($categories->get());
    }
}
