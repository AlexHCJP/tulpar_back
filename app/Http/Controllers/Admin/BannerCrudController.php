<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\BannerRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class BannerCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class BannerCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     *
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\Banner::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/banner');
        CRUD::setEntityNameStrings('баннер', 'баннеры');
    }

    /**
     * Define what happens when the List operation is loaded.
     *
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        CRUD::column('id');
        $this->crud->addColumn(['name' => 'image', 'label' => 'Картинка', 'type' => 'image']);
        $this->crud->addColumn([
            'name' => 'title',
            'label' => 'Заголовок',
        ]);
        $this->crud->addColumn([
            'label'     => 'Магазин',
            'type'      => 'select',
            'name'      => 'store_id',
            'entity'    => 'store',
            'attribute' => 'name',
            'model'     => "App\Models\Store",
        ]);
        $this->crud->addColumn(['name' => 'created_at', 'label' => 'Создан']);
        $this->crud->addColumn(['name' => 'updated_at', 'label' => 'Обновлен']);

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
        CRUD::setValidation(BannerRequest::class);

        $this->crud->addField([
            'name' => 'image',
            'label' => 'Картинка',
            'type'      => 'upload',
            'upload'    => true,
            'disk'      => 'public',
        ]);
        $this->crud->addField([
            'name' => 'title',
            'label' => 'Заголовок',
        ]);
        $this->crud->addField([
            'label'     => 'Магазин',
            'type'      => 'select',
            'name'      => 'store_id',
            'entity'    => 'store',
            'attribute' => 'name',
            'model'     => "App\Models\Store",
        ]);

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
        $this->setupListOperation();
    }
}
