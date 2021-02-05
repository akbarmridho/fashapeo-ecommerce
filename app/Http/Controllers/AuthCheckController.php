<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class AuthCheckController extends Controller
{
    public function admin()
    {
        if (Auth::check('admin')) {
            return response()->json((bool) true, 200);
        } else {
            return response()->json((bool) false, 200);
        }
    }

    public function customer()
    {
        if (Auth::check('customer')) {
            return response()->json((bool) true, 200);
        } else {
            return response()->json((bool) false, 200);
        }
    }
}
