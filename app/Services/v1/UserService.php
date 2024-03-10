<?php

namespace App\Services\v1;

use App\Models\User;
use App\Presenters\v1\UserPresenter;
use App\Services\Service;

class UserService extends Service
{
    public function update(User $user, array $data)
    {
        $user->fill($data);
        $user->save();

        return $this->result([
            'user' => (new UserPresenter($user))->myProfile()
        ]);
    }

    public function delete()
    {
        $user = auth('api')->user();
        $user->fill([
            'phone' => $user->phone . '_' . time(),
            'email' => $user->email . '_' . time(),
        ]);
        $user->save();
        $user->delete();

        return $this->ok();
    }
}
