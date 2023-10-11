<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use App\Models\Brand;

class BrandController extends Controller
{
    public function index()
    {
        $brands = Brand::where('is_active','1')->latest()->paginate(20);

        return view('admin.brand.index',compact('brands'));
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

        return redirect()->route('brand')->with($notification);
    }

    public function edit(Brand $brand)
    {
        return ('brand');
    }

    public function update(Request $request)
    {
        $brand_id = $request->brand_id;
        $brand = Brand::findOrFail($brand_id);

        if ($request->file('image')) {

            $image = $request->file('image');
            $name_gen = time().'.'.$image->getClientOriginalExtension();
            $save_url = 'images/brands/'.$name_gen;
            $image->move(public_path('images/brands'), $name_gen);

            File::delete($brand->image);

        $brand->update([
            'name' => $request->name,
            'slug' => strtolower(str_replace(' ', '-',$request->name)),
            'image' => $save_url,
        ]);

        $notification = array(
            'message' => 'Brand Update Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('brand')->with($notification);

        } else {

            $brand->update([
                'name' => $request->name,
                'slug' => strtolower(str_replace(' ', '-',$request->name)),
        ]);

        $notification = array(
            'message' => 'Brand Update Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('brand')->with($notification);
        }
    }


    public function delete(Brand $brand)
    {
        $brand->Update(['is_active' => 0]);

        $notification=array(
            'message'=>'Product Delete Successfully ',
            'alert-type'=>'success'
        );
        return Redirect()->back()->with($notification);


        // $img = $brand->image;
        // unlink($img);

        // $brand->delete();

        // $notification = array(
        //     'message' => 'Brand Delete Successfully',
        //     'alert-type' => 'success'
        // );

        // return redirect()->back()->with($notification);
    }
}
