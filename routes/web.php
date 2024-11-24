<?php

use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\ReportController;

// Route::get('/', [HomeController::class, 'index'])->name('home');
// Route::get('/product', [ProductController::class, 'index'])->name('product');
// Route::get('/product/detail', [ProductController::class, 'detail'])->name('product-detail');
// Route::get('/product/tambah', [ProductController::class, 'create'])->name('product-tambah');
// Route::get('/product/edit/{id}', [ProductController::class, 'edit'])->name('product-edit');
// Route::get('/stock', [StockController::class, 'index'])->name('stock');
// Route::get('/stock/detail', [StockController::class, 'detail'])->name('stock-detail');
// Route::get('/report', [ReportController::class, 'index'])->name('report');

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout']);

Route::get('/', function () {
    return view('pages.home');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::middleware('permission:manage product')->group(function () {
            Route::resource('product', ProductController::class);
        });

        Route::middleware('permission:manage stock')->group(function () {
            Route::resource('stock', StockController::class);
        });

        Route::middleware('permission:manage report')->group(function () {
            Route::resource('report', ReportController::class);
        });

        Route::middleware('permission:manage category')->group(function () {
            Route::resource('category', CategoryController::class);
        });

        // Route::middleware(['role:admin', 'permission:manage user'])->group(function () {
        //     Route::resource('user', UserController::class);
        // });
    });
});