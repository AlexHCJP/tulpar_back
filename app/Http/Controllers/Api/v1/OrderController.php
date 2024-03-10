<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\ApiController;
use App\Http\Requests\Api\v1\Order\CreateRequest;
use App\Http\Requests\Api\v1\Order\IndexMyRequest;
use App\Http\Requests\Api\v1\Order\IndexRequest;
use App\Http\Requests\Api\v1\Order\RateOrderRequest;
use App\Models\Order;
use App\Services\v1\OrderService;

class OrderController extends ApiController
{
    public function __construct(
        public OrderService $orderService
    )
    {
    }

    public function create(CreateRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = auth('api')->id();
        $data['status'] = 'active';

        return $this->result($this->orderService->create($data));
    }

    public function indexMy(IndexMyRequest $request)
    {
        $params = $request->validated();
        $params['user_id'] = auth('api')->id();


        return $this->result($this->orderService->indexMy($params));
    }

    public function index(IndexRequest $request)
    {
        $params = $request->validated();
        $params['status'] = 'active';

        return $this->result($this->orderService->index($params));
    }

    public function show(Order $order)
    {
        return $this->result(
                $this->orderService->show($order->load('car', 'part', 'store', 'city'))
            );
    }

    public function rate(Order $order, RateOrderRequest $request)
    {
        return $this->result(
            $this->orderService->rate($order, $request->validated())
        );
    }
}
