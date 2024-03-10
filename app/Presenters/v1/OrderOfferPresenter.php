<?php

namespace App\Presenters\v1;

use App\Presenters\Presenter;

class OrderOfferPresenter extends Presenter
{
    public function orderOffers()
    {
        return [
            'id' => $this->id,
            'store' => (new StorePresenter($this->store))->hidden(),
            'price' => $this->price,
            'delivery' => $this->delivery,
            'producer' => $this->producer,
            'condition' => $this->condition,
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
        ];
    }

    public function listMy()
    {
        return [
            'id' => $this->id,
            'order' => (new OrderPresenter($this->order))->short(),
            'price' => $this->price,
            'delivery' => $this->delivery,
            'producer' => $this->producer,
            'condition' => $this->condition,
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
        ];
    }
}