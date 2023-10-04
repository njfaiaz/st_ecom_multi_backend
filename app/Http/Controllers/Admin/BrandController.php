<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function index()
    {
        $brands = Brand::latest()->paginate(15);

        return view('admin.brand.index',compact('brands'));
    }

    public function add()
    {

        return view('admin.brand.create');
    }
}
