<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Notification;
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
        $notifications = $user->notifications()->paginate(7);

        return view('admin.pages.notifications', compact('notifications'));
    }
}
