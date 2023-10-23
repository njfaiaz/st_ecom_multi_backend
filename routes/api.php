<?php

use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\BrandController;
use App\Http\Controllers\Api\AuthController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;


Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

Route::get('brands', [BrandController::class, 'index']);

Route::get('categories', [CategoryController::class, 'index']);
Route::get('sub-category/{category}', [CategoryController::class, 'subCategories']);


Route::get('products', [ProductController::class, 'index']);
