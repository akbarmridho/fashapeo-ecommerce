<?php

namespace App\Http\Controllers\Customer;

use App\Actions\Address\UpdateAddress;
use App\Http\Controllers\Controller;
use App\Models\Address;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AddressController extends Controller
{
    public function index()
    {
        $customer = Auth::guard('customer')->user();
        $addresses = $customer->addresses;

        return view('customer.pages.my-account.addresses', compact('addresses'));
    }

    public function edit(Address $address)
    {
        return view('customer.pages.my-account.edit-address', compact('address'));
    }

    public function create()
    {
        return view('customer.pages.my-account.add-address');
    }

    public function store(Request $request, UpdateAddress $creator)
    {
        $customer = Auth::guard('customer')->user();
        $addressCount = $customer->addresses()->count();

        if ($addressCount == 0) {
            $main = true;
        } elseif ($addressCount >= 5) {
            session()->flash('error', 'Customer are not allowed to have more than 5 address');

            return redirect()->route('customer.address');
        } else {
            $main = false;
        }

        $address = $creator->create($request->all(), $main);
        $customer->addresses()->save($address);

        session()->flash('status', 'Address created');

        return redirect()->route('customer.address');
    }

    public function delete(Address $address)
    {
        $address->delete();

        session('status', 'Address deleted');

        return redirect()->route('customer.address');
    }

    public function update(Address $address, Request $request, UpdateAddress $updater)
    {
        $updater->update($address, $request->all());

        session()->flash('status', 'Address updated');

        return redirect()->route('customer.address');
    }

    public function setMain(Address $address)
    {
        $customer = Auth::guard('customer')->user();

        if (! $old = $customer->addresses()->active()->first()) {
            $old->is_main = false;
            $old->save();
        }

        $address->is_main = true;
        $address->save();

        session()->flash('status', 'Main address updated');

        return redirect()->route('customer.address');
    }
}
