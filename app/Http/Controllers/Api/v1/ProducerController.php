<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\ApiController;
use App\Http\Requests\Api\v1\Producer\IndexRequest;
use App\Services\v1\ProducerService;

class ProducerController extends ApiController
{
    public function __construct(public ProducerService $producerService)
    {
        
    }

    public function index(IndexRequest $request)
    {
        $params = $request->validated();
        return $this->result($this->producerService->index($params));
    }
}