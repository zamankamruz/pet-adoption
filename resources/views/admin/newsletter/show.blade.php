<?php
// File: show.blade.php
// Path: /resources/views/admin/newsletter/show.blade.php
?>

@extends('layouts.admin')

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
                            <!-- RSS feed icon for "News" -->
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
                            <!-- Annotation/chat bubble icon for "Testimonials" -->
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M7 8h10M7 12h8m-5 8l-5-5H5a2 2 0 01-2-2V7a2 2 0 012-2h14a2 2 0 012 2v7a2 2 0 01-2 2h-3l-5 5z" />
                        </svg>
                        Testimonials
                    </a>

                    <!-- Messages -->
                    <a href="{{ route('admin.messages.index') }}" 
                       class="text-gray-600 hover:bg-gray-50 hover:text-gray-900 group flex items-center px-2 py-2 text-sm font-medium rounded-md">
                        <svg class="text-gray-400 group-hover:text-gray-500 mr-3 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                        Messages
                    </a>

                    <!-- Newsletter - Active -->
                    <a href="{{ route('admin.newsletter.index') }}" 
                    class="bg-purple-100 text-purple-900 group flex items-center px-2 py-2 text-sm font-medium rounded-md">
                        <svg class="text-purple-500 mr-3 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                d="M3 10l9 4-9 4V6l18 6-18 6" />
                        </svg>
                        Newsletter 
                    </a>

                    <!-- Divider -->
                    <div class="border-t border-gray-200 mt-6 pt-6">
                        <!-- Settings -->
                        <a href="{{ route('admin.settings.index') }}" 
                           class="text-gray-600 hover:bg-gray-50 hover:text-gray-900 group flex items-center px-2 py-2 text-sm font-medium rounded-md">
                            <svg class="text-gray-400 group-hover:text-gray-500 mr-3 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                            Settings
                        </a>

                        <!-- Reports -->
                        <a href="{{ route('admin.reports.index') }}" 
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
                    <h1 class="text-sm font-bold text-gray-900">Newsletter Subscriber</h1>
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

        <!-- Newsletter Subscriber Content -->
        <main class="flex-1 relative overflow-y-auto focus:outline-none">
            <div class="py-6">
                <div class="container mx-auto px-4">
                    <!-- Header -->
                    <div class="flex justify-between items-center mb-6">
                        <div>
                            <h1 class="text-2xl font-bold text-gray-900">Subscriber Details</h1>
                            <p class="text-gray-600">View and manage subscriber information</p>
                        </div>
                        <div class="flex space-x-3">
                            <a href="{{ route('admin.newsletter.edit', $subscriber) }}" 
                               class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg font-medium transition-colors duration-200">
                                <i class="fas fa-edit mr-2"></i>Edit Subscriber
                            </a>
                            <a href="{{ route('admin.newsletter.index') }}" 
                               class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg font-medium transition-colors duration-200">
                                <i class="fas fa-arrow-left mr-2"></i>Back to List
                            </a>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                        <!-- Main Information -->
                        <div class="lg:col-span-2 space-y-6">
                            <!-- Subscriber Information -->
                            <div class="bg-white rounded-lg shadow">
                                <div class="p-6">
                                    <div class="flex items-center justify-between mb-6">
                                        <h3 class="text-lg font-semibold text-gray-900">
                                            <i class="fas fa-user mr-2"></i>Subscriber Information
                                        </h3>
                                        
                                        <!-- Status Badge -->
                                        @if($subscriber->is_active)
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                                                <i class="fas fa-check-circle mr-1"></i>Active
                                            </span>
                                        @else
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-red-100 text-red-800">
                                                <i class="fas fa-times-circle mr-1"></i>Inactive
                                            </span>
                                        @endif
                                    </div>

                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                        <!-- Email -->
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
                                            <div class="flex items-center">
                                                <i class="fas fa-envelope text-gray-400 mr-3"></i>
                                                <span class="text-gray-900 font-medium">{{ $subscriber->email }}</span>
                                                <button onclick="copyToClipboard('{{ $subscriber->email }}')" 
                                                        class="ml-2 text-gray-400 hover:text-gray-600">
                                                    <i class="fas fa-copy"></i>
                                                </button>
                                            </div>
                                        </div>

                                        <!-- Name -->
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-1">Name</label>
                                            <div class="flex items-center">
                                                <i class="fas fa-user text-gray-400 mr-3"></i>
                                                <span class="text-gray-900">{{ $subscriber->name ?: 'Not provided' }}</span>
                                            </div>
                                        </div>

                                        <!-- Subscriber ID -->
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-1">Subscriber ID</label>
                                            <div class="flex items-center">
                                                <i class="fas fa-hashtag text-gray-400 mr-3"></i>
                                                <span class="text-gray-900 font-mono">#{{ str_pad($subscriber->id, 6, '0', STR_PAD_LEFT) }}</span>
                                            </div>
                                        </div>

                                        <!-- Status -->
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-1">Current Status</label>
                                            <div class="flex items-center">
                                                <i class="fas {{ $subscriber->is_active ? 'fa-toggle-on text-green-500' : 'fa-toggle-off text-red-500' }} mr-3"></i>
                                                <span class="text-gray-900">{{ $subscriber->is_active ? 'Active' : 'Inactive' }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Subscription Timeline -->
                            <div class="bg-white rounded-lg shadow">
                                <div class="p-6">
                                    <h3 class="text-lg font-semibold text-gray-900 mb-6">
                                        <i class="fas fa-clock mr-2"></i>Subscription Timeline
                                    </h3>

                                    <div class="space-y-4">
                                        <!-- Subscribed -->
                                        <div class="flex items-start">
                                            <div class="flex-shrink-0">
                                                <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center">
                                                    <i class="fas fa-plus text-green-600 text-sm"></i>
                                                </div>
                                            </div>
                                            <div class="ml-4">
                                                <p class="text-sm font-medium text-gray-900">Subscribed to Newsletter</p>
                                                <p class="text-sm text-gray-500">
                                                    {{ $subscriber->subscribed_at->format('F j, Y \a\t g:i A') }}
                                                    <span class="text-gray-400">
                                                        ({{ $subscriber->subscribed_at->diffForHumans() }})
                                                    </span>
                                                </p>
                                            </div>
                                        </div>

                                        @if($subscriber->unsubscribed_at)
                                            <!-- Unsubscribed -->
                                            <div class="flex items-start">
                                                <div class="flex-shrink-0">
                                                    <div class="w-8 h-8 bg-red-100 rounded-full flex items-center justify-center">
                                                        <i class="fas fa-minus text-red-600 text-sm"></i>
                                                    </div>
                                                </div>
                                                <div class="ml-4">
                                                    <p class="text-sm font-medium text-gray-900">Unsubscribed</p>
                                                    <p class="text-sm text-gray-500">
                                                        {{ $subscriber->unsubscribed_at->format('F j, Y \a\t g:i A') }}
                                                        <span class="text-gray-400">
                                                            ({{ $subscriber->unsubscribed_at->diffForHumans() }})
                                                        </span>
                                                    </p>
                                                </div>
                                            </div>
                                        @endif

                                        <!-- Last Updated -->
                                        @if($subscriber->updated_at != $subscriber->created_at)
                                            <div class="flex items-start">
                                                <div class="flex-shrink-0">
                                                    <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center">
                                                        <i class="fas fa-edit text-blue-600 text-sm"></i>
                                                    </div>
                                                </div>
                                                <div class="ml-4">
                                                    <p class="text-sm font-medium text-gray-900">Last Updated</p>
                                                    <p class="text-sm text-gray-500">
                                                        {{ $subscriber->updated_at->format('F j, Y \a\t g:i A') }}
                                                        <span class="text-gray-400">
                                                            ({{ $subscriber->updated_at->diffForHumans() }})
                                                        </span>
                                                    </p>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <!-- Technical Details -->
                            <div class="bg-white rounded-lg shadow">
                                <div class="p-6">
                                    <h3 class="text-lg font-semibold text-gray-900 mb-6">
                                        <i class="fas fa-cog mr-2"></i>Technical Details
                                    </h3>

                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-1">Unsubscribe Token</label>
                                            <div class="flex items-center">
                                                <code class="text-xs bg-gray-100 px-2 py-1 rounded font-mono">
                                                    {{ Str::limit($subscriber->unsubscribe_token, 20) }}...
                                                </code>
                                                <button onclick="copyToClipboard('{{ $subscriber->unsubscribe_token }}')" 
                                                        class="ml-2 text-gray-400 hover:text-gray-600">
                                                    <i class="fas fa-copy"></i>
                                                </button>
                                            </div>
                                        </div>

                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-1">Unsubscribe URL</label>
                                            <div class="flex items-center">
                                                <a href="{{ route('newsletter.unsubscribe', $subscriber->unsubscribe_token) }}" 
                                                   target="_blank" 
                                                   class="text-blue-600 hover:text-blue-800 text-sm">
                                                    View Unsubscribe Page
                                                    <i class="fas fa-external-link-alt ml-1"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Sidebar Actions -->
                        <div class="space-y-6">
                            <!-- Quick Actions -->
                            <div class="bg-white rounded-lg shadow">
                                <div class="p-6">
                                    <h3 class="text-lg font-semibold text-gray-900 mb-4">
                                        <i class="fas fa-bolt mr-2"></i>Quick Actions
                                    </h3>

                                    <div class="space-y-3">
                                        @if($subscriber->is_active)
                                            <form method="POST" action="{{ route('admin.newsletter.deactivate', $subscriber) }}">
                                                @csrf
                                                <button type="submit" 
                                                        onclick="return confirm('Deactivate this subscriber?')"
                                                        class="w-full bg-yellow-600 hover:bg-yellow-700 text-white px-4 py-2 rounded-lg font-medium transition-colors duration-200">
                                                    <i class="fas fa-pause mr-2"></i>Deactivate Subscriber
                                                </button>
                                            </form>
                                        @else
                                            <form method="POST" action="{{ route('admin.newsletter.activate', $subscriber) }}">
                                                @csrf
                                                <button type="submit" 
                                                        class="w-full bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg font-medium transition-colors duration-200">
                                                    <i class="fas fa-play mr-2"></i>Activate Subscriber
                                                </button>
                                            </form>
                                        @endif

                                        <a href="{{ route('admin.newsletter.edit', $subscriber) }}" 
                                           class="block w-full bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg font-medium text-center transition-colors duration-200">
                                            <i class="fas fa-edit mr-2"></i>Edit Details
                                        </a>

                                        <button onclick="sendTestEmail()" 
                                                class="w-full bg-purple-600 hover:bg-purple-700 text-white px-4 py-2 rounded-lg font-medium transition-colors duration-200">
                                            <i class="fas fa-envelope mr-2"></i>Send Test Email
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <!-- Danger Zone -->
                            <div class="bg-white rounded-lg shadow border border-red-200">
                                <div class="p-6">
                                    <h3 class="text-lg font-semibold text-red-900 mb-4">
                                        <i class="fas fa-exclamation-triangle mr-2"></i>Danger Zone
                                    </h3>

                                    <p class="text-sm text-gray-600 mb-4">
                                        Permanently delete this subscriber. This action cannot be undone.
                                    </p>

                                    <form method="POST" action="{{ route('admin.newsletter.destroy', $subscriber) }}" onsubmit="return confirmDelete()">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="w-full bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg font-medium transition-colors duration-200">
                                            <i class="fas fa-trash mr-2"></i>Delete Subscriber
                                        </button>
                                    </form>
                                </div>
                            </div>

                            <!-- Statistics -->
                            <div class="bg-white rounded-lg shadow">
                                <div class="p-6">
                                    <h3 class="text-lg font-semibold text-gray-900 mb-4">
                                        <i class="fas fa-chart-bar mr-2"></i>Statistics
                                    </h3>

                                    <div class="space-y-3">
                                        <div class="flex justify-between">
                                            <span class="text-sm text-gray-600">Days Subscribed:</span>
                                            <span class="text-sm font-medium text-gray-900">
                                                {{ $subscriber->subscribed_at->diffInDays(now()) }}
                                            </span>
                                        </div>

                                        <div class="flex justify-between">
                                            <span class="text-sm text-gray-600">Status:</span>
                                            <span class="text-sm font-medium {{ $subscriber->is_active ? 'text-green-600' : 'text-red-600' }}">
                                                {{ $subscriber->is_active ? 'Active' : 'Inactive' }}
                                            </span>
                                        </div>

                                        <div class="flex justify-between">
                                            <span class="text-sm text-gray-600">Last Updated:</span>
                                            <span class="text-sm font-medium text-gray-900">
                                                {{ $subscriber->updated_at->diffForHumans() }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
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

function copyToClipboard(text) {
    navigator.clipboard.writeText(text).then(function() {
        // Show success message
        const originalText = event.target.innerHTML;
        event.target.innerHTML = '<i class="fas fa-check"></i>';
        event.target.classList.add('text-green-600');
        
        setTimeout(() => {
            event.target.innerHTML = originalText;
            event.target.classList.remove('text-green-600');
        }, 2000);
    }).catch(function(err) {
        alert('Failed to copy to clipboard');
    });
}

function sendTestEmail() {
    alert('Test email functionality would be implemented here');
}

function confirmDelete() {
    return confirm('Are you sure you want to permanently delete this subscriber?\n\nThis action cannot be undone and will remove:\n- Subscriber information\n- Subscription history\n- All related data');
}
</script>
@endsection