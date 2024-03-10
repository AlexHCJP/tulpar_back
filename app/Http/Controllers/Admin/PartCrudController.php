<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\PartRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

class PartCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    public function setup()
    {
        CRUD::setModel(\App\Models\Part::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/part');
        CRUD::setEntityNameStrings('запчасть', 'запчасти');
    }

    protected function setupListOperation()
    {
        CRUD::setOperationSetting('lineButtonsAsDropdown', true);
        CRUD::column('id');

        $this->crud->addColumn(['name' => 'name', 'label' => 'Наименование']);
        $this->crud->addColumn(['name' => 'notice', 'label' => 'Примечание']);
    }

    protected function setupUpdateOperation()
    {
        CRUD::setValidation(PartRequest::class);

        CRUD::field('name')->label('Наименование');
        $this->crud->addField([
            'name' => 'notice',
            'label' => 'Примечание',
        ]);
        $this->crud->addField([
            'name' => 'description',
            'label' => 'Описание',
        ]);
    }

    protected function setupShowOperation()
    {
        CRUD::column('id');
        $this->crud->addColumn(['name' => 'name', 'label' => 'Наименование']);
        $this->crud->addColumn(['name' => 'number', 'label' => 'Номер']);
        $this->crud->addColumn(['name' => 'notice', 'label' => 'Примечание']);
        $this->crud->addColumn(['name' => 'description', 'label' => 'Описание']);
        $this->crud->addColumn(['name' => 'created_at', 'label' => 'Дата создания']);
        $this->crud->addColumn(['name' => 'updated_at', 'label' => 'Редактирован']);
    }
}
