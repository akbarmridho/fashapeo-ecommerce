<?php

namespace App\Http\Controllers;

use App\Models\Notification;

class NotificationController extends Controller
{
    public function read(Notification $notification)
    {
        $notification->markAsRead();
    }

    public function readAll()
    {
        auth()->user()->unreadNotifications->markAsRead();

        return back();
    }
}
