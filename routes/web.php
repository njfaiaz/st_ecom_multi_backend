<?php

use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Auth\RegisterController;
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
            Route::get('{id}/edit', [BrandController::class, 'edit'])->name('brand.edit');
            Route::post('{id}/update', [BrandController::class, 'update'])->name('brand.update');
            Route::get('{id}/delete', [BrandController::class, 'delete'])->name('brand.delete');
        });
    });
});
