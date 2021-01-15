<?php

namespace App\Actions\Order;

use App\Models\Order;
use App\Models\Shipment;
use App\Models\OrderItem;
use App\Models\Courier;
use App\Models\Transaction;
use App\Calculations\TransactionTotal;

class UpdateOrder {

    use TransactionTotal;

    public function createTransaction(Order $order)
    {
        $total = $this->calculateTotal($order);

        return Transaction::create([
            'order_id' => $order->id,
            'total' => $total,
        ]);
    }

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

    public function setShipmentOption(Shipment $shipment, $courier, $cost)
    {
        $data = $this->serializeCost($courier, $cost);

        $shipment->fill([
            'courier_id' => $data['courier_id'],
            'service' => $data['service'],
            'etd' => $data['etd'],
            'price' => $data['price'],
        ])->save();
    }

    public function updateTransaction(Order $order, array $input)
    {
        $order->transaction->fill([
            'transaction_number' => $input['transaction_id'],
            'payment_method' => PaymentMethod::convert($input),
            'completed_at' => Carbon::parse($input['transaction_time']),
        ])->save();
    }

    private function serializeCost($courier, $cost)
    {
        $data = $cost[0]['costs'];
        $key = array_search($courier['service'], $data);
        $courier = Courier::where('code', $courier['code'])->first();
        
        return array(
            'courier_id' => $courier->id,
            'service' => $courier['service'],
            'etd' => $data[$key]['cost']['etd'],
            'price' => $data[$key]['cost']['value'],
        );
    }
}