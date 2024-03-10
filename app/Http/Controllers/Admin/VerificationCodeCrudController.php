<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\VerificationCodeRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

class VerificationCodeCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    public function setup()
    {
        CRUD::setModel(\App\Models\VerificationCode::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/verification-code');
        CRUD::setEntityNameStrings('код верификации', 'коды верификации');
    }

    protected function setupListOperation()
    {
        CRUD::column('email')->label('E-mail');
        CRUD::column('phone')->label('Телефон');
        CRUD::column('code')->label('Код');
    }

    protected function setupCreateOperation()
    {
        CRUD::setValidation(VerificationCodeRequest::class);

        CRUD::field('email')->label('E-mail');
        CRUD::field('phone')->label('Телефон');
        CRUD::field('code')->label('Код');
    }

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
