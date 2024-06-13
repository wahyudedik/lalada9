<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\user\UserController;
use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;

Route::get('/', [GuestController::class, 'index'])->name('welcomee');
Route::get('/guest-category', [GuestController::class, 'category'])->name('guest.category');
Route::get('/guest-category/{id}', [GuestController::class, 'show'])->name('guest.show.product');
Route::get('login', [GuestController::class, 'login'])->name('login');
Route::get('register', [GuestController::class, 'register'])->name('register');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

//user route
Route::middleware(['auth', 'userMiddleware'])->group(function () {
    //dashboard
    Route::get('dashboard', [UserController::class, 'index'])->name('dashboard');
    Route::get('dashboard/details/{id}', [UserController::class, 'addToCart'])->name('dashboard.show.product');
    Route::get('dashboard/cart', [CartController::class, 'index'])->name('dashboard.cart');
    Route::post('dashboard/cart', [CartController::class, 'store'])->name('dashboard.cart.store');
    Route::post('dashboard/place-order', [CartController::class, 'placeOrder'])->name('dashboard.place.order');

    //category
    Route::get('dashboard/category', [UserController::class, 'categoryIndex'])->name('dashboard.category');
    Route::get('dashboard/category/{id}', [UserController::class, 'categoryShow'])->name('dashboard.show.category');
});

//admin route
Route::middleware(['auth', 'adminMiddleware'])->group(function () {
    //dashboard Product
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/dashboard/create', [ProductController::class, 'create'])->name('admin.product.create');
    Route::post('/admin/dashboard/create', [ProductController::class, 'store'])->name('admin.product.store');
    Route::get('/admin/dashboard/edit/{id}', [ProductController::class, 'edit'])->name('admin.product.edit');
    Route::put('/admin/dashboard/edit/{id}', [ProductController::class, 'update'])->name('admin.product.update');
    Route::delete('/admin/dashboard/{id}', [ProductController::class, 'destroy'])->name('admin.product.destroy');
    Route::get('/admin/dashboard/details/{id}', [ProductController::class, 'show'])->name('admin.product.show');

    //category
    Route::get('admin/category', [CategoryController::class, 'index'])->name('admin.category');
    Route::get('admin/category/create', [CategoryController::class, 'create'])->name('admin.category.create');
    Route::post('admin/category/create', [CategoryController::class, 'store'])->name('admin.category.store');
    Route::get('admin/category/edit/{id}', [CategoryController::class, 'edit'])->name('admin.category.edit');
    Route::put('admin/category/edit/{id}', [CategoryController::class, 'update'])->name('admin.category.update');
    Route::delete('admin/category/{id}', [CategoryController::class, 'destroy'])->name('admin.category.destroy');
    Route::get('admin/category/details/{id}', [CategoryController::class, 'show'])->name('admin.category.show');

    //transaction
    Route::get('/admin/view-transaction', [OrderController::class, 'index'])->name('admin.view.transaction');
    Route::get('/admin/view-transaction/{id}', [OrderController::class, 'show'])->name('admin.view.transaction.show');
});
