<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;

class SellerOrderController extends Controller
{

    public function index()
    {
        $id = Auth::user()->id;
        $orders = Order::with('shop', 'user', 'payment_option')->where('shop_id', $id)->latest()->paginate(10);

        return view('seller.order.index', compact('orders'));
    }

    public function show($order)
    {
        $order = Order::with('items.product', 'payment_option')->where('invoice_no', $order)->first();

        return view('seller.order.show',compact('order'));
    }

    public function invoice(Order $order)
    {
        $order->load('address.city','items.product', 'payment_option');

        return view('seller.order.invoice', compact('order'));
    }
}
