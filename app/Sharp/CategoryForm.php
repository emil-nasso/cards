<?php

namespace App\Sharp;

use App\Category;
use Code16\Sharp\Form\Eloquent\WithSharpFormEloquentUpdater;
use Code16\Sharp\Form\Fields\SharpFormTextField;
use Code16\Sharp\Form\Layout\FormLayoutColumn;
use Code16\Sharp\Form\SharpForm;

class CategoryForm extends SharpForm
{
    use WithSharpFormEloquentUpdater;

    public function find($id): array
    {
        return $this->transform(
            Category::findOrFail($id)
        );
    }

    public function update($id, array $data)
    {
        if ($id) {
            $category = Category::findOrFail($id);
        } else {
            $category = new Category();
            $last = Category::query()
                ->orderBy('order', 'DESC')
                ->first();
            $category->order = $last ? $last->order + 1 : 0;
        }
        $this->save($category, $data);
    }

    public function delete($id)
    {
        Category::findOrFail($id)->find($id)->delete();
    }

    public function buildFormFields()
    {
        $this->addField(
            SharpFormTextField::make('name')
                ->setLabel('Name')
        );
        $this->addField(
            SharpFormTextField::make('description')
                ->setLabel('Description')
        );
        $this->addField(
            SharpFormTextField::make('slug')
                ->setLabel('Slug')
        );
    }

    public function buildFormLayout()
    {
        $this->addColumn(
            12,
            function (FormLayoutColumn $column) {
                $column->withFields('name', 'description', 'slug');
            }
        );
    }
}
