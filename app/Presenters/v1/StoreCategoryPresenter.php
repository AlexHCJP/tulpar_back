<?php

namespace App\Presenters\v1;

use App\Models\CarModel;
use App\Models\Part;
use App\Models\Producer;
use App\Presenters\Presenter;

class StoreCategoryPresenter extends Presenter
{
    public function get()
    {
        return [
            'producers' => Producer::whereIn('api_id', explode(',', $this->producers))->get(),
            'models' => CarModel::whereIn('api_id', explode(',', $this->models))->get(),
            'parts' => Part::whereIn('id', explode(',', $this->parts))->get(),
        ];
    }
}
