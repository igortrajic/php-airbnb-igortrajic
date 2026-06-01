<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ApartmentController;


Route::middleware('guest')->group(function () {
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.post');
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

Route::resource('apartments', ApartmentController::class)
    ->only(['index','show', 'create'])
    ->withoutMiddleware(['auth']);

Route::resource('apartments', ApartmentController::class)
    ->except(['index','show'])
    ->middleware('auth');
    
use Illuminate\Support\Facades\Session;

Route::get('/nuke-session', function () {
    Session::flush(); // Wipes out all session data
    return 'Session completely destroyed! You are now a guest.';
});