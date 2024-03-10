<?php

namespace App\Repositories;

use App\Models\Car;
use App\Models\UserCar;

class UserCarRepository extends Repository
{
    public function index(array $params = [])
    {
        $query = UserCar::with('car');
        $query = $this->queryApplyFilter($query, $params);
        $query = $this->queryApplyOrderBy($query, $params);
        $query = $this->queryApplyPagination($query, $params);

        return $query->get();
    }

    public function count(array $params = [])
    {
        $query = UserCar::query();
        $query = $this->queryApplyFilter($query, $params);

        return $query->count();
    }

    protected function queryApplyFilter($query, array $params = [])
    {
        if (isset($params['user_id'])) {
            $query->where('user_id', $params['user_id']);
        }

        return $query;
    }
}
