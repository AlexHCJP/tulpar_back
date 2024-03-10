<?php

namespace App\Services\v1;

use App\Events\OfferAcceptedEvent;
use App\Events\OfferCreatedEvent;
use App\Models\Order;
use App\Models\OrderOffer;
use App\Models\Store;
use App\Presenters\v1\OrderOfferPresenter;
use App\Presenters\v1\StorePresenter;
use App\Repositories\OrderOfferRepository;
use App\Services\Service;

class OrderOfferService extends Service
{
    public function __construct(public OrderOfferRepository $orderOfferRepository)
    {

    }

    public function orderOffers(Order $order)
    {
        return $this->resultCollections(
            $order->offers->load('store'),
            OrderOfferPresenter::class,
            'orderOffers',
        );
    }

    public function create(array $data)
    {
        $orderOffer = OrderOffer::create($data);

        event(new OfferCreatedEvent($orderOffer));

        return $this->result([
            'success' => true,
            'message' => 'Предложение отправленно',
            'orderOffer' => (new OrderOfferPresenter($orderOffer))->orderOffers(),
        ]);
    }

    public function myOffers(array $params = [])
    {
        return $this->resultCollections(
            $this->orderOfferRepository->index($params),
            OrderOfferPresenter::class,
            'listMy',
            $this->orderOfferRepository->count(),
        );
    }

    public function accept(OrderOffer $orderOffer)
    {
        if (auth('api')->id() != $orderOffer->order->user_id) {
            return $this->errFobidden('Нет доступа');
        }

        if ($orderOffer->order->store_id != null) {
            return $this->errFobidden('Вы уже приняли предложение для этого заказа');
        }

        $orderOffer->order->update([
            'store_id' => $orderOffer->store_id,
            'status' => 'done',
        ]);

        event(new OfferAcceptedEvent($orderOffer));

        return $this->result([
            'message' => 'Предложение принято',
            'store' => (new StorePresenter(Store::find($orderOffer->store_id)))->profile(),
        ]);
    }
}
