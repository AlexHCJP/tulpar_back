<?php

namespace App\Events;

use App\Models\OrderOffer;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class OfferAcceptedEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public OrderOffer $offer;

    public function __construct(OrderOffer $orderOffer)
    {
        $this->offer = $orderOffer->load(['store']);
    }

}
