<?php

namespace App\Presenters\v1;

use App\Presenters\Presenter;

class ProducerPresenter extends Presenter
{
    public function list()
    {
        return [
            'id' => $this->id,
            'api_id' => $this->api_id,
            'name' => $this->name,
            'img' => $this->img ? url($this->img): null,
            'is_popular' => (boolean) $this->is_popular,
        ];
    }
}
