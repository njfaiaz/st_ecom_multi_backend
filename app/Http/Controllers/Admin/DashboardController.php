<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\Shop;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $data['orderCount'] = Order::count();
        $data['deliveredOrderCount'] = Order::where('status', '5')->count();
        $data['productCount'] = Product::count();
        $data['activeProductCount'] = Product::where('is_active', '1')->count();
        $data['sellerCount'] = Shop::count();
        $data['activeSellerCount'] = Shop::where('is_active', '1')->count();
        $data['customerCount'] = User::where('role', '2')->where('is_active', '1')->count();
        $data['activeCustomerCount'] = User::where('role', '2')->count();

        $allSeller = User::where('role','3')->where('is_active','1')->latest()->limit(12)->get();

        return view('admin.dashboard', compact('data', 'allSeller'));
    }
}
