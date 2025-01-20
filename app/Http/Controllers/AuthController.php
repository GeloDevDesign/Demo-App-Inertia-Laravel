<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Storage;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Hash;


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
            'role' => ['string'],
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
            event(new Registered($user));
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
            return redirect()->route('home')->with('green', 'Welcome bisaya');
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

    public function verify_email()
    {
        request()->validate(['email' => 'required|email']);

        $status = Password::sendResetLink(
            request()->only('email')
        );

        if ($status === Password::RESET_LINK_SENT) {
            return back()->with('status', __($status));
        }

        return back()->withErrors(['email' => __($status)]);
    }

    public function reset_password_token(string $token)
    {
        return Inertia::render('Auth/ResetPassword', [
            'token' => $token,
            'email' => request()->query('email')
        ]);
    }

    public function reset_password(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => ['required', 'confirmed', Password::min(8)->mixedCase()->numbers()],
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function (User $user, string $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));

                $user->save();

                event(new PasswordReset($user));
            }
        );

        if ($status === Password::PASSWORD_RESET) {
            return redirect()->route('login')->with('status', __($status));
        }

        return back()->withErrors(['email' => [__($status)]]);
    }
}
