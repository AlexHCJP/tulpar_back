<?php

namespace App\Http\Controllers\Admin;

use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

class OrderCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    public function setup()
    {
        CRUD::setModel(\App\Models\Order::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/order');
        CRUD::setEntityNameStrings('заказ', 'заказы');
    }

    protected function setupListOperation()
    {
        CRUD::setOperationSetting('lineButtonsAsDropdown', true);
        $this->crud->addColumn([
            'label' => 'Город',
            'type' => 'select',
            'name' => 'city_id',
            'entity' => 'city',
            'attribute' => 'name',
            'model'     => "App\Models\City",
        ]);
        $this->crud->addColumn(['name' => 'id', 'label' => 'ID']);
        $this->crud->addColumn(['name' => 'title', 'label' => 'Заголовок']);
        $this->crud->addColumn([
            'label' => 'Машина',
            'type' => 'select',
            'name' => 'car_id',
            'entity' => 'car',
            'attribute' => 'name',
            'model'     => "App\Models\Car",
        ]);
        $this->crud->addColumn([
            'label'     => 'Запчасть',
            'type'      => 'select',
            'name'      => 'part_id',
            'entity'    => 'part',
            'attribute' => 'name',
            'model'     => "App\Models\Part",
        ]);
        $this->crud->addColumn(['name' => 'comment', 'label' => 'Комментарий']);
        $this->crud->addColumn([
            'name'    => 'status',
            'label'   => 'Статус',
            'type'    => 'select_from_array',
            'options' => [
                'moderation' => 'На модерации',
                'canceled' => 'Отменен',
                'active' => 'Активный',
                'done' => 'Завершенный',
            ],
        ]);
        $this->crud->addColumn([
            'name'    => 'payment_type',
            'label'   => 'Тип оплаты',
            'type'    => 'select_from_array',
            'options' => [
                'cash' => 'Наличные',
                'card' => 'Оплата картой',
                'epayment' => 'Электронные платежи',
            ],
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
    }

    protected function setupShowOperation()
    {
        $this->setupListOperation();
    }

    protected function setupUpdateOperation()
    {
        $this->crud->addField(['name' => 'title', 'label' => 'Заголовок']);
        $this->crud->addField([
            'label'     => 'Запчасть',
            'type'      => 'select',
            'name'      => 'part_id',
            'entity'    => 'part',
            'attribute' => 'name',
            'model'     => "App\Models\Part",
        ],);

        $this->crud->addField([
            'label' => 'Город',
            'type' => 'select',
            'name' => 'city_id',
            'entity' => 'city',
            'attribute' => 'name',
            'model'     => "App\Models\City",
        ]);
        $this->crud->addField(['name' => 'comment', 'label' => 'Комментарий']);
        $this->crud->addField([
            'name'    => 'status',
            'label'   => 'Статус',
            'type'    => 'select_from_array',
            'options' => [
                'moderation' => 'На модерации',
                'active' => 'Активный',
                'canceled' => 'Отменен',
                'done' => 'Завершенный',
            ],
        ]);
        $this->crud->addField([
            'name'    => 'payment_type',
            'label'   => 'Тип оплаты',
            'type'    => 'select_from_array',
            'options' => [
                'cash' => 'Наличные',
                'card' => 'Оплата картой',
                'epayment' => 'Электронные платежи',
            ],
        ]);
    }
}
