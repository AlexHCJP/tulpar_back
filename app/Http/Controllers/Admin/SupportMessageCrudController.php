<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\SupportMessageRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class SupportMessageCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class SupportMessageCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     *
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\SupportMessage::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/support-message');
        CRUD::setEntityNameStrings('Сообщение', 'Сообщения от пользователей');
    }

    /**
     * Define what happens when the List operation is loaded.
     *
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        $this->crud->addColumn('id');
        $this->crud->addColumn([
            'label' => 'Пользователь',
            'type' => 'select',
            'name' => 'user_id',
            'entity' => 'user',
            'attribute' => 'name',
            'model'     => "App\Models\User",
        ]);
        $this->crud->addColumn([
            'name' => 'title',
            'label' => 'Заголовок'
        ]);
        $this->crud->addColumn(['name' => 'created_at', 'label' => 'Создан']);

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
        CRUD::setValidation(SupportMessageRequest::class);



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
    protected function setupShowOperation()
    {
        $this->crud->addColumn('id');
        $this->crud->addColumn([
            'label' => 'Пользователь',
            'type' => 'select',
            'name' => 'user_id',
            'entity' => 'user',
            'attribute' => 'name',
            'model'     => "App\Models\User",
        ]);
        $this->crud->addColumn([
            'name' => 'title',
            'label' => 'Заголовок'
        ]);
        $this->crud->addColumn([
            'name' => 'description',
            'label' => 'Описание'
        ]);
        $this->crud->addColumn(['name' => 'created_at', 'label' => 'Создан']);
    }
}
