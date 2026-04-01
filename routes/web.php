<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ShopController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/



// Admin Auth Routes
Route::get('/admin/login', [App\Http\Controllers\Admin\AdminLoginController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [App\Http\Controllers\Admin\AdminLoginController::class, 'login'])->name('admin.login.submit');
Route::get('/admin/logout', [App\Http\Controllers\Admin\AdminLoginController::class, 'logout'])->name('admin.logout');

// Admin Dashboard (protected)
Route::middleware(['admin.auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\Admin\AdminDashboardController::class, 'index'])->name('dashboard');
    
    // Modules
    Route::get('/deliveries', [App\Http\Controllers\Admin\AdminDeliveryController::class, 'index'])->name('deliveries.index');
    Route::get('/orders',     [App\Http\Controllers\Admin\AdminOrderController::class, 'index'])->name('orders.index');
    Route::post('/orders/{order}', [App\Http\Controllers\Admin\AdminOrderController::class, 'update'])->name('orders.update');
    Route::get('/products',   [App\Http\Controllers\Admin\AdminProductController::class, 'index'])->name('products.index');
    
    // Notifications Polling
    Route::get('/notifications/poll', [App\Http\Controllers\Admin\AdminDashboardController::class, 'pollNotifications'])->name('notifications.poll');
});

// Delivery Boy Portal
Route::prefix('driver')->name('delivery.')->group(function () {
    Route::get('/login', [App\Http\Controllers\DeliveryController::class, 'showLogin'])->name('login');
    Route::post('/login', [App\Http\Controllers\DeliveryController::class, 'login'])->name('login.submit');
    Route::post('/logout', [App\Http\Controllers\DeliveryController::class, 'logout'])->name('logout');
    
    Route::middleware('auth')->group(function () {
        Route::get('/dashboard', [App\Http\Controllers\DeliveryController::class, 'dashboard'])->name('dashboard');
        Route::post('/order/{order}/status', [App\Http\Controllers\DeliveryController::class, 'updateStatus'])->name('order.update');
    });
});
// Home
Route::get('/', [HomeController::class, 'index'])->name('home');

// Products
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/{slug}', [ProductController::class, 'show'])->name('products.show');

// Static / Info pages
Route::get('/customized-cakes', [ShopController::class, 'customized'])->name('customized');
Route::get('/delivery', [ShopController::class, 'delivery'])->name('delivery');
Route::get('/contact', [ShopController::class, 'contact'])->name('contact');
Route::post('/contact', [ShopController::class, 'contactSubmit'])->name('contact.submit');
