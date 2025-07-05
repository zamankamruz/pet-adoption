<?php
// File: edit.blade.php
// Path: /resources/views/user/rehoming/edit.blade.php
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
                                    <a href="{{ route('rehoming.my-pets.show', $rehoming) }}" class="hover:text-purple-600">{{ $rehoming->pet_name ?: 'Pet Details' }}</a>
                                    <span class="mx-2">></span>
                                    <span class="text-gray-900">Edit</span>
                                </nav>
                                <h1 class="text-2xl font-bold text-gray-900">Edit Rehoming Request</h1>
                                <p class="text-gray-600 mt-1">Update your pet's information</p>
                            </div>
                            <a href="{{ route('rehoming.my-pets.show', $rehoming) }}" 
                               class="px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors">
                                <i class="fas fa-times mr-2"></i> Cancel
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Main Content -->
                <form method="POST" action="{{ route('rehoming.my-pets.update', $rehoming) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    
                    <div class="space-y-8">
                        <!-- Basic Information -->
                        <div class="bg-white rounded-lg shadow-sm">
                            <div class="p-6 border-b border-gray-200">
                                <h2 class="text-lg font-semibold text-gray-900">Basic Information</h2>
                            </div>
                            <div class="p-6">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <!-- Pet Name -->
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Pet Name *</label>
                                        <input type="text" name="pet_name" value="{{ old('pet_name', $rehoming->pet_name) }}" 
                                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500" required>
                                        @error('pet_name')
                                            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Species -->
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Species *</label>
                                        <select name="species" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500" required>
                                            <option value="">Select Species</option>
                                            <option value="dog" {{ old('species', $rehoming->species) === 'dog' ? 'selected' : '' }}>Dog</option>
                                            <option value="cat" {{ old('species', $rehoming->species) === 'cat' ? 'selected' : '' }}>Cat</option>
                                        </select>
                                        @error('species')
                                            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Breed -->
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Breed *</label>
                                        <input type="text" name="breed" value="{{ old('breed', $rehoming->breed) }}" 
                                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500" required>
                                        @error('breed')
                                            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Age -->
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Age *</label>
                                        <input type="text" name="age" value="{{ old('age', $rehoming->age) }}" 
                                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500" required>
                                        @error('age')
                                            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Gender -->
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Gender *</label>
                                        <select name="gender" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500" required>
                                            <option value="">Select Gender</option>
                                            <option value="male" {{ old('gender', $rehoming->gender) === 'male' ? 'selected' : '' }}>Male</option>
                                            <option value="female" {{ old('gender', $rehoming->gender) === 'female' ? 'selected' : '' }}>Female</option>
                                        </select>
                                        @error('gender')
                                            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Size -->
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Size *</label>
                                        <select name="size" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500" required>
                                            <option value="">Select Size</option>
                                            <option value="small" {{ old('size', $rehoming->size) === 'small' ? 'selected' : '' }}>Small</option>
                                            <option value="medium" {{ old('size', $rehoming->size) === 'medium' ? 'selected' : '' }}>Medium</option>
                                            <option value="large" {{ old('size', $rehoming->size) === 'large' ? 'selected' : '' }}>Large</option>
                                            <option value="extra_large" {{ old('size', $rehoming->size) === 'extra_large' ? 'selected' : '' }}>Extra Large</option>
                                        </select>
                                        @error('size')
                                            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Pet Description -->
                        <div class="bg-white rounded-lg shadow-sm">
                            <div class="p-6 border-b border-gray-200">
                                <h2 class="text-lg font-semibold text-gray-900">Pet's Story</h2>
                            </div>
                            <div class="p-6">
                                <label class="block text-sm font-medium text-gray-700 mb-2">Description *</label>
                                <textarea name="description" rows="6" 
                                          class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500"
                                          required>{{ old('description', $rehoming->description) }}</textarea>
                                @error('description')
                                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Rehoming Information -->
                        <div class="bg-white rounded-lg shadow-sm">
                            <div class="p-6 border-b border-gray-200">
                                <h2 class="text-lg font-semibold text-gray-900">Rehoming Information</h2>
                            </div>
                            <div class="p-6">
                                <label class="block text-sm font-medium text-gray-700 mb-2">Reason for Rehoming *</label>
                                <textarea name="reason_for_rehoming" rows="4" 
                                          class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500"
                                          required>{{ old('reason_for_rehoming', $rehoming->reason_for_rehoming) }}</textarea>
                                @error('reason_for_rehoming')
                                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Pet Characteristics -->
                        <div class="bg-white rounded-lg shadow-sm">
                            <div class="p-6 border-b border-gray-200">
                                <h2 class="text-lg font-semibold text-gray-900">Pet Characteristics</h2>
                            </div>
                            <div class="p-6">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <!-- Good with Kids -->
                                    <div>
                                        <label class="flex items-center">
                                            <input type="checkbox" name="good_with_kids" value="1" 
                                                   class="mr-3 text-purple-600 focus:ring-purple-500"
                                                   {{ old('good_with_kids', $rehoming->good_with_kids) ? 'checked' : '' }}>
                                            <span class="text-gray-700">Good with Kids</span>
                                        </label>
                                    </div>

                                    <!-- Good with Pets -->
                                    <div>
                                        <label class="flex items-center">
                                            <input type="checkbox" name="good_with_pets" value="1" 
                                                   class="mr-3 text-purple-600 focus:ring-purple-500"
                                                   {{ old('good_with_pets', $rehoming->good_with_pets) ? 'checked' : '' }}>
                                            <span class="text-gray-700">Good with Other Pets</span>
                                        </label>
                                    </div>

                                    <!-- Spayed/Neutered -->
                                    <div>
                                        <label class="flex items-center">
                                            <input type="checkbox" name="spayed_neutered" value="1" 
                                                   class="mr-3 text-purple-600 focus:ring-purple-500"
                                                   {{ old('spayed_neutered', $rehoming->spayed_neutered) ? 'checked' : '' }}>
                                            <span class="text-gray-700">Spayed/Neutered</span>
                                        </label>
                                    </div>

                                    <!-- House Trained -->
                                    <div>
                                        <label class="flex items-center">
                                            <input type="checkbox" name="house_trained" value="1" 
                                                   class="mr-3 text-purple-600 focus:ring-purple-500"
                                                   {{ old('house_trained', $rehoming->house_trained) ? 'checked' : '' }}>
                                            <span class="text-gray-700">House Trained</span>
                                        </label>
                                    </div>
                                </div>

                                <!-- Vaccination Status -->
                                <div class="mt-6">
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Vaccination Status</label>
                                    <select name="vaccination_status" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500">
                                        <option value="">Select Status</option>
                                        <option value="up_to_date" {{ old('vaccination_status', $rehoming->vaccination_status) === 'up_to_date' ? 'selected' : '' }}>Up to Date</option>
                                        <option value="partial" {{ old('vaccination_status', $rehoming->vaccination_status) === 'partial' ? 'selected' : '' }}>Partial</option>
                                        <option value="none" {{ old('vaccination_status', $rehoming->vaccination_status) === 'none' ? 'selected' : '' }}>None</option>
                                        <option value="unknown" {{ old('vaccination_status', $rehoming->vaccination_status) === 'unknown' ? 'selected' : '' }}>Unknown</option>
                                    </select>
                                    @error('vaccination_status')
                                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Special Needs -->
                        <div class="bg-white rounded-lg shadow-sm">
                            <div class="p-6 border-b border-gray-200">
                                <h2 class="text-lg font-semibold text-gray-900">Special Needs</h2>
                            </div>
                            <div class="p-6">
                                <label class="block text-sm font-medium text-gray-700 mb-2">Special Needs (Optional)</label>
                                <textarea name="special_needs" rows="3" 
                                          class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500"
                                          placeholder="Describe any special medical needs, medications, or care requirements...">{{ old('special_needs', $rehoming->special_needs ?? '') }}</textarea>
                                @error('special_needs')
                                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Contact Preferences -->
                        <div class="bg-white rounded-lg shadow-sm">
                            <div class="p-6 border-b border-gray-200">
                                <h2 class="text-lg font-semibold text-gray-900">Contact Preferences</h2>
                            </div>
                            <div class="p-6">
                                <label class="block text-sm font-medium text-gray-700 mb-3">How would you like potential adopters to contact you?</label>
                                <div class="space-y-3">
                                    @php
                                        $contactPrefs = old('contact_preferences', $rehoming->contact_preferences ?? []);
                                        if (is_string($contactPrefs)) {
                                            $contactPrefs = json_decode($contactPrefs, true) ?? [];
                                        }
                                    @endphp
                                    
                                    <label class="flex items-center">
                                        <input type="checkbox" name="contact_preferences[]" value="email" 
                                               class="mr-3 text-purple-600 focus:ring-purple-500"
                                               {{ in_array('email', $contactPrefs) ? 'checked' : '' }}>
                                        <span class="text-gray-700">Email</span>
                                    </label>
                                    
                                    <label class="flex items-center">
                                        <input type="checkbox" name="contact_preferences[]" value="phone" 
                                               class="mr-3 text-purple-600 focus:ring-purple-500"
                                               {{ in_array('phone', $contactPrefs) ? 'checked' : '' }}>
                                        <span class="text-gray-700">Phone</span>
                                    </label>
                                    
                                    <label class="flex items-center">
                                        <input type="checkbox" name="contact_preferences[]" value="text" 
                                               class="mr-3 text-purple-600 focus:ring-purple-500"
                                               {{ in_array('text', $contactPrefs) ? 'checked' : '' }}>
                                        <span class="text-gray-700">Text Message</span>
                                    </label>
                                </div>
                                @error('contact_preferences')
                                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Form Actions -->
                        <div class="flex justify-between">
                            <a href="{{ route('rehoming.my-pets.show', $rehoming) }}" 
                               class="px-6 py-3 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors">
                                Cancel
                            </a>
                            <button type="submit" 
                                    class="px-8 py-3 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition-colors">
                                Update Rehoming Request
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection