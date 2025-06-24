{{-- File: resources/views/admin/users/show.blade.php --}}
<?php
// File: show.blade.php
// Path: /resources/views/admin/users/show.blade.php
?>

@extends('layouts.admin')

@section('title', 'User Details - ' . $user->name)

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
                       class="bg-purple-100 text-purple-900 group flex items-center px-2 py-2 text-sm font-medium rounded-md">
                        <svg class="text-purple-500 mr-3 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
                       class="text-gray-600 hover:bg-gray-50 hover:text-gray-900 group flex items-center px-2 py-2 text-sm font-medium rounded-md">
                        <svg class="text-gray-400 group-hover:text-gray-500 mr-3 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
                    <h1 class="text-lg font-semibold text-gray-900">{{ $user->name }}</h1>
                    <p class="text-xs text-gray-500">User ID: {{ $user->id }} • Member since {{ $user->created_at->format('M d, Y') }}</p>
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
            <!-- Header Actions -->
            <div class="bg-white shadow border-b border-gray-200">
                <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-end items-center">
                        <div class="flex space-x-3">
                            @if(!$user->is_verified)
                                <form method="POST" action="{{ route('admin.users.verify', $user) }}" class="inline">
                                    @csrf
                                    <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-green-600 hover:bg-green-700">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                        Verify User
                                    </button>
                                </form>
                            @endif
                            
                            @if($user->is_active)
                                <form method="POST" action="{{ route('admin.users.ban', $user) }}" class="inline">
                                    @csrf
                                    <button type="submit" onclick="return confirm('Are you sure you want to ban this user?')" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-red-600 hover:bg-red-700">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728L5.636 5.636m12.728 12.728L18.364 5.636M5.636 18.364l12.728-12.728"/>
                                        </svg>
                                        Ban User
                                    </button>
                                </form>
                            @else
                                <form method="POST" action="{{ route('admin.users.unban', $user) }}" class="inline">
                                    @csrf
                                    <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-green-600 hover:bg-green-700">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                        Unban User
                                    </button>
                                </form>
                            @endif

                            <form method="POST" action="#" class="inline">
                                @csrf
                                <button type="submit" onclick="return confirm('Do you want to impersonate this user?')" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"/>
                                    </svg>
                                    Impersonate
                                </button>
                            </form>

                            <a href="{{ route('admin.users.edit', $user) }}" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                </svg>
                                Edit User
                            </a>

                            <a href="{{ route('admin.users.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                                </svg>
                                Back to Users
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                <!-- Status Badges -->
                <div class="flex items-center space-x-3 mb-6">
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium
                        {{ $user->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                        {{ $user->is_active ? 'Active' : 'Banned' }}
                    </span>
                    
                    @if($user->is_verified)
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                            Verified
                        </span>
                    @else
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-yellow-100 text-yellow-800">
                            Unverified
                        </span>
                    @endif
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                    <!-- Main Content -->
                    <div class="lg:col-span-2 space-y-6">
                        <!-- User Profile Information -->
                        <div class="bg-white shadow rounded-lg">
                            <div class="px-6 py-4 border-b border-gray-200">
                                <h3 class="text-lg font-medium text-gray-900">Profile Information</h3>
                            </div>
                            <div class="px-6 py-4">
                                <div class="flex items-center space-x-6 mb-6">
                                    <img class="h-20 w-20 rounded-full object-cover" src="{{ $user->avatar_url }}" alt="{{ $user->name }}">
                                    <div>
                                        <h4 class="text-xl font-semibold text-gray-900">{{ $user->name }}</h4>
                                        <p class="text-gray-600">{{ $user->email }}</p>
                                        @if($user->phone)
                                            <p class="text-gray-600">{{ $user->phone }}</p>
                                        @endif
                                    </div>
                                </div>

                                @if($user->bio)
                                    <div class="mb-4">
                                        <h5 class="text-sm font-medium text-gray-700 mb-2">Bio</h5>
                                        <p class="text-gray-600">{{ $user->bio }}</p>
                                    </div>
                                @endif

                                @if($user->address || $user->city || $user->state)
                                    <div>
                                        <h5 class="text-sm font-medium text-gray-700 mb-2">Address</h5>
                                        <div class="text-gray-600">
                                            @if($user->address)
                                                <p>{{ $user->address }}</p>
                                            @endif
                                            @if($user->city || $user->state)
                                                <p>
                                                    {{ $user->city }}{{ $user->city && $user->state ? ', ' : '' }}{{ $user->state }}
                                                    {{ $user->zip_code ? ' ' . $user->zip_code : '' }}
                                                </p>
                                            @endif
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- Recent Activity -->
                        @if($recentActivity->count() > 0)
                            <div class="bg-white shadow rounded-lg">
                                <div class="px-6 py-4 border-b border-gray-200">
                                    <h3 class="text-lg font-medium text-gray-900">Recent Activity</h3>
                                </div>
                                <div class="divide-y divide-gray-200">
                                    @foreach($recentActivity as $activity)
                                        <div class="px-6 py-4">
                                            <div class="flex items-center justify-between">
                                                <div class="flex items-center space-x-3">
                                                    <div class="flex-shrink-0">
                                                        @if($activity->type === 'adoption_request')
                                                            <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center">
                                                                <svg class="w-4 h-4 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                                                    <path d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z"/>
                                                                </svg>
                                                            </div>
                                                        @else
                                                            <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center">
                                                                <svg class="w-4 h-4 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                                                    <path d="M10 12a2 2 0 100-4 2 2 0 000 4z"/>
                                                                    <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"/>
                                                                </svg>
                                                            </div>
                                                        @endif
                                                    </div>
                                                    <div>
                                                        <p class="text-sm font-medium text-gray-900">{{ $activity->description }}</p>
                                                        <p class="text-sm text-gray-500">{{ $activity->date->diffForHumans() }}</p>
                                                    </div>
                                                </div>
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                                    {{ $activity->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : 
                                                       ($activity->status === 'completed' ? 'bg-green-100 text-green-800' : 
                                                       ($activity->status === 'available' ? 'bg-blue-100 text-blue-800' : 'bg-gray-100 text-gray-800')) }}">
                                                    {{ ucfirst($activity->status) }}
                                                </span>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        <!-- User's Pets -->
                        @if($user->pets->count() > 0)
                            <div class="bg-white shadow rounded-lg">
                                <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
                                    <h3 class="text-lg font-medium text-gray-900">Listed Pets ({{ $user->pets->count() }})</h3>
                                    <a href="{{ route('admin.users.pets', $user) }}" class="text-blue-600 hover:text-blue-900 text-sm font-medium">View All</a>
                                </div>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 p-6">
                                    @foreach($user->pets->take(4) as $pet)
                                        <div class="flex items-center space-x-4 p-4 border border-gray-200 rounded-lg">
                                            <img src="{{ $pet->main_image_url }}" alt="{{ $pet->name }}" class="w-16 h-16 rounded-lg object-cover">
                                            <div class="flex-1 min-w-0">
                                                <p class="text-sm font-medium text-gray-900">{{ $pet->name }}</p>
                                                <p class="text-sm text-gray-500">{{ $pet->breed->name }}</p>
                                                <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium
                                                    {{ $pet->status === 'available' ? 'bg-green-100 text-green-800' : 
                                                       ($pet->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : 'bg-gray-100 text-gray-800') }}">
                                                    {{ ucfirst($pet->status) }}
                                                </span>
                                            </div>
                                            <a href="{{ route('admin.pets.show', $pet) }}" class="text-blue-600 hover:text-blue-900 text-sm">View</a>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        <!-- Adoption Requests -->
                        @if($user->adoptionRequests->count() > 0)
                            <div class="bg-white shadow rounded-lg">
                                <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
                                    <h3 class="text-lg font-medium text-gray-900">Adoption Requests ({{ $user->adoptionRequests->count() }})</h3>
                                    <a href="{{ route('admin.users.adoptions', $user) }}" class="text-blue-600 hover:text-blue-900 text-sm font-medium">View All</a>
                                </div>
                                <div class="divide-y divide-gray-200">
                                    @foreach($user->adoptionRequests->take(5) as $adoption)
                                        <div class="px-6 py-4">
                                            <div class="flex items-center justify-between">
                                                <div class="flex items-center space-x-3">
                                                    <img src="{{ $adoption->pet->main_image_url }}" alt="{{ $adoption->pet->name }}" class="w-10 h-10 rounded-lg object-cover">
                                                    <div>
                                                        <p class="text-sm font-medium text-gray-900">{{ $adoption->pet->name }}</p>
                                                        <p class="text-sm text-gray-500">{{ $adoption->requested_at->format('M d, Y') }}</p>
                                                    </div>
                                                </div>
                                                <div class="flex items-center space-x-3">
                                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                                        {{ $adoption->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : 
                                                           ($adoption->status === 'approved' ? 'bg-green-100 text-green-800' : 
                                                           ($adoption->status === 'completed' ? 'bg-blue-100 text-blue-800' : 'bg-red-100 text-red-800')) }}">
                                                        {{ ucfirst($adoption->status) }}
                                                    </span>
                                                    <a href="{{ route('admin.adoptions.show', $adoption) }}" class="text-blue-600 hover:text-blue-900 text-sm">View</a>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </div>

                    <!-- Sidebar -->
                    <div class="space-y-6">
                        <!-- User Statistics -->
                        <div class="bg-white shadow rounded-lg">
                            <div class="px-6 py-4 border-b border-gray-200">
                                <h3 class="text-lg font-medium text-gray-900">User Statistics</h3>
                            </div>
                            <div class="px-6 py-4">
                                <dl class="space-y-4">
                                    <div class="flex justify-between">
                                        <dt class="text-sm text-gray-500">Adoption Requests:</dt>
                                        <dd class="text-sm font-medium text-gray-900">{{ $stats['adoption_requests'] }}</dd>
                                    </div>
                                    <div class="flex justify-between">
                                        <dt class="text-sm text-gray-500">Pending Adoptions:</dt>
                                        <dd class="text-sm font-medium text-gray-900">{{ $stats['pending_adoptions'] }}</dd>
                                    </div>
                                    <div class="flex justify-between">
                                        <dt class="text-sm text-gray-500">Completed Adoptions:</dt>
                                        <dd class="text-sm font-medium text-gray-900">{{ $stats['completed_adoptions'] }}</dd>
                                    </div>
                                    <div class="flex justify-between">
                                        <dt class="text-sm text-gray-500">Pets Listed:</dt>
                                        <dd class="text-sm font-medium text-gray-900">{{ $stats['pets_listed'] }}</dd>
                                    </div>
                                    <div class="flex justify-between">
                                        <dt class="text-sm text-gray-500">Active Pets:</dt>
                                        <dd class="text-sm font-medium text-gray-900">{{ $stats['active_pets'] }}</dd>
                                    </div>
                                    <div class="flex justify-between">
                                        <dt class="text-sm text-gray-500">Favorites:</dt>
                                        <dd class="text-sm font-medium text-gray-900">{{ $stats['favorites'] }}</dd>
                                    </div>
                                    <div class="flex justify-between">
                                        <dt class="text-sm text-gray-500">Rehoming Requests:</dt>
                                        <dd class="text-sm font-medium text-gray-900">{{ $stats['rehoming_requests'] }}</dd>
                                    </div>
                                </dl>
                            </div>
                        </div>

                        <!-- Account Information -->
                        <div class="bg-white shadow rounded-lg">
                            <div class="px-6 py-4 border-b border-gray-200">
                                <h3 class="text-lg font-medium text-gray-900">Account Information</h3>
                            </div>
                            <div class="px-6 py-4">
                                <dl class="space-y-3">
                                    <div class="flex justify-between text-sm">
                                        <dt class="text-gray-500">User ID:</dt>
                                        <dd class="text-gray-900 font-medium">{{ $user->id }}</dd>
                                    </div>
                                    <div class="flex justify-between text-sm">
                                        <dt class="text-gray-500">Email Verified:</dt>
                                        <dd class="text-gray-900 font-medium">
                                            {{ $user->email_verified_at ? $user->email_verified_at->format('M d, Y') : 'No' }}
                                        </dd>
                                    </div>
                                    <div class="flex justify-between text-sm">
                                        <dt class="text-gray-500">Joined:</dt>
                                        <dd class="text-gray-900 font-medium">{{ $user->created_at->format('M d, Y') }}</dd>
                                    </div>
                                    <div class="flex justify-between text-sm">
                                        <dt class="text-gray-500">Last Login:</dt>
                                        <dd class="text-gray-900 font-medium">
                                            {{ $user->last_login_at ? $user->last_login_at->diffForHumans() : 'Never' }}
                                        </dd>
                                    </div>
                                    <div class="flex justify-between text-sm">
                                        <dt class="text-gray-500">Last Updated:</dt>
                                        <dd class="text-gray-900 font-medium">{{ $user->updated_at->diffForHumans() }}</dd>
                                    </div>
                                </dl>
                            </div>
                        </div>

                        <!-- Quick Actions -->
                        <div class="bg-white shadow rounded-lg">
                            <div class="px-6 py-4 border-b border-gray-200">
                                <h3 class="text-lg font-medium text-gray-900">Quick Actions</h3>
                            </div>
                            <div class="px-6 py-4 space-y-3">
                                <a href="{{ route('admin.users.adoptions', $user) }}" class="w-full inline-flex justify-center items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                                    View All Adoptions
                                </a>
                                
                                <a href="{{ route('admin.users.pets', $user) }}" class="w-full inline-flex justify-center items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                                    View All Pets
                                </a>
                                
                                <button onclick="deleteUser()" class="w-full inline-flex justify-center items-center px-4 py-2 border border-red-300 rounded-md shadow-sm text-sm font-medium text-red-700 bg-white hover:bg-red-50">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                    </svg>
                                    Delete User
                                </button>
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

// Existing user functionality
function deleteUser() {
    if (confirm('Are you sure you want to delete this user? This action cannot be undone.')) {
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = '{{ route("admin.users.destroy", $user) }}';
        
        const csrfToken = document.createElement('input');
        csrfToken.type = 'hidden';
        csrfToken.name = '_token';
        csrfToken.value = document.querySelector('meta[name="csrf-token"]').content;
        
        const methodField = document.createElement('input');
        methodField.type = 'hidden';
        methodField.name = '_method';
        methodField.value = 'DELETE';
        
        form.appendChild(csrfToken);
        form.appendChild(methodField);
        document.body.appendChild(form);
        form.submit();
    }
}
</script>
@endsection