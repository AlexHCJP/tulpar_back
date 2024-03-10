<?php

namespace App\Repositories;

use App\Models\CarModel;

class CarModelRepository extends Repository
{
    public function index(array $params = [])
    {
        $query = CarModel::query();
        $query = $this->queryApplyFilter($query, $params);
        $query = $this->queryApplyOrderBy($query, $params);
        $query = $this->queryApplyPagination($query, $params);

        return $query->get();
    }

    public function count(array $params = [])
    {
        $query = CarModel::query();
        $query = $this->queryApplyFilter($query, $params);

        return $query->count();
    }

    protected function queryApplyFilter($query, array $params = [])
    {
        if (isset($params['filter'])) {
            $query->where('name', 'like', '%'.$params['filter'].'%');
        }

        if (isset($params['producer_id'])) {
            $query->where('producer_id', $params['producer_id']);
        }

        return $query;
    }
}