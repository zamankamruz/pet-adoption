<?php
// File: NewsletterController.php
// Path: /app/Http/Controllers/NewsletterController.php

namespace App\Http\Controllers;

use App\Models\NewsletterSubscriber;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class NewsletterController extends Controller
{
    public function subscribe(Request $request)
    {
        try {
            $request->validate([
                'email' => 'required|email|max:255',
            ]);

            // Check if email already exists
            $existingSubscriber = NewsletterSubscriber::where('email', $request->email)->first();

            if ($existingSubscriber) {
                if ($existingSubscriber->is_active) {
                    return response()->json([
                        'success' => false,
                        'message' => 'You are already subscribed to our newsletter!'
                    ], 422);
                } else {
                    // Reactivate if previously unsubscribed
                    $existingSubscriber->resubscribe();
                    return response()->json([
                        'success' => true,
                        'message' => 'Welcome back! You have been resubscribed to our newsletter.'
                    ]);
                }
            }

            // Create new subscriber
            NewsletterSubscriber::create([
                'email' => $request->email,
                'name' => $request->name ?? null,
                'is_active' => true,
                'unsubscribe_token' => Str::random(64),
                'subscribed_at' => now(),
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Thank you for subscribing! You will receive our latest updates.'
            ]);

        } catch (ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Please enter a valid email address.',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            \Log::error('Newsletter subscription error: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'message' => 'Sorry, something went wrong. Please try again later.'
            ], 500);
        }
    }

    public function unsubscribe($token)
    {
        $subscriber = NewsletterSubscriber::where('unsubscribe_token', $token)->first();

        if (!$subscriber) {
            abort(404, 'Invalid unsubscribe link');
        }

        if ($subscriber->is_active) {
            $subscriber->unsubscribe();
            $message = 'You have been successfully unsubscribed from our newsletter.';
        } else {
            $message = 'You are already unsubscribed from our newsletter.';
        }

        return view('newsletter.unsubscribed', compact('message'));
    }

    public function getSubscriberStats()
    {
        $stats = [
            'total' => NewsletterSubscriber::count(),
            'active' => NewsletterSubscriber::active()->count(),
            'inactive' => NewsletterSubscriber::inactive()->count(),
            'today' => NewsletterSubscriber::whereDate('subscribed_at', today())->count(),
            'this_week' => NewsletterSubscriber::whereBetween('subscribed_at', [now()->startOfWeek(), now()->endOfWeek()])->count(),
            'this_month' => NewsletterSubscriber::whereMonth('subscribed_at', now()->month)->count(),
        ];

        return response()->json($stats);
    }
}