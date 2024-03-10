<?php

namespace App\Services\v1;

use App\Presenters\v1\CityPresenter;
use App\Repositories\CityRepository;
use App\Services\Service;

class CityService extends Service
{
    public function __construct(public CityRepository $cityRepository)
    {

    }

    public function get(array $params = [])
    {
        return $this->resultCollections(
            $this->cityRepository->get($params),
            CityPresenter::class,
            'get',
            $this->cityRepository->count()
        );
    }
}
