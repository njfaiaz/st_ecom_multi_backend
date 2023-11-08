<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CartResource;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        // $cart = Cart::with('items')->where('user_id', auth()->id())->first();
        $cart = auth()->user()->cart;

        return apiResourceResponse(CartResource::collection($cart->items ?? []), 'Cart List');
    }
}
