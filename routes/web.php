<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AdminMiddleware;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/menu', function () {
    return view('menu');
})->name('menu');

Route::get('/contact', function () {
    return view('contact');
})->name('contact');

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

        // Menu Items Management
        Route::resource('items', App\Http\Controllers\Admin\MenuItemController::class);

        // Categories Management
        Route::resource('categories', App\Http\Controllers\Admin\CategoryController::class);

        // Orders Management
        Route::resource('orders', App\Http\Controllers\Admin\OrderController::class);

        // Users Management
        Route::resource('users', App\Http\Controllers\Admin\UserController::class);
    });
});
