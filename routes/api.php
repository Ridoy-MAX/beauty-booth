<?php

use Illuminate\Http\Request;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');



Route::get('/category/{slug}/products', [ProductController::class, 'index_api'])->name('products.index');
Route::get('/', [ProductController::class, 'home_api']);