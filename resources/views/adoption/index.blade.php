<?php
// File: index.blade.php
// Path: /resources/views/pets/index.blade.php
?>

@extends('layouts.app')

@section('content')
<div class="bg-gray-50 min-h-screen pt-8">
    <div class="max-w-7xl mx-auto px-4">
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-6 mx-auto px-4 sm:px-6 lg:px-8">
<!-- Filters Sidebar -->
<div class="lg:col-span-1">
  <div class="bg-white rounded-2xl p-6 shadow-sm border sticky top-24">
    <div class="flex justify-between items-center mb-6 pb-4 border-b border-gray-100">
      <h3 class="text-lg font-semibold text-gray-900">Filters</h3>
      <a href="{{ route('pets.index') }}" class="text-purple-600 text-sm font-medium hover:underline">
        Reset Filters
      </a>
    </div>

    <form method="GET" action="{{ route('pets.index') }}" id="filterForm">
      <!-- Animal Type Selection -->
      <div class="mb-6">
        <div class="grid grid-cols-2 gap-4">
          <!-- Cat -->
          <a href="{{ route('pets.index', array_merge(request()->query(), ['species' => 'cat'])) }}"
             class="flex flex-col items-center text-sm">
            <div class="w-16 h-16 rounded-full border-2 flex items-center justify-center mb-2 transition-colors duration-200
                        {{ request('species') === 'cat'
                           ? 'bg-purple-50 border-purple-500 text-white'
                           : 'border-gray-200 text-gray-400 hover:border-gray-300' }}">
              <img src="{{ asset('images/cat.png') }}" alt="">
            </div>
            <span class="{{ request('species') === 'cat' ? 'text-purple-600' : 'text-gray-600' }} font-medium">
              Cat
            </span>
          </a>
          
          <!-- Dog -->
          <a href="{{ route('pets.index', array_merge(request()->query(), ['species' => 'dog'])) }}"
             class="flex flex-col items-center text-sm">
            <div class="w-16 h-16 rounded-full border-2 flex items-center justify-center mb-2 transition-colors duration-200
                        {{ request('species') === 'dog'
                           ? 'bg-purple-50 border-purple-500 text-white'
                           : 'border-gray-200 text-gray-400 hover:border-gray-300' }}">
              <img src="{{ asset('images/dog.png') }}" alt="">
            </div>
            <span class="{{ request('species') === 'dog' ? 'text-purple-600' : 'text-gray-600' }} font-medium">
              Dog
            </span>
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

                        <!-- Distance Filter -->
<div class="mb-6">
  <label class="block text-sm font-medium text-gray-700 mb-2">Distance</label>
  <!-- dynamic miles text -->
  <div id="distanceLabel" class="text-sm text-gray-700 mb-2">
    {{ request('distance', 0) }} Miles
  </div>
  <div class="relative">
    <!-- full track -->
    <div class="w-full h-1 bg-gray-200 rounded-full"></div>
    <!-- filled track -->
    <div id="filledTrack" class="absolute top-0 left-0 h-1 bg-purple-500 rounded-full" style="width: {{ request('distance',0) }}%"></div>
    <!-- invisible range input sits on top -->
    <input
      type="range"
      name="distance"
      min="0" max="100"
      value="{{ request('distance', 0) }}"
      oninput="updateDistance(this)"
      class="absolute top-0 left-0 w-full h-1 opacity-0 cursor-pointer"
    />
    <!-- paw thumb -->
    <div
      id="pawThumb"
      class="absolute top-1/2 text-purple-500 transform -translate-y-1/2"
      style="left: {{ request('distance',0) }}%"
    >
      <i class="fas fa-paw fa-lg"></i>
    </div>
  </div>
</div>

<script>
  function updateDistance(el) {
    const v = el.value;
    // move & resize
    document.getElementById('filledTrack').style.width = v + '%';
    document.getElementById('pawThumb').style.left     = v + '%';
    // update label
    document.getElementById('distanceLabel').innerText = v + ' Miles';
  }
</script>


                        <!-- Size Filter -->
                        <div class="mb-6">
                            <label class="block text-sm font-medium text-gray-700 mb-3">Size</label>
                            <div class="grid grid-cols-3 gap-3">
                                <div class="size-option {{ in_array('small', (array)request('size')) ? 'bg-purple-500 text-white border-purple-500' : 'bg-white text-gray-600 border-gray-200' }} flex flex-col items-center p-3 rounded-lg cursor-pointer transition-all duration-200 hover:border-purple-300" 
                                     onclick="toggleSize('small')">
                                    <img src="{{ asset('images/small.png') }}" alt="">
                                    <span class="text-xs font-medium">Small</span>
                                </div>
                                <div class="size-option {{ in_array('medium', (array)request('size')) ? 'bg-purple-500 text-white border-purple-500' : 'bg-white text-gray-600 border-gray-200' }} flex flex-col items-center p-3  rounded-lg cursor-pointer transition-all duration-200 hover:border-purple-300" 
                                     onclick="toggleSize('medium')">
                                     <img src="{{ asset('images/mediam.png') }}" alt="">

                                    <span class="text-xs font-medium">Medium</span>
                                </div>
                                <div class="size-option {{ in_array('large', (array)request('size')) ? 'bg-purple-500 text-white border-purple-500' : 'bg-white text-gray-600 border-gray-200' }} flex flex-col items-center p-3  rounded-lg cursor-pointer transition-all duration-200 hover:border-purple-300" 
                                     onclick="toggleSize('large')">
                                    <img src="{{ asset('images/large.png') }}" alt="">

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
                        <div class="space-y-3">
                            @php
                            $colors = [
                                'golden'  => 'bg-yellow-400',
                                'brown'   => 'bg-amber-800',
                                'gray'    => 'bg-gray-500',
                                'black'   => 'bg-black',
                                'red'     => 'bg-red-500',
                                'bicolor' => 'bg-gradient-to-r from-amber-600 to-yellow-400',
                                'brindle' => 'bg-gradient-to-r from-amber-800 via-yellow-600 to-amber-700',
                            ];
                            $selected = (array)request('colors', []);
                            @endphp

                            @foreach($colors as $value => $bgClass)
                            <label class="flex items-center space-x-2 cursor-pointer">
                                <input
                                type="checkbox"
                                name="colors[]"
                                value="{{ $value }}"
                                {{ in_array($value, $selected) ? 'checked' : '' }}
                                onchange="document.getElementById('filterForm').submit()"
                                class="sr-only"
                                >
                                <div class="w-4 h-4 {{ $bgClass }} rounded-full border border-gray-300"></div>
                                <span class="text-sm text-gray-600 capitalize">{{ $value }}</span>
                            </label>
                            @endforeach

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

                       <button
  type="submit"
  class="w-full border-2 border-purple-600 text-purple-600 bg-transparent py-3 px-6 rounded-lg font-medium
         hover:bg-purple-600 hover:text-white transition-all duration-200 transform hover:scale-105"
>
  Apply Filter
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
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                    @foreach($pets as $pet)
                        <div class="bg-white rounded-2xl overflow-hidden shadow-sm border hover:shadow-lg transition-all duration-300 hover:-translate-y-1">
                        
                        <!-- much shorter image block -->
                        <div class="relative h-32 overflow-hidden">
                            <img src="{{ $pet->main_image_url }}"
                                alt="{{ $pet->name }}"
                                class="w-full h-full object-cover transition-transform duration-300 hover:scale-105">
                            {{-- badges & heart as before --}}
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

                                <!-- tighter padding -->
                                <div class="p-3">
                                    <div class="flex justify-between items-start mb-1">
                                    <h3 class="text-lg font-semibold text-gray-900">{{ $pet->name }}</h3>
                                    <span class="text-sm text-purple-600 font-medium">{{ ucfirst($pet->gender) }}</span>
                                    </div>

                                    <div class="flex items-center text-gray-500 text-sm mb-2">
                                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 24 24">…</svg>
                                    {{ $pet->location->city }}, {{ $pet->location->state }}
                                    </div>

                                    <div class="grid grid-cols-2 gap-2 text-sm mb-2">
                                    <div><strong>Breed:</strong> {{ $pet->breed->name }}</div>
                                    <div><strong>Age:</strong> {{ $pet->age_display }}</div>
                                    </div>

                                    <p class="text-gray-600 text-sm line-clamp-2 mb-2">
                                    {{ Str::limit($pet->description, 80) }}
                                    </p>

                                    <a href="{{ route('adoption.show', $pet) }}"
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