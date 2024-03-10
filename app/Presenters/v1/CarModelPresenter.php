<?php

namespace App\Presenters\v1;

use App\Presenters\Presenter;

class CarModelPresenter extends Presenter
{
    public function list()
    {
        return [
            'id' => $this->id,
            'api_id' => $this->api_id,
            'name' => $this->name,
            'producer_id' => $this->producer_id,
            'img' => $this->img ? url($this->img) : null,
        ];
    }
}
