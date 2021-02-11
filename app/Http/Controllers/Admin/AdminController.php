<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function account()
    {
        $user = Auth::guard('admin')->user();
        return view('admin.pages.edit-account', compact('user'));
    }

    public function notification()
    {
        $user = Auth::guard('admin')->user();
        $notifications = $user->notifications;

        return view('admin.pages.notifications', compact('notifications'));
    }
}
