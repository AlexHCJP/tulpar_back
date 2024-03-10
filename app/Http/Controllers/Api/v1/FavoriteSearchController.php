<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\ApiController;
use App\Http\Requests\Api\v1\FavoriteSearch\CreateRequest;
use App\Http\Requests\Api\v1\FavoriteSearch\IndexRequest;
use App\Models\FavoriteSearch;
use App\Services\v1\FavoriteSearchService;
use Illuminate\Auth\Access\AuthorizationException;

class FavoriteSearchController extends ApiController
{
    public function __construct(public FavoriteSearchService $service)
    {

    }

    public function create(CreateRequest $request)
    {
        return $this->result(
            $this->service->create($request->validated()),
        );
    }

    public function index(IndexRequest $request)
    {
        return $this->result(
            $this->service->index($request->validated())
        );
    }

    public function update(FavoriteSearch $favoriteSearch, CreateRequest $request)
    {
        if ($favoriteSearch->store_id != auth('store_api')->id()) {
            throw new AuthorizationException('Вы не можете редактировать чужую запись');
        }

        return $this->result(
            $this->service->update($favoriteSearch, $request->validated())
        );
    }

    public function delete(FavoriteSearch $favoriteSearch)
    {
        if ($favoriteSearch->store_id != auth('store_api')->id()) {
            throw new AuthorizationException('Вы не можете удалить чужую запись');
        }
        return $this->result(
            $this->service->delete($favoriteSearch)
        );
    }
}