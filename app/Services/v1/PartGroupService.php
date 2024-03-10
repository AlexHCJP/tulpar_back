<?php

namespace App\Services\v1;

use App\Presenters\v1\PartPresenter;
use App\Repositories\PartGroupRepository;
use App\Services\Service;

class PartGroupService extends Service
{
    public function __construct(public PartGroupRepository $repository)
    {}

    public function getPaginated(array $params = [])
    {
        return $this->resultCollections(
            $this->repository->getPaginated($params),
            PartPresenter::class,
            'list',
            $this->repository->count($params)
        );
    }
}
