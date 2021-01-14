<?php

namespace App\Actions\Vendor;

use App\Actions\Order\CreateInvoiceDetail;
use Midtrans\Snap;
use Midtrans\Config as MidtransConfig;
use Midtrans\Notification;
use Midtarns\Transaction;

class Midtrans
{
    use CreateInvoiceDetail;

    public $notification;

    public function __construct()
    {
        MidtransConfig::$serverkey = env('MIDTRANS_SERVER_KEY');
        MidtransConfig::$isProduction = config('app.debug');
        MidtransConfig::$isSanitized = true;
        MidtransConfig::$is3ds = true;
    }
    
    public function token(Order $order)
    {
        return Snap::getSnapToken($this->invoiceDetail($order));
    }

    public function notification($request)
    {
        $this->notification = new Notification($request);
    }

    public function handle()
    {
        //
    }
}