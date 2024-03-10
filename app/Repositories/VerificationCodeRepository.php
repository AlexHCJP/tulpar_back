<?php

namespace App\Repositories;

use App\Models\VerificationCode;

class VerificationCodeRepository extends Repository
{
    public function get(array $params = [])
    {
        $query = VerificationCode::query();
        $query = $this->queryApplyFilter($query, $params);

        return $query->first();
    }

    public function create(array $data)
    {
        return VerificationCode::create($data);
    }

    protected function queryApplyFilter($query, array $params = [])
    {
        if (isset($params['email'])) {
            $query->where('email', $params['email']);
        }

        if (isset($params['phone'])) {
            $query->where('phone', $params['phone']);
        }

        return $query;
    }
}