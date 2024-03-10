<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\ApiController;
use App\Http\Requests\Api\v1\PartGroup\IndexRequest;
use App\Services\v1\PartGroupService;
use Illuminate\Http\Request;

class PartGroupController extends ApiController
{
    public function __construct(public PartGroupService $service)
    {}

    public function getPaginated(IndexRequest $request)
    {
        return $this->result(
            $this->service->getPaginated($request->validated())
        );
    }
}
