<?php
// File: show.blade.php (continuation from previous file)
// Path: /resources/views/admin/pets/show.blade.php
?>

@extends('layouts.app')

@section('title', 'Pet Details - ' . $pet->name)

@section('content')
<div class="min-h-screen bg-gray-50">
    <!-- Header -->
    <div class="bg-white shadow">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">{{ $pet->name }}</h1>
                    <p class="mt-1 text-sm text-gray-600">Pet ID: {{ str_pad($pet->id, 7, '0', STR_PAD_LEFT) }} • {{ $pet->breed->name }} • {{ $pet->location->city }}, {{ $pet->location->state }}</p>
                </div>
                <div class="flex space-x-3">
                    @if($pet->status === 'pending')
                        <form method="POST" action="{{ route('admin.pets.approve', $pet) }}" class="inline">
                            @csrf
                            <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-green-600 hover:bg-green-700">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                                Approve
                            </button>
                        </form>
                        <button onclick="openRejectModal()" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-red-600 hover:bg-red-700">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                            Reject
                        </button>
                    @endif
                    
                    <form method="POST" action="{{ route('admin.pets.toggle-feature', $pet) }}" class="inline">
                        @csrf
                        <button type="submit" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium {{ $pet->is_featured ? 'text-yellow-700 bg-yellow-50' : 'text-gray-700 bg-white' }} hover:bg-gray-50">
                            <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                            </svg>
                            {{ $pet->is_featured ? 'Unfeature' : 'Feature' }}
                        </button>
                    </form>

                    <a href="{{ route('admin.pets.edit', $pet) }}" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                        </svg>
                        Edit Pet
                    </a>

                    <a href="{{ route('pets.show', $pet) }}" target="_blank" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                        </svg>
                        View Public
                    </a>

                    <a href="{{ route('admin.pets.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                        </svg>
                        Back to Pets
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        <!-- Status Badges -->
        <div class="flex items-center space-x-3 mb-6">
            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium
                {{ $pet->status === 'available' ? 'bg-green-100 text-green-800' : 
                   ($pet->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : 
                   ($pet->status === 'adopted' ? 'bg-blue-100 text-blue-800' : 
                   ($pet->status === 'on_hold' ? 'bg-purple-100 text-purple-800' : 'bg-gray-100 text-gray-800'))) }}">
                {{ ucfirst(str_replace('_', ' ', $pet->status)) }}
            </span>
            
            @if($pet->is_featured)
                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-yellow-100 text-yellow-800">
                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                    </svg>
                    Featured
                </span>
            @endif
            
            @if($pet->is_urgent)
                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-red-100 text-red-800">
                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"/>
                    </svg>
                    Urgent
                </span>
            @endif
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Main Content -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Pet Images -->
                <div class="bg-white shadow rounded-lg overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h3 class="text-lg font-medium text-gray-900">Photos</h3>
                    </div>
                    <div class="p-6">
                        @if($pet->main_image || $pet->images->count() > 0)
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                                @if($pet->main_image)
                                    <div class="relative">
                                        <img src="{{ $pet->main_image_url }}" alt="{{ $pet->name }}" class="w-full h-48 object-cover rounded-lg">
                                        <span class="absolute top-2 left-2 bg-blue-600 text-white text-xs px-2 py-1 rounded">Main</span>
                                    </div>
                                @endif
                                @foreach($pet->images as $image)
                                    <div class="relative">
                                        <img src="{{ $image->image_url }}" alt="{{ $pet->name }}" class="w-full h-48 object-cover rounded-lg">
                                        @if($image->is_primary)
                                            <span class="absolute top-2 left-2 bg-green-600 text-white text-xs px-2 py-1 rounded">Primary</span>
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="text-center py-8">
                                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                <p class="mt-2 text-sm text-gray-500">No photos uploaded</p>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Pet Description -->
                <div class="bg-white shadow rounded-lg">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h3 class="text-lg font-medium text-gray-900">Description</h3>
                    </div>
                    <div class="px-6 py-4">
                        <p class="text-gray-700 leading-relaxed">{{ $pet->description }}</p>
                        
                        @if($pet->personality)
                            <div class="mt-4">
                                <h4 class="text-sm font-medium text-gray-900 mb-2">Personality</h4>
                                <p class="text-gray-700">{{ $pet->personality }}</p>
                            </div>
                        @endif
                        
                        @if($pet->special_needs)
                            <div class="mt-4">
                                <h4 class="text-sm font-medium text-gray-900 mb-2">Special Needs</h4>
                                <p class="text-gray-700">{{ $pet->special_needs }}</p>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Behavioral Traits -->
                <div class="bg-white shadow rounded-lg">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h3 class="text-lg font-medium text-gray-900">Behavioral Traits</h3>
                    </div>
                    <div class="px-6 py-4">
                        <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                            <div class="flex items-center {{ $pet->good_with_kids ? 'text-green-600' : 'text-red-600' }}">
                                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24">
                                    @if($pet->good_with_kids)
                                        <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    @else
                                        <path d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    @endif
                                </svg>
                                <span class="text-sm">Good with kids</span>
                            </div>
                            
                            <div class="flex items-center {{ $pet->good_with_pets ? 'text-green-600' : 'text-red-600' }}">
                                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24">
                                    @if($pet->good_with_pets)
                                        <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    @else
                                        <path d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    @endif
                                </svg>
                                <span class="text-sm">Good with pets</span>
                            </div>
                            
                            <div class="flex items-center {{ $pet->good_with_strangers ? 'text-green-600' : 'text-red-600' }}">
                                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24">
                                    @if($pet->good_with_strangers)
                                        <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    @else
                                        <path d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    @endif
                                </svg>
                                <span class="text-sm">Good with strangers</span>
                            </div>
                            
                            <div class="flex items-center {{ $pet->house_trained ? 'text-green-600' : 'text-red-600' }}">
                                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24">
                                    @if($pet->house_trained)
                                        <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    @else
                                        <path d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    @endif
                                </svg>
                                <span class="text-sm">House trained</span>
                            </div>
                            
                            <div class="flex items-center {{ $pet->spayed_neutered ? 'text-green-600' : 'text-red-600' }}">
                                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24">
                                    @if($pet->spayed_neutered)
                                        <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    @else
                                        <path d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    @endif
                                </svg>
                                <span class="text-sm">Spayed/Neutered</span>
                            </div>
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                            <div>
                                <span class="text-sm font-medium text-gray-700">Energy Level:</span>
                                <span class="ml-2 px-2 py-1 text-xs rounded-full
                                    {{ $pet->energy_level === 'high' ? 'bg-red-100 text-red-800' : 
                                       ($pet->energy_level === 'moderate' ? 'bg-yellow-100 text-yellow-800' : 'bg-green-100 text-green-800') }}">
                                    {{ ucfirst($pet->energy_level) }}
                                </span>
                            </div>
                            
                            <div>
                                <span class="text-sm font-medium text-gray-700">Training Level:</span>
                                <span class="ml-2 px-2 py-1 text-xs rounded-full
                                    {{ $pet->training_level === 'advanced' ? 'bg-green-100 text-green-800' : 
                                       ($pet->training_level === 'intermediate' ? 'bg-blue-100 text-blue-800' : 
                                       ($pet->training_level === 'basic' ? 'bg-yellow-100 text-yellow-800' : 'bg-gray-100 text-gray-800')) }}">
                                    {{ ucfirst($pet->training_level) }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Vaccination Records -->
                @if($pet->vaccinations->count() > 0)
                    <div class="bg-white shadow rounded-lg">
                        <div class="px-6 py-4 border-b border-gray-200">
                            <h3 class="text-lg font-medium text-gray-900">Vaccination Records</h3>
                        </div>
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Vaccine</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date Given</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Next Due</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Veterinarian</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach($pet->vaccinations as $vaccination)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $vaccination->vaccine_name }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $vaccination->vaccination_date->format('M d, Y') }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                {{ $vaccination->next_due_date ? $vaccination->next_due_date->format('M d, Y') : 'N/A' }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $vaccination->veterinarian ?? 'N/A' }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                @endif

                <!-- Adoption Requests -->
                @if($pet->adoptionRequests->count() > 0)
                    <div class="bg-white shadow rounded-lg">
                        <div class="px-6 py-4 border-b border-gray-200">
                            <h3 class="text-lg font-medium text-gray-900">Adoption Requests ({{ $pet->adoptionRequests->count() }})</h3>
                        </div>
                        <div class="divide-y divide-gray-200">
                            @foreach($pet->adoptionRequests as $adoption)
                                <div class="px-6 py-4">
                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center space-x-3">
                                            <div class="flex-shrink-0">
                                                <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center">
                                                    <span class="text-blue-600 font-semibold text-sm">{{ substr($adoption->user->name, 0, 2) }}</span>
                                                </div>
                                            </div>
                                            <div>
                                                <p class="text-sm font-medium text-gray-900">{{ $adoption->user->name }}</p>
                                                <p class="text-sm text-gray-500">{{ $adoption->user->email }}</p>
                                                <p class="text-xs text-gray-400">Requested {{ $adoption->requested_at->diffForHumans() }}</p>
                                            </div>
                                        </div>
                                        <div class="flex items-center space-x-3">
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                                {{ $adoption->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : 
                                                   ($adoption->status === 'approved' ? 'bg-green-100 text-green-800' : 
                                                   ($adoption->status === 'completed' ? 'bg-blue-100 text-blue-800' : 'bg-red-100 text-red-800')) }}">
                                                {{ ucfirst($adoption->status) }}
                                            </span>
                                            <a href="{{ route('admin.adoptions.show', $adoption) }}" class="text-blue-600 hover:text-blue-900 text-sm font-medium">
                                                View Details
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>

            <!-- Sidebar -->
            <div class="space-y-6">
                <!-- Quick Stats -->
                <div class="bg-white shadow rounded-lg">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h3 class="text-lg font-medium text-gray-900">Quick Stats</h3>
                    </div>
                    <div class="px-6 py-4">
                        <dl class="space-y-3">
                            <div class="flex justify-between text-sm">
                                <dt class="text-gray-500">Views:</dt>
                                <dd class="text-gray-900 font-medium">{{ number_format($pet->views_count) }}</dd>
                            </div>
                            <div class="flex justify-between text-sm">
                                <dt class="text-gray-500">Adoption Requests:</dt>
                                <dd class="text-gray-900 font-medium">{{ $pet->adoptionRequests->count() }}</dd>
                            </div>
                            <div class="flex justify-between text-sm">
                                <dt class="text-gray-500">Favorites:</dt>
                                <dd class="text-gray-900 font-medium">{{ $pet->favorites->count() }}</dd>
                            </div>
                            <div class="flex justify-between text-sm">
                                <dt class="text-gray-500">Listed:</dt>
                                <dd class="text-gray-900 font-medium">{{ $pet->created_at->format('M d, Y') }}</dd>
                            </div>
                            @if($pet->last_viewed_at)
                                <div class="flex justify-between text-sm">
                                    <dt class="text-gray-500">Last Viewed:</dt>
                                    <dd class="text-gray-900 font-medium">{{ $pet->last_viewed_at->diffForHumans() }}</dd>
                                </div>
                            @endif
                        </dl>
                    </div>
                </div>

                <!-- Pet Details -->
                <div class="bg-white shadow rounded-lg">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h3 class="text-lg font-medium text-gray-900">Pet Details</h3>
                    </div>
                    <div class="px-6 py-4">
                        <dl class="space-y-3">
                            <div class="flex justify-between text-sm">
                                <dt class="text-gray-500">Species:</dt>
                                <dd class="text-gray-900 font-medium">{{ ucfirst($pet->species) }}</dd>
                            </div>
                            <div class="flex justify-between text-sm">
                                <dt class="text-gray-500">Breed:</dt>
                                <dd class="text-gray-900 font-medium">{{ $pet->breed->name }}</dd>
                            </div>
                            <div class="flex justify-between text-sm">
                                <dt class="text-gray-500">Age:</dt>
                                <dd class="text-gray-900 font-medium">{{ $pet->age_display }}</dd>
                            </div>
                            <div class="flex justify-between text-sm">
                                <dt class="text-gray-500">Gender:</dt>
                                <dd class="text-gray-900 font-medium">{{ ucfirst($pet->gender) }}</dd>
                            </div>
                            <div class="flex justify-between text-sm">
                                <dt class="text-gray-500">Size:</dt>
                                <dd class="text-gray-900 font-medium">{{ ucfirst(str_replace('_', ' ', $pet->size)) }}</dd>
                            </div>
                            <div class="flex justify-between text-sm">
                                <dt class="text-gray-500">Color:</dt>
                                <dd class="text-gray-900 font-medium">{{ $pet->color }}</dd>
                            </div>
                            @if($pet->weight)
                                <div class="flex justify-between text-sm">
                                    <dt class="text-gray-500">Weight:</dt>
                                    <dd class="text-gray-900 font-medium">{{ $pet->weight }} lbs</dd>
                                </div>
                            @endif
                            <div class="flex justify-between text-sm">
                                <dt class="text-gray-500">Adoption Fee:</dt>
                                <dd class="text-gray-900 font-medium">${{ number_format($pet->adoption_fee, 2) }}</dd>
                            </div>
                        </dl>
                    </div>
                </div>

                <!-- Health Information -->
                <div class="bg-white shadow rounded-lg">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h3 class="text-lg font-medium text-gray-900">Health Information</h3>
                    </div>
                    <div class="px-6 py-4">
                        <dl class="space-y-3">
                            <div class="flex justify-between text-sm">
                                <dt class="text-gray-500">Health Status:</dt>
                                <dd class="text-gray-900 font-medium">{{ $pet->health_status }}</dd>
                            </div>
                            <div class="flex justify-between text-sm">
                                <dt class="text-gray-500">Vaccination Status:</dt>
                                <dd class="text-gray-900 font-medium">{{ ucfirst(str_replace('_', ' ', $pet->vaccination_status)) }}</dd>
                            </div>
                            @if($pet->microchip_id)
                                <div class="flex justify-between text-sm">
                                    <dt class="text-gray-500">Microchip ID:</dt>
                                    <dd class="text-gray-900 font-medium">{{ $pet->microchip_id }}</dd>
                                </div>
                            @endif
                        </dl>
                    </div>
                </div>

                <!-- Owner Information -->
                @if($pet->owner)
                    <div class="bg-white shadow rounded-lg">
                        <div class="px-6 py-4 border-b border-gray-200">
                            <h3 class="text-lg font-medium text-gray-900">Owner Information</h3>
                        </div>
                        <div class="px-6 py-4">
                            <div class="flex items-center space-x-3">
                                <div class="flex-shrink-0">
                                    <img class="h-10 w-10 rounded-full" src="{{ $pet->owner->avatar_url }}" alt="{{ $pet->owner->name }}">
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-medium text-gray-900">{{ $pet->owner->name }}</p>
                                    <p class="text-sm text-gray-500">{{ $pet->owner->email }}</p>
                                    @if($pet->owner->phone)
                                        <p class="text-sm text-gray-500">{{ $pet->owner->phone }}</p>
                                    @endif
                                </div>
                            </div>
                            <div class="mt-3">
                                <a href="{{ route('admin.users.show', $pet->owner) }}" class="text-blue-600 hover:text-blue-900 text-sm font-medium">
                                    View User Profile
                                </a>
                            </div>
                        </div>
                    </div>
                @endif

                <!-- Quick Actions -->
                <div class="bg-white shadow rounded-lg">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h3 class="text-lg font-medium text-gray-900">Quick Actions</h3>
                    </div>
                    <div class="px-6 py-4 space-y-3">
                        <select onchange="updateStatus(this.value)" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                            <option value="">Change Status</option>
                            <option value="available" {{ $pet->status === 'available' ? 'selected' : '' }}>Available</option>
                            <option value="pending" {{ $pet->status === 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="adopted" {{ $pet->status === 'adopted' ? 'selected' : '' }}>Adopted</option>
                            <option value="on_hold" {{ $pet->status === 'on_hold' ? 'selected' : '' }}>On Hold</option>
                            <option value="not_available" {{ $pet->status === 'not_available' ? 'selected' : '' }}>Not Available</option>
                        </select>
                        
                        <a href="{{ route('admin.pets.images', $pet) }}" class="w-full inline-flex justify-center items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            Manage Images
                        </a>
                        
                        <button onclick="deletePet()" class="w-full inline-flex justify-center items-center px-4 py-2 border border-red-300 rounded-md shadow-sm text-sm font-medium text-red-700 bg-white hover:bg-red-50">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                            </svg>
                            Delete Pet
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Reject Modal -->
<div id="rejectModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50">
    <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
        <div class="mt-3">
            <h3 class="text-lg font-medium text-gray-900 mb-4">Reject Pet Application</h3>
            <form method="POST" action="{{ route('admin.pets.reject', $pet) }}">
                @csrf
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Rejection Reason *</label>
                    <textarea name="rejection_reason" required rows="4" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500" placeholder="Please provide a reason for rejection..."></textarea>
                </div>
                <div class="flex justify-end space-x-3">
                    <button type="button" onclick="closeRejectModal()" class="px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-50">
                        Cancel
                    </button>
                    <button type="submit" class="px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-red-600 hover:bg-red-700">
                        Reject Pet
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function openRejectModal() {
    document.getElementById('rejectModal').classList.remove('hidden');
}

function closeRejectModal() {
    document.getElementById('rejectModal').classList.add('hidden');
}

function updateStatus(status) {
    if (!status) return;
    
    if (confirm('Are you sure you want to change the pet status to ' + status + '?')) {
        fetch('{{ route("admin.pets.update-status", $pet) }}', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({ status: status })
        })
        .then(response => response.json())
        .then(data => {
            if (data.message) {
                alert(data.message);
                location.reload();
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Failed to update status');
        });
    }
}

function deletePet() {
    if (confirm('Are you sure you want to delete this pet? This action cannot be undone.')) {
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = '{{ route("admin.pets.destroy", $pet) }}';
        
        const csrfToken = document.createElement('input');
        csrfToken.type = 'hidden';
        csrfToken.name = '_token';
        csrfToken.value = document.querySelector('meta[name="csrf-token"]').content;
        
        const methodField = document.createElement('input');
        methodField.type = 'hidden';
        methodField.name = '_method';
        methodField.value = 'DELETE';
        
        form.appendChild(csrfToken);
        form.appendChild(methodField);
        document.body.appendChild(form);
        form.submit();
    }
}

// Close modal when clicking outside
document.getElementById('rejectModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeRejectModal();
    }
});
</script>
@endsection