<?php

namespace App\Presenters\v1;

use App\Presenters\Presenter;

class OrderPresenter extends Presenter
{
    public function listMy()
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'car' => (new CarPresenter($this->car))->list(),
            'part' => (new PartPresenter($this->part))->parts(),
            'city' => (new CityPresenter($this->city))->get(),
            'comment' => $this->comment,
            'payment_type' => $this->payment_type,
            'status' => $this->status,
            'store' => $this->store ? (new StorePresenter($this->store))->profile() : null,
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
        ];
    }

    public function short()
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'comment' => $this->comment,
            'status' => $this->status,
            'payment_type' => $this->payment_type,
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
        ];
    }
}
