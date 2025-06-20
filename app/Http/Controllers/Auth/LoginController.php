<?php
// File: LoginController.php
// Path: /app/Http/Controllers/Auth/LoginController.php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Laravel\Socialite\Facades\Socialite;

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

        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        if (method_exists($this, 'hasTooManyLoginAttempts') &&
            $this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

        if ($this->attemptLogin($request)) {
            if ($request->hasSession()) {
                $request->session()->put('auth.password_confirmed_at', time());
            }

            return $this->sendLoginResponse($request);
        }

        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        $this->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse($request);
    }

    /**
     * Validate the user login request.
     */
    protected function validateLogin(Request $request)
    {
        $request->validate([
            $this->username() => 'required|string',
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
        
        // Check if user is active
        $user = User::where($this->username(), $credentials[$this->username()])->first();
        
        if ($user && !$user->is_active) {
            throw ValidationException::withMessages([
                $this->username() => ['Your account has been deactivated. Please contact support.'],
            ]);
        }

        $attempt = $this->guard()->attempt(
            $credentials, $request->boolean('remember')
        );

        if ($attempt) {
            // Update last login timestamp
            $user = $this->guard()->user();
            $user->update(['last_login_at' => now()]);
        }

        return $attempt;
    }

    /**
     * Get the needed authorization credentials from the request.
     */
    protected function credentials(Request $request)
    {
        return $request->only($this->username(), 'password');
    }

    /**
     * Get the login username to be used by the controller.
     */
    public function username()
    {
        return 'email';
    }

    /**
     * Send the response after the user was authenticated.
     */
    protected function sendLoginResponse(Request $request)
    {
        $request->session()->regenerate();

        $this->clearLoginAttempts($request);

        if ($response = $this->authenticated($request, $this->guard()->user())) {
            return $response;
        }

        if ($request->wantsJson()) {
            return response()->json([
                'message' => 'Login successful',
                'user' => $this->guard()->user(),
                'redirect' => $this->redirectPath()
            ]);
        }

        return redirect()->intended($this->redirectPath());
    }

    /**
     * The user has been authenticated.
     */
    protected function authenticated(Request $request, $user)
    {
        // Add any post-login logic here
        return null;
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
                    $this->username() => [trans('auth.failed')]
                ]
            ], 422);
        }

        throw ValidationException::withMessages([
            $this->username() => [trans('auth.failed')],
        ]);
    }

    /**
     * Log the user out of the application.
     */
    public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        if ($response = $this->loggedOut($request)) {
            return $response;
        }

        if ($request->wantsJson()) {
            return response()->json(['message' => 'Logged out successfully']);
        }

        return redirect('/');
    }

    /**
     * The user has logged out of the application.
     */
    protected function loggedOut(Request $request)
    {
        return null;
    }

    /**
     * Get the guard to be used during authentication.
     */
    protected function guard()
    {
        return Auth::guard();
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
        $token = \Str::random(64);
        
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

    /**
     * Redirect to Google OAuth.
     */
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Handle Google OAuth callback.
     */
    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();
            
            $user = User::where('email', $googleUser->email)->first();

            if ($user) {
                // User exists, log them in
                Auth::login($user);
                $user->update(['last_login_at' => now()]);
            } else {
                // Create new user
                $user = User::create([
                    'name' => $googleUser->name,
                    'email' => $googleUser->email,
                    'email_verified_at' => now(),
                    'password' => Hash::make(\Str::random(24)),
                    'avatar' => $googleUser->avatar,
                ]);

                Auth::login($user);
            }

            return redirect()->intended($this->redirectPath());
            
        } catch (\Exception $e) {
            return redirect()->route('login')
                ->with('error', 'Google authentication failed. Please try again.');
        }
    }

    /**
     * Redirect to Facebook OAuth.
     */
    public function redirectToFacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }

    /**
     * Handle Facebook OAuth callback.
     */
    public function handleFacebookCallback()
    {
        try {
            $facebookUser = Socialite::driver('facebook')->user();
            
            $user = User::where('email', $facebookUser->email)->first();

            if ($user) {
                // User exists, log them in
                Auth::login($user);
                $user->update(['last_login_at' => now()]);
            } else {
                // Create new user
                $user = User::create([
                    'name' => $facebookUser->name,
                    'email' => $facebookUser->email,
                    'email_verified_at' => now(),
                    'password' => Hash::make(\Str::random(24)),
                    'avatar' => $facebookUser->avatar,
                ]);

                Auth::login($user);
            }

            return redirect()->intended($this->redirectPath());
            
        } catch (\Exception $e) {
            return redirect()->route('login')
                ->with('error', 'Facebook authentication failed. Please try again.');
        }
    }

    /**
     * Get the post-login redirect path.
     */
    public function redirectPath()
    {
        if (method_exists($this, 'redirectTo')) {
            return $this->redirectTo();
        }

        // Redirect admin users to admin dashboard
        if (Auth::user() && Auth::user()->is_admin) {
            return '/admin';
        }

        return property_exists($this, 'redirectTo') ? $this->redirectTo : '/dashboard';
    }
}