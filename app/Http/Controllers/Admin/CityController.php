<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\City;

class CityController extends Controller
{
    public function index()
    {
        $cities = City::where('is_active','1')->latest()->paginate(10);

        return view('admin.city.index',compact('cities'));
    }

    public function store(Request $request)
    {
        City::create([
            'name' => $request->name,
            'slug' => strtolower(str_replace(' ', '-',$request->name)),
        ]);

        $notification = array(
            'message' => 'Brand Add Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('city')->with($notification);
    }

    public function update(Request $request)
    {
        $city_id = $request->city_id;
        $city = City::findOrFail($city_id);

        $city->update([
            'name' => $request->name,
            'slug' => strtolower(str_replace(' ', '-',$request->name)),
        ]);

        $notification = array(
            'message' => 'Brand Update Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('city')->with($notification);

    }

    public function delete(City $city)
    {
        $city->update(['is_active' => 0]);

        $notification=array(
            'message'=>'City Delete Successfully ',
            'alert-type'=>'success'
        );
        return Redirect()->back()->with($notification);
    }
}
