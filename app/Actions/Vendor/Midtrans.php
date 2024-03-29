<?php

namespace App\Actions\Vendor;

use App\Models\Order;
use App\Transformers\CreateInvoiceDetail as Invoice;
use Midtrans\Config;
use Midtrans\Notification;
use Midtrans\Snap;
use Midtrans\Transaction;

class Midtrans
{
    public $notification;
    public $transaction;
    public $transaction_status;
    public $fraud_status;

    public function __construct()
    {
        Config::$serverKey = config('vendor.midtrans_server');
        Config::$isProduction = !config('app.debug');
        Config::$isSanitized = true;
        Config::$is3ds = true;
    }

    public function notification()
    {
        $this->notification = new Notification();
        $this->transaction_status = $this->notification->transaction_status;
        $this->fraud_status = $this->notification->fraud_status;
    }

    public function token(Order $order)
    {
        return Snap::getSnapToken(Invoice::create($order));
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
