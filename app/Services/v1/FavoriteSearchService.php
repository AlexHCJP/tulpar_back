<?php

namespace App\Services\v1;

use App\Models\FavoriteSearch;
use App\Presenters\v1\FavoriteSearchPresenter;
use App\Repositories\FavoriteSearchRepository;
use App\Services\Service;

class FavoriteSearchService extends Service
{
    public function __construct(public FavoriteSearchRepository $repository)
    {

    }

    public function create(array $data): array
    {
        $data['store_id'] = auth('store_api')->id();
        $data['model_id'] = $data['model_id'] ?? null;
        $data['part_id'] = $data['part_id'] ?? null;

        $favoriteSearch = FavoriteSearch::create($data);

        return $this->result([
            'message' => 'Запись добавлена',
            'favorite_search' => (new FavoriteSearchPresenter($favoriteSearch->load('producer', 'carModel', 'part')))->list(),
        ]);
    }

    public function index(array $params = []): array
    {
        $params['store_id'] = auth('store_api')->id();

        $repository = new FavoriteSearchRepository();
        
        return $this->resultCollections(
            $repository->index($params),
            FavoriteSearchPresenter::class,
            'list',
            $repository->count()
        );
    }

    public function update(FavoriteSearch $favoriteSearch, array $data): array
    {
        $data['model_id'] = $data['model_id'] ?? null;
        $data['part_id'] = $data['part_id'] ?? null;

        $favoriteSearch->update($data);

        return $this->result([
            'message' => 'Запись обновлена',
            'favorite_search' => (new FavoriteSearchPresenter($favoriteSearch->load('producer', 'carModel', 'part')))->list(),
        ]);
    }

    public function delete(FavoriteSearch $favoriteSearch)
    {
        $favoriteSearch->delete();

        return $this->ok('Запись удалена');
    }
}