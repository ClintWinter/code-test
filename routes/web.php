<?php

use App\Http\Controllers\ProductController;
use App\User;
use App\Product;
use Illuminate\Support\Facades\Route;

Route::get('/', [ProductController::class, 'index']);

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
