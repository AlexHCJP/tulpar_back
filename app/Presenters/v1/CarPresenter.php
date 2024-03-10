<?php

namespace App\Presenters\v1;

use App\Presenters\Presenter;

class CarPresenter extends Presenter
{
    public function list()
    {
        return [
            'id' => $this->id,
            'api_id' => $this->api_id,
            'name' => $this->name,
            'modelId' => $this->modelId,
            'model' => $this->modelName,
            'catalogId' => $this->catalogId,
            'brand' => $this->brand,
            'parameters' => json_decode($this->parameters, true),
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
            'updated_at' => $this->updated_at->format('Y-m-d H:i:s'),
        ];
    }

    public function my()
    {
        return [
            'id' => $this->id,
            'car' => (new CarPresenter($this->car))->list(),
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
            'updated_at' => $this->updated_at->format('Y-m-d H:i:s'),
        ];
    }
}
