<?php

namespace App\View\Composers;

use App\Repository\CategoryRepositoryInterface;
use Illuminate\View\View;

class CategoryComposer
{
    /**
     * The user repository implementation.
     *
     * @var \App\Reposistory\CategoryRepositoryInterface
     */
    protected $categories;

    /**
     * Create a new profile composer.
     *
     * @param  \App\Repository\CategoryRepositoryInterface  $categories
     * @return void
     */
    public function __construct(CategoryRepositoryInterface $categories)
    {
        // Dependencies automatically resolved by service container...
        $this->categories = $categories;
    }

    /**
     * Bind data to the view.
     *
     * @param  \Illuminate\View\View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('categories', $this->categories->parents());
    }
}