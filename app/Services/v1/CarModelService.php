<?php

namespace App\Services\v1;

use App\Presenters\v1\CarModelPresenter;
use App\Repositories\CarModelRepository;
use App\Services\Service;

class CarModelService extends Service
{
    public function __construct(public CarModelRepository $carModelRepository)
    {

    }

    public function index(array $params = [])
    {
        return $this->resultCollections(
            $this->carModelRepository->index($params),
            CarModelPresenter::class,
            'list',
            $this->carModelRepository->count($params)
        );
    }
}