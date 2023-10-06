<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::latest()->paginate(20);

        return view('admin.category.index',compact('categories'));
    }

    public function store(Request $request)
    {
        $image = $request->file('image');
        $name_gen = time().'.'.$image->getClientOriginalExtension();
        $save_url = 'images/categories/'.$name_gen;
        $image->move(public_path('images/categories'), $name_gen);

        Category::insert([
            'name' => $request->name,
            'slug' => strtolower(str_replace(' ', '-',$request->name)),
            'image' => $save_url,
        ]);

        $notification = array(
            'message' => 'Category Add Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('category')->with($notification);
    }

    public function edit(Category $category)
    {
        return ('category');
    }

    public function update(Request $request)
    {

        $category_id = $request->category_id;
        $category = Category::findOrFail($category_id);

        if ($request->file('image')) {

            $image = $request->file('image');
            $name_gen = time().'.'.$image->getClientOriginalExtension();
            $save_url = 'images/categories/'.$name_gen;
            $image->move(public_path('images/categories'), $name_gen);

            File::delete($category->image);

        $category->update([
            'name' => $request->name,
            'slug' => strtolower(str_replace(' ', '-',$request->name)),
            'image' => $save_url,
        ]);

        $notification = array(
            'message' => 'Category Update Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('category')->with($notification);

        } else {

            $category->update([
                'name' => $request->name,
                'slug' => strtolower(str_replace(' ', '-',$request->name)),
        ]);

        $notification = array(
            'message' => 'Category Update Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('category')->with($notification);
        }
    }

    public function delete(Category $category)
    {
        $img = $category->image;
        unlink($img);

        $category->delete();

        $notification = array(
            'message' => 'Category Delete Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }
}
