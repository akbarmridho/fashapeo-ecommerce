<?php

namespace App\Http\Controllers\Orders;

use App\Requests\UpdateShipmentRequest;
use App\Requests\FinalizeShipmentRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Address;
use App\Actions\Order\UpdateStatus;
use App\Actions\Order\UpdateOrder;
use App\Repository\StatusRepositoryInterface;

class CreatedOrderController extends Controller
{

    private $status;
    private $delivery;

    public function __construct(StatusRepositoryInterface $statusRepository,
                                DeliveryRepositoryInterface $delivery)
    {
        $this->status = $statusRepository;
        $this->delivery = $delivery;
    }

    public function show(Order $order)
    {
        //
    }

    public function update(UpdateShipmentRequest $request, Order $order, UpdateOrder $updater)
    {
        $address = Address::find($request->address);
        $updater->updateShipmentAddress($order->shipment, $address);

        return response()->json(['message' => 'Shipment address updated']);
    }

    public function finalize(FinalizeShipmentRequest $request, Order $order, UpdateOrder $updater)
    {
        foreach($request->products as $product)
        {
            if (! $note = $product['note']) {
                $updater->updateNote(OrderItem::find($product), $note);
            }
        }

        // buat repo untuk courier, action untuk serialize cost response dari vendor

        // $shipment = $order->shipment;

        // $data = $this->delivery->cost(
        //     $shipment->destination_id,
        //     $shipment->origin_id,
        //     $shipment->weight,
        //     $request->courier,
        //     true
        // );
        
        // $updater->setShipmentOption($shipment, )
    }
}