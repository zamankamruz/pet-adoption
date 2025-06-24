<?php
// File: step7.blade.php
// Path: /resources/views/rehoming/step7.blade.php
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
                @for($i = 1; $i <= 6; $i++)
                <div class="flex items-center">
                    <div class="w-8 h-8 bg-green-500 rounded-full flex items-center justify-center">
                        <i class="fas fa-check text-white text-xs"></i>
                    </div>
                </div>
                @endfor
                
                <div class="flex items-center">
                    <div class="w-8 h-8 bg-purple-500 rounded-full flex items-center justify-center">
                        <span class="text-white text-sm font-bold">7</span>
                    </div>
                    <span class="ml-2 text-sm font-medium text-purple-600">Pet's Story</span>
                </div>

                @for($i = 8; $i <= 9; $i++)
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
            <div class="mb-6">
                <p class="text-gray-700 mb-4">
                    Share anything here about your pet. (Your pet profile will be visible to the public. For your safety, do not include any personal details or contact information). Include information such as:
                </p>
                
                <ul class="list-disc list-inside text-gray-700 space-y-1 mb-4">
                    <li>Your pet's story - how you've had them, where you got them from and why you need to rehome them</li>
                    <li>Details about who your pet lives with, eg children and other pets</li>
                    <li>Your pet's favourite activities</li>
                    <li>A description of their personality, preferences and habits</li>
                    <li>Anything they're scared of such as fireworks, people in your pet, other animals</li>
                    <li>The type of food they eat including the brand and amount</li>
                    <li>Allergies, health conditions, and any medications your pet is taking</li>
                    <li>If you are listing a bonded pair, make sure you include details about both pets</li>
                </ul>
            </div>

            <form method="POST" action="{{ route('rehoming.step7.store') }}">
                @csrf

                <div class="mb-8">
                    <textarea name="description" rows="10" 
                              class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500"
                              placeholder="Type Here..." required>{{ old('description', $rehoming->description) }}</textarea>
                    @error('description')
                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Action Buttons -->
                <div class="flex justify-between">
                    <a href="{{ route('rehoming.step6') }}" class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors">
                        <i class="fas fa-arrow-left mr-2"></i> Back
                    </a>
                    <button type="submit" class="px-8 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition-colors">
                        Continue <i class="fas fa-arrow-right ml-2"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection