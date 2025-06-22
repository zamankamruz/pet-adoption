<?php
// File: messages.blade.php
// Path: /resources/views/user/messages.blade.php
?>

@extends('layouts.app')

@section('title', 'Messages - Furry Friends')

@section('content')
<div class="min-h-screen bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 py-6">
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-6">
            <!-- Sidebar Navigation -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-2xl shadow-sm border overflow-hidden sticky top-6">
                    <nav class="p-4">
                        <ul class="space-y-1">
                            <li>
                                <a href="{{ route('dashboard') }}" 
                                   class="flex items-center px-4 py-3 rounded-xl text-gray-600 hover:bg-purple-50 hover:text-purple-600 transition-all duration-200">
                                    <div class="w-8 h-8 bg-purple-100 text-purple-600 rounded-full flex items-center justify-center mr-3 text-sm">📊</div>
                                    <span class="font-medium">Overview</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('user.profile') }}" 
                                   class="flex items-center px-4 py-3 rounded-xl text-gray-600 hover:bg-purple-50 hover:text-purple-600 transition-all duration-200">
                                    <div class="w-8 h-8 bg-purple-100 text-purple-600 rounded-full flex items-center justify-center mr-3 text-sm">👤</div>
                                    <span class="font-medium">Profile</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('user.adoptions') }}" 
                                   class="flex items-center px-4 py-3 rounded-xl text-gray-600 hover:bg-purple-50 hover:text-purple-600 transition-all duration-200">
                                    <div class="w-8 h-8 bg-purple-100 text-purple-600 rounded-full flex items-center justify-center mr-3 text-sm">🐾</div>
                                    <span class="font-medium">Adopt</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('rehoming.my-pets') }}" 
                                   class="flex items-center px-4 py-3 rounded-xl text-gray-600 hover:bg-purple-50 hover:text-purple-600 transition-all duration-200">
                                    <div class="w-8 h-8 bg-purple-100 text-purple-600 rounded-full flex items-center justify-center mr-3 text-sm">🏠</div>
                                    <span class="font-medium">Rehome</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('user.messages') }}" 
                                   class="flex items-center px-4 py-3 rounded-xl bg-gradient-to-r from-purple-500 to-purple-600 text-white">
                                    <div class="w-8 h-8 bg-white bg-opacity-20 rounded-full flex items-center justify-center mr-3 text-sm font-bold">💬</div>
                                    <span class="font-medium">Message</span>
                                    @if($unreadCount > 0)
                                        <span class="ml-auto bg-red-500 text-white text-xs font-bold px-2 py-1 rounded-full min-w-[20px] text-center">
                                            {{ $unreadCount }}
                                        </span>
                                    @endif
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('user.settings') }}" 
                                   class="flex items-center px-4 py-3 rounded-xl text-gray-600 hover:bg-purple-50 hover:text-purple-600 transition-all duration-200">
                                    <div class="w-8 h-8 bg-purple-100 text-purple-600 rounded-full flex items-center justify-center mr-3 text-sm">⚙️</div>
                                    <span class="font-medium">Setting</span>
                                </a>
                            </li>
                        </ul>
                    </nav>

                     <!-- Charity Widget -->
                    <div class="p-4">
                        <div class="relative bg-white border-2 border-gray-100 rounded-2xl p-4 text-center">
                            <button class="absolute top-2 right-2 w-6 h-6 text-gray-400 hover:text-gray-600">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                </svg>
                            </button>
                            <div class="flex justify-center mb-3">
                                <div class="flex -space-x-1">
                                    <img src="/api/placeholder/32/32" alt="Pet 1" class="w-8 h-8 rounded-full border-2 border-white">
                                    <img src="/api/placeholder/32/32" alt="Pet 2" class="w-8 h-8 rounded-full border-2 border-white">
                                    <img src="/api/placeholder/32/32" alt="Pet 3" class="w-8 h-8 rounded-full border-2 border-white">
                                    <img src="/api/placeholder/32/32" alt="Pet 4" class="w-8 h-8 rounded-full border-2 border-white">
                                    <img src="/api/placeholder/32/32" alt="Pet 5" class="w-8 h-8 rounded-full border-2 border-white">
                                    <img src="/api/placeholder/32/32" alt="Pet 6" class="w-8 h-8 rounded-full border-2 border-white">
                                </div>
                            </div>
                            <p class="text-sm text-gray-700 font-medium mb-3">Join Furry Friends Charity</p>
                            <button class="flex items-center justify-center space-x-1 bg-purple-100 text-purple-600 px-4 py-2 rounded-lg text-sm font-medium w-full hover:bg-purple-200 transition-colors">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd"></path>
                                </svg>
                                <span>Donate</span>
                            </button>
                        </div>
                    </div>

                    

                </div>
            </div>

            <!-- Main Content -->
            <div class="lg:col-span-3">
                <div class="bg-white rounded-2xl shadow-sm border overflow-hidden">
                    <!-- Header -->
                    <div class="p-6 border-b border-gray-100">
                        <div class="flex justify-between items-center">
                            <div>
                                <h1 class="text-2xl font-bold text-gray-900">Messages</h1>
                                <p class="text-gray-600 mt-1">{{ $conversations->count() }} conversations</p>
                            </div>
                            <button onclick="markAllAsRead()" 
                                    class="text-purple-600 hover:text-purple-700 font-medium transition-colors">
                                Mark all as read
                            </button>
                        </div>
                    </div>

                    <!-- Messages Content -->
                    <div class="p-6">
                        @if($conversations->count() > 0)
                            <div class="space-y-4">
                                @foreach($conversations as $conversation)
                                    @php
                                        $otherUser = $conversation->sender_id === auth()->id() ? $conversation->receiver : $conversation->sender;
                                        $isUnread = $conversation->receiver_id === auth()->id() && !$conversation->is_read;
                                    @endphp
                                    <div class="flex items-center p-4 border border-gray-200 rounded-xl hover:bg-gray-50 transition-colors cursor-pointer {{ $isUnread ? 'bg-purple-50 border-purple-200' : '' }}"
                                         onclick="openConversation('{{ $conversation->conversation_id }}')">
                                        <img src="{{ $otherUser->avatar_url }}" alt="{{ $otherUser->name }}" 
                                             class="w-12 h-12 rounded-full object-cover">
                                        <div class="ml-4 flex-1">
                                            <div class="flex items-center justify-between">
                                                <h3 class="font-semibold text-gray-900 {{ $isUnread ? 'font-bold' : '' }}">
                                                    {{ $otherUser->name }}
                                                </h3>
                                                <span class="text-sm text-gray-500">
                                                    {{ $conversation->created_at->diffForHumans() }}
                                                </span>
                                            </div>
                                            <div class="flex items-center justify-between mt-1">
                                                <p class="text-gray-600 text-sm {{ $isUnread ? 'font-medium' : '' }}">
                                                    @if($conversation->pet)
                                                        <span class="text-purple-600">Re: {{ $conversation->pet->name }}</span> - 
                                                    @endif
                                                    {{ Str::limit($conversation->body, 50) }}
                                                </p>
                                                @if($isUnread)
                                                    <div class="w-3 h-3 bg-purple-500 rounded-full"></div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <!-- Pagination -->
                            @if($conversations->hasPages())
                                <div class="mt-8 flex justify-center">
                                    {{ $conversations->links() }}
                                </div>
                            @endif
                        @else
                            <!-- Empty State -->
                            <div class="text-center py-12">
                                <svg class="w-16 h-16 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                                </svg>
                                <h3 class="text-xl font-semibold text-gray-900 mb-2">No messages yet</h3>
                                <p class="text-gray-600 mb-6">Start a conversation by messaging pet owners about their listings.</p>
                                <a href="{{ route('pets.index') }}" 
                                   class="inline-block bg-purple-600 hover:bg-purple-700 text-white font-medium py-3 px-6 rounded-lg transition-colors">
                                    Browse Pets
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function openConversation(conversationId) {
    window.location.href = `/user/messages/${conversationId}`;
}

function markAllAsRead() {
    fetch('/user/messages/mark-all-read', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            'Content-Type': 'application/json',
        }
    })
    .then(response => response.json())
    .then(data => {
        location.reload();
    })
    .catch(error => {
        console.error('Error:', error);
    });
}
</script>
@endsection