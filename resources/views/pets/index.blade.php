<?php
// File: index.blade.php
// Path: /resources/views/pets/index.blade.php
?>

@extends('layouts.app')

@section('content')
<div class="bg-gray-50 min-h-screen pt-8">
    <div class="max-w-7xl mx-auto px-4">
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-6">
            <!-- Filters Sidebar -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-2xl p-6 shadow-sm border sticky top-24">
                    <div class="flex justify-between items-center mb-6 pb-4 border-b border-gray-100">
                        <h3 class="text-lg font-semibold text-gray-900">Filters</h3>
                        <a href="{{ route('pets.index') }}" class="text-purple-600 text-sm font-medium hover:underline">Reset Filters</a>
                    </div>

                    <form method="GET" action="{{ route('pets.index') }}" id="filterForm">
                        <!-- Animal Type Selection -->
                        <div class="mb-6">
                            <div class="grid grid-cols-2 gap-3">
                                <a href="{{ route('pets.index', array_merge(request()->query(), ['species' => 'cat'])) }}" 
                                   class="flex flex-col items-center p-4 border-2 rounded-xl transition-all duration-200 {{ request('species') === 'cat' ? 'border-purple-500 bg-purple-50 text-purple-600' : 'border-gray-200 text-gray-600 hover:border-gray-300' }}">
                                    <div class="w-12 h-12 flex items-center justify-center mb-2">
                                        <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M12 2C13.1 2 14 2.9 14 4C14 5.1 13.1 6 12 6C10.9 6 10 5.1 10 4C10 2.9 10.9 2 12 2M21 9V7L15 1L13.5 2.5C13.1 1.9 12.6 1.4 12 1.1C11.4 1.4 10.9 1.9 10.5 2.5L9 1L3 7V9H9C10.1 9 11 9.9 11 11V16C11 17.1 11.9 18 13 18H15C16.1 18 17 17.1 17 16V11C17 9.9 17.9 9 19 9H21Z"/>
                                        </svg>
                                    </div>
                                    <span class="text-sm font-medium">Cat</span>
                                </a>
                                <a href="{{ route('pets.index', array_merge(request()->query(), ['species' => 'dog'])) }}" 
                                   class="flex flex-col items-center p-4 border-2 rounded-xl transition-all duration-200 {{ request('species') === 'dog' ? 'border-purple-500 bg-purple-50 text-purple-600' : 'border-gray-200 text-gray-600 hover:border-gray-300' }}">
                                    <div class="w-12 h-12 flex items-center justify-center mb-2">
                                        <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M4.5 12C3.12 12 2 13.12 2 14.5S3.12 17 4.5 17 7 15.88 7 14.5 5.88 12 4.5 12M19.5 12C18.12 12 17 13.12 17 14.5S18.12 17 19.5 17 22 15.88 22 14.5 20.88 12 19.5 12M12 3.5C10.62 3.5 9.5 4.62 9.5 6S10.62 8.5 12 8.5 14.5 7.38 14.5 6 13.38 3.5 12 3.5M12 20.5C10.9 20.5 10 19.6 10 18.5S10.9 16.5 12 16.5 14 17.4 14 18.5 13.1 20.5 12 20.5Z"/>
                                        </svg>
                                    </div>
                                    <span class="text-sm font-medium">Dog</span>
                                </a>
                            </div>
                        </div>

                        <!-- Location Filter -->
                        <div class="mb-6">
                            <label class="block text-sm font-medium text-gray-700 mb-3">Location</label>
                            <select name="location_id" class="w-full px-4 py-3 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                                <option value="">City or Zip</option>
                                @foreach($locations as $location)
                                    <option value="{{ $location->id }}" 
                                        {{ request('location_id') == $location->id ? 'selected' : '' }}>
                                        {{ $location->city }}, {{ $location->state }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Distance -->
                        <div class="mb-6">
                            <div class="flex items-center justify-between mb-3">
                                <span class="text-sm font-medium text-gray-700">Distance</span>
                                <span class="text-sm text-gray-500">Use current location</span>
                            </div>
                            <div class="flex items-center space-x-4">
                                <div class="flex-1 h-2 bg-gray-200 rounded-full relative">
                                    <div class="absolute inset-0 bg-purple-500 rounded-full" style="width: 0%"></div>
                                    <div class="absolute top-0 left-0 w-4 h-4 bg-purple-500 rounded-full transform -translate-y-1"></div>
                                </div>
                            </div>
                            <div class="flex justify-between text-xs text-gray-500 mt-2">
                                <span>0 Miles</span>
                                <span>100+ Miles</span>
                            </div>
                        </div>

                        <!-- Size Filter -->
                        <div class="mb-6">
                            <label class="block text-sm font-medium text-gray-700 mb-3">Size</label>
                            <div class="grid grid-cols-3 gap-3">
                                <div class="size-option {{ in_array('small', (array)request('size')) ? 'bg-purple-500 text-white border-purple-500' : 'bg-white text-gray-600 border-gray-200' }} flex flex-col items-center p-3 border-2 rounded-lg cursor-pointer transition-all duration-200 hover:border-purple-300" 
                                     onclick="toggleSize('small')">
                                    <svg class="w-4 h-4 mb-1" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M12 8.5C10.62 8.5 9.5 9.62 9.5 11S10.62 13.5 12 13.5 14.5 12.38 14.5 11 13.38 8.5 12 8.5M12 1.5C10.62 1.5 9.5 2.62 9.5 4S10.62 6.5 12 6.5 14.5 5.38 14.5 4 13.38 1.5 12 1.5M6 8.5C4.62 8.5 3.5 9.62 3.5 11S4.62 13.5 6 13.5 8.5 12.38 8.5 11 7.38 8.5 6 8.5M18 8.5C16.62 8.5 15.5 9.62 15.5 11S16.62 13.5 18 13.5 20.5 12.38 20.5 11 19.38 8.5 18 8.5Z"/>
                                    </svg>
                                    <span class="text-xs font-medium">Small</span>
                                </div>
                                <div class="size-option {{ in_array('medium', (array)request('size')) ? 'bg-purple-500 text-white border-purple-500' : 'bg-white text-gray-600 border-gray-200' }} flex flex-col items-center p-3 border-2 rounded-lg cursor-pointer transition-all duration-200 hover:border-purple-300" 
                                     onclick="toggleSize('medium')">
                                    <svg class="w-5 h-5 mb-1" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M12 8.5C10.62 8.5 9.5 9.62 9.5 11S10.62 13.5 12 13.5 14.5 12.38 14.5 11 13.38 8.5 12 8.5M12 1.5C10.62 1.5 9.5 2.62 9.5 4S10.62 6.5 12 6.5 14.5 5.38 14.5 4 13.38 1.5 12 1.5M6 8.5C4.62 8.5 3.5 9.62 3.5 11S4.62 13.5 6 13.5 8.5 12.38 8.5 11 7.38 8.5 6 8.5M18 8.5C16.62 8.5 15.5 9.62 15.5 11S16.62 13.5 18 13.5 20.5 12.38 20.5 11 19.38 8.5 18 8.5Z"/>
                                    </svg>
                                    <span class="text-xs font-medium">Medium</span>
                                </div>
                                <div class="size-option {{ in_array('large', (array)request('size')) ? 'bg-purple-500 text-white border-purple-500' : 'bg-white text-gray-600 border-gray-200' }} flex flex-col items-center p-3 border-2 rounded-lg cursor-pointer transition-all duration-200 hover:border-purple-300" 
                                     onclick="toggleSize('large')">
                                    <svg class="w-6 h-6 mb-1" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M12 8.5C10.62 8.5 9.5 9.62 9.5 11S10.62 13.5 12 13.5 14.5 12.38 14.5 11 13.38 8.5 12 8.5M12 1.5C10.62 1.5 9.5 2.62 9.5 4S10.62 6.5 12 6.5 14.5 5.38 14.5 4 13.38 1.5 12 1.5M6 8.5C4.62 8.5 3.5 9.62 3.5 11S4.62 13.5 6 13.5 8.5 12.38 8.5 11 7.38 8.5 6 8.5M18 8.5C16.62 8.5 15.5 9.62 15.5 11S16.62 13.5 18 13.5 20.5 12.38 20.5 11 19.38 8.5 18 8.5Z"/>
                                    </svg>
                                    <span class="text-xs font-medium">Large</span>
                                </div>
                            </div>
                            <input type="hidden" name="size[]" id="sizeInput" value="{{ implode(',', (array)request('size')) }}">
                        </div>

                        <!-- Breed Filter -->
                        <div class="mb-6">
                            <label class="block text-sm font-medium text-gray-700 mb-3">Breed</label>
                            <select name="breed_id" class="w-full px-4 py-3 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                                <option value="">Select Breed</option>
                                @foreach($breeds as $breed)
                                    <option value="{{ $breed->id }}" 
                                        {{ request('breed_id') == $breed->id ? 'selected' : '' }}>
                                        {{ $breed->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Color Filter -->
                        <div class="mb-6">
                            <label class="block text-sm font-medium text-gray-700 mb-3">Color</label>
                            <div class="grid grid-cols-3 gap-3">
                                <div class="flex items-center space-x-2">
                                    <div class="w-4 h-4 bg-yellow-400 rounded-full border border-gray-300"></div>
                                    <span class="text-sm text-gray-600">Golden</span>
                                </div>
                                <div class="flex items-center space-x-2">
                                    <div class="w-4 h-4 bg-amber-800 rounded-full border border-gray-300"></div>
                                    <span class="text-sm text-gray-600">Brown</span>
                                </div>
                                <div class="flex items-center space-x-2">
                                    <div class="w-4 h-4 bg-gray-500 rounded-full border border-gray-300"></div>
                                    <span class="text-sm text-gray-600">Gray</span>
                                </div>
                                <div class="flex items-center space-x-2">
                                    <div class="w-4 h-4 bg-black rounded-full border border-gray-300"></div>
                                    <span class="text-sm text-gray-600">Black</span>
                                </div>
                                <div class="flex items-center space-x-2">
                                    <div class="w-4 h-4 bg-red-500 rounded-full border border-gray-300"></div>
                                    <span class="text-sm text-gray-600">Red</span>
                                </div>
                                <div class="flex items-center space-x-2">
                                    <div class="w-4 h-4 bg-gradient-to-r from-amber-600 to-yellow-400 rounded-full border border-gray-300"></div>
                                    <span class="text-sm text-gray-600">Bicolor</span>
                                </div>
                                <div class="flex items-center space-x-2">
                                    <div class="w-4 h-4 bg-gradient-to-r from-amber-800 via-yellow-600 to-amber-700 rounded-full border border-gray-300"></div>
                                    <span class="text-sm text-gray-600">Brindle</span>
                                </div>
                            </div>
                        </div>

                        <!-- Gender Filter -->
                        <div class="mb-6">
                            <label class="block text-sm font-medium text-gray-700 mb-3">Gender</label>
                            <div class="space-y-3">
                                <label class="flex items-center">
                                    <input type="radio" name="gender" value="" class="text-purple-600 focus:ring-purple-500" {{ !request('gender') ? 'checked' : '' }}>
                                    <span class="ml-2 text-sm text-gray-600">Any</span>
                                </label>
                                <label class="flex items-center">
                                    <input type="radio" name="gender" value="female" class="text-purple-600 focus:ring-purple-500" {{ request('gender') === 'female' ? 'checked' : '' }}>
                                    <span class="ml-2 text-sm text-gray-600">Female</span>
                                </label>
                                <label class="flex items-center">
                                    <input type="radio" name="gender" value="male" class="text-purple-600 focus:ring-purple-500" {{ request('gender') === 'male' ? 'checked' : '' }}>
                                    <span class="ml-2 text-sm text-gray-600">Male</span>
                                </label>
                            </div>
                        </div>

                        <!-- Age Filter -->
                        <div class="mb-8">
                            <label class="block text-sm font-medium text-gray-700 mb-3">Age</label>
                            <select name="age" class="w-full px-4 py-3 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                                <option value="">Select Age</option>
                                <option value="young" {{ request('age') === 'young' ? 'selected' : '' }}>Young (0-2 years)</option>
                                <option value="adult" {{ request('age') === 'adult' ? 'selected' : '' }}>Adult (3-6 years)</option>
                                <option value="senior" {{ request('age') === 'senior' ? 'selected' : '' }}>Senior (7+ years)</option>
                            </select>
                        </div>

                        <button type="submit" class="w-full bg-gradient-to-r from-purple-600 to-purple-700 text-white py-3 px-6 rounded-lg font-medium hover:from-purple-700 hover:to-purple-800 transition-all duration-200 transform hover:scale-105">
                            Apply your Filter
                        </button>
                    </form>
                </div>
            </div>
             <!-- Main Content -->
            <div class="lg:col-span-3">
                <!-- Header with results count and sort -->
                <div class="flex justify-between items-center mb-6">
                    <div class="text-gray-600">
                        Showing {{ $pets->firstItem() ?? 0 }}-{{ $pets->lastItem() ?? 0 }} of {{ $pets->total() }} pets
                    </div>
                    <select name="sort" class="px-4 py-2 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-purple-500" onchange="updateSort(this.value)">
                        <option value="latest" {{ request('sort') === 'latest' ? 'selected' : '' }}>Latest</option>
                        <option value="name" {{ request('sort') === 'name' ? 'selected' : '' }}>Name A-Z</option>
                        <option value="age" {{ request('sort') === 'age' ? 'selected' : '' }}>Age</option>
                        <option value="featured" {{ request('sort') === 'featured' ? 'selected' : '' }}>Featured</option>
                    </select>
                </div>

                @if($pets->count() > 0)
                    <!-- Pets Grid -->
                    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6 mb-8">
                        @foreach($pets as $pet)
                            <div class="bg-white rounded-2xl overflow-hidden shadow-sm border hover:shadow-lg transition-all duration-300 hover:-translate-y-1">
                                <!-- Pet Image -->
                                <div class="relative h-48 overflow-hidden">
                                    <img src="{{ $pet->main_image_url }}" 
                                         alt="{{ $pet->name }}" 
                                         class="w-full h-full object-cover transition-transform duration-300 hover:scale-105">
                                    
                                    <!-- Badges -->
                                    @if($pet->is_new)
                                        <div class="absolute top-3 left-3 bg-blue-500 text-white text-xs font-bold px-2 py-1 rounded-full">
                                            NEW
                                        </div>
                                    @endif
                                    @if($pet->is_urgent)
                                        <div class="absolute top-3 left-3 bg-red-500 text-white text-xs font-bold px-2 py-1 rounded-full">
                                            URGENT
                                        </div>
                                    @endif

                                    <!-- Heart Icon -->
                                    <button class="absolute top-3 right-3 w-8 h-8 bg-white bg-opacity-90 rounded-full flex items-center justify-center hover:bg-purple-500 hover:text-white transition-all duration-200 {{ auth()->check() && auth()->user()->hasFavorited($pet) ? 'text-red-500' : 'text-gray-400' }}" 
                                            onclick="toggleFavorite({{ $pet->id }}, this)" 
                                            data-pet-id="{{ $pet->id }}">
                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
                                        </svg>
                                    </button>
                                </div>

                                <!-- Pet Info -->
                                <div class="p-5">
                                    <div class="flex justify-between items-start mb-2">
                                        <h3 class="text-lg font-semibold text-gray-900">{{ $pet->name }}</h3>
                                        <span class="text-sm text-purple-600 font-medium">{{ ucfirst($pet->gender) }}</span>
                                    </div>
                                    
                                    <div class="flex items-center text-gray-500 text-sm mb-3">
                                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/>
                                        </svg>
                                        {{ $pet->location->city }}, {{ $pet->location->state }}
                                    </div>

                                    <!-- Pet Details Grid -->
                                    <div class="grid grid-cols-2 gap-3 text-sm mb-4">
                                        <div class="flex justify-between">
                                            <span class="text-gray-600">Breed:</span>
                                            <span class="font-medium text-gray-900">{{ $pet->breed->name }}</span>
                                        </div>
                                        <div class="flex justify-between">
                                            <span class="text-gray-600">Age:</span>
                                            <span class="font-medium text-gray-900">{{ $pet->age_display }}</span>
                                        </div>
                                        <div class="flex justify-between">
                                            <span class="text-gray-600">Size:</span>
                                            <span class="font-medium text-gray-900">{{ ucfirst($pet->size) }}</span>
                                        </div>
                                    </div>

                                    <!-- Description -->
                                    <p class="text-gray-600 text-sm mb-4 line-clamp-2">
                                        {{ Str::limit($pet->description, 100) }}
                                    </p>

                                    <!-- Pet Features -->
                                    <div class="flex items-center space-x-4 mb-4 text-xs">
                                        <div class="flex items-center {{ $pet->good_with_kids ? 'text-green-600' : 'text-gray-300' }}">
                                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 24 24">
                                                <path d="M12 2C13.1 2 14 2.9 14 4C14 5.1 13.1 6 12 6C10.9 6 10 5.1 10 4C10 2.9 10.9 2 12 2M12 7C14.21 7 16 8.79 16 11V17H14V22H10V17H8V11C8 8.79 9.79 7 12 7Z"/>
                                            </svg>
                                            <span>Kids</span>
                                        </div>
                                        <div class="flex items-center {{ $pet->good_with_pets ? 'text-green-600' : 'text-gray-300' }}">
                                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 24 24">
                                                <path d="M12 8.5C10.62 8.5 9.5 9.62 9.5 11S10.62 13.5 12 13.5 14.5 12.38 14.5 11 13.38 8.5 12 8.5M12 1.5C10.62 1.5 9.5 2.62 9.5 4S10.62 6.5 12 6.5 14.5 5.38 14.5 4 13.38 1.5 12 1.5M6 8.5C4.62 8.5 3.5 9.62 3.5 11S4.62 13.5 6 13.5 8.5 12.38 8.5 11 7.38 8.5 6 8.5M18 8.5C16.62 8.5 15.5 9.62 15.5 11S16.62 13.5 18 13.5 20.5 12.38 20.5 11 19.38 8.5 18 8.5Z"/>
                                            </svg>
                                            <span>Pets</span>
                                        </div>
                                        <div class="flex items-center {{ $pet->house_trained ? 'text-green-600' : 'text-gray-300' }}">
                                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 24 24">
                                                <path d="M10 20V14H14V20H19V12H22L12 3L2 12H5V20H10Z"/>
                                            </svg>
                                            <span>Trained</span>
                                        </div>
                                    </div>

                                    <!-- More Info Button -->
                                    <a href="{{ route('pets.show', $pet) }}" 
                                       class="block w-full text-center py-2 border-2 border-purple-600 text-purple-600 rounded-lg font-medium hover:bg-purple-600 hover:text-white transition-all duration-200">
                                        More Info
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Pagination -->
                    <div class="flex justify-center">
                        <div class="flex items-center space-x-2">
                            {{ $pets->withQueryString()->links('pagination::tailwind') }}
                        </div>
                    </div>
                @else
                    <!-- No Pets Found -->
                    <div class="text-center py-12">
                        <svg class="w-16 h-16 mx-auto text-gray-300 mb-4" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M15.5 14H20.5L22 13L20.5 12H15.5C14.12 12 13 13.12 13 14.5S14.12 17 15.5 17H20.5L22 16L20.5 15H15.5C15.22 15 15 14.78 15 14.5S15.22 14 15.5 14M9.5 14C10.88 14 12 12.88 12 11.5S10.88 9 9.5 9H4.5L3 10L4.5 11H9.5C9.78 11 10 11.22 10 11.5S9.78 12 9.5 12H4.5L3 13L4.5 14H9.5Z"/>
                        </svg>
                        <h3 class="text-xl font-semibold text-gray-900 mb-2">No pets found</h3>
                        <p class="text-gray-600">Try adjusting your filters to see more results.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<script>
function toggleSize(size) {
    const sizeInput = document.getElementById('sizeInput');
    const currentSizes = sizeInput.value ? sizeInput.value.split(',') : [];
    const sizeIndex = currentSizes.indexOf(size);
    
    if (sizeIndex > -1) {
        currentSizes.splice(sizeIndex, 1);
    } else {
        currentSizes.push(size);
    }
    
    sizeInput.value = currentSizes.join(',');
    
    // Update visual state
    document.querySelectorAll('.size-option').forEach(option => {
        option.classList.remove('bg-purple-500', 'text-white', 'border-purple-500');
        option.classList.add('bg-white', 'text-gray-600', 'border-gray-200');
    });
    
    currentSizes.forEach(s => {
        const option = document.querySelector(`[onclick="toggleSize('${s}')"]`);
        if (option) {
            option.classList.remove('bg-white', 'text-gray-600', 'border-gray-200');
            option.classList.add('bg-purple-500', 'text-white', 'border-purple-500');
        }
    });
}

function updateSort(value) {
    const url = new URL(window.location);
    url.searchParams.set('sort', value);
    window.location.href = url.toString();
}

function toggleFavorite(petId, button) {
    @auth
        fetch(`/ajax/favorite/${petId}`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Content-Type': 'application/json',
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.favorited) {
                button.classList.add('text-red-500');
                button.classList.remove('text-gray-400');
            } else {
                button.classList.add('text-gray-400');
                button.classList.remove('text-red-500');
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
    @else
        window.location.href = '{{ route("login") }}';
    @endauth
}

// Auto-submit form when filters change
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('filterForm');
    const inputs = form.querySelectorAll('select, input[type="checkbox"], input[type="radio"]');
    
    inputs.forEach(input => {
        input.addEventListener('change', function() {
            form.submit();
        });
    });
});
</script>
@endsection