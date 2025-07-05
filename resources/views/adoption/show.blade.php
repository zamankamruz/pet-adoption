<?php
// File: show.blade.php (continued from previous - updating specific sections)
// Path: /resources/views/pets/show.blade.php
?>

@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 mx-auto px-4 sm:px-6 lg:px-8">


    <!-- Pet Profile Header -->
    <div class="bg-white border-b">
        <div class="max-w-7xl mx-auto px-4 py-6">
            <div class="flex items-start space-x-4">
                <!-- Pet Avatar -->
                <div class="flex-shrink-0">
                    <img src="{{ $pet->main_image_url }}" 
                         alt="{{ $pet->name }}" 
                         class="w-20 h-20 rounded-full object-cover border-2 border-gray-200">
                </div>
                
                <!-- Pet Basic Info -->
                <div class="flex-1">
                    <h1 class="text-2xl font-bold text-gray-900 mb-1">Hi Human !</h1>
                    <h2 class="text-xl font-semibold text-gray-800 mb-1">{{ $pet->name }}</h2>
                    <p class="text-sm text-gray-600 mb-2">Pet ID: {{ str_pad($pet->id, 8, '0', STR_PAD_LEFT) }}</p>
                    
                    <!-- Location -->
                    <div class="flex items-center space-x-2 text-sm">
                        <img src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 16'%3E%3Crect width='24' height='16' fill='%23b22234'/%3E%3Cpath d='M0,0h9.6v8H0z' fill='%23002868'/%3E%3Cpath d='M0,2.4h9.6m0,1.6H0m0,1.6h9.6m0,1.6H0' stroke='%23fff' stroke-width='0.8'/%3E%3C/svg%3E" 
                             alt="US Flag" class="w-4 h-3">
                        <span class="text-gray-700">United States Of America</span>
                    </div>
                    <div class="flex items-center space-x-1 text-sm text-gray-600 mt-1">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"></path>
                        </svg>
                        <span>{{ $pet->location->city }} ({{ $pet->location->state === 'CA' ? '12 Km away' : $pet->location->state }})</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto px-4 py-8">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Left Column - Images -->
            <div class="lg:col-span-2">
                <!-- Main Image -->
                <div class="relative mb-4">
                    <img src="{{ $pet->main_image_url }}" 
                         alt="{{ $pet->name }}" 
                         id="mainImage"
                         class="w-full h-96 object-cover rounded-lg">
                    
                    <!-- Favorite Button -->
                    <button class="absolute top-4 right-4 w-10 h-10 bg-white rounded-full shadow-md flex items-center justify-center hover:bg-gray-50 {{ $isFavorited ? 'text-red-500' : 'text-gray-400' }}" 
                            onclick="toggleFavorite({{ $pet->id }}, this)">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd"></path>
                        </svg>
                    </button>
                </div>

                <!-- Thumbnail Gallery -->
                @if($pet->getAllImages()->count() > 1)
                <div class="flex space-x-3 overflow-x-auto pb-2">
                    @foreach($pet->getAllImages() as $index => $image)
                        <img src="{{ $image['url'] }}" 
                             alt="{{ $pet->name }}" 
                             class="w-20 h-20 object-cover rounded-lg cursor-pointer border-2 {{ $index === 0 ? 'border-purple-500' : 'border-transparent hover:border-gray-300' }} thumbnail"
                             onclick="showImage({{ $index }}, '{{ $image['url'] }}', this)">
                    @endforeach
                </div>
                @endif

                <!-- Pet Details Grid -->
                <div class="mt-8 grid grid-cols-6 gap-4">
                    <!-- Gender -->
                    <div class="text-center">
                        <div class="w-12 h-12 mx-auto mb-2 bg-purple-100 rounded-full flex items-center justify-center">
                            <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"></path>
                            </svg>
                        </div>
                        <p class="text-xs text-gray-600 mb-1">Gender</p>
                        <p class="text-sm font-medium">{{ ucfirst($pet->gender) }}</p>
                    </div>

                    <!-- Breed -->
                    <div class="text-center">
                        <div class="w-12 h-12 mx-auto mb-2 bg-purple-100 rounded-full flex items-center justify-center">
                            <svg class="w-6 h-6 text-purple-600" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2C13.1 2 14 2.9 14 4C14 5.1 13.1 6 12 6C10.9 6 10 5.1 10 4C10 2.9 10.9 2 12 2M21 9V7L15 1L13.5 2.5C13.1 1.9 12.6 1.4 12 1.1C11.4 1.4 10.9 1.9 10.5 2.5L9 1L3 7V9H9C10.1 9 11 9.9 11 11V16C11 17.1 11.9 18 13 18H15C16.1 18 17 17.1 17 16V11C17 9.9 17.9 9 19 9H21Z"/>
                            </svg>
                        </div>
                        <p class="text-xs text-gray-600 mb-1">Breed</p>
                        <p class="text-sm font-medium">{{ $pet->breed->name }}</p>
                    </div>

                    <!-- Age -->
                    <div class="text-center">
                        <div class="w-12 h-12 mx-auto mb-2 bg-purple-100 rounded-full flex items-center justify-center">
                            <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <circle cx="12" cy="12" r="10"></circle>
                                <polyline points="12,6 12,12 16,14"></polyline>
                            </svg>
                        </div>
                        <p class="text-xs text-gray-600 mb-1">Age</p>
                        <p class="text-sm font-medium">{{ $pet->age_years > 0 ? $pet->age_years . ' year' . ($pet->age_years > 1 ? 's' : '') : $pet->age_months . ' month' . ($pet->age_months > 1 ? 's' : '') }}</p>
                    </div>

                    <!-- Color -->
                    <div class="text-center">
                        <div class="w-12 h-12 mx-auto mb-2 bg-purple-100 rounded-full flex items-center justify-center">
                            <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <circle cx="13.5" cy="6.5" r=".5"></circle>
                                <circle cx="17.5" cy="10.5" r=".5"></circle>
                                <circle cx="8.5" cy="7.5" r=".5"></circle>
                                <circle cx="6.5" cy="12.5" r=".5"></circle>
                                <path d="M12 2C6.5 2 2 6.5 2 12s4.5 10 10 10c.926 0 1.648-.746 1.648-1.688 0-.437-.18-.835-.437-1.125-.29-.289-.438-.652-.438-1.125a1.64 1.64 0 011.668-1.668h1.996c3.051 0 5.555-2.503 5.555-5.554C21.965 6.012 17.461 2 12 2z"></path>
                            </svg>
                        </div>
                        <p class="text-xs text-gray-600 mb-1">Color</p>
                        <p class="text-sm font-medium">{{ $pet->color }}</p>
                    </div>

                    <!-- Weight -->
                    <div class="text-center">
                        <div class="w-12 h-12 mx-auto mb-2 bg-purple-100 rounded-full flex items-center justify-center">
                            <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3"></path>
                            </svg>
                        </div>
                        <p class="text-xs text-gray-600 mb-1">Weight</p>
                        <p class="text-sm font-medium">{{ $pet->weight ? $pet->weight . ' Lb' : '12 Lb' }}</p>
                    </div>

                    <!-- Height -->
                    <div class="text-center">
                        <div class="w-12 h-12 mx-auto mb-2 bg-purple-100 rounded-full flex items-center justify-center">
                            <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 4V2a1 1 0 011-1h8a1 1 0 011 1v2m0 0V1h4a1 1 0 011 1v20a1 1 0 01-1 1H3a1 1 0 01-1-1V2a1 1 0 011-1h4v3M7 4h10M9 9h6m-6 4h6m-6 4h6"></path>
                            </svg>
                        </div>
                        <p class="text-xs text-gray-600 mb-1">Height</p>
                        <p class="text-sm font-medium">{{ $pet->size === 'small' ? '51 Cm' : ($pet->size === 'medium' ? '61 Cm' : '71 Cm') }}</p>
                    </div>
                </div>

                <!-- Vaccination Schedule -->
                @if($pet->vaccinations->count() > 0)
                <div class="mt-8">
                    <h3 class="text-lg font-semibold mb-4">Vaccinated</h3>
                    <div class="bg-white rounded-lg border overflow-hidden">
                        <table class="w-full">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Age</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">8th Week</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">14th Week</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">22th Week</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                <tr>
                                    <td class="px-4 py-3 text-sm text-gray-900">Vaccinated</td>
                                    <td class="px-4 py-3">
                                        <div class="text-sm text-gray-900">Bordetella</div>
                                        <div class="text-sm text-gray-500">Match</div>
                                        <div class="text-xs text-gray-500">Leptospirosis</div>
                                    </td>
                                    <td class="px-4 py-3">
                                        <div class="text-sm text-gray-900">Bordetella,Canine Antifluanza</div>
                                        <div class="text-sm text-gray-500">Match</div>
                                        <div class="text-xs text-gray-500">Leptospirosis</div>
                                    </td>
                                    <td class="px-4 py-3">
                                        <div class="text-sm text-gray-900">Bordetella,Canine Antifluanza</div>
                                        <div class="text-sm text-gray-500">Match</div>
                                        <div class="text-xs text-gray-500">Leptospirosis</div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                @endif
            </div>

            <!-- Right Column - Pet Info -->
            <div class="lg:col-span-1">
                <!-- Pet Story -->
                <div class="bg-white rounded-lg p-6 mb-6">
                    <h3 class="text-lg font-semibold mb-4">{{ $pet->name }} Story</h3>
                    <p class="text-sm text-gray-700 leading-relaxed mb-6">
                        {{ $pet->description }}
                    </p>

                    <!-- Pet Characteristics -->
                    <div class="space-y-3 mb-6">
                        <div class="flex items-center space-x-3">
                            <div class="w-6 h-6 {{ $pet->good_with_kids ? 'text-green-500' : 'text-gray-400' }}">
                                <svg fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                </svg>
                            </div>
                            <span class="text-sm">{{ $pet->good_with_kids ? 'Can live with other children of any age' : 'Better with older children' }}</span>
                        </div>

                        <div class="flex items-center space-x-3">
                            <div class="w-6 h-6 {{ $pet->vaccination_status === 'up_to_date' ? 'text-green-500' : 'text-gray-400' }}">
                                <svg fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                </svg>
                            </div>
                            <span class="text-sm">Vaccinated</span>
                        </div>

                        <div class="flex items-center space-x-3">
                            <div class="w-6 h-6 {{ $pet->house_trained ? 'text-green-500' : 'text-gray-400' }}">
                                <svg fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path>
                                </svg>
                            </div>
                            <span class="text-sm">House-Trained</span>
                        </div>

                        <div class="flex items-center space-x-3">
                            <div class="w-6 h-6 {{ $pet->spayed_neutered ? 'text-green-500' : 'text-gray-400' }}">
                                <svg fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                </svg>
                            </div>
                            <span class="text-sm">Neutered</span>
                        </div>

                        <div class="flex items-center space-x-3">
                            <div class="w-6 h-6 text-green-500">
                                <svg fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                </svg>
                            </div>
                            <span class="text-sm">Shots up to date</span>
                        </div>

                        <div class="flex items-center space-x-3">
                            <div class="w-6 h-6 text-green-500">
                                <svg fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M4 4a2 2 0 00-2 2v8a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2H4z"></path>
                                </svg>
                            </div>
                            <span class="text-sm">Microchipped</span>
                        </div>
                    </div>

                    <!-- Adoption Call to Action -->
                    <div class="text-center">
                        <p class="text-sm text-gray-600 mb-4">If you are interested to adopt</p>
                        @if($canAdopt)
                            <a href="{{ route('adoption.start', $pet) }}" 
                               class="inline-block bg-purple-600 text-white px-8 py-3 rounded-lg font-medium hover:bg-purple-700 transition-colors">
                                Get started
                            </a>
                        @else
                            <button class="inline-block bg-gray-400 text-white px-8 py-3 rounded-lg font-medium cursor-not-allowed">
                                @if(!auth()->check())
                                    Login to Adopt
                                @else
                                    Adoption Pending
                                @endif
                            </button>
                        @endif
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- Similar Pets -->
    @if($similarPets->count() > 0)
    <div class="bg-white py-12">
        <div class="max-w-7xl mx-auto px-4">
            <h2 class="text-2xl font-bold text-center mb-8">Similar Pets</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach($similarPets as $similarPet)
                <div class="bg-white border border-gray-200 rounded-lg p-4 text-center">
                    <div class="relative mb-4">
                        <img src="{{ $similarPet->main_image_url }}" 
                             alt="{{ $similarPet->name }}" 
                             class="w-20 h-20 rounded-full object-cover mx-auto border-2 border-gray-200">
                    </div>
                    <h3 class="font-semibold text-lg mb-1">{{ $similarPet->name }}</h3>
                    <p class="text-sm text-gray-600 mb-1">{{ ucfirst($similarPet->gender) }}</p>
                    <p class="text-sm text-gray-600 mb-3">{{ $similarPet->breed->name }}</p>
                    <a href="{{ route('adoption.show', $similarPet) }}" 
                       class="inline-block border border-purple-600 text-purple-600 px-6 py-2 rounded-lg text-sm hover:bg-purple-600 hover:text-white transition-colors">
                        More Info
                    </a>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    @endif
</div>

<script>
let currentImageIndex = 0;
const images = @json($pet->getAllImages()->toArray());

function showImage(index, url, thumbnail) {
    currentImageIndex = index;
    document.getElementById('mainImage').src = url;
    
    // Update thumbnail active state
    document.querySelectorAll('.thumbnail').forEach(thumb => {
        thumb.classList.remove('border-purple-500');
        thumb.classList.add('border-transparent');
    });
    thumbnail.classList.remove('border-transparent');
    thumbnail.classList.add('border-purple-500');
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
</script>
@endsection