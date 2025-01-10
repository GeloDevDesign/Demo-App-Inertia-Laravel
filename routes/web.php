<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;


Route::inertia('/login', 'Auth/Login')->name('login');

// 'users' => User::all()->map(function ($user) {
//     return [
//         'name' => $user->name,
//         'email' => $user->email,
//         'created_at' => $user->created_at->format('Y-m-d H:i:s'),
//         'updated_at' => $user->updated_at->format('Y-m-d H:i:s'),
//     ];
// }); 


Route::get('/register', function () {
    return Inertia::render('Auth/Register', [
        'time' => now()->toTimeString()
    ]);
})->name('register');



Route::get('/home', function () {
    return Inertia::render('Views/Home', [
        'time' => now()->toTimeString()
    ]);
})->name('home');

Route::get('/welcome', function () {
    return Inertia::render('Views/Welcome');
})->name('welcome');

Route::post('/logout', function () {
    return Inertia::render('Auth/Login');
})->name('logout');


Route::post('/register-test', [AuthController::class,'store']);
Route::post('/login', [AuthController::class, 'login']);
