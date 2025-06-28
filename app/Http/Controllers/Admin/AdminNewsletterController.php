<?php
// File: AdminNewsletterController.php
// Path: /app/Http/Controllers/Admin/AdminNewsletterController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\NewsletterSubscriber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\NewsletterBroadcastMail;

class AdminNewsletterController extends Controller
{

    public function index(Request $request)
    {
        $query = NewsletterSubscriber::query();

        // Apply filters
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('email', 'LIKE', "%{$search}%")
                  ->orWhere('name', 'LIKE', "%{$search}%");
            });
        }

        if ($request->filled('status')) {
            if ($request->status === 'active') {
                $query->where('is_active', true);
            } elseif ($request->status === 'inactive') {
                $query->where('is_active', false);
            }
        }

        if ($request->filled('date_from')) {
            $query->whereDate('subscribed_at', '>=', $request->date_from);
        }

        if ($request->filled('date_to')) {
            $query->whereDate('subscribed_at', '<=', $request->date_to);
        }

        // Sorting
        $sortBy = $request->get('sort', 'latest');
        switch ($sortBy) {
            case 'email':
                $query->orderBy('email');
                break;
            case 'oldest':
                $query->orderBy('subscribed_at');
                break;
            case 'name':
                $query->orderBy('name');
                break;
            default:
                $query->orderByDesc('subscribed_at');
        }

        $subscribers = $query->paginate(20)->withQueryString();

        // Get statistics
        $stats = [
            'total' => NewsletterSubscriber::count(),
            'active' => NewsletterSubscriber::where('is_active', true)->count(),
            'inactive' => NewsletterSubscriber::where('is_active', false)->count(),
            'today' => NewsletterSubscriber::whereDate('subscribed_at', today())->count(),
            'this_week' => NewsletterSubscriber::whereBetween('subscribed_at', [now()->startOfWeek(), now()->endOfWeek()])->count(),
            'this_month' => NewsletterSubscriber::whereMonth('subscribed_at', now()->month)->count(),
        ];

        return view('admin.newsletter.index', compact('subscribers', 'stats'));
    }

    public function show(NewsletterSubscriber $subscriber)
    {
        return view('admin.newsletter.show', compact('subscriber'));
    }

    public function create()
    {
        return view('admin.newsletter.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:newsletter_subscribers',
            'name' => 'nullable|string|max:255',
        ]);

        $subscriber = NewsletterSubscriber::create([
            'email' => $request->email,
            'name' => $request->name,
            'is_active' => true,
            'unsubscribe_token' => \Str::random(64),
            'subscribed_at' => now(),
        ]);

        return redirect()->route('admin.newsletter.index')
            ->with('success', 'Subscriber added successfully!');
    }

    public function edit(NewsletterSubscriber $subscriber)
    {
        return view('admin.newsletter.edit', compact('subscriber'));
    }

    public function update(Request $request, NewsletterSubscriber $subscriber)
    {
        $request->validate([
            'email' => 'required|email|unique:newsletter_subscribers,email,' . $subscriber->id,
            'name' => 'nullable|string|max:255',
            'is_active' => 'boolean',
        ]);

        $subscriber->update($request->all());

        return redirect()->route('admin.newsletter.show', $subscriber)
            ->with('success', 'Subscriber updated successfully!');
    }

    public function destroy(NewsletterSubscriber $subscriber)
    {
        $subscriber->delete();

        return redirect()->route('admin.newsletter.index')
            ->with('success', 'Subscriber deleted successfully!');
    }

    public function activate(NewsletterSubscriber $subscriber)
    {
        $subscriber->update([
            'is_active' => true,
            'unsubscribed_at' => null
        ]);

        return redirect()->back()
            ->with('success', 'Subscriber activated successfully!');
    }

    public function deactivate(NewsletterSubscriber $subscriber)
    {
        $subscriber->update([
            'is_active' => false,
            'unsubscribed_at' => now()
        ]);

        return redirect()->back()
            ->with('success', 'Subscriber deactivated successfully!');
    }

    public function bulkAction(Request $request)
    {
        $request->validate([
            'action' => 'required|in:activate,deactivate,delete',
            'subscriber_ids' => 'required|array',
            'subscriber_ids.*' => 'exists:newsletter_subscribers,id'
        ]);

        $subscribers = NewsletterSubscriber::whereIn('id', $request->subscriber_ids);
        $count = $subscribers->count();

        switch ($request->action) {
            case 'activate':
                $subscribers->update(['is_active' => true, 'unsubscribed_at' => null]);
                $message = "{$count} subscribers activated successfully";
                break;
                
            case 'deactivate':
                $subscribers->update(['is_active' => false, 'unsubscribed_at' => now()]);
                $message = "{$count} subscribers deactivated successfully";
                break;
                
            case 'delete':
                $subscribers->delete();
                $message = "{$count} subscribers deleted successfully";
                break;
        }

        return redirect()->back()->with('success', $message);
    }

    public function broadcast()
    {
        return view('admin.newsletter.broadcast');
    }

    public function sendBroadcast(Request $request)
    {
        $request->validate([
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
            'send_to' => 'required|in:all,active_only',
        ]);

        $query = NewsletterSubscriber::query();
        
        if ($request->send_to === 'active_only') {
            $query->where('is_active', true);
        }

        $subscribers = $query->get();

        if ($subscribers->isEmpty()) {
            return redirect()->back()
                ->with('error', 'No subscribers found to send the newsletter to.');
        }

        $sentCount = 0;
        $failedCount = 0;

        foreach ($subscribers as $subscriber) {
            try {
                Mail::to($subscriber->email)->send(new NewsletterBroadcastMail(
                    $request->subject,
                    $request->message,
                    $subscriber
                ));
                $sentCount++;
            } catch (\Exception $e) {
                \Log::error('Failed to send newsletter to ' . $subscriber->email . ': ' . $e->getMessage());
                $failedCount++;
            }
        }

        $message = "Newsletter sent successfully to {$sentCount} subscribers.";
        if ($failedCount > 0) {
            $message .= " {$failedCount} emails failed to send.";
        }

        return redirect()->route('admin.newsletter.index')
            ->with('success', $message);
    }

    public function export(Request $request)
    {
        $query = NewsletterSubscriber::query();

        // Apply same filters as index
        if ($request->filled('status')) {
            if ($request->status === 'active') {
                $query->where('is_active', true);
            } elseif ($request->status === 'inactive') {
                $query->where('is_active', false);
            }
        }

        $subscribers = $query->orderBy('email')->get();

        $csvData = [];
        $csvData[] = [
            'ID', 'Email', 'Name', 'Status', 'Subscribed Date', 'Unsubscribed Date'
        ];

        foreach ($subscribers as $subscriber) {
            $csvData[] = [
                $subscriber->id,
                $subscriber->email,
                $subscriber->name ?: 'N/A',
                $subscriber->is_active ? 'Active' : 'Inactive',
                $subscriber->subscribed_at->format('Y-m-d H:i:s'),
                $subscriber->unsubscribed_at ? $subscriber->unsubscribed_at->format('Y-m-d H:i:s') : 'N/A'
            ];
        }

        $filename = 'newsletter-subscribers-' . now()->format('Y-m-d-H-i-s') . '.csv';

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];

        $callback = function() use ($csvData) {
            $file = fopen('php://output', 'w');
            foreach ($csvData as $row) {
                fputcsv($file, $row);
            }
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function getStats()
    {
        $stats = [
            'total' => NewsletterSubscriber::count(),
            'active' => NewsletterSubscriber::where('is_active', true)->count(),
            'inactive' => NewsletterSubscriber::where('is_active', false)->count(),
            'today' => NewsletterSubscriber::whereDate('subscribed_at', today())->count(),
            'this_week' => NewsletterSubscriber::whereBetween('subscribed_at', [now()->startOfWeek(), now()->endOfWeek()])->count(),
            'this_month' => NewsletterSubscriber::whereMonth('subscribed_at', now()->month)->count(),
            'recent_subscribers' => NewsletterSubscriber::latest()->take(5)->get(),
        ];

        // Monthly subscription trends (last 12 months)
        $monthlyTrends = NewsletterSubscriber::where('subscribed_at', '>=', now()->subYear())
            ->selectRaw('MONTH(subscribed_at) as month, YEAR(subscribed_at) as year, COUNT(*) as count')
            ->groupBy('year', 'month')
            ->orderBy('year')
            ->orderBy('month')
            ->get();

        $stats['monthly_trends'] = $monthlyTrends;

        return response()->json($stats);
    }
}