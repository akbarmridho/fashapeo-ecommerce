<?php

namespace App\Listeners;

use App\Events\OrderShipped;
use App\notifications\OrderShipped as OrderShippedNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
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
    }
}
