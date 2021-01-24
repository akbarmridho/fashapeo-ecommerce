<?php

namespace App\Actions\Order;

use App\Models\OrderActivity;
use App\Models\Order;
use App\Models\Status;

class UpdateStatus {
    
    public function update(Order $order, Status $status)
    {
        $this->createActivity($order, $status);
    }

    public function createActivity(Order $order, Status $status)
    {
        return OrderActivity::create([
            'order_id' => $order->id,
            'status_id' => $status->id,
        ]);
    }
}