<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brand;

class SellerBrandController extends Controller
{
    public function index()
    {
        $brands = Brand::where('is_active','1')->latest()->paginate(20);

        return view('seller.brand.index',compact('brands'));
    }

    public function store(Request $request)
    {
        $image = $request->file('image');
        $name_gen = time().'.'.$image->getClientOriginalExtension();
        $save_url = 'images/brands/'.$name_gen;
        $image->move(public_path('images/brands'), $name_gen);

        Brand::create([
            'name' => $request->name,
            'slug' => strtolower(str_replace(' ', '-',$request->name)),
            'image' => $save_url,
        ]);

        $notification = array(
            'message' => 'Brand Add Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('seller.brand')->with($notification);
    }
}
