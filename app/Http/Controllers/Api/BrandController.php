<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\BrandResource;
use Illuminate\Http\Request;
use App\Models\Brand;

class BrandController extends Controller
{
    public function index()
    {
        $brands = Brand::where('is_active','1')->get();
        return  apiResourceResponse(BrandResource::collection($brands));
    }
}
