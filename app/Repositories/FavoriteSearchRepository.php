<?php

namespace App\Repositories;

use App\Models\FavoriteSearch;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class FavoriteSearchRepository extends Repository
{
    public function index(array $params = []): Collection
    {
        $query = FavoriteSearch::with('producer', 'carModel', 'part');
        $query = $this->queryApplyFilter($query, $params);
        $query = $this->queryApplyOrderBy($query, $params);
        $query = $this->queryApplyPagination($query, $params);

        return $query->get();
    }

    public function count(array $params = []): int
    {
        $query = FavoriteSearch::query();
        $query = $this->queryApplyFilter($query, $params);

        return $query->count();
    }

    public function getStoresBySearchs(array $data): array
    {
        return array_unique(
            FavoriteSearch::where('producer_id', $data['producer_id'])
            ->where(function ($query) use ($data) {
                $query->where('model_id', $data['model_id'])
                    ->orWhereNull('model_id');

                $query->where('part_id', $data['part_id'])
                    ->orWhereNull('part_id');
            })
            ->pluck('store_id')
            ->toArray()
        );
    }

    protected function queryApplyFilter(Builder $query, array $params = []) : Builder
    {
        if (isset($params['store_id'])) {
            $query->where('store_id', $params['store_id']);
        }

        return $query;
    }
}