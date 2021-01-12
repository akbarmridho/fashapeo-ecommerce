<?php

namespace App\Actions\Calculations;

use App\Models\Order;

trait TransactionTotal {

    public function calculateTotal(Order $order)
    {
        $subtotal = [];

        foreach($order->items as $item) {
            array_push($subtotal, $item->final_price);
        }

        array_push($subtotal, $order->shipment->price);

        return (int) array_sum($subtotal);
    }

}