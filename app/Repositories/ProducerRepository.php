<?php

namespace App\Repositories;

use App\Models\Producer;

class ProducerRepository extends Repository
{
    public function index(array $params = [])
    {
        $query = Producer::query();
        $query = $this->queryApplyFilter($query, $params);
        $query = $this->queryApplyOrderBy($query, $params);
        $query = $this->queryApplyPagination($query, $params);

        return $query->get();
    }

    public function count(array $params = [])
    {
        $query = Producer::query();
        $query = $this->queryApplyFilter($query, $params);

        return $query->count();
    }

    protected function queryApplyFilter($query, array $params = [])
    {
        if (isset($params['filter'])) {
            return $query->where('name', 'like', '%'.$params['filter'].'%');
        }

        if (isset($params['is_popular'])) {
            return $query->where('is_popular', $params['is_popular']);
        }

        return $query;
    }
}
