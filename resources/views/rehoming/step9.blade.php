<?php
// File: step9.blade.php
// Path: /resources/views/rehoming/step9.blade.php
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
                @for($i = 1; $i <= 8; $i++)
                <div class="flex items-center">
                    <div class="w-8 h-8 bg-green-500 rounded-full flex items-center justify-center">
                        <i class="fas fa-check text-white text-xs"></i>
                    </div>
                </div>
                @endfor
                
                <div class="flex items-center">
                    <div class="w-8 h-8 bg-purple-500 rounded-full flex items-center justify-center">
                        <span class="text-white text-sm font-bold">9</span>
                    </div>
                    <span class="ml-2 text-sm font-medium text-purple-600">Confirm</span>
                </div>
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

            <!-- Pet Summary -->
            <div class="bg-gray-50 rounded-lg p-6 mb-8">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Pet Summary</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <span class="text-sm text-gray-600">Pet Name:</span>
                        <span class="ml-2 font-medium">{{ $rehoming->pet_name }}</span>
                    </div>
                    <div>
                        <span class="text-sm text-gray-600">Species:</span>
                        <span class="ml-2 font-medium">{{ ucfirst($rehoming->species) }}</span>
                    </div>
                    <div>
                        <span class="text-sm text-gray-600">Breed:</span>
                        <span class="ml-2 font-medium">{{ $rehoming->breed }}</span>
                    </div>
                    <div>
                        <span class="text-sm text-gray-600">Age:</span>
                        <span class="ml-2 font-medium">{{ $rehoming->age_years }} years</span>
                    </div>
                    <div>
                        <span class="text-sm text-gray-600">Gender:</span>
                        <span class="ml-2 font-medium">{{ ucfirst($rehoming->gender) }}</span>
                    </div>
                    <div>
                        <span class="text-sm text-gray-600">Size:</span>
                        <span class="ml-2 font-medium">{{ ucfirst($rehoming->size) }}</span>
                    </div>
                    <div>
                        <span class="text-sm text-gray-600">Color:</span>
                        <span class="ml-2 font-medium">{{ ucfirst($rehoming->color) }}</span>
                    </div>
                    <div>
                        <span class="text-sm text-gray-600">Spayed/Neutered:</span>
                        <span class="ml-2 font-medium">{{ ucfirst($rehoming->spayed_neutered) }}</span>
                    </div>
                </div>
            </div>

            <!-- Location Summary -->
            <div class="bg-gray-50 rounded-lg p-6 mb-8">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Location</h3>
                <div class="text-gray-700">
                    <div>{{ $rehoming->address_line_1 }}</div>
                    @if($rehoming->address_line_2)
                        <div>{{ $rehoming->address_line_2 }}</div>
                    @endif
                    <div>{{ $rehoming->city }}, {{ $rehoming->postcode }}</div>
                </div>
            </div>

            <!-- Terms and Conditions -->
            <form method="POST" action="{{ route('rehoming.step9.store') }}">
                @csrf
                
                <div class="mb-6">
                    <label class="flex items-start">
                        <input type="checkbox" name="final_terms" value="1" class="mt-1 mr-3 text-purple-600 focus:ring-purple-500" required>
                        <span class="text-sm text-gray-700">
                            I have read and agree to the <a href="#" class="text-purple-600 hover:underline">Terms and Privacy Policy</a>
                        </span>
                    </label>
                    @error('final_terms')
                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="text-sm text-gray-600 mb-8">
                    To apply for <span class="text-purple-600 font-medium">Rehome pet</span> you need to complete some fields. Click Start
                </div>

                <!-- Action Buttons -->
                <div class="flex justify-between">
                    <a href="{{ route('rehoming.step8') }}" class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors">
                        <i class="fas fa-arrow-left mr-2"></i> Back
                    </a>
                    <button type="submit" class="px-8 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition-colors">
                        Submit Application
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection