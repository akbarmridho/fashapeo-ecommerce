<?php

namespace App\Actions\Order;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Address;
use App\Models\Cart;
use App\Models\Shipment;

class PlaceNewOrder {

    public function place()
    {
        // create order
        // create items
        // create shipment
        // create event order created
    }

    public function createOrder(Customer $customer, Address $address, string $orderNumber)
    {
        return Order::create([
            'order_number' => $orderNumer,
            'user_id' => $customer->id,
            'customer_name' => $customer->name,
            'destination_province' => $address->province,
            'destination_city' => $address->city,
            'destination_district' => $address->district,
            'destination_delivery'=> $address->delivery_address,
        ]);
    }

    public function createOrderItem(Order $order, Cart $cart, string $note)
    {

        $product = $cart->product;

        $order = Order::create([
            'order_id' => $order->id,
            'product_id' => $product->id,
            'name' => $product->product_name,
            'variant' => $product->variant_name,
            'quantity' => $product->quantity,
            'price' => $product->price,
            'note' => $note,
        ]);

        // if product has active discount, add price cut to order

        $order->calculate();

        return $order;
    }

    public function createShipment(Address $destination, Address $origin, Order $order, int $weight)
    {
        return Shipment::create([
            'order_id' => $order->id,
            'origin_id' => $origin->rajaongkir_id,
            'destination_id' => $destination->rajaongkir_id,
            'weight' => $weight,
        ]);
    }
}