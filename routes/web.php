<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
use App\Http\Controllers\ProductController;

Route::get('/products', [ProductController::class, 'index']);
Route::get('/products/create', [App\Http\Controllers\ProductController::class, 'create']);
Route::post('/products', [App\Http\Controllers\ProductController::class, 'store']);
Route::get('/products/{id}/edit', [App\Http\Controllers\ProductController::class, 'edit']);
Route::put('/products/{id}', [App\Http\Controllers\ProductController::class, 'update']);
Route::delete('/products/{id}', [App\Http\Controllers\ProductController::class, 'destroy']);

use App\Http\Controllers\AuthController;

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login')->middleware('guest');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

use App\Http\Controllers\MovementController;

Route::get('/movements', [MovementController::class, 'index']);
Route::post('/movements', [MovementController::class, 'store']);

use App\Http\Controllers\SupplierController;

Route::get('/suppliers', [SupplierController::class, 'index']);
Route::post('/suppliers', [SupplierController::class, 'store']);