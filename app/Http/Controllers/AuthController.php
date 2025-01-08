<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Password;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    public function __construct()
    {
        // $this->middleware('guest'); // Fixed 'Middleware' to 'middleware'
    }

    public function store()
    {
        sleep(2);
        $validatedAttributes = request()->validate([
            'name' => ['required', 'min:3'],
            'email' => ['required', 'email', 'min:3','unique:users'], // Fixed 'numeric' to 'email'
            'password' => ['required', 'confirmed', Password::min(8)],

        ]);

        $user = User::create($validatedAttributes);
        Auth::login($user);

        Log::info('User registered successfully', ['user' => $user]);

        return redirect()->route('home');
    }
}
