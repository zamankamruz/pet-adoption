<?php
// File: show.blade.php
// Path: /resources/views/admin/messages/show.blade.php
?>

@extends('layouts.app')

@section('title', 'Message Details')

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
                <h1 class="text-2xl font-bold text-gray-900">Message Details</h1>
                @if(!$message->is_read)
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                        <i class="fas fa-envelope mr-1"></i>Unread
                    </span>
                @endif
            </div>
            <p class="text-gray-600">Message ID: {{ $message->id }}</p>
        </div>
        <div class="flex space-x-3">
            @if(!$message->is_read)
                <button onclick="markAsRead({{ $message->id }})" 
                        class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition-colors">
                    <i class="fas fa-check mr-2"></i>Mark as Read
                </button>
            @else
                <button onclick="markAsUnread({{ $message->id }})" 
                        class="bg-yellow-600 text-white px-4 py-2 rounded-lg hover:bg-yellow-700 transition-colors">
                    <i class="fas fa-undo mr-2"></i>Mark as Unread
                </button>
            @endif
            <button onclick="deleteMessage({{ $message->id }})" 
                    class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700 transition-colors">
                <i class="fas fa-trash mr-2"></i>Delete
            </button>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Message Content -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-lg shadow-sm border">
                <div class="p-6 border-b border-gray-200">
                    <div class="flex items-start justify-between mb-4">
                        <div class="flex items-center space-x-3">
                            <img src="{{ $message->sender->avatar_url }}" 
                                 alt="{{ $message->sender->name }}" 
                                 class="w-10 h-10 rounded-full">
                            <div>
                                <h3 class="text-lg font-medium text-gray-900">
                                    {{ $message->sender->name }}
                                </h3>
                                <p class="text-sm text-gray-500">{{ $message->sender->email }}</p>
                            </div>
                        </div>
                        <div class="text-right">
                            <p class="text-sm text-gray-900">{{ $message->created_at->format('M d, Y') }}</p>
                            <p class="text-sm text-gray-500">{{ $message->created_at->format('H:i A') }}</p>
                        </div>
                    </div>

                    <div class="mb-4">
                        <p class="text-sm text-gray-600 mb-1">To:</p>
                        <div class="flex items-center space-x-2">
                            <img src="{{ $message->receiver->avatar_url }}" 
                                 alt="{{ $message->receiver->name }}" 
                                 class="w-6 h-6 rounded-full">
                            <span class="text-sm font-medium text-gray-900">{{ $message->receiver->name }}</span>
                            <span class="text-sm text-gray-500">({{ $message->receiver->email }})</span>
                        </div>
                    </div>

                    @if($message->subject)
                        <div class="mb-4">
                            <p class="text-sm text-gray-600 mb-1">Subject:</p>
                            <h2 class="text-xl font-semibold text-gray-900">{{ $message->subject }}</h2>
                        </div>
                    @endif

                    @if($message->pet)
                        <div class="mb-4">
                            <p class="text-sm text-gray-600 mb-1">Related Pet:</p>
                            <div class="flex items-center space-x-3 p-3 bg-gray-50 rounded-lg">
                                <img src="{{ $message->pet->main_image_url }}" 
                                     alt="{{ $message->pet->name }}" 
                                     class="w-12 h-12 rounded-lg object-cover">
                                <div>
                                    <h4 class="font-medium text-gray-900">{{ $message->pet->name }}</h4>
                                    <p class="text-sm text-gray-500">
                                        {{ $message->pet->breed->name }} • {{ $message->pet->age_display }}
                                    </p>
                                </div>
                                <a href="{{ route('admin.pets.show', $message->pet) }}" 
                                   class="ml-auto text-blue-600 hover:text-blue-800 text-sm">
                                    View Pet <i class="fas fa-external-link-alt ml-1"></i>
                                </a>
                            </div>
                        </div>
                    @endif
                </div>

                <div class="p-6">
                    <div class="prose max-w-none">
                        {!! nl2br(e($message->body)) !!}
                    </div>
                </div>

                @if($message->read_at)
                    <div class="px-6 py-3 bg-green-50 border-t border-gray-200">
                        <p class="text-sm text-green-800">
                            <i class="fas fa-check-circle mr-1"></i>
                            Read on {{ $message->read_at->format('M d, Y \a\t H:i A') }}
                        </p>
                    </div>
                @endif
            </div>

            <!-- Conversation Thread -->
            @if($conversationMessages->count() > 1)
                <div class="mt-6 bg-white rounded-lg shadow-sm border">
                    <div class="p-4 border-b border-gray-200">
                        <h3 class="text-lg font-medium text-gray-900">
                            Conversation Thread ({{ $conversationMessages->count() }} messages)
                        </h3>
                    </div>
                    <div class="p-4 space-y-4 max-h-96 overflow-y-auto">
                        @foreach($conversationMessages as $conversationMessage)
                            <div class="flex space-x-3 {{ $conversationMessage->id === $message->id ? 'bg-blue-50 p-3 rounded-lg' : '' }}">
                                <img src="{{ $conversationMessage->sender->avatar_url }}" 
                                     alt="{{ $conversationMessage->sender->name }}" 
                                     class="w-8 h-8 rounded-full flex-shrink-0">
                                <div class="flex-1 min-w-0">
                                    <div class="flex items-center space-x-2 mb-1">
                                        <p class="text-sm font-medium text-gray-900">{{ $conversationMessage->sender->name }}</p>
                                        <p class="text-xs text-gray-500">{{ $conversationMessage->created_at->diffForHumans() }}</p>
                                        @if($conversationMessage->id === $message->id)
                                            <span class="text-xs bg-blue-100 text-blue-800 px-2 py-1 rounded">Current</span>
                                        @endif
                                    </div>
                                    @if($conversationMessage->subject)
                                        <p class="text-sm font-medium text-gray-800 mb-1">{{ $conversationMessage->subject }}</p>
                                    @endif
                                    <p class="text-sm text-gray-600">{{ Str::limit($conversationMessage->body, 200) }}</p>
                                    @if(strlen($conversationMessage->body) > 200)
                                        <a href="{{ route('admin.messages.show', $conversationMessage) }}" 
                                           class="text-xs text-blue-600 hover:text-blue-800">Read more</a>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>

        <!-- Sidebar -->
        <div class="space-y-6">
            <!-- Message Info -->
            <div class="bg-white rounded-lg shadow-sm border">
                <div class="p-4 border-b border-gray-200">
                    <h3 class="text-lg font-medium text-gray-900">Message Information</h3>
                </div>
                <div class="p-4 space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Status</label>
                        <div class="mt-1">
                            @if($message->is_read)
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                    <i class="fas fa-envelope-open mr-1"></i>Read
                                </span>
                            @else
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                    <i class="fas fa-envelope mr-1"></i>Unread
                                </span>
                            @endif
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Sent</label>
                        <p class="mt-1 text-sm text-gray-900">{{ $message->created_at->format('M d, Y \a\t H:i A') }}</p>
                        <p class="text-xs text-gray-500">{{ $message->created_at->diffForHumans() }}</p>
                    </div>

                    @if($message->read_at)
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Read</label>
                            <p class="mt-1 text-sm text-gray-900">{{ $message->read_at->format('M d, Y \a\t H:i A') }}</p>
                            <p class="text-xs text-gray-500">{{ $message->read_at->diffForHumans() }}</p>
                        </div>
                    @endif

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Conversation ID</label>
                        <p class="mt-1 text-sm text-gray-900 font-mono">{{ $message->conversation_id }}</p>
                    </div>

                    @if($message->reply_to)
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Reply To</label>
                            <a href="{{ route('admin.messages.show', $message->reply_to) }}" 
                               class="mt-1 text-sm text-blue-600 hover:text-blue-800">
                                Message #{{ $message->reply_to }}
                            </a>
                        </div>
                    @endif
                </div>
            </div>

            <!-- User Information -->
            <div class="bg-white rounded-lg shadow-sm border">
                <div class="p-4 border-b border-gray-200">
                    <h3 class="text-lg font-medium text-gray-900">Participants</h3>
                </div>
                <div class="p-4 space-y-4">
                    <!-- Sender -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">From</label>
                        <div class="flex items-center space-x-3">
                            <img src="{{ $message->sender->avatar_url }}" 
                                 alt="{{ $message->sender->name }}" 
                                 class="w-10 h-10 rounded-full">
                            <div class="flex-1">
                                <p class="text-sm font-medium text-gray-900">{{ $message->sender->name }}</p>
                                <p class="text-sm text-gray-500">{{ $message->sender->email }}</p>
                                @if($message->sender->is_admin)
                                    <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-purple-100 text-purple-800">
                                        Admin
                                    </span>
                                @endif
                            </div>
                            <a href="{{ route('admin.users.show', $message->sender) }}" 
                               class="text-blue-600 hover:text-blue-800 text-sm">
                                <i class="fas fa-external-link-alt"></i>
                            </a>
                        </div>
                    </div>

                    <!-- Receiver -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">To</label>
                        <div class="flex items-center space-x-3">
                            <img src="{{ $message->receiver->avatar_url }}" 
                                 alt="{{ $message->receiver->name }}" 
                                 class="w-10 h-10 rounded-full">
                            <div class="flex-1">
                                <p class="text-sm font-medium text-gray-900">{{ $message->receiver->name }}</p>
                                <p class="text-sm text-gray-500">{{ $message->receiver->email }}</p>
                                @if($message->receiver->is_admin)
                                    <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-purple-100 text-purple-800">
                                        Admin
                                    </span>
                                @endif
                            </div>
                            <a href="{{ route('admin.users.show', $message->receiver) }}" 
                               class="text-blue-600 hover:text-blue-800 text-sm">
                                <i class="fas fa-external-link-alt"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Actions -->
            <div class="bg-white rounded-lg shadow-sm border">
                <div class="p-4 border-b border-gray-200">
                    <h3 class="text-lg font-medium text-gray-900">Actions</h3>
                </div>
                <div class="p-4 space-y-3">
                    @if(!$message->is_read)
                        <button onclick="markAsRead({{ $message->id }})" 
                                class="w-full bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition-colors">
                            <i class="fas fa-check mr-2"></i>Mark as Read
                        </button>
                    @else
                        <button onclick="markAsUnread({{ $message->id }})" 
                                class="w-full bg-yellow-600 text-white px-4 py-2 rounded-lg hover:bg-yellow-700 transition-colors">
                            <i class="fas fa-undo mr-2"></i>Mark as Unread
                        </button>
                    @endif

                    @if($conversationMessages->count() > 1)
                        <button onclick="deleteConversation('{{ $message->conversation_id }}')" 
                                class="w-full bg-orange-600 text-white px-4 py-2 rounded-lg hover:bg-orange-700 transition-colors">
                            <i class="fas fa-comments mr-2"></i>Delete Conversation
                        </button>
                    @endif

                    <button onclick="deleteMessage({{ $message->id }})" 
                            class="w-full bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700 transition-colors">
                        <i class="fas fa-trash mr-2"></i>Delete Message
                    </button>

                    <a href="{{ route('admin.messages.index', ['conversation_id' => $message->conversation_id]) }}" 
                       class="block w-full bg-gray-600 text-white px-4 py-2 rounded-lg hover:bg-gray-700 transition-colors text-center">
                        <i class="fas fa-list mr-2"></i>View All in Conversation
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function markAsRead(messageId) {
    fetch(`/admin/messages/${messageId}/mark-read`, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            'Content-Type': 'application/json',
        }
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

function markAsUnread(messageId) {
    fetch(`/admin/messages/${messageId}/mark-unread`, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            'Content-Type': 'application/json',
        }
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

function deleteMessage(messageId) {
    if (!confirm('Are you sure you want to delete this message? This action cannot be undone.')) {
        return;
    }
    
    fetch(`/admin/messages/${messageId}`, {
        method: 'DELETE',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            'Content-Type': 'application/json',
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.message) {
            window.location.href = '{{ route("admin.messages.index") }}';
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('An error occurred. Please try again.');
    });
}

function deleteConversation(conversationId) {
    if (!confirm('Are you sure you want to delete this entire conversation? This will delete all messages in this conversation and cannot be undone.')) {
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
            alert(data.message);
            window.location.href = '{{ route("admin.messages.index") }}';
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('An error occurred. Please try again.');
    });
}
</script>
@endsection