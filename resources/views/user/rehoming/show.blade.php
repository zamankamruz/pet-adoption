<?php
// File: show.blade.php
// Path: /resources/views/user/rehoming/show.blade.php
?>

@extends('layouts.app')

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
                                   class="flex items-center px-4 py-3 rounded-xl text-gray-600 hover:bg-purple-50 hover:text-purple-600 transition-all duration-200">
                                    <div class="w-8 h-8 bg-purple-100 text-purple-600 rounded-full flex items-center justify-center mr-3 text-sm">
                                        📊
                                    </div>
                                    <span class="font-medium">Overview</span>
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
                                   class="flex items-center px-4 py-3 rounded-xl bg-gradient-to-r from-purple-500 to-purple-600 text-white">
                                    <div class="w-8 h-8 bg-white bg-opacity-20 rounded-full flex items-center justify-center mr-3 text-sm font-bold">
                                        🏠
                                    </div>
                                    <span class="font-medium">Rehome</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('user.messages') }}" 
                                   class="flex items-center px-4 py-3 rounded-xl text-gray-600 hover:bg-purple-50 hover:text-purple-600 transition-all duration-200">
                                    <div class="w-8 h-8 bg-purple-100 text-purple-600 rounded-full flex items-center justify-center mr-3 text-sm">
                                        💬
                                    </div>
                                    <span class="font-medium">Message</span>
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
                <!-- Header -->
                <div class="bg-white shadow-sm rounded-lg mb-6">
                    <div class="px-6 py-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <nav class="text-sm text-gray-600 mb-2">
                                    <a href="{{ route('rehoming.my-pets') }}" class="hover:text-purple-600">My Pets</a>
                                    <span class="mx-2">></span>
                                    <span class="text-gray-900">{{ $rehoming->pet_name ?: 'Pet Details' }}</span>
                                </nav>
                                <h1 class="text-2xl font-bold text-gray-900">{{ $rehoming->pet_name ?: 'Rehoming Request' }}</h1>
                                <div class="flex items-center space-x-4 mt-2">
                                    <span class="px-3 py-1 rounded-full text-sm font-medium
                                        @if($rehoming->status === 'draft') bg-gray-100 text-gray-800
                                        @elseif($rehoming->status === 'pending') bg-yellow-100 text-yellow-800
                                        @elseif($rehoming->status === 'approved') bg-green-100 text-green-800
                                        @elseif($rehoming->status === 'rejected') bg-red-100 text-red-800
                                        @elseif($rehoming->status === 'published') bg-blue-100 text-blue-800
                                        @elseif($rehoming->status === 'completed') bg-purple-100 text-purple-800
                                        @endif">
                                        {{ ucfirst($rehoming->status) }}
                                    </span>
                                    <span class="text-sm text-gray-600">
                                        {{ $rehoming->step_completed }}/3 steps completed
                                    </span>
                                </div>
                            </div>
                            
                            <div class="flex items-center space-x-3">
                                @if(in_array($rehoming->status, ['draft', 'pending']))
                                    <a href="{{ route('rehoming.my-pets.edit', $rehoming) }}" 
                                       class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                                        <i class="fas fa-edit mr-2"></i> Edit
                                    </a>
                                @endif
                                
                                @if($rehoming->status === 'draft' && $rehoming->step_completed < 3)
                                    <a href="{{ route('rehoming.step' . ($rehoming->step_completed + 1)) }}" 
                                       class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors">
                                        <i class="fas fa-arrow-right mr-2"></i> Continue
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Main Content Grid -->
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    <!-- Main Info -->
                    <div class="lg:col-span-2 space-y-6">
                        <!-- Pet Images -->
                        @if(isset($rehoming->images) && count($rehoming->images) > 0)
                            <div class="bg-white rounded-lg shadow-sm overflow-hidden">
                                <div class="p-6 border-b border-gray-200">
                                    <h2 class="text-lg font-semibold text-gray-900">Pet Photos</h2>
                                </div>
                                <div class="p-6">
                                    <div class="grid grid-cols-2 gap-4">
                                        @foreach($rehoming->images as $image)
                                            <div class="aspect-square bg-gray-200 rounded-lg overflow-hidden">
                                                   <img src="{{ asset('storage/' . $image) }}" alt="Pet Image" class="w-32 h-32 object-cover rounded">
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @endif

                        <!-- Pet Details -->
                        <div class="bg-white rounded-lg shadow-sm">
                            <div class="p-6 border-b border-gray-200">
                                <h2 class="text-lg font-semibold text-gray-900">Pet Details</h2>
                            </div>
                            <div class="p-6">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    @if($rehoming->pet_name)
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700">Name</label>
                                            <p class="mt-1 text-gray-900">{{ $rehoming->pet_name }}</p>
                                        </div>
                                    @endif
                                    
                                    @if($rehoming->species)
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700">Species</label>
                                            <p class="mt-1 text-gray-900">{{ ucfirst($rehoming->species) }}</p>
                                        </div>
                                    @endif
                                    
                                    @if($rehoming->breed)
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700">Breed</label>
                                            <p class="mt-1 text-gray-900">{{ $rehoming->breed }}</p>
                                        </div>
                                    @endif
                                    
                                    @if($rehoming->age !== null)
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700">Age</label>
                                            <p class="mt-1 text-gray-900">{{ $rehoming->age }}</p>
                                        </div>
                                    @endif
                                    
                                    @if($rehoming->gender)
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700">Gender</label>
                                            <p class="mt-1 text-gray-900">{{ ucfirst($rehoming->gender) }}</p>
                                        </div>
                                    @endif
                                    
                                    @if($rehoming->size)
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700">Size</label>
                                            <p class="mt-1 text-gray-900">{{ ucfirst(str_replace('_', ' ', $rehoming->size)) }}</p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- Pet Story -->
                        @if($rehoming->description)
                            <div class="bg-white rounded-lg shadow-sm">
                                <div class="p-6 border-b border-gray-200">
                                    <h2 class="text-lg font-semibold text-gray-900">Pet's Story</h2>
                                </div>
                                <div class="p-6">
                                    <p class="text-gray-700 leading-relaxed">{{ $rehoming->description }}</p>
                                </div>
                            </div>
                        @endif

                        <!-- Characteristics -->
                        <div class="bg-white rounded-lg shadow-sm">
                            <div class="p-6 border-b border-gray-200">
                                <h2 class="text-lg font-semibold text-gray-900">Characteristics</h2>
                            </div>
                            <div class="p-6">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    @if(isset($rehoming->good_with_kids))
                                        <div class="flex justify-between">
                                            <span class="text-gray-700">Good with kids:</span>
                                            <span class="font-medium">{{ $rehoming->good_with_kids ? 'Yes' : 'No' }}</span>
                                        </div>
                                    @endif
                                    
                                    @if(isset($rehoming->good_with_pets))
                                        <div class="flex justify-between">
                                            <span class="text-gray-700">Good with pets:</span>
                                            <span class="font-medium">{{ $rehoming->good_with_pets ? 'Yes' : 'No' }}</span>
                                        </div>
                                    @endif
                                    
                                    @if(isset($rehoming->house_trained))
                                        <div class="flex justify-between">
                                            <span class="text-gray-700">House trained:</span>
                                            <span class="font-medium">{{ $rehoming->house_trained ? 'Yes' : 'No' }}</span>
                                        </div>
                                    @endif
                                    
                                    @if(isset($rehoming->spayed_neutered))
                                        <div class="flex justify-between">
                                            <span class="text-gray-700">Spayed/Neutered:</span>
                                            <span class="font-medium">{{ $rehoming->spayed_neutered ? 'Yes' : 'No' }}</span>
                                        </div>
                                    @endif
                                    
                                    @if(isset($rehoming->vaccination_status))
                                        <div class="flex justify-between">
                                            <span class="text-gray-700">Vaccination status:</span>
                                            <span class="font-medium">{{ ucfirst(str_replace('_', ' ', $rehoming->vaccination_status)) }}</span>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- Reason for Rehoming -->
                        @if($rehoming->reason_for_rehoming)
                            <div class="bg-white rounded-lg shadow-sm">
                                <div class="p-6 border-b border-gray-200">
                                    <h2 class="text-lg font-semibold text-gray-900">Reason for Rehoming</h2>
                                </div>
                                <div class="p-6">
                                    <p class="text-gray-700 leading-relaxed">{{ $rehoming->reason_for_rehoming }}</p>
                                </div>
                            </div>
                        @endif

                        <!-- Special Needs -->
                        @if($rehoming->special_needs)
                            <div class="bg-white rounded-lg shadow-sm">
                                <div class="p-6 border-b border-gray-200">
                                    <h2 class="text-lg font-semibold text-gray-900">Special Needs</h2>
                                </div>
                                <div class="p-6">
                                    <p class="text-gray-700 leading-relaxed">{{ $rehoming->special_needs }}</p>
                                </div>
                            </div>
                        @endif
                    </div>

                    <!-- Sidebar -->
                    <div class="space-y-6">
                        <!-- Progress -->
                        <div class="bg-white rounded-lg shadow-sm">
                            <div class="p-6 border-b border-gray-200">
                                <h2 class="text-lg font-semibold text-gray-900">Progress</h2>
                            </div>
                            <div class="p-6">
                                <div class="space-y-3">
                                    @for($i = 1; $i <= 3; $i++)
                                        <div class="flex items-center">
                                            <div class="w-6 h-6 rounded-full flex items-center justify-center text-xs
                                                {{ $i <= $rehoming->step_completed ? 'bg-green-500 text-white' : 'bg-gray-200 text-gray-600' }}">
                                                @if($i <= $rehoming->step_completed)
                                                    <i class="fas fa-check"></i>
                                                @else
                                                    {{ $i }}
                                                @endif
                                            </div>
                                            <span class="ml-3 text-sm text-gray-700">
                                                @switch($i)
                                                    @case(1) Basic Information @break
                                                    @case(2) Pet Details & Health @break
                                                    @case(3) Contact Preferences @break
                                                @endswitch
                                            </span>
                                        </div>
                                    @endfor
                                </div>
                            </div>
                        </div>

                        <!-- Submission Info -->
                        <div class="bg-white rounded-lg shadow-sm">
                            <div class="p-6 border-b border-gray-200">
                                <h2 class="text-lg font-semibold text-gray-900">Submission Info</h2>
                            </div>
                            <div class="p-6 space-y-3">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Created</label>
                                    <p class="mt-1 text-gray-900">{{ $rehoming->created_at->format('M j, Y \a\t g:i A') }}</p>
                                </div>
                                
                                @if($rehoming->submitted_at)
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Submitted</label>
                                        <p class="mt-1 text-gray-900">{{ $rehoming->submitted_at->format('M j, Y \a\t g:i A') }}</p>
                                    </div>
                                @endif
                                
                                @if($rehoming->approved_at)
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Approved</label>
                                        <p class="mt-1 text-gray-900">{{ $rehoming->approved_at->format('M j, Y \a\t g:i A') }}</p>
                                    </div>
                                @endif
                                
                                @if($rehoming->published_at)
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Published</label>
                                        <p class="mt-1 text-gray-900">{{ $rehoming->published_at->format('M j, Y \a\t g:i A') }}</p>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- Admin Notes -->
                        @if($rehoming->admin_notes)
                            <div class="bg-white rounded-lg shadow-sm">
                                <div class="p-6 border-b border-gray-200">
                                    <h2 class="text-lg font-semibold text-gray-900">Admin Notes</h2>
                                </div>
                                <div class="p-6">
                                    <p class="text-gray-700">{{ $rehoming->admin_notes }}</p>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection