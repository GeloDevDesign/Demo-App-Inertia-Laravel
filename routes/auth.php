<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\EmailVerificationController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;


Route::inertia('/login', 'Auth/Login')->name('login');

Route::get('/register', function () {
  return Inertia::render('Auth/Register');
})
  ->name('register');

Route::get('/email/verify', [EmailVerificationController::class, 'notice'])->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', [EmailVerificationController::class, 'handler'])
  ->middleware(['signed'])
  ->name('verification.verify');

Route::post('/email/verification-notification', [EmailVerificationController::class, 'resend'])
  ->middleware(['signed'])
  ->middleware(['throttle:6,1'])
  ->name('verification.send');


Route::post('/register-test', [AuthController::class, 'store']);
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
