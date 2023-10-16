<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\Order;

class SellerDashboardController extends Controller
{
    public function index()
    {
        $id = Auth::user()->id;
        $data['shopCount'] = Order::where('shop_id', $id)->get();
        $data['pendingOrder'] = Order::where('shop_id', $id)->where('status', '1')->get();
        $data['returnOrder'] = Order::where('shop_id', $id)->where('status', '6')->get();

        $products = Product::where('shop_id', $id)->where('is_active','1')->latest()->limit(12)->get();

        return view('seller.dashboard',compact('data', 'products'));
    }

}




