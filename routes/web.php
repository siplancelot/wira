<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\ReportController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/product', [ProductController::class, 'index'])->name('product');
Route::get('/product/detail', [ProductController::class, 'detail'])->name('product-detail');
Route::get('/product/tambah', [ProductController::class, 'create'])->name('product-tambah');
Route::get('/product/edit/{id}', [ProductController::class, 'edit'])->name('product-edit');
Route::get('/stock', [StockController::class, 'index'])->name('stock');
Route::get('/stock/detail', [StockController::class, 'detail'])->name('stock-detail');
Route::get('/report', [ReportController::class, 'index'])->name('report');