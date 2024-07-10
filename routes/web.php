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
Route::get('/', [HomeController::class, 'index'])->middleware('auth');
Route::resource('/products', ProductController::class)->names("products")->middleware('auth');
Route::resource('/keranjang', KeranjangController::class)->names("keranjang")->middleware('auth');

//admin
//product
Route::resource('/adminproduct', AdminProductController::class)->names("adminproduct")->middleware('auth');
Route::get('/getalldataproduct', [AdminProductController::class, 'getalldata']);
Route::post('/createdataproduct', [AdminProductController::class, 'store']);
Route::post('/updatedataproduct', [AdminProductController::class, 'update']);
//user
Route::get('/getalldatauser', [AdminUserController::class, 'getalldata']);
Route::resource('/adminuser', AdminUserController::class)->names("adminuser");
Route::get('/admin', [DashboardController::class, 'index'])->middleware('auth');

//Login
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::get('/register', [LoginController::class, 'register'])->name('login');
Route::post('/registerakun', [LoginController::class, 'registerakun'])->name('registerakun');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
Route::post('/ceklogin', [LoginController::class, 'ceklogin'])->name('ceklogin');
