<?php
// File: step1.blade.php
// Path: /resources/views/rehoming/step1.blade.php
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

            <!-- Progress Steps -->
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <div class="w-8 h-8 bg-purple-500 rounded-full flex items-center justify-center">
                        <span class="text-white text-sm font-bold">1</span>
                    </div>
                    <span class="ml-2 text-sm font-medium text-purple-600">Start</span>
                </div>
                
                @for($i = 2; $i <= 9; $i++)
                <div class="flex items-center">
                    <div class="w-8 h-8 bg-gray-300 rounded-full flex items-center justify-center">
                        <span class="text-gray-600 text-sm">{{ $i }}</span>
                    </div>
                </div>
                @endfor
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="max-w-4xl mx-auto px-4 py-8">
        <div class="bg-white rounded-lg shadow-md p-8">
            <!-- User Info Section -->
            <div class="flex items-center mb-8">
                <div class="w-16 h-16 bg-gray-300 rounded-full overflow-hidden mr-4">
                    @if(auth()->user()->avatar)
                        <img src="{{ auth()->user()->avatar_url }}" alt="{{ auth()->user()->name }}" class="w-full h-full object-cover">
                    @else
                        <div class="w-full h-full bg-purple-500 flex items-center justify-center">
                            <span class="text-white text-xl font-bold">{{ substr(auth()->user()->name, 0, 1) }}</span>
                        </div>
                    @endif
                </div>
                <div>
                    <div class="text-sm text-gray-600">Email/Username</div>
                    <div class="font-medium text-gray-900">{{ auth()->user()->email }}</div>
                    <div class="text-sm text-gray-600 mt-1">First name</div>
                    <div class="font-medium text-gray-900">{{ explode(' ', auth()->user()->name)[0] }}</div>
                    <div class="text-sm text-gray-600 mt-1">Last name</div>
                    <div class="font-medium text-gray-900">{{ explode(' ', auth()->user()->name)[1] ?? '' }}</div>
                </div>
            </div>

            <!-- Terms and Conditions -->
            <form method="POST" action="{{ route('rehoming.step1.store') }}">
                @csrf
                <div class="mb-6">
                    <label class="flex items-start">
                        <input type="checkbox" name="agree_terms" value="1" class="mt-1 mr-3 text-purple-600 focus:ring-purple-500" required>
                        <span class="text-sm text-gray-700">
                            I have read and agree to the <a href="#" class="text-purple-600 hover:underline">Terms and Privacy Policy</a>
                        </span>
                    </label>
                    @error('agree_terms')
                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="text-sm text-gray-600 mb-8">
                    To apply for <span class="text-purple-600 font-medium">Rehome pet</span> you need to complete some fields. Click Start
                </div>

                <!-- Action Buttons -->
                <div class="flex justify-between">
                    <a href="{{ route('rehoming.index') }}" class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors">
                        <i class="fas fa-arrow-left mr-2"></i> Back
                    </a>
                    <button type="submit" class="px-8 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition-colors">
                        Start
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection