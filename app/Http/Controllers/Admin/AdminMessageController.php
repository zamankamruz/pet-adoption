<?php
// File: AdminMessageController.php
// Path: /app/Http/Controllers/Admin/AdminMessageController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminMessageController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'admin']);
    }

    public function index(Request $request)
    {
        $query = Message::with(['sender', 'receiver', 'pet']);

        // Apply filters
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('subject', 'LIKE', "%{$search}%")
                  ->orWhere('body', 'LIKE', "%{$search}%")
                  ->orWhereHas('sender', function($userQuery) use ($search) {
                      $userQuery->where('name', 'LIKE', "%{$search}%")
                               ->orWhere('email', 'LIKE', "%{$search}%");
                  })
                  ->orWhereHas('receiver', function($userQuery) use ($search) {
                      $userQuery->where('name', 'LIKE', "%{$search}%")
                               ->orWhere('email', 'LIKE', "%{$search}%");
                  });
            });
        }

        if ($request->filled('sender_id')) {
            $query->where('sender_id', $request->sender_id);
        }

        if ($request->filled('receiver_id')) {
            $query->where('receiver_id', $request->receiver_id);
        }

        if ($request->filled('is_read')) {
            $query->where('is_read', $request->is_read);
        }

        if ($request->filled('date_from')) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }

        if ($request->filled('date_to')) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }

        if ($request->filled('conversation_id')) {
            $query->where('conversation_id', $request->conversation_id);
        }

        // Sorting
        $sortBy = $request->get('sort', 'latest');
        switch ($sortBy) {
            case 'oldest':
                $query->orderBy('created_at');
                break;
            case 'sender':
                $query->join('users as senders', 'messages.sender_id', '=', 'senders.id')
                      ->orderBy('senders.name');
                break;
            case 'unread':
                $query->orderBy('is_read')->orderByDesc('created_at');
                break;
            default:
                $query->orderByDesc('created_at');
        }

        $messages = $query->paginate(20)->withQueryString();

        // Get filter options
        $senders = User::whereIn('id', Message::distinct()->pluck('sender_id'))
                       ->orderBy('name')
                       ->get();

        $receivers = User::whereIn('id', Message::distinct()->pluck('receiver_id'))
                         ->orderBy('name')
                         ->get();

        // Get message statistics
        $stats = [
            'total' => Message::count(),
            'unread' => Message::where('is_read', false)->count(),
            'today' => Message::whereDate('created_at', today())->count(),
            'this_week' => Message::whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])->count(),
            'this_month' => Message::whereMonth('created_at', now()->month)->count(),
        ];

        return view('admin.messages.index', compact('messages', 'senders', 'receivers', 'stats'));
    }

    public function show(Message $message)
    {
        $message->load(['sender', 'receiver', 'pet']);

        // Get conversation messages
        $conversationMessages = Message::where('conversation_id', $message->conversation_id)
            ->with(['sender', 'receiver'])
            ->orderBy('created_at')
            ->get();

        // Mark as read if unread
        if (!$message->is_read) {
            $message->update(['is_read' => true, 'read_at' => now()]);
        }

        return view('admin.messages.show', compact('message', 'conversationMessages'));
    }

    public function destroy(Message $message)
    {
        $message->delete();

        if (request()->ajax()) {
            return response()->json(['message' => 'Message deleted successfully']);
        }

        return redirect()->route('admin.messages.index')
            ->with('success', 'Message deleted successfully!');
    }

    public function markAsRead(Message $message)
    {
        $message->update([
            'is_read' => true,
            'read_at' => now()
        ]);

        if (request()->ajax()) {
            return response()->json(['message' => 'Message marked as read']);
        }

        return redirect()->back()
            ->with('success', 'Message marked as read!');
    }

    public function markAsUnread(Message $message)
    {
        $message->update([
            'is_read' => false,
            'read_at' => null
        ]);

        if (request()->ajax()) {
            return response()->json(['message' => 'Message marked as unread']);
        }

        return redirect()->back()
            ->with('success', 'Message marked as unread!');
    }

    public function bulkAction(Request $request)
    {
        $request->validate([
            'action' => 'required|in:delete,mark_read,mark_unread',
            'message_ids' => 'required|array',
            'message_ids.*' => 'exists:messages,id'
        ]);

        $messages = Message::whereIn('id', $request->message_ids);
        $count = $messages->count();

        switch ($request->action) {
            case 'delete':
                $messages->delete();
                $message = "{$count} messages deleted successfully";
                break;
                
            case 'mark_read':
                $messages->update(['is_read' => true, 'read_at' => now()]);
                $message = "{$count} messages marked as read";
                break;
                
            case 'mark_unread':
                $messages->update(['is_read' => false, 'read_at' => null]);
                $message = "{$count} messages marked as unread";
                break;
        }

        if ($request->ajax()) {
            return response()->json(['message' => $message]);
        }

        return redirect()->back()->with('success', $message);
    }

    public function export(Request $request)
    {
        $query = Message::with(['sender', 'receiver']);

        // Apply same filters as index
        if ($request->filled('sender_id')) {
            $query->where('sender_id', $request->sender_id);
        }

        if ($request->filled('receiver_id')) {
            $query->where('receiver_id', $request->receiver_id);
        }

        if ($request->filled('is_read')) {
            $query->where('is_read', $request->is_read);
        }

        if ($request->filled('date_from')) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }

        if ($request->filled('date_to')) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }

        $messages = $query->orderBy('created_at', 'desc')->get();

        $csvData = [];
        $csvData[] = [
            'ID', 'From', 'To', 'Subject', 'Message', 'Status', 'Pet ID', 
            'Conversation ID', 'Sent At', 'Read At'
        ];

        foreach ($messages as $message) {
            $csvData[] = [
                $message->id,
                $message->sender->name . ' (' . $message->sender->email . ')',
                $message->receiver->name . ' (' . $message->receiver->email . ')',
                $message->subject,
                strip_tags($message->body),
                $message->is_read ? 'Read' : 'Unread',
                $message->pet_id,
                $message->conversation_id,
                $message->created_at->format('Y-m-d H:i:s'),
                $message->read_at ? $message->read_at->format('Y-m-d H:i:s') : ''
            ];
        }

        $filename = 'messages-export-' . now()->format('Y-m-d-H-i-s') . '.csv';

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

    public function getMessageStats()
    {
        $stats = [
            'total' => Message::count(),
            'unread' => Message::where('is_read', false)->count(),
            'today' => Message::whereDate('created_at', today())->count(),
            'this_week' => Message::whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])->count(),
            'this_month' => Message::whereMonth('created_at', now()->month)->count(),
            'conversations' => Message::distinct('conversation_id')->count('conversation_id'),
        ];

        return response()->json($stats);
    }

    public function deleteConversation(Request $request)
    {
        $request->validate([
            'conversation_id' => 'required|string'
        ]);

        $deletedCount = Message::where('conversation_id', $request->conversation_id)->delete();

        if ($request->ajax()) {
            return response()->json([
                'message' => "Conversation deleted successfully ({$deletedCount} messages)"
            ]);
        }

        return redirect()->route('admin.messages.index')
            ->with('success', "Conversation deleted successfully ({$deletedCount} messages)");
    }

    public function conversations(Request $request)
    {
        // Get all unique conversations
        $conversations = Message::select('conversation_id')
            ->selectRaw('MAX(created_at) as last_message_at')
            ->selectRaw('COUNT(*) as message_count')
            ->selectRaw('SUM(CASE WHEN is_read = 0 THEN 1 ELSE 0 END) as unread_count')
            ->with(['sender', 'receiver'])
            ->groupBy('conversation_id')
            ->orderByDesc('last_message_at')
            ->paginate(20);

        return view('admin.messages.conversations', compact('conversations'));
    }
}