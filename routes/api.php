<?php

use App\Http\Controllers\Api\WishlistController;
use App\Http\Controllers\Api\AddressController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\ReviewController;
use App\Http\Controllers\Api\BrandController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CartController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;


Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
Route::get('logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

Route::get('brands', [BrandController::class, 'index']);

Route::get('city', [AddressController::class, 'city']);

Route::get('review', [ReviewController::class, 'index']);

Route::get('categories', [CategoryController::class, 'index']);
Route::get('sub-category/{category}', [CategoryController::class, 'subCategories']);

Route::get('products', [ProductController::class, 'index']);
Route::get('product/{slug}', [ProductController::class, 'show']);
Route::get('products/search', [ProductController::class, 'productSearch']);


Route::middleware('auth:sanctum')->group(function(){
    Route::get('address', [AddressController::class, 'index']);
    Route::post('address/store', [AddressController::class, 'store']);
    Route::post('address/update/{address}', [AddressController::class, 'update']);
    Route::get('address/delete/{address}', [AddressController::class, 'destroy']);

    Route::get('profile', [UserController::class, 'index']);
    Route::post('profile/update', [UserController::class, 'update']);
    Route::post('password/update', [UserController::class, 'changePassword']);

    Route::get('wishlist', [WishlistController::class, 'index']);
    Route::post('wishlist/store', [WishlistController::class, 'store']);
    Route::delete('wishlist/delete/{product_id}', [WishlistController::class, 'delete']);

    Route::post('review/store', [ReviewController::class, 'store']);

    Route::get('cart', [CartController::class, 'index']);
    Route::get('cart/store', [CartController::class, 'store']);
    Route::get('cart/delete/{cartItem}', [CartController::class, 'delete']);

    Route::get('order', [OrderController::class, 'index']);
    Route::post('order', [OrderController::class, 'order']);
    Route::get('order/{order}', [OrderController::class, 'show']);
    Route::post('order/{order}/cancelled', [OrderController::class, 'orderCancel']);
});




Route::any('{catchall}', [
    function () {
        return response()->json([
            'status'=>false,
            'message'=>'No Endpoints Found!'
        ], 404);
    }
])->where('catchall', '.*');





