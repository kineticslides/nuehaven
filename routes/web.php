<?php

use App\Http\Controllers\Admin\AuthController as AdminAuthController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\ReservationController as AdminReservationController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ReservationController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/checkout', [HomeController::class, 'checkout'])->name('checkout');
Route::get('/checkout/details', [HomeController::class, 'bookingDetails'])->name('checkout.details');
Route::post('/reservations', [ReservationController::class, 'store'])->name('reservations.store');
Route::get('/reservation/{reservation}/received', [ReservationController::class, 'received'])->name('reservation.received');
Route::post('/generate', [HomeController::class, 'generate'])->name('generate');

Route::prefix('admin')->group(function (): void {
    Route::get('/login', [AdminAuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AdminAuthController::class, 'login'])
        ->middleware('guest')
        ->name('admin.login.store');

    Route::middleware(['auth', 'admin'])->group(function (): void {
        Route::get('/', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
        Route::get('/reservations/{reservation}/proof', [AdminReservationController::class, 'proof'])->name('admin.reservations.proof');
        Route::patch('/reservations/{reservation}/approve', [AdminReservationController::class, 'approve'])->name('admin.reservations.approve');
        Route::patch('/reservations/{reservation}/decline', [AdminReservationController::class, 'decline'])->name('admin.reservations.decline');
        Route::post('/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');
    });
});
