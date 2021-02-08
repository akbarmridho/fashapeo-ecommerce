<?php

namespace App\Http\Controllers\Orders;

use App\Actions\Order\PlaceNewOrder;
use App\Services\OrderStatus;
use App\Events\OrderCreated;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CreatedOrderController extends Controller
{
    protected $status;

    public function __construct(OrderStatus $status)
    {
        $this->status = $status;
    }

    public function create(PlaceNewOrder $creator)
    {
        $customer = Auth::guard('customer')->user();

        $order = $creator->place($customer);

        $this->status->orderCreated($order);

        return redirect()->route('customer.order.shipment', $order);
    }
}
