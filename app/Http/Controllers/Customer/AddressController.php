<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Repository\DeliveryRepositoryInterface as Administration;
use App\Models\Address;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Actions\Address\UpdateAddress;

class AddressController extends Controller
{
    public $administration;

    public function __construct(Administration $administration)
    {
        $this->administration = $administration;
    }

    public function index()
    {
        //
    }

    public function edit(Address $address)
    {
        //
    }

    public function create()
    {
        //
    }

    public function store(Request $request, UpdateAddress $creator)
    {
        $customer = Auth::guard('customer')->user();

        if($customer->addresses->isEmpty()) {
            $main = true;
        } else {
            $main = false;
        }

        $data = $request->all();
        $data = array_merge($data, $this->administration->address($request->city ?: $request->vendor_id));

        $address = $creator->create($data, $main);

        $customer->addresses()->save($address);

        session()->flash('status', 'Address created');
    }

    public function delete(Address $address)
    {
        $address->delete();

        session('status', 'Address deleted');

        return back();
    }

    public function update(Address $address, Request $request, UpdateAddress $updater)
    {
        $updater->update($address, $request->all());

        session()->flash('status', 'Address updated');

        return back();
    }

    public function setMain(Address $address)
    {
        $customer = Auth::guard('customer')->user();

        if(! $old = $customer->addresses()->active()->first()) {
            $old->is_main = false;
            $old->save();
        }

        $address->is_main = true;
        $address->save();

        session()->flash('status', 'Main address updated');

        return back();
    }
}