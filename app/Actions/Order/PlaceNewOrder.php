<?php

namespace App\Actions\Order;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Cart;
use App\Models\Customer;
use App\Models\Shipment;
use App\Actions\Calculations\CreateOrderNumber;
use App\Actions\Address\ActiveOriginAddress;

class PlaceNewOrder {

    use CreateorderNumber, ActiveOriginAddress;

    public function place(Customer $customer)
    {
        $order = $this->createOrder($customer, $this->generate());

        foreach($order->carts as $cart) {
            $this->createOrderItem($order, $cart);
        }

        $this->createShipment($customer->active_address, $order, $order->weight);

        return $order;
    }

    public function createOrder(Customer $customer, string $orderNumber)
    {
        return Order::create([
            'order_number' => $orderNumer,
            'user_id' => $customer->id,
            'customer_name' => $customer->name,
        ]);
    }

    public function createOrderItem(Order $order, Cart $cart)
    {

        $product = $cart->product;
        $product->stock = $product->stock - $cart->quantity;
        $product->save();

        $orderItem = OrderItem::create([
            'order_id' => $order->id,
            'product_id' => $product->id,
            'name' => $product->product_name,
            'variant' => $product->variant_name,
            'quantity' => $cart->quantity,
            'price' => $product->price,
            'price_cut' => $product->active_discount,
        ]);

        $orderItem->calculate();
        $cart->delete();

        return $orderItem;
    }

    public function createShipment(Address $destination, Order $order, int $weight)
    {
        $origin = $this->retreiveActiveOrigin();

        return Shipment::create([
            'order_id' => $order->id,
            'origin_id' => $origin->vendor_id,
            'destination_id' => $destination->vendor_id,
            'destination_province' => $destination->province,
            'destination_city' => $destination->city,
            'destination_district' => $destination->district,
            'destination_delivery' => $destination->delivery_address,
            'postal_code' => $destination->postal_code,
            'phone' => $destination->phone,
            'weight' => $weight,
        ]);
    }
}