<?php

namespace App\Transformers;

use App\Models\Order;

class CreateInvoiceDetail
{
    public static function create(Order $order): array
    {
        $shipment = $order->shipment;

        $shippingAddress = [
            'phone' => $shipment->phone,
            'address' => $shipment->delivery_address.' '.$shipment->delivery_district,
            'city' => $shipment->delivery_city,
            'postal_code' => $shipment->postal_code,
        ];

        $productItems = [];

        foreach ($order->items as $item) {
            $productItems[] = [
                'price' => $item->final_price,
                'quantity' => $item->quantity,
                'name' => $item->name.$item->variant ? ', '.$item->variant : '',
            ];
        }

        $productItems[] = [
            'name' => $shipment->courier->name.' '.$shipment->service,
            'price' => $shipment->price,
        ];

        return [
            'transaction_details' => [
                'order_id' => $order->order_number,
                'gross_amount' => $order->transaction->total,
            ],
            'customer_details' => [
                'first_name' => $order->customer->first_name,
                'last_name' => $order->customer->last_name,
                'email' => $order->customer->email,
                'shipping_address' => $shippingAddress,
            ],
            'item_details' => $productItems,
        ];
    }
}
