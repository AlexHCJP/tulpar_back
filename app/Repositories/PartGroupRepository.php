<?php

namespace App\Repositories;

use App\Models\PartGroup;

class PartGroupRepository extends Repository
{
    public function getPaginated(array $params = [])
    {
        $query = PartGroup::with('childs');
        $query = $this->applyFilter($query, $params);
        $query = $this->queryApplyOrderBy($query, $params);
        $query = $this->queryApplyPagination($query, $params);

        return $query->get();
    }

    public function count(array $params = [])
    {
        $query = PartGroup::query();
        $query = $this->applyFilter($query, $params);

        return $query->count();
    }

    private function applyFilter($query, array $params = [])
    {
        if (isset($params['parentId'])) {
            $query->where('parentId', $params['parentId']);
        } else {
            $query->whereNull('parentId');
        }

        if (isset($params['carId'])) {
            $query->where('car_id', $params['carId']);
        }

        return $query;
    }
}
