<?php
// File: pets.blade.php  
// Path: /resources/views/search/pets.blade.php
?>
@extends('layouts.app')
@section('content')
<div class="bg-gray-50 min-h-screen pt-6 mx-auto px-4 sm:px-6 lg:px-8">
    <div class="max-w-7xl mx-auto px-4">
        <!-- Search Header -->
        <div class="mb-6">
            <div class="bg-white rounded-xl p-4 shadow-sm border">
                <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-3">
                    <!-- Search Info -->
                    <div class="flex-1">
                        @if($query)
                            <h1 class="text-lg font-bold text-gray-900 mb-1">
                                Search Results for "{{ $query }}"
                            </h1>
                            <p class="text-sm text-gray-600">
                                Found {{ $pets->total() }} {{ Str::plural('pet', $pets->total()) }} matching your search
                            </p>
                        @else
                            <h1 class="text-lg font-bold text-gray-900 mb-1">
                                Pet Search
                            </h1>
                            <p class="text-sm text-gray-600">
                                {{ $pets->total() }} {{ Str::plural('pet', $pets->total()) }} available for adoption
                            </p>
                        @endif
                    </div>
                <!-- Advanced Search Button -->
                <div class="flex items-center space-x-2">
                    @if($query || !empty(array_filter($filters)))
                        <a href="{{ route('pets.search') }}" 
                           class="flex items-center px-3 py-1.5 text-sm text-purple-600 border border-purple-200 rounded-lg hover:bg-purple-50 transition-colors duration-200">
                            <i class="fas fa-times mr-1 text-xs"></i>
                            Clear Search
                        </a>
                    @endif
                    <button onclick="toggleAdvancedSearch()" 
                            class="flex items-center px-3 py-1.5 text-sm bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition-colors duration-200">
                        <i class="fas fa-sliders-h mr-1 text-xs"></i>
                        Advanced Search
                    </button>
                </div>
            </div>

            <!-- Applied Filters -->
            @if($query || !empty(array_filter($filters)))
                <div class="mt-3 pt-3 border-t border-gray-100">
                    <div class="flex flex-wrap gap-1.5">
                        @if($query)
                            <span class="inline-flex items-center px-2 py-1 bg-purple-100 text-purple-800 rounded-full text-xs">
                                Search: "{{ $query }}"
                                <a href="{{ route('pets.search', array_merge(request()->query(), ['q' => ''])) }}" 
                                   class="ml-1 text-purple-600 hover:text-purple-800">
                                    <i class="fas fa-times text-xs"></i>
                                </a>
                            </span>
                        @endif

                        @foreach($filters as $key => $value)
                            @if($value)
                                <span class="inline-flex items-center px-2 py-1 bg-blue-100 text-blue-800 rounded-full text-xs">
                                    {{ ucwords(str_replace('_', ' ', $key)) }}: 
                                    @if(is_array($value))
                                        {{ implode(', ', $value) }}
                                    @else
                                        {{ $value }}
                                    @endif
                                    <a href="{{ route('pets.search', array_merge(request()->query(), [$key => ''])) }}" 
                                       class="ml-1 text-blue-600 hover:text-blue-800">
                                        <i class="fas fa-times text-xs"></i>
                                    </a>
                                </span>
                            @endif
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </div>

    <!-- Advanced Search Panel (Hidden by default) -->
    <div id="advanced-search" class="hidden mb-6">
        <div class="bg-white rounded-xl p-4 shadow-sm border">
            <h3 class="text-sm font-semibold text-gray-900 mb-3">Advanced Search</h3>
            <form method="GET" action="{{ route('pets.search') }}" class="space-y-4">
                <!-- Keep existing query -->
                <input type="hidden" name="q" value="{{ $query }}">

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                    <!-- Species -->
                    <div>
                        <label class="block text-xs font-medium text-gray-700 mb-1">Animal Type</label>
                        <select name="species" class="w-full px-2 py-1.5 text-sm border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500">
                            <option value="">Any</option>
                            <option value="dog" {{ request('species') === 'dog' ? 'selected' : '' }}>Dog</option>
                            <option value="cat" {{ request('species') === 'cat' ? 'selected' : '' }}>Cat</option>
                            <option value="bird" {{ request('species') === 'bird' ? 'selected' : '' }}>Bird</option>
                            <option value="rabbit" {{ request('species') === 'rabbit' ? 'selected' : '' }}>Rabbit</option>
                        </select>
                    </div>

                    <!-- Breed -->
                    <div>
                        <label class="block text-xs font-medium text-gray-700 mb-1">Breed</label>
                        <select name="breed_id" class="w-full px-2 py-1.5 text-sm border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500">
                            <option value="">Any Breed</option>
                            @foreach($breeds as $breed)
                                <option value="{{ $breed->id }}" {{ request('breed_id') == $breed->id ? 'selected' : '' }}>
                                    {{ $breed->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Location -->
                    <div>
                        <label class="block text-xs font-medium text-gray-700 mb-1">Location</label>
                        <select name="location_id" class="w-full px-2 py-1.5 text-sm border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500">
                            <option value="">Any Location</option>
                            @foreach($locations as $location)
                                <option value="{{ $location->id }}" {{ request('location_id') == $location->id ? 'selected' : '' }}>
                                    {{ $location->city }}, {{ $location->state }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Age Range -->
                    <div>
                        <label class="block text-xs font-medium text-gray-700 mb-1">Age</label>
                        <div class="grid grid-cols-2 gap-1">
                            <input type="number" name="age_min" placeholder="Min" 
                                   value="{{ request('age_min') }}"
                                   class="px-2 py-1.5 text-sm border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500">
                            <input type="number" name="age_max" placeholder="Max" 
                                   value="{{ request('age_max') }}"
                                   class="px-2 py-1.5 text-sm border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500">
                        </div>
                    </div>
                </div>

                <div class="flex items-center space-x-3">
                    <button type="submit" class="bg-purple-600 text-white px-4 py-1.5 text-sm rounded-lg hover:bg-purple-700 transition-colors duration-200">
                        <i class="fas fa-search mr-1 text-xs"></i>
                        Search Pets
                    </button>
                    <a href="{{ route('pets.search') }}" class="text-sm text-gray-600 hover:text-gray-800 transition-colors duration-200">
                        Clear All Filters
                    </a>
                </div>
            </form>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-4 gap-4">
        <!-- Quick Filters Sidebar -->
        <div class="lg:col-span-1">
            <div class="bg-white rounded-xl p-4 shadow-sm border sticky top-20">
                <div class="flex justify-between items-center mb-4 pb-3 border-b border-gray-100">
                    <h3 class="text-sm font-semibold text-gray-900">Quick Filters</h3>
                    <a href="{{ route('pets.search', ['q' => $query]) }}" class="text-purple-600 text-xs font-medium hover:underline">Reset</a>
                </div>

                <form method="GET" action="{{ route('pets.search') }}" id="quickFilterForm">
                    <input type="hidden" name="q" value="{{ $query }}">

                    <!-- Animal Type -->
                    <div class="mb-4">
                        <label class="block text-xs font-medium text-gray-700 mb-2">Animal Type</label>
                        <div class="grid grid-cols-2 gap-2">
                            <a href="{{ route('pets.search', array_merge(request()->query(), ['species' => 'cat'])) }}" 
                               class="flex flex-col items-center p-2 border-2 rounded-lg transition-all duration-200 {{ request('species') === 'cat' ? 'border-purple-500 bg-purple-50 text-purple-600' : 'border-gray-200 text-gray-600 hover:border-gray-300' }}">
                                <i class="fas fa-cat text-lg mb-1"></i>
                                <span class="text-xs font-medium">Cat</span>
                            </a>
                            <a href="{{ route('pets.search', array_merge(request()->query(), ['species' => 'dog'])) }}" 
                               class="flex flex-col items-center p-2 border-2 rounded-lg transition-all duration-200 {{ request('species') === 'dog' ? 'border-purple-500 bg-purple-50 text-purple-600' : 'border-gray-200 text-gray-600 hover:border-gray-300' }}">
                                <i class="fas fa-dog text-lg mb-1"></i>
                                <span class="text-xs font-medium">Dog</span>
                            </a>
                        </div>
                    </div>

                    <!-- Popular Breeds -->
                    @if($breeds->count() > 0)
                        <div class="mb-4">
                            <label class="block text-xs font-medium text-gray-700 mb-2">Popular Breeds</label>
                            <div class="space-y-1">
                                @foreach($breeds->take(5) as $breed)
                                    <label class="flex items-center">
                                        <input type="radio" name="breed_id" value="{{ $breed->id }}" 
                                               {{ request('breed_id') == $breed->id ? 'checked' : '' }}
                                               class="text-purple-600 focus:ring-purple-500"
                                               onchange="this.form.submit()">
                                        <span class="ml-2 text-xs text-gray-600">{{ $breed->name }}</span>
                                    </label>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <!-- Size Filter -->
                    <div class="mb-4">
                        <label class="block text-xs font-medium text-gray-700 mb-2">Size</label>
                        <div class="space-y-1">
                            @foreach(['small', 'medium', 'large'] as $size)
                                <label class="flex items-center">
                                    <input type="checkbox" name="size[]" value="{{ $size }}" 
                                           {{ in_array($size, (array)request('size')) ? 'checked' : '' }}
                                           class="text-purple-600 focus:ring-purple-500 rounded"
                                           onchange="this.form.submit()">
                                    <span class="ml-2 text-xs text-gray-600">{{ ucfirst($size) }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>

                    <!-- Special Qualities -->
                    <div class="mb-4">
                        <label class="block text-xs font-medium text-gray-700 mb-2">Special Qualities</label>
                        <div class="space-y-1">
                            <label class="flex items-center">
                                <input type="checkbox" name="good_with_kids" value="1" 
                                       {{ request('good_with_kids') ? 'checked' : '' }}
                                       class="text-purple-600 focus:ring-purple-500 rounded"
                                       onchange="this.form.submit()">
                                <span class="ml-2 text-xs text-gray-600">Good with kids</span>
                            </label>
                            <label class="flex items-center">
                                <input type="checkbox" name="good_with_pets" value="1" 
                                       {{ request('good_with_pets') ? 'checked' : '' }}
                                       class="text-purple-600 focus:ring-purple-500 rounded"
                                       onchange="this.form.submit()">
                                <span class="ml-2 text-xs text-gray-600">Good with pets</span>
                            </label>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Search Results -->
        <div class="lg:col-span-3">
            <!-- Results Header with Sort -->
            <div class="flex justify-between items-center mb-4">
                <div class="text-sm text-gray-600">
                    Showing {{ $pets->firstItem() ?? 0 }}-{{ $pets->lastItem() ?? 0 }} of {{ $pets->total() }} pets
                </div>
                <select name="sort" class="px-3 py-1.5 text-sm border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500" onchange="updateSort(this.value)">
                    <option value="relevance" {{ request('sort') === 'relevance' ? 'selected' : '' }}>Most Relevant</option>
                    <option value="newest" {{ request('sort') === 'newest' ? 'selected' : '' }}>Newest First</option>
                    <option value="name" {{ request('sort') === 'name' ? 'selected' : '' }}>Name A-Z</option>
                    <option value="age" {{ request('sort') === 'age' ? 'selected' : '' }}>Age</option>
                    <option value="fee_low" {{ request('sort') === 'fee_low' ? 'selected' : '' }}>Fee: Low to High</option>
                    <option value="fee_high" {{ request('sort') === 'fee_high' ? 'selected' : '' }}>Fee: High to Low</option>
                    <option value="featured" {{ request('sort') === 'featured' ? 'selected' : '' }}>Featured First</option>
                </select>
            </div>

            @if($pets->count() > 0)
                <!-- Search Results Grid - 4 pets per row -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4 mb-6">
                    @foreach($pets as $pet)
                        <div class="bg-white rounded-xl overflow-hidden shadow-sm border hover:shadow-lg transition-all duration-300 hover:-translate-y-1">
                            <!-- Pet Image - Smaller height -->
                            <div class="relative h-32 overflow-hidden">
                                <img src="{{ $pet->main_image_url }}" 
                                     alt="{{ $pet->name }}" 
                                     class="w-full h-full object-cover transition-transform duration-300 hover:scale-105">
                                
                                <!-- Badges -->
                                @if($pet->is_new)
                                    <div class="absolute top-2 left-2 bg-blue-500 text-white text-xs font-bold px-1.5 py-0.5 rounded-full">
                                        NEW
                                    </div>
                                @endif
                                @if($pet->is_featured)
                                    <div class="absolute top-2 left-2 bg-yellow-500 text-white text-xs font-bold px-1.5 py-0.5 rounded-full">
                                        FEATURED
                                    </div>
                                @endif
                                @if($pet->is_urgent)
                                    <div class="absolute top-2 left-2 bg-red-500 text-white text-xs font-bold px-1.5 py-0.5 rounded-full">
                                        URGENT
                                    </div>
                                @endif

                                <!-- Heart Icon -->
                                <button class="absolute top-2 right-2 w-6 h-6 bg-white bg-opacity-90 rounded-full flex items-center justify-center hover:bg-purple-500 hover:text-white transition-all duration-200 {{ auth()->check() && auth()->user()->hasFavorited($pet) ? 'text-red-500' : 'text-gray-400' }}" 
                                        onclick="toggleFavorite({{ $pet->id }}, this)" 
                                        data-pet-id="{{ $pet->id }}">
                                    <i class="fas fa-heart text-xs"></i>
                                </button>
                            </div>

                            <!-- Pet Info - Compact -->
                            <div class="p-3">
                                <div class="flex justify-between items-start mb-1">
                                    <h3 class="text-sm font-semibold text-gray-900 truncate">{{ $pet->name }}</h3>
                                    <span class="text-xs text-purple-600 font-medium">${{ number_format($pet->adoption_fee) }}</span>
                                </div>
                                
                                <div class="flex items-center text-gray-500 text-xs mb-2">
                                    <i class="fas fa-map-marker-alt mr-1"></i>
                                    <span class="truncate">{{ $pet->location->city }}, {{ $pet->location->state }}</span>
                                </div>

                                <!-- Pet Details - Compact -->
                                <div class="grid grid-cols-2 gap-1 text-xs mb-2">
                                    <div class="flex justify-between">
                                        <span class="text-gray-600">Breed:</span>
                                        <span class="font-medium text-gray-900 truncate">{{ Str::limit($pet->breed->name, 8) }}</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-gray-600">Age:</span>
                                        <span class="font-medium text-gray-900">{{ $pet->age_display }}</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-gray-600">Size:</span>
                                        <span class="font-medium text-gray-900">{{ ucfirst($pet->size) }}</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-gray-600">Gender:</span>
                                        <span class="font-medium text-gray-900">{{ ucfirst($pet->gender) }}</span>
                                    </div>
                                </div>

                                <!-- Description - Shorter -->
                                <p class="text-gray-600 text-xs mb-2 line-clamp-1">
                                    {{ Str::limit($pet->description, 50) }}
                                </p>

                                <!-- Pet Features - Compact -->
                                <div class="flex items-center justify-center space-x-3 mb-2 text-xs">
                                    <div class="flex items-center {{ $pet->good_with_kids ? 'text-green-600' : 'text-gray-300' }}">
                                        <i class="fas fa-child mr-1"></i>
                                        <span>Kids</span>
                                    </div>
                                    <div class="flex items-center {{ $pet->good_with_pets ? 'text-green-600' : 'text-gray-300' }}">
                                        <i class="fas fa-paw mr-1"></i>
                                        <span>Pets</span>
                                    </div>
                                    <div class="flex items-center {{ $pet->house_trained ? 'text-green-600' : 'text-gray-300' }}">
                                        <i class="fas fa-home mr-1"></i>
                                        <span>Trained</span>
                                    </div>
                                </div>

                                <!-- View Details Button - Smaller -->
                                <a href="{{ route('adoption.show', $pet) }}" 
                                   class="block w-full text-center py-1.5 text-xs border-2 border-purple-600 text-purple-600 rounded-lg font-medium hover:bg-purple-600 hover:text-white transition-all duration-200">
                                    View Details
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="flex justify-center">
                    {{ $pets->withQueryString()->links('pagination::tailwind') }}
                </div>
            @else
                <!-- No Results Found -->
                <div class="text-center py-8">
                    <div class="max-w-md mx-auto">
                        <i class="fas fa-search text-4xl text-gray-300 mb-3"></i>
                        <h3 class="text-lg font-semibold text-gray-900 mb-2">No pets found</h3>
                        @if($query)
                            <p class="text-sm text-gray-600 mb-3">
                                We couldn't find any pets matching "{{ $query }}"
                            </p>
                        @else
                            <p class="text-sm text-gray-600 mb-3">
                                Try adjusting your search filters to see more results.
                            </p>
                        @endif
                        
                        <div class="space-y-1">
                            <p class="text-xs text-gray-500">Suggestions:</p>
                            <ul class="text-xs text-gray-500 space-y-1">
                                <li>• Try different keywords</li>
                                <li>• Remove some filters</li>
                                <li>• Check spelling</li>
                                <li>• Search for breed names</li>
                            </ul>
                        </div>
                        
                        <div class="mt-4">
                            <a href="{{ route('pets.search') }}" 
                               class="inline-flex items-center px-3 py-1.5 text-sm bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition-colors duration-200">
                                <i class="fas fa-search mr-1 text-xs"></i>
                                Browse All Pets
                            </a>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Search Suggestions -->
            @if($pets->count() > 0 && $pets->total() < 10)
                <div class="mt-6 bg-blue-50 rounded-xl p-4">
                    <h3 class="text-sm font-semibold text-blue-900 mb-2">Try These Popular Searches</h3>
                    <div class="flex flex-wrap gap-1.5">
                        <a href="{{ route('pets.search', ['q' => 'friendly']) }}" 
                           class="px-2 py-1 bg-blue-100 text-blue-800 rounded-full text-xs hover:bg-blue-200 transition-colors duration-200">
                            Friendly pets
                        </a>
                        <a href="{{ route('pets.search', ['q' => 'small']) }}" 
                           class="px-2 py-1 bg-blue-100 text-blue-800 rounded-full text-xs hover:bg-blue-200 transition-colors duration-200">
                            Small dogs
                        </a>
                        <a href="{{ route('pets.search', ['species' => 'cat', 'good_with_kids' => 1]) }}" 
                           class="px-2 py-1 bg-blue-100 text-blue-800 rounded-full text-xs hover:bg-blue-200 transition-colors duration-200">
                            Cats good with kids
                        </a>
                        <a href="{{ route('pets.search', ['age_max' => 2]) }}" 
                           class="px-2 py-1 bg-blue-100 text-blue-800 rounded-full text-xs hover:bg-blue-200 transition-colors duration-200">
                            Young pets
                        </a>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
</div>
<script>
function toggleAdvancedSearch() {
    const advancedSearch = document.getElementById('advanced-search');
    advancedSearch.classList.toggle('hidden');
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

// Search suggestions functionality
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.querySelector('input[name="q"]');
    if (searchInput) {
        // Add autocomplete functionality here if needed
    }
});
</script>
@endsection