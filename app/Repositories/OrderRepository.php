<?php

namespace App\Repositories;

use App\Models\Order;
use Illuminate\Database\Eloquent\Builder;

class OrderRepository
{
    public function index(array $params = [])
    {
        $query = Order::with('car', 'part', 'store', 'city');
        $query = $this->queryApplyFilter($query, $params);
        $query = $this->queryApplyOrderBy($query, $params);
        $query = $this->queryApplyPagination($query, $params);

        return $query->get();
    }

    public function count(array $params = [])
    {
        $query = Order::query();
        $query = $this->queryApplyFilter($query, $params);

        return $query->count();
    }

    protected function queryApplyFilter(Builder $query, array $params = [])
    {
        if (isset($params['id'])) {
            $query->where('id', $params['id']);
        }

        if (isset($params['user_id'])) {
            $query->where('user_id', $params['user_id']);
        }

        if (isset($params['status'])) {
            $query->where('status', $params['status']);
        }

        if (isset($params['producers']) && !empty($params['producers'])) {
            $query->whereHas('car', function (Builder $query) use ($params) {
                $query->whereIn('producer_id', $params['producers']);
            });
        }

        if (isset($params['models']) && !empty($params['models'])) {
            $query->whereHas('car', function (Builder $query) use ($params) {
                $query->whereIn('model_id', $params['models']);
            });
        }

        if (isset($params['parts']) && !empty($params['parts']))  {
            $query->whereIn('part_id', $params['parts']);
        }

        if (isset($params['part_id'])) {
            $query->where('part_id', $params['part_id']);
        }

        if (isset($params['producer_id'])) {
            $query->whereRelation('car', 'producer_id', $params['producer_id']);
        }

        if (isset($params['model_id'])) {
            $query->whereRelation('car', 'model_id', $params['model_id']);
        }

        if (isset($params['vin'])) {
            $query->whereRelation('car', 'vin', 'like', '%' . $params['vin'] . '%');
        }

        if (isset($params['lat']) && isset($params['lon']) && isset($params['radius'])) {
            $query->withinRadius($params['lat'], $params['lon'], $params['radius']);
        }

        return $query;
    }

    protected function queryApplyOrderBy($query, $params)
    {
        $desc = 'asc';
        if (isset($params['descending']) && $params['descending'] == 'true') {
            $desc = 'desc';
        }

        if (isset($params['sortBy'])) {
            $query->orderBy($params['sortBy'], $desc);
        }
        return $query;
    }

    protected function queryApplyPagination($query, $params)
    {
        if (isset($params['startRow'])) {
            $query->offset($params['startRow']);
        }
        if (isset($params['rowsPerPage'])) {
            $query->limit($params['rowsPerPage']);
        } else {
            $query->limit(100);
        }
        return $query;
    }
}
