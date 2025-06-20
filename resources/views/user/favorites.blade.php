<?php
// File: favorites.blade.php
// Path: /resources/views/user/favorites.blade.php
?>

@extends('layouts.app')

@section('title', 'Favorites - Furry Friends')

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
                                <a href="{{ route('user.dashboard') }}" 
                                   class="flex items-center px-4 py-3 rounded-xl text-gray-600 hover:bg-purple-50 hover:text-purple-600 transition-all duration-200">
                                    <div class="w-8 h-8 bg-purple-100 text-purple-600 rounded-full flex items-center justify-center mr-3 text-sm">📊</div>
                                    <span class="font-medium">Overview</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('user.profile') }}" 
                                   class="flex items-center px-4 py-3 rounded-xl text-gray-600 hover:bg-purple-50 hover:text-purple-600 transition-all duration-200">
                                    <div class="w-8 h-8 bg-purple-100 text-purple-600 rounded-full flex items-center justify-center mr-3 text-sm">👤</div>
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
                                <a href="{{ route('user.rehomed') }}" 
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
                </div>
            </div>

            <!-- Main Content -->
            <div class="lg:col-span-3">
                <div class="bg-white rounded-2xl shadow-sm border overflow-hidden">
                    <!-- Header -->
                    <div class="p-6 border-b border-gray-100">
                        <div class="flex justify-between items-center">
                            <div>
                                <h1 class="text-2xl font-bold text-gray-900">My Favorites</h1>
                                <p class="text-gray-600 mt-1">{{ $totalFavorites }} pets in your favorites list</p>
                            </div>
                            @if($favorites->count() > 0)
                                <button onclick="clearAllFavorites()" 
                                        class="text-red-600 hover:text-red-700 font-medium transition-colors">
                                    Clear All
                                </button>
                            @endif
                        </div>
                    </div>

                    <!-- Favorites Content -->
                    <div class="p-6">
                        @if($favorites->count() > 0)
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                                @foreach($favorites as $favorite)
                                    @php $pet = $favorite->pet; @endphp
                                    <div class="bg-white border border-gray-200 rounded-xl overflow-hidden hover:shadow-lg transition-shadow duration-300" id="favorite-card-{{ $pet->id }}">
                                        <!-- Pet Image -->
                                        <div class="relative h-48 overflow-hidden">
                                            <img src="{{ $pet->main_image_url }}" alt="{{ $pet->name }}" 
                                                 class="w-full h-full object-cover">
                                            
                                            @if($pet->is_new)
                                                <div class="absolute top-3 left-3 bg-blue-500 text-white text-xs font-bold px-2 py-1 rounded-full flex items-center space-x-1">
                                                    <span>⭐</span>
                                                    <span>New</span>
                                                </div>
                                            @endif
                                            
                                            <button onclick="toggleFavorite({{ $pet->id }}, this)" 
                                                    class="absolute top-3 right-3 w-8 h-8 bg-red-500 text-white rounded-full flex items-center justify-center transition-all duration-300 hover:bg-red-600">
                                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd"></path>
                                                </svg>
                                            </button>
                                        </div>

                                        <!-- Pet Info -->
                                        <div class="p-4">
                                            <h3 class="text-lg font-semibold text-gray-900 mb-2">{{ $pet->name }}</h3>
                                            <div class="flex items-center text-gray-500 text-sm mb-3">
                                                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"></path>
                                                </svg>
                                                {{ $pet->location->city }}, {{ $pet->location->state }}
                                            </div>
                                            
                                            <!-- Pet Details -->
                                            <div class="space-y-2 text-sm mb-4">
                                                <div class="flex justify-between">
                                                    <span class="text-gray-600">Gender:</span>
                                                    <span class="font-medium text-gray-900">{{ ucfirst($pet->gender) }}</span>
                                                </div>
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

                                            <!-- Pet Features -->
                                            <div class="flex items-center space-x-3 mb-4 text-xs">
                                                <div class="flex items-center {{ $pet->good_with_kids ? 'text-green-600' : 'text-gray-300' }}">
                                                    <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                        <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                    </svg>
                                                    <span>Kids</span>
                                                </div>
                                                <div class="flex items-center {{ $pet->good_with_pets ? 'text-green-600' : 'text-gray-300' }}">
                                                    <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                        <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                    </svg>
                                                    <span>Pets</span>
                                                </div>
                                                <div class="flex items-center {{ $pet->house_trained ? 'text-green-600' : 'text-gray-300' }}">
                                                    <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                        <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                    </svg>
                                                    <span>Trained</span>
                                                </div>
                                            </div>

                                            <!-- Action Buttons -->
                                            <div class="space-y-2">
                                                <a href="{{ route('pets.show', $pet) }}" 
                                                   class="block w-full text-center py-2 bg-purple-600 hover:bg-purple-700 text-white rounded-lg transition-colors">
                                                    View Details
                                                </a>
                                                @if($pet->status === 'available')
                                                    <a href="{{ route('adoption.request', $pet) }}" 
                                                       class="block w-full text-center py-2 border border-purple-600 text-purple-600 hover:bg-purple-600 hover:text-white rounded-lg transition-colors">
                                                        Adopt {{ $pet->name }}
                                                    </a>
                                                @else
                                                    <div class="block w-full text-center py-2 bg-gray-300 text-gray-500 rounded-lg cursor-not-allowed">
                                                        Not Available
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <!-- Pagination -->
                            @if($favorites->hasPages())
                                <div class="mt-8 flex justify-center">
                                    {{ $favorites->links() }}
                                </div>
                            @endif
                        @else
                            <!-- Empty State -->
                            <div class="text-center py-12">
                                <svg class="w-16 h-16 mx-auto text-gray-300 mb-4" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd"></path>
                                </svg>
                                <h3 class="text-xl font-semibold text-gray-900 mb-2">No favorites yet</h3>
                                <p class="text-gray-600 mb-6">Start browsing pets and add your favorites to see them here.</p>
                                <a href="{{ route('pets.index') }}" 
                                   class="inline-block bg-purple-600 hover:bg-purple-700 text-white font-medium py-3 px-6 rounded-lg transition-colors">
                                    Browse Pets
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function toggleFavorite(petId, button) {
    fetch(`/ajax/favorite/${petId}`, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            'Content-Type': 'application/json',
        }
    })
    .then(response => response.json())
    .then(data => {
        if (!data.favorited) {
            // Remove the card with animation
            const card = document.getElementById(`favorite-card-${petId}`);
            card.style.transition = 'all 0.5s ease-out';
            card.style.transform = 'scale(0.8)';
            card.style.opacity = '0';
            setTimeout(() => {
                card.remove();
                // Check if no favorites left
                if (document.querySelectorAll('[id^="favorite-card-"]').length === 0) {
                    location.reload();
                }
            }, 500);
        }
    })
    .catch(error => {
        console.error('Error:', error);
    });
}

function clearAllFavorites() {
    if (confirm('Are you sure you want to remove all pets from your favorites?')) {
        fetch('/user/favorites/clear', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Content-Type': 'application/json',
            }
        })
        .then(response => response.json())
        .then(data => {
            location.reload();
        })
        .catch(error => {
            console.error('Error:', error);
        });
    }
}
</script>
@endsection