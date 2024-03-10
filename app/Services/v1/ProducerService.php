<?php

namespace App\Services\v1;

use App\Presenters\v1\ProducerPresenter;
use App\Repositories\ProducerRepository;
use App\Services\Service;

class ProducerService extends Service
{
    public function __construct(public ProducerRepository $producerRepository)
    {

    }

    public function index(array $params = [])
    {
        return $this->resultCollections(
            $this->producerRepository->index($params),
            ProducerPresenter::class,
            'list',
            $this->producerRepository->count($params)
        );
    }
}