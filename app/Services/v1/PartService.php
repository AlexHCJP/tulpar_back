<?php

namespace App\Services\v1;

use App\Models\Part;
use App\Presenters\v1\PartPresenter;
use App\Repositories\PartRepository;
use App\Services\Service;
use Illuminate\Support\Facades\DB;

class PartService extends Service
{
    public function __construct(public PartRepository $partRepository)
    {

    }

    public function index(array $params)
    {
        return $this->resultCollections(
            $this->partRepository->index($params),
            PartPresenter::class,
            'parts',
            $this->partRepository->count($params)
        );
    }
}
