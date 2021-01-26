<?php

namespace App\View\Components\admin;

use Illuminate\View\Component;

class CategorySelection extends Component
{
    public $categories;
    
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($categories)
    {
        $this->categories = $categories;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.admin.category-selection');
    }
}
