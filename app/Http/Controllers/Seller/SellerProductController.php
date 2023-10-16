<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Review;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SellerProductController extends Controller
{
    public function index()
    {
        $id = Auth::user()->id;
        $products = Product::where('shop_id', $id)->where('is_active','1')->latest()->paginate(30);

        return view('seller.product.index',compact('products'));
    }

    public function create()
    {
        $categories = Category::latest()->get();
        $brands = Brand::latest()->get();

        return view('seller.product.create',compact('brands', 'categories'));
    }

    public function getSubCategory($category_id)
    {
        $subcategory = Subcategory::where('category_id',$category_id)->orderBy('name','ASC')->get();
        return json_encode($subcategory);
    }

    public function store(Request $request)
    {
        $image = $request->file('image');
        $imageName = time().'.'.$image->getClientOriginalExtension();
        $imagePath = 'images/products/'.$imageName;
        $image->move(public_path('images/products'), $imageName);

        $product = Product::create([
            'shop_id' => Auth::user()->id,
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'brand_id' => $request->brand_id,
            'name' => $request->name,
            'slug' => strtolower(str_replace(' ', '-',$request->name)),
            'description_short' => $request->description_short,
            'description_long' => $request->description_long,
            'regular_price' => $request->regular_price,
            'sale_price' => $request->sale_price,
            'stock_in' => $request->stock_in,
            'image' => $imagePath,
        ]);


        $attribute_names = $request->attribute_names;
        $attribute_values = $request->attribute_values;
        $additional_prices = $request->additional_prices;
        $attribute_count = count($attribute_names);

        for($i=0; $i<$attribute_count; $i++) {
            $product->variants()->create([
                'name' => $attribute_names[$i],
                'value' => $attribute_values[$i],
                'additional_price' => $additional_prices[$i]
            ]);
        }

        // Multiple Image Store
        $images = $request->file('images');
        foreach ($images as $img) {

            $image = rand().'.'.$img->getClientOriginalExtension();
            $imagePath = 'images/products/'.$image;

            $img->move(public_path('images/products'), $image);

            ProductImage::create([
                'product_id' => $product->id,
                'image' => $imagePath,
            ]);
        }

        $notification = array(
            'message' => 'Product Added Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('seller.product')->with($notification);
    }

    public function edit(Product $product)
    {
        $product->load( 'brand', 'category', 'images', 'subcategory');
        $brands = Brand::get();
        $categories = Category::get();
        $subcategories = SubCategory::get();

        return view('seller.product.edit',compact('brands','categories','subcategories', 'product'));
    }

    public function show(Product $product)
    {
        $product->load( 'brand', 'category', 'images', 'subcategory', 'review.user');

        $review_count = $product->review->count();
        $average = $product->review->avg('rating');
        $average = number_format($average, 1);
        $reviews = $product->review->take(3);

        $product_attributes = $product->formatAttributes($product->attributes);

        return view('seller.product.show',compact('product','product_attributes', 'reviews', 'review_count', 'average'));
    }

    public function update(Request $request, Product $product)
    {
        if ($request->file('image')) {

            $image = $request->file('image');
            $imageName = time().'.'.$image->getClientOriginalExtension();
            $imagePath = 'images/products/'.$imageName;
            $image->move(public_path('images/products'), $imageName);

            unlink($product->image);

        $product->update([
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'brand_id' => $request->brand_id,
            'name' => $request->name,
            'slug' => strtolower(str_replace(' ', '-',$request->name)),
            'description_short' => $request->description_short,
            'description_long' => $request->description_long,
            'regular_price' => $request->regular_price,
            'sale_price' => $request->sale_price,
            'stock_in' => $request->stock_in,
            'image' => $imagePath,

        ]);

        $notification = array(
            'message' => 'Product Update Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('seller.product')->with($notification);

        } else {

        $product->update([
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'brand_id' => $request->brand_id,
            'name' => $request->name,
            'slug' => strtolower(str_replace(' ', '-',$request->name)),
            'description_short' => $request->description_short,
            'description_long' => $request->description_long,
            'regular_price' => $request->regular_price,
            'sale_price' => $request->sale_price,
            'stock_in' => $request->stock_in,
        ]);

        $notification = array(
            'message' => 'Product Update Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('seller.product')->with($notification);
        }
    }

    public function multiImageDelete (ProductImage $productImage)
    {
        unlink($productImage->image);
        $productImage->delete();

        $notification=array(
            'message'=>'Product Multiple Image Delete Successfully ',
            'alert-type'=>'success'
        );
        return Redirect()->back()->with($notification);
    }

    public function productInactive($id)
    {
        Product::findOrFail($id)->Update(['is_active' => 0]);

        $notification=array(
            'message'=>'Product InActive Successfully ',
            'alert-type'=>'success'
        );
        return Redirect()->route('seller.product')->with($notification);
    }

    public function productAllInactive ()
    {
        $id = Auth::user()->id;
        $products = Product::where('shop_id', $id)->where('is_active','0')->latest()->paginate(15);
        return view('seller.product.inactive',compact('products'));
    }

    public function productReview($product)
    {
        $reviews = Review::with('product', 'images')->where('product_id', $product)->paginate(20);

        return view('seller.product.review', compact('reviews'));
    }
}
