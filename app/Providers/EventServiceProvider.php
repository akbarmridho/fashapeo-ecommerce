<?php

namespace App\Providers;

use App\Events\OrderCancelled;
use App\Events\OrderCompleted;
use App\Events\OrderCreated;
use App\Events\OrderShipped;
use App\Events\PaymentConfirmed;
use App\Events\PaymentExpired;
use App\Events\TransactionDenied;
use App\Listeners\HandleOrderCancelled;
use App\Listeners\HandleCompletedOrder;
use App\Listeners\HandleCreatedOrder;
use App\Listeners\HandleShippedOrder;
use App\Listeners\HandleConfirmedPayment;
use App\Listeners\HandleExpiredPayment;
use App\Listeners\HandleDeniedPayment;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        OrderCreated::class => [
            HandleCreatedOrder::class,
        ],
        OrderCancelled::class => [
            HandleOrderCancelled::class,
        ],
        OrderCompleted::class => [
            HandleCompletedOrder::class,
        ],
        OrderShipped::class => [
            HandleShippedOrder::class,
        ],
        PaymentConfirmed::class => [
            HandleConfirmedPayment::class,
        ],
        PaymentExpired::class => [
            HandleExpiredPayment::class,
        ],
        TransactionDenied::class => [
            HandleDeniedPayment::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
