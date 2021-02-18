<?php

namespace App\View\Components\main;

use Illuminate\View\Component;

class ProductCardGroup extends Component
{
    public $title;
    public $products;
    public $tag;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($title, $products, $tag)
    {
        $this->title = $title;
        $this->products = $products;
        $this->tag = $tag;
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
