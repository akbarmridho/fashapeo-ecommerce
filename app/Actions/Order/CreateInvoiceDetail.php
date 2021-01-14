<?php

namespace App\Actions\Order;

use App\Models\Order;

trait CreateInvoiceDetail
{
    public function invoiceDetail(Order $order): array
    {
        return [
            'transaction_details' => [],
            'customer_details' => [],
            'item_details' => [],
        ];
    }
}