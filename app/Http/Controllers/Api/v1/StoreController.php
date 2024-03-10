<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\ApiController;
use App\Http\Requests\Api\v1\Store\EditRequest;
use App\Http\Requests\Api\v1\Store\UpdateCategoryRequest;
use App\Services\v1\StoreService;

class StoreController extends ApiController
{
    public function __construct(public StoreService $storeService)
    {

    }

    public function info($id)
    {
        return $this->result($this->storeService->info($id));
    }

    public function edit($id, EditRequest $request)
    {
        return $this->result($this->storeService->edit($id, $request->validated()));
    }

    public function updateCategory(UpdateCategoryRequest $request)
    {
        return $this->result($this->storeService->updateCategory($request->validated()));
    }
}
