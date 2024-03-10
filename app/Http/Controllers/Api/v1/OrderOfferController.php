<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\ApiController;
use App\Http\Requests\Api\v1\OrderOffer\CreateRequest;
use App\Http\Requests\Api\v1\OrderOffer\MyOffersRequest;
use App\Models\Order;
use App\Models\OrderOffer;
use App\Services\v1\OrderOfferService;

class OrderOfferController extends ApiController
{
    public function __construct(public OrderOfferService $orderOfferService)
    {

    }

    public function index(Order $order)
    {
        return $this->result(
            $this->orderOfferService->orderOffers($order->load('offers'))
        );
    }

    public function create(CreateRequest $request)
    {
        $data = $request->validated();
        $data['store_id'] = auth('store_api')->id();

        return $this->result(
            $this->orderOfferService->create($data)
        );
    }

    public function accept(OrderOffer $orderOffer)
    {
        return $this->result(
            $this->orderOfferService->accept($orderOffer->load('order'))
        );
    }

    public function myOffers(MyOffersRequest $request)
    {
        $params = $request->validated();
        $params['store_id'] = auth('store_api')->id();

        return $this->result(
            $this->orderOfferService->myOffers($params)
        );
    }
}