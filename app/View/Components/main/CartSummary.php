<?php

namespace App\View\Components\main;

use Illuminate\View\Component;

class CartSummary extends Component
{
    public $summary;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($summary)
    {
        $this->summary = $summary;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.main.cart-summary');
    }
}
