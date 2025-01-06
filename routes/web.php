<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Auth/Login',[
        'name' => 'Definotlee', 
        'subject_ni_lee' => [
            'sub1','sub2','sub3'
        ]
    ]);
});

Route::get('/home',function (){
    // sleep(2);
    return Inertia::render('Views/Home',[
        'time' => now()->toTimeString()
    ]);
});

Route::get('/welcome',function (){
    return Inertia::render('Views/Welcome',[
        'name' => 'Definotlee',
        'subject_ni_lee' => [
            'sub1','sub2','sub3'
        ]
    ]);
});

Route::post('/logout',function (){
    return Inertia::render('Auth/Login');
});