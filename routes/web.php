<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PageController::class, 'index'])->name('index');
Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/product_page', [PageController::class, 'product_page'])->name('product_page');

Route::get('/admin/login', [AdminController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AdminController::class, 'login'])->name('admin.login.submit'); // Rute untuk login
Route::post('/admin/logout', [AdminController::class, 'logout'])->name('admin.logout');
Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard')->middleware('auth');
Route::resource('/admin/products', ProductController::class)->middleware('auth');
Route::resource('/admin/orders', OrderController::class)->middleware('auth');
Route::resource('/admin/users', AdminController::class)->middleware('auth');
Route::get('/user/login', [AuthController::class, 'showLoginForm'])->name('user.login');
Route::post('/user/login', [AuthController::class, 'login'])->name('user.login.submit');
Route::post('/user/logout', [AuthController::class, 'logout'])->name('user.logout');
Route::get('/user/register', [AuthController::class, 'showRegisterForm'])->name('user.register');
Route::post('/user/register', [AuthController::class, 'register'])->name('user.register.submit');

Route::get('/user/cart', [CartController::class, 'view'])->name('user.cart');
Route::post('/user/cart/add/{id}', [CartController::class, 'add'])->name('user.cart.add')->middleware('auth');
Route::get('/user/cart/checkout', [CartController::class, 'checkout'])->name('user.cart.checkout')->middleware('auth');
Route::get('/user/order', [OrderController::class, 'order'])->name('user.order')->middleware('auth');
Route::get('/user/profile', [ProfileController::class, 'profile'])->name('user.profile')->middleware('auth');
Route::put('/user/profile', [ProfileController::class, 'updateProfile'])->name('user.updateProfile')->middleware('auth');

Route::get('/admin/orders/{order}/detail', [OrderController::class, 'detail_order'])->name('admin.order-detail')->middleware('auth');
Route::get('/user/history/{order}/detail', [OrderController::class, 'order_detail_user'])->name('user.order-detail-user')->middleware('auth');

Route::get('/user/history', [OrderController::class, 'history'])->name('user.history')->middleware('auth');
Route::get('/user/cart/buy-now/{id}', [CartController::class, 'buyNow'])->name('user.cart.buyNow');
Route::delete('/user/cart/delete/{id}', [CartController::class, 'delete'])->name('user.cart.delete');

Route::get('/admin/profile', [ProfileController::class, 'adminProfile'])->name('admin.profile')->middleware('auth');
Route::put('/admin/profile', [ProfileController::class, 'updateProfileAdmin'])->name('admin.updateProfileAdmin')->middleware('auth');
