<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChirpController;
use Inertia\Inertia;

// Home page route
Route::get('/', [HomeController::class, 'index'])->name('home')->middleware(['auth','verified']);
Route::inertia('/welcome', 'Views/Welcome')->name('welcome')->middleware(['auth','verified']);

Route::resource('chirps', ChirpController::class)
    ->only(['index', 'store'])
    ->middleware(['auth', 'verified']);
    

require __DIR__ . '/auth.php';
