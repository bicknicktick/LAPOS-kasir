<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TransactionController;

// Homepage
Route::get('/', function () {
    return view('homepage');
})->name('home');

// Routes Produk
Route::resource('products', ProductController::class);
Route::get('products/search/api', [ProductController::class, 'search'])->name('products.search');

// Routes Transaksi
Route::resource('transactions', TransactionController::class)->only(['index', 'create', 'store', 'show']);
