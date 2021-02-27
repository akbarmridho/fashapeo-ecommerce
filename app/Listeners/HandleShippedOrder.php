<?php

namespace App\Listeners;

use App\Events\OrderShipped;
use App\Mail\OrderShipped as OrderShippedMail;
use App\Notifications\OrderShipped as OrderShippedNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\InteractsWithQueue;

class HandleShippedOrder
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
     * @param  OrderShipped  $event
     * @return void
     */
    public function handle(OrderShipped $event)
    {
        $event->customer->notify(new OrderShippedNotification($event->order));
        Mail::to($event->order->customer->email)->send(new OrderShippedMail($event->order->toArray()));
    }
}
