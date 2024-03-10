<?php

namespace App\Listeners;

use App\Models\User;
use App\Services\v1\PushNotificationService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class OfferCreatedListener
{
    public function __construct()
    {
        //
    }

    public function handle(object $event): void
    {
        $user = User::find($event->offer->order->user_id);

        if (!is_null($user) && !is_null($user->firebase_token)) {
            (new PushNotificationService())->sendNotification(
                $user->firebase_token,
                'Новый отклик',
                'Кто-то откликнулся на ваш заказ',
                [
                    'order_id' => $event->offer->order->id,
                ]
            );
        }
    }
}
