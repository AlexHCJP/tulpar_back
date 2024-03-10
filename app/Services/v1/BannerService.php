<?php

namespace App\Services\v1;

use App\Models\Banner;
use App\Presenters\v1\BannerPresenter;
use App\Services\Service;

class BannerService extends Service
{
    public function get()
    {
        return $this->resultCollections(
            Banner::with('store')->get(),
            BannerPresenter::class,
            'list'
        );
    }
}
