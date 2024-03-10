<?php

namespace App\Presenters\v1;

use App\Presenters\Presenter;

class BannerPresenter extends Presenter
{
    public function list()
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'image' => url($this->image),
            'store' => (new StorePresenter($this->store))->profile(),
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
            'updated_at' => $this->updated_at->format('Y-m-d H:i:s'),
        ];
    }
}
