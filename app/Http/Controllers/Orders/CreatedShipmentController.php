<?php

namespace App\Http\Controllers\Orders;

use App\Services\OrderStatus;
use App\Actions\Order\UpdateOrder;
use App\Http\Controllers\Controller;
use App\Http\Requests\FinalizeShipmentRequest;
use App\Models\Address;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Services\OrderShipment;

class CreatedShipmentController extends Controller
{
    private $status;
    private $delivery;

    public function __construct(
        OrderStatus $status,
        OrderShipment $delivery
    ) {
        $this->status = $status;
        $this->delivery = $delivery;
    }

    public function show(Order $order)
    {
        $shipments = $this->delivery->getCachedShipmentOptions($order->shipment);
        return view('customer.pages.orders.shipment', compact('order', 'shipments'));
    }

    public function update(Request $request, Order $order, UpdateOrder $updater)
    {
        $address = Address::find($request->address);
        $updater->updateShipmentAddress($order->shipment, $address);

        return response()->json(['message' => 'Shipment address updated']);
    }

    public function finalize(
        FinalizeShipmentRequest $request,
        Order $order
    ) {

        $shipment = $order->shipment;

        $this->delivery->finalizeShipment($shipment, $request->shipment);

        $this->status->shipmentCreated($order);

        return redirect()->route('customer.orders.transaction', ['order' => $order]);
    }
}
