<?php

use App\User;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductImageController;
use App\Http\Controllers\RegisteredProductController;

Route::get('/', function () {
    return view('app', [
        'products' => Product::all(),
        'users' => User::all(),
    ]);
});

Route::get('/product', [ProductController::class, 'index']);
Route::middleware('auth')->group(function () {
    Route::post('/product', [ProductController::class, 'store']);
    Route::get('/product/{product}', [ProductController::class, 'show']);
    Route::post('/product/{product}', [ProductController::class, 'update']);
    Route::delete('/product/{product}', [ProductController::class, 'destroy']);

    Route::get('/user/product', [RegisteredProductController::class, 'index']);
    Route::post('/user/product/{product}', [RegisteredProductController::class, 'store']);
    Route::delete('/user/product/{product}', [RegisteredProductController::class, 'destroy']);

    Route::post('/product-image/{product}', [ProductImageController::class, 'store']);
    Route::delete('/product-image/{product}', [ProductImageController::class, 'destroy']);
});


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
