<?php

namespace App\Actions\Order;

use App\Models\OrderActivity;
use App\Models\Order;
use App\Models\Status;

class UpdateStatus {
    
    public function update(Order $order, Status $status)
    {
        $this->createActivity($order, $status);
        
        // if($status->type === 'order') {
        //     $this->updateOrderStatus($order, $status);
        // } else if ($status->type === 'transaction') {
        //     $this->updateTransactionStatus($order, $status);
        // }
    }

    // public function updateTransactionStatus(Order $order, Status $status)
    // {
    //     $transaction = $order->transaction;
    //     $transaction->status_id = $status->id;
    //     $transaction->save();
    // }

    // public function updateOrderStatus(Order $order, Status $status)
    // {
    //     $order->status_id = $status->id;
    //     $order->save();
    // }

    public function createActivity(Order $order, Status $status)
    {
        return OrderActivity::create([
            'order_id' => $order->id,
            'status_id' => $status->id,
        ]);
    }
}