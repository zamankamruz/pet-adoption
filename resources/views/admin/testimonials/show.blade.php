<?php
// File: show.blade.php
// Path: /resources/views/admin/testimonials/show.blade.php
?>

@extends('layouts.admin')

@section('title', 'View Testimonial')

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
                        <svg class="text-gray-400 group-hover:text-gray-500 mr-3 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V7a2 2 0 012-2h3l2-2h4l2 2h3a2 2 0 012 2v11a2 2 0 01-2 2zM7 10h10M7 14h10M7 18h10"/>
                        </svg>
                        News
                    </a>

                    <!-- Testimonials -->
                    <a href="{{ route('admin.testimonials.index') }}" 
                       class="bg-purple-100 text-purple-900 group flex items-center px-2 py-2 text-sm font-medium rounded-md">
                        <svg class="text-purple-500 mr-3 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"/>
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
                    <h1 class="text-lg font-bold text-gray-900">Testimonial Details</h1>
                    <p class="text-sm text-gray-600">View testimonial from {{ $testimonial->name }}</p>
                </div>
                
                <!-- Action Buttons -->
                <div class="flex items-center space-x-4">
                    <div class="flex space-x-2">
                        <a href="{{ route('admin.testimonials.edit', $testimonial) }}" class="inline-flex items-center px-4 py-2 bg-yellow-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-yellow-700 active:bg-yellow-900 focus:outline-none focus:border-yellow-900 focus:ring ring-yellow-300 disabled:opacity-25 transition ease-in-out duration-150">
                            <i class="fas fa-edit mr-2"></i> Edit
                        </a>
                        <a href="{{ route('admin.testimonials.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                            <i class="fas fa-arrow-left mr-2"></i> Back to List
                        </a>
                    </div>
                    
                    <!-- User Menu -->
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

        <!-- Dashboard Content -->
        <main class="flex-1 relative overflow-y-auto focus:outline-none">
            <div class="py-6">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 md:px-8">
                    
                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                        <!-- Main Content -->
                        <div class="lg:col-span-2">
                            <!-- Testimonial Content -->
                            <div class="bg-white shadow rounded-lg mb-6">
                                <div class="px-6 py-4 border-b border-gray-200">
                                    <h3 class="text-lg font-medium text-gray-900">Testimonial Content</h3>
                                </div>
                                <div class="p-6">
                                    <!-- Customer Info -->
                                    <div class="flex items-start space-x-4 mb-6">
                                        <img src="{{ $testimonial->avatar_url }}" alt="{{ $testimonial->name }}" 
                                             class="w-20 h-20 rounded-lg object-cover border border-gray-300">
                                        <div class="flex-1">
                                            <h4 class="text-xl font-semibold text-gray-900 mb-1">{{ $testimonial->name }}</h4>
                                            @if($testimonial->email)
                                                <p class="text-gray-600 mb-2">{{ $testimonial->email }}</p>
                                            @endif
                                            <div class="flex items-center text-yellow-400 mb-2">
                                                @for($i = 1; $i <= 5; $i++)
                                                    <i class="fas fa-star{{ $i <= $testimonial->rating ? '' : '-o' }}"></i>
                                                @endfor
                                                <span class="ml-2 text-gray-600">({{ $testimonial->rating }}/5 stars)</span>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Testimonial Text -->
                                    <div class="testimonial-content bg-gray-50 p-6 rounded-lg relative">
                                        <i class="fas fa-quote-left text-purple-400 text-3xl mb-4 opacity-30"></i>
                                        <p class="text-lg leading-relaxed text-gray-800 mb-4">{{ $testimonial->testimonial }}</p>
                                        <i class="fas fa-quote-right text-purple-400 text-3xl float-right opacity-30"></i>
                                        <div class="clear-both"></div>
                                    </div>

                                    <!-- Associated Records -->
                                    @if($testimonial->user || $testimonial->pet)
                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
                                            @if($testimonial->user)
                                                <div>
                                                    <h6 class="text-blue-600 font-medium mb-3">Associated User</h6>
                                                    <div class="border border-blue-200 rounded-lg p-4">
                                                        <div class="flex items-center mb-3">
                                                            <img src="{{ $testimonial->user->avatar_url }}" alt="{{ $testimonial->user->name }}" 
                                                                 class="w-10 h-10 rounded-full mr-3">
                                                            <div>
                                                                <div class="font-semibold text-gray-900">{{ $testimonial->user->name }}</div>
                                                                <div class="text-sm text-gray-500">{{ $testimonial->user->email }}</div>
                                                            </div>
                                                        </div>
                                                        <a href="{{ route('admin.users.show', $testimonial->user) }}" class="inline-flex items-center px-3 py-2 border border-blue-300 rounded-md text-sm font-medium text-blue-700 bg-blue-50 hover:bg-blue-100 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                                            View User Profile
                                                        </a>
                                                    </div>
                                                </div>
                                            @endif

                                            @if($testimonial->pet)
                                                <div>
                                                    <h6 class="text-green-600 font-medium mb-3">Associated Pet</h6>
                                                    <div class="border border-green-200 rounded-lg p-4">
                                                        <div class="flex items-center mb-3">
                                                            <img src="{{ $testimonial->pet->main_image_url }}" alt="{{ $testimonial->pet->name }}" 
                                                                 class="w-10 h-10 rounded object-cover mr-3">
                                                            <div>
                                                                <div class="font-semibold text-gray-900">{{ $testimonial->pet->name }}</div>
                                                                <div class="text-sm text-gray-500">{{ $testimonial->pet->breed->name }} • {{ ucfirst($testimonial->pet->gender) }}</div>
                                                            </div>
                                                        </div>
                                                        <a href="{{ route('admin.pets.show', $testimonial->pet) }}" class="inline-flex items-center px-3 py-2 border border-green-300 rounded-md text-sm font-medium text-green-700 bg-green-50 hover:bg-green-100 focus:outline-none focus:ring-2 focus:ring-green-500">
                                                            View Pet Profile
                                                        </a>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- Sidebar -->
                        <div class="lg:col-span-1 space-y-6">
                            <!-- Status Information -->
                            <div class="bg-white shadow rounded-lg">
                                <div class="px-6 py-4 border-b border-gray-200">
                                    <h3 class="text-lg font-medium text-gray-900">Status Information</h3>
                                </div>
                                <div class="p-6">
                                    <div class="grid grid-cols-2 gap-4 mb-4">
                                        <div>
                                            <p class="text-sm text-gray-500">Approval Status:</p>
                                            <div class="mt-1">
                                                @if($testimonial->is_approved)
                                                    <span class="inline-flex px-2 py-1 text-sm font-semibold rounded-full bg-green-100 text-green-800">
                                                        Approved
                                                    </span>
                                                @else
                                                    <span class="inline-flex px-2 py-1 text-sm font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                                        Pending
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div>
                                            <p class="text-sm text-gray-500">Featured:</p>
                                            <div class="mt-1">
                                                @if($testimonial->is_featured)
                                                    <span class="inline-flex px-2 py-1 text-sm font-semibold rounded-full bg-purple-100 text-purple-800">
                                                        Featured
                                                    </span>
                                                @else
                                                    <span class="inline-flex px-2 py-1 text-sm font-semibold rounded-full bg-gray-100 text-gray-800">
                                                        Normal
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="grid grid-cols-2 gap-4 mb-4">
                                        <div>
                                            <p class="text-sm text-gray-500">Created:</p>
                                            <p class="font-semibold text-gray-900">{{ $testimonial->created_at->format('M d, Y') }}</p>
                                            <p class="text-sm text-gray-500">{{ $testimonial->created_at->diffForHumans() }}</p>
                                        </div>
                                        <div>
                                            <p class="text-sm text-gray-500">Last Updated:</p>
                                            <p class="font-semibold text-gray-900">{{ $testimonial->updated_at->format('M d, Y') }}</p>
                                            <p class="text-sm text-gray-500">{{ $testimonial->updated_at->diffForHumans() }}</p>
                                        </div>
                                    </div>

                                    <div>
                                        <p class="text-sm text-gray-500">Rating:</p>
                                        <div class="flex items-center mt-1">
                                            <div class="text-yellow-400 mr-2">
                                                @for($i = 1; $i <= 5; $i++)
                                                    <i class="fas fa-star{{ $i <= $testimonial->rating ? '' : '-o' }}"></i>
                                                @endfor
                                            </div>
                                            <span class="font-semibold text-gray-900">{{ $testimonial->rating }}/5</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Quick Actions -->
                            <div class="bg-white shadow rounded-lg">
                                <div class="px-6 py-4 border-b border-gray-200">
                                    <h3 class="text-lg font-medium text-green-600">Quick Actions</h3>
                                </div>
                                <div class="p-6">
                                    <div class="space-y-3">
                                        @if(!$testimonial->is_approved)
                                            <form action="{{ route('admin.testimonials.approve', $testimonial) }}" method="POST" class="w-full">
                                                @csrf
                                                <button type="submit" class="w-full inline-flex items-center justify-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 active:bg-green-900 focus:outline-none focus:border-green-900 focus:ring ring-green-300 disabled:opacity-25 transition ease-in-out duration-150">
                                                    <i class="fas fa-check mr-2"></i> Approve Testimonial
                                                </button>
                                            </form>
                                        @endif
                                        
                                        <form action="{{ route('admin.testimonials.feature', $testimonial) }}" method="POST" class="w-full">
                                            @csrf
                                            <button type="submit" class="w-full inline-flex items-center justify-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-900 focus:outline-none focus:border-blue-900 focus:ring ring-blue-300 disabled:opacity-25 transition ease-in-out duration-150">
                                                <i class="fas fa-star mr-2"></i> 
                                                {{ $testimonial->is_featured ? 'Remove from Featured' : 'Make Featured' }}
                                            </button>
                                        </form>
                                        
                                        <a href="{{ route('admin.testimonials.edit', $testimonial) }}" class="w-full inline-flex items-center justify-center px-4 py-2 bg-yellow-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-yellow-700 active:bg-yellow-900 focus:outline-none focus:border-yellow-900 focus:ring ring-yellow-300 disabled:opacity-25 transition ease-in-out duration-150">
                                            <i class="fas fa-edit mr-2"></i> Edit Testimonial
                                        </a>
                                        
                                        <form action="{{ route('admin.testimonials.destroy', $testimonial) }}" method="POST" 
                                              onsubmit="return confirm('Are you sure you want to delete this testimonial?')" class="w-full">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="w-full inline-flex items-center justify-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 active:bg-red-900 focus:outline-none focus:border-red-900 focus:ring ring-red-300 disabled:opacity-25 transition ease-in-out duration-150">
                                                <i class="fas fa-trash mr-2"></i> Delete Testimonial
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <!-- Preview Card -->
                            <div class="bg-white shadow rounded-lg">
                                <div class="px-6 py-4 border-b border-gray-200">
                                    <h3 class="text-lg font-medium text-blue-600">
                                        <i class="fas fa-eye mr-2"></i> Website Preview
                                    </h3>
                                </div>
                                <div class="p-6">
                                    <div class="testimonial-preview bg-gray-50 p-4 rounded-lg border-2 border-dashed border-gray-300">
                                        <div class="text-center">
                                            <img src="{{ $testimonial->avatar_url }}" alt="{{ $testimonial->name }}" 
                                                 class="w-15 h-15 rounded-full mx-auto mb-3 object-cover">
                                            <div class="flex justify-center text-yellow-400 mb-2">
                                                @for($i = 1; $i <= 5; $i++)
                                                    <i class="fas fa-star{{ $i <= $testimonial->rating ? '' : '-o' }}"></i>
                                                @endfor
                                            </div>
                                            <h6 class="font-semibold text-gray-900 mb-2">{{ $testimonial->name }}</h6>
                                            <p class="text-sm text-gray-600 mb-0">
                                                "{{ Str::limit($testimonial->testimonial, 100) }}"
                                            </p>
                                            @if($testimonial->pet)
                                                <div class="mt-2">
                                                    <span class="text-sm text-purple-600">
                                                        <i class="fas fa-paw"></i> About {{ $testimonial->pet->name }}
                                                    </span>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <p class="text-sm text-gray-500 mt-2">This is how the testimonial appears on your website.</p>
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
            <!-- Mobile sidebar content (same navigation as desktop) -->
            <div class="flex-1 h-0 pt-5 pb-4 overflow-y-auto">
                <div class="flex items-center flex-shrink-0 px-4 mb-8">
                    <div class="w-8 h-8 bg-purple-600 rounded-full flex items-center justify-center mr-2">
                        <i class="fas fa-paw text-white text-sm"></i>
                    </div>
                    <span class="text-xl font-bold text-gray-800">Furry Friends</span>
                </div>
                <!-- Copy the same navigation from desktop here -->
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

// Close menus when clicking outside
document.addEventListener('click', function(event) {
    const userMenu = document.getElementById('userMenu');
    
    if (!event.target.closest('button[onclick="toggleUserMenu()"]')) {
        userMenu.classList.add('hidden');
    }
});
</script>
@endsection