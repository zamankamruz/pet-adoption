<?php
// File: profile.blade.php
// Path: /resources/views/user/profile.blade.php
?>

@extends('layouts.app')

@section('title', 'Profile - Furry Friends')

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
                                   class="flex items-center px-4 py-3 rounded-xl bg-gradient-to-r from-purple-500 to-purple-600 text-white">
                                    <div class="w-8 h-8 bg-white bg-opacity-20 rounded-full flex items-center justify-center mr-3 text-sm font-bold">👤</div>
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
                                   class="flex items-center px-4 py-3 rounded-xl text-gray-600 hover:bg-purple-50 hover:text-purple-600 transition-all duration-200">
                                    <div class="w-8 h-8 bg-purple-100 text-purple-600 rounded-full flex items-center justify-center mr-3 text-sm">💬</div>
                                    <span class="font-medium">Message</span>
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
                            <div class="flex justify-center mb-3">
                                <div class="flex -space-x-1">
                                    <img src="{{ asset('images/donate1.jpeg') }}" alt="Pet 1" class="w-8 h-8 rounded-full border-2 border-white">
                                    <img src="{{ asset('images/donate2.jpeg') }}" alt="Pet 2" class="w-8 h-8 rounded-full border-2 border-white">
                                    <img src="{{ asset('images/donate3.jpeg') }}" alt="Pet 3" class="w-8 h-8 rounded-full border-2 border-white">
                                    <img src="{{ asset('images/donate4.jpeg') }}" alt="Pet 4" class="w-8 h-8 rounded-full border-2 border-white">
                                    <img src="{{ asset('images/donate5.jpeg') }}" alt="Pet 5" class="w-8 h-8 rounded-full border-2 border-white">
                                    <img src="{{ asset('images/donate6.jpeg') }}" alt="Pet 6" class="w-8 h-8 rounded-full border-2 border-white">
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
                        <h1 class="text-2xl font-bold text-gray-900">Profile Settings</h1>
                        <p class="text-gray-600 mt-1">Manage your account information and preferences</p>
                    </div>

                    <!-- Profile Content -->
                    <div class="p-6">
                        <form method="POST" action="{{ route('user.profile.update') }}" enctype="multipart/form-data">
                            @csrf
                            @method('PATCH')

                            <!-- Avatar Section -->
                            <div class="mb-8">
                                <h3 class="text-lg font-semibold text-gray-900 mb-4">Profile Picture</h3>
                                <div class="flex items-center space-x-6">
                                    <div class="relative">
                                        <img src="{{ auth()->user()->avatar_url }}" alt="{{ auth()->user()->name }}" 
                                             class="w-24 h-24 rounded-full object-cover border-4 border-gray-200" id="avatarPreview">
                                        <label for="avatar" class="absolute bottom-0 right-0 w-8 h-8 bg-purple-600 hover:bg-purple-700 rounded-full flex items-center justify-center cursor-pointer transition-colors">
                                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            </svg>
                                        </label>
                                        <input type="file" id="avatar" name="avatar" accept="image/*" class="hidden" onchange="previewImage(this)">
                                    </div>
                                    <div>
                                        <h4 class="font-medium text-gray-900">{{ auth()->user()->name }}</h4>
                                        <p class="text-sm text-gray-500">JPG, PNG or GIF. Max size 2MB</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Personal Information -->
                            <div class="mb-8">
                                <h3 class="text-lg font-semibold text-gray-900 mb-4">Personal Information</h3>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div>
                                        <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Full Name</label>
                                        <input type="text" id="name" name="name" value="{{ old('name', auth()->user()->name) }}" 
                                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                                        @error('name')
                                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div>
                                        <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email Address</label>
                                        <input type="email" id="email" name="email" value="{{ old('email', auth()->user()->email) }}" 
                                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                                        @error('email')
                                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div>
                                        <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">Phone Number</label>
                                        <input type="tel" id="phone" name="phone" value="{{ old('phone', auth()->user()->phone) }}" 
                                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                                        @error('phone')
                                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div>
                                        <label for="city" class="block text-sm font-medium text-gray-700 mb-2">City</label>
                                        <input type="text" id="city" name="city" value="{{ old('city', auth()->user()->city) }}" 
                                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                                        @error('city')
                                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="md:col-span-2">
                                        <label for="address" class="block text-sm font-medium text-gray-700 mb-2">Address</label>
                                        <input type="text" id="address" name="address" value="{{ old('address', auth()->user()->address) }}" 
                                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                                        @error('address')
                                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="md:col-span-2">
                                        <label for="bio" class="block text-sm font-medium text-gray-700 mb-2">Bio</label>
                                        <textarea id="bio" name="bio" rows="3" 
                                                  class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent">{{ old('bio', auth()->user()->bio) }}</textarea>
                                        @error('bio')
                                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- Action Buttons -->
                            <div class="flex space-x-4 pt-6 border-t border-gray-100">
                                <button type="submit" 
                                        class="bg-purple-600 hover:bg-purple-700 text-white font-medium py-2 px-6 rounded-lg transition-colors">
                                    Save Changes
                                </button>
                                <a href="{{ route('dashboard') }}" 
                                   class="border border-gray-300 hover:bg-gray-50 text-gray-700 font-medium py-2 px-6 rounded-lg transition-colors">
                                    Cancel
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function previewImage(input) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('avatarPreview').src = e.target.result;
        }
        reader.readAsDataURL(input.files[0]);
    }
}
</script>
@endsection