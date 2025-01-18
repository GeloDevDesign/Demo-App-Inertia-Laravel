<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\EmailVerificationController;

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


Route::get('/email/verify/{id}/{hash}', [EmailVerificationController::class, 'handler'])->middleware('signed')->name('verification.verify')->middleware(['auth', 'limited_request:2,10','signed']);


Route::post('/register-test', [AuthController::class, 'store']);
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/forgot-password', function () {
  return view('auth.forgot-password');
})->middleware('guest')->name('password.request');
