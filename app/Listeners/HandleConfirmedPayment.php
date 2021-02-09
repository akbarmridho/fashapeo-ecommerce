<?php

namespace App\Listeners;

use App\Models\Admin;
use App\Events\PaymentConfirmed as PaymentConfirmedEvent;
use App\Notifications\PaymentConfirmed;
use App\Notifications\Admin\PaymentConfirmed as AdminPaymentConfirmed;
use Illuminate\Support\Facades\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class HandleConfirmedPayment
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  PaymentConfirmedEvent  $event
     * @return void
     */
    public function handle(PaymentConfirmedEvent $event)
    {
        $event->customer->notify(new PaymentConfirmed($event->order));
        Notification::send(Admin::all(), new AdminPaymentConfirmed($event->order));
    }
}
