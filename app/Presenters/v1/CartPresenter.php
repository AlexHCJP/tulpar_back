<?php

namespace App\Presenters\v1;

use App\Presenters\Presenter;

class CartPresenter extends Presenter
{
    public function list(): array
    {
        return [
            'id' => $this->id,
            'part' => (new PartPresenter($this->part))->single(),
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
            'updated_at' => $this->updated_at->format('Y-m-d H:i:s'),
        ];
    }
}
