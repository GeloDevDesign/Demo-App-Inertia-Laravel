<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\User;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Log;


class EmailVerificationController extends Controller
{
    public function notice()
    {
        if (auth()->check() && auth()->user()->hasVerifiedEmail()) {
            return redirect()->route('home');
        }

        return Inertia::render('Auth/Verify', ['status' => session('status')]);
    }

    public function handler(EmailVerificationRequest $request)
    {
        $request->fulfill();
        $userName = auth()->user()->name;
        return redirect()->route('home')->with('greetings', "Welcome to our app, $userName!");
    }

    public function resend(Request $request)
    {
        // abort(429);
        
        if (auth()->check() && auth()->user()->hasVerifiedEmail()) {
            return redirect()->route('home');
        }
        
        $request->user()->sendEmailVerificationNotification();
        
        return back()->with('status', 'Verification link sent!');
    }
}
