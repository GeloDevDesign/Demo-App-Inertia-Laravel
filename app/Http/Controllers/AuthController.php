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
            'email' => ['required', 'email', 'min:3', 'unique:users'], // Fixed 'numeric' to 'email'
            'password' => ['required', 'confirmed', Password::min(8)],

        ]);

        $user = User::create($validatedAttributes);
        Auth::login($user);

        Log::info('User registered successfully', ['user' => $user]);

        return redirect()->route('home');
    }

    public function login()
    {
        $credentials = request()->validate([
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);

        $remember = request()->boolean('remember');

        if (Auth::attempt($credentials, $remember)) {
            request()->session()->regenerate();
            return redirect()->route('home');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function logout()
    {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return redirect()->route('login');
    }
}
