<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\ApiController;
use App\Http\Requests\Api\v1\CarModel\IndexRequest;
use App\Services\v1\CarModelService;

class CarModelController extends ApiController
{
    public function __construct(public CarModelService $carModelService)
    {
        
    }

    public function index(IndexRequest $request)
    {
        return $this->result(
            $this->carModelService->index($request->validated())
        );
    }
}