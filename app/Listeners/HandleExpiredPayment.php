<?php

namespace App\Listeners;

use App\Events\PaymentExpired;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class HandleExpiredPayment
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
     * @param  PaymentExpired  $event
     * @return void
     */
    public function handle(PaymentExpired $event)
    {
        //
    }
}
