<?php

namespace App\Sharp;

use App\Attachment;
use Code16\Sharp\EntityList\Containers\EntityListDataContainer;
use Code16\Sharp\EntityList\EntityListQueryParams;
use Code16\Sharp\EntityList\SharpEntityList;

class AttachmentList extends SharpEntityList
{
    /**
     * Build list containers using ->addDataContainer()
     *
     * @return void
     */
    public function buildListDataContainers()
    {
        $this->addDataContainer(
            EntityListDataContainer::make('description')
                ->setLabel('Description')
        )->addDataContainer(
            EntityListDataContainer::make('label')
                ->setLabel('Label')
        )->addDataContainer(
            EntityListDataContainer::make('url')
                ->setLabel('Url')
        )->addDataContainer(
            EntityListDataContainer::make('post:title')
            ->setLabel("Post")
        );
    }

    public function buildListLayout()
    {
        $this
            ->addColumn('description', 4)
            ->addColumn('label', 2)
            ->addColumn('url', 2)
            ->addColumn('post:title', 4);
    }

    public function buildListConfig()
    {
        $this->setInstanceIdAttribute('id')
            ->setSearchable()
            ->setDefaultSort('created_at', 'desc')
            ->setPaginated();
    }

    public function getListData(EntityListQueryParams $params)
    {
        $attachments = Attachment::query();

        if ($params->hasSearch()) {
            foreach ($params->searchWords() as $word) {
                $attachments->where(function ($query) use ($word) {
                    $query->orWhere('label', 'like', $word)
                        ->orWhere('url', 'like', $word);
                });
            }
        }

        return $this
            // ->setCustomTransformer("postTitle", function ($value, $attachment) {
            //     return $attachment->post->title;
            // })
            ->transform($attachments->get());
    }
}
