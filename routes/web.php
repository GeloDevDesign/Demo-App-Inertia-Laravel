<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Models\User;
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
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

// Home page route
Route::get('/', [HomeController::class,'index'])->name('home')->middleware('auth');
Route::inertia('/welcome', 'Views/Welcome')->name('welcome')->middleware('auth');
