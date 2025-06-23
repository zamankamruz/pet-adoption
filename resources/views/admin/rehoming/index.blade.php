<?php
// File: index.blade.php
// Path: /resources/views/admin/rehoming/index.blade.php
?>

@extends('layouts.admin')

@section('title', 'Rehoming Requests Management')

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
                        <span class="ml-auto bg-gray-200 text-gray-600 text-xs rounded-full px-2 py-1">
                            {{ \App\Models\User::where('is_admin', false)->count() }}
                        </span>
                    </a>

                    <!-- Pets -->
                    <a href="{{ route('admin.pets.index') }}" 
                       class="text-gray-600 hover:bg-gray-50 hover:text-gray-900 group flex items-center px-2 py-2 text-sm font-medium rounded-md">
                        <svg class="text-gray-400 group-hover:text-gray-500 mr-3 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.5 12C3.12 12 2 13.12 2 14.5S3.12 17 4.5 17 7 15.88 7 14.5 5.88 12 4.5 12M19.5 12C18.12 12 17 13.12 17 14.5S18.12 17 19.5 17 22 15.88 22 14.5 20.88 12 19.5 12M12 3.5C10.62 3.5 9.5 4.62 9.5 6S10.62 8.5 12 8.5 14.5 7.38 14.5 6 13.38 3.5 12 3.5M12 20.5C10.9 20.5 10 19.6 10 18.5S10.9 16.5 12 16.5 14 17.4 14 18.5 13.1 20.5 12 20.5Z"/>
                        </svg>
                        Pets
                        <span class="ml-auto bg-gray-200 text-gray-600 text-xs rounded-full px-2 py-1">
                            {{ \App\Models\Pet::count() }}
                        </span>
                    </a>

                    <!-- Adoptions -->
                    <a href="{{ route('admin.adoptions.index') }}" 
                       class="text-gray-600 hover:bg-gray-50 hover:text-gray-900 group flex items-center px-2 py-2 text-sm font-medium rounded-md">
                        <svg class="text-gray-400 group-hover:text-gray-500 mr-3 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                        </svg>
                        Adoptions
                        @php
                            $pendingAdoptions = \App\Models\Adoption::where('status', 'pending')->count();
                        @endphp
                        @if($pendingAdoptions > 0)
                            <span class="ml-auto bg-red-100 text-red-600 text-xs rounded-full px-2 py-1">
                                {{ number_format($pendingAdoptions) }}
                            </span>
                        @endif
                    </a>

                    <!-- Rehoming (Active) -->
                    <a href="{{ route('admin.rehoming.index') }}" 
                       class="bg-purple-100 text-purple-900 group flex items-center px-2 py-2 text-sm font-medium rounded-md">
                        <svg class="text-purple-500 mr-3 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                        </svg>
                        Rehoming Requests
                        @php
                            $pendingRehoming = \App\Models\Rehoming::where('status', 'pending')->count();
                        @endphp
                        @if($pendingRehoming > 0)
                            <span class="ml-auto bg-blue-100 text-blue-600 text-xs rounded-full px-2 py-1">
                                {{ number_format($pendingRehoming) }}
                            </span>
                        @endif
                    </a>

                    <a href="{{ route('admin.settings.index') }}" 
                       class="text-gray-600 hover:bg-gray-50 hover:text-gray-900 group flex items-center px-2 py-2 text-sm font-medium rounded-md">
                        <svg class="text-gray-400 group-hover:text-gray-500 mr-3 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
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
                        @php
                            $pendingContacts = \App\Models\Contact::where('status', 'pending')->count();
                        @endphp
                        @if($pendingContacts > 0)
                            <span class="ml-auto bg-orange-100 text-orange-600 text-xs rounded-full px-2 py-1">
                                {{ number_format($pendingContacts) }}
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
                    <h1 class="text-lg font-bold text-gray-900">Rehoming Requests Management</h1>
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
                                <a href="{{ route('home') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                    <i class="fas fa-home mr-2"></i>View Site
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
                <div class="mb-8">
                    <div class="flex justify-between items-center">
                        <div>
                            <h1 class="text-2xl font-bold text-gray-900">Rehoming Requests</h1>
                            <p class="mt-1 text-sm text-gray-600">Manage pet rehoming requests from users</p>
                        </div>
                        <div class="flex space-x-3">
                            <a href="{{ route('admin.rehoming.export', request()->query()) }}" 
                               class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                                Export
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Stats Cards -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                    <div class="bg-white overflow-hidden shadow rounded-lg">
                        <div class="p-5">
                            <div class="flex items-center">
                                <div class="flex-shrink-0">
                                    <div class="w-8 h-8 bg-blue-500 rounded-md flex items-center justify-center">
                                        <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                    </div>
                                </div>
                                <div class="ml-5 w-0 flex-1">
                                    <dl>
                                        <dt class="text-sm font-medium text-gray-500 truncate">Total Requests</dt>
                                        <dd class="text-lg font-medium text-gray-900">{{ number_format($stats['total']) }}</dd>
                                    </dl>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white overflow-hidden shadow rounded-lg">
                        <div class="p-5">
                            <div class="flex items-center">
                                <div class="flex-shrink-0">
                                    <div class="w-8 h-8 bg-yellow-500 rounded-md flex items-center justify-center">
                                        <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"></path>
                                        </svg>
                                    </div>
                                </div>
                                <div class="ml-5 w-0 flex-1">
                                    <dl>
                                        <dt class="text-sm font-medium text-gray-500 truncate">Pending Review</dt>
                                        <dd class="text-lg font-medium text-gray-900">{{ number_format($stats['pending']) }}</dd>
                                    </dl>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white overflow-hidden shadow rounded-lg">
                        <div class="p-5">
                            <div class="flex items-center">
                                <div class="flex-shrink-0">
                                    <div class="w-8 h-8 bg-green-500 rounded-md flex items-center justify-center">
                                        <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                        </svg>
                                    </div>
                                </div>
                                <div class="ml-5 w-0 flex-1">
                                    <dl>
                                        <dt class="text-sm font-medium text-gray-500 truncate">Published</dt>
                                        <dd class="text-lg font-medium text-gray-900">{{ number_format($stats['published']) }}</dd>
                                    </dl>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white overflow-hidden shadow rounded-lg">
                        <div class="p-5">
                            <div class="flex items-center">
                                <div class="flex-shrink-0">
                                    <div class="w-8 h-8 bg-purple-500 rounded-md flex items-center justify-center">
                                        <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM3 10a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zM14 9a1 1 0 00-1 1v6a1 1 0 001 1h2a1 1 0 001-1v-6a1 1 0 00-1-1h-2z"></path>
                                        </svg>
                                    </div>
                                </div>
                                <div class="ml-5 w-0 flex-1">
                                    <dl>
                                        <dt class="text-sm font-medium text-gray-500 truncate">This Week</dt>
                                        <dd class="text-lg font-medium text-gray-900">{{ number_format($stats['this_week']) }}</dd>
                                    </dl>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Filters -->
                <div class="bg-white shadow rounded-lg mb-6">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h3 class="text-lg font-medium text-gray-900">Filters</h3>
                    </div>
                    <div class="px-6 py-4">
                        <form method="GET" action="{{ route('admin.rehoming.index') }}" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-4">
                            <!-- Search -->
                            <div>
                                <label for="search" class="block text-sm font-medium text-gray-700 mb-1">Search</label>
                                <input type="text" 
                                       name="search" 
                                       id="search"
                                       value="{{ request('search') }}"
                                       placeholder="Pet name, breed, or owner..."
                                       class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500">
                            </div>

                            <!-- Status Filter -->
                            <div>
                                <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                                <select name="status" id="status" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500">
                                    <option value="">All Statuses</option>
                                    @foreach($statuses as $status)
                                        <option value="{{ $status }}" {{ request('status') === $status ? 'selected' : '' }}>
                                            {{ ucfirst($status) }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Species Filter -->
                            <div>
                                <label for="species" class="block text-sm font-medium text-gray-700 mb-1">Species</label>
                                <select name="species" id="species" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500">
                                    <option value="">All Species</option>
                                    @foreach($species as $specie)
                                        <option value="{{ $specie }}" {{ request('species') === $specie ? 'selected' : '' }}>
                                            {{ ucfirst($specie) }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Date From -->
                            <div>
                                <label for="date_from" class="block text-sm font-medium text-gray-700 mb-1">From Date</label>
                                <input type="date" 
                                       name="date_from" 
                                       id="date_from"
                                       value="{{ request('date_from') }}"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500">
                            </div>

                            <!-- Date To -->
                            <div>
                                <label for="date_to" class="block text-sm font-medium text-gray-700 mb-1">To Date</label>
                                <input type="date" 
                                       name="date_to" 
                                       id="date_to"
                                       value="{{ request('date_to') }}"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500">
                            </div>

                            <!-- Filter Buttons -->
                            <div class="md:col-span-2 lg:col-span-5 flex justify-between items-end">
                                <div class="flex space-x-3">
                                    <button type="submit" 
                                            class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path>
                                        </svg>
                                        Apply Filters
                                    </button>
                                    <a href="{{ route('admin.rehoming.index') }}" 
                                       class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                                        Clear Filters
                                    </a>
                                </div>
                                
                                <!-- Sort Options -->
                                <div class="flex items-center space-x-2">
                                    <label for="sort" class="text-sm font-medium text-gray-700">Sort by:</label>
                                    <select name="sort" id="sort" onchange="this.form.submit()" class="px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500">
                                        <option value="latest" {{ request('sort') === 'latest' ? 'selected' : '' }}>Latest</option>
                                        <option value="oldest" {{ request('sort') === 'oldest' ? 'selected' : '' }}>Oldest</option>
                                        <option value="pet_name" {{ request('sort') === 'pet_name' ? 'selected' : '' }}>Pet Name</option>
                                        <option value="user_name" {{ request('sort') === 'user_name' ? 'selected' : '' }}>Owner Name</option>
                                        <option value="status" {{ request('sort') === 'status' ? 'selected' : '' }}>Status</option>
                                    </select>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Results Summary and Bulk Actions -->
                @if($rehomings->count() > 0)
                    <div class="bg-white shadow rounded-lg">
                        <div class="px-6 py-4 border-b border-gray-200">
                            <div class="flex justify-between items-center">
                                <div class="flex items-center space-x-4">
                                    <h3 class="text-lg font-medium text-gray-900">
                                        Showing {{ $rehomings->firstItem() }}-{{ $rehomings->lastItem() }} of {{ $rehomings->total() }} results
                                    </h3>
                                    
                                    <!-- Bulk Actions -->
                                    <div class="flex items-center space-x-2" id="bulkActions" style="display: none;">
                                        <form method="POST" action="{{ route('admin.rehoming.bulk') }}" id="bulkForm">
                                            @csrf
                                            <input type="hidden" name="rehoming_ids" id="selectedIds" value="">
                                            <input type="hidden" name="bulk_reason" id="bulkReason" value="">
                                            
                                            <select name="action" id="bulkAction" class="px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500">
                                                <option value="">Bulk Actions</option>
                                                <option value="approve">Approve Selected</option>
                                                <option value="reject">Reject Selected</option>
                                                <option value="publish">Publish Selected</option>
                                                <option value="delete">Delete Selected</option>
                                            </select>
                                            
                                            <button type="button" onclick="executeBulkAction()" 
                                                    class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700">
                                                Execute
                                            </button>
                                        </form>
                                    </div>
                                </div>
                                
                                <!-- Select All -->
                                <div class="flex items-center">
                                    <input type="checkbox" 
                                           id="selectAll" 
                                           onchange="toggleAll(this)"
                                           class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                                    <label for="selectAll" class="ml-2 text-sm text-gray-700">Select All</label>
                                </div>
                            </div>
                        </div>

                        <!-- Rehoming Requests Table -->
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            <input type="checkbox" id="headerCheckbox" onchange="toggleAll(this)" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Pet Details
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Owner
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Status
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Submitted
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Characteristics
                                        </th>
                                        <th scope="col" class="relative px-6 py-3">
                                            <span class="sr-only">Actions</span>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach($rehomings as $rehoming)
                                        <tr class="hover:bg-gray-50">
                                            <!-- Checkbox -->
                                            <td class="px-6 py-4">
                                                <input type="checkbox" 
                                                       name="selected_rehomings[]" 
                                                       value="{{ $rehoming->id }}"
                                                       onchange="updateBulkActions()"
                                                       class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                                            </td>
                                            
                                            <!-- Pet Details -->
                                            <td class="px-6 py-4">
                                                <div class="flex items-center">
                                                    <div class="flex-shrink-0 h-12 w-12">
                                                        <div class="h-12 w-12 rounded-lg bg-gradient-to-r from-purple-400 to-pink-400 flex items-center justify-center">
                                                            <span class="text-white font-bold text-lg">
                                                                {{ strtoupper(substr($rehoming->pet_name, 0, 1)) }}
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <div class="ml-4">
                                                        <div class="text-sm font-medium text-gray-900">
                                                            <a href="{{ route('admin.rehoming.show', $rehoming) }}" class="hover:text-blue-600">
                                                                {{ $rehoming->pet_name }}
                                                            </a>
                                                        </div>
                                                        <div class="text-sm text-gray-500">
                                                            {{ ucfirst($rehoming->species) }} • {{ $rehoming->breed }} • {{ $rehoming->age }}
                                                        </div>
                                                        <div class="text-xs text-gray-400">
                                                            {{ ucfirst($rehoming->gender) }} • {{ ucfirst($rehoming->size) }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            
                                            <!-- Owner -->
                                            <td class="px-6 py-4">
                                                <div class="text-sm text-gray-900">{{ $rehoming->user->name }}</div>
                                                <div class="text-sm text-gray-500">{{ $rehoming->user->email }}</div>
                                                @if($rehoming->user->phone)
                                                    <div class="text-xs text-gray-400">{{ $rehoming->user->phone }}</div>
                                                @endif
                                            </td>
                                            
                                            <!-- Status -->
                                            <td class="px-6 py-4">
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                                    @switch($rehoming->status)
                                                        @case('draft')
                                                            bg-gray-100 text-gray-800
                                                            @break
                                                        @case('pending')
                                                            bg-yellow-100 text-yellow-800
                                                            @break
                                                        @case('approved')
                                                            bg-blue-100 text-blue-800
                                                            @break
                                                        @case('rejected')
                                                            bg-red-100 text-red-800
                                                            @break
                                                        @case('published')
                                                            bg-green-100 text-green-800
                                                            @break
                                                        @case('completed')
                                                            bg-purple-100 text-purple-800
                                                            @break
                                                        @default
                                                            bg-gray-100 text-gray-800
                                                    @endswitch
                                                ">
                                                    {{ ucfirst($rehoming->status) }}
                                                </span>
                                            </td>
                                            
                                            <!-- Submitted Date -->
                                            <td class="px-6 py-4 text-sm text-gray-500">
                                                @if($rehoming->submitted_at)
                                                    <div>{{ $rehoming->submitted_at->format('M d, Y') }}</div>
                                                    <div class="text-xs">{{ $rehoming->submitted_at->format('g:i A') }}</div>
                                                @else
                                                    <span class="text-gray-400">Not submitted</span>
                                                @endif
                                            </td>
                                            
                                            <!-- Characteristics -->
                                            <td class="px-6 py-4">
                                                <div class="flex flex-wrap gap-1">
                                                    @if($rehoming->good_with_kids)
                                                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                            Kids
                                                        </span>
                                                    @endif
                                                    @if($rehoming->good_with_pets)
                                                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                            Pets
                                                        </span>
                                                    @endif
                                                    @if($rehoming->house_trained)
                                                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                                            House Trained
                                                        </span>
                                                    @endif
                                                    @if($rehoming->spayed_neutered)
                                                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-purple-100 text-purple-800">
                                                            Fixed
                                                        </span>
                                                    @endif
                                                </div>
                                            </td>
                                            
                                            <!-- Actions -->
                                            <td class="px-6 py-4 text-right text-sm font-medium">
                                                <div class="flex justify-end space-x-2">
                                                    <a href="{{ route('admin.rehoming.show', $rehoming) }}" 
                                                       class="text-blue-600 hover:text-blue-900">
                                                        View
                                                    </a>
                                                    
                                                    @if($rehoming->status === 'pending')
                                                        <button onclick="approveRehoming({{ $rehoming->id }})" 
                                                                class="text-green-600 hover:text-green-900">
                                                            Approve
                                                        </button>
                                                        <button onclick="rejectRehoming({{ $rehoming->id }})" 
                                                                class="text-red-600 hover:text-red-900">
                                                            Reject
                                                        </button>
                                                    @endif
                                                    
                                                    @if($rehoming->status === 'approved')
                                                        <button onclick="publishRehoming({{ $rehoming->id }})" 
                                                                class="text-purple-600 hover:text-purple-900">
                                                            Publish
                                                        </button>
                                                    @endif
                                                    
                                                    @if(!in_array($rehoming->status, ['published', 'completed']))
                                                        <button onclick="deleteRehoming({{ $rehoming->id }})" 
                                                                class="text-red-600 hover:text-red-900">
                                                            Delete
                                                        </button>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- Pagination -->
                        <div class="px-6 py-4 border-t border-gray-200">
                            {{ $rehomings->withQueryString()->links() }}
                        </div>
                    </div>
                @else
                    <!-- No Results -->
                    <div class="bg-white shadow rounded-lg">
                        <div class="px-6 py-12 text-center">
                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            <h3 class="mt-2 text-sm font-medium text-gray-900">No rehoming requests found</h3>
                            <p class="mt-1 text-sm text-gray-500">
                                @if(request()->hasAny(['search', 'status', 'species', 'date_from', 'date_to']))
                                    Try adjusting your search criteria or filters.
                                @else
                                    No rehoming requests have been submitted yet.
                                @endif
                            </p>
                            @if(request()->hasAny(['search', 'status', 'species', 'date_from', 'date_to']))
                                <div class="mt-6">
                                    <a href="{{ route('admin.rehoming.index') }}" 
                                       class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700">
                                        Clear Filters
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>
                @endif
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

<!-- Modals -->
<!-- Approve Modal -->
<div id="approveModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden" style="z-index: 1000;">
    <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
        <div class="mt-3">
            <h3 class="text-lg font-medium text-gray-900 mb-4">Approve Rehoming Request</h3>
            <form id="approveForm" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="approve_notes" class="block text-sm font-medium text-gray-700 mb-2">
                        Admin Notes (Optional)
                    </label>
                    <textarea name="admin_notes" 
                              id="approve_notes"
                              rows="3" 
                              class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500"
                              placeholder="Add any notes about the approval..."></textarea>
                </div>
                <div class="flex justify-end space-x-3">
                    <button type="button" 
                            onclick="closeModal('approveModal')"
                            class="px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                        Cancel
                    </button>
                    <button type="submit" 
                            class="px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-green-600 hover:bg-green-700">
                        Approve Request
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Reject Modal -->
<div id="rejectModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden" style="z-index: 1000;">
    <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
        <div class="mt-3">
            <h3 class="text-lg font-medium text-gray-900 mb-4">Reject Rehoming Request</h3>
            <form id="rejectForm" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="rejection_reason" class="block text-sm font-medium text-gray-700 mb-2">
                        Rejection Reason <span class="text-red-500">*</span>
                    </label>
                    <textarea name="rejection_reason" 
                              id="rejection_reason"
                              rows="4" 
                              required
                              class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500"
                              placeholder="Please provide a reason for rejection..."></textarea>
                </div>
                <div class="flex justify-end space-x-3">
                    <button type="button" 
                            onclick="closeModal('rejectModal')"
                            class="px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                        Cancel
                    </button>
                    <button type="submit" 
                            class="px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-red-600 hover:bg-red-700">
                        Reject Request
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Publish Modal -->
<div id="publishModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden" style="z-index: 1000;">
    <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
        <div class="mt-3">
            <h3 class="text-lg font-medium text-gray-900 mb-4">Publish as Pet Listing</h3>
            <p class="text-sm text-gray-600 mb-4">
                This will create a new pet listing from this rehoming request and mark it as published.
            </p>
            <form id="publishForm" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="publish_notes" class="block text-sm font-medium text-gray-700 mb-2">
                        Admin Notes (Optional)
                    </label>
                    <textarea name="admin_notes" 
                              id="publish_notes"
                              rows="3" 
                              class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500"
                              placeholder="Add any notes about the publication..."></textarea>
                </div>
                <div class="flex justify-end space-x-3">
                    <button type="button" 
                            onclick="closeModal('publishModal')"
                            class="px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                        Cancel
                    </button>
                    <button type="submit" 
                            class="px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-purple-600 hover:bg-purple-700">
                        Publish Listing
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Bulk Action Modal -->
<div id="bulkModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden" style="z-index: 1000;">
    <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
        <div class="mt-3">
            <h3 class="text-lg font-medium text-gray-900 mb-4" id="bulkModalTitle">Bulk Action</h3>
            <p class="text-sm text-gray-600 mb-4" id="bulkModalMessage"></p>
            <div class="mb-4" id="bulkReasonDiv" style="display: none;">
                <label for="bulk_reason_input" class="block text-sm font-medium text-gray-700 mb-2">
                    Reason <span class="text-red-500">*</span>
                </label>
                <textarea id="bulk_reason_input"
                          rows="3" 
                          class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500"
                          placeholder="Please provide a reason..."></textarea>
            </div>
            <div class="flex justify-end space-x-3">
                <button type="button" 
                        onclick="closeModal('bulkModal')"
                        class="px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                    Cancel
                </button>
                <button type="button" 
                        onclick="confirmBulkAction()"
                        id="bulkConfirmBtn"
                        class="px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700">
                    Confirm
                </button>
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
    
    if (!userButton || !userButton.onclick || !userButton.onclick.toString().includes('toggleUserMenu')) {
        userMenu.classList.add('hidden');
    }
});

// Global variables
let selectedRehomingId = null;
let selectedAction = null;

// Modal functions
function showModal(modalId) {
    document.getElementById(modalId).classList.remove('hidden');
}

function closeModal(modalId) {
    document.getElementById(modalId).classList.add('hidden');
    selectedRehomingId = null;
    selectedAction = null;
}

// Individual actions
function approveRehoming(id) {
    selectedRehomingId = id;
    document.getElementById('approveForm').action = `/admin/rehoming/${id}/approve`;
    showModal('approveModal');
}

function rejectRehoming(id) {
    selectedRehomingId = id;
    document.getElementById('rejectForm').action = `/admin/rehoming/${id}/reject`;
    showModal('rejectModal');
}

function publishRehoming(id) {
    selectedRehomingId = id;
    document.getElementById('publishForm').action = `/admin/rehoming/${id}/publish`;
    showModal('publishModal');
}

function deleteRehoming(id) {
    if (confirm('Are you sure you want to delete this rehoming request? This action cannot be undone.')) {
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = `/admin/rehoming/${id}`;
        form.innerHTML = `
            @csrf
            @method('DELETE')
        `;
        document.body.appendChild(form);
        form.submit();
    }
}

// Bulk actions
function toggleAll(checkbox) {
    const checkboxes = document.querySelectorAll('input[name="selected_rehomings[]"]');
    checkboxes.forEach(cb => cb.checked = checkbox.checked);
    updateBulkActions();
}

function updateBulkActions() {
    const checkboxes = document.querySelectorAll('input[name="selected_rehomings[]"]:checked');
    const bulkActions = document.getElementById('bulkActions');
    
    if (checkboxes.length > 0) {
        bulkActions.style.display = 'flex';
    } else {
        bulkActions.style.display = 'none';
    }
    
    // Update select all checkbox
    const allCheckboxes = document.querySelectorAll('input[name="selected_rehomings[]"]');
    const selectAllCheckbox = document.getElementById('selectAll');
    const headerCheckbox = document.getElementById('headerCheckbox');
    
    if (checkboxes.length === allCheckboxes.length) {
        selectAllCheckbox.checked = true;
        headerCheckbox.checked = true;
        selectAllCheckbox.indeterminate = false;
        headerCheckbox.indeterminate = false;
    } else if (checkboxes.length > 0) {
        selectAllCheckbox.checked = false;
        headerCheckbox.checked = false;
        selectAllCheckbox.indeterminate = true;
        headerCheckbox.indeterminate = true;
    } else {
        selectAllCheckbox.checked = false;
        headerCheckbox.checked = false;
        selectAllCheckbox.indeterminate = false;
        headerCheckbox.indeterminate = false;
    }
}

function executeBulkAction() {
    const action = document.getElementById('bulkAction').value;
    const checkboxes = document.querySelectorAll('input[name="selected_rehomings[]"]:checked');
    
    if (!action) {
        alert('Please select an action');
        return;
    }
    
    if (checkboxes.length === 0) {
        alert('Please select at least one rehoming request');
        return;
    }
    
    selectedAction = action;
    const ids = Array.from(checkboxes).map(cb => cb.value);
    document.getElementById('selectedIds').value = ids.join(',');
    
    // Show confirmation modal
    const title = document.getElementById('bulkModalTitle');
    const message = document.getElementById('bulkModalMessage');
    const reasonDiv = document.getElementById('bulkReasonDiv');
    const confirmBtn = document.getElementById('bulkConfirmBtn');
    
    switch (action) {
        case 'approve':
            title.textContent = 'Approve Selected Requests';
            message.textContent = `Are you sure you want to approve ${ids.length} rehoming requests?`;
            reasonDiv.style.display = 'none';
            confirmBtn.className = 'px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-green-600 hover:bg-green-700';
            break;
        case 'reject':
            title.textContent = 'Reject Selected Requests';
            message.textContent = `Are you sure you want to reject ${ids.length} rehoming requests?`;
            reasonDiv.style.display = 'block';
            confirmBtn.className = 'px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-red-600 hover:bg-red-700';
            break;
        case 'publish':
            title.textContent = 'Publish Selected Requests';
            message.textContent = `Are you sure you want to publish ${ids.length} approved rehoming requests as pet listings?`;
            reasonDiv.style.display = 'none';
            confirmBtn.className = 'px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-purple-600 hover:bg-purple-700';
            break;
        case 'delete':
            title.textContent = 'Delete Selected Requests';
            message.textContent = `Are you sure you want to delete ${ids.length} rehoming requests? This action cannot be undone.`;
            reasonDiv.style.display = 'none';
            confirmBtn.className = 'px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-red-600 hover:bg-red-700';
            break;
    }
    
    showModal('bulkModal');
}

function confirmBulkAction() {
    const reasonInput = document.getElementById('bulk_reason_input');
    
    if (selectedAction === 'reject' && !reasonInput.value.trim()) {
        alert('Please provide a reason for rejection');
        return;
    }
    
    document.getElementById('bulkReason').value = reasonInput.value;
    document.getElementById('bulkForm').submit();
}

// Close modals when clicking outside
window.onclick = function(event) {
    const modals = ['approveModal', 'rejectModal', 'publishModal', 'bulkModal'];
    modals.forEach(modalId => {
        const modal = document.getElementById(modalId);
        if (event.target === modal) {
            closeModal(modalId);
        }
    });
}

// Initialize on page load
document.addEventListener('DOMContentLoaded', function() {
    updateBulkActions();
});
</script>
@endsection