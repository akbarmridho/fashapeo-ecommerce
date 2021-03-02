<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderConfirmed extends Mailable
{
    use Queueable, SerializesModels;

    public $content;
    public $transaction;

    public function __construct($content, $transaction)
    {
        $this->content = $content;
        $this->transaction = $transaction;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Your order #' . $this->content['order_number'] . ' payment has been confirmed')
            ->markdown('email.orders.confirmed', ['content' => $this->content, 'transaction' => $this->transcation]);
    }
}
