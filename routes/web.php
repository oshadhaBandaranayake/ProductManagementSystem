<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Product\ProductController;
use Illuminate\Support\Facades\Route;


//Initial Route Definition
Route::redirect('/', '/login');

// Authentication Routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');





Route::middleware(['auth'])->group(function () {

    //Product Routes
    Route::prefix('products')->controller(ProductController::class)->name('products.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create',  'create')->name('create');
        Route::post('/store',  'store')->name('store');
        Route::get('/{product}/show',  'show')->name('show');
        Route::get('/{product}/edit',  'edit')->name('edit');
        Route::put('/{product}/update', 'update')->name('update');
        Route::delete('/{product}/delete',  'destroy')->name('delete');
    });
});







