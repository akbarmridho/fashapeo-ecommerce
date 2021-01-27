<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\MasterProduct as Product;
use Illuminate\Http\Request;
use App\Repository\WishlistRepositoryInterface as Wishlist;

class WishlistController extends Controller
{
    public $wishlist;

    public function __construct(Wishlist $wishlist)
    {
        $this->wishlist = $wishlist;
    }

    public function store(Product $product)
    {
        $customer = Auth::guard('customer')->user();

        $this->wishlist->create($product, $customer);

        return response()->json(['message' => 'Product added to your wishlist'], 200);
    }

    public function delete(int $id)
    {
        $customer = Auth::guard('customer')->user();

        $wishlist = $customer->wishlists()->where('product_id', $id)->first();

        $this->wishlist->delete($wishlist);

        return response()->json(['message' => 'Product removed from your wishlist'], 200);
    }

    public function index()
    {
        //
    }
}