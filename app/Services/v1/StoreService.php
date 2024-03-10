<?php

namespace App\Services\v1;

use App\Models\StoreCategory;
use App\Presenters\v1\StorePresenter;
use App\Repositories\StoreRepository;
use App\Services\Service;

class StoreService extends Service
{
    public function __construct(public StoreRepository $storeRepository)
    {

    }

    public function info($id)
    {
        $store = $this->storeRepository->get(['id' => $id]);
        if (is_null($store)) {
            return $this->errNotFound('Магазин не найден');
        }

        return $this->result([
            'store' => (new StorePresenter($store))->profile(),
        ]);
    }

    public function edit($id, array $data)
    {
        $store = $this->storeRepository->get(['id' => $id]);
        if (is_null($store)) {
            return $this->errNotFound('Магазин не найден');
        }

        $store = $this->storeRepository->update($store, $data);

        return $this->result([
            'message' => 'Профиль изменён',
            'store' => (new StorePresenter($store))->profile(),
        ]);
    }

    public function updateCategory(array $data)
    {
        $storeCategory = StoreCategory::firstOrCreate(['store_id' => auth('store_api')->id()]);

        if (isset($data['producers'])) {
            $data['producers'] = implode(',', $data['producers']);
        }
        if (isset($data['models'])) {
            $data['models'] = implode(',', $data['models']);
        }
        if (isset($data['parts'])) {
            $data['parts'] = implode(',', $data['parts']);
        }

        $storeCategory->fill($data);
        $storeCategory->save();

        $store = auth('store_api')->user();

        return $this->result([
            'message' => 'Изменения сохранены',
            'store' => (new StorePresenter($store->load('category')))->profile(),
        ]);
    }
}
