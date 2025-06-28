<?php
// File: edit.blade.php
// Path: /resources/views/admin/newsletter/edit.blade.php
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
                        Rehoming Requests
                    </a>

                    <!-- Setup Data -->
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
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 20H5a2 2 0 01-2-2V7a2 2 0 012-2h3l2-2h4l2 2h3a2 2 0 012 2v11a2 2 0 01-2 2zM7 10h10M7 14h10M7 18h10" />
                        </svg>
                        News
                    </a>

                    <!-- Testimonials -->
                    <a href="{{ route('admin.testimonials.index') }}" 
                       class="text-gray-600 hover:bg-gray-50 hover:text-gray-900 group flex items-center px-2 py-2 text-sm font-medium rounded-md">
                        <svg class="text-gray-400 group-hover:text-gray-500 mr-3 h-5 w-5"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 20H5a2 2 0 01-2-2V7a2 2 0 012-2h3l2-2h4l2 2h3a2 2 0 012 2v11a2 2 0 01-2 2zM7 10h10M7 14h10M7 18h10" />
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
                    <h1 class="text-sm font-bold text-gray-900">Edit Subscriber</h1>
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

        <!-- Edit Subscriber Content -->
        <main class="flex-1 relative overflow-y-auto focus:outline-none">
            <div class="py-6">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 md:px-8">
                    <!-- Header -->
                    <div class="flex justify-between items-center mb-6">
                        <div>
                            <h1 class="text-sm font-bold text-gray-900">Edit Subscriber</h1>
                            <p class="text-sm text-gray-600">Update subscriber information</p>
                        </div>
                        <div class="flex space-x-3">
                            <a href="{{ route('admin.newsletter.show', $subscriber) }}" 
                               class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg font-medium transition-colors duration-200 text-sm">
                                <i class="fas fa-eye mr-2"></i>View Details
                            </a>
                            <a href="{{ route('admin.newsletter.index') }}" 
                               class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg font-medium transition-colors duration-200 text-sm">
                                <i class="fas fa-arrow-left mr-2"></i>Back to List
                            </a>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                        <!-- Edit Form -->
                        <div class="lg:col-span-2">
                            <div class="bg-white rounded-lg shadow">
                                <form method="POST" action="{{ route('admin.newsletter.update', $subscriber) }}">
                                    @csrf
                                    @method('PUT')
                                    
                                    <div class="p-6 space-y-6">
                                        <!-- Current Status Info -->
                                        <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                                            <div class="flex items-center">
                                                <i class="fas fa-info-circle text-blue-600 mr-2"></i>
                                                <span class="text-sm font-medium text-blue-900">
                                                    Currently editing subscriber #{{ str_pad($subscriber->id, 6, '0', STR_PAD_LEFT) }}
                                                </span>
                                            </div>
                                            <p class="text-sm text-blue-800 mt-1">
                                                Subscribed {{ $subscriber->subscribed_at->diffForHumans() }} • 
                                                Status: {{ $subscriber->is_active ? 'Active' : 'Inactive' }}
                                            </p>
                                        </div>

                                        <!-- Email Address -->
                                        <div>
                                            <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                                                Email Address *
                                            </label>
                                            <input type="email" 
                                                   id="email" 
                                                   name="email" 
                                                   value="{{ old('email', $subscriber->email) }}"
                                                   required 
                                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('email') border-red-500 @enderror text-sm"
                                                   placeholder="subscriber@example.com">
                                            @error('email')
                                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                            @enderror
                                            <p class="mt-1 text-sm text-gray-500">
                                                The email address must be unique across all subscribers.
                                            </p>
                                        </div>

                                        <!-- Name -->
                                        <div>
                                            <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                                                Name (Optional)
                                            </label>
                                            <input type="text" 
                                                   id="name" 
                                                   name="name" 
                                                   value="{{ old('name', $subscriber->name) }}"
                                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('name') border-red-500 @enderror text-sm"
                                                   placeholder="Subscriber's full name">
                                            @error('name')
                                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                            @enderror
                                            <p class="mt-1 text-sm text-gray-500">
                                                Name helps personalize newsletter emails.
                                            </p>
                                        </div>

                                        <!-- Status -->
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                                Subscription Status
                                            </label>
                                            <div class="space-y-3">
                                                <label class="flex items-center">
                                                    <input type="radio" 
                                                           name="is_active" 
                                                           value="1" 
                                                           {{ old('is_active', $subscriber->is_active) ? 'checked' : '' }}
                                                           class="text-blue-600 focus:ring-blue-500">
                                                    <span class="ml-2 text-sm">
                                                        <span class="font-medium text-green-600">Active</span> - 
                                                        Subscriber will receive newsletters
                                                    </span>
                                                </label>
                                                <label class="flex items-center">
                                                    <input type="radio" 
                                                           name="is_active" 
                                                           value="0" 
                                                           {{ !old('is_active', $subscriber->is_active) ? 'checked' : '' }}
                                                           class="text-blue-600 focus:ring-blue-500">
                                                    <span class="ml-2 text-sm">
                                                        <span class="font-medium text-red-600">Inactive</span> - 
                                                        Subscriber will not receive newsletters
                                                    </span>
                                                </label>
                                            </div>
                                            @if($subscriber->unsubscribed_at)
                                                <div class="mt-3 p-3 bg-yellow-50 border border-yellow-200 rounded-lg">
                                                    <p class="text-sm text-yellow-800">
                                                        <i class="fas fa-exclamation-triangle mr-1"></i>
                                                        This subscriber unsubscribed on {{ $subscriber->unsubscribed_at->format('M j, Y') }}.
                                                        Activating them will clear the unsubscribe date.
                                                    </p>
                                                </div>
                                            @endif
                                        </div>

                                        <!-- Advanced Options -->
                                        <div class="border-t pt-6">
                                            <h4 class="text-sm font-medium text-gray-900 mb-4">Advanced Options</h4>
                                            
                                            <div class="space-y-4">
                                                <!-- Reset Unsubscribe Token -->
                                                <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                                                    <div>
                                                        <h5 class="text-sm font-medium text-gray-900">Reset Unsubscribe Token</h5>
                                                        <p class="text-sm text-gray-600">Generate a new unsubscribe token for security</p>
                                                    </div>
                                                    <button type="button" 
                                                            onclick="resetToken()"
                                                            class="bg-gray-600 hover:bg-gray-700 text-white px-3 py-1 rounded text-sm font-medium transition-colors duration-200">
                                                        Reset Token
                                                    </button>
                                                </div>

                                                <!-- Subscription Date -->
                                                <div>
                                                    <label for="subscribed_at" class="block text-sm font-medium text-gray-700 mb-2">
                                                        Subscription Date
                                                    </label>
                                                    <input type="datetime-local" 
                                                           id="subscribed_at" 
                                                           name="subscribed_at" 
                                                           value="{{ old('subscribed_at', $subscriber->subscribed_at->format('Y-m-d\TH:i')) }}"
                                                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm">
                                                    <p class="mt-1 text-sm text-gray-500">
                                                        When this subscriber originally signed up.
                                                    </p>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Change Log -->
                                        <div class="bg-gray-50 border border-gray-200 rounded-lg p-4">
                                            <h5 class="text-sm font-medium text-gray-900 mb-2">
                                                <i class="fas fa-history mr-1"></i>Change History
                                            </h5>
                                            <div class="text-sm text-gray-600 space-y-1">
                                                <p>Created: {{ $subscriber->created_at->format('M j, Y g:i A') }}</p>
                                                @if($subscriber->updated_at != $subscriber->created_at)
                                                    <p>Last Modified: {{ $subscriber->updated_at->format('M j, Y g:i A') }}</p>
                                                @endif
                                                @if($subscriber->unsubscribed_at)
                                                    <p>Unsubscribed: {{ $subscriber->unsubscribed_at->format('M j, Y g:i A') }}</p>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Form Actions -->
                                    <div class="px-6 py-4 bg-gray-50 border-t border-gray-200 flex justify-between items-center">
                                        <div class="text-sm text-gray-600">
                                            <i class="fas fa-asterisk text-red-500 text-xs mr-1"></i>
                                            Fields marked with * are required
                                        </div>
                                        
                                        <div class="flex space-x-3">
                                            <a href="{{ route('admin.newsletter.show', $subscriber) }}" 
                                               class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 font-medium transition-colors duration-200 text-sm">
                                                Cancel
                                            </a>
                                            <button type="submit" 
                                                    class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg font-medium transition-colors duration-200 text-sm">
                                                <i class="fas fa-save mr-2"></i>Update Subscriber
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <!-- Sidebar Info -->
                        <div class="space-y-6">
                            <!-- Current Information -->
                            <div class="bg-white rounded-lg shadow">
                                <div class="p-6">
                                    <h3 class="text-sm font-semibold text-gray-900 mb-4">
                                        <i class="fas fa-info-circle mr-2"></i>Current Information
                                    </h3>

                                    <div class="space-y-3">
                                        <div>
                                            <label class="block text-xs font-medium text-gray-500 uppercase tracking-wider">Email</label>
                                            <p class="text-sm text-gray-900 font-medium">{{ $subscriber->email }}</p>
                                        </div>

                                        <div>
                                            <label class="block text-xs font-medium text-gray-500 uppercase tracking-wider">Name</label>
                                            <p class="text-sm text-gray-900">{{ $subscriber->name ?: 'Not provided' }}</p>
                                        </div>

                                        <div>
                                            <label class="block text-xs font-medium text-gray-500 uppercase tracking-wider">Status</label>
                                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium {{ $subscriber->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                                {{ $subscriber->is_active ? 'Active' : 'Inactive' }}
                                            </span>
                                        </div>

                                        <div>
                                            <label class="block text-xs font-medium text-gray-500 uppercase tracking-wider">Subscribed</label>
                                            <p class="text-sm text-gray-900">{{ $subscriber->subscribed_at->format('M j, Y') }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Help & Tips -->
                            <div class="bg-white rounded-lg shadow">
                                <div class="p-6">
                                    <h3 class="text-sm font-semibold text-gray-900 mb-4">
                                        <i class="fas fa-lightbulb mr-2"></i>Tips
                                    </h3>

                                    <div class="space-y-3 text-sm text-gray-600">
                                        <div class="flex items-start">
                                            <i class="fas fa-check text-green-500 mr-2 mt-0.5"></i>
                                            <span>Email changes will take effect immediately</span>
                                        </div>
                                        <div class="flex items-start">
                                            <i class="fas fa-check text-green-500 mr-2 mt-0.5"></i>
                                            <span>Status changes affect newsletter delivery</span>
                                        </div>
                                        <div class="flex items-start">
                                            <i class="fas fa-check text-green-500 mr-2 mt-0.5"></i>
                                            <span>Names help personalize email content</span>
                                        </div>
                                        <div class="flex items-start">
                                            <i class="fas fa-exclamation-triangle text-yellow-500 mr-2 mt-0.5"></i>
                                            <span>Token reset will invalidate existing unsubscribe links</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Quick Actions -->
                            <div class="bg-white rounded-lg shadow">
                                <div class="p-6">
                                    <h3 class="text-sm font-semibold text-gray-900 mb-4">
                                        <i class="fas fa-bolt mr-2"></i>Quick Actions
                                    </h3>

                                    <div class="space-y-3">
                                        <button onclick="sendTestEmail()" 
                                                class="w-full bg-purple-600 hover:bg-purple-700 text-white px-4 py-2 rounded-lg font-medium text-sm transition-colors duration-200">
                                            <i class="fas fa-envelope mr-2"></i>Send Test Email
                                        </button>

                                        <a href="{{ route('newsletter.unsubscribe', $subscriber->unsubscribe_token) }}" 
                                           target="_blank"
                                           class="block w-full bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg font-medium text-sm text-center transition-colors duration-200">
                                            <i class="fas fa-external-link-alt mr-2"></i>View Unsubscribe Page
                                        </a>
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

// Email validation as user types
document.getElementById('email').addEventListener('input', function() {
    const email = this.value;
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    
    if (email && !emailRegex.test(email)) {
        this.classList.add('border-red-500');
        this.classList.remove('border-gray-300');
    } else {
        this.classList.remove('border-red-500');
        this.classList.add('border-gray-300');
    }
});

function resetToken() {
    if (confirm('Are you sure you want to reset the unsubscribe token?\n\nThis will invalidate any existing unsubscribe links sent to this subscriber.')) {
        // Add a hidden input to trigger token reset
        const form = document.querySelector('form');
        const input = document.createElement('input');
        input.type = 'hidden';
        input.name = 'reset_token';
        input.value = '1';
        form.appendChild(input);
        
        alert('Token will be reset when you save the form.');
    }
}

function sendTestEmail() {
    const email = document.getElementById('email').value;
    if (!email) {
        alert('Please enter an email address first');
        return;
    }
    
    if (confirm(`Send a test newsletter to ${email}?`)) {
        alert('Test email functionality would be implemented here');
    }
}

// Form validation before submit
document.querySelector('form').addEventListener('submit', function(e) {
    const email = document.getElementById('email').value.trim();
    
    if (!email) {
        e.preventDefault();
        alert('Please enter an email address');
        document.getElementById('email').focus();
        return false;
    }
    
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailRegex.test(email)) {
        e.preventDefault();
        alert('Please enter a valid email address');
        document.getElementById('email').focus();
        return false;
    }
});

// Auto-save draft (optional feature)
let autoSaveTimer;
function autoSave() {
    clearTimeout(autoSaveTimer);
    autoSaveTimer = setTimeout(() => {
        // Auto-save logic could be implemented here
        console.log('Auto-saving draft...');
    }, 3000);
}

// Trigger auto-save on input changes
document.querySelectorAll('input, textarea, select').forEach(element => {
    element.addEventListener('input', autoSave);
});
</script>
@endsection