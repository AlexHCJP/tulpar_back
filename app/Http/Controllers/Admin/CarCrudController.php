<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CarRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class CarCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class CarCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     *
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\Car::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/car');
        CRUD::setEntityNameStrings('Машина', 'Машины');
    }

    /**
     * Define what happens when the List operation is loaded.
     *
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        CRUD::column('name')->label('Наименование');
        CRUD::column('modelName')->label('Модель');
        CRUD::column('brand')->label('Производитель');

        /**
         * Columns can be defined using the fluent syntax or array syntax:
         * - CRUD::column('price')->type('number');
         * - CRUD::addColumn(['name' => 'price', 'type' => 'number']);
         */
    }

    /**
     * Define what happens when the Create operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(CarRequest::class);

        $this->crud->addField([
            'label' => 'Пользователь',
            'type' => 'select',
            'name' => 'user_id',
            'entity' => 'user',
            'attribute' => 'name',
            'model'     => "App\Models\User",
        ]);
        CRUD::field('name')->label('Наименование');
        $this->crud->addField([
            'label' => 'Модель',
            'type' => 'select',
            'name' => 'model_id',
            'entity' => 'carModel',
            'attribute' => 'name',
            'model'     => "App\Models\CarModel",
        ]);
        $this->crud->addField([
            'label' => 'Производитель',
            'type' => 'select',
            'name' => 'producer_id',
            'entity' => 'producer',
            'attribute' => 'name',
            'model'     => "App\Models\Producer",
        ]);
        $this->crud->addField([
            'label' => 'Объем',
            'name' => 'engine_volume',
        ]);
        $this->crud->addField([
            'label' => 'Год',
            'name' => 'year',
        ]);
        CRUD::field('vin_number')->label('VIN');

        /**
         * Fields can be defined using the fluent syntax or array syntax:
         * - CRUD::field('price')->type('number');
         * - CRUD::addField(['name' => 'price', 'type' => 'number']));
         */
    }

    /**
     * Define what happens when the Update operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-update
     * @return void
     */
    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }

    protected function setupShowOperation()
    {
        $this->crud->addColumn([
            'label' => 'Пользователь',
            'type' => 'select',
            'name' => 'user_id',
            'entity' => 'user',
            'attribute' => 'name',
            'model'     => "App\Models\User",
        ]);
        CRUD::column('name')->label('Наименование');
        $this->crud->addColumn([
            'label' => 'Модель',
            'type' => 'select',
            'name' => 'model_id',
            'entity' => 'carModel',
            'attribute' => 'name',
            'model'     => "App\Models\CarModel",
        ]);
        $this->crud->addColumn([
            'label' => 'Производитель',
            'type' => 'select',
            'name' => 'producer_id',
            'entity' => 'producer',
            'attribute' => 'name',
            'model'     => "App\Models\Producer",
        ]);
        $this->crud->addColumn([
            'label' => 'Объем',
            'name' => 'engine_volume',
        ]);
        $this->crud->addColumn([
            'label' => 'Год',
            'name' => 'year',
        ]);
        CRUD::column('vin_number')->label('VIN');
    }
}
