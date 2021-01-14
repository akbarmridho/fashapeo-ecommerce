<?php

namespace App\Actions\Order;

use App\Models\Order;
use App\Models\Shipment;
use App\Models\OrderItem;
use App\Models\Courier;

class UpdateOrder {

    public function updateShipment(array $input)
    {
        //
    }

    // address and shipment fee selected (update order destination)
    // transactions created
    // transaction done

    public function updateNote(OrderItem $orderItem, string $note)
    {
        $orderItem->note = $note;
        $orderItem->save();

        return $orderItem;
    }

    public function updateShipmentAddress(Shipment $shipment, Address $address)
    {
        $shipment->origin_id = $address->id;
        $shipment->save();
    }

    public function setShipmentOption(Shipment $shipment, Courier $courier, $data)
    {
        // set price, etc, price, courier id service
    }
}