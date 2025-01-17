<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

// Home page route
Route::get('/', [HomeController::class, 'index'])->name('home')->middleware(['auth','verified']);
Route::inertia('/welcome', 'Views/Welcome')->name('welcome')->middleware(['auth','verified']);

require __DIR__ . '/auth.php';
