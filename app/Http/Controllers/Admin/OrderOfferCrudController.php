<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\OrderOfferRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class OrderOfferCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class OrderOfferCrudController extends CrudController
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
        CRUD::setModel(\App\Models\OrderOffer::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/order-offer');
        CRUD::setEntityNameStrings('предложение к заказу', 'предложения к заказам');
    }

    /**
     * Define what happens when the List operation is loaded.
     *
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        $this->crud->addColumn([
            'label'     => 'Магазин',
            'type'      => 'select',
            'name'      => 'store_id',
            'entity'    => 'store',
            'attribute' => 'name',
            'model'     => "App\Models\Store",
        ]);
        $this->crud->addColumn([
            'label'     => 'Заказ',
            'type'      => 'select',
            'name'      => 'order_id',
            'entity'    => 'order',
            'attribute' => 'title',
            'model'     => "App\Models\Order",
        ]);
        CRUD::column('price')->label('Цена');
        CRUD::column('delivery')->label('Доставка');
        CRUD::column('producer')->label('Производитель');
        $this->crud->addColumn([
            'name' => 'condition',
            'label' => 'Состояние',
            'type'        => 'select_from_array',
            'options'     => [
                'new' => 'Новое',
                'used' => 'Б/У',
            ],
            'allows_null' => false,
            'default'     => 'new',
        ]);

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
        CRUD::setValidation(OrderOfferRequest::class);

        $this->crud->addField([
            'label'     => 'Магазин',
            'type'      => 'select',
            'name'      => 'store_id',
            'entity'    => 'store',
            'attribute' => 'name',
            'model'     => "App\Models\Store",
        ]);
        $this->crud->addField([
            'label'     => 'Заказ',
            'type'      => 'select',
            'name'      => 'order_id',
            'entity'    => 'order',
            'attribute' => 'title',
            'model'     => "App\Models\Order",
        ]);
        CRUD::field('price')->label('Цена');
        CRUD::field('delivery')->label('Доставка');
        CRUD::field('producer')->label('Производитель');
        $this->crud->addField([
            'name' => 'condition',
            'label' => 'Состояние',
            'type'        => 'select_from_array',
            'options'     => [
                'new' => 'Новое',
                'used' => 'Б/У',
            ],
            'allows_null' => false,
            'default'     => 'new',
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
}
