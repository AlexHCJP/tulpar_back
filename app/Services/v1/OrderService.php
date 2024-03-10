<?php

namespace App\Services\v1;

use App\Events\OrderCreatedEvent;
use App\Models\Order;
use App\Models\Rating;
use App\Models\StoreCategory;
use App\Presenters\v1\OrderPresenter;
use App\Repositories\OrderRepository;
use App\Services\Service;
use Illuminate\Support\Facades\Storage;

class OrderService extends Service
{
    public function __construct(public OrderRepository $orderRepository)
    {
    }

    public function create(array $data): array
    {
        $order = Order::create($data);

        if (isset($data['photos'])) {
            foreach($data['photos'] as $file) {
                $path = $file->store('public/order/');
                $order->media()->create([
                    'storage_link' => Storage::url($path),
                ]);
            }
        }

        event(new OrderCreatedEvent($order));

        return $this->ok('Заявка создана');
    }

    public function indexMy(array $params = []): array
    {
        $orders = $this->orderRepository->index($params);
        $count = $this->orderRepository->count($params);

        return $this->resultCollections($orders, OrderPresenter::class, 'listMy', $count);
    }

    public function index(array $params = [])
    {
        $storeCatgory = StoreCategory::where('store_id', auth('store_api')->id())->first();
        if (!is_null($storeCatgory)) {
            $params['producers'] = explode(',', $storeCatgory->producers);
            $params['models'] = explode(',', $storeCatgory->models);
            $params['parts'] = explode(',', $storeCatgory->parts);
        }
        return $this->resultCollections(
            $this->orderRepository->index($params),
            OrderPresenter::class,
            'listMy',
            $this->orderRepository->count($params),
        );
    }

    public function show(Order $order): array
    {
        return $this->result([
            'order' => (new OrderPresenter($order))->listMy(),
        ]);
    }

    public function rate(Order $order, array $data)
    {
        if ($order->status != 'done') {
            return $this->errNotAcceptable('Заказ должен иметь исполнителя');
        }
        if ($order->user_id != auth('api')->id()) {
            return $this->errFobidden('Это не ваш заказ');
        }

        $data['order_id'] = $order->id;
        $data['user_id'] = auth('api')->id();
        $data['store_id'] = $order->store_id;

        Rating::create($data);

        return $this->ok('Спасибо за ваш отзыв');
    }
}
