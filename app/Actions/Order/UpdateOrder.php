<?php

namespace App\Actions\Order;

use App\Actions\Calculations\TransactionTotal;
use App\Models\Address;
use App\Models\Courier;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Shipment;
use App\Models\Transaction;
use App\Transformers\MidtransPaymentMethod as PaymentMethod;
use Illuminate\Support\Carbon;

class UpdateOrder
{
    use TransactionTotal;

    public function createTransaction(Order $order)
    {
        $total = $this->calculateTotal($order);
        $transaction = Transaction::create([
            'total' => $total,
        ]);
        $order->transaction()->associate($transaction);
        $order->save();

        return $transaction;
    }

    public function updateNote(OrderItem $orderItem, string $note)
    {
        $orderItem->note = $note;
        $orderItem->save();

        return $orderItem;
    }

    public function updateShipmentAddress(Shipment $shipment, Address $address)
    {
        $shipment->fill(
            [
                'destination_id' => $address->vendor_id,
                'destination_province' => $address->province,
                'destination_city' => $address->city,
                'destination_district' => $address->district,
                'destination_delivery' => $address->delivery_address,
                'postal_code' => $address->postal_code,
                'phone' => $address->phone,
            ]
        )->save();
    }

    public function setShipmentOption(Shipment $shipment, array $data)
    {
        $shipment->fill([
            'courier' => $data['name'],
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

    public function revertStock(Order $order)
    {
        $items = $order->items;
        foreach ($items as $item) {
            $product = $item->product;
            $product->stock = $product->stock + $item->quantity;
            $product->save();
        }
    }

    private function serializeCost($courier, $cost)
    {
        $data = $cost[0]['costs'];
        $key = array_search($courier['service'], $data);
        $courier = Courier::where('code', $courier['code'])->first();

        return [
            'courier_id' => $courier->id,
            'service' => $courier['service'],
            'etd' => $data[$key]['cost']['etd'],
            'price' => $data[$key]['cost']['value'],
        ];
    }

    public function setDateCompletion(Transaction $transaction)
    {
        $transaction->fill(['completed_at' => now()])->save();
    }

    public function updateFailedOrder(Order $order)
    {
        $order->fill([
            'completed_at' => now(),
            'is_success' => false,
        ])->save();
    }

    public function completeOrder(Order $order)
    {
        $order->fill([
            'completed_at' => now(),
            'is_success' => true,
        ])->save();
    }

    public function cancelOrder($order)
    {
        $this->setDateCompletion($order->transaction);
        $this->updateFailedOrder($order);
    }
}
