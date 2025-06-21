<?php
// File: edit.blade.php
// Path: /resources/views/admin/pets/edit.blade.php
?>

@extends('layouts.admin')

@section('title', 'Edit Pet - ' . $pet->name)

@section('content')
<div class="min-h-screen bg-gray-50">
    <!-- Header -->
    <div class="bg-white shadow">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">Edit Pet - {{ $pet->name }}</h1>
                    <p class="mt-1 text-sm text-gray-600">Update pet information and details</p>
                </div>
                <div class="flex space-x-3">
                    <a href="{{ route('admin.pets.show', $pet) }}" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                        </svg>
                        View Pet
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

    <div class="max-w-4xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        <form method="POST" action="{{ route('admin.pets.update', $pet) }}" enctype="multipart/form-data" class="space-y-8">
            @csrf
            @method('PUT')
            
            <!-- Basic Information -->
            <div class="bg-white shadow rounded-lg">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-medium text-gray-900">Basic Information</h3>
                </div>
                <div class="px-6 py-4 space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Pet Name *</label>
                            <input type="text" name="name" value="{{ old('name', $pet->name) }}" required
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 @error('name') border-red-500 @enderror">
                            @error('name')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Species *</label>
                            <select name="species" required class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 @error('species') border-red-500 @enderror">
                                <option value="">Select Species</option>
                                <option value="dog" {{ old('species', $pet->species) === 'dog' ? 'selected' : '' }}>Dog</option>
                                <option value="cat" {{ old('species', $pet->species) === 'cat' ? 'selected' : '' }}>Cat</option>
                                <option value="bird" {{ old('species', $pet->species) === 'bird' ? 'selected' : '' }}>Bird</option>
                                <option value="rabbit" {{ old('species', $pet->species) === 'rabbit' ? 'selected' : '' }}>Rabbit</option>
                                <option value="other" {{ old('species', $pet->species) === 'other' ? 'selected' : '' }}>Other</option>
                            </select>
                            @error('species')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Category *</label>
                            <select name="category_id" required class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 @error('category_id') border-red-500 @enderror">
                                <option value="">Select Category</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id', $pet->category_id) == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Breed *</label>
                            <select name="breed_id" required class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 @error('breed_id') border-red-500 @enderror">
                                <option value="">Select Breed</option>
                                @foreach($breeds as $breed)
                                    <option value="{{ $breed->id }}" {{ old('breed_id', $pet->breed_id) == $breed->id ? 'selected' : '' }}>
                                        {{ $breed->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('breed_id')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Location *</label>
                            <select name="location_id" required class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 @error('location_id') border-red-500 @enderror">
                                <option value="">Select Location</option>
                                @foreach($locations as $location)
                                    <option value="{{ $location->id }}" {{ old('location_id', $pet->location_id) == $location->id ? 'selected' : '' }}>
                                        {{ $location->city }}, {{ $location->state }}
                                    </option>
                                @endforeach
                            </select>
                            @error('location_id')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Owner</label>
                            <select name="owner_id" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                <option value="">Admin Listed</option>
                                @if($pet->owner)
                                    <option value="{{ $pet->owner->id }}" selected>{{ $pet->owner->name }} ({{ $pet->owner->email }})</option>
                                @endif
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Current Photo -->
            @if($pet->main_image)
                <div class="bg-white shadow rounded-lg">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h3 class="text-lg font-medium text-gray-900">Current Photo</h3>
                    </div>
                    <div class="px-6 py-4">
                        <div class="flex items-center space-x-4">
                            <img src="{{ $pet->main_image_url }}" alt="{{ $pet->name }}" class="w-32 h-32 object-cover rounded-lg">
                            <div>
                                <p class="text-sm text-gray-600">Current main photo for {{ $pet->name }}</p>
                                <p class="text-xs text-gray-500 mt-1">Upload a new photo below to replace this image</p>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            <!-- All form sections from create.blade.php with values filled -->
            <!-- Physical Characteristics -->
            <div class="bg-white shadow rounded-lg">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-medium text-gray-900">Physical Characteristics</h3>
                </div>
                <div class="px-6 py-4 space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Age (Years) *</label>
                            <input type="number" name="age_years" value="{{ old('age_years', $pet->age_years) }}" min="0" max="30" required
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 @error('age_years') border-red-500 @enderror">
                            @error('age_years')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Age (Months) *</label>
                            <input type="number" name="age_months" value="{{ old('age_months', $pet->age_months) }}" min="0" max="11" required
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 @error('age_months') border-red-500 @enderror">
                            @error('age_months')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Gender *</label>
                            <select name="gender" required class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 @error('gender') border-red-500 @enderror">
                                <option value="">Select Gender</option>
                                <option value="male" {{ old('gender', $pet->gender) === 'male' ? 'selected' : '' }}>Male</option>
                                <option value="female" {{ old('gender', $pet->gender) === 'female' ? 'selected' : '' }}>Female</option>
                            </select>
                            @error('gender')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Size *</label>
                            <select name="size" required class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 @error('size') border-red-500 @enderror">
                                <option value="">Select Size</option>
                                <option value="small" {{ old('size', $pet->size) === 'small' ? 'selected' : '' }}>Small</option>
                                <option value="medium" {{ old('size', $pet->size) === 'medium' ? 'selected' : '' }}>Medium</option>
                                <option value="large" {{ old('size', $pet->size) === 'large' ? 'selected' : '' }}>Large</option>
                                <option value="extra_large" {{ old('size', $pet->size) === 'extra_large' ? 'selected' : '' }}>Extra Large</option>
                            </select>
                            @error('size')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Color *</label>
                            <input type="text" name="color" value="{{ old('color', $pet->color) }}" required
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 @error('color') border-red-500 @enderror">
                            @error('color')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Weight (lbs)</label>
                            <input type="number" name="weight" value="{{ old('weight', $pet->weight) }}" step="0.1" min="0"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 @error('weight') border-red-500 @enderror">
                            @error('weight')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <!-- Behavioral Traits -->
            <div class="bg-white shadow rounded-lg">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-medium text-gray-900">Behavioral Traits</h3>
                </div>
                <div class="px-6 py-4 space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Energy Level *</label>
                            <select name="energy_level" required class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 @error('energy_level') border-red-500 @enderror">
                                <option value="">Select Energy Level</option>
                                <option value="low" {{ old('energy_level', $pet->energy_level) === 'low' ? 'selected' : '' }}>Low</option>
                                <option value="moderate" {{ old('energy_level', $pet->energy_level) === 'moderate' ? 'selected' : '' }}>Moderate</option>
                                <option value="high" {{ old('energy_level', $pet->energy_level) === 'high' ? 'selected' : '' }}>High</option>
                            </select>
                            @error('energy_level')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Training Level *</label>
                            <select name="training_level" required class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 @error('training_level') border-red-500 @enderror">
                                <option value="">Select Training Level</option>
                                <option value="none" {{ old('training_level', $pet->training_level) === 'none' ? 'selected' : '' }}>None</option>
                                <option value="basic" {{ old('training_level', $pet->training_level) === 'basic' ? 'selected' : '' }}>Basic</option>
                                <option value="intermediate" {{ old('training_level', $pet->training_level) === 'intermediate' ? 'selected' : '' }}>Intermediate</option>
                                <option value="advanced" {{ old('training_level', $pet->training_level) === 'advanced' ? 'selected' : '' }}>Advanced</option>
                            </select>
                            @error('training_level')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="space-y-4">
                        <h4 class="text-sm font-medium text-gray-700">Good With:</h4>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <label class="flex items-center">
                                <input type="checkbox" name="good_with_kids" value="1" {{ old('good_with_kids', $pet->good_with_kids) ? 'checked' : '' }}
                                       class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                                <span class="ml-2 text-sm text-gray-700">Kids</span>
                            </label>
                            <label class="flex items-center">
                                <input type="checkbox" name="good_with_pets" value="1" {{ old('good_with_pets', $pet->good_with_pets) ? 'checked' : '' }}
                                       class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                                <span class="ml-2 text-sm text-gray-700">Other Pets</span>
                            </label>
                            <label class="flex items-center">
                                <input type="checkbox" name="good_with_strangers" value="1" {{ old('good_with_strangers', $pet->good_with_strangers) ? 'checked' : '' }}
                                       class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                                <span class="ml-2 text-sm text-gray-700">Strangers</span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Health Information -->
            <div class="bg-white shadow rounded-lg">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-medium text-gray-900">Health Information</h3>
                </div>
                <div class="px-6 py-4 space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Health Status *</label>
                            <input type="text" name="health_status" value="{{ old('health_status', $pet->health_status) }}" required
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 @error('health_status') border-red-500 @enderror">
                            @error('health_status')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Vaccination Status *</label>
                            <select name="vaccination_status" required class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 @error('vaccination_status') border-red-500 @enderror">
                                <option value="">Select Status</option>
                                <option value="up_to_date" {{ old('vaccination_status', $pet->vaccination_status) === 'up_to_date' ? 'selected' : '' }}>Up to Date</option>
                                <option value="partial" {{ old('vaccination_status', $pet->vaccination_status) === 'partial' ? 'selected' : '' }}>Partial</option>
                                <option value="none" {{ old('vaccination_status', $pet->vaccination_status) === 'none' ? 'selected' : '' }}>None</option>
                                <option value="unknown" {{ old('vaccination_status', $pet->vaccination_status) === 'unknown' ? 'selected' : '' }}>Unknown</option>
                            </select>
                            @error('vaccination_status')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Microchip ID</label>
                            <input type="text" name="microchip_id" value="{{ old('microchip_id', $pet->microchip_id) }}"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 @error('microchip_id') border-red-500 @enderror">
                            @error('microchip_id')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="space-y-4">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <label class="flex items-center">
                                <input type="checkbox" name="spayed_neutered" value="1" {{ old('spayed_neutered', $pet->spayed_neutered) ? 'checked' : '' }}
                                       class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                                <span class="ml-2 text-sm text-gray-700">Spayed/Neutered</span>
                            </label>
                            <label class="flex items-center">
                                <input type="checkbox" name="house_trained" value="1" {{ old('house_trained', $pet->house_trained) ? 'checked' : '' }}
                                       class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                                <span class="ml-2 text-sm text-gray-700">House Trained</span>
                            </label>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Special Needs</label>
                        <textarea name="special_needs" rows="3" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 @error('special_needs') border-red-500 @enderror">{{ old('special_needs', $pet->special_needs) }}</textarea>
                        @error('special_needs')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Description & Photos -->
            <div class="bg-white shadow rounded-lg">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-medium text-gray-900">Description & Photos</h3>
                </div>
                <div class="px-6 py-4 space-y-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Description *</label>
                        <textarea name="description" rows="4" required class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 @error('description') border-red-500 @enderror">{{ old('description', $pet->description) }}</textarea>
                        @error('description')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Personality</label>
                        <textarea name="personality" rows="3" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 @error('personality') border-red-500 @enderror">{{ old('personality', $pet->personality) }}</textarea>
                        @error('personality')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Update Main Photo</label>
                        <input type="file" name="main_image" accept="image/*" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 @error('main_image') border-red-500 @enderror">
                        <p class="mt-1 text-sm text-gray-500">Upload a new main photo to replace the current one (JPEG, PNG, JPG, GIF, max 2MB)</p>
                        @error('main_image')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Adoption Details -->
            <div class="bg-white shadow rounded-lg">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-medium text-gray-900">Adoption Details</h3>
                </div>
                <div class="px-6 py-4 space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Adoption Fee *</label>
                            <div class="relative">
                                <span class="absolute left-3 top-2 text-gray-500">$</span>
                                <input type="number" name="adoption_fee" value="{{ old('adoption_fee', $pet->adoption_fee) }}" step="0.01" min="0" required
                                       class="w-full pl-8 pr-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 @error('adoption_fee') border-red-500 @enderror">
                            </div>
                            @error('adoption_fee')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Status *</label>
                            <select name="status" required class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 @error('status') border-red-500 @enderror">
                                <option value="">Select Status</option>
                                <option value="available" {{ old('status', $pet->status) === 'available' ? 'selected' : '' }}>Available</option>
                                <option value="pending" {{ old('status', $pet->status) === 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="adopted" {{ old('status', $pet->status) === 'adopted' ? 'selected' : '' }}>Adopted</option>
                                <option value="on_hold" {{ old('status', $pet->status) === 'on_hold' ? 'selected' : '' }}>On Hold</option>
                                <option value="not_available" {{ old('status', $pet->status) === 'not_available' ? 'selected' : '' }}>Not Available</option>
                            </select>
                            @error('status')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="space-y-4">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <label class="flex items-center">
                                <input type="checkbox" name="is_featured" value="1" {{ old('is_featured', $pet->is_featured) ? 'checked' : '' }}
                                       class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                                <span class="ml-2 text-sm text-gray-700">Featured Pet</span>
                            </label>
                            <label class="flex items-center">
                                <input type="checkbox" name="is_urgent" value="1" {{ old('is_urgent', $pet->is_urgent) ? 'checked' : '' }}
                                       class="rounded border-gray-300 text-red-600 shadow-sm focus:border-red-300 focus:ring focus:ring-red-200 focus:ring-opacity-50">
                                <span class="ml-2 text-sm text-gray-700">Urgent Adoption</span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Form Actions -->
            <div class="flex justify-end space-x-3">
                <a href="{{ route('admin.pets.show', $pet) }}" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                    Cancel
                </a>
                <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    Update Pet
                </button>
            </div>
        </form>
    </div>
</div>
@endsection