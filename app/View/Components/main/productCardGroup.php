<?php

namespace App\View\Components\main;

use Illuminate\View\Component;

class productCardGroup extends Component
{
    public $productsCardGroupTitle;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($productsCardGroupTitle)
    {
        $this->productsCardGroupTitle = $productsCardGroupTitle;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.main.product-card-group');
    }
}
