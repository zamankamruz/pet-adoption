<?php
// File: LoginController.php
// Path: /app/Http/Controllers/Auth/LoginController.php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    /**
     * Where to redirect users after login.
     */
    protected $redirectTo = '/dashboard';

    /**
     * Create a new controller instance.
     */

    /**
     * Show the application's login form.
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Handle a login request to the application.
     */
    public function login(Request $request)
    {
        $this->validateLogin($request);

        // Check for too many login attempts
        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);
            return $this->sendLockoutResponse($request);
        }

        if ($this->attemptLogin($request)) {
            $request->session()->regenerate();
            $this->clearLoginAttempts($request);

            return $this->sendLoginResponse($request);
        }

        // Increment login attempts
        $this->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse($request);
    }

    /**
     * Validate the user login request.
     */
    protected function validateLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
            'remember' => 'boolean',
        ]);
    }

    /**
     * Attempt to log the user into the application.
     */
    protected function attemptLogin(Request $request)
    {
        $credentials = $this->credentials($request);
        
        // Check if user exists and is active
        $user = User::where('email', $credentials['email'])->first();
        
        if ($user && isset($user->is_active) && !$user->is_active) {
            throw ValidationException::withMessages([
                'email' => ['Your account has been deactivated. Please contact support.'],
            ]);
        }

        $attempt = Auth::attempt($credentials, $request->boolean('remember'));

        if ($attempt && $user) {
            // Update last login timestamp if column exists
            if ($user->getConnection()->getSchemaBuilder()->hasColumn('users', 'last_login_at')) {
                $user->update(['last_login_at' => now()]);
            }
        }

        return $attempt;
    }

    /**
     * Get the needed authorization credentials from the request.
     */
    protected function credentials(Request $request)
    {
        return $request->only('email', 'password');
    }

    /**
     * Send the response after the user was authenticated.
     */
    protected function sendLoginResponse(Request $request)
    {
        if ($request->wantsJson()) {
            return response()->json([
                'message' => 'Login successful',
                'user' => Auth::user(),
                'redirect' => $this->redirectPath()
            ]);
        }

        return redirect()->intended($this->redirectPath());
    }

    /**
     * Get the failed login response instance.
     */
    protected function sendFailedLoginResponse(Request $request)
    {
        if ($request->wantsJson()) {
            return response()->json([
                'message' => 'Invalid credentials',
                'errors' => [
                    'email' => ['These credentials do not match our records.']
                ]
            ], 422);
        }

        throw ValidationException::withMessages([
            'email' => ['These credentials do not match our records.'],
        ]);
    }

    /**
     * Determine if the user has too many failed login attempts.
     */
    protected function hasTooManyLoginAttempts(Request $request)
    {
        return RateLimiter::tooManyAttempts(
            $this->throttleKey($request), 5 // 5 attempts
        );
    }

    /**
     * Increment the login attempts for the user.
     */
    protected function incrementLoginAttempts(Request $request)
    {
        RateLimiter::hit(
            $this->throttleKey($request), 60 // 60 seconds
        );
    }

    /**
     * Clear the login locks for the given user credentials.
     */
    protected function clearLoginAttempts(Request $request)
    {
        RateLimiter::clear($this->throttleKey($request));
    }

    /**
     * Get the throttle key for the given request.
     */
    protected function throttleKey(Request $request)
    {
        return Str::lower($request->input('email')).'|'.$request->ip();
    }

    /**
     * Fire the lockout event.
     */
    protected function fireLockoutEvent(Request $request)
    {
        // You can implement event firing here if needed
    }

    /**
     * Get the response for too many login attempts.
     */
    protected function sendLockoutResponse(Request $request)
    {
        $seconds = RateLimiter::availableIn($this->throttleKey($request));

        if ($request->wantsJson()) {
            return response()->json([
                'message' => 'Too many login attempts.',
                'retry_after' => $seconds
            ], 429);
        }

        throw ValidationException::withMessages([
            'email' => ["Too many login attempts. Please try again in {$seconds} seconds."],
        ]);
    }

    /**
     * Log the user out of the application.
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        if ($request->wantsJson()) {
            return response()->json(['message' => 'Logged out successfully']);
        }

        return redirect('/');
    }

    /**
     * Get the post-login redirect path.
     */
    public function redirectPath()
    {
        // Check if user is authenticated and get their role
        if (Auth::check()) {
            $user = Auth::user();
            
            // Redirect admin users to admin dashboard
            if ($user->is_admin) {
                return route('admin.dashboard');
            }
            
            // Redirect regular users to user dashboard
            return route('dashboard');
        }

        // Default fallback
        return '/';
    }


    /**
     * Show forgot password form.
     */
    public function showForgotPasswordForm()
    {
        return view('auth.forgot-password');
    }

    /**
     * Send reset link email.
     */
    public function sendResetLinkEmail(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            if ($request->wantsJson()) {
                return response()->json([
                    'message' => 'If an account with that email exists, we have sent a password reset link.',
                ]);
            }

            return back()->with('status', 'If an account with that email exists, we have sent a password reset link.');
        }

        // Generate reset token
        $token = Str::random(64);
        
        \DB::table('password_reset_tokens')->updateOrInsert(
            ['email' => $request->email],
            [
                'token' => Hash::make($token),
                'created_at' => now()
            ]
        );

        // Send email with reset link
        try {
            \Mail::to($user->email)->send(new \App\Mail\ResetPasswordMail($user, $token));
        } catch (\Exception $e) {
            \Log::error('Failed to send password reset email: ' . $e->getMessage());
            
            if ($request->wantsJson()) {
                return response()->json(['message' => 'Failed to send reset email'], 500);
            }
            
            return back()->withErrors(['email' => 'Failed to send reset email. Please try again.']);
        }

        if ($request->wantsJson()) {
            return response()->json([
                'message' => 'Password reset link sent to your email.',
            ]);
        }

        return back()->with('status', 'Password reset link sent to your email.');
    }

    /**
     * Show reset password form.
     */
    public function showResetPasswordForm($token)
    {
        return view('auth.reset-password', ['token' => $token]);
    }

    /**
     * Reset password.
     */
    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);

        $resetRecord = \DB::table('password_reset_tokens')
            ->where('email', $request->email)
            ->first();

        if (!$resetRecord || !Hash::check($request->token, $resetRecord->token)) {
            if ($request->wantsJson()) {
                return response()->json(['message' => 'Invalid reset token'], 422);
            }
            
            return back()->withErrors(['email' => 'Invalid reset token']);
        }

        // Check if token is expired (24 hours)
        if (now()->diffInHours($resetRecord->created_at) > 24) {
            if ($request->wantsJson()) {
                return response()->json(['message' => 'Reset token has expired'], 422);
            }
            
            return back()->withErrors(['email' => 'Reset token has expired']);
        }

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            if ($request->wantsJson()) {
                return response()->json(['message' => 'User not found'], 404);
            }
            
            return back()->withErrors(['email' => 'User not found']);
        }

        // Update password
        $user->update(['password' => Hash::make($request->password)]);

        // Delete reset token
        \DB::table('password_reset_tokens')->where('email', $request->email)->delete();

        if ($request->wantsJson()) {
            return response()->json(['message' => 'Password reset successfully']);
        }

        return redirect()->route('login')->with('status', 'Password reset successfully. You can now login.');
    }
}