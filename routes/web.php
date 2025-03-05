<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Product\ProductController;
use Illuminate\Support\Facades\Route;

//Product Routes
// Route::controller('product', ProductController::class)->group(function () {
//     Route::get('/', 'index')->name('product.index');
//     Route::get('/create',  'create')->name('product.create');
//     Route::post('/store', 'store')->name('product.store');
//     Route::get('/{product}/edit',  'edit')->name('product.edit');
//     Route::put('/{product}/update',  'update')->name('product.update');
//     Route::delete('/{product}/delete', 'destroy')->name('product.delete');
// });

// Authentication Routes
Route::get('/', [AuthController::class, 'showLoginForm'])->name('login');
Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');



Route::prefix('product')->group(function () {
    Route::get('/', [ProductController::class, 'index'])->name('products.index');
    Route::get('/create', [ProductController::class, 'create'])->name('products.create');
    Route::post('/store', [ProductController::class, 'store'])->name('products.store');
    Route::get('/{product}/show', [ProductController::class, 'show'])->name('products.show');
    Route::get('/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');
    Route::put('/{product}/update', [ProductController::class, 'update'])->name('products.update');
    Route::delete('/{product}/delete', [ProductController::class, 'destroy'])->name('products.delete');
});
