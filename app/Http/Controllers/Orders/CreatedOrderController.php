<?php

namespace App\Http\Controllers\Orders;

use App\Actions\Order\PlaceNewOrder;
use App\Services\OrderStatus;
use App\Services\OrderShipment;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CreatedOrderController extends Controller
{
    protected $status;
    protected $shipment;

    public function __construct(OrderStatus $status, OrderShipment $shipment)
    {
        $this->status = $status;
        $this->shipment = $shipment;
    }

    public function create(PlaceNewOrder $creator)
    {
        $customer = Auth::guard('customer')->user();

        $order = $creator->place($customer);

        $this->status->orderCreated($order);

        $customer->carts()->detach();

        $this->shipment->setShipmentOptionsCache($order->shipment);

        return redirect()->route('customer.order.shipment', $order);
    }
}
