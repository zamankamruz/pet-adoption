<?php
// File: RegisterController.php
// Path: /app/Http/Controllers/Auth/RegisterController.php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Mail;
use App\Mail\WelcomeMail;
use App\Notifications\WelcomeNotification;

class RegisterController extends Controller
{
    use RegistersUsers;

    /**
     * Where to redirect users after registration.
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
     * Show the application registration form.
     */
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    /**
     * Handle a registration request for the application.
     */
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));

        $this->guard()->login($user);

        if ($response = $this->registered($request, $user)) {
            return $response;
        }

        if ($request->wantsJson()) {
            return response()->json([
                'message' => 'Registration successful',
                'user' => $user,
                'redirect' => $this->redirectPath()
            ], 201);
        }

        return redirect($this->redirectPath());
    }

    /**
     * Get a validator for an incoming registration request.
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'phone' => ['nullable', 'string', 'max:20'],
            'address' => ['nullable', 'string', 'max:500'],
            'city' => ['nullable', 'string', 'max:100'],
            'state' => ['nullable', 'string', 'max:100'],
            'zip_code' => ['nullable', 'string', 'max:10'],
            'terms' => ['required', 'accepted'],
            'marketing_emails' => ['boolean'],
        ], [
            'terms.required' => 'You must agree to the Terms and Conditions.',
            'terms.accepted' => 'You must agree to the Terms and Conditions.',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     */
    protected function create(array $data)
    {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'phone' => $data['phone'] ?? null,
            'address' => $data['address'] ?? null,
            'city' => $data['city'] ?? null,
            'state' => $data['state'] ?? null,
            'zip_code' => $data['zip_code'] ?? null,
            'preferences' => [
                'marketing_emails' => $data['marketing_emails'] ?? false,
                'newsletter' => true,
                'adoption_alerts' => true,
            ],
        ]);

        // Send welcome notification
        try {
            $user->notify(new WelcomeNotification());
            Mail::to($user->email)->send(new WelcomeMail($user));
        } catch (\Exception $e) {
            \Log::error('Failed to send welcome email: ' . $e->getMessage());
        }

        return $user;
    }

    /**
     * The user has been registered.
     */
    protected function registered(Request $request, $user)
    {
        // Send email verification if required
        if (!$user->hasVerifiedEmail()) {
            $user->sendEmailVerificationNotification();
        }

        // Log user registration
        \Log::info('New user registered', [
            'user_id' => $user->id,
            'email' => $user->email,
            'ip' => $request->ip(),
            'user_agent' => $request->userAgent()
        ]);

        return null;
    }

    /**
     * Get the guard to be used during registration.
     */
    protected function guard()
    {
        return \Auth::guard();
    }

    /**
     * Get the post-registration redirect path.
     */
    public function redirectPath()
    {
        if (method_exists($this, 'redirectTo')) {
            return $this->redirectTo();
        }

        return property_exists($this, 'redirectTo') ? $this->redirectTo : '/dashboard';
    }

    /**
     * Check if email is available.
     */
    public function checkEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email'
        ]);

        $exists = User::where('email', $request->email)->exists();

        return response()->json([
            'available' => !$exists,
            'message' => $exists ? 'Email is already taken' : 'Email is available'
        ]);
    }

    /**
     * Validate registration step by step (for multi-step forms).
     */
    public function validateStep(Request $request)
    {
        $step = $request->get('step', 1);

        switch ($step) {
            case 1:
                $rules = [
                    'name' => 'required|string|max:255',
                    'email' => 'required|string|email|max:255|unique:users',
                ];
                break;
            case 2:
                $rules = [
                    'password' => 'required|string|min:8|confirmed',
                ];
                break;
            case 3:
                $rules = [
                    'phone' => 'nullable|string|max:20',
                    'address' => 'nullable|string|max:500',
                    'city' => 'nullable|string|max:100',
                    'state' => 'nullable|string|max:100',
                    'zip_code' => 'nullable|string|max:10',
                ];
                break;
            default:
                return response()->json(['message' => 'Invalid step'], 400);
        }

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'valid' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        return response()->json(['valid' => true]);
    }

    /**
     * Quick registration (minimal required fields).
     */
    public function quickRegister(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

        if ($validator->fails()) {
            if ($request->wantsJson()) {
                return response()->json([
                    'message' => 'Validation failed',
                    'errors' => $validator->errors()
                ], 422);
            }

            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));
        $this->guard()->login($user);

        // Send welcome notification
        try {
            $user->notify(new WelcomeNotification());
        } catch (\Exception $e) {
            \Log::error('Failed to send welcome notification: ' . $e->getMessage());
        }

        if ($request->wantsJson()) {
            return response()->json([
                'message' => 'Registration successful',
                'user' => $user,
                'redirect' => $this->redirectPath()
            ], 201);
        }

        return redirect($this->redirectPath())
            ->with('success', 'Welcome to Furry Friends! Your account has been created successfully.');
    }
}