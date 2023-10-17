<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Subcategory;
use App\Models\Category;

class SellerSubCategoryController extends Controller
{
    public function index()
    {
        $subcategories = Subcategory::where('is_active','1')->latest()->paginate(20);
        $categories = Category::orderBy('name','ASC')->get();

        return view('seller.subcategory.index',compact('subcategories','categories'));
    }

    public function store(Request $request)
    {
        $image = $request->file('image');
        $name_gen = time().'.'.$image->getClientOriginalExtension();
        $save_url = 'images/categories/'.$name_gen;
        $image->move(public_path('images/categories'), $name_gen);

        Subcategory::create([
            'category_id' => $request->category_id,
            'name' => $request->name,
            'slug' => strtolower(str_replace(' ', '-',$request->name)),
            'image' => $save_url,
        ]);

        $notification = array(
            'message' => 'Subcategory Add Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('seller.subcategory')->with($notification);
    }
}
