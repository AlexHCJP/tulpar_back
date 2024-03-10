<?php

namespace App\Presenters\v1;

use App\Presenters\Presenter;

class CityPresenter extends Presenter
{
    public function get()
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
        ];
    }
}
