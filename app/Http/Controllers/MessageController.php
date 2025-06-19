<?php
// File: MessageController.php
// Path: /app/Http/Controllers/MessageController.php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\User;
use App\Models\Pet;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Notifications\NewMessageNotification;

class MessageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = auth()->user();
        
        // Get all conversations (grouped by conversation_id or participants)
        $conversations = Message::where('sender_id', $user->id)
            ->orWhere('receiver_id', $user->id)
            ->with(['sender', 'receiver', 'pet'])
            ->latest()
            ->get()
            ->groupBy(function($message) {
                $participants = collect([$message->sender_id, $message->receiver_id])->sort()->implode('-');
                return $participants;
            })
            ->map(function($messages) {
                return $messages->first(); // Get the latest message from each conversation
            })
            ->values();

        $unreadCount = Message::where('receiver_id', $user->id)
            ->where('is_read', false)
            ->count();

        return view('user.messages.index', compact('conversations', 'unreadCount'));
    }

    public function show($conversationId)
    {
        $user = auth()->user();
        
        // Parse conversation ID to get participants
        $participants = explode('-', $conversationId);
        $otherUserId = $participants[0] == $user->id ? $participants[1] : $participants[0];
        
        $otherUser = User::findOrFail($otherUserId);
        
        // Get all messages in this conversation
        $messages = Message::where(function($query) use ($user, $otherUser) {
            $query->where('sender_id', $user->id)->where('receiver_id', $otherUser->id);
        })->orWhere(function($query) use ($user, $otherUser) {
            $query->where('sender_id', $otherUser->id)->where('receiver_id', $user->id);
        })
        ->with(['sender', 'receiver', 'pet'])
        ->orderBy('created_at')
        ->get();

        // Mark messages as read
        Message::where('sender_id', $otherUser->id)
            ->where('receiver_id', $user->id)
            ->where('is_read', false)
            ->update(['is_read' => true, 'read_at' => now()]);

        return view('user.messages.show', compact('messages', 'otherUser', 'conversationId'));
    }

    public function store(Request $request, User $user)
    {
        $request->validate([
            'subject' => 'nullable|string|max:255',
            'body' => 'required|string|max:2000',
            'pet_id' => 'nullable|exists:pets,id'
        ]);

        $sender = auth()->user();

        // Generate conversation ID
        $conversationId = collect([$sender->id, $user->id])->sort()->implode('-');

        $message = Message::create([
            'sender_id' => $sender->id,
            'receiver_id' => $user->id,
            'subject' => $request->subject,
            'body' => $request->body,
            'pet_id' => $request->pet_id,
            'conversation_id' => $conversationId,
        ]);

        // Send notification to receiver
        $user->notify(new NewMessageNotification($message));

        if ($request->ajax()) {
            return response()->json([
                'message' => 'Message sent successfully',
                'data' => $message->load(['sender', 'receiver'])
            ]);
        }

        return redirect()->route('user.messages.show', $conversationId)
            ->with('success', 'Message sent successfully!');
    }

    public function reply(Request $request, $conversationId)
    {
        $request->validate([
            'body' => 'required|string|max:2000',
            'reply_to' => 'nullable|exists:messages,id'
        ]);

        $user = auth()->user();
        
        // Parse conversation ID to get participants
        $participants = explode('-', $conversationId);
        $otherUserId = $participants[0] == $user->id ? $participants[1] : $participants[0];
        
        $otherUser = User::findOrFail($otherUserId);

        $message = Message::create([
            'sender_id' => $user->id,
            'receiver_id' => $otherUser->id,
            'body' => $request->body,
            'conversation_id' => $conversationId,
            'reply_to' => $request->reply_to,
        ]);

        // Send notification to receiver
        $otherUser->notify(new NewMessageNotification($message));

        if ($request->ajax()) {
            return response()->json([
                'message' => 'Reply sent successfully',
                'data' => $message->load(['sender', 'receiver'])
            ]);
        }

        return redirect()->route('user.messages.show', $conversationId)
            ->with('success', 'Reply sent successfully!');
    }

    public function delete(Message $message)
    {
        $this->authorize('delete', $message);

        $message->delete();

        if (request()->ajax()) {
            return response()->json(['message' => 'Message deleted successfully']);
        }

        return redirect()->back()
            ->with('success', 'Message deleted successfully!');
    }

    public function markAsRead($conversationId)
    {
        $user = auth()->user();
        
        // Parse conversation ID to get other participant
        $participants = explode('-', $conversationId);
        $otherUserId = $participants[0] == $user->id ? $participants[1] : $participants[0];

        Message::where('sender_id', $otherUserId)
            ->where('receiver_id', $user->id)
            ->where('is_read', false)
            ->update(['is_read' => true, 'read_at' => now()]);

        if (request()->ajax()) {
            return response()->json(['message' => 'Messages marked as read']);
        }

        return redirect()->back();
    }

    public function ajaxMarkAsRead(Request $request)
    {
        $request->validate([
            'message_ids' => 'required|array',
            'message_ids.*' => 'exists:messages,id'
        ]);

        $user = auth()->user();

        Message::whereIn('id', $request->message_ids)
            ->where('receiver_id', $user->id)
            ->update(['is_read' => true, 'read_at' => now()]);

        return response()->json(['message' => 'Messages marked as read']);
    }

    public function getUnreadCount()
    {
        $count = Message::where('receiver_id', auth()->id())
            ->where('is_read', false)
            ->count();

        return response()->json(['unread_count' => $count]);
    }

    public function createConversation(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'pet_id' => 'nullable|exists:pets,id',
            'subject' => 'nullable|string|max:255',
            'body' => 'required|string|max:2000'
        ]);

        $receiver = User::findOrFail($request->user_id);
        $sender = auth()->user();

        if ($sender->id === $receiver->id) {
            return response()->json(['error' => 'Cannot send message to yourself'], 400);
        }

        $conversationId = collect([$sender->id, $receiver->id])->sort()->implode('-');

        $message = Message::create([
            'sender_id' => $sender->id,
            'receiver_id' => $receiver->id,
            'subject' => $request->subject,
            'body' => $request->body,
            'pet_id' => $request->pet_id,
            'conversation_id' => $conversationId,
        ]);

        // Send notification to receiver
        $receiver->notify(new NewMessageNotification($message));

        return response()->json([
            'message' => 'Conversation started successfully',
            'conversation_id' => $conversationId,
            'redirect_url' => route('user.messages.show', $conversationId)
        ]);
    }
}