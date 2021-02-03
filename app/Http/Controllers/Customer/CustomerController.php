<?php

namespace App\Http\Controllers\Customer;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class CustomerController extends Controller
{
    public function dashboard()
    {
        return view('customer.pages.my-account.dashboard');
    }

    public function notification()
    {
        $customer = Auth::guard('customer')->user();
        $notifications = $customer->notifications;
        return view('customer.pages.my-account.notifications', compact('notifications'));
    }

    public function profile()
    {
        $user = Auth::guard('customer')->user();
        return view('customer.pages.my-account.edit-account', compact('user'));
    }
}
