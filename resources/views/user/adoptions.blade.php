<?php
// File: adoptions.blade.php
// Path: /resources/views/user/adoptions.blade.php
?>

@extends('layouts.app')

@section('title', 'My Adoptions - Furry Friends')

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
                                <a href="{{ route('pets.index') }}" 
                                   class="flex items-center px-4 py-3 rounded-xl bg-gradient-to-r from-purple-500 to-purple-600 text-white">
                                    <div class="w-8 h-8 bg-white bg-opacity-20 rounded-full flex items-center justify-center mr-3 text-sm font-bold">🐾</div>
                                    <span class="font-medium">Adopt</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('rehoming.index') }}" 
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
                    <!-- Header -->
                    <div class="p-6 border-b border-gray-100">
                        <h1 class="text-2xl font-bold text-gray-900">My Adoption Requests</h1>
                        <p class="text-gray-600 mt-1">Track your adoption applications and their status</p>
                    </div>

                    <!-- Adoptions Content -->
                    <div class="p-6">
                        @if($adoptions->count() > 0)
                            <div class="space-y-6">
                                @foreach($adoptions as $adoption)
                                    <div class="border border-gray-200 rounded-xl p-6 hover:shadow-lg transition-shadow duration-300">
                                        <div class="flex flex-col lg:flex-row lg:items-center space-y-4 lg:space-y-0 lg:space-x-6">
                                            <!-- Pet Image -->
                                            <div class="flex-shrink-0">
                                                <img src="{{ $adoption->pet->main_image_url }}" alt="{{ $adoption->pet->name }}" 
                                                     class="w-24 h-24 rounded-xl object-cover">
                                            </div>

                                            <!-- Pet Info -->
                                            <div class="flex-1">
                                                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-3">
                                                    <h3 class="text-xl font-semibold text-gray-900">{{ $adoption->pet->name }}</h3>
                                                    <div class="flex items-center space-x-2 mt-2 sm:mt-0">
                                                        @php
                                                            $statusColors = [
                                                                'pending' => 'bg-yellow-100 text-yellow-800',
                                                                'approved' => 'bg-green-100 text-green-800',
                                                                'rejected' => 'bg-red-100 text-red-800',
                                                                'completed' => 'bg-blue-100 text-blue-800',
                                                                'cancelled' => 'bg-gray-100 text-gray-800'
                                                            ];
                                                        @endphp
                                                        <span class="px-3 py-1 text-xs font-medium rounded-full {{ $statusColors[$adoption->status] ?? 'bg-gray-100 text-gray-800' }}">
                                                            {{ ucfirst($adoption->status) }}
                                                        </span>
                                                    </div>
                                                </div>

                                                <div class="grid grid-cols-2 md:grid-cols-4 gap-4 text-sm mb-4">
                                                    <div>
                                                        <span class="text-gray-600">Breed:</span>
                                                        <div class="font-medium text-gray-900">{{ $adoption->pet->breed->name }}</div>
                                                    </div>
                                                    <div>
                                                        <span class="text-gray-600">Age:</span>
                                                        <div class="font-medium text-gray-900">{{ $adoption->pet->age_display }}</div>
                                                    </div>
                                                    <div>
                                                        <span class="text-gray-600">Location:</span>
                                                        <div class="font-medium text-gray-900">{{ $adoption->pet->location->city }}</div>
                                                    </div>
                                                    <div>
                                                        <span class="text-gray-600">Applied:</span>
                                                        <div class="font-medium text-gray-900">{{ $adoption->requested_at->format('M d, Y') }}</div>
                                                    </div>
                                                </div>

                                                @if($adoption->reference_number)
                                                    <div class="bg-gray-50 rounded-lg p-3 mb-4">
                                                        <span class="text-sm text-gray-600">Reference Number: </span>
                                                        <span class="font-mono font-medium text-gray-900">{{ $adoption->reference_number }}</span>
                                                    </div>
                                                @endif

                                                @if($adoption->status === 'rejected' && $adoption->rejection_reason)
                                                    <div class="bg-red-50 border border-red-200 rounded-lg p-3 mb-4">
                                                        <div class="text-sm text-red-800">
                                                            <strong>Rejection Reason:</strong> {{ $adoption->rejection_reason }}
                                                        </div>
                                                    </div>
                                                @endif

                                                @if($adoption->admin_notes)
                                                    <div class="bg-blue-50 border border-blue-200 rounded-lg p-3 mb-4">
                                                        <div class="text-sm text-blue-800">
                                                            <strong>Notes:</strong> {{ $adoption->admin_notes }}
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>

                                            <!-- Actions -->
                                            <div class="flex flex-col space-y-2 lg:flex-shrink-0">
                                                <a href="{{ route('user.adoptions.show', $adoption) }}" 
                                                   class="px-4 py-2 bg-purple-600 hover:bg-purple-700 text-white text-sm font-medium rounded-lg transition-colors text-center">
                                                    View Details
                                                </a>
                                                
                                                @if($adoption->status === 'pending')
                                                    <button onclick="cancelAdoption({{ $adoption->id }})" 
                                                            class="px-4 py-2 border border-red-300 hover:bg-red-50 text-red-600 text-sm font-medium rounded-lg transition-colors">
                                                        Cancel Request
                                                    </button>
                                                @endif

                                                <a href="{{ route('pets.show', $adoption->pet) }}" 
                                                   class="px-4 py-2 border border-gray-300 hover:bg-gray-50 text-gray-700 text-sm font-medium rounded-lg transition-colors text-center">
                                                    View Pet
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <!-- Pagination -->
                            @if($adoptions->hasPages())
                                <div class="mt-8 flex justify-center">
                                    {{ $adoptions->links() }}
                                </div>
                            @endif
                        @else
                            <!-- Empty State -->
                            <div class="text-center py-12">
                                <svg class="w-16 h-16 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                                </svg>
                                <h3 class="text-xl font-semibold text-gray-900 mb-2">No adoption requests yet</h3>
                                <p class="text-gray-600 mb-6">Start browsing pets and submit adoption applications to see them here.</p>
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
function cancelAdoption(adoptionId) {
    if (confirm('Are you sure you want to cancel this adoption request?')) {
        fetch(`/user/adoptions/${adoptionId}/cancel`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Content-Type': 'application/json',
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload();
            } else {
                alert('Failed to cancel adoption request. Please try again.');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An error occurred. Please try again.');
        });
    }
}
</script>
@endsection