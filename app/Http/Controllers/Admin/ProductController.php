<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repository\ProductRepositoryInterface;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public $product;

    public function __construct(ProductRepositoryInterface $product)
    {
        $this->product = $product;
    }

    public function index(Request $request)
    {
        if ($request->has('page')) {
            $page = $request->page;
        } else {
            $page = 1;
        }

        $products = $this->product->all($page);

        return view('admin.pages.products', compact('products'));
    }

    public function archived(Request $request)
    {
        $products = $this->product->archived($request->page);

        return view('admin.pages.products-archived', compact('products'));
    }
}
