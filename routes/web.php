<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Auth\LoginController;
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
            Route::get('add', [BrandController::class, 'add'])->name('brand.add');
            Route::post('store', [BrandController::class, 'store'])->name('brand.store');
            Route::get('{brand}/edit', [BrandController::class, 'edit'])->name('brand.edit');
            Route::post('update', [BrandController::class, 'update'])->name('brand.update');
            Route::get('{brand}/delete', [BrandController::class, 'delete'])->name('brand.delete');
        });

        Route::prefix('category')->group(function() {
            Route::get('/', [CategoryController::class, 'index'])->name('category');
            Route::get('add', [CategoryController::class, 'add'])->name('category.add');
            Route::post('store', [CategoryController::class, 'store'])->name('category.store');
            Route::get('{category}/edit', [CategoryController::class, 'edit'])->name('category.edit');
            Route::post('update', [CategoryController::class, 'update'])->name('category.update');
            Route::get('{category}/delete', [CategoryController::class, 'delete'])->name('category.delete');
        });
    });
});
