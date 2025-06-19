<?php
// File: ContactController.php
// Path: /app/Http/Controllers/ContactController.php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Http\Requests\ContactRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactFormMail;

class ContactController extends Controller
{
    public function index()
    {
        return view('contact.index');
    }

    public function store(ContactRequest $request)
    {
        $validated = $request->validated();
        
        // Add additional data
        $validated['user_id'] = auth()->id();
        $validated['ip_address'] = $request->ip();
        $validated['status'] = 'pending';

        $contact = Contact::create($validated);

        // Send email notification to admin
        try {
            Mail::to(config('mail.admin_email', 'admin@furryfriends.com'))
                ->send(new ContactFormMail($contact));
        } catch (\Exception $e) {
            \Log::error('Failed to send contact form email: ' . $e->getMessage());
        }

        // Send auto-reply to user
        if ($contact->email) {
            try {
                Mail::to($contact->email)->send(new ContactFormAutoReplyMail($contact));
            } catch (\Exception $e) {
                \Log::error('Failed to send contact form auto-reply: ' . $e->getMessage());
            }
        }

        if ($request->ajax()) {
            return response()->json([
                'message' => 'Thank you for your message! We will get back to you soon.',
                'contact_id' => $contact->id
            ]);
        }

        return redirect()->route('contact')
            ->with('success', 'Thank you for your message! We will get back to you soon.');
    }

    public function show(Contact $contact)
    {
        // Only admin or the contact creator can view
        if (!auth()->user()->is_admin && $contact->user_id !== auth()->id()) {
            abort(403);
        }

        return view('contact.show', compact('contact'));
    }

    public function update(Request $request, Contact $contact)
    {
        // Only admin can update
        if (!auth()->user()->is_admin) {
            abort(403);
        }

        $validated = $request->validate([
            'status' => 'required|in:pending,responded,closed',
            'admin_response' => 'nullable|string|max:2000'
        ]);

        if ($request->filled('admin_response') && $contact->status === 'pending') {
            $validated['status'] = 'responded';
            $validated['responded_at'] = now();
        }

        $contact->update($validated);

        // Send response email to user if admin response is provided
        if ($request->filled('admin_response') && $contact->email) {
            try {
                Mail::to($contact->email)->send(new ContactResponseMail($contact));
            } catch (\Exception $e) {
                \Log::error('Failed to send contact response email: ' . $e->getMessage());
            }
        }

        return redirect()->route('admin.contacts.show', $contact)
            ->with('success', 'Contact updated successfully!');
    }

    public function destroy(Contact $contact)
    {
        // Only admin can delete
        if (!auth()->user()->is_admin) {
            abort(403);
        }

        $contact->delete();

        return redirect()->route('admin.contacts.index')
            ->with('success', 'Contact deleted successfully!');
    }

    public function bulkAction(Request $request)
    {
        // Only admin can perform bulk actions
        if (!auth()->user()->is_admin) {
            abort(403);
        }

        $request->validate([
            'action' => 'required|in:delete,mark_responded,mark_closed',
            'contact_ids' => 'required|array',
            'contact_ids.*' => 'exists:contacts,id'
        ]);

        $contacts = Contact::whereIn('id', $request->contact_ids);

        switch ($request->action) {
            case 'delete':
                $count = $contacts->count();
                $contacts->delete();
                $message = "{$count} contacts deleted successfully";
                break;
                
            case 'mark_responded':
                $count = $contacts->update(['status' => 'responded', 'responded_at' => now()]);
                $message = "{$count} contacts marked as responded";
                break;
                
            case 'mark_closed':
                $count = $contacts->update(['status' => 'closed']);
                $message = "{$count} contacts marked as closed";
                break;
        }

        if ($request->ajax()) {
            return response()->json(['message' => $message]);
        }

        return redirect()->back()->with('success', $message);
    }

    public function getContactStats()
    {
        $stats = [
            'total' => Contact::count(),
            'pending' => Contact::where('status', 'pending')->count(),
            'responded' => Contact::where('status', 'responded')->count(),
            'closed' => Contact::where('status', 'closed')->count(),
            'today' => Contact::whereDate('created_at', today())->count(),
            'this_week' => Contact::whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])->count(),
            'this_month' => Contact::whereMonth('created_at', now()->month)->count(),
        ];

        return response()->json($stats);
    }

    public function exportContacts(Request $request)
    {
        // Only admin can export
        if (!auth()->user()->is_admin) {
            abort(403);
        }

        $query = Contact::query();

        // Apply filters
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('date_from')) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }

        if ($request->filled('date_to')) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }

        $contacts = $query->orderBy('created_at', 'desc')->get();

        $csvData = [];
        $csvData[] = [
            'ID', 'Name', 'Email', 'Phone', 'Subject', 'Message', 
            'Status', 'Created At', 'Responded At', 'Admin Response'
        ];

        foreach ($contacts as $contact) {
            $csvData[] = [
                $contact->id,
                $contact->name,
                $contact->email,
                $contact->phone,
                $contact->subject,
                $contact->message,
                $contact->status,
                $contact->created_at->format('Y-m-d H:i:s'),
                $contact->responded_at ? $contact->responded_at->format('Y-m-d H:i:s') : '',
                $contact->admin_response
            ];
        }

        $filename = 'contacts-export-' . now()->format('Y-m-d-H-i-s') . '.csv';

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
}