<?php
// File: conversations.blade.php
// Path: /resources/views/admin/messages/conversations.blade.php
?>

@extends('layouts.app')

@section('title', 'Message Conversations')

@section('content')
<div class="p-6">
    <!-- Header -->
    <div class="flex justify-between items-center mb-6">
        <div>
            <div class="flex items-center space-x-2 mb-2">
                <a href="{{ route('admin.messages.index') }}" 
                   class="text-gray-500 hover:text-gray-700">
                    <i class="fas fa-arrow-left"></i>
                </a>
                <h1 class="text-2xl font-bold text-gray-900">Message Conversations</h1>
            </div>
            <p class="text-gray-600">View and manage all user conversations</p>
        </div>
        <div class="flex space-x-3">
            <a href="{{ route('admin.messages.index') }}" 
               class="bg-gray-600 text-white px-4 py-2 rounded-lg hover:bg-gray-700 transition-colors">
                <i class="fas fa-list mr-2"></i>All Messages
            </a>
            <button onclick="exportConversations()" 
                    class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition-colors">
                <i class="fas fa-download mr-2"></i>Export
            </button>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-6">
        <div class="bg-white rounded-lg shadow-sm border p-4">
            <div class="flex items-center">
                <div class="flex-1">
                    <p class="text-sm font-medium text-gray-600">Total Conversations</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $conversations->total() }}</p>
                </div>
                <div class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center">
                    <i class="fas fa-comments text-blue-600"></i>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-sm border p-4">
            <div class="flex items-center">
                <div class="flex-1">
                    <p class="text-sm font-medium text-gray-600">Active Today</p>
                    <p class="text-2xl font-bold text-green-600">
                        {{ $conversations->where('last_message_at', '>=', today())->count() }}
                    </p>
                </div>
                <div class="w-8 h-8 bg-green-100 rounded-lg flex items-center justify-center">
                    <i class="fas fa-calendar-day text-green-600"></i>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-sm border p-4">
            <div class="flex items-center">
                <div class="flex-1">
                    <p class="text-sm font-medium text-gray-600">With Unread</p>
                    <p class="text-2xl font-bold text-red-600">
                        {{ $conversations->where('unread_count', '>', 0)->count() }}
                    </p>
                </div>
                <div class="w-8 h-8 bg-red-100 rounded-lg flex items-center justify-center">
                    <i class="fas fa-envelope text-red-600"></i>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-sm border p-4">
            <div class="flex items-center">
                <div class="flex-1">
                    <p class="text-sm font-medium text-gray-600">Avg Messages</p>
                    <p class="text-2xl font-bold text-purple-600">
                        {{ number_format($conversations->avg('message_count'), 1) }}
                    </p>
                </div>
                <div class="w-8 h-8 bg-purple-100 rounded-lg flex items-center justify-center">
                    <i class="fas fa-chart-line text-purple-600"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Filters -->
    <div class="bg-white rounded-lg shadow-sm border mb-6">
        <div class="p-4 border-b border-gray-200">
            <h3 class="text-lg font-medium text-gray-900">Filters</h3>
        </div>
        <div class="p-4">
            <form method="GET" action="{{ route('admin.messages.conversations') }}" class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Search Users</label>
                    <input type="text" name="search" value="{{ request('search') }}" 
                           placeholder="User name or email..."
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                    <select name="status" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="">All Conversations</option>
                        <option value="unread" {{ request('status') === 'unread' ? 'selected' : '' }}>With Unread Messages</option>
                        <option value="read" {{ request('status') === 'read' ? 'selected' : '' }}>All Read</option>
                        <option value="active" {{ request('status') === 'active' ? 'selected' : '' }}>Active Today</option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Date From</label>
                    <input type="date" name="date_from" value="{{ request('date_from') }}" 
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Date To</label>
                    <input type="date" name="date_to" value="{{ request('date_to') }}" 
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <div class="md:col-span-4 flex justify-between">
                    <div class="flex space-x-2">
                        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors">
                            <i class="fas fa-filter mr-2"></i>Apply Filters
                        </button>
                        <a href="{{ route('admin.messages.conversations') }}" 
                           class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600 transition-colors">
                            <i class="fas fa-times mr-2"></i>Clear
                        </a>
                    </div>
                    <div class="flex space-x-2">
                        <select name="sort" onchange="this.form.submit()" 
                                class="px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="latest" {{ request('sort') === 'latest' ? 'selected' : '' }}>Latest Activity</option>
                            <option value="oldest" {{ request('sort') === 'oldest' ? 'selected' : '' }}>Oldest Activity</option>
                            <option value="most_messages" {{ request('sort') === 'most_messages' ? 'selected' : '' }}>Most Messages</option>
                            <option value="unread_first" {{ request('sort') === 'unread_first' ? 'selected' : '' }}>Unread First</option>
                        </select>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Conversations List -->
    <div class="bg-white rounded-lg shadow-sm border">
        <div class="p-4 border-b border-gray-200">
            <div class="flex justify-between items-center">
                <h3 class="text-lg font-medium text-gray-900">
                    Conversations ({{ $conversations->total() }})
                </h3>
                <div class="flex items-center space-x-2">
                    <button onclick="toggleBulkActions()" 
                            class="text-sm text-gray-600 hover:text-gray-900">
                        <i class="fas fa-check-square mr-1"></i>Bulk Actions
                    </button>
                </div>
            </div>
        </div>

        <!-- Bulk Actions Bar (hidden by default) -->
        <div id="bulkActionsBar" class="hidden bg-gray-50 p-4 border-b border-gray-200">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-4">
                    <span class="text-sm text-gray-600">
                        <span id="selectedCount">0</span> conversations selected
                    </span>
                    <div class="flex space-x-2">
                        <button onclick="bulkMarkAsRead()" 
                                class="text-sm bg-green-600 text-white px-3 py-1 rounded hover:bg-green-700">
                            Mark All as Read
                        </button>
                        <button onclick="bulkDeleteConversations()" 
                                class="text-sm bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700">
                            Delete Conversations
                        </button>
                    </div>
                </div>
                <button onclick="toggleBulkActions()" class="text-gray-400 hover:text-gray-600">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </div>

        <div class="divide-y divide-gray-200">
            @forelse($conversations as $conversation)
                @php
                    // Get the latest message for this conversation
                    $latestMessage = \App\Models\Message::where('conversation_id', $conversation->conversation_id)
                        ->with(['sender', 'receiver', 'pet'])
                        ->latest()
                        ->first();
                    
                    // Get participants
                    $participants = \App\Models\Message::where('conversation_id', $conversation->conversation_id)
                        ->with(['sender', 'receiver'])
                        ->get()
                        ->pluck('sender', 'receiver')
                        ->flatten()
                        ->unique('id')
                        ->take(2);
                @endphp
                
                <div class="p-4 hover:bg-gray-50 {{ $conversation->unread_count > 0 ? 'bg-blue-50' : '' }}">
                    <div class="flex items-center space-x-4">
                        <div class="flex-shrink-0">
                            <input type="checkbox" name="conversation_ids[]" value="{{ $conversation->conversation_id }}" 
                                   class="conversation-checkbox rounded border-gray-300 text-blue-600 focus:ring-blue-500"
                                   onchange="updateSelectedCount()">
                        </div>

                        <!-- Participants Avatars -->
                        <div class="flex-shrink-0">
                            <div class="flex -space-x-2">
                                @foreach($participants->take(2) as $participant)
                                    <img src="{{ $participant->avatar_url }}" 
                                         alt="{{ $participant->name }}" 
                                         class="w-10 h-10 rounded-full border-2 border-white">
                                @endforeach
                                @if($participants->count() > 2)
                                    <div class="w-10 h-10 rounded-full border-2 border-white bg-gray-300 flex items-center justify-center text-xs font-medium text-gray-600">
                                        +{{ $participants->count() - 2 }}
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- Conversation Details -->
                        <div class="flex-1 min-w-0">
                            <div class="flex items-center justify-between mb-1">
                                <div class="flex items-center space-x-2">
                                    <h4 class="text-sm font-medium text-gray-900 truncate">
                                        {{ $participants->pluck('name')->join(' & ') }}
                                    </h4>
                                    @if($conversation->unread_count > 0)
                                        <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                            {{ $conversation->unread_count }} unread
                                        </span>
                                    @endif
                                </div>
                                <div class="flex items-center space-x-2 text-sm text-gray-500">
                                    <span>{{ $conversation->message_count }} messages</span>
                                    <span>•</span>
                                    <span>{{ \Carbon\Carbon::parse($conversation->last_message_at)->diffForHumans() }}</span>
                                </div>
                            </div>

                            <div class="flex items-center justify-between">
                                <div class="flex-1">
                                    <p class="text-sm text-gray-600 truncate">
                                        @if($latestMessage)
                                            <span class="font-medium">{{ $latestMessage->sender->name }}:</span>
                                            {{ $latestMessage->subject ? $latestMessage->subject : Str::limit(strip_tags($latestMessage->body), 60) }}
                                        @endif
                                    </p>
                                    @if($latestMessage && $latestMessage->pet)
                                        <p class="text-xs text-blue-600 mt-1">
                                            <i class="fas fa-paw mr-1"></i>About {{ $latestMessage->pet->name }}
                                        </p>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- Actions -->
                        <div class="flex-shrink-0">
                            <div class="flex items-center space-x-2">
                                <a href="{{ route('admin.messages.index', ['conversation_id' => $conversation->conversation_id]) }}" 
                                   class="text-blue-600 hover:text-blue-800 text-sm">
                                    <i class="fas fa-eye"></i>
                                </a>
                                @if($conversation->unread_count > 0)
                                    <button onclick="markConversationAsRead('{{ $conversation->conversation_id }}')" 
                                            class="text-green-600 hover:text-green-800 text-sm" 
                                            title="Mark all as read">
                                        <i class="fas fa-check"></i>
                                    </button>
                                @endif
                                <button onclick="deleteConversation('{{ $conversation->conversation_id }}')" 
                                        class="text-red-600 hover:text-red-800 text-sm" 
                                        title="Delete conversation">
                                    <i class="fas fa-trash"></i>
                                </button>
                                <div class="relative" x-data="{ open: false }">
                                    <button @click="open = !open" class="text-gray-400 hover:text-gray-600 text-sm">
                                        <i class="fas fa-ellipsis-v"></i>
                                    </button>
                                    <div x-show="open" @click.away="open = false" 
                                         class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg z-10 border">
                                        <div class="py-1">
                                            <a href="{{ route('admin.messages.index', ['conversation_id' => $conversation->conversation_id]) }}" 
                                               class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                                <i class="fas fa-list mr-2"></i>View All Messages
                                            </a>
                                            @if($latestMessage)
                                                <a href="{{ route('admin.messages.show', $latestMessage) }}" 
                                                   class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                                    <i class="fas fa-eye mr-2"></i>View Latest Message
                                                </a>
                                            @endif
                                            @foreach($participants->take(2) as $participant)
                                                <a href="{{ route('admin.users.show', $participant) }}" 
                                                   class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                                    <i class="fas fa-user mr-2"></i>View {{ $participant->name }}
                                                </a>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="px-4 py-12 text-center text-gray-500">
                    <i class="fas fa-comments text-4xl text-gray-300 mb-4"></i>
                    <p class="text-lg font-medium mb-2">No conversations found</p>
                    <p>No user conversations exist yet or try adjusting your filters.</p>
                </div>
            @endforelse
        </div>

        @if($conversations->hasPages())
            <div class="px-4 py-3 border-t border-gray-200">
                {{ $conversations->withQueryString()->links() }}
            </div>
        @endif
    </div>
</div>

<script>
let bulkActionsVisible = false;

function toggleBulkActions() {
    bulkActionsVisible = !bulkActionsVisible;
    const bar = document.getElementById('bulkActionsBar');
    
    if (bulkActionsVisible) {
        bar.classList.remove('hidden');
    } else {
        bar.classList.add('hidden');
        document.querySelectorAll('.conversation-checkbox').forEach(cb => cb.checked = false);
        updateSelectedCount();
    }
}

function updateSelectedCount() {
    const selectedCheckboxes = document.querySelectorAll('.conversation-checkbox:checked');
    document.getElementById('selectedCount').textContent = selectedCheckboxes.length;
}

function markConversationAsRead(conversationId) {
    fetch('/admin/messages/conversation/mark-read', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({
            conversation_id: conversationId
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.message) {
            location.reload();
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('An error occurred. Please try again.');
    });
}

function deleteConversation(conversationId) {
    if (!confirm('Are you sure you want to delete this entire conversation? This action cannot be undone.')) {
        return;
    }
    
    fetch('/admin/messages/conversation/delete', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({
            conversation_id: conversationId
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.message) {
            location.reload();
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('An error occurred. Please try again.');
    });
}

function bulkMarkAsRead() {
    const selectedConversations = Array.from(document.querySelectorAll('.conversation-checkbox:checked'))
        .map(cb => cb.value);
    
    if (selectedConversations.length === 0) {
        alert('Please select at least one conversation.');
        return;
    }
    
    fetch('/admin/messages/bulk-mark-conversations-read', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({
            conversation_ids: selectedConversations
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.message) {
            alert(data.message);
            location.reload();
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('An error occurred. Please try again.');
    });
}

function bulkDeleteConversations() {
    const selectedConversations = Array.from(document.querySelectorAll('.conversation-checkbox:checked'))
        .map(cb => cb.value);
    
    if (selectedConversations.length === 0) {
        alert('Please select at least one conversation.');
        return;
    }
    
    if (!confirm(`Are you sure you want to delete ${selectedConversations.length} conversation(s)? This action cannot be undone.`)) {
        return;
    }
    
    fetch('/admin/messages/bulk-delete-conversations', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({
            conversation_ids: selectedConversations
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.message) {
            alert(data.message);
            location.reload();
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('An error occurred. Please try again.');
    });
}

function exportConversations() {
    const params = new URLSearchParams(window.location.search);
    params.append('export', '1');
    window.location.href = '{{ route("admin.messages.export") }}?' + params.toString();
}
</script>

<!-- Add Alpine.js for dropdown functionality -->
<script src="//unpkg.com/alpinejs" defer></script>
@endsection