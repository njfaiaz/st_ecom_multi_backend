<?php

use App\Http\Controllers\Admin\SubcategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Admin\SellerController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CityController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Seller\SellerDashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('guest')->group(function(){
    Route::get('login',[LoginController::class, 'loginForm'])->name('login');
    Route::post('login', [LoginController::class, 'login'])->name('login');
    Route::get('register',[RegisterController::class, 'signupForm'])->name('register');
    Route::post('register',[RegisterController::class, 'signup'])->name('register');
});

Route::middleware('auth')->group(function(){
    Route::get('logout',[LoginController::class,'logout'])->name('logout')->middleware('auth');

    Route::group(['prefix'=> 'admin'], function(){
        Route::get('dashboard',[DashboardController::class, 'index'])->name('admin.dashboard');

        Route::prefix('brand')->group(function() {
            Route::get('/', [BrandController::class, 'index'])->name('brand');
            Route::get('create', [BrandController::class, 'create'])->name('brand.create');
            Route::post('store', [BrandController::class, 'store'])->name('brand.store');
            Route::get('{brand}/edit', [BrandController::class, 'edit'])->name('brand.edit');
            Route::post('update', [BrandController::class, 'update'])->name('brand.update');
            Route::get('{brand}/delete', [BrandController::class, 'delete'])->name('brand.delete');
        });

        Route::prefix('category')->group(function() {
            Route::get('/', [CategoryController::class, 'index'])->name('category');
            Route::get('create', [CategoryController::class, 'create'])->name('category.create');
            Route::post('store', [CategoryController::class, 'store'])->name('category.store');
            Route::get('{category}/edit', [CategoryController::class, 'edit'])->name('category.edit');
            Route::post('update', [CategoryController::class, 'update'])->name('category.update');
            Route::get('{category}/delete', [CategoryController::class, 'delete'])->name('category.delete');
        });

        Route::prefix('subcategory')->group(function() {
            Route::get('/', [SubcategoryController::class, 'index'])->name('subcategory');
            Route::get('create', [SubcategoryController::class, 'create'])->name('subcategory.create');
            Route::post('store', [SubcategoryController::class, 'store'])->name('subcategory.store');
            Route::get('{subcategory}/edit', [SubcategoryController::class, 'edit'])->name('subcategory.edit');
            Route::post('update', [SubcategoryController::class, 'update'])->name('subcategory.update');
            Route::get('{subcategory}/delete', [SubcategoryController::class, 'delete'])->name('subcategory.delete');
        });

        Route::prefix('product')->group(function() {
            Route::get('/',[ProductController::class,'index'])->name('product');
            Route::get('create',[ProductController::class,'create'])->name('product.create');
            Route::get('/ajax/{category_id}', [ProductController::class, 'getSubCategory']);
            Route::post('store',[ProductController::class,'store'])->name('product.store');
            Route::get('{product}/edit', [ProductController::class, 'edit'])->name('product.edit');
            Route::post('{product}/update', [ProductController::class, 'update'])->name('product.update');
            Route::get('show/{product}', [ProductController::class, 'show'])->name('product.show');
            Route::get('review/{product}', [ProductController::class, 'productReview'])->name('product.review');
            Route::get('delete/multiImage/{productImage}', [ProductController::class, 'multiImageDelete'])->name('product.multiImage.delete');
            //  Product Inactive route --------------------------------------------------------------------
            Route::get('{id}/inactive', [ProductController::class, 'productInactive'])->name('product.inactive');
            Route::get('inactive',[ProductController::class,'productAllInactive'])->name('all.inactive.product');
        });

        Route::prefix('city')->group(function() {
            Route::get('/', [CityController::class, 'index'])->name('city');
            Route::post('store', [CityController::class, 'store'])->name('city.store');
            Route::get('{city}/edit', [CityController::class, 'edit'])->name('city.edit');
            Route::post('update', [CityController::class, 'update'])->name('city.update');
            Route::get('{city}/delete', [CityController::class, 'delete'])->name('city.delete');
        });

        Route::prefix('seller')->group(function() {
            Route::get('/', [SellerController::class, 'allSeller'])->name('allSeller');
            Route::get('{user}/block', [SellerController::class, 'BlockedSeller'])->name('BlockedSeller');
            Route::get('all/blocked', [SellerController::class, 'allBlockedSeller'])->name('allBlockedSeller');
            Route::get('{user}/unblock', [SellerController::class, 'unBlockSeller'])->name('sellerUnBlock');
            Route::get('show/{user}', [SellerController::class, 'show'])->name('sellerProfile');
        });

        Route::prefix('order')->group(function() {
            Route::get('/', [OrderController::class, 'index'])->name('order');
            Route::get('{order}/details', [OrderController::class, 'show'])->name('orderShow');
            Route::get('{order}/invoice', [OrderController::class, 'invoice'])->name('invoice');
        });



    });
});




