<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository extends Repository
{
    public function index(array $params = [])
    {
        $query = User::query();
        $query = $this->queryApplyFilter($query, $params);
        $query = $this->queryApplyOrderBy($query, $params);
        $query = $this->queryApplyPagination($query, $params);

        return $query->get();
    }

    public function get(array $params = []) : ?User
    {
        $query = User::query();
        $query = $this->queryApplyFilter($query, $params);
        return $query->first();
    }

    public function create(array $data)
    {
        return User::create($data);
    }

    protected function queryApplyFilter($query, array $params = [])
    {
        if (isset($params['id'])) {
            $query->where('id', $params['id']);
        }

        if (isset($params['filter'])) {
            $query->where('name', 'like', '%' . $params['filter'] . '%')
                ->orWhere('email', 'like', '%' . $params['filter'] . '%');
        }

        if (isset($params['email'])) {
            $query->where('email', $params['email']);
        }

        if (isset($params['name'])) {
            $query->where('name', $params['name']);
        }

        if (isset($params['phone'])) {
            $query->where('phone', $params['phone']);
        }

        return $query;
    }
}
