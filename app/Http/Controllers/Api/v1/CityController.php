<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\ApiController;
use App\Http\Requests\CityIndexRequest;
use App\Services\v1\CityService;
use Illuminate\Http\Request;

class CityController extends ApiController
{
    public function __construct(public CityService $cityService)
    {

    }

    public function get(CityIndexRequest $request)
    {
        return $this->result(
            $this->cityService->get($request->validated())
        );
    }
}
