<?php

namespace App\Actions\Order;

use App\Models\OrderActivity;

trait UpdateOrderActivity {
    // set as bla bla bla
    public function updateTransactionStatus(Order $order, Status $status)
    {
        $order->transaction->status_id = $status->id;
    }

    public function updateOrderStatus(Order $order, Status $status)
    {
        $order->status_id = $status->id;
        $order->save();
    }

    public function createActivity(Order $order, Status $status)
    {
        return OrderActivity::create([
            'order_id' => $order->id,
            'status_id' => $status->id,
        ]);
    }
}