<?php
// File: rehomed.blade.php
// Path: /resources/views/user/rehomed.blade.php
?>

@extends('layouts.app')

@section('title', 'My Rehomed Pets - Furry Friends')

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
                                <a href="{{ route('dashboard') }}" 
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
                                   class="flex items-center px-4 py-3 rounded-xl bg-gradient-to-r from-purple-500 to-purple-600 text-white">
                                    <div class="w-8 h-8 bg-white bg-opacity-20 rounded-full flex items-center justify-center mr-3 text-sm font-bold">🏠</div>
                                    <span class="font-medium">Rehome</span>
                                    <span class="ml-auto bg-white bg-opacity-30 text-white text-xs font-bold px-2 py-1 rounded-full min-w-[20px] text-center">
                                        {{ $rehomings->count() }}
                                    </span>
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
                    <!-- Main Dashboard Content -->
                    <div class="p-6 space-y-8">
                        <!-- Welcome Message -->
                        <div>
                            <h2 class="text-xl font-semibold text-gray-900 mb-2">Dear {{ auth()->user()->name }}</h2>
                            @if($activePet)
                                <p class="text-gray-600 mb-1">You have some requests to adopt {{ $activePet->name }}.</p>
                                <p class="text-gray-600">Please check out your requests and start text message with "Adopters".</p>
                            @else
                                <p class="text-gray-600">Welcome to your rehoming dashboard. You can manage your pet listings here.</p>
                            @endif
                        </div>

                        <!-- Active Pet Card -->
                        @if($activePet)
                        <div class="bg-gray-50 rounded-xl p-6 border border-gray-200">
                            <div class="flex items-center space-x-4">
                                <img src="{{ $activePet->main_image_url }}" alt="{{ $activePet->name }}" 
                                     class="w-20 h-20 rounded-full object-cover border-4 border-white shadow-sm">
                                <div class="flex-1">
                                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 text-sm mb-3">
                                        <div>
                                            <span class="text-gray-500">Pet ID</span>
                                            <div class="font-semibold text-gray-900">{{ str_pad($activePet->id, 8, '0', STR_PAD_LEFT) }}</div>
                                        </div>
                                        <div>
                                            <span class="text-gray-500">Breed</span>
                                            <div class="font-semibold text-gray-900">{{ $activePet->breed->name }}</div>
                                        </div>
                                        <div>
                                            <span class="text-gray-500">Gender</span>
                                            <div class="font-semibold text-gray-900">{{ ucfirst($activePet->gender) }}</div>
                                        </div>
                                        <div>
                                            <span class="text-gray-500">Age</span>
                                            <div class="font-semibold text-gray-900">{{ $activePet->age_display }}</div>
                                        </div>
                                    </div>
                                    <h3 class="text-2xl font-bold text-gray-900">{{ $activePet->name }}</h3>
                                </div>
                            </div>
                        </div>
                        @endif

                        <!-- Adoption Requests Table -->
                        @if($activePet && $adoptionRequests->count() > 0)
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">All Requests to adopt {{ $activePet->name }}</h3>
                            <div class="bg-white border border-gray-200 rounded-xl overflow-hidden">
                                <!-- Table Header -->
                                <div class="px-6 py-3 bg-gray-50 border-b border-gray-200">
                                    <div class="grid grid-cols-4 gap-4 text-sm font-medium text-gray-700">
                                        <div>Full name</div>
                                        <div>Location</div>
                                        <div>Date of Request</div>
                                        <div>Status</div>
                                    </div>
                                </div>
                                <!-- Table Rows -->
                                @foreach($adoptionRequests as $request)
                                <div class="px-6 py-4 border-b border-gray-100 hover:bg-gray-50 transition-colors duration-200">
                                    <div class="grid grid-cols-4 gap-4 items-center">
                                        <div class="flex items-center space-x-3">
                                            <img src="{{ $request->user->avatar_url }}" alt="{{ $request->user->name }}" 
                                                 class="w-10 h-10 rounded-full object-cover">
                                            <div>
                                                <div class="font-medium text-gray-900">{{ $request->user->name }}</div>
                                                <div class="text-sm text-gray-500">{{ $request->user->email }}</div>
                                            </div>
                                        </div>
                                        <div class="text-gray-600">{{ $request->user->city ?? 'Not specified' }}</div>
                                        <div class="text-gray-500 text-sm">{{ $request->requested_at->format('M d') }}</div>
                                        <div class="flex items-center space-x-2">
                                            <div class="flex flex-col items-center">
                                                <div class="w-12 h-12 bg-purple-100 rounded-full flex items-center justify-center mb-1">
                                                    <span class="text-sm font-semibold text-purple-600">{{ rand(70, 95) }}%</span>
                                                </div>
                                                <span class="text-xs text-gray-500">Match</span>
                                            </div>
                                            <button onclick="startMessage({{ $request->user->id }}, {{ $activePet->id }})" 
                                                    class="bg-purple-600 hover:bg-purple-700 text-white text-sm font-medium py-1 px-3 rounded-lg transition-colors">
                                                Start Message
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        @endif

                        <!-- My Rehoming Requests -->
                        @if($rehomings->count() > 0)
                        <div>
                            <div class="flex justify-between items-center mb-4">
                                <h3 class="text-lg font-semibold text-gray-900">My Rehoming Requests</h3>
                                <a href="{{ route('rehoming.start') }}" 
                                   class="bg-purple-600 hover:bg-purple-700 text-white text-sm font-medium py-2 px-4 rounded-lg transition-colors">
                                    Add New Pet
                                </a>
                            </div>
                            
                            <div class="space-y-4">
                                @foreach($rehomings as $rehoming)
                                <div class="border border-gray-200 rounded-xl p-6 hover:shadow-lg transition-shadow duration-300">
                                    <div class="flex justify-between items-start">
                                        <div>
                                            <h4 class="text-xl font-semibold text-gray-900 mb-2">{{ $rehoming->pet_name }}</h4>
                                            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 text-sm mb-4">
                                                <div>
                                                    <span class="text-gray-600">Species:</span>
                                                    <div class="font-medium text-gray-900">{{ ucfirst($rehoming->species) }}</div>
                                                </div>
                                                <div>
                                                    <span class="text-gray-600">Breed:</span>
                                                    <div class="font-medium text-gray-900">{{ $rehoming->breed }}</div>
                                                </div>
                                                <div>
                                                    <span class="text-gray-600">Age:</span>
                                                    <div class="font-medium text-gray-900">{{ $rehoming->age }}</div>
                                                </div>
                                                <div>
                                                    <span class="text-gray-600">Gender:</span>
                                                    <div class="font-medium text-gray-900">{{ ucfirst($rehoming->gender) }}</div>
                                                </div>
                                            </div>
                                            <p class="text-gray-600 text-sm">{{ Str::limit($rehoming->description, 100) }}</p>
                                        </div>
                                        <div class="flex flex-col items-end space-y-2">
                                            @php
                                                $statusColors = [
                                                    'draft' => 'bg-gray-100 text-gray-800',
                                                    'pending' => 'bg-yellow-100 text-yellow-800',
                                                    'approved' => 'bg-green-100 text-green-800',
                                                    'rejected' => 'bg-red-100 text-red-800',
                                                    'published' => 'bg-blue-100 text-blue-800'
                                                ];
                                            @endphp
                                            <span class="px-3 py-1 text-xs font-medium rounded-full {{ $statusColors[$rehoming->status] ?? 'bg-gray-100 text-gray-800' }}">
                                                {{ ucfirst($rehoming->status) }}
                                            </span>
                                            <div class="flex space-x-2">
                                                @if($rehoming->status === 'draft')
                                                    <a href="{{ route('rehoming.edit', $rehoming) }}" 
                                                       class="text-purple-600 hover:text-purple-700 text-sm font-medium">
                                                        Continue
                                                    </a>
                                                @else
                                                    <a href="{{ route('rehoming.show', $rehoming) }}" 
                                                       class="text-purple-600 hover:text-purple-700 text-sm font-medium">
                                                        View
                                                    </a>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        @endif

                        <!-- Empty State for No Rehoming Requests -->
                        @if($rehomings->count() === 0)
                        <div class="text-center py-12 bg-gray-50 rounded-xl border border-gray-200">
                            <svg class="w-16 h-16 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                            </svg>
                            <h3 class="text-xl font-semibold text-gray-900 mb-2">No pets listed for rehoming</h3>
                            <p class="text-gray-600 mb-6">Start by listing a pet that needs a new home.</p>
                            <a href="{{ route('rehoming.start') }}" 
                               class="inline-block bg-purple-600 hover:bg-purple-700 text-white font-medium py-3 px-6 rounded-lg transition-colors">
                                List Your Pet
                            </a>
                        </div>
                        @endif

                        <!-- Liked Pets Section -->
                        @if(isset($favoritePets) && $favoritePets->count() > 0)
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900 mb-6">You liked these</h3>
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
                                                    class="absolute top-3 right-3 w-8 h-8 bg-purple-500 text-white rounded-full flex items-center justify-center transition-all duration-300 hover:bg-purple-600">
                                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd"></path>
                                                </svg>
                                            </button>
                                        </div>

                                        <!-- Pet Info -->
                                        <div class="p-4">
                                            <h4 class="text-lg font-semibold text-gray-900 mb-2">{{ $pet->name }}</h4>
                                            <div class="flex items-center text-gray-500 text-sm mb-3">
                                                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"></path>
                                                </svg>
                                                {{ $pet->location->city }}, {{ $pet->location->state }}
                                            </div>
                                            
                                            <!-- Pet Details -->
                                            <div class="space-y-1 text-sm mb-4">
                                                <div class="flex justify-between">
                                                    <span class="text-gray-600">Gender:</span>
                                                    <span class="font-medium text-purple-600">{{ ucfirst($pet->gender) }}</span>
                                                </div>
                                                <div class="flex justify-between">
                                                    <span class="text-gray-600">Breed:</span>
                                                    <span class="font-medium text-purple-600">{{ $pet->breed->name }}</span>
                                                </div>
                                                <div class="flex justify-between">
                                                    <span class="text-gray-600">Age:</span>
                                                    <span class="font-medium text-purple-600">{{ $pet->age_display }}</span>
                                                </div>
                                                <div class="flex justify-between">
                                                    <span class="text-gray-600">Size:</span>
                                                    <span class="font-medium text-purple-600">{{ ucfirst($pet->size) }}</span>
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

<script>
function startMessage(userId, petId) {
    // Create a new message conversation
    const conversationData = {
        user_id: userId,
        pet_id: petId,
        subject: 'Adoption Interest',
        body: 'Hi! I am interested in adopting your pet. Could we discuss further?'
    };

    fetch('/user/messages/create', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            'Content-Type': 'application/json',
        },
        body: JSON.stringify(conversationData)
    })
    .then(response => response.json())
    .then(data => {
        if (data.redirect_url) {
            window.location.href = data.redirect_url;
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Failed to start conversation. Please try again.');
    });
}

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
}
</script>
@endsection