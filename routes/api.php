<?php

use App\Http\Controllers\Api\AddressController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\BrandController;
use App\Http\Controllers\Api\AuthController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;


Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

Route::get('brands', [BrandController::class, 'index']);

Route::get('city', [AddressController::class, 'city']);

Route::get('categories', [CategoryController::class, 'index']);
Route::get('sub-category/{category}', [CategoryController::class, 'subCategories']);

Route::get('products', [ProductController::class, 'index']);
Route::get('product/{slug}', [ProductController::class, 'show']);
Route::get('products/search', [ProductController::class, 'productSearch']);


Route::middleware('auth:sanctum')->group(function(){
    Route::get('user/address', [AddressController::class, 'index']);
    Route::post('user/address/store', [AddressController::class, 'store']);
    Route::post('user/address/update/{address}', [AddressController::class, 'update']);
    Route::get('user/address/delete/{address}', [AddressController::class, 'delete']);
});



Route::any('{catchall}', [
    function () {
        return response()->json([
            'status'=>false,
            'message'=>'No Endpoints Found!'
        ], 404);
    }
])->where('catchall', '.*');
