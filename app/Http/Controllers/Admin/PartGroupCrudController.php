<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\PartGroupRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class PartGroupCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class PartGroupCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
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
        CRUD::setModel(\App\Models\PartGroup::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/part-group');
        CRUD::setEntityNameStrings('Группа запчастей', 'Группы запчастей');
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
        CRUD::column('name')->label('Наименование');
        CRUD::column('description')->label('Описание');
        $this->crud->addColumn(['name' => 'img', 'label' => 'Изображение', 'type' => 'image']);
        $this->crud->addColumn([
            'label' => 'Родитель',
            'type' => 'select',
            'name' => 'parentId',
            'entity' => 'parent',
            'attribute' => 'name',
            'model'     => "App\Models\PartGroup",
        ]);

    }

    protected function setupUpdateOperation()
    {
        CRUD::field('name')->label('Наименование');
        CRUD::field('description')->label('Описание');
        $this->crud->addField([
            'name' => 'img',
            'label' => 'Изображение',
            'type'      => 'upload',
            'upload'    => true,
            'disk'      => 'public',
        ]);
        $this->crud->addField([
            'label' => 'Родитель',
            'type' => 'select',
            'name' => 'parentId',
            'entity' => 'parent',
            'attribute' => 'name',
            'model'     => "App\Models\PartGroup",
        ]);
    }
}
