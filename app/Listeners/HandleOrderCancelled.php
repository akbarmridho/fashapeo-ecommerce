<?php

namespace App\Listeners;

use App\Models\Admin;
use App\Notifications\OrderCancelled;
use App\Notifications\Admin\OrderCancelled as AdminOrderCancelled;
use App\Events\OrderCancelled as OrderCancelledEvent;
use Illuminate\Support\Facades\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class HandleOrderCancelled
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
     * @param  OrderCancelledEvent  $event
     * @return void
     */
    public function handle(OrderCancelledEvent $event)
    {
        $event->customer->notify(new OrderCancelled($event->order));
        Notification::send(Admin::all(), new AdminOrderCancelled($event->order));
    }
}
