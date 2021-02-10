<?php

namespace App\Services;

use App\Repository\DeliveryRepositoryInterface;
use App\Models\Shipment;
use App\Models\Courier;
use App\Actions\Order\UpdateOrder;
use Illuminate\Support\Facades\Cache;

class OrderShipment
{
    protected $cacheTime  = 60 * 60;
    protected $delivery;
    protected $order;

    public function __construct(DeliveryRepositoryInterface $delivery, UpdateOrder $order)
    {
        $this->delivery = $delivery;
        $this->order = $order;
    }

    public function finalizeShipment(Shipment $shipment, string $option)
    {
        $service = $this->getSelectedShipmentOption($shipment, $option);

        $this->order->setShipmentOption($shipment, $service);

        $this->order->createTransaction($shipment->order);
    }

    public function getSelectedShipmentOption(Shipment $shipment, string $option)
    {
        $opt = explode(':', $option);
        $courier = $opt[0];
        $srv = $opt[1];

        $courier = $this->getCachedShipmentOptions($shipment)->firstWhere('code', $courier);

        $courier = is_array($courier) ? $courier : $courier->toArray();

        $service = collect($courier['costs'])->firstWhere('service', $srv);

        return [
            'name' => $courier['name'],
            'code' => $courier['code'],
            'service' => $service['service'],
            'price' => $service['cost'][0]['value'],
            'etd' => $service['cost'][0]['etd'],
        ];
    }

    public function getShipmentOptions(Shipment $shipment)
    {
        $result = collect();

        foreach (Courier::all()->pluck('code') as $courier) {
            $result->push(array_values($this->delivery->cost($shipment->destination_id, $shipment->origin_id, $shipment->weight, $courier)->toArray()));
        }

        return $result->flatten(1);
    }

    public function getCachedShipmentOptions(Shipment $shipment)
    {
        return Cache::remember('shipment.cost.' . $shipment->id, $this->cacheTime, function () use ($shipment) {
            return $this->getShipmentOptions($shipment);
        });
    }

    public function setShipmentOptionsCache(Shipment $shipment)
    {
        Cache::put('shipment.cost.' . $shipment->id, $this->getShipmentOptions($shipment), $this->cacheTime);
    }
}
