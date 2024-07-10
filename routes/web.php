<?php

use App\Http\Controllers\AdminProductController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KeranjangController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

//public
Route::get('/', [HomeController::class, 'index']);
Route::resource('/products', ProductController::class)->names("products");
Route::resource('/keranjang', KeranjangController::class)->names("keranjang");

//admin
Route::resource('/adminproduct', AdminProductController::class)->names("adminproduct");
Route::get('/getalldataproduct', [AdminProductController::class, 'getalldata']);

Route::post('/createdataproduct', [AdminProductController::class, 'store']);

Route::get('/getalldatauser', [AdminUserController::class, 'getalldata']);
Route::resource('/adminuser', AdminUserController::class)->names("adminuser");
Route::get('/admin', [DashboardController::class, 'index']);

//Login
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
Route::post('/ceklogin', [LoginController::class, 'login'])->name('ceklogin');