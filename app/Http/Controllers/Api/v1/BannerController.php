<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\ApiController;
use App\Services\v1\BannerService;

class BannerController extends ApiController
{
    public function get()
    {
        return $this->result((new BannerService())->get());
    }
}
