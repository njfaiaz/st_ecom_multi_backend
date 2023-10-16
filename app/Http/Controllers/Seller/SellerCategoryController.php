<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class SellerCategoryController extends Controller
{
    public function index()
    {
        $categories = Category::where('is_active','1')->latest()->paginate(20);

        return view('seller.category.index',compact('categories'));
    }

    public function store(Request $request)
    {
        $image = $request->file('image');
        $name_gen = time().'.'.$image->getClientOriginalExtension();
        $save_url = 'images/categories/'.$name_gen;
        $image->move(public_path('images/categories'), $name_gen);

        Category::create([
            'name' => $request->name,
            'slug' => strtolower(str_replace(' ', '-',$request->name)),
            'image' => $save_url,
        ]);

        $notification = array(
            'message' => 'Category Add Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('seller.category')->with($notification);
    }
}
