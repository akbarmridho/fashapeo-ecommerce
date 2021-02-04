<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Repository\ProductRepositoryInterface;
use App\Models\MasterProduct;
use App\Models\Category;

class MainPageController extends Controller
{
    protected $products;

    public function __construct(ProductRepositoryInterface $products)
    {
        $this->products = $products;
    }
    public function home()
    {
        $newArrival = $this->products->newArrival();
        return view('main.pages.home', compact('newArrival'));
    }

    public function product(MasterProduct $product)
    {
        $recentViewed = $this->products->recentViewed();
        return view('main.pages.product', compact('product', 'recentViewed'));
    }

    public function category(Category $category)
    {
        return view('main.pages.category');
    }
}
