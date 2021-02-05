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

        $wishlist = $this->wishlist->create(MasterProduct::findOrFail($request->id), $customer);

        return response()->json(['message' => 'Product added to your wishlist', 'id' => $wishlist->id], 200);
    }

    public function delete(int $id)
    {
        $wishlist = Wishlist::findOrFail($id);

        $this->wishlist->delete($wishlist);

        return response()->json(['message' => 'Product removed from your wishlist', 'id' => $wishlist->master_product_id], 200);
    }

    public function index()
    {
        return view('customer.pages.wishlist');
    }
}
