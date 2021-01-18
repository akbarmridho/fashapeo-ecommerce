<?php

namespace App\Http\Controllers\Orders;

use App\Http\Controllers\Controller;
use App\Models\Order;

class CreatedOrderStatus extends Controller
{
    public function success(Order $order)
    {
        //
    }

    public function failed(Order $order)
    {
        //
    }

    public function pending(Order $order)
    {
        //
    }
}