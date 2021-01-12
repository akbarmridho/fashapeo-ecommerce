<?php

namespace App\Actions\Order;

use App\Models\Transaction;
use App\Models\Order;
use App\Calculations\TransactionTotal;

class CreateTransaction {

    use TransactionTotal;

    public function createTransaction(Order $order)
    {
        $total = $this->calculateTotal($order);

        return Transaction::create([
            'order_id' => $order->id,
            'total' => $total,
        ]);
    }
}