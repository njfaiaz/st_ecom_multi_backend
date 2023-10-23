<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\Validator;
use App\Http\Resources\ProductResource;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Subcategory;
use App\Models\Category;
use App\Models\Product;
use App\Models\Brand;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $request->validate([
            'category_id' => 'nullable|array',
            'category_slug' => 'nullable|array',
            'subcategory_slug' => 'nullable|array',
            'brand_id' => 'nullable|array',
            'brand_slug' => 'nullable|array',
            'name' => 'nullable|string',
        ]);

        $category_id = $this->filterArray($request->category_id);
        $category_slug = $this->filterArray($request->category_slug);
        $subcategory_slug = $this->filterArray($request->subcategory_slug);
        $brand_id = $this->filterArray($request->brand_id);
        $brand_slug = $this->filterArray($request->brand_slug);
        $data = [];

        $products = Product::with('category', 'subcategory', 'images', 'variants', 'review');

        if (!empty($category_id)) {
            $products =  $products->whereIn('category_id', $category_id);
        }

        if (!empty($category_slug)) {
            $categoryIds = Category::whereIn('slug', $category_slug)->pluck('id')->toArray();
            $products =  $products->whereIn('category_id', $categoryIds);
        }

        if (!empty($subcategory_slug)) {
            $subcategoryIds = Subcategory::whereIn('slug', $subcategory_slug)->pluck('id')->toArray();
            $products =  $products->whereIn('subcategory_id', $subcategoryIds);
        }

        if (!empty($brand_id)) {
            $products =  $products->whereIn('brand_id', $brand_id);
        }

        if (!empty($brand_slug)) {
            $brandIds = Brand::whereIn('slug', $brand_slug)->pluck('id')->toArray();
            $products =  $products->whereIn('brand_id', $brandIds);
        }

        if ($request->order_by_price == 0) {  //Low to High price
            $products =  $products->orderBy('regular_price');
        }

        if ($request->order_by_price == 1) {  //High to Low price
            $products =  $products->orderBy('regular_price', 'desc');
        }

        if ($request->rating) {
            $products = $products->where('rating', intval($request->rating));
        }

        if ($request->name) {
            $products =  $products->where('name', 'like', '%' . $request->name . '%');
        }

        if ($request->popular) {
            $products =  $products->orderBy('stock_out', 'desc');
        }

        if ($request->min_price && $request->max_price) {
            $products =  $products->whereBetween('regular_price', [$request->min_price, $request->max_price]);
        }

        $products = $products->latest()->paginate(5);

        return apiResourceResponse(ProductResource::collection($products ?? []), null, 200, $data);
    }

    private function filterArray($array)
    {
        if (is_null($array)) return [];

        return array_values(array_filter($array));
    }


    public function show($slug)
    {
        $product = Product::where('slug', $slug)->with('category', 'subcategory', 'images', 'review', 'variants')->first();
        if (is_null($product)) {
            return errorResponse('Invalid Product', 420);
        }

        return apiResponse(ProductResource::make($product));
    }

    public function productSearch(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'min:3']
        ]);

        if ($validator->fails()) {
            return  successResponse($validator->errors()->first(), 422);
        }
        $name = $request->name;

        $product = Product::with('category','brand', 'review', 'subcategory', 'images', 'variants')->when($name, function ($q) use ($name) {
            $q->where('name', 'like', '%' . $name . '%');
        })->get();

        return apiResourceResponse(ProductResource::collection($product ?? []));
    }
}
