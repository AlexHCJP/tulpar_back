<?php

namespace App\Listeners;

use App\Models\Store;
use App\Models\StoreCategory;
use App\Repositories\FavoriteSearchRepository;
use App\Services\v1\PushNotificationService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class OrderCreatedListener
{
    public function __construct()
    {
        //
    }

    public function handle(object $event): void
    {
        $storeIds = StoreCategory::where('producers', 'like', '%'.$event->order->car->catalogId.'%')
            ->orWhere('models', 'like', '%'.$event->order->car->modelId.'%')
            ->orWhere('parts', 'like', '%'.$event->order->part_id.'%')
            ->pluck('store_id');

        $tokens = Store::whereIn('id', $storeIds)->whereNotNull('firebase_token')->pluck('firebase_token')->toArray();

        (new PushNotificationService())->sendNotification($tokens, 'Новый заказ', 'Кто-то разместил новый заказ', ['order_id' => $event->order->id]);
    }
}
