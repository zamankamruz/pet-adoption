<?php
// File: conversations.blade.php
// Path: /resources/views/admin/messages/conversations.blade.php
?>

@extends('layouts.admin')

@section('title', 'Message Conversations')

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
                        Rehoming
                    </a>

                    <a href="{{ route('admin.setup.index') }}" 
                       class="text-gray-600 hover:bg-gray-50 hover:text-gray-900 group flex items-center px-2 py-2 text-sm font-medium rounded-md">
                        <svg class="text-gray-400 group-hover:text-gray-500 mr-3 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                        Setup Data
                    </a>

                                        <!-- News -->
                    <a href="{{ route('admin.news.index') }}"
                    class="text-gray-600 hover:bg-gray-50 hover:text-gray-900 group flex items-center px-2 py-2 text-sm font-medium rounded-md">
                        <svg class="text-gray-400 group-hover:text-gray-500 mr-3 h-5 w-5"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <!-- RSS feed icon for “News” -->
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 11a8 8 0 018 8m-8-4a4 4 0 014 4m0-8a12 12 0 0112 12"/>
                            <circle cx="6" cy="18" r="2" />
                        </svg>
                        News
                    </a>

                    <!-- Testimonials -->
                    <a href="{{ route('admin.testimonials.index') }}"
                    class="text-gray-600 hover:bg-gray-50 hover:text-gray-900 group flex items-center px-2 py-2 text-sm font-medium rounded-md">
                        <svg class="text-gray-400 group-hover:text-gray-500 mr-3 h-5 w-5"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <!-- Annotation/chat bubble icon for “Testimonials” -->
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M7 8h10M7 12h8m-5 8l-5-5H5a2 2 0 01-2-2V7a2 2 0 012-2h14a2 2 0 012 2v7a2 2 0 01-2 2h-3l-5 5z" />
                        </svg>
                        Testimonials
                    </a>

                    <!-- Messages -->
                    <a href="{{ route('admin.messages.index') }}" 
                       class="bg-purple-100 text-purple-900 group flex items-center px-2 py-2 text-sm font-medium rounded-md">
                        <svg class="text-purple-500 mr-3 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                        Messages
                    </a>


                    <a href="{{ route('admin.newsletter.index') }}" 
                    class="text-gray-600 hover:bg-gray-50 hover:text-gray-900 group flex items-center px-2 py-2 text-sm font-medium rounded-md">
                        <svg class="text-gray-400 group-hover:text-gray-500 mr-3 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                d="M3 10l9 4-9 4V6l18 6-18 6" />
                        </svg>
                        Newsletter 
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
                        <h1 class="text-lg font-semibold text-gray-900">Message Conversations</h1>
                    </div>
                    <p class="text-xs text-gray-500">View and manage all user conversations</p>
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

// Existing conversation functionality
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