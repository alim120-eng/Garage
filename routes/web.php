<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\{
    SaleController,
    UserOrderController,
    UserRepairController,
    AdminRepairController,
    AdminVehicleController,
    AdminOrderController,
    DashboardController
};

// 1. Guest Routes (Publicly Accessible)
Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/sale', [SaleController::class, 'index'])->name('sale.index');

// 2. Client/Customer Routes (Protected by auth and customer middleware)
Route::middleware(['auth', 'customer'])->group(function () {
    
    // User Consolidated Dashboard (My Orders + My Repairs)
    Route::get('/dashboard', [UserOrderController::class, 'index'])->name('dashboard');

    // Buying a vehicle
    Route::post('/sale/buy/{id}', [SaleController::class, 'buy'])->name('sale.buy');

    // Order & Repair cancellation for User
    Route::delete('/user/orders/{id}', [UserOrderController::class, 'destroy'])->name('user.orders.destroy');
    Route::delete('/user/repairs/{id}', [UserOrderController::class, 'destroyRepair'])->name('user.repairs.destroy');

    // Repair request submission
    Route::get('/user/repair/create', [UserRepairController::class, 'create'])->name('user.repairs.create');
    Route::post('/user/repair', [UserRepairController::class, 'store'])->name('user.repairs.store');

    // Dynamic vehicle details page for purchased car
    Route::get('/my-cars/{id}', [UserOrderController::class, 'showCar'])->name('my.cars.show');

    // Checkout Flow Routes
    Route::get('/checkout/{vehicle_id}', [App\Http\Controllers\CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/checkout/{vehicle_id}', [App\Http\Controllers\CheckoutController::class, 'store'])->name('checkout.store');

    // User selling car (C2C) Routes
    Route::get('/user/vehicles/create', [App\Http\Controllers\UserVehicleController::class, 'create'])->name('user.vehicles.create');
    Route::post('/user/vehicles', [App\Http\Controllers\UserVehicleController::class, 'store'])->name('user.vehicles.store');

    // Chat Routes (For C2C transactions)
    Route::get('/chat/{order_id}', [App\Http\Controllers\ChatController::class, 'show'])->name('chat.show');
    Route::post('/chat/{order_id}', [App\Http\Controllers\ChatController::class, 'store'])->name('chat.store');

    // Seller order management routes
    Route::patch('/seller/orders/{id}', [UserOrderController::class, 'sellerUpdateStatus'])->name('seller.orders.update');
    Route::delete('/seller/orders/{id}', [UserOrderController::class, 'sellerDestroyOrder'])->name('seller.orders.destroy');
});

// 3. Admin Protected Routes (Protected by auth and admin middleware)
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    
    // Admin Consolidated Dashboard (Stats + Active lists)
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Vehicles CRUD Management
    Route::get('/vehicles', [AdminVehicleController::class, 'index'])->name('vehicles.index');
    Route::get('/vehicles/create', [AdminVehicleController::class, 'create'])->name('vehicles.create');
    Route::post('/vehicles', [AdminVehicleController::class, 'store'])->name('vehicles.store');
    Route::get('/vehicles/{id}/edit', [AdminVehicleController::class, 'edit'])->name('vehicles.edit');
    Route::put('/vehicles/{id}', [AdminVehicleController::class, 'update'])->name('vehicles.update');
    Route::delete('/vehicles/{id}', [AdminVehicleController::class, 'destroy'])->name('vehicles.destroy');

    // Purchase Orders Management
    Route::patch('/orders/{id}', [AdminOrderController::class, 'updateStatus'])->name('orders.update');
    Route::delete('/orders/{id}', [AdminOrderController::class, 'destroy'])->name('orders.destroy');

    // Repair Orders Management
    Route::patch('/repairs/{id}', [AdminRepairController::class, 'updateStatus'])->name('repairs.update');
    Route::delete('/repairs/{id}', [AdminRepairController::class, 'destroy'])->name('repairs.destroy');
});

// 4. Shared Auth Routes (Breeze default profile, etc.)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});



// Auth Routes (Laravel Breeze)
require __DIR__.'/auth.php';