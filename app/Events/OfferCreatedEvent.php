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

class OfferCreatedEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $offer;

    public function __construct(OrderOffer $offer)
    {
        $this->offer = $offer->load('order');
    }

}
