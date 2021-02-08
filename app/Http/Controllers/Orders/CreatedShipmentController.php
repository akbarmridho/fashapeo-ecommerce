<?php

namespace App\Http\Controllers\Orders;

use App\Services\OrderStatus;
use App\Actions\Order\UpdateOrder;
use App\Actions\Order\UpdateStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\FinalizeShipmentRequest;
use App\Http\Requests\UpdateShipmentRequest;
use App\Models\Address;
use App\Models\Order;
use App\Models\OrderItem;
use App\Repository\DeliveryRepositoryInterface;
use App\Repository\StatusRepositoryInterface;

class CreatedShipmentController extends Controller
{
    private $status;
    private $delivery;

    public function __construct(
        OrderStatus $status,
        DeliveryRepositoryInterface $delivery
    ) {
        $this->status = $status;
        $this->delivery = $delivery;
    }

    public function show(Order $order)
    {
        return view('customer.pages.orders.shipment');
    }

    public function update(UpdateShipmentRequest $request, Order $order, UpdateOrder $updater)
    {
        $address = Address::find($request->address);
        $updater->updateShipmentAddress($order->shipment, $address);

        return response()->json(['message' => 'Shipment address updated']);
    }

    public function finalize(
        FinalizeShipmentRequest $request,
        Order $order,
        UpdateOrder $updater
    ) {
        foreach ($request->products as $product) {
            if (!$note = $product['note']) {
                $updater->updateNote(OrderItem::find($product), $note);
            }
        }

        $shipment = $order->shipment;

        $cost = $this->delivery->cost(
            $shipment->destination_id,
            $shipment->origin_id,
            $shipment->weight,
            $request->courier,
            true
        );

        $courier = [
            'courier' => $request->courier,
            'service' => $request->service,
        ];

        $updater->setShipmentOption($shipment, $courier, $cost);
        $updater->createTransaction($order);
        $this->status->shipmentCreated($order);

        return redirect()->route('customer.orders.transaction');
    }
}
