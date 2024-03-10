<?php

namespace App\Presenters\v1;

use App\Presenters\Presenter;

class StorePresenter extends Presenter
{
    public function profile()
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'address' => $this->address,
            'phone' => $this->phone,
            'city' => (new CityPresenter($this->city))->get(),
            'image' => $this->image ? url($this->image) : null,
            'rating' => (double) $this->rating,
            'store_category' => $this->category ? (new StoreCategoryPresenter($this->category))->get() : null,
            'last_active' => $this->last_active ? $this->last_active->format('Y-m-d H:i:s') : null,
        ];
    }

    public function hidden()
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'address' => $this->address,
            'city' => (new CityPresenter($this->city))->get(),
            'image' => $this->image ? url($this->image) : null,
            'rating' => (double) $this->rating,
            'last_active' => $this->last_active ? $this->last_active->format('Y-m-d H:i:s') : null,
        ];
    }
}
