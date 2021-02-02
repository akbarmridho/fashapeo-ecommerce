<?php

namespace App\Actions\Order;

use App\Actions\Address\ActiveOriginAddress;
use App\Actions\Calculations\CreateOrderNumber;
use App\Models\Address;
use App\Models\Cart;
use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Shipment;

class PlaceNewOrder
{
    use CreateorderNumber, ActiveOriginAddress;

    public function place(Customer $customer)
    {
        $order = $this->createOrder($customer, $this->generate());

        foreach ($order->carts as $cart) {
            $this->createOrderItem($order, $cart);
        }

        $shipment = $this->createShipment($customer->active_address, $order, $order->weight);
        $order->shipment()->associate($shipment);
        $order->save();
        $order->refresh();

        return $order;
    }

    public function createOrder(Customer $customer, string $orderNumber)
    {
        return Order::create([
            'order_number' => $orderNumber,
            'user_id' => $customer->id,
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
            'destination_name' => $destination->name,
            'postal_code' => $destination->postal_code,
            'phone' => $destination->phone,
            'weight' => $weight,
        ]);
    }
}
