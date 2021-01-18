<?php

namespace App\Http\Controllers\Orders;

use App\Http\Controllers\Controller;
use App\Requests\ShipmentCostRequest;
use App\Repository\DeliveryRepositoryInterface;

class ShipmentOptionController extends Controller
{
    public $delivery;

    public function __construct(DeliveryRepositoryInterface $delivery)
    {
        $this->delivery = $delivery;
    }

    public function show(ShipmentCostRequest $request, Order $order)
    {
        $shipment = $order->shipment;

        return $this->delivery->cost(
            $shipment->destination_id,
            $shipment->origin_id,
            $shipment->weight,
            $request->courier,
        );
    }
}