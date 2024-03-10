<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\ApiController;
use App\Http\Requests\Api\v1\User\UpdateRequest;
use App\Services\v1\UserService;

class UserController extends ApiController
{
    public function __construct(public UserService $userService)
    {

    }

    public function updateProfile(UpdateRequest $request)
    {
        return $this->result(
            $this->userService->update(
                auth('api')->user(),
                $request->validated()
            )
        );
    }

    public function delete()
    {
        return $this->result(
            $this->userService->delete()
        );
    }
}
