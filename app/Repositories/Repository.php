<?php

namespace App\Repositories;

abstract class Repository
{
    protected function queryApplyOrderBy($query, array $params = [])
    {
        $desc = 'asc';
        if (isset($params['descending']) && $params['descending']) {
            $desc = 'desc';
        }

        if (isset($params['sortBy'])) {
            $query->orderBy($params['sortBy'], $desc);
        }
        return $query;
    }

    protected function queryApplyPagination($query, array $params = [])
    {
        if (isset($params['startRow'])) {
            $query->offset($params['startRow']);
        }
        if (isset($params['rowsPerPage'])) {
            $query->limit($params['rowsPerPage']);
        } else {
            $query->limit(100);
        }
        return $query;
    }
}
