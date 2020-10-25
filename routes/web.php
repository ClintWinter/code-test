<?php

use App\Http\Controllers\ProductController;
use App\User;
use App\Product;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('app', [
        'products' => Product::all(),
        'users' => User::all(),
    ]);
});

Route::get('/product', [ProductController::class, 'index']);

Route::get()

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
