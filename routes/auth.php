<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::inertia('/login', 'Auth/Login')->name('login');


Route::get('/register', function () {
  return Inertia::render('Auth/Register', [
    'time' => now()->toTimeString()
  ]);
})->name('register');

Route::post('/register-test', [AuthController::class, 'store']);
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
