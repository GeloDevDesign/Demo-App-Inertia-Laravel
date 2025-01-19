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

        // Prevent rapid resend attempts
        if ($request->user()->hasRecentlySentVerificationEmail()) {
            return back()->with('status', 'You can only request a new verification email every 10 minutes.');
        }

        // Generate a temporary signed URL for the email verification
        $verificationUrl = URL::temporarySignedRoute(
            'verification.verify',
            now()->addMinutes(60),
            [
                'id' => $request->user()->id,
                'hash' => sha1($request->user()->email)
            ]
        );

        // Log the verification URL (for debugging or audit purposes)
        // Log::info('Verification URL generated', [
        //     'user_id' => $request->user()->id,
        //     'email' => $request->user()->email,
        //     'verification_url' => $verificationUrl,
        // ]);

        // Send the email verification notification
        $request->user()->sendEmailVerificationNotification();
        
        return back()->with('status', 'Verification link sent!');
    }
}
