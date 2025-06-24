<?php
// File: index.blade.php
// Path: /resources/views/admin/messages/index.blade.php
?>

@extends('layouts.admin')

@section('title', 'Messages Management')

@section('content')
<div class="flex h-screen bg-gray-100">
    <!-- Sidebar -->
    <div class="hidden md:flex md:flex-shrink-0">
        <div class="flex flex-col w-50">
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
                    <a href="#" 
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
                        @if(isset($stats['unread']) && $stats['unread'] > 0)
                            <span class="ml-auto bg-red-100 text-red-600 text-xs rounded-full px-2 py-1">
                                {{ number_format($stats['unread']) }}
                            </span>
                        @endif
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
                    <h1 class="text-sm font-bold text-gray-900">Messages Management</h1>
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
        <main class="flex-1 relative overflow-y-auto focus:outline-none">
            <div class="p-6">
                <!-- Header -->
                <div class="flex justify-between items-center mb-6">
                    <div>
                        <h1 class="text-2xl font-bold text-gray-900">Messages Management</h1>
                        <p class="text-gray-600">Manage all user messages and conversations</p>
                    </div>
                    <div class="flex space-x-3">
                        <a href="{{ route('admin.messages.conversations') }}" 
                           class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors">
                            <i class="fas fa-comments mr-2"></i>View Conversations
                        </a>
                        <button onclick="exportMessages()" 
                                class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition-colors">
                            <i class="fas fa-download mr-2"></i>Export
                        </button>
                    </div>
                </div>

                <!-- Stats Cards -->
                <div class="grid grid-cols-1 md:grid-cols-5 gap-6 mb-6">
                    <div class="bg-white rounded-lg shadow-sm border p-4">
                        <div class="flex items-center">
                            <div class="flex-1">
                                <p class="text-sm font-medium text-gray-600">Total Messages</p>
                                <p class="text-2xl font-bold text-gray-900">{{ number_format($stats['total']) }}</p>
                            </div>
                            <div class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center">
                                <i class="fas fa-envelope text-blue-600"></i>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-lg shadow-sm border p-4">
                        <div class="flex items-center">
                            <div class="flex-1">
                                <p class="text-sm font-medium text-gray-600">Unread</p>
                                <p class="text-2xl font-bold text-red-600">{{ number_format($stats['unread']) }}</p>
                            </div>
                            <div class="w-8 h-8 bg-red-100 rounded-lg flex items-center justify-center">
                                <i class="fas fa-envelope-open text-red-600"></i>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-lg shadow-sm border p-4">
                        <div class="flex items-center">
                            <div class="flex-1">
                                <p class="text-sm font-medium text-gray-600">Today</p>
                                <p class="text-2xl font-bold text-green-600">{{ number_format($stats['today']) }}</p>
                            </div>
                            <div class="w-8 h-8 bg-green-100 rounded-lg flex items-center justify-center">
                                <i class="fas fa-calendar-day text-green-600"></i>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-lg shadow-sm border p-4">
                        <div class="flex items-center">
                            <div class="flex-1">
                                <p class="text-sm font-medium text-gray-600">This Week</p>
                                <p class="text-2xl font-bold text-blue-600">{{ number_format($stats['this_week']) }}</p>
                            </div>
                            <div class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center">
                                <i class="fas fa-calendar-week text-blue-600"></i>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-lg shadow-sm border p-4">
                        <div class="flex items-center">
                            <div class="flex-1">
                                <p class="text-sm font-medium text-gray-600">This Month</p>
                                <p class="text-2xl font-bold text-purple-600">{{ number_format($stats['this_month']) }}</p>
                            </div>
                            <div class="w-8 h-8 bg-purple-100 rounded-lg flex items-center justify-center">
                                <i class="fas fa-calendar-alt text-purple-600"></i>
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
                        <form method="GET" action="{{ route('admin.messages.index') }}" class="grid grid-cols-1 md:grid-cols-6 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Search</label>
                                <input type="text" name="search" value="{{ request('search') }}" 
                                       placeholder="Subject, message, user..."
                                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">From User</label>
                                <select name="sender_id" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                                    <option value="">All Senders</option>
                                    @foreach($senders as $sender)
                                        <option value="{{ $sender->id }}" {{ request('sender_id') == $sender->id ? 'selected' : '' }}>
                                            {{ $sender->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">To User</label>
                                <select name="receiver_id" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                                    <option value="">All Recipients</option>
                                    @foreach($receivers as $receiver)
                                        <option value="{{ $receiver->id }}" {{ request('receiver_id') == $receiver->id ? 'selected' : '' }}>
                                            {{ $receiver->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                                <select name="is_read" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                                    <option value="">All Status</option>
                                    <option value="1" {{ request('is_read') === '1' ? 'selected' : '' }}>Read</option>
                                    <option value="0" {{ request('is_read') === '0' ? 'selected' : '' }}>Unread</option>
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

                            <div class="md:col-span-6 flex justify-between">
                                <div class="flex space-x-2">
                                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors">
                                        <i class="fas fa-filter mr-2"></i>Apply Filters
                                    </button>
                                    <a href="{{ route('admin.messages.index') }}" 
                                       class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600 transition-colors">
                                        <i class="fas fa-times mr-2"></i>Clear
                                    </a>
                                </div>
                                <div class="flex space-x-2">
                                    <select name="sort" onchange="this.form.submit()" 
                                            class="px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                                        <option value="latest" {{ request('sort') === 'latest' ? 'selected' : '' }}>Latest First</option>
                                        <option value="oldest" {{ request('sort') === 'oldest' ? 'selected' : '' }}>Oldest First</option>
                                        <option value="sender" {{ request('sort') === 'sender' ? 'selected' : '' }}>By Sender</option>
                                        <option value="unread" {{ request('sort') === 'unread' ? 'selected' : '' }}>Unread First</option>
                                    </select>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Messages Table -->
                <div class="bg-white rounded-lg shadow-sm border">
                    <div class="p-4 border-b border-gray-200">
                        <div class="flex justify-between items-center">
                            <h3 class="text-lg font-medium text-gray-900">
                                Messages ({{ $messages->total() }})
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
                                    <span id="selectedCount">0</span> messages selected
                                </span>
                                <div class="flex space-x-2">
                                    <button onclick="bulkAction('mark_read')" 
                                            class="text-sm bg-green-600 text-white px-3 py-1 rounded hover:bg-green-700">
                                        Mark as Read
                                    </button>
                                    <button onclick="bulkAction('mark_unread')" 
                                            class="text-sm bg-yellow-600 text-white px-3 py-1 rounded hover:bg-yellow-700">
                                        Mark as Unread
                                    </button>
                                    <button onclick="bulkAction('delete')" 
                                            class="text-sm bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700">
                                        Delete
                                    </button>
                                </div>
                            </div>
                            <button onclick="toggleBulkActions()" class="text-gray-400 hover:text-gray-600">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="w-8 px-4 py-3">
                                        <input type="checkbox" id="selectAll" onchange="toggleAllMessages(this)" 
                                               class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                                    </th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">From</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">To</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Subject</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Pet</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Date</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                @forelse($messages as $message)
                                    <tr class="hover:bg-gray-50 {{ !$message->is_read ? 'bg-blue-50' : '' }}">
                                        <td class="px-4 py-3">
                                            <input type="checkbox" name="message_ids[]" value="{{ $message->id }}" 
                                                   class="message-checkbox rounded border-gray-300 text-blue-600 focus:ring-blue-500"
                                                   onchange="updateSelectedCount()">
                                        </td>
                                        <td class="px-4 py-3">
                                            @if($message->is_read)
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                    <i class="fas fa-envelope-open mr-1"></i>Read
                                                </span>
                                            @else
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                                    <i class="fas fa-envelope mr-1"></i>Unread
                                                </span>
                                            @endif
                                        </td>
                                        <td class="px-4 py-3">
                                            <div class="text-sm font-medium text-gray-900">{{ $message->sender->name }}</div>
                                            <div class="text-sm text-gray-500">{{ $message->sender->email }}</div>
                                        </td>
                                        <td class="px-4 py-3">
                                            <div class="text-sm font-medium text-gray-900">{{ $message->receiver->name }}</div>
                                            <div class="text-sm text-gray-500">{{ $message->receiver->email }}</div>
                                        </td>
                                        <td class="px-4 py-3">
                                            <div class="text-sm font-medium text-gray-900">
                                                {{ $message->subject ?: 'No Subject' }}
                                            </div>
                                            <div class="text-sm text-gray-500">
                                                {{ Str::limit(strip_tags($message->body), 50) }}
                                            </div>
                                        </td>
                                        <td class="px-4 py-3">
                                            @if($message->pet)
                                                <a href="{{ route('admin.pets.show', $message->pet) }}" 
                                                   class="text-sm text-blue-600 hover:text-blue-900">
                                                    {{ $message->pet->name }}
                                                </a>
                                            @else
                                                <span class="text-sm text-gray-400">-</span>
                                            @endif
                                        </td>
                                        <td class="px-4 py-3">
                                            <div class="text-sm text-gray-900">
                                                {{ $message->created_at->format('M d, Y') }}
                                            </div>
                                            <div class="text-sm text-gray-500">
                                                {{ $message->created_at->format('H:i') }}
                                            </div>
                                        </td>
                                        <td class="px-4 py-3">
                                            <div class="flex items-center space-x-2">
                                                <a href="{{ route('admin.messages.show', $message) }}" 
                                                   class="text-blue-600 hover:text-blue-900 text-sm">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                @if(!$message->is_read)
                                                    <button onclick="markAsRead({{ $message->id }})" 
                                                            class="text-green-600 hover:text-green-900 text-sm" 
                                                            title="Mark as Read">
                                                        <i class="fas fa-check"></i>
                                                    </button>
                                                @else
                                                    <button onclick="markAsUnread({{ $message->id }})" 
                                                            class="text-yellow-600 hover:text-yellow-900 text-sm" 
                                                            title="Mark as Unread">
                                                        <i class="fas fa-undo"></i>
                                                    </button>
                                                @endif
                                                <button onclick="deleteMessage({{ $message->id }})" 
                                                        class="text-red-600 hover:text-red-900 text-sm" 
                                                        title="Delete">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="px-4 py-12 text-center text-gray-500">
                                            <i class="fas fa-envelope text-4xl text-gray-300 mb-4"></i>
                                            <p class="text-lg font-medium mb-2">No messages found</p>
                                            <p>Try adjusting your filters to see more results.</p>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    @if($messages->hasPages())
                        <div class="px-4 py-3 border-t border-gray-200">
                            {{ $messages->withQueryString()->links() }}
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
            <!-- Mobile sidebar content (same as desktop) -->
            <div class="flex-1 h-0 pt-5 pb-4 overflow-y-auto">
                <!-- Mobile navigation here -->
            </div>
        </div>
    </div>
</div>

<script>
function toggleMobileMenu() {
    const overlay = document.getElementById('mobileMenuOverlay');
    overlay.classList.toggle('hidden');
}

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

let bulkActionsVisible = false;

function toggleBulkActions() {
    bulkActionsVisible = !bulkActionsVisible;
    const bar = document.getElementById('bulkActionsBar');
    
    if (bulkActionsVisible) {
        bar.classList.remove('hidden');
    } else {
        bar.classList.add('hidden');
        document.getElementById('selectAll').checked = false;
        document.querySelectorAll('.message-checkbox').forEach(cb => cb.checked = false);
        updateSelectedCount();
    }
}

function toggleAllMessages(selectAllCheckbox) {
    const checkboxes = document.querySelectorAll('.message-checkbox');
    checkboxes.forEach(checkbox => {
        checkbox.checked = selectAllCheckbox.checked;
    });
    updateSelectedCount();
}

function updateSelectedCount() {
    const selectedCheckboxes = document.querySelectorAll('.message-checkbox:checked');
    document.getElementById('selectedCount').textContent = selectedCheckboxes.length;
    
    // Update select all checkbox state
    const allCheckboxes = document.querySelectorAll('.message-checkbox');
    const selectAllCheckbox = document.getElementById('selectAll');
    
    if (selectedCheckboxes.length === 0) {
        selectAllCheckbox.indeterminate = false;
        selectAllCheckbox.checked = false;
    } else if (selectedCheckboxes.length === allCheckboxes.length) {
        selectAllCheckbox.indeterminate = false;
        selectAllCheckbox.checked = true;
    } else {
        selectAllCheckbox.indeterminate = true;
    }
}

function bulkAction(action) {
    const selectedMessages = Array.from(document.querySelectorAll('.message-checkbox:checked'))
        .map(cb => cb.value);
    
    if (selectedMessages.length === 0) {
        alert('Please select at least one message.');
        return;
    }
    
    let actionText = '';
    switch(action) {
        case 'delete':
            actionText = 'delete';
            break;
        case 'mark_read':
            actionText = 'mark as read';
            break;
        case 'mark_unread':
            actionText = 'mark as unread';
            break;
    }
    
    if (action === 'delete' && !confirm(`Are you sure you want to ${actionText} ${selectedMessages.length} message(s)?`)) {
        return;
    }
    
    const formData = new FormData();
    formData.append('_token', document.querySelector('meta[name="csrf-token"]').content);
    formData.append('_method', 'POST');
    formData.append('action', action);
    selectedMessages.forEach(id => formData.append('message_ids[]', id));
    
    fetch('#', {
        method: 'POST',
        body: formData
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
    if (!confirm('Are you sure you want to delete this message?')) {
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
            location.reload();
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('An error occurred. Please try again.');
    });
}

function exportMessages() {
    const params = new URLSearchParams(window.location.search);
    params.append('export', '1');
    window.location.href = '?' + params.toString();
}
</script>
@endsection