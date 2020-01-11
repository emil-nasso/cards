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
        $category = $id ? Category::findOrFail($id) : new Category();
        $category->order = 0;
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
    }

    public function buildFormLayout()
    {
        $this->addColumn(
            12,
            function (FormLayoutColumn $column) {
                $column->withFields('name');
            }
        );
    }
}
