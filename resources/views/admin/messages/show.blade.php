{{-- File: resources/views/admin/messages/show.blade.php --}}
<?php
// File: show.blade.php
// Path: /resources/views/admin/messages/show.blade.php
?>

@extends('layouts.app')

@section('title', 'Message Details')

@section('content')
<div class="flex h-screen bg-gray-100">
    <!-- Sidebar -->
    <div class="hidden md:flex md:flex-shrink-0">
        <div class="flex flex-col w-64">
            <div class="flex flex-col flex-grow pt-5 pb-4 overflow-y-auto bg-white border-r border-gray-200">
                <!-- Logo -->
                <div class="flex items-center flex-shrink-0 px-4">
                    <div class="w-8 h-8 bg-purple-600 rounded-full flex items-center justify-center mr-2">
                        <i class="fas fa-paw text-white text-sm"></i>
                    </div>
                    <span class="text-xl font-bold text-gray-800">Furry Friends</span>
                </div>
                
                <!-- Navigation -->
                <nav class="mt-8 flex-1 px-2 space-y-1">
                    <!-- Dashboard -->
                    <a href="{{ route('admin.dashboard') }}" 
                       class="text-gray-600 hover:bg-gray-50 hover:text-gray-900 group flex items-center px-2 py-2 text-sm font-medium rounded-md">
                        <svg class="text-gray-400 group-hover:text-gray-500 mr-3 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m15 13l-3 3l-3-3"/>
                        </svg>
                        Dashboard
                    </a>

                    <!-- Users -->
                    <a href="{{ route('admin.users.index') }}" 
                       class="text-gray-600 hover:bg-gray-50 hover:text-gray-900 group flex items-center px-2 py-2 text-sm font-medium rounded-md">
                        <svg class="text-gray-400 group-hover:text-gray-500 mr-3 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"/>
                        </svg>
                        Users
                    </a>

                    <!-- Pets -->
                    <a href="{{ route('admin.pets.index') }}" 
                       class="text-gray-600 hover:bg-gray-50 hover:text-gray-900 group flex items-center px-2 py-2 text-sm font-medium rounded-md">
                        <svg class="text-gray-400 group-hover:text-gray-500 mr-3 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.5 12C3.12 12 2 13.12 2 14.5S3.12 17 4.5 17 7 15.88 7 14.5 5.88 12 4.5 12M19.5 12C18.12 12 17 13.12 17 14.5S18.12 17 19.5 17 22 15.88 22 14.5 20.88 12 19.5 12M12 3.5C10.62 3.5 9.5 4.62 9.5 6S10.62 8.5 12 8.5 14.5 7.38 14.5 6 13.38 3.5 12 3.5M12 20.5C10.9 20.5 10 19.6 10 18.5S10.9 16.5 12 16.5 14 17.4 14 18.5 13.1 20.5 12 20.5Z"/>
                        </svg>
                        Pets
                    </a>

                    <!-- Adoptions -->
                    <a href="{{ route('admin.adoptions.index') }}" 
                       class="text-gray-600 hover:bg-gray-50 hover:text-gray-900 group flex items-center px-2 py-2 text-sm font-medium rounded-md">
                        <svg class="text-gray-400 group-hover:text-gray-500 mr-3 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                        </svg>
                        Adoptions
                    </a>

                     <!-- Rehoming -->
                    <a href="{{ route('admin.rehoming.index') }}" 
                       class="text-gray-600 hover:bg-gray-50 hover:text-gray-900 group flex items-center px-2 py-2 text-sm font-medium rounded-md">
                        <svg class="text-gray-400 group-hover:text-gray-500 mr-3 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                        </svg>
                        Rehoming Requests
                    </a>

                    <a href="{{ route('admin.setup.index') }}" 
                       class="text-gray-600 hover:bg-gray-50 hover:text-gray-900 group flex items-center px-2 py-2 text-sm font-medium rounded-md">
                        <svg class="text-gray-400 group-hover:text-gray-500 mr-3 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                        Setup Data
                    </a>

                    <!-- Messages -->
                    <a href="{{ route('admin.messages.index') }}" 
                       class="bg-purple-100 text-purple-900 group flex items-center px-2 py-2 text-sm font-medium rounded-md">
                        <svg class="text-purple-500 mr-3 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                        Messages
                    </a>

                    <!-- Contacts -->
                    <a href="{{ route('admin.contacts.index') }}" 
                       class="text-gray-600 hover:bg-gray-50 hover:text-gray-900 group flex items-center px-2 py-2 text-sm font-medium rounded-md">
                        <svg class="text-gray-400 group-hover:text-gray-500 mr-3 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                        </svg>
                        Contact Messages
                    </a>

                    <!-- Divider -->
                    <div class="border-t border-gray-200 mt-6 pt-6">
                        <!-- Settings -->
                        <a href="#" 
                           class="text-gray-600 hover:bg-gray-50 hover:text-gray-900 group flex items-center px-2 py-2 text-sm font-medium rounded-md">
                            <svg class="text-gray-400 group-hover:text-gray-500 mr-3 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                            Settings
                        </a>

                        <!-- Reports -->
                        <a href="#" 
                           class="text-gray-600 hover:bg-gray-50 hover:text-gray-900 group flex items-center px-2 py-2 text-sm font-medium rounded-md">
                            <svg class="text-gray-400 group-hover:text-gray-500 mr-3 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                            </svg>
                            Reports
                        </a>
                    </div>
                </nav>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="flex flex-col w-0 flex-1 overflow-hidden">
        <!-- Top Navigation Bar -->
        <div class="relative z-10 flex-shrink-0 flex h-16 bg-white shadow border-b border-gray-200">
            <!-- Mobile menu button -->
            <button type="button" class="px-4 border-r border-gray-200 text-gray-600 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-purple-500 md:hidden" onclick="toggleMobileMenu()">
                <span class="sr-only">Open sidebar</span>
                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
            </button>

            <!-- Page title and user menu -->
            <div class="flex-1 px-4 flex justify-between items-center">
                <div>
                    <div class="flex items-center space-x-2 mb-1">
                        <a href="{{ route('admin.messages.index') }}" 
                           class="text-gray-500 hover:text-gray-700">
                            <i class="fas fa-arrow-left"></i>
                        </a>
                        <h1 class="text-lg font-semibold text-gray-900">Message Details</h1>
                        @if(!$message->is_read)
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                <i class="fas fa-envelope mr-1"></i>Unread
                            </span>
                        @endif
                    </div>
                    <p class="text-xs text-gray-500">Message ID: {{ $message->id }}</p>
                </div>
                
                <!-- User Menu -->
                <div class="ml-4 flex items-center md:ml-6">
                    <div class="relative">
                        <button type="button" class="max-w-xs bg-white flex items-center text-sm rounded-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500" onclick="toggleUserMenu()">
                            <span class="sr-only">Open user menu</span>
                            @if(auth()->user()->avatar)
                                <img class="h-8 w-8 rounded-full" src="{{ auth()->user()->avatar_url }}" alt="{{ auth()->user()->name }}">
                            @else
                                <div class="h-8 w-8 bg-purple-600 rounded-full flex items-center justify-center">
                                    <span class="text-white text-sm font-medium">{{ substr(auth()->user()->name, 0, 1) }}</span>
                                </div>
                            @endif
                            <span class="ml-2 text-gray-700 text-sm">{{ auth()->user()->name }}</span>
                            <svg class="ml-1 h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>
                        
                        <!-- User Dropdown Menu -->
                        <div id="userMenu" class="hidden origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5">
                            <div class="py-1">
                                <a href="{{ route('user.profile') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                    <i class="fas fa-user mr-2"></i>Your Profile
                                </a>
                                <a href="{{ route('user.settings') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                    <i class="fas fa-cog mr-2"></i>Settings
                                </a>
                                <div class="border-t border-gray-100"></div>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                        <i class="fas fa-sign-out-alt mr-2"></i>Sign out
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Page Content -->
        <main class="flex-1 relative overflow-y-auto focus:outline-none bg-gray-50">
            <div class="p-6">
                <!-- Header Actions -->
                <div class="flex justify-end items-center mb-6">
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
        </main>
    </div>

    <!-- Mobile Sidebar Overlay -->
    <div id="mobileMenuOverlay" class="hidden fixed inset-0 flex z-40 md:hidden">
        <div class="fixed inset-0 bg-gray-600 bg-opacity-75" onclick="toggleMobileMenu()"></div>
        <div class="relative flex-1 flex flex-col max-w-xs w-full bg-white">
            <div class="absolute top-0 right-0 -mr-12 pt-2">
                <button type="button" class="ml-1 flex items-center justify-center h-10 w-10 rounded-full focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white" onclick="toggleMobileMenu()">
                    <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
            <!-- Mobile sidebar content would go here -->
            <div class="flex-1 h-0 pt-5 pb-4 overflow-y-auto">
                <!-- Mobile navigation here - copy from desktop sidebar -->
            </div>
        </div>
    </div>
</div>

<script>
// Mobile menu toggle
function toggleMobileMenu() {
    const overlay = document.getElementById('mobileMenuOverlay');
    overlay.classList.toggle('hidden');
}

// User menu toggle
function toggleUserMenu() {
    const menu = document.getElementById('userMenu');
    menu.classList.toggle('hidden');
}

// Close user menu when clicking outside
document.addEventListener('click', function(event) {
    const userMenu = document.getElementById('userMenu');
    const userButton = event.target.closest('button');
    
    if (!userButton || !userButton.onclick.toString().includes('toggleUserMenu')) {
        userMenu.classList.add('hidden');
    }
});

// Existing message functionality
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