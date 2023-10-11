<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use App\Models\Subcategory;
use App\Models\Category;

class SubcategoryController extends Controller
{
    public function index()
    {
        $subcategories = Subcategory::where('is_active','1')->latest()->paginate(20);
        $categories = Category::orderBy('name','ASC')->get();

        return view('admin.subcategory.index',compact('subcategories','categories'));
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

        return redirect()->route('subcategory')->with($notification);
    }

    public function edit(Subcategory $subcategory)
    {
        return ('subcategory');
    }

    public function update(Request $request)
    {
        $subcategory_id = $request->subcategory_id;
        $subcategory = Subcategory::findOrFail($subcategory_id);

        if ($request->file('image')) {

            $image = $request->file('image');
            $name_gen = time().'.'.$image->getClientOriginalExtension();
            $save_url = 'images/categories/'.$name_gen;
            $image->move(public_path('images/categories'), $name_gen);

            File::delete($subcategory->image);

        $subcategory->update([
            'category_id' => $request->category_id,
            'name' => $request->name,
            'slug' => strtolower(str_replace(' ', '-',$request->name)),
            'image' => $save_url,
        ]);

        $notification = array(
            'message' => 'Subcategory Update Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('subcategory')->with($notification);

        } else {

            $subcategory->update([
                'category_id' => $request->category_id,
                'name' => $request->name,
                'slug' => strtolower(str_replace(' ', '-',$request->name)),
        ]);

        $notification = array(
            'message' => 'Subcategory Update Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('subcategory')->with($notification);
        }
    }

    public function delete(Subcategory $subcategory)
    {
        $subcategory->Update(['is_active' => 0]);

        $notification=array(
            'message'=>'Product Delete Successfully ',
            'alert-type'=>'success'
        );
        return Redirect()->back()->with($notification);
    }

}
