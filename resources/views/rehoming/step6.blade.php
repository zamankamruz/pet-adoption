<?php
// File: step6.blade.php
// Path: /resources/views/rehoming/step6.blade.php
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
                @for($i = 1; $i <= 5; $i++)
                <div class="flex items-center">
                    <div class="w-8 h-8 bg-green-500 rounded-full flex items-center justify-center">
                        <i class="fas fa-check text-white text-xs"></i>
                    </div>
                </div>
                @endfor
                
                <div class="flex items-center">
                    <div class="w-8 h-8 bg-purple-500 rounded-full flex items-center justify-center">
                        <span class="text-white text-sm font-bold">6</span>
                    </div>
                    <span class="ml-2 text-sm font-medium text-purple-600">Pet's Location</span>
                </div>

                @for($i = 7; $i <= 9; $i++)
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
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <div class="border-2 border-blue-300 p-6">
                <form method="POST" action="{{ route('rehoming.step6.store') }}">
                    @csrf
                    
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                        <!-- Left Side - Form -->
                        <div>
                            <div class="mb-6">
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    Please enter the Postcode of your pet's address
                                </label>
                                <div class="flex">
                                    <input type="text" name="postcode" value="{{ old('postcode', $rehoming->postcode) }}" 
                                           class="flex-1 px-4 py-3 border border-gray-300 rounded-l-lg focus:outline-none focus:ring-2 focus:ring-purple-500"
                                           placeholder="Postcode" required>
                                    <button type="button" id="lookupBtn" class="px-4 py-3 bg-yellow-400 text-black font-medium rounded-r-lg hover:bg-yellow-500 transition-colors">
                                        Look Address
                                    </button>
                                </div>
                                @error('postcode')
                                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="text-sm text-gray-600 mb-6">Or enter address manually</div>

                            <!-- Address Line 1 -->
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700 mb-2">Address line 1 *</label>
                                <input type="text" name="address_line_1" value="{{ old('address_line_1', $rehoming->address_line_1) }}" 
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500" required>
                                @error('address_line_1')
                                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Address Line 2 -->
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700 mb-2">Address line 2</label>
                                <input type="text" name="address_line_2" value="{{ old('address_line_2', $rehoming->address_line_2) }}" 
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500">
                                @error('address_line_2')
                                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- City -->
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700 mb-2">City *</label>
                                <input type="text" name="city" value="{{ old('city', $rehoming->city) }}" 
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500" required>
                                @error('city')
                                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Postcode (repeated) -->
                            <div class="mb-6">
                                <label class="block text-sm font-medium text-gray-700 mb-2">Postcode *</label>
                                <input type="text" name="postcode_confirm" value="{{ old('postcode', $rehoming->postcode) }}" 
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500" required>
                            </div>
                        </div>

                        <!-- Right Side - Map -->
                        <div>
                            <div id="map" class="w-full h-96 bg-gray-200 rounded-lg flex items-center justify-center">
                                <div class="text-gray-500">
                                    <i class="fas fa-map-marker-alt text-4xl mb-2"></i>
                                    <div>Map will appear here</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex justify-between mt-8">
                        <a href="{{ route('rehoming.step5') }}" class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors">
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
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const lookupBtn = document.getElementById('lookupBtn');
    const postcodeInput = document.querySelector('input[name="postcode"]');
    
    lookupBtn.addEventListener('click', function() {
        const postcode = postcodeInput.value.trim();
        if (postcode) {
            // Simulate address lookup
            alert('Address lookup functionality would be implemented here');
            // In real implementation, this would call a postcode lookup API
        } else {
            alert('Please enter a postcode first');
        }
    });

    // Initialize map (placeholder)
    // In real implementation, you would integrate with Google Maps or similar
    const mapDiv = document.getElementById('map');
    mapDiv.innerHTML = `
        <div class="text-center">
            <i class="fas fa-map-marker-alt text-6xl text-purple-500 mb-4"></i>
            <div class="text-lg font-medium text-gray-700">Los Angeles Area</div>
            <div class="text-sm text-gray-500">Map integration would show exact location</div>
        </div>
    `;
});
</script>
@endsection