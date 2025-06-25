<?php
// File: edit.blade.php
// Path: /resources/views/admin/testimonials/edit.blade.php
?>

@extends('layouts.admin')

@section('title', 'Edit Testimonial')

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
                    <h1 class="text-lg font-bold text-gray-900">Edit Testimonial</h1>
                    <p class="text-sm text-gray-600">Update testimonial from {{ $testimonial->name }}</p>
                </div>
                
                <!-- Action Buttons -->
                <div class="flex items-center space-x-4">
                    <div class="flex space-x-2">
                        <a href="{{ route('admin.testimonials.show', $testimonial) }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-900 focus:outline-none focus:border-blue-900 focus:ring ring-blue-300 disabled:opacity-25 transition ease-in-out duration-150">
                            <i class="fas fa-eye mr-2"></i> View
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
                        <!-- Main Form -->
                        <div class="lg:col-span-2">
                            <div class="bg-white shadow rounded-lg">
                                <div class="px-6 py-4 border-b border-gray-200">
                                    <h3 class="text-lg font-medium text-gray-900">Testimonial Information</h3>
                                </div>
                                <div class="p-6">
                                    <form action="{{ route('admin.testimonials.update', $testimonial) }}" method="POST" enctype="multipart/form-data" id="testimonialForm">
                                        @csrf
                                        @method('PUT')
                                        
                                        <!-- Customer Information -->
                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                                            <div>
                                                <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Customer Name <span class="text-red-500">*</span></label>
                                                <input type="text" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-purple-500 focus:border-purple-500 @error('name') border-red-500 @enderror" 
                                                       id="name" name="name" value="{{ old('name', $testimonial->name) }}" required>
                                                @error('name')
                                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                                @enderror
                                            </div>
                                            <div>
                                                <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email Address</label>
                                                <input type="email" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-purple-500 focus:border-purple-500 @error('email') border-red-500 @enderror" 
                                                       id="email" name="email" value="{{ old('email', $testimonial->email) }}">
                                                @error('email')
                                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>

                                        <!-- Avatar Upload -->
                                        <div class="mb-6">
                                            <label for="avatar" class="block text-sm font-medium text-gray-700 mb-2">Customer Avatar</label>
                                            <div class="flex items-center space-x-6">
                                                <div class="shrink-0">
                                                    <img id="avatarPreview" src="{{ $testimonial->avatar_url }}" 
                                                         alt="Avatar Preview" class="w-24 h-24 object-cover rounded-lg border border-gray-300">
                                                </div>
                                                <div class="flex-1">
                                                    <input type="file" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-purple-500 focus:border-purple-500 @error('avatar') border-red-500 @enderror" 
                                                           id="avatar" name="avatar" accept="image/*" onchange="previewAvatar(this)">
                                                    <p class="mt-1 text-sm text-gray-500">
                                                        Upload new customer photo (optional). Leave empty to keep current image.
                                                        <br>Accepted formats: JPG, PNG, GIF. Max size: 2MB
                                                    </p>
                                                    @error('avatar')
                                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Rating -->
                                        <div class="mb-6">
                                            <label class="block text-sm font-medium text-gray-700 mb-2">Rating <span class="text-red-500">*</span></label>
                                            <div class="rating-input">
                                                <div class="star-rating flex flex-row-reverse justify-end items-center">
                                                    @for($i = 5; $i >= 1; $i--)
                                                        <input type="radio" id="star{{ $i }}" name="rating" value="{{ $i }}" 
                                                               {{ old('rating', $testimonial->rating) == $i ? 'checked' : '' }} required class="hidden">
                                                        <label for="star{{ $i }}" class="star cursor-pointer w-8 h-8 text-2xl text-gray-300 hover:text-yellow-400 transition-colors mr-1">
                                                            <i class="fas fa-star"></i>
                                                        </label>
                                                    @endfor
                                                </div>
                                                <span class="rating-text text-sm text-gray-600 ml-2">
                                                    {{ old('rating', $testimonial->rating) }} star{{ old('rating', $testimonial->rating) > 1 ? 's' : '' }} selected
                                                </span>
                                            </div>
                                            @error('rating')
                                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <!-- Testimonial Content -->
                                        <div class="mb-6">
                                            <label for="testimonial" class="block text-sm font-medium text-gray-700 mb-2">Testimonial Content <span class="text-red-500">*</span></label>
                                            <textarea class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-purple-500 focus:border-purple-500 @error('testimonial') border-red-500 @enderror" 
                                                      id="testimonial" name="testimonial" rows="6" required 
                                                      placeholder="Write the customer's testimonial here...">{{ old('testimonial', $testimonial->testimonial) }}</textarea>
                                            <div class="mt-1 flex justify-between">
                                                <p class="text-sm text-gray-500">
                                                    <span id="charCount">{{ strlen(old('testimonial', $testimonial->testimonial)) }}</span> characters (minimum 10 characters required)
                                                </p>
                                            </div>
                                            @error('testimonial')
                                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <!-- Associated User -->
                                        <div class="mb-6">
                                            <label for="user_id" class="block text-sm font-medium text-gray-700 mb-2">Associated User Account</label>
                                            <select class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-purple-500 focus:border-purple-500 @error('user_id') border-red-500 @enderror" id="user_id" name="user_id">
                                                <option value="">Select a user (optional)</option>
                                                @foreach($users as $user)
                                                    <option value="{{ $user->id }}" 
                                                        {{ old('user_id', $testimonial->user_id) == $user->id ? 'selected' : '' }}>
                                                        {{ $user->name }} ({{ $user->email }})
                                                    </option>
                                                @endforeach
                                            </select>
                                            <p class="mt-1 text-sm text-gray-500">Link this testimonial to an existing user account</p>
                                            @error('user_id')
                                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <!-- Associated Pet -->
                                        <div class="mb-6">
                                            <label for="pet_id" class="block text-sm font-medium text-gray-700 mb-2">Associated Pet</label>
                                            <select class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-purple-500 focus:border-purple-500 @error('pet_id') border-red-500 @enderror" id="pet_id" name="pet_id">
                                                <option value="">Select a pet (optional)</option>
                                                @foreach($pets as $pet)
                                                    <option value="{{ $pet->id }}" 
                                                        {{ old('pet_id', $testimonial->pet_id) == $pet->id ? 'selected' : '' }}>
                                                        {{ $pet->name }} - {{ $pet->breed->name }} ({{ ucfirst($pet->gender) }})
                                                    </option>
                                                @endforeach
                                            </select>
                                            <p class="mt-1 text-sm text-gray-500">If this testimonial is about a specific pet</p>
                                            @error('pet_id')
                                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <!-- Form Actions -->
                                        <div class="flex justify-between items-center">
                                            <a href="#" class="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                                                <i class="fas fa-times mr-2"></i> Cancel
                                            </a>
                                            <div>
                                                <button type="submit" class="inline-flex items-center px-4 py-2 bg-purple-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-purple-700 active:bg-purple-900 focus:outline-none focus:border-purple-900 focus:ring ring-purple-300 disabled:opacity-25 transition ease-in-out duration-150">
                                                    <i class="fas fa-save mr-2"></i> Update Testimonial
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <!-- Sidebar -->
                        <div class="lg:col-span-1 space-y-6">
                            <!-- Status Settings -->
                            <div class="bg-white shadow rounded-lg">
                                <div class="px-6 py-4 border-b border-gray-200">
                                    <h3 class="text-lg font-medium text-gray-900">Status Settings</h3>
                                </div>
                                <div class="p-6">
                                    <!-- Approval Status -->
                                    <div class="mb-4">
                                        <div class="flex items-center">
                                            <input type="checkbox" id="is_approved" name="is_approved" value="1" 
                                                   {{ old('is_approved', $testimonial->is_approved) ? 'checked' : '' }}
                                                   class="w-4 h-4 text-purple-600 bg-gray-100 border-gray-300 rounded focus:ring-purple-500 focus:ring-2">
                                            <label for="is_approved" class="ml-3">
                                                <span class="text-sm font-medium text-gray-900">Approved</span>
                                                <p class="text-sm text-gray-500">Show this testimonial on the website</p>
                                            </label>
                                        </div>
                                    </div>

                                    <!-- Featured Status -->
                                    <div class="mb-4">
                                        <div class="flex items-center">
                                            <input type="checkbox" id="is_featured" name="is_featured" value="1" 
                                                   {{ old('is_featured', $testimonial->is_featured) ? 'checked' : '' }}
                                                   class="w-4 h-4 text-purple-600 bg-gray-100 border-gray-300 rounded focus:ring-purple-500 focus:ring-2">
                                            <label for="is_featured" class="ml-3">
                                                <span class="text-sm font-medium text-gray-900">Featured</span>
                                                <p class="text-sm text-gray-500">Highlight this testimonial prominently</p>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Testimonial Info -->
                            <div class="bg-white shadow rounded-lg">
                                <div class="px-6 py-4 border-b border-gray-200">
                                    <h3 class="text-lg font-medium text-blue-600">Testimonial Info</h3>
                                </div>
                                <div class="p-6">
                                    <div class="grid grid-cols-2 gap-4 mb-4">
                                        <div>
                                            <p class="text-sm text-gray-500">Created:</p>
                                            <p class="font-semibold text-gray-900">{{ $testimonial->created_at->format('M d, Y') }}</p>
                                        </div>
                                        <div>
                                            <p class="text-sm text-gray-500">Updated:</p>
                                            <p class="font-semibold text-gray-900">{{ $testimonial->updated_at->format('M d, Y') }}</p>
                                        </div>
                                    </div>
                                    <hr class="border-gray-200 my-4">
                                    <div class="grid grid-cols-2 gap-4">
                                        <div>
                                            <p class="text-sm text-gray-500">Status:</p>
                                            <div class="mt-1">
                                                @if($testimonial->is_approved)
                                                    <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                                                        Approved
                                                    </span>
                                                @else
                                                    <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                                        Pending
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div>
                                            <p class="text-sm text-gray-500">Featured:</p>
                                            <div class="mt-1">
                                                @if($testimonial->is_featured)
                                                    <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-purple-100 text-purple-800">
                                                        Yes
                                                    </span>
                                                @else
                                                    <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-gray-100 text-gray-800">
                                                        No
                                                    </span>
                                                @endif
                                            </div>
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

<style>
.star-rating input[type="radio"]:checked ~ label {
    color: #fbbf24 !important;
}

.star-rating label:hover,
.star-rating label:hover ~ label {
    color: #fbbf24 !important;
}

.star-rating label:hover {
    transform: scale(1.1);
}
</style>

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

// Avatar preview
function previewAvatar(input) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('avatarPreview').src = e.target.result;
        }
        reader.readAsDataURL(input.files[0]);
    }
}

// Character counter
document.getElementById('testimonial').addEventListener('input', function() {
    const charCount = this.value.length;
    const charCountElement = document.getElementById('charCount');
    charCountElement.textContent = charCount;
    
    if (charCount < 10) {
        charCountElement.className = 'text-red-600 font-medium';
    } else {
        charCountElement.className = 'text-green-600 font-medium';
    }
});

// Rating interaction
document.querySelectorAll('.star-rating input[type="radio"]').forEach(radio => {
    radio.addEventListener('change', function() {
        const rating = this.value;
        document.querySelector('.rating-text').textContent = `${rating} star${rating > 1 ? 's' : ''} selected`;
    });
});

// Initialize character count
document.addEventListener('DOMContentLoaded', function() {
    const testimonialTextarea = document.getElementById('testimonial');
    const charCount = testimonialTextarea.value.length;
    const charCountElement = document.getElementById('charCount');
    charCountElement.textContent = charCount;
    
    if (charCount < 10) {
        charCountElement.className = 'text-red-600 font-medium';
    } else {
        charCountElement.className = 'text-green-600 font-medium';
    }
});
</script>
@endsection