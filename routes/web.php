<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ApartmentController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Middleware\EnsureIsAdmin;

Route::middleware('guest')->group(function () {
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.post');
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
});

Route::get('/apartments', [ApartmentController::class, 'index'])->name('apartments.index');
Route::get('/apartments/popular', [ApartmentController::class, 'popular'])->name('apartments.popular');

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/my-apartments', [ApartmentController::class, 'myApartments'])->name('apartments.my');
    Route::get('/my-bookings', [BookingController::class, 'index'])->name('bookings.index');

    Route::get('/apartments/create', [ApartmentController::class, 'create'])->name('apartments.create');
    Route::post('/apartments', [ApartmentController::class, 'store'])->name('apartments.store');
    Route::get('/apartments/{apartment}/edit', [ApartmentController::class, 'edit'])->name('apartments.edit');
    Route::put('/apartments/{apartment}', [ApartmentController::class, 'update'])->name('apartments.update');
    Route::delete('/apartments/{apartment}', [ApartmentController::class, 'destroy'])->name('apartments.destroy');

    Route::post('/bookings', [BookingController::class, 'store'])->name('bookings.store');
    Route::delete('/bookings/{booking}', [BookingController::class, 'destroy'])->name('bookings.destroy');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::patch('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password.update');
});

Route::middleware(['auth', EnsureIsAdmin::class])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/users', [AdminUserController::class, 'index'])->name('users.index');
    Route::patch('/users/{user}/promote', [AdminUserController::class, 'promote'])->name('users.promote');
    Route::delete('/users/{user}', [AdminUserController::class, 'destroy'])->name('users.destroy');
});

Route::get('/apartments/{apartment}', [ApartmentController::class, 'show'])->name('apartments.show');
