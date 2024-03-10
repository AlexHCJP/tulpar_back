<?php

namespace App\Repositories;

use App\Models\Store;

class StoreRepository extends Repository
{
    public function get(array $params = []):? Store
    {
        $query = Store::query();
        $query = $this->queryApplyFilter($query, $params);

        return $query->first();
    }

    public function update(Store $store, array $data)
    {
        $store->fill($data);
        $store->save();

        return $store;
    }

    protected function queryApplyFilter($query, $params = [])
    {
        if (isset($params['phone'])) {
            $query->where('phone', $params['phone']);
        }

        return $query;
    }
}
