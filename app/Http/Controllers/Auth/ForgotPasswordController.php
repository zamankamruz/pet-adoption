<?php
// File: ForgotPasswordController.php
// Path: /app/Http/Controllers/Auth/ForgotPasswordController.php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\ResetPasswordMail;

class ForgotPasswordController extends Controller
{
    use SendsPasswordResetEmails;

    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Display the form to request a password reset link.
     */
    public function showLinkRequestForm()
    {
        return view('auth.passwords.email');
    }

    /**
     * Send a reset link to the given user.
     */
    public function sendResetLinkEmail(Request $request)
    {
        $this->validateEmail($request);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            // Don't reveal if email exists or not for security
            return $this->sendResetLinkResponse($request, Password::RESET_LINK_SENT);
        }

        if (!$user->is_active) {
            return $this->sendResetLinkFailedResponse($request, 'Your account has been deactivated. Please contact support.');
        }

        // Generate and store reset token
        $token = \Str::random(64);
        
        \DB::table('password_reset_tokens')->updateOrInsert(
            ['email' => $request->email],
            [
                'token' => Hash::make($token),
                'created_at' => now()
            ]
        );

        // Send reset email
        try {
            Mail::to($user->email)->send(new ResetPasswordMail($user, $token));
            
            // Log password reset request
            \Log::info('Password reset requested', [
                'user_id' => $user->id,
                'email' => $user->email,
                'ip' => $request->ip(),
                'user_agent' => $request->userAgent()
            ]);

            return $this->sendResetLinkResponse($request, Password::RESET_LINK_SENT);
            
        } catch (\Exception $e) {
            \Log::error('Failed to send password reset email: ' . $e->getMessage());
            
            return $this->sendResetLinkFailedResponse($request, 'Failed to send reset email. Please try again.');
        }
    }

    /**
     * Validate the email for the given request.
     */
    protected function validateEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email'
        ], [
            'email.required' => 'Please enter your email address.',
            'email.email' => 'Please enter a valid email address.',
        ]);
    }

    /**
     * Get the response for a successful password reset link.
     */
    protected function sendResetLinkResponse(Request $request, $response)
    {
        if ($request->wantsJson()) {
            return response()->json([
                'message' => 'If an account with that email exists, we have sent a password reset link.'
            ]);
        }

        return back()->with('status', trans($response));
    }

    /**
     * Get the response for a failed password reset link.
     */
    protected function sendResetLinkFailedResponse(Request $request, $response)
    {
        if ($request->wantsJson()) {
            return response()->json([
                'message' => 'Failed to send reset link.',
                'errors' => ['email' => [trans($response)]]
            ], 422);
        }

        return back()
            ->withInput($request->only('email'))
            ->withErrors(['email' => trans($response)]);
    }

    /**
     * Get the broker to be used during password reset.
     */
    public function broker()
    {
        return Password::broker();
    }

    /**
     * Check if reset token is valid.
     */
    public function validateToken(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email'
        ]);

        $resetRecord = \DB::table('password_reset_tokens')
            ->where('email', $request->email)
            ->first();

        if (!$resetRecord) {
            return response()->json(['valid' => false, 'message' => 'Invalid reset token'], 422);
        }

        if (!Hash::check($request->token, $resetRecord->token)) {
            return response()->json(['valid' => false, 'message' => 'Invalid reset token'], 422);
        }

        // Check if token is expired (24 hours)
        if (now()->diffInHours($resetRecord->created_at) > 24) {
            return response()->json(['valid' => false, 'message' => 'Reset token has expired'], 422);
        }

        return response()->json(['valid' => true]);
    }

    /**
     * Resend reset link.
     */
    public function resendResetLink(Request $request)
    {
        $this->validateEmail($request);

        // Check rate limiting
        $key = 'reset_link_' . $request->ip() . '_' . $request->email;
        $attempts = \Cache::get($key, 0);

        if ($attempts >= 3) {
            return response()->json([
                'message' => 'Too many reset attempts. Please try again later.'
            ], 429);
        }

        \Cache::put($key, $attempts + 1, now()->addHour());

        return $this->sendResetLinkEmail($request);
    }

    /**
     * Clean up expired reset tokens.
     */
    public function cleanupExpiredTokens()
    {
        \DB::table('password_reset_tokens')
            ->where('created_at', '<', now()->subDay())
            ->delete();

        return response()->json(['message' => 'Expired tokens cleaned up']);
    }
}