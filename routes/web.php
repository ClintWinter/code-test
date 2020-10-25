<?php

use App\User;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RegisteredProductController;

Route::get('/', function () {
    return view('app', [
        'products' => Product::all(),
        'users' => User::all(),
    ]);
});

Route::get('/product', [ProductController::class, 'index']);

Route::get('/user', [RegisteredProductController::class, 'index']);

// Route::get()

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
