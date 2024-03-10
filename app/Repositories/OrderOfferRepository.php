<?php

namespace App\Repositories;

use App\Models\OrderOffer;
use Illuminate\Database\Eloquent\Builder;

class OrderOfferRepository extends Repository
{
    public function index(array $params = [])
    {
        $query = OrderOffer::query();
        $query = $this->queryApplyFilter($query, $params);
        $query = $this->queryApplyOrderBy($query, $params);
        $query = $this->queryApplyPagination($query, $params);

        return $query->get();
    }

    public function count(array $params = [])
    {
        $query = OrderOffer::query();
        $query = $this->queryApplyFilter($query, $params);

        return $query->count();
    }

    public function queryApplyFilter(Builder $query, array $params = [])
    {
        return $query;
    }
}