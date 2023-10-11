<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Shop;
use App\Models\User;

class SellerController extends Controller
{
    public function allSeller()
    {
        $users = User::where('role','3')->where('is_active','1')->latest()->paginate(18);

        return view('admin.seller.index',compact('users'));
    }

    public function show($userId)
    {
        $shop = Shop::where('user_id', $userId)->first();
        $products = Product::where('shop_id', $shop->id)->paginate(15);

        return view('admin.seller.show',compact('products', 'shop'));
    }

    public function BlockedSeller(User $user)
    {
        $user->update(['is_active' => 0]);

        $notification=array(
            'message'=>'Seller Block Successfully ',
            'alert-type'=>'success'
        );
        return Redirect()->back()->with($notification);
    }

    public function allBlockedSeller()
    {
        $users = User::where('role','3')->where('is_active','0')->latest()->paginate(15);

        return view('admin.seller.blocked',compact('users'));
    }

    public function unBlockSeller(User $user)
    {
        $user->update(['is_active' => 1]);

        $notification=array(
            'message'=>'Seller Block Successfully ',
            'alert-type'=>'success'
        );
        return Redirect()->back()->with($notification);
    }
}
