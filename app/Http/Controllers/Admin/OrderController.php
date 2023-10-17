<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\OrderDataTable;
use App\Http\Controllers\Controller;
use App\Models\Order;

class OrderController extends Controller
{
    public function index(OrderDataTable $dataTable)
    {
        return $dataTable->render('admin.order.index');
    }

    public function show($order)
    {
        $order = Order::with('items.product', 'payment_option')->where('invoice_no', $order)->first();

        return view('admin.order.show',compact('order'));
    }

    public function invoice(Order $order)
    {
        $order->load('address.city','items.product', 'payment_option');

        return view('admin.order.invoice', compact('order'));
    }


}







