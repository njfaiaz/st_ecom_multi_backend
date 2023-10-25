<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\WishlistResource;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    public function index()
    {
        $products = Wishlist::with('product')->with('product.category')->with('product.subcategory')->where('user_id', auth()->id())->paginate(10);

        return apiResourceResponse(WishlistResource::collection($products), 'Wishlist');
    }

        public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id'
        ]);

        $productId = request()->product_id;

        $check = Wishlist::where('product_id', $productId)->where('user_id', Auth()->user()->id)->first();

        if($check) {
            return errorResponse('This item is already in your wishlist', 400);
        }

        Wishlist::create([
            'user_id' => auth()->id(),
            'product_id' => $productId,
        ]);

        return successResponse('Added to wishlist',200);
    }

    public function delete($product_id)
    {
        $wishlist = Wishlist::where('user_id', auth()->id())->where('product_id', $product_id)->first();

        if(!$wishlist) {
            return errorResponse('You have not added this product to your wishlist!', 404);
        }

        $wishlist->delete();

        return successResponse('Product removed from wishlist.');
    }
}
