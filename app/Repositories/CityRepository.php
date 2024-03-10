<?php

namespace App\Repositories;

use App\Models\City;

class CityRepository extends Repository
{
    public function get(array $params = [])
    {
        $query = City::query();
        $query = $this->queryApplyFilter($query, $params);
        $query = $this->queryApplyOrderBy($query, $params);
        $query = $this->queryApplyPagination($query, $params);

        return $query->get();
    }

    public function count(array $params = [])
    {
        $query = City::query();
        $query = $this->queryApplyFilter($query, $params);

        return $query->count();
    }

    protected function queryApplyFilter($query, array $params = [])
    {
        if (isset($params['filter'])) {
            $query->where('name', 'like', '%' . $params['filter'] . '%');
        }

        return $query;
    }
}
