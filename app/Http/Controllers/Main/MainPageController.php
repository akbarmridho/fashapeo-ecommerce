<?php

namespace App\Http\Controllers\Main;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repository\ProductRepositoryInterface;
use App\Models\MasterProduct;
use App\Models\Category;
use Illuminate\Support\Facades\Cache;

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
        $bestSeller = $this->products->bestSeller();
        return view('main.pages.home', compact('newArrival', 'bestSeller'));
    }

    public function product($product)
    {
        $recentViewed = $this->products->recentViewed();
        $product = $this->products->findBySlug($product);
        $productInformation = $product->product_information;
        if ($customer = Auth::guard("customer")->user()) {
            $wishlist = $customer->wishlists()->where('master_product_id', $product->id)->first();
        } else {
            $wishlist = null;
        }

        return view('main.pages.product', compact('product', 'recentViewed', 'productInformation', 'wishlist'));
    }

    public function category(Category $category, Request $request)
    {
        if ($request->has('term') || $request->has('min') || $request->has('max')) {
            $products = $this->products->categoryFilter($category, $request->term, $request->min, $request->max);
        } else {
            $products = $this->products->category($category, $request->page);
        }
        return view('main.pages.category', compact('category', 'products'));
    }

    public function search(Request $request)
    {
        if ($request->has('term')) {
            $query = $request->term;
            $products = $this->products->search($query);

            return view('main.pages.product-search', compact('products', 'query'));
        } else {
            return redirect()->route('home');
        }
    }
}
