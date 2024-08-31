<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

// Route::get('/', function () {
//     return view('welcome');
// });


// Route::get('/category/{slug}/products', [ProductController::class, 'getProductsByCategory']);
Route::get('/category/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/', [ProductController::class, 'home']);
