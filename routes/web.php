<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CategoriesController;
use App\Http\Controllers\Admin\MartialsController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\MpesaController;
use App\Http\Controllers\PayheroPaymentController;


// USERS
Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/public/categories/{category}/martials', [App\Http\Controllers\MartialsController::class, 'index'])->name('public.martials.index');

// cart
Route::post('/cart/add/{martial}', [CartController::class, 'add'])->name('cart.add');
Route::middleware(['auth'])->group(function () {
    Route::get('/martial/download/{id}', [CartController::class, 'download'])->name('martial.download');
    Route::get('/checkout', [CartController::class, 'checkout'])->name('checkout.page');
});

// payment details
Route::middleware(['auth'])->group(function () {
    Route::get('/payment', [PaymentController::class, 'index'])->name('payment.page');
    Route::post('/mpesa/stkpush', [MpesaController::class, 'stkPush'])->name('mpesa.stkpush');
    Route::post('/api/mpesa/callback', [MpesaController::class, 'stkCallback']);
    Route::post('/stkpush', [PayheroPaymentController::class, 'stkPush'])->name('stk.push');
    Route::post('/stk/callback', [PayheroPaymentController::class, 'stkCallback'])->name('stk.callback');
    Route::get('/payment/check-status', [PaymentController::class, 'checkPaymentStatus'])->name('payment.checkStatus');
});

// ADMINS

// categories
Route::middleware(['auth', 'is_admin'])->group(function () {
    Route::get('/categories', [CategoriesController::class, 'index'])->name('categories.index');
    Route::post('/categories', [CategoriesController::class, 'store'])->name('categories.store');
    Route::patch('/categories/{category}', [CategoriesController::class, 'update'])->name('categories.update');
    Route::delete('/categories/{category}', [CategoriesController::class, 'destroy'])->name('categories.destroy');
});

// users
Route::middleware(['auth', 'is_admin'])->group(function () {
    Route::get('/users', [UsersController::class, 'index'])->name('users.index');
    Route::get('/users/{user}', [UsersController::class, 'show'])->name('users.show');
    Route::get('/users/{user}/edit', [UsersController::class, 'edit'])->name('users.edit');
    Route::put('/users/{user}', [UsersController::class, 'update'])->name('users.update');
    Route::delete('/users/{user}', [UsersController::class, 'destroy'])->name('users.destroy');
});

// martials
Route::middleware(['auth', 'is_admin'])->group(function () {
    Route::get('/categories/{category}/details', [MartialsController::class, 'show'])->name('martials.index');
    Route::get('/martials/create/{category}', [MartialsController::class, 'create'])->name('martials.create');
    Route::post('/martials', [MartialsController::class, 'store'])->name('martials.store');
    Route::delete('/martials/{martial}', [MartialsController::class, 'destroy'])->name('martials.destroy');
});

// 👤 Profile Routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// 👑 Admin-only Routes
Route::middleware(['auth', 'is_admin'])->group(function () {
    Route::get('/admin', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
});

Route::middleware(['auth', 'is_admin'])->group(function () {
    Route::get('/admin/categories/create', function () {
        return view('admin.categories.create');
    })->name('categories.create');
});

require __DIR__.'/auth.php';
