<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ProducerRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

class ProducerCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    public function setup()
    {
        CRUD::setModel(\App\Models\Producer::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/producer');
        CRUD::setEntityNameStrings('производитель', 'производители');
    }

    protected function setupListOperation()
    {
        CRUD::setOperationSetting('lineButtonsAsDropdown', true);
        CRUD::column('id');
        CRUD::column('name')->label('Наименование');
        $this->crud->addColumn(['name' => 'img', 'label' => 'Логотип', 'type' => 'image']);
        $this->crud->addColumn([
            'name' => 'is_popular',
            'label' => 'Популярный',
            'type' => 'check',
        ]);
    }

    protected function setupCreateOperation()
    {
        CRUD::setValidation(ProducerRequest::class);

        CRUD::field('name')->label('Наименование');
        $this->crud->addField([
            'name' => 'img',
            'label' => 'Фото',
            'type'      => 'upload',
            'upload'    => true,
            'disk'      => 'public',
        ]);
        CRUD::field('is_popular')->label('Популярный')->type('switch');
    }

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
