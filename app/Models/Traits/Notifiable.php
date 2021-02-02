<?php

namespace App\Models\Traits;

use Illuminate\Notifications\Notifiable as BaseNotifiable;
use App\Models\Notification;

trait Notifiable
{
    use BaseNotifiable;

    public function notifications()
    {
        return $this->morphMany(Notification::class, 'notifiable')->orderBy('created_at', 'desc');
    }
}
