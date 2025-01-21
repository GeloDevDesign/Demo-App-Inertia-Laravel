<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ResetPasswordController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\EmailVerificationController;
use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;


Route::inertia('/login', 'Auth/Login')->name('login');

Route::get('/register', function () {
  return Inertia::render('Auth/Register');
})
  ->name('register');

Route::get('/email/verify', [EmailVerificationController::class, 'notice'])->name('verification.notice')
  ->middleware('auth');

Route::post('/email/verification-notification', [EmailVerificationController::class, 'resend'])
  ->middleware(['auth', 'limited_request:2,10'])  
  ->name('verification.send');

Route::get('/email/verify/{id}/{hash}', [EmailVerificationController::class, 'handler'])->middleware('signed')->name('verification.verify')->middleware(['auth', 'limited_request:3,5', 'signed']);


Route::post('/register-test', [AuthController::class, 'store']);
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');




Route::get('/forgot-password', function () {
  return Inertia::render('Auth/ForgotPassword', [
    'status' => session('status')
  ]);
})->middleware('guest')->name('password.request');

Route::post('/forgot-password', [ResetPasswordController::class, 'verify_email'])
  ->middleware(['guest', 'throttle:6,1'])
  ->name('password.email');

Route::get('/reset-password/{token}', [AuthController::class, 'reset_password_token'])
  ->middleware('guest')
  ->name('password.reset');

Route::post('/reset-password', [AuthController::class, 'reset_password'])
  ->middleware('guest')
  ->name('password.update');
