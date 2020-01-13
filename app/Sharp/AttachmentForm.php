<?php

namespace App\Sharp;

use App\Attachment;
use Code16\Sharp\Form\Eloquent\WithSharpFormEloquentUpdater;
use Code16\Sharp\Form\Fields\SharpFormSelectField;
use Code16\Sharp\Form\Fields\SharpFormTextField;
use Code16\Sharp\Form\Layout\FormLayoutColumn;
use Code16\Sharp\Form\SharpForm;

class AttachmentForm extends SharpForm
{
    use WithSharpFormEloquentUpdater;

    public function find($id): array
    {
        return $this->transform(
            Attachment::findOrFail($id)
        );
    }

    public function update($id, array $data)
    {
        $attachment = $id ? Attachment::findOrFail($id) : new Attachment();
        $attachment->description = $data['description'];
        $attachment->label = $data['label'];
        $attachment->url = $data['url'];
        $this->save($attachment, $data);
    }

    public function delete($id)
    {
        Attachment::findOrFail($id)->delete();
    }

    public function buildFormFields()
    {
        $this->addField(
            SharpFormTextField::make('description')
                ->setLabel('Description')
        );
        $this->addField(
            SharpFormTextField::make('label')
                ->setLabel('Label (link-text)')
        );
        $this->addField(
            SharpFormTextField::make('url')
            ->setLabel('Url')
        );
    }

    public function buildFormLayout()
    {
        $this->addColumn(
            5,
            function (FormLayoutColumn $column) {
                $column->withSingleField('description');
            }
        );
        $this->addColumn(
            3,
            function (FormLayoutColumn $column) {
                $column->withSingleField('label');
            }
        );
        $this->addColumn(
            4,
            function (FormLayoutColumn $column) {
                $column->withSingleField('url');
            }
        );
    }
}
