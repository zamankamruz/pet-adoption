<?php
// File: complete.blade.php
// Path: /resources/views/rehoming/complete.blade.php
?>

@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50">
    <!-- Progress Bar -->
    <div class="bg-white shadow-sm">
        <div class="max-w-4xl mx-auto px-4 py-4">
            <div class="flex items-center justify-between mb-4">
                <div class="flex items-center space-x-2">
                    <img src="{{ asset('images/logo.png') }}" alt="Furry Friends" class="h-8">
                    <span class="text-lg font-semibold text-gray-900">Furry Friends</span>
                </div>
                <div class="flex items-center space-x-2">
                    <div class="w-8 h-8 bg-purple-500 rounded-full flex items-center justify-center">
                        <i class="fas fa-user text-white text-sm"></i>
                    </div>
                    <span class="text-sm font-medium text-gray-700">{{ auth()->user()->name }}</span>
                </div>
            </div>

            <!-- Progress Steps - All Complete -->
            <div class="flex items-center justify-between">
                @for($i = 1; $i <= 9; $i++)
                <div class="flex items-center">
                    <div class="w-8 h-8 bg-green-500 rounded-full flex items-center justify-center">
                        <i class="fas fa-check text-white text-xs"></i>
                    </div>
                </div>
                @endfor
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="max-w-4xl mx-auto px-4 py-8">
        <div class="bg-white rounded-lg shadow-md p-8 text-center">
            <div class="mb-6">
                <h1 class="text-2xl font-bold text-gray-900 mb-4">Thanks for submitting!</h1>
                <p class="text-gray-700 mb-4">
                    We'll be in touch once we've reviewed your pet's profile.
                </p>
                <p class="text-gray-700">
                    We want to make sure we give you the best chance of finding the right home for your pet.
                </p>
            </div>

            <!-- Success Icon -->
            <div class="flex justify-center mb-8">
                <div class="w-32 h-32 bg-purple-100 rounded-full flex items-center justify-center">
                    <div class="text-center">
                        <i class="fas fa-heart text-4xl text-purple-500 mb-2"></i>
                        <div class="w-8 h-8 bg-purple-500 rounded-full mx-auto flex items-center justify-center">
                            <i class="fas fa-paw text-white text-sm"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Go to Profile Button -->
            <div class="mb-8">
                <a href="{{ route('dashboard') }}" class="inline-block px-8 py-3 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition-colors">
                    Go To My Profile
                </a>
            </div>
        </div>
    </div>
</div>
@endsection