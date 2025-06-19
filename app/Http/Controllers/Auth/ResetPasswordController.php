<?php
// File: ResetPasswordController.php
// Path: /app/Http/Controllers/Auth/ResetPasswordController.php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules\Password as PasswordRule;

class ResetPasswordController extends Controller
{
    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     */
    protected $redirectTo = '/dashboard';

    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Display the password reset view for the given token.
     */
    public function showResetForm(Request $request, $token = null)
    {
        return view('auth.passwords.reset')->with([
            'token' => $token,
            'email' => $request->email
        ]);
    }

    /**
     * Reset the given user's password.
     */
    public function reset(Request $request)
    {
        $this->validate($request, $this->rules(), $this->validationErrorMessages());

        // Validate token manually
        $resetRecord = \DB::table('password_reset_tokens')
            ->where('email', $request->email)
            ->first();

        if (!$resetRecord || !Hash::check($request->token, $resetRecord->token)) {
            return $this->sendResetFailedResponse($request, 'Invalid reset token');
        }

        // Check if token is expired (24 hours)
        if (now()->diffInHours($resetRecord->created_at) > 24) {
            return $this->sendResetFailedResponse($request, 'Reset token has expired');
        }

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return $this->sendResetFailedResponse($request, 'User not found');
        }

        if (!$user->is_active) {
            return $this->sendResetFailedResponse($request, 'Your account has been deactivated');
        }

        // Reset the password
        $this->resetPassword($user, $request->password);

        // Delete the reset token
        \DB::table('password_reset_tokens')->where('email', $request->email)->delete();

        return $this->sendResetResponse($request, Password::PASSWORD_RESET);
    }

    /**
     * Get the password reset validation rules.
     */
    protected function rules()
    {
        return [
            'token' => 'required',
            'email' => 'required|email',
            'password' => ['required', 'confirmed', PasswordRule::defaults()],
        ];
    }

    /**
     * Get the password reset validation error messages.
     */
    protected function validationErrorMessages()
    {
        return [
            'password.required' => 'Please enter a new password.',
            'password.confirmed' => 'Password confirmation does not match.',
            'password.min' => 'Password must be at least 8 characters.',
            'email.required' => 'Email address is required.',
            'email.email' => 'Please enter a valid email address.',
            'token.required' => 'Reset token is required.',
        ];
    }

    /**
     * Reset the given user's password.
     */
    protected function resetPassword($user, $password)
    {
        $this->setUserPassword($user, $password);

        $user->setRememberToken(Str::random(60));
        $user->save();

        event(new PasswordReset($user));

        // Log password reset
        \Log::info('Password reset completed', [
            'user_id' => $user->id,
            'email' => $user->email,
            'ip' => request()->ip(),
            'user_agent' => request()->userAgent()
        ]);

        $this->guard()->login($user);
    }

    /**
     * Set the user's password.
     */
    protected function setUserPassword($user, $password)
    {
        $user->password = Hash::make($password);
    }

    /**
     * Get the response for a successful password reset.
     */
    protected function sendResetResponse(Request $request, $response)
    {
        if ($request->wantsJson()) {
            return response()->json([
                'message' => 'Password reset successfully',
                'redirect' => $this->redirectPath()
            ]);
        }

        return redirect($this->redirectPath())
            ->with('status', trans($response));
    }

    /**
     * Get the response for a failed password reset.
     */
    protected function sendResetFailedResponse(Request $request, $response)
    {
        if ($request->wantsJson()) {
            return response()->json([
                'message' => 'Password reset failed',
                'errors' => ['email' => [trans($response)]]
            ], 422);
        }

        return redirect()->back()
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
     * Get the guard to be used during password reset.
     */
    protected function guard()
    {
        return \Auth::guard();
    }

    /**
     * Get the password reset credentials from the request.
     */
    protected function credentials(Request $request)
    {
        return $request->only(
            'email', 'password', 'password_confirmation', 'token'
        );
    }

    /**
     * Validate password strength.
     */
    public function validatePasswordStrength(Request $request)
    {
        $request->validate([
            'password' => ['required', PasswordRule::defaults()]
        ]);

        $password = $request->password;
        $strength = 0;
        $feedback = [];

        // Check length
        if (strlen($password) >= 8) {
            $strength += 25;
        } else {
            $feedback[] = 'Use at least 8 characters';
        }

        // Check for lowercase
        if (preg_match('/[a-z]/', $password)) {
            $strength += 25;
        } else {
            $feedback[] = 'Include lowercase letters';
        }

        // Check for uppercase
        if (preg_match('/[A-Z]/', $password)) {
            $strength += 25;
        } else {
            $feedback[] = 'Include uppercase letters';
        }

        // Check for numbers
        if (preg_match('/\d/', $password)) {
            $strength += 25;
        } else {
            $feedback[] = 'Include numbers';
        }

        // Check for special characters
        if (preg_match('/[^a-zA-Z\d]/', $password)) {
            $strength += 25;
        } else {
            $feedback[] = 'Include special characters';
        }

        return response()->json([
            'strength' => min($strength, 100),
            'feedback' => $feedback,
            'level' => $this->getStrengthLevel($strength)
        ]);
    }

    /**
     * Get password strength level.
     */
    private function getStrengthLevel($strength)
    {
        if ($strength < 50) return 'weak';
        if ($strength < 75) return 'fair';
        if ($strength < 100) return 'good';
        return 'strong';
    }

    /**
     * Change password for authenticated user.
     */
    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password' => ['required', 'confirmed', PasswordRule::defaults()],
        ]);

        $user = auth()->user();

        if (!Hash::check($request->current_password, $user->password)) {
            return response()->json([
                'message' => 'Current password is incorrect',
                'errors' => ['current_password' => ['Current password is incorrect']]
            ], 422);
        }

        $user->update(['password' => Hash::make($request->password)]);

        // Log password change
        \Log::info('Password changed', [
            'user_id' => $user->id,
            'ip' => $request->ip(),
            'user_agent' => $request->userAgent()
        ]);

        return response()->json(['message' => 'Password changed successfully']);
    }
}