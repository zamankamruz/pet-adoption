<?php
// File: show.blade.php
// Path: /resources/views/user/adoptions/show.blade.php
?>

@extends('layouts.app')

@section('title', 'Adoption Request Details - Furry Friends')

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
                                   class="flex items-center px-4 py-3 rounded-xl bg-gradient-to-r from-purple-500 to-purple-600 text-white">
                                    <div class="w-8 h-8 bg-white bg-opacity-20 rounded-full flex items-center justify-center mr-3 text-sm font-bold">🐾</div>
                                    <span class="font-medium">Adopt</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('rehoming.my-pets') }}" 
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
                            <div class="flex justify-center mb-3">
                                <div class="flex -space-x-1">
                                    <img src="{{ asset('images/donate1.jpeg') }}" alt="Pet 1" class="w-8 h-8 rounded-full border-2 border-white">
                                    <img src="{{ asset('images/donate2.jpeg') }}" alt="Pet 2" class="w-8 h-8 rounded-full border-2 border-white">
                                    <img src="{{ asset('images/donate3.jpeg') }}" alt="Pet 3" class="w-8 h-8 rounded-full border-2 border-white">
                                    <img src="{{ asset('images/donate4.jpeg') }}" alt="Pet 4" class="w-8 h-8 rounded-full border-2 border-white">
                                    <img src="{{ asset('images/donate5.jpeg') }}" alt="Pet 5" class="w-8 h-8 rounded-full border-2 border-white">
                                    <img src="{{ asset('images/donate6.jpeg') }}" alt="Pet 6" class="w-8 h-8 rounded-full border-2 border-white">
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
                <!-- Breadcrumb -->
                <div class="mb-6">
                    <nav class="flex" aria-label="Breadcrumb">
                        <ol class="flex items-center space-x-4">
                            <li>
                                <a href="{{ route('user.adoptions') }}" class="text-gray-500 hover:text-gray-700">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M7.707 14.707a1 1 0 01-1.414 0L2.586 11H17a1 1 0 110 2H2.586l3.707 3.707a1 1 0 01-1.414 1.414l-5.5-5.5a1 1 0 010-1.414l5.5-5.5a1 1 0 011.414 1.414L2.586 9H17a1 1 0 110 2H7.707z" clip-rule="evenodd"></path>
                                    </svg>
                                </a>
                            </li>
                            <li>
                                <div class="flex items-center">
                                    <svg class="w-5 h-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                                    </svg>
                                    <a href="{{ route('user.adoptions') }}" class="ml-4 text-sm font-medium text-gray-500 hover:text-gray-700">
                                        My Adoptions
                                    </a>
                                </div>
                            </li>
                            <li>
                                <div class="flex items-center">
                                    <svg class="w-5 h-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                                    </svg>
                                    <span class="ml-4 text-sm font-medium text-gray-900">{{ $adoption->pet->name }}</span>
                                </div>
                            </li>
                        </ol>
                    </nav>
                </div>

                <div class="space-y-6">
                    <!-- Status Card -->
                    <div class="bg-white rounded-2xl shadow-sm border overflow-hidden">
                        <div class="p-6">
                            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
                                <div>
                                    <h1 class="text-2xl font-bold text-gray-900">Adoption Request for {{ $adoption->pet->name }}</h1>
                                    <p class="text-gray-600 mt-1">Reference: {{ $adoption->reference_number ?? 'N/A' }}</p>
                                </div>
                                <div class="mt-4 sm:mt-0">
                                    @php
                                        $statusColors = [
                                            'pending' => 'bg-yellow-100 text-yellow-800 border-yellow-200',
                                            'approved' => 'bg-green-100 text-green-800 border-green-200',
                                            'rejected' => 'bg-red-100 text-red-800 border-red-200',
                                            'completed' => 'bg-blue-100 text-blue-800 border-blue-200',
                                            'cancelled' => 'bg-gray-100 text-gray-800 border-gray-200'
                                        ];
                                        $statusIcons = [
                                            'pending' => '⏳',
                                            'approved' => '✅',
                                            'rejected' => '❌',
                                            'completed' => '🎉',
                                            'cancelled' => '⭕'
                                        ];
                                    @endphp
                                    <div class="flex items-center space-x-2">
                                        <span class="text-2xl">{{ $statusIcons[$adoption->status] ?? '📝' }}</span>
                                        <span class="px-4 py-2 text-sm font-medium rounded-xl border {{ $statusColors[$adoption->status] ?? 'bg-gray-100 text-gray-800 border-gray-200' }}">
                                            {{ ucfirst($adoption->status) }}
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <!-- Timeline -->
                            <div class="mt-6 pt-6 border-t border-gray-100">
                                <div class="flex items-center space-x-6 text-sm">
                                    <div class="flex items-center space-x-2">
                                        <div class="w-2 h-2 bg-purple-500 rounded-full"></div>
                                        <span class="text-gray-600">Requested:</span>
                                        <span class="font-medium">{{ $adoption->requested_at->format('M d, Y g:i A') }}</span>
                                    </div>
                                    
                                    @if($adoption->approved_at)
                                        <div class="flex items-center space-x-2">
                                            <div class="w-2 h-2 bg-green-500 rounded-full"></div>
                                            <span class="text-gray-600">Approved:</span>
                                            <span class="font-medium">{{ $adoption->approved_at->format('M d, Y g:i A') }}</span>
                                        </div>
                                    @endif
                                    
                                    @if($adoption->completed_at)
                                        <div class="flex items-center space-x-2">
                                            <div class="w-2 h-2 bg-blue-500 rounded-full"></div>
                                            <span class="text-gray-600">Completed:</span>
                                            <span class="font-medium">{{ $adoption->completed_at->format('M d, Y g:i A') }}</span>
                                        </div>
                                    @endif
                                    
                                    @if($adoption->rejected_at)
                                        <div class="flex items-center space-x-2">
                                            <div class="w-2 h-2 bg-red-500 rounded-full"></div>
                                            <span class="text-gray-600">Rejected:</span>
                                            <span class="font-medium">{{ $adoption->rejected_at->format('M d, Y g:i A') }}</span>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Messages/Notes Section -->
                    @if($adoption->status === 'rejected' && $adoption->rejection_reason)
                        <div class="bg-white rounded-2xl shadow-sm border overflow-hidden">
                            <div class="bg-red-50 px-6 py-4 border-b border-red-100">
                                <h2 class="text-lg font-semibold text-red-900 flex items-center">
                                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                    </svg>
                                    Rejection Reason
                                </h2>
                            </div>
                            <div class="p-6">
                                <p class="text-gray-700">{{ $adoption->rejection_reason }}</p>
                            </div>
                        </div>
                    @endif

                    @if($adoption->admin_notes)
                        <div class="bg-white rounded-2xl shadow-sm border overflow-hidden">
                            <div class="bg-blue-50 px-6 py-4 border-b border-blue-100">
                                <h2 class="text-lg font-semibold text-blue-900 flex items-center">
                                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M18 13V5a2 2 0 00-2-2H4a2 2 0 00-2 2v8a2 2 0 002 2h3l3 3 3-3h3a2 2 0 002-2zM5 7a1 1 0 011-1h8a1 1 0 110 2H6a1 1 0 01-1-1zm1 3a1 1 0 100 2h3a1 1 0 100-2H6z" clip-rule="evenodd"></path>
                                    </svg>
                                    Admin Notes
                                </h2>
                            </div>
                            <div class="p-6">
                                <p class="text-gray-700">{{ $adoption->admin_notes }}</p>
                            </div>
                        </div>
                    @endif

                    <!-- Pet Information -->
                    <div class="bg-white rounded-2xl shadow-sm border overflow-hidden">
                        <div class="px-6 py-4 border-b border-gray-100">
                            <h2 class="text-lg font-semibold text-gray-900">Pet Information</h2>
                        </div>
                        <div class="p-6">
                            <div class="flex flex-col lg:flex-row lg:space-x-6">
                                <!-- Pet Images -->
                                <div class="flex-shrink-0 mb-6 lg:mb-0">
                                    <img src="{{ $adoption->pet->main_image_url }}" alt="{{ $adoption->pet->name }}" 
                                         class="w-full lg:w-48 h-48 rounded-xl object-cover">
                                    @if($adoption->pet->images->count() > 0)
                                        <div class="flex space-x-2 mt-3 overflow-x-auto">
                                            @foreach($adoption->pet->images->take(3) as $image)
                                                <img src="{{ asset('storage/' . $image->image_path) }}" alt="{{ $adoption->pet->name }}" 
                                                     class="w-12 h-12 rounded-lg object-cover flex-shrink-0">
                                            @endforeach
                                        </div>
                                    @endif
                                </div>

                                <!-- Pet Details -->
                                <div class="flex-1">
                                    <h3 class="text-xl font-bold text-gray-900 mb-4">{{ $adoption->pet->name }}</h3>
                                    <div class="grid grid-cols-2 md:grid-cols-3 gap-4 mb-4">
                                        <div>
                                            <span class="text-sm text-gray-600">Breed</span>
                                            <div class="font-medium text-gray-900">{{ $adoption->pet->breed->name }}</div>
                                        </div>
                                        <div>
                                            <span class="text-sm text-gray-600">Age</span>
                                            <div class="font-medium text-gray-900">{{ $adoption->pet->age_display }}</div>
                                        </div>
                                        <div>
                                            <span class="text-sm text-gray-600">Gender</span>
                                            <div class="font-medium text-gray-900">{{ ucfirst($adoption->pet->gender) }}</div>
                                        </div>
                                        <div>
                                            <span class="text-sm text-gray-600">Size</span>
                                            <div class="font-medium text-gray-900">{{ ucfirst($adoption->pet->size) }}</div>
                                        </div>
                                        <div>
                                            <span class="text-sm text-gray-600">Color</span>
                                            <div class="font-medium text-gray-900">{{ $adoption->pet->color }}</div>
                                        </div>
                                        <div>
                                            <span class="text-sm text-gray-600">Location</span>
                                            <div class="font-medium text-gray-900">{{ $adoption->pet->location->city }}, {{ $adoption->pet->location->state }}</div>
                                        </div>
                                    </div>
                                    
                                    @if($adoption->pet->description)
                                        <div>
                                            <span class="text-sm text-gray-600">Description</span>
                                            <p class="text-gray-700 mt-1">{{ Str::limit($adoption->pet->description, 200) }}</p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                   <!-- Application Details -->
                    <div class="bg-white rounded-2xl shadow-sm border overflow-hidden">
                        <div class="px-6 py-4 border-b border-gray-100">
                            <h2 class="text-lg font-semibold text-gray-900">Your Application Details</h2>
                        </div>
                        <div class="p-6">
                            @if(!empty($adoption->application_data) && is_array($adoption->application_data))
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    @foreach($adoption->application_data as $key => $value)
                                        <div>
                                            <span class="text-sm font-medium text-gray-600">
                                                {{ ucwords(str_replace('_', ' ', $key)) }}
                                            </span>
                                            <div class="mt-1">
                                                @if(is_array($value))
                                                    @if(count($value) > 0)
                                                        <ul class="text-gray-900 list-disc list-inside">
                                                            @foreach($value as $item)
                                                                <li>{{ is_scalar($item) ? $item : json_encode($item) }}</li>
                                                            @endforeach
                                                        </ul>
                                                    @else
                                                        <span class="text-gray-500 italic">No items selected</span>
                                                    @endif
                                                @elseif(is_bool($value))
                                                    <span class="text-gray-900">{{ $value ? 'Yes' : 'No' }}</span>
                                                @elseif(is_null($value) || $value === '')
                                                    <span class="text-gray-500 italic">Not provided</span>
                                                @else
                                                    <span class="text-gray-900">{{ $value }}</span>
                                                @endif
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <p class="text-gray-600">No application data available.</p>
                            @endif
                        </div>
                    </div>


                    <!-- Actions -->
                    <div class="bg-white rounded-2xl shadow-sm border overflow-hidden">
                        <div class="p-6">
                            <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center space-y-4 sm:space-y-0">
                                <div>
                                    <h2 class="text-lg font-semibold text-gray-900">Actions</h2>
                                    <p class="text-gray-600 text-sm mt-1">Manage your adoption request</p>
                                </div>
                                <div class="flex flex-col sm:flex-row space-y-2 sm:space-y-0 sm:space-x-3">
                                    @if($adoption->status === 'pending')
                                        <button onclick="cancelAdoption({{ $adoption->id }})" 
                                                class="px-4 py-2 border border-red-300 hover:bg-red-50 text-red-600 font-medium rounded-lg transition-colors">
                                            Cancel Request
                                        </button>
                                    @endif


                                    <a href="{{ route('adoption.show', $adoption->pet) }}" 
                                       class="px-4 py-2 bg-purple-600 hover:bg-purple-700 text-white font-medium rounded-lg transition-colors text-center">
                                        View Pet Profile
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- What's Next Section -->
                    @if($adoption->status === 'pending')
                        <div class="bg-gradient-to-r from-blue-50 to-indigo-50 rounded-2xl border border-blue-200 p-6">
                            <div class="flex items-start space-x-4">
                                <div class="flex-shrink-0">
                                    <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center">
                                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                    </div>
                                </div>
                                <div class="flex-1">
                                    <h3 class="text-lg font-semibold text-blue-900">What's Next?</h3>
                                    <p class="text-blue-800 mt-1">Your adoption request is being reviewed. The pet owner or our team will contact you soon with next steps. This process typically takes 2-5 business days.</p>
                                    <div class="mt-4 text-sm text-blue-700">
                                        <p><strong>In the meantime:</strong></p>
                                        <ul class="list-disc list-inside mt-2 space-y-1">
                                            <li>Prepare your home for a new pet</li>
                                            <li>Research pet care tips in our guide section</li>
                                            <li>Gather any required documents</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @elseif($adoption->status === 'approved')
                        <div class="bg-gradient-to-r from-green-50 to-emerald-50 rounded-2xl border border-green-200 p-6">
                            <div class="flex items-start space-x-4">
                                <div class="flex-shrink-0">
                                    <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center">
                                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                    </div>
                                </div>
                                <div class="flex-1">
                                    <h3 class="text-lg font-semibold text-green-900">Congratulations!</h3>
                                    <p class="text-green-800 mt-1">Your adoption request has been approved! The pet owner will contact you to arrange the final steps and meet {{ $adoption->pet->name }}.</p>
                                </div>
                            </div>
                        </div>
                    @elseif($adoption->status === 'completed')
                        <div class="bg-gradient-to-r from-purple-50 to-pink-50 rounded-2xl border border-purple-200 p-6">
                            <div class="flex items-start space-x-4">
                                <div class="flex-shrink-0">
                                    <div class="w-12 h-12 bg-purple-100 rounded-full flex items-center justify-center">
                                        <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                                        </svg>
                                    </div>
                                </div>
                                <div class="flex-1">
                                    <h3 class="text-lg font-semibold text-purple-900">Welcome to the Family!</h3>
                                    <p class="text-purple-800 mt-1">{{ $adoption->pet->name }} is now part of your family! Thank you for choosing adoption and giving a loving home to a pet in need.</p>
                                    <div class="mt-4">
                                        <a href="{{ route('care-guide') }}" 
                                           class="inline-block px-4 py-2 bg-purple-600 hover:bg-purple-700 text-white text-sm font-medium rounded-lg transition-colors">
                                            Pet Care Guide
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function cancelAdoption(adoptionId) {
    if (confirm('Are you sure you want to cancel this adoption request? This action cannot be undone.')) {
        fetch(`/user/adoptions/${adoptionId}/cancel`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Content-Type': 'application/json',
            }
        })
        .then(response => {
            if (response.ok) {
                return response.json();
            }
            throw new Error('Network response was not ok');
        })
        .then(data => {
            if (data.success) {
                window.location.href = '{{ route("user.adoptions") }}';
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