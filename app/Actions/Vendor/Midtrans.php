<?php

namespace App\Actions\Vendor;

use App\Models\Order;
use App\Transformers\CreateInvoiceDetail as Invoice;
use Midtrans\Config as MidtransConfig;
use Midtrans\Notification;
use Midtrans\Snap;
use Midtrans\Transaction;

class Midtrans
{
    public $notification;
    public $transaction;

    public function __construct()
    {
        MidtransConfig::$serverKey = config('vendor.midtrans_server');
        MidtransConfig::$isProduction = config('app.debug');
        MidtransConfig::$isSanitized = true;
        MidtransConfig::$is3ds = true;
    }

    public function token(Order $order)
    {
        return Snap::getSnapToken(Invoice::create($order));
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
