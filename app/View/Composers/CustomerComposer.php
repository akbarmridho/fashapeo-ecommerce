<?php

namespace App\View\Composers;

use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;

class CustomerComposer
{
    /**
     * The user repository implementation.
     *
     */
    protected $customer;

    /**
     * Create a new profile composer.
     *
     * @return void
     */
    public function __construct()
    {
        $this->customer = Auth::guard('customer')->user();
    }

    /**
     * Bind data to the view.
     *
     * @param  \Illuminate\View\View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('customer', $this->customer);
    }
}
