<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        $setting = Setting::where('is_active', 1)->first();

        return view('admin.setting.index',compact('setting'));
    }

    public function update(Request $request, Setting $setting)
    {
        if ($request->file('logo')) {

            $image = $request->file('logo');
            $imageName = time().'.'.$image->getClientOriginalExtension();
            $imagePath = 'images/logo/'.$imageName;
            $image->move(public_path('images/logo'), $imageName);

            unlink($setting->logo);

        $setting->update([
            'inside_dhaka' => $request->inside_dhaka,
            'outside_dhaka' => $request->outside_dhaka,
            'app_title' => $request->app_title,
            'logo' => $imagePath,

        ]);

        $notification = array(
            'message' => 'Setting Update Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('setting')->with($notification);

        } else {

        $setting->update([
            'inside_dhaka' => $request->inside_dhaka,
            'outside_dhaka' => $request->outside_dhaka,
            'app_title' => $request->app_title,
        ]);

        $notification = array(
            'message' => 'Setting Update Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('setting')->with($notification);
        }
    }
}
