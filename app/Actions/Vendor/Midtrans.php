<?php

namespace App\Actions\Vendor;

use App\Transformers\CreateInvoiceDetail as Invoice;
use Midtrans\Snap;
use Midtrans\Config as MidtransConfig;
use Midtrans\Notification;
use Midtrans\Transaction;

class Midtrans
{
    use CreateInvoiceDetail;

    public $notification;
    public $transaction;

    public function __construct()
    {
        MidtransConfig::$serverkey = env('MIDTRANS_SERVER_KEY');
        MidtransConfig::$isProduction = config('app.debug');
        MidtransConfig::$isSanitized = true;
        MidtransConfig::$is3ds = true;
    }
    
    public function token(Order $order)
    {
        $transaction = $order->transaction;

        if(! $transaction->token) {

            $newToken = Snap::getSnapToken(Invoice::create($order));
            $transaction->token = $newToken;
            $transaction->save();

            return $newToken;
        }

        return $transaction->token;
    }

    public function notification($request)
    {
        $this->notification = new Notification($request);
    }

    public function approve($orderId)
    {
        return Transaction::approve($orderId);
    }

    public function cancel($orderId)
    {
        return Transaction::cancel($orderId);
    }
}