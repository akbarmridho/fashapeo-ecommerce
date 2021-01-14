<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Status;

class StatusSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['name' => 'Order Created',
             'type' => 'order',
             'code' => 101,
             'description' => 'Order has been created'],
             ['name' => 'Waiting for Confirmation',
             'type' => 'order',
             'code' => 102,
             'description' => 'Your payment has been confirmed. We will process your order immediately'],
             ['name' => 'Processing Order',
             'type' => 'order',
             'code' => 103,
             'description' => 'We are processing your order'],
             ['name' => 'Order Completed',
             'type' => 'order',
             'code' => 104,
             'description' => 'Order marked as completed'],
             ['name' => 'Order Cancelled by Customer',
             'type' => 'order',
             'code' => 201,
             'description' => 'Order has been cancelled by customer'],
             ['name' => 'Order Cancelled',
             'type' => 'order',
             'code' => 202,
             'description' => 'Order has been cancelled by seller or by the system'],
             ['name' => 'Shipment Details Created',
             'type' => 'shipment',
             'code' => 301,
             'description' => 'Order destination and shipment price has been chosen'],
             ['name' => 'Order Shipped',
             'type' => 'shipment',
             'code' => 302,
             'description' => 'Shipment confirmed. Check provided tracking number'],
             ['name' => 'Order Arrived',
             'type' => 'shipment',
             'code' => 303,
             'description' => 'Order has been received by customer'],
             ['name' => 'Transaction Created',
             'type' => 'transaction',
             'code' => 501,
             'description' => 'Transaction payment method and invoice has been created'],
             ['name' => 'Transaction Pending',
             'type' => 'transaction',
             'code' => 502,
             'description' => 'Invoice has been created. Waiting for payment completion'],
             ['name' => 'Transaction Success',
             'type' => 'transaction',
             'code' => 503,
             'description' => 'Payment has been confirmed'],
             ['name' => 'Payment Expired',
             'type' => 'transaction',
             'code' => 504,
             'description' => 'Payment expired. Order will be cancelled automatically'],
             ['name' => 'Transaction Denied',
             'type' => 'transaction',
             'code' => 601,
             'description' => 'Payment has been denied because our system detected fraud indication'],
             ['name' => 'Transaction Failed',
             'type' => 'transaction',
             'code' => 602,
             'description' => 'Unexpected error during transaction. Please check your payment provider'],
        ];
        
        Status::insert($data);
    }
}
