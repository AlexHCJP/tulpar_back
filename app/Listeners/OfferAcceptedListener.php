<?php

namespace App\Listeners;

use App\Services\v1\PushNotificationService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class OfferAcceptedListener
{
    public function __construct()
    {
        //
    }

    public function handle(object $event): void
    {
        if (!is_null($event->offer->store->firebase_token)) {
            (new PushNotificationService())->sendNotification(
                $event->offer->store->firebase_token,
                'Заказ №'. $event->offer->order_id,
                'Ваше предложение принято',
                [
                    'order_id' => $event->offer->order_id,
                ]
            );
        }
    }
}
