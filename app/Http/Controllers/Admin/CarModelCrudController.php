<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CarModelRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class CarModelCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class CarModelCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    public function setup()
    {
        CRUD::setModel(\App\Models\CarModel::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/car-model');
        CRUD::setEntityNameStrings('модель', 'модели');
    }

    protected function setupListOperation()
    {
        CRUD::setOperationSetting('lineButtonsAsDropdown', true);
        CRUD::column('id');
        CRUD::column('name')->label('Наименование');
        $this->crud->addColumn([
            'label'     => 'Производитель',
            'type'      => 'select',
            'name'      => 'producer_id',
            'entity'    => 'producer',
            'attribute' => 'name',
            'model'     => "App\Models\Producer",
        ]);
        $this->crud->addColumn(['name' => 'img', 'label' => 'Фото', 'type' => 'image']);
    }

    protected function setupCreateOperation()
    {
        CRUD::setValidation(CarModelRequest::class);

        CRUD::field('name')->label('Наименование');
        $this->crud->addField([
            'label'     => 'Производитель',
            'type'      => 'select',
            'name'      => 'producer_id',
            'entity'    => 'producer',
            'attribute' => 'name',
            'model'     => "App\Models\Producer",
            'options'   => (function ($query) {
                return $query->orderBy('name', 'ASC')->get();
            }),
        ]);
        $this->crud->addField([
            'name' => 'img',
            'label' => 'Фото',
            'type'      => 'upload',
            'upload'    => true,
            'disk'      => 'public',
        ]);
    }

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
