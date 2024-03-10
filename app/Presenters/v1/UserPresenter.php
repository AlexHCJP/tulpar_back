<?php

namespace App\Presenters\v1;

use App\Presenters\Presenter;

class UserPresenter extends Presenter
{
    public function myProfile()
    {
        return [
            'id' => $this->id,
            'email' => $this->email,
            'name' => $this->name,
            'phone' => $this->phone,
            'role' => $this->role,
            'image' => $this->image ? url($this->image) : null,
            'rating' => $this->rating,
            'last_active' => $this->last_active ? $this->last_active->format('Y-m-d H:i:s') : null,
        ];
    }
}
