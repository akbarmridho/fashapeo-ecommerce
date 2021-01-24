<?php

namespace App\Actions\Auth;

use App\Models\Admin;
use App\Models\Customer;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class Authenticate
{
    public function __invoke(Request $request)
    {
        $customer = Customer::where('email', $request->email)->firstOr(function () {
                return false;
        });

        if ($customer &&
            Hash::check($request->password, $customer->password)) {
            return $customer;
        }

        $admin = Admin::where('email', $request->email)->firstOr(function () {
            return false;
        });

        if ($admin &&
            Hash::check($request->password, $admin->password)) {
            return $admin;
        }
    }
}