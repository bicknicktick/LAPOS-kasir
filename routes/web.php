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

// Routes Reports
Route::get('/reports', [App\Http\Controllers\ReportController::class, 'index'])->name('reports.index');
Route::get('/reports/pdf', [App\Http\Controllers\ReportController::class, 'exportPdf'])->name('reports.pdf');
Route::get('/reports/excel', [App\Http\Controllers\ReportController::class, 'exportExcel'])->name('reports.excel');
