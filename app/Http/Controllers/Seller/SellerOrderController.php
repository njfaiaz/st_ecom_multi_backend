<?php

namespace App\Http\Controllers\Seller;

use App\DataTables\OrderDataTable;
use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SellerOrderController extends Controller
{

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $id = Auth::user()->id;
            $data = Order::with('shop', 'user', 'payment_option')->where('shop_id', $id)->get();

            return Datatables::of($data)
                ->addIndexColumn()
                ->editColumn('created_at', function(Order $order){
                    return $order->created_at->format('Y.m.d H:i:s');
                })

                ->addColumn('status', function($row){

                    if($row->status == 1)
                    {
                        return "Pending";
                    } elseif($row->status == 2)
                    {
                        return "Processing";
                    } elseif($row->status == 3)
                    {
                        return "On the way";
                    } elseif($row->status == 4)
                    {
                        return "Shipped";
                    } elseif($row->status == 5)
                    {
                        return "Delivered";
                    } elseif($row->status == 6)
                    {
                        return "Cancelled by Customer";
                    } elseif($row->status == 7)
                    {
                        return "Cancelled by Seller";
                    } else {
                        return "Refunded";
                    }

                })
            ->make();
        }

        return view('seller.order.index');
    }
}
