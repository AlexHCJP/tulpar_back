<?php

namespace App\Presenters\v1;

use App\Presenters\Presenter;

class FavoriteSearchPresenter extends Presenter
{
    public function list()
    {
        return [
            'id' => $this->id,
            'producer' => (new ProducerPresenter($this->producer))->list(),
            'model' => $this->carModel ? (new CarModelPresenter($this->carModel))->list() : null,
            'part' => $this->part ? (new PartPresenter($this->part))->list() : null,
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
        ];
    }
}