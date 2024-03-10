<?php

namespace App\Repositories;

use App\Models\Cart;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class CartRepository extends Repository
{
    public function getPaginated(array $params = []): Collection
    {
        $query = Cart::with('part');
        $query = $this->queryApplyFilter($query, $params);
        $query = $this->queryApplyOrderBy($query, $params);
        $query = $this->queryApplyPagination($query, $params);

        return $query->get();
    }

    public function count(array $params = []): int
    {
        $query = Cart::query();
        $query = $this->queryApplyFilter($query, $params);

        return $query->count();
    }

    private function queryApplyFilter(Builder $query, array $params = []): Builder
    {
        if (isset($params['user_id'])) {
            $query->where('user_id', $params['user_id']);
        }

        return $query;
    }
}
