<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Carbon\Carbon;

class ResetPasswordController extends Controller
{
    /**
     * Step 1: Request OTP (verify email & generate/send OTP)
     */
    public function requestOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ]);

        $user = User::where('email', $request->email)->firstOrFail();

        // Generate a 6-digit numeric OTP or an alphanumeric code of your choice
        $otp = rand(100000, 999999);
        // Alternatively: $otp = Str::upper(Str::random(6));

        // Set OTP expiration (e.g., 10 minutes from now)
        $expiry = Carbon::now()->addMinutes(10);

        // Store the OTP and expiration in the user record
        $user->otp = $otp;
        $user->otp_expires_at = $expiry;
        $user->save();

        // Send OTP via email (example using raw text email)
        Mail::raw("Your OTP is: {$otp}", function ($message) use ($user) {
            $message->to($user->email)
                ->subject('Your Password Reset OTP');
        });
        return back()->with('message', 'An OTP has been sent to your email.');
    }

    /**
     * Step 2: Verify the OTP
     */
    public function verifyOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'otp'   => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return response()->json([
                'message' => 'User not found.',
            ], 404);
        }

        // Check if the OTP matches and is not expired
        if (
            $user->otp === $request->otp &&
            Carbon::now()->lessThanOrEqualTo($user->otp_expires_at)
        ) {
            return response()->json([
                'message' => 'OTP verified successfully.',
            ]);
        }
        return back()->with('message', 'Invalid or expired OTP.');
      
    }

    /**
     * Step 3: Reset the password (using valid OTP)
     */
    public function resetPassword(Request $request)
    {
        $request->validate([
            'email'                => 'required|email|exists:users,email',
            'otp'                  => 'required',
            'password'             => 'required|min:8|confirmed',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return response()->json([
                'message' => 'User not found.',
            ], 404);
        }

       
        if (
            $user->otp !== $request->otp ||
            Carbon::now()->greaterThan($user->otp_expires_at)
        ) {
            return response()->json([
                'message' => 'Invalid or expired OTP.',
            ], 400);
        }

        // Update the user's password
        $user->password = Hash::make($request->password);

        // Optionally clear the OTP fields so they cannot be reused
        $user->otp = null;
        $user->otp_expires_at = null;
        $user->save();

        return response()->json([
            'message' => 'Password has been reset successfully.',
        ]);
    }
}
