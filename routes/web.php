<?php

use App\Http\Controllers\Dashboard\Admin\DashboardController;
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

Route::group(['prefix'=> 'admin'], function(){
    Route::get('logout',[LoginController::class,'logout'])->name('logout');
    Route::get('dashboard',[DashboardController::class,'dashboard'])->name('admin.dashboard');
});

