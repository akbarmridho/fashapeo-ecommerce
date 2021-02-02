<?php

namespace App\View\Components\customer;

use Illuminate\View\Component;

class Notifications extends Component
{

    public $notification;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($notification)
    {
        $this->notification = $notification;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.main.notifications');
    }
}
