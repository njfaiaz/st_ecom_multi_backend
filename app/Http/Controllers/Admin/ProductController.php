<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Review;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::where('is_active','1')->latest()->paginate(30);

        return view('admin.product.index',compact('products'));
    }


    public function show(Product $product)
    {
        $product->load( 'brand', 'category', 'images', 'subcategory', 'review.user');

        $review_count = $product->review->count();
        $average = $product->review->avg('rating');
        $average = number_format($average, 1);
        $reviews = $product->review->take(3);

        $product_attributes = $product->formatAttributes($product->attributes);

        return view('admin.product.show',compact('product','product_attributes', 'reviews', 'review_count', 'average'));
    }


    public function productInactive($id)
    {
        Product::findOrFail($id)->Update(['is_active' => 0]);

        $notification=array(
            'message'=>'Product InActive Successfully ',
            'alert-type'=>'success'
        );
        return Redirect()->route('product')->with($notification);
    }

    public function productAllInactive ()
    {
        $products = Product::where('is_active','0')->latest()->paginate(15);
        return view('admin.product.inactive',compact('products'));
    }

    public function productReview($product)
    {
        $reviews = Review::with('product', 'images')->where('product_id', $product)->paginate(20);

        return view('admin.product.review', compact('reviews'));
    }

}
