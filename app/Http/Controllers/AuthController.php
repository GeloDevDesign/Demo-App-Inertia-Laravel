<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Password;
use Inertia\Inertia;

class AuthController extends Controller
{
    public function __construct()
    {
        // $this->middleware('guest'); // Fixed 'Middleware' to 'middleware'
    }

    public function store()
    {
        sleep(1);
        request()->validate([
            'name' => ['required', 'min:3'],
            'email' => ['required', 'email', 'min:3'], // Fixed 'numeric' to 'email'
            'password' => ['required', 'confirmed', Password::min(8), 'confirmed'],
        ]);

        return response()->json(request()->all());
        return Inertia::render('Auth/Login');
    }
}
