<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Auth/Login', [
        'name' => 'Definotlee',
        'subject_ni_lee' => [
            'sub1',
            'sub2',
            'sub3'
        ]
    ]);
});

Route::get('/home', function () {
    return Inertia::render('Views/Home', [
        'time' => now()->toTimeString()
    ]);
})->name('home');

Route::get('/welcome', function() {
    return Inertia::render('Views/Welcome', [
        'name' => 'Definotlee',
        'subject_ni_lee' => [
            'sub1','sub2','sub3'
        ]
    ]);
})->name('welcome');

Route::post('/logout', function () {
    return Inertia::render('Auth/Login');
});
