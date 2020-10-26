<?php

use App\User;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductImageController;
use App\Http\Controllers\RegisteredProductController;

// main app
Route::get('/', function () {
    return view('app', [
        'products' => Product::all(),
        'users' => User::all(),
    ]);
});

// api routes
Route::get('/product', [ProductController::class, 'index']);
Route::middleware('auth')->group(function () {
    Route::post('/product', [ProductController::class, 'store'])->middleware('can:create,App\Product');
    Route::get('/product/{product}', [ProductController::class, 'show'])->middleware('can:view,product');
    Route::post('/product/{product}', [ProductController::class, 'update'])->middleware('can:update,product');
    Route::delete('/product/{product}', [ProductController::class, 'destroy'])->middleware('can:delete,product');

    Route::get('/user/product', [RegisteredProductController::class, 'index'])->middleware('can:register,App\Product');
    Route::post('/user/product/{product}', [RegisteredProductController::class, 'store'])->middleware('can:register,App\Product');
    Route::delete('/user/product/{product}', [RegisteredProductController::class, 'destroy'])->middleware('can:register,App\Product');

    Route::post('/product-image/{product}', [ProductImageController::class, 'store'])->middleware('can:update,product');
});

Auth::routes();
