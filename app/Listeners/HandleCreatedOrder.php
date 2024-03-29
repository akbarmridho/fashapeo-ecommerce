<?php

namespace App\Listeners;

use App\Events\OrderCreated as OrderCreatedEvent;
use App\Mail\OrderConfirmed as OrderCreatedMail;
use App\Notifications\OrderCreated;
use App\Notifications\Admin\OrderCreated as AdminOrderCreated;
use App\Models\Admin;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Mail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class HandleCreatedOrder
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
     * @param  OrderCreatedEvent $event
     * @return void
     */
    public function handle(OrderCreatedEvent $event)
    {
        $event->customer->notify(new OrderCreated($event->order));
        Notification::send(Admin::all(), new AdminOrderCreated($event->order));
        Mail::to($event->order->customer->email)->send(new OrderCreatedMail($event->order->toArray()));
    }
}
