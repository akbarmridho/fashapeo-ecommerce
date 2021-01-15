<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use App\Events\OrderCancelled;
use App\Events\OrderCreated;
use App\Events\PaymentConfirmed;
use App\Events\PaymentExpired;
use App\Events\TransactionDenied;
use App\Listeners\OrderCancelledNotification;
use App\Listeners\OrderCreatedNotification;
use App\Listeners\PaymentConfirmedNotification;
use App\Listeners\PaymentExpiredNotification;
use App\Listeners\TransactionDeniedNotification;
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
            OrderCreatedNotification::class,
        ],
        OrderCancelled::class => [
            OrderCreatedNotification::class,
        ],
        PaymentConfirmed::class => [
            PaymentConfirmedNotification::class,
        ],
        PaymentExpired::class => [
            PaymentExpiredNotification::class,
        ],
        TransactionDenied::class => [
            TransactionDeniedNotification::class,
        ]
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
