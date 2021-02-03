<?php

namespace App\Http\Controllers\Admin;

use App\Actions\Address\UpdateAddress;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateWarehouseRequest;
use App\Models\Warehouse;
use Illuminate\Http\Request;

class WarehouseController extends Controller
{
    public function index()
    {
        $warehouses = Warehouse::orderByDesc('id')->get();

        return view('admin.pages.warehouse', compact('warehouses'));
    }

    public function show(Warehouse $warehouse)
    {
        return view('admin.pages.edit-warehouse', compact('warehouse'));
    }

    public function create()
    {
        return view('admin.pages.create-warehouse');
    }

    public function store(CreateWarehouseRequest $request, UpdateAddress $creator)
    {
        $warehouseCount = Warehouse::count();

        if ($warehouseCount === 0) {
            $main = true;
        } else if ($warehouseCount >= 5) {
            session()->flash('error', 'Only five warehouse that are allowed');
            return redirect()->route('admin.warehouse');
        } else {
            $main = false;
        }

        $warehouse = Warehouse::create([
            'name' => $request->warehouse_name,
            'description' => $request->description,
            'main' => $main,
        ]);

        $address = $creator->create($request->address, true);
        $warehouse->address()->save($address);

        session()->flash('status', 'Warehouse created');

        return redirect()->route('admin.warehouse');
    }

    public function delete(Warehouse $warehouse)
    {
        $warehouse->address->delete();
        $warehouse->delete();

        session('status', 'Warehouse and its address has been deleted');

        return redirect()->route('admin.warehouse');
    }

    public function update(Warehouse $warehouse, CreateWarehouseRequest $request, UpdateAddress $updater)
    {
        $updater->update($warehouse->address, $request->address);

        $warehouse->fill([
            'name' => $request->warehouse_name,
            'description' => $request->description,
        ])->save();

        session()->flash('status', 'Warehouse updated');

        return redirect()->route('admin.warehouse');
    }

    public function setMain(Warehouse $warehouse)
    {
        if ($old = Warehouse::active()->first()) {
            $old->main = false;
            $old->save();
        }

        $warehouse->main = true;
        $warehouse->save();

        session()->flash('status', 'Main warehouse updated');

        return redirect()->route('admin.warehouse');
    }
}
