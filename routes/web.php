<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Authentication Routes
|--------------------------------------------------------------------------
*/

// Login route
Route::inertia('/login', 'Auth/Login')->name('login');


Route::get('/register', function () {
    return Inertia::render('Auth/Register', [
        'time' => now()->toTimeString()
    ]);
})->name('register');
Route::post('/register-test', [AuthController::class, 'store']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

// Home page route
Route::get('/', function () {
    return Inertia::render('Views/Home', [
        'time' => now()->toTimeString()
    ]);
})->name('home')->middleware('auth');

Route::get('/welcome', function () {
    return Inertia::render('Views/Welcome');
})->name('welcome')->middleware('auth');
