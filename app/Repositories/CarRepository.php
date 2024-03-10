<?php

namespace App\Repositories;

use App\Models\Car;

class CarRepository extends Repository
{
    public function getPaginated(array $params = [])
    {
        $query = Car::query();
        $query = $this->applyFilter($query, $params);
        $query = $this->queryApplyOrderBy($query, $params);
        $query = $this->queryApplyPagination($query, $params);

        return $query->get();
    }

    public function count(array $params = [])
    {
        $query = Car::query();
        $query = $this->applyFilter($query, $params);

        return $query->count();
    }

    private function applyFilter($query, array $params = [])
    {
        if (isset($params['modelId'])) {
            $query->where('modelId', $params['modelId']);
        }

        if (isset($params['catalogId'])) {
            $query->where('catalogId', $params['catalogId']);
        }

        return $query;
    }
}
