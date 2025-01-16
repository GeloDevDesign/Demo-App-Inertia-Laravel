<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\User;
use Illuminate\Foundation\Auth\EmailVerificationRequest;


class EmailVerificationController extends Controller
{

    public function notice()
    {
        return Inertia::render('Auth/Verify',['status' => session('status')]);
    }

    public function handler(EmailVerificationRequest $request)
    {
        $request->fulfill();
        return redirect()->name('home');
    }

    public function resend(Request $request)
    {
        $request->user()->sendEmailVerificationNotification();
        return back()->with('status', 'Verification link sent!');
    }
}
