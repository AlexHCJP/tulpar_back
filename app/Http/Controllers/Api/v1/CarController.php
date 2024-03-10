<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\ApiController;
use App\Http\Requests\Api\v1\Car\AddRequest;
use App\Http\Requests\Api\v1\Car\IndexRequest;
use App\Http\Requests\Api\v1\Car\GetCarByVinRequest;
use App\Http\Requests\Api\v1\Car\IndexMyRequest;
use App\Services\v1\CarService;

class CarController extends ApiController
{
    public function __construct(
        public CarService $carService
    ) {}

    public function getPaginated(IndexRequest $request)
    {
        return $this->result($this->carService->getPaginated($request->validated()));
    }

    public function my(IndexMyRequest $request)
    {
        $params = $request->validated();
        $params['user_id'] = auth('api')->id();

        return $this->result($this->carService->index($params));
    }

    public function add(AddRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = auth('api')->id();

        return $this->result($this->carService->create($data));
    }

    public function getCarByVin(GetCarByVinRequest $request)
    {
        return $this->result($this->carService->getCarByVin($request->validated()));
    }
}
