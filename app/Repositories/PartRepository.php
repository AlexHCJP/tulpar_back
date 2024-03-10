<?php

namespace App\Repositories;

use App\Models\Part;

class PartRepository extends Repository
{
    public function index(array $params = [])
    {
        $query = Part::query();
        $query = $this->queryApplyFilter($query, $params);
        $query = $this->queryApplyOrderBy($query, $params);
        $query = $this->queryApplyPagination($query, $params);

        return $query->get();
    }

    public function count(array $params = [])
    {
        $query = Part::query();
        $query = $this->queryApplyFilter($query, $params);

        return $query->count();
    }

    protected function queryApplyFilter($query, array $params = [])
    {
        if (isset($params['name'])) {
            $query->where('name', 'like', '%'.$params['name'].'%');
        }

        if (isset($params['group_id'])) {
            $query->where('group_id', $params['group_id']);
        }

        return $query;
    }
}
