<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\MasterProduct;
use App\Models\Wishlist;
use App\Repository\WishlistRepositoryInterface as WishlistRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    public $wishlist;

    public function __construct(WishlistRepository $wishlist)
    {
        $this->wishlist = $wishlist;
    }

    public function store(Request $request)
    {
        $customer = Auth::guard('customer')->user();

        $customer->wishlists()->attach($request->id);

        return response()->json(['message' => 'Product added to your wishlist'], 200);
    }

    public function delete(int $id)
    {
        $customer = Auth::guard('customer')->user();

        $customer->wishlists()->detach($id);

        return response()->json(['message' => 'Product removed from your wishlist'], 200);
    }

    public function index()
    {
        $customer = Auth::guard('customer')->user();
        $wishlists = $customer->wishlists;
        return view('customer.pages.wishlist', compact('wishlists'));
    }
}
