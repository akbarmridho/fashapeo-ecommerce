<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Repository\ProductRepositoryInterface;
use App\Models\MasterProduct;

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
        dump($product->product_information->toArray());
        return view('main.pages.product', compact('product'));
    }
}
