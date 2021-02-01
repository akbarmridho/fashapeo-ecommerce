<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function dashboard()
    {
        return view('customer.pages.my-account.dashboard');
    }

    public function notification()
    {
        return view('customer.pages.my-account.notifications');
    }

    public function profile()
    {
        return view('customer.pages.my-account.edit-account');
    }
}
