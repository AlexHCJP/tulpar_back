<?php

namespace App\Providers;

use App\Events\OfferAcceptedEvent;
use App\Events\OfferCreatedEvent;
use App\Events\OrderCreatedEvent;
use App\Listeners\OfferAcceptedListener;
use App\Listeners\OfferCreatedListener;
use App\Listeners\OrderCreatedListener;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        OrderCreatedEvent::class => [
            OrderCreatedListener::class,
        ],

        OfferCreatedEvent::class => [
            OfferCreatedListener::class,
        ],

        OfferAcceptedEvent::class => [
            OfferAcceptedListener::class,
        ],
    ];

    /**
     * Register any events for your application.
     */
    public function boot(): void
    {
        //
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}
