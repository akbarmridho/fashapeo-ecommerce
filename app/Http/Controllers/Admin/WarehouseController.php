<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateWarehouseRequest;
use Illuminate\Http\Request;
use App\Models\Warehouse;
use App\Actions\Address\UpdateAddress;
use App\Repository\DeliveryRepositoryInterface as Deliveries;

class WarehouseController extends Controller
{
    public $deliveries;

    public function __construct(Deliveries $deliveries)
    {
        $this->deliveries = $deliveries;
    }

    public function index()
    {
        //
    }

    public function show()
    {
        //
    }

    public function create()
    {
        //
    }

    public function store(CreateWarehouseRequest $request, UpdateAddress $creator)
    {
        if(Warehouse::count() === 0) {
            $main = true;
        } else {
            $main = false;
        }

        $warehouse = Warehouse::create([
            'name' => $request->name,
            'description' => $request->description,
            'main' => $main,
        ]);

        $address = $request->address;
        $address = array_merge($address, $this->deliveries->address($address['city'] ?: $address['vendor_id']));

        $address = $creator->create($address, true);

        $warehouse->address()->save($address);

        session()->flash('status', 'Warehouse created');
    }

    public function delete(Warehouse $warehouse)
    {
        $warehouse->address->delete();
        $warehouse->delete();

        session('status', 'Warehouse and its address has been deleted');

        return back();
    }

    public function updateWarehouse(Warehouse $warehouse, Request $request)
    {
        $validated = $request->validate([
            'name' => 'string|required|max:255',
            'description' => 'string|nullable|max:255',
        ]);

        $warehouse->fill([
            'name' => $validated['name'],
            'description' => $validated['description'],
        ])->save();

        session()->flash('status', 'Warehouse updated');

        return back();
    }

    public function updateAddress(Warehouse $warehouse, Request $request, UpdateAddress $updater)
    {
        $updater->update($warehouse->address, $request->all());

        session()->flash('status', 'Address updated');

        return back();
    }

    public function setMain(Warehouse $warehouse)
    {
        if(! $old = Warehouse::active()->first()) {
            $old->main = false;
            $old->save();
        }

        $warehouse->main = true;
        $warehouse->save();

        session()->flash('status', 'Main warehouse updated');

        return back();
    }
}