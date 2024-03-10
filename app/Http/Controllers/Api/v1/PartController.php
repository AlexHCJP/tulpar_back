<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\ApiController;
use App\Http\Requests\Api\v1\Part\IndexRequest as PartIndexRequest;
use App\Http\Requests\Api\v1\Producer\IndexRequest;
use App\Services\v1\PartService;

class PartController extends ApiController
{
    public function __construct(public PartService $partService)
    {

    }

    public function index(PartIndexRequest $request)
    {
        return $this->result(
            $this->partService->index($request->validated())
        );
    }
}
