<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\FeedbackController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AdminMiddleware;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/about', function () {
    return view('about');
})->name('about');

use App\Http\Controllers\MenuController;

Route::get('/menu', [MenuController::class, 'index'])->name('menu');

Route::get('/contact', function () {
    return view('contact');
})->name('contact');

// Cart routes
Route::middleware(['auth'])->group(function () {
    // Cart routes
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
    Route::delete('/cart/{id}', [CartController::class, 'remove'])->name('cart.remove');

    // Checkout routes
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');

    // Order routes
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show');
    Route::post('/orders/{order}/feedback', [FeedbackController::class, 'store'])->name('orders.feedback.store');
});

// Address routes
Route::middleware(['auth'])->group(function () {
    Route::get('/addresses', [AddressController::class, 'index'])->name('addresses.index');
    Route::post('/addresses', [AddressController::class, 'store'])->name('addresses.store');
    Route::patch('/addresses/{address}', [AddressController::class, 'update'])->name('addresses.update');
    Route::delete('/addresses/{address}', [AddressController::class, 'destroy'])->name('addresses.destroy');
});

// Include authentication routes
require __DIR__ . '/auth.php';

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    // User profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    Route::prefix('admin')->name('admin.')->middleware(AdminMiddleware::class)->group(function () {
        // Dashboard
        Route::get('/dashboard', [App\Http\Controllers\Admin\AdminController::class, 'index'])->name('dashboard');

        // Profile Management
        Route::get('/profile', [App\Http\Controllers\Admin\ProfileController::class, 'edit'])->name('profile.edit');
        Route::put('/profile', [App\Http\Controllers\Admin\ProfileController::class, 'update'])->name('profile.update');
        Route::put('/profile/password', [App\Http\Controllers\Admin\ProfileController::class, 'updatePassword'])->name('profile.password');

        // Menu Items Management
        Route::resource('items', App\Http\Controllers\Admin\MenuItemController::class);

        // Categories Management
        Route::resource('categories', App\Http\Controllers\Admin\CategoryController::class);

        // Orders Management
        Route::resource('orders', App\Http\Controllers\Admin\OrderController::class);

        // Users Management
        Route::resource('users', App\Http\Controllers\Admin\UserController::class);

        // Feedback Management
        Route::get('/feedback', [App\Http\Controllers\Admin\FeedbackController::class, 'index'])->name('feedback.index');
        Route::post('/feedback/{feedback}/approve', [App\Http\Controllers\Admin\FeedbackController::class, 'approve'])->name('feedback.approve');
        Route::post('/feedback/{feedback}/reject', [App\Http\Controllers\Admin\FeedbackController::class, 'reject'])->name('feedback.reject');
        Route::post('/feedback/{feedback}/toggle-featured', [App\Http\Controllers\Admin\FeedbackController::class, 'toggleFeatured'])->name('feedback.toggle-featured');
        Route::delete('/feedback/{feedback}', [App\Http\Controllers\Admin\FeedbackController::class, 'destroy'])->name('feedback.destroy');
    });
});
