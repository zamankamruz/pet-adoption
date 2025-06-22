<?php
// File: step5.blade.php
// Path: /resources/views/rehoming/step5.blade.php
?>

@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50">
    <!-- Progress Bar -->
    <div class="bg-white shadow-sm">
        <div class="max-w-4xl mx-auto px-4 py-4">
            <div class="flex items-center justify-between mb-4">
                <div class="flex items-center space-x-2">
                    <img src="{{ asset('images/logo.png') }}" alt="Furry Friends" class="h-8">
                    <span class="text-lg font-semibold text-gray-900">Furry Friends</span>
                </div>
                <div class="flex items-center space-x-2">
                    <div class="w-8 h-8 bg-purple-500 rounded-full flex items-center justify-center">
                        <i class="fas fa-user text-white text-sm"></i>
                    </div>
                    <span class="text-sm font-medium text-gray-700">{{ auth()->user()->name }}</span>
                </div>
            </div>

            <!-- Progress Steps -->
            <div class="flex items-center justify-between">
                @for($i = 1; $i <= 4; $i++)
                <div class="flex items-center">
                    <div class="w-8 h-8 bg-green-500 rounded-full flex items-center justify-center">
                        <i class="fas fa-check text-white text-xs"></i>
                    </div>
                </div>
                @endfor
                
                <div class="flex items-center">
                    <div class="w-8 h-8 bg-purple-500 rounded-full flex items-center justify-center">
                        <span class="text-white text-sm font-bold">5</span>
                    </div>
                    <span class="ml-2 text-sm font-medium text-purple-600">Key Facts</span>
                </div>

                @for($i = 6; $i <= 9; $i++)
                <div class="flex items-center">
                    <div class="w-8 h-8 bg-gray-300 rounded-full flex items-center justify-center">
                        <span class="text-gray-600 text-sm">{{ $i }}</span>
                    </div>
                </div>
                @endfor
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="max-w-4xl mx-auto px-4 py-8">
        <div class="bg-white rounded-lg shadow-md p-8">
            <form method="POST" action="{{ route('rehoming.step5.store') }}">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Pet's Name -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Pet's Name *</label>
                        <input type="text" name="pet_name" value="{{ old('pet_name', $rehoming->pet_name) }}" 
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500"
                               placeholder="If your pet is a puppy then use that age as 0" required>
                        @error('pet_name')
                            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Age (Years) -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Age (Years) *</label>
                        <select name="age_years" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500" required>
                            <option value="">0</option>
                            @for($i = 0; $i <= 20; $i++)
                                <option value="{{ $i }}" {{ old('age_years', $rehoming->age_years) == $i ? 'selected' : '' }}>{{ $i }}</option>
                            @endfor
                        </select>
                        @error('age_years')
                            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Size -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Size *</label>
                        <select name="size" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500" required>
                            <option value="">Please select</option>
                            <option value="small" {{ old('size', $rehoming->size) === 'small' ? 'selected' : '' }}>Small</option>
                            <option value="medium" {{ old('size', $rehoming->size) === 'medium' ? 'selected' : '' }}>Medium</option>
                            <option value="large" {{ old('size', $rehoming->size) === 'large' ? 'selected' : '' }}>Large</option>
                            <option value="extra_large" {{ old('size', $rehoming->size) === 'extra_large' ? 'selected' : '' }}>Extra Large</option>
                        </select>
                        @error('size')
                            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Gender -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Gender *</label>
                        <select name="gender" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500" required>
                            <option value="">Please select</option>
                            <option value="male" {{ old('gender', $rehoming->gender) === 'male' ? 'selected' : '' }}>Male</option>
                            <option value="female" {{ old('gender', $rehoming->gender) === 'female' ? 'selected' : '' }}>Female</option>
                        </select>
                        @error('gender')
                            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Breed(s) -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Breed(s) *</label>
                        <select name="breed" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500" required>
                            <option value="">Pick a value</option>
                            <option value="mixed" {{ old('breed', $rehoming->breed) === 'mixed' ? 'selected' : '' }}>Mixed Breed</option>
                            <option value="labrador" {{ old('breed', $rehoming->breed) === 'labrador' ? 'selected' : '' }}>Labrador Retriever</option>
                            <option value="golden_retriever" {{ old('breed', $rehoming->breed) === 'golden_retriever' ? 'selected' : '' }}>Golden Retriever</option>
                            <option value="german_shepherd" {{ old('breed', $rehoming->breed) === 'german_shepherd' ? 'selected' : '' }}>German Shepherd</option>
                            <option value="bulldog" {{ old('breed', $rehoming->breed) === 'bulldog' ? 'selected' : '' }}>Bulldog</option>
                            <option value="poodle" {{ old('breed', $rehoming->breed) === 'poodle' ? 'selected' : '' }}>Poodle</option>
                            <option value="beagle" {{ old('breed', $rehoming->breed) === 'beagle' ? 'selected' : '' }}>Beagle</option>
                            <option value="rottweiler" {{ old('breed', $rehoming->breed) === 'rottweiler' ? 'selected' : '' }}>Rottweiler</option>
                            <option value="yorkshire_terrier" {{ old('breed', $rehoming->breed) === 'yorkshire_terrier' ? 'selected' : '' }}>Yorkshire Terrier</option>
                            <option value="dachshund" {{ old('breed', $rehoming->breed) === 'dachshund' ? 'selected' : '' }}>Dachshund</option>
                            <option value="persian" {{ old('breed', $rehoming->breed) === 'persian' ? 'selected' : '' }}>Persian Cat</option>
                            <option value="maine_coon" {{ old('breed', $rehoming->breed) === 'maine_coon' ? 'selected' : '' }}>Maine Coon</option>
                            <option value="siamese" {{ old('breed', $rehoming->breed) === 'siamese' ? 'selected' : '' }}>Siamese</option>
                            <option value="british_shorthair" {{ old('breed', $rehoming->breed) === 'british_shorthair' ? 'selected' : '' }}>British Shorthair</option>
                            <option value="ragdoll" {{ old('breed', $rehoming->breed) === 'ragdoll' ? 'selected' : '' }}>Ragdoll</option>
                            <option value="other" {{ old('breed', $rehoming->breed) === 'other' ? 'selected' : '' }}>Other</option>
                        </select>
                        @error('breed')
                            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Colors -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Colors *</label>
                        <select name="color" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500" required>
                            <option value="">All</option>
                            <option value="black" {{ old('color', $rehoming->color) === 'black' ? 'selected' : '' }}>Black</option>
                            <option value="white" {{ old('color', $rehoming->color) === 'white' ? 'selected' : '' }}>White</option>
                            <option value="brown" {{ old('color', $rehoming->color) === 'brown' ? 'selected' : '' }}>Brown</option>
                            <option value="golden" {{ old('color', $rehoming->color) === 'golden' ? 'selected' : '' }}>Golden</option>
                            <option value="gray" {{ old('color', $rehoming->color) === 'gray' ? 'selected' : '' }}>Gray</option>
                            <option value="cream" {{ old('color', $rehoming->color) === 'cream' ? 'selected' : '' }}>Cream</option>
                            <option value="red" {{ old('color', $rehoming->color) === 'red' ? 'selected' : '' }}>Red</option>
                            <option value="blue" {{ old('color', $rehoming->color) === 'blue' ? 'selected' : '' }}>Blue</option>
                            <option value="chocolate" {{ old('color', $rehoming->color) === 'chocolate' ? 'selected' : '' }}>Chocolate</option>
                            <option value="brindle" {{ old('color', $rehoming->color) === 'brindle' ? 'selected' : '' }}>Brindle</option>
                            <option value="tricolor" {{ old('color', $rehoming->color) === 'tricolor' ? 'selected' : '' }}>Tricolor</option>
                            <option value="mixed" {{ old('color', $rehoming->color) === 'mixed' ? 'selected' : '' }}>Mixed</option>
                        </select>
                        @error('color')
                            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex justify-between mt-8">
                    <a href="{{ route('rehoming.step4') }}" class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors">
                        <i class="fas fa-arrow-left mr-2"></i> Back
                    </a>
                    <button type="submit" class="px-8 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition-colors">
                        Continue <i class="fas fa-arrow-right ml-2"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection