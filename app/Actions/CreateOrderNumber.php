<?php

namespace App\Actions;

use Illuminate\Support\Carbon;
use App\Models\Order;

class CreateOrderNumber {

    public function generate() {
        return (string) $this->getDate() . \sprintf('%04d', strval($this->getnumber()));
    }

    public function getDate() {
        return (string) Carbon::now()->format('Ym');
    }

    public function getMonth() {
        return (string) Carbon::today()->format('m');
    }

    public function getNumber() {
        // First Model
        if(! $latest = Order::latest()->first()) {
            return 1;
        }

        // Check month number. Reset to one if different
        if (substr($latest->order_number, 5, 2) === $this->getMonth()){
            return 1;
        }

        return intval(substr($latest->order_number, -4)) + 1;
    }
}