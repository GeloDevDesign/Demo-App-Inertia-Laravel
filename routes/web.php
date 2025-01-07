<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Auth/Login');
});

// 'users' => User::all()->map(function ($user) {
//     return [
//         'name' => $user->name,
//         'email' => $user->email,
//         'created_at' => $user->created_at->format('Y-m-d H:i:s'),
//         'updated_at' => $user->updated_at->format('Y-m-d H:i:s'),
//     ];
// }); 


Route::post('/register', function () {
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
});
