<?php

namespace App\Http\Controllers\Api;
use App\Http\Resources\CartItemsResource;
use App\Http\Requests\CartStoreRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CartItem;
use App\Models\Cart;

class CartController extends Controller
{
    public function index()
    {
        $cart = Cart::with('items')->where('user_id', auth()->id())->first();

        return apiResourceResponse(CartItemsResource::collection($cart->items ?? []), 'Cart List');
    }

    public function store(CartStoreRequest $request)
    {
         $cart = Cart::with('items')->where('user_id', auth()->id())->first();

        if ($cart) {

            $checkItem = $cart?->items()->where('product_id', $request->product_id)->first();

            if ($checkItem) {
                $checkItem->update([
                    'price' => $request->price,
                    'quantity' => $checkItem->quantity +  $request->quantity,
                ]);
            } else {
                $cart->items()->create([
                    'product_id' => $request->product_id,
                    'price' => $request->price,
                    'quantity' => $request->quantity,
                ]);
            }

            return successResponse('Product Added To Cart Successfully');
        }

        $newCart = Cart::create([
            'user_id' => auth()->id(),
        ]);

        $newCart->items()->create([
            'product_id' => $request->product_id,
            'price' => $request->price,
            'quantity' => $request->quantity,
        ]);

        return successResponse('Product Added To Cart Successfully');
    }

    public function delete(CartItem $cartItem)
    {
        if ($cartItem->cart->user_id !== auth()->user()->id) {
            return errorResponse('Cart Not Found', 404);
        }

        $cartItem->delete();

        return successResponse('Cart deleted');
    }
}
