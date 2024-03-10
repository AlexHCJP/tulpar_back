<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Backpack\CRUD\app\Exceptions\AccessDeniedException;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Carbon\Carbon;

class UserCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    public function setup()
    {
        CRUD::setModel(\App\Models\User::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/user');
        CRUD::setEntityNameStrings('пользователь', 'пользователи');
    }

    protected function setupListOperation()
    {
        $this->crud->addColumn(['name' => 'id', 'label' => 'ID']);
        $this->crud->addColumn(['name' => 'image', 'label' => 'Фото', 'type' => 'image']);
        $this->crud->addColumn(['name' => 'name', 'label' => 'ФИО']);
        $this->crud->addColumn(['name' => 'email', 'label' => 'E-Mail']);
        $this->crud->addColumn(['name' => 'phone', 'label' => 'Телефон']);
        $this->crud->addColumn([
            'name' => 'role',
            'label' => 'Роль',
            'type'        => 'select_from_array',
            'options'     => [
                'admin' => 'Админ',
                'moderator' => 'Модератор',
                'user' => 'Пользователь',
            ],
            'allows_null' => false,
            'default'     => 'user',
        ]);
        $this->crud->addColumn(['name' => 'verified_at', 'label' => 'Верифицирован']);
        $this->crud->addColumn(['name' => 'created_at', 'label' => 'Зарегистрирован']);
    }

    protected function setupCreateOperation()
    {
        CRUD::setValidation(UserRequest::class);

        $this->crud->addField([
            'name' => 'image',
            'label' => 'Фото',
            'type'      => 'upload',
            'upload'    => true,
            'disk'      => 'public',
        ]);
        $this->crud->addField(['name' => 'name', 'label' => 'ФИО']);
        $this->crud->addField(['name' => 'email', 'label' => 'E-Mail']);
        $this->crud->addField(['name' => 'phone', 'label' => 'Телефон']);
        $this->crud->addField(['name' => 'password', 'type' => 'password', 'label' => 'Пароль']);
        $this->crud->addField([
            'name'  => 'verified_at',
            'type'  => 'hidden',
            'value' => Carbon::now(),
        ]);
        $this->crud->addField([
            'name' => 'role',
            'label' => 'Роль',
            'type'        => 'select_from_array',
            'options'     => [
                'admin' => 'Админ',
                'moderator' => 'Модератор',
                'user' => 'Пользователь',
            ],
            'allows_null' => false,
            'default'     => 'user',
        ]);
    }

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }

    protected function setupShowOperation()
    {
        $this->setupListOperation();
        $this->crud->addColumn(['name' => 'updated_at', 'label' => 'Последнее обновление']);
    }

    public function destroy($id)
    {
        $user = User::find($id);
        if (backpack_user()->role !== User::ROLE_ADMIN && $user->role === User::ROLE_ADMIN) {
            throw new AccessDeniedException(trans('backpack::crud.unauthorized_access', ['access' => 'delete']));
        }

        return $this->crud->delete($id);
    }
}
