<?php

namespace App\Listeners;

use App\Models\Admin;
use App\Events\OrderCompleted as OrderCompletedEvent;
use App\Notifications\OrderCompleted;
use App\Notifications\Admin\OrderCompleted as AdminOrderCompleted;
use Illuminate\Support\Facades\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class HandleCompletedOrder
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
     * @param  OrderCompleted  $event
     * @return void
     */
    public function handle(OrderCompletedEvent $event)
    {
        $event->customer->notify(new OrderCompleted($event->order));
        Notification::send(Admin::all(), new AdminOrderCompleted($event->order));
    }
}
