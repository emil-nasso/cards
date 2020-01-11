<?php

namespace App\Sharp;

use App\Post;
use Code16\Sharp\Form\Eloquent\Transformers\FormUploadModelTransformer;
use Code16\Sharp\Form\Eloquent\WithSharpFormEloquentUpdater;
use Code16\Sharp\Form\Fields\SharpFormListField;
use Code16\Sharp\Form\Fields\SharpFormTextField;
use Code16\Sharp\Form\Fields\SharpFormUploadField;
use Code16\Sharp\Form\Fields\SharpFormWysiwygField;
use Code16\Sharp\Form\Layout\FormLayoutColumn;
use Code16\Sharp\Form\SharpForm;
use Code16\Sharp\Form\Fields\SharpFormSelectField;
use App\Category;

class PostForm extends SharpForm
{
    use WithSharpFormEloquentUpdater;

    public function find($id): array
    {
        $this->setCustomTransformer('image', new FormUploadModelTransformer());
        $this->setCustomTransformer(
            "category_id",
            function($category_id) {
                return (int)$category_id;
            }
        );
        return $this->transform(
            Post::with(['attachments', 'image', 'category'])->findOrFail($id)
        );
    }

    public function update($id, array $data)
    {
        $post = $id ? Post::findOrFail($id) : new Post();
        $post->order = 0;
        $this->save($post, $data);
    }

    public function delete($id)
    {
        Post::findOrFail($id)->find($id)->delete();
    }

    public function buildFormFields()
    {
        $this->addField(
            SharpFormTextField::make('title')
                ->setLabel('Title')
        );
        $this->addField(
            SharpFormWysiwygField::make('body')
                ->setLabel('Body')
        );
        $this->addField(
            SharpFormUploadField::make('image')
                ->setFileFilterImages()
                ->setCropRatio("1:1")
                ->setStorageDisk("local")
                ->setLabel('Image')
        );
        $this->addField(
            SharpFormSelectField::make(
                'category_id',
                Category::all()
                    ->mapWithKeys(function ($category) {
                        return [$category->id => $category->name];
                    })
                    ->all()
            )->setLabel("Category")
        );
        $this->addField(
            SharpFormListField::make('attachments')
                ->setLabel('Attachments')
                ->setAddable()
                ->setRemovable()
                ->addItemField(
                    SharpFormTextField::make('label')->setLabel('Label')
                )
                ->addItemField(
                    SharpFormTextField::make('url')->setLabel('Url')
                )
        );
    }

    public function buildFormLayout()
    {
        $this->addColumn(
            6,
            function (FormLayoutColumn $column) {
                $column->withFields('title', 'body', 'image');
            }
        );
        $this->addColumn(
            6,
            function (FormLayoutColumn $column) {
                $column->withFields('category_id');
                $column->withSingleField("attachments", function (FormLayoutColumn $listItem) {
                    $listItem->withSingleField("label")
                        ->withSingleField("url");
                });
            }
        );
    }
}
