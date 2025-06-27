<?php
// File: step7.blade.php
// Path: /resources/views/rehoming/step7.blade.php
?>

@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50">
            <!-- Progress Steps -->
    <div class="bg-white shadow-sm">
        <div class="max-w-4xl mx-auto px-4 py-6">
            <div class="flex items-center justify-center">
                <div class="flex items-center space-x-8">
                    <img src="{{ asset('images/steps7.png') }}" alt="">
                </div>
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