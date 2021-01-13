<?php

namespace App\Actions\Order;

use App\Models\Order;
use App\Models\OrderItem;

class UpdateOrder {

    public function update()
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
        //
    }

    public function setShipmentOption()
    {
        // set price, and order address
    }
}