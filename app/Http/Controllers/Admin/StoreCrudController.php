<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\StoreRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

class StoreCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    public function setup()
    {
        CRUD::setModel(\App\Models\Store::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/store');
        CRUD::setEntityNameStrings('магазин', 'магазины');
    }

    protected function setupListOperation()
    {
        CRUD::setOperationSetting('lineButtonsAsDropdown', true);
        CRUD::column('id');
        $this->crud->addColumn([
            'label'     => 'Город',
            'type'      => 'select',
            'name'      => 'city_id',
            'entity'    => 'city',
            'attribute' => 'name',
            'model'     => "App\Models\City",
        ]);
        CRUD::column('image')->type('image')->label('Фото');
        CRUD::column('name')->label('Название');
        CRUD::column('phone')->label('Телефон');
        CRUD::column('rating')->label('Рейтинг');
        CRUD::column('active')->type('check')->label('Доступ');
    }

    protected function setupCreateOperation()
    {
        CRUD::setValidation(StoreRequest::class);

        $this->crud->addField([
            'label'     => 'Город',
            'type'      => 'select',
            'name'      => 'city_id',
            'entity'    => 'city',
            'attribute' => 'name',
            'model'     => "App\Models\City",
        ]);
        CRUD::field('name')->label('Название');
        CRUD::field('phone')->label('Телефон');
        CRUD::field('password')->label('Пароль');
        CRUD::field('description')->label('Описание');
        CRUD::field('address')->label('Адреса');
        $this->crud->addField([
            'name' => 'image',
            'label' => 'Фото',
            'type'      => 'upload',
            'upload'    => true,
            'disk'      => 'public',
        ]);
        $this->crud->addField([
            'name'  => 'active',
            'type'  => 'hidden',
            'value' => 1,
        ]);
    }

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }

    protected function setupShowOperation()
    {
        CRUD::column('id');
        $this->crud->addColumn([
            'label'     => 'Город',
            'type'      => 'select',
            'name'      => 'city_id',
            'entity'    => 'city',
            'attribute' => 'name',
            'model'     => "App\Models\City",
        ]);
        CRUD::column('image')->type('image')->label('Фото');
        CRUD::column('name')->label('Название');
        CRUD::column('phone')->label('Телефон');
        CRUD::column('rating')->label('Рейтинг');
        CRUD::column('active')->type('check')->label('Доступ');
        CRUD::column('description')->label('Описание');
        CRUD::column('address')->label('Адреса');
        $this->crud->addColumn([
            'name'  => 'producers',
            'label' => 'Производители',
            'type'  => 'model_function',
            'function_name' => 'getProducers',
            'limit' => 10000,
        ]);

        $this->crud->addColumn([
            'name'  => 'models',
            'label' => 'Модели',
            'type'  => 'model_function',
            'function_name' => 'getModels',
            'limit' => 10000,
        ]);

        $this->crud->addColumn([
            'name'  => 'parts',
            'label' => 'Запчасти',
            'type'  => 'model_function',
            'function_name' => 'getParts',
            'limit' => 10000,
        ]);
    }
}
