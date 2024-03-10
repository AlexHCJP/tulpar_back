<?php

namespace App\Presenters\v1;

use App\Presenters\Presenter;

class PartPresenter extends Presenter
{
    public function list()
    {
        return [
            'id' => $this->id,
            'api_id' => $this->api_id,
            'hasGroups' => (boolean) $this->hasGroups,
            'hasParts' => (boolean) $this->hasParts,
            'name' => $this->name,
            'img' => $this->img ? url($this->img) : null,
            'description' => $this->description,
            'parentId' => $this->parentId,
            'childs' => $this->presentCollections($this->childs, PartPresenter::class, 'list'),
        ];
    }

    public function single()
    {
        return [
            'id' => $this->id,
            'api_id' => $this->api_id,
            'hasGroups' => (boolean) $this->hasGroups,
            'hasParts' => (boolean) $this->hasParts,
            'name' => $this->name,
            'img' => $this->img ? url($this->img) : null,
            'description' => $this->description,
            'parentId' => $this->parentId,
        ];
    }

    public function parts()
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'number' => $this->number,
            'notice' => $this->notice,
            'description' => $this->description,
        ];
    }
}
