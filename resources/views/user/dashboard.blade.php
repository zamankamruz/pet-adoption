<?php
// File: dashboard.blade.php
// Path: /resources/views/user/dashboard.blade.php
?>

@extends('layouts.app')

@section('title', 'Dashboard - Furry Friends')

@section('content')
<div class="min-h-screen bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 py-6">
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-6">
            <!-- Sidebar Navigation -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-2xl shadow-sm border overflow-hidden sticky top-6">
                    <!-- Navigation Menu -->
                    <nav class="p-4">
                        <ul class="space-y-1">
                            <li>
                                <a href="{{ route('dashboard') }}" 
                                   class="flex items-center px-4 py-3 rounded-xl bg-gradient-to-r from-purple-500 to-purple-600 text-white">
                                    <div class="w-8 h-8 bg-white bg-opacity-20 rounded-full flex items-center justify-center mr-3 text-sm font-bold">
                                        📊
                                    </div>
                                    <span class="font-medium">Overview</span>
                                    @if($stats['pending_adoptions'] > 0)
                                        <span class="ml-auto bg-red-500 text-white text-xs font-bold px-2 py-1 rounded-full min-w-[20px] text-center">
                                            {{ $stats['pending_adoptions'] }}
                                        </span>
                                    @endif
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('user.profile') }}" 
                                   class="flex items-center px-4 py-3 rounded-xl text-gray-600 hover:bg-purple-50 hover:text-purple-600 transition-all duration-200">
                                    <div class="w-8 h-8 bg-purple-100 text-purple-600 rounded-full flex items-center justify-center mr-3 text-sm">
                                        👤
                                    </div>
                                    <span class="font-medium">Profile</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('user.adoptions') }}" 
                                   class="flex items-center px-4 py-3 rounded-xl text-gray-600 hover:bg-purple-50 hover:text-purple-600 transition-all duration-200">
                                    <div class="w-8 h-8 bg-purple-100 text-purple-600 rounded-full flex items-center justify-center mr-3 text-sm">
                                        🐾
                                    </div>
                                    <span class="font-medium">Adopt</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('rehoming.my-pets') }}" 
                                   class="flex items-center px-4 py-3 rounded-xl text-gray-600 hover:bg-purple-50 hover:text-purple-600 transition-all duration-200">
                                    <div class="w-8 h-8 bg-purple-100 text-purple-600 rounded-full flex items-center justify-center mr-3 text-sm">
                                        🏠
                                    </div>
                                    <span class="font-medium">Rehome</span>
                                    @if($stats['rehoming_requests'] > 0)
                                        <span class="ml-auto bg-red-500 text-white text-xs font-bold px-2 py-1 rounded-full min-w-[20px] text-center">
                                            {{ $stats['rehoming_requests'] }}
                                        </span>
                                    @endif
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('user.messages') }}" 
                                   class="flex items-center px-4 py-3 rounded-xl text-gray-600 hover:bg-purple-50 hover:text-purple-600 transition-all duration-200">
                                    <div class="w-8 h-8 bg-purple-100 text-purple-600 rounded-full flex items-center justify-center mr-3 text-sm">
                                        💬
                                    </div>
                                    <span class="font-medium">Message</span>
                                    @if($stats['messages'] > 0)
                                        <span class="ml-auto bg-red-500 text-white text-xs font-bold px-2 py-1 rounded-full min-w-[20px] text-center">
                                            {{ $stats['messages'] }}
                                        </span>
                                    @endif
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('user.settings') }}" 
                                   class="flex items-center px-4 py-3 rounded-xl text-gray-600 hover:bg-purple-50 hover:text-purple-600 transition-all duration-200">
                                    <div class="w-8 h-8 bg-purple-100 text-purple-600 rounded-full flex items-center justify-center mr-3 text-sm">
                                        ⚙️
                                    </div>
                                    <span class="font-medium">Setting</span>
                                </a>
                            </li>
                        </ul>
                    </nav>
                    
                    <!-- Charity Widget -->
                    <div class="p-4">
                        <div class="relative bg-white border-2 border-gray-100 rounded-2xl p-4 text-center">
                            <button class="absolute top-2 right-2 w-6 h-6 text-gray-400 hover:text-gray-600">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                </svg>
                            </button>
                            <div class="flex justify-center mb-3">
                                <div class="flex -space-x-1">
                                    <img src="/api/placeholder/32/32" alt="Pet 1" class="w-8 h-8 rounded-full border-2 border-white">
                                    <img src="/api/placeholder/32/32" alt="Pet 2" class="w-8 h-8 rounded-full border-2 border-white">
                                    <img src="/api/placeholder/32/32" alt="Pet 3" class="w-8 h-8 rounded-full border-2 border-white">
                                    <img src="/api/placeholder/32/32" alt="Pet 4" class="w-8 h-8 rounded-full border-2 border-white">
                                    <img src="/api/placeholder/32/32" alt="Pet 5" class="w-8 h-8 rounded-full border-2 border-white">
                                    <img src="/api/placeholder/32/32" alt="Pet 6" class="w-8 h-8 rounded-full border-2 border-white">
                                </div>
                            </div>
                            <p class="text-sm text-gray-700 font-medium mb-3">Join Furry Friends Charity</p>
                            <button class="flex items-center justify-center space-x-1 bg-purple-100 text-purple-600 px-4 py-2 rounded-lg text-sm font-medium w-full hover:bg-purple-200 transition-colors">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd"></path>
                                </svg>
                                <span>Donate</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Content -->
            <div class="lg:col-span-3">
                <div class="bg-white rounded-2xl shadow-sm border overflow-hidden">
                    <!-- Pet Profile Header -->
                    @if(auth()->user()->pets->count() > 0)
                        @php $userPet = auth()->user()->pets->first(); @endphp
                        <div class="p-6 border-b border-gray-100">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center space-x-4">
                                    <img src="{{ $userPet->main_image_url }}" alt="{{ $userPet->name }}" 
                                         class="w-16 h-16 rounded-full object-cover">
                                    <div>
                                        <div class="flex items-center space-x-4 mb-2">
                                            <div>
                                                <div class="text-sm text-gray-500">Pet ID</div>
                                                <div class="font-semibold">{{ str_pad($userPet->id, 8, '0', STR_PAD_LEFT) }}</div>
                                            </div>
                                            <div>
                                                <div class="text-sm text-gray-500">Breed</div>
                                                <div class="font-semibold">{{ $userPet->breed->name }}</div>
                                            </div>
                                            <div>
                                                <div class="text-sm text-gray-500">Gender</div>
                                                <div class="font-semibold">{{ ucfirst($userPet->gender) }}</div>
                                            </div>
                                            <div>
                                                <div class="text-sm text-gray-500">Age</div>
                                                <div class="font-semibold">{{ $userPet->age_display }}</div>
                                            </div>
                                        </div>
                                        <h1 class="text-2xl font-bold text-gray-900">{{ $userPet->name }}</h1>
                                    </div>
                                </div>
                                <button onclick="window.location.href='{{ route('user.profile') }}'" 
                                        class="flex items-center space-x-2 px-4 py-2 text-purple-600 border border-purple-600 rounded-lg hover:bg-purple-50 transition-colors">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                    </svg>
                                    <span>Edit Pet Profile</span>
                                </button>
                            </div>
                        </div>
                    @endif

                    <!-- Dashboard Content -->
                    <div class="p-6 space-y-8">
                        <!-- Welcome Message -->
                        <div class="bg-green-50 border border-green-200 rounded-xl p-4">
                            <div class="text-green-800">
                                <p class="font-semibold mb-1">Hi {{ auth()->user()->name }}!</p>
                                @if(auth()->user()->pets->count() > 0)
                                    <p class="text-sm">You have decided to Rehome your pet through the Furry Friends.</p>
                                    <p class="text-sm">We are glad and thankful to you for choosing us.</p>
                                @else
                                    <p class="text-sm">Welcome to Furry Friends! Start your journey to find a perfect companion.</p>
                                    <p class="text-sm">Browse available pets or list your pet for rehoming.</p>
                                @endif
                            </div>
                        </div>

                        <!-- Visitor Statistics -->
                        @if(auth()->user()->pets->count() > 0)
                        <div>
                            <div class="flex items-center justify-between mb-4">
                                <h2 class="text-lg font-semibold text-gray-900">Visitor Statistics({{ auth()->user()->pets->first()->name }})</h2>
                                <div class="text-sm text-gray-500">Last 30 days</div>
                            </div>
                            <div class="bg-white border border-gray-200 rounded-xl p-6">
                                <div class="relative h-64 mb-4">
                                    <canvas id="visitorChart" class="w-full h-full"></canvas>
                                </div>
                                <p class="text-center text-gray-500 text-sm">
                                    Upload more photos of your pet to increase the views
                                </p>
                            </div>
                        </div>
                        @endif

                        <!-- Adoption Requests -->
                        @if($recentAdoptions->count() > 0)
                        <div>
                            <h2 class="text-lg font-semibold text-gray-900 mb-4">
                                @if(auth()->user()->pets->count() > 0)
                                    All Requests to adopt {{ auth()->user()->pets->first()->name }}
                                @else
                                    Your Recent Adoption Requests
                                @endif
                            </h2>
                            <div class="bg-white border border-gray-200 rounded-xl overflow-hidden">
                                <!-- Table Header -->
                                <div class="px-6 py-3 bg-gray-50 border-b border-gray-200">
                                    <div class="grid grid-cols-3 gap-4 text-sm font-medium text-gray-700">
                                        <div>Full name</div>
                                        <div>Location</div>
                                        <div>Date of request</div>
                                    </div>
                                </div>
                                <!-- Table Rows -->
                                @foreach($recentAdoptions as $adoption)
                                <div class="px-6 py-4 border-b border-gray-100 hover:bg-gray-50 transition-colors duration-200">
                                    <div class="grid grid-cols-3 gap-4 items-center">
                                        <div class="flex items-center space-x-3">
                                            <img src="{{ $adoption->user->avatar_url }}" alt="{{ $adoption->user->name }}" 
                                                 class="w-10 h-10 rounded-full object-cover">
                                            <div class="font-medium text-gray-900">{{ $adoption->user->name }}</div>
                                        </div>
                                        <div class="text-gray-600">{{ $adoption->user->city ?? 'Not specified' }}</div>
                                        <div class="text-gray-500 text-sm">{{ $adoption->requested_at->format('M d') }}</div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        @endif

                        <!-- CTA Section -->
                        @if($stats['adoption_requests'] == 0 && $stats['pets_listed'] == 0)
                        <div class="text-center py-12 bg-gray-50 rounded-xl border border-gray-200">
                            <h3 class="text-xl font-semibold text-gray-900 mb-2">You have not yet registered to Adopt a pet.</h3>
                            <p class="text-gray-600 mb-6">Are you planning to Adopt a new pet?</p>
                            <a href="{{ route('pets.index') }}" 
                               class="inline-block bg-purple-600 hover:bg-purple-700 text-white font-medium py-3 px-6 rounded-lg transition-colors">
                                Get Start
                            </a>
                        </div>
                        @endif

                        <!-- Liked Pets Section -->
                        @if(isset($favoritePets) && $favoritePets->count() > 0)
                        <div>
                            <h2 class="text-lg font-semibold text-gray-900 mb-6">You liked these</h2>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                @foreach($favoritePets as $favorite)
                                    @php $pet = $favorite->pet; @endphp
                                    <div class="bg-white border border-gray-200 rounded-xl overflow-hidden hover:shadow-lg transition-shadow duration-300">
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
                                                    class="absolute top-3 right-3 w-8 h-8 bg-white bg-opacity-90 hover:bg-purple-500 text-purple-500 hover:text-white rounded-full flex items-center justify-center transition-all duration-300">
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

                                            <!-- More Info Button -->
                                            <a href="{{ route('pets.show', $pet) }}" 
                                               class="block w-full text-center py-2 border border-purple-600 text-purple-600 hover:bg-purple-600 hover:text-white rounded-lg transition-colors">
                                                More Info
                                            </a>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            
                            @if(auth()->user()->favorites->count() > 3)
                                <div class="text-center mt-8">
                                    <a href="{{ route('user.favorites') }}" 
                                       class="inline-block bg-purple-600 hover:bg-purple-700 text-white font-medium py-2 px-6 rounded-lg transition-colors">
                                        See more
                                    </a>
                                </div>
                            @endif
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
// Visitor Statistics Chart
@if(auth()->user()->pets->count() > 0)
const ctx = document.getElementById('visitorChart').getContext('2d');
const visitorChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
        datasets: [{
            label: 'Number of views',
            data: [0, 25, 50, 75, 100, 125, 150, 175, 200, 225, 240, 235],
            borderColor: '#8B5CF6',
            backgroundColor: 'transparent',
            borderWidth: 2,
            fill: false,
            tension: 0.4,
            pointBackgroundColor: '#8B5CF6',
            pointBorderColor: '#8B5CF6',
            pointBorderWidth: 2,
            pointRadius: 4,
            pointHoverRadius: 6
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: {
                display: false
            }
        },
        scales: {
            y: {
                beginAtZero: true,
                max: 250,
                ticks: {
                    stepSize: 50,
                    color: '#6b7280'
                },
                grid: {
                    color: '#f3f4f6'
                }
            },
            x: {
                grid: {
                    display: false
                },
                ticks: {
                    color: '#6b7280'
                }
            }
        }
    }
});
@endif

// Toggle favorite function
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
            if (!data.favorited) {
                // Remove the card
                const card = button.closest('.bg-white');
                card.style.transition = 'all 0.5s ease-out';
                card.style.transform = 'scale(0.8)';
                card.style.opacity = '0';
                setTimeout(() => {
                    card.remove();
                }, 500);
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
    @else
        window.location.href = '{{ route("login") }}';
    @endauth
}
</script>
@endsection