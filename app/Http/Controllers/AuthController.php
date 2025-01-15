<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Password;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Storage;

class AuthController extends Controller
{
    public function __construct()
    {
        // $this->middleware('guest')->except(['logout']);
    }

    public function store()
    {
        $validatedAttributes = request()->validate([
            'name' => ['required', 'max:10'],
            'email' => ['required', 'email', 'min:3', 'unique:users'],
            'avatar' => [
                'file',
                'nullable',
                'max:300',
                'mimes:jpeg,png,jpg,gif,svg'
            ],
            'password' => ['required', 'confirmed', Password::min(8)->mixedCase()->numbers()],
        ]);

        if (request()->hasFile('avatar') && request()->file('avatar')->isValid()) {
            try {
                $validatedAttributes['avatar'] = Storage::disk('public')->put('avatars', request()->file('avatar'));
            } catch (\Exception $e) {
                Log::error('Avatar upload failed', ['error' => $e->getMessage()]);
                return back()->withErrors(['avatar' => 'Failed to upload avatar. Please try again.']);
            }
        }

        $validatedAttributes['password'] = bcrypt($validatedAttributes['password']);

        try {
            $user = User::create($validatedAttributes);
            Auth::login($user);
            return redirect()->route('home');
        } catch (\Exception $e) {
            Log::error('User registration failed', ['error' => $e->getMessage()]);
            return back()->withErrors(['email' => 'Registration failed. Please try again.']);
        }
    }

    public function login()
    {
        $credentials = request()->validate([
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);

        $key = 'login.' . request()->ip();

        // $ipKey = 'login.ip.' . request()->ip();
        // if (RateLimiter::tooManyAttempts($ipKey, 20)) {
        //     return back()->withErrors(['email' => 'Too many attempts from this IP']);
        // }

        // Email-based limit (lower number)
        // $emailKey = 'login.email.' . $request->email;
        // if (RateLimiter::tooManyAttempts($emailKey, 5)) {
        //     return back()->withErrors(['email' => 'Too many attempts for this email']);
        // }

        if (RateLimiter::tooManyAttempts($key, 5)) {
            $seconds = RateLimiter::availableIn($key);
            return back()->withErrors([
                'email' => "Too many login attempts. Please try again in {$seconds} seconds."
            ]);
        }

        $remember = request()->boolean('remember');

        if (Auth::attempt($credentials, $remember)) {
            request()->session()->regenerate();
            RateLimiter::clear($key);  // Clear attempts on successful login
            return redirect()->route('home');
        }

        RateLimiter::hit($key);  // Increment attempts on failed login
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
            'password' => 'Incorrect password, please try again',
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
