<?php

use App\Http\Controllers\auth\AuthController;
use App\Http\Controllers\auth\ForgotPasswordController;
use App\Http\Controllers\auth\ResetPasswordController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn () => view('home'))->name('home');

Route::middleware('guest')->group(function() {
    Route::get('/sign-in', [AuthController::class, 'showLogin'])->name('login');
    Route::get('/sign-up', [AuthController::class, 'showRegistration'])->name('register');
    Route::post('/sign-in', [AuthController::class, 'login']);
    Route::post('/sign-up', [AuthController::class, 'register']);

    Route::get('/forgot-password', fn() => view('auth.forgot-password'))->name('password.request');
    Route::get('/reset-password/{token}', fn() => view('auth.reset-password'))->name('password.reset');
});

Route::middleware('auth')->group(function() {
    Route::post('/sign-out', [AuthController::class, 'logout'])->name('logout');
});