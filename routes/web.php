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


/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

// Home page route
Route::get('/', [HomeController::class,'index'])->name('home')->middleware('auth');
Route::inertia('/welcome', 'Views/Welcome')->name('welcome')->middleware('auth');


require __DIR__ . '/auth.php';