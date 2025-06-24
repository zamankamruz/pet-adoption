<?php
// File: step4.blade.php
// Path: /resources/views/adoption/step4.blade.php
?>

@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50">
    <!-- Progress Steps -->
    <div class="bg-white shadow-sm">
        <div class="max-w-4xl mx-auto px-4 py-6">
            <div class="flex items-center justify-center">
                <div class="flex items-center space-x-8">
                    <!-- Previous steps completed -->
                    <div class="flex items-center">
                        <div class="w-10 h-10 bg-purple-600 text-white rounded-full flex items-center justify-center font-semibold">
                            ✓
                        </div>
                        <span class="ml-2 text-sm font-medium text-purple-600">Start</span>
                    </div>

                    <div class="w-8 h-0.5 bg-purple-600"></div>

                    <div class="flex items-center">
                        <div class="w-10 h-10 bg-purple-600 text-white rounded-full flex items-center justify-center font-semibold">
                            ✓
                        </div>
                        <span class="ml-2 text-sm font-medium text-purple-600">Address</span>
                    </div>

                    <div class="w-8 h-0.5 bg-purple-600"></div>

                    <div class="flex items-center">
                        <div class="w-10 h-10 bg-purple-600 text-white rounded-full flex items-center justify-center font-semibold">
                            ✓
                        </div>
                        <span class="ml-2 text-sm font-medium text-purple-600">Home</span>
                    </div>

                    <div class="w-8 h-0.5 bg-purple-600"></div>

                    <div class="flex items-center">
                        <div class="w-10 h-10 bg-purple-600 text-white rounded-full flex items-center justify-center font-semibold">
                            ✓
                        </div>
                        <span class="ml-2 text-sm font-medium text-purple-600">Images of Home</span>
                    </div>

                    <div class="w-8 h-0.5 bg-purple-600"></div>

                    <!-- Roommate (Current) -->
                    <div class="flex items-center">
                        <div class="w-10 h-10 bg-green-500 text-white rounded-full flex items-center justify-center font-semibold">
                            5
                        </div>
                        <span class="ml-2 text-sm font-medium text-green-500">Roommate</span>
                    </div>

                    <div class="w-8 h-0.5 bg-gray-300"></div>

                    <!-- Remaining steps -->
                    <div class="flex items-center">
                        <div class="w-10 h-10 bg-gray-300 text-gray-600 rounded-full flex items-center justify-center font-semibold">
                            6
                        </div>
                        <span class="ml-2 text-sm font-medium text-gray-600">Other Animals</span>
                    </div>

                    <div class="w-8 h-0.5 bg-gray-300"></div>
                    <div class="flex items-center">
                        <div class="w-10 h-10 bg-gray-300 text-gray-600 rounded-full flex items-center justify-center font-semibold">
                            7
                        </div>
                        <span class="ml-2 text-sm font-medium text-gray-600">Confirm</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="max-w-4xl mx-auto px-4 py-8">
        <div class="bg-white rounded-lg shadow-sm p-8">
            <form action="{{ route('adoption.step4.store', $pet) }}" method="POST">
                @csrf
                
                <div class="border-4 border-blue-200 rounded-lg p-6 space-y-6">
                    <!-- Number of adults and children -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div>
                            <label for="number_of_adults" class="block text-sm font-medium text-gray-700 mb-2">
                                Number of adults
                            </label>
                            <select name="number_of_adults" 
                                    id="number_of_adults"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500"
                                    required>
                                @for($i = 0; $i <= 10; $i++)
                                    <option value="{{ $i }}" {{ old('number_of_adults', $adoption->application_data['step4']['number_of_adults'] ?? '') == $i ? 'selected' : '' }}>{{ $i }}</option>
                                @endfor
                            </select>
                            @error('number_of_adults')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="number_of_children" class="block text-sm font-medium text-gray-700 mb-2">
                                Number of children <span class="text-red-500">*</span>
                            </label>
                            <select name="number_of_children" 
                                    id="number_of_children"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500"
                                    required>
                                @for($i = 0; $i <= 10; $i++)
                                    <option value="{{ $i }}" {{ old('number_of_children', $adoption->application_data['step4']['number_of_children'] ?? '') == $i ? 'selected' : '' }}>{{ $i }}</option>
                                @endfor
                            </select>
                            @error('number_of_children')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="age_of_youngest_children" class="block text-sm font-medium text-gray-700 mb-2">
                                Age of youngest children
                            </label>
                            <select name="age_of_youngest_children" 
                                    id="age_of_youngest_children"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500">
                                <option value="">Pick a value</option>
                                <option value="0-2" {{ old('age_of_youngest_children', $adoption->application_data['step4']['age_of_youngest_children'] ?? '') == '0-2' ? 'selected' : '' }}>0-2 years</option>
                                <option value="3-5" {{ old('age_of_youngest_children', $adoption->application_data['step4']['age_of_youngest_children'] ?? '') == '3-5' ? 'selected' : '' }}>3-5 years</option>
                                <option value="6-10" {{ old('age_of_youngest_children', $adoption->application_data['step4']['age_of_youngest_children'] ?? '') == '6-10' ? 'selected' : '' }}>6-10 years</option>
                                <option value="11-15" {{ old('age_of_youngest_children', $adoption->application_data['step4']['age_of_youngest_children'] ?? '') == '11-15' ? 'selected' : '' }}>11-15 years</option>
                                <option value="16+" {{ old('age_of_youngest_children', $adoption->application_data['step4']['age_of_youngest_children'] ?? '') == '16+' ? 'selected' : '' }}>16+ years</option>
                            </select>
                            @error('age_of_youngest_children')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <p class="text-sm text-gray-600">Please also add must be living in your household</p>

                    <!-- Any visiting children? -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-3">
                            Any visiting children? <span class="text-red-500">*</span>
                        </label>
                        <div class="flex space-x-6">
                            <label class="flex items-center">
                                <input type="radio" 
                                       name="visiting_children" 
                                       value="yes" 
                                       {{ old('visiting_children', $adoption->application_data['step4']['visiting_children'] ?? '') == 'yes' ? 'checked' : '' }}
                                       class="mr-2 text-purple-600 focus:ring-purple-500" 
                                       required>
                                <span class="text-gray-700">Yes</span>
                            </label>
                            <label class="flex items-center">
                                <input type="radio" 
                                       name="visiting_children" 
                                       value="no" 
                                       {{ old('visiting_children', $adoption->application_data['step4']['visiting_children'] ?? '') == 'no' ? 'checked' : '' }}
                                       class="mr-2 text-purple-600 focus:ring-purple-500" 
                                       required>
                                <span class="text-gray-700">No</span>
                            </label>
                        </div>
                        @error('visiting_children')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Ages of visiting children -->
                    <div>
                        <label for="ages_of_visiting_children" class="block text-sm font-medium text-gray-700 mb-2">
                            Ages of visiting children
                        </label>
                        <select name="ages_of_visiting_children" 
                                id="ages_of_visiting_children"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500">
                            <option value="">Please Select</option>
                            <option value="0-2" {{ old('ages_of_visiting_children', $adoption->application_data['step4']['ages_of_visiting_children'] ?? '') == '0-2' ? 'selected' : '' }}>0-2 years</option>
                            <option value="3-5" {{ old('ages_of_visiting_children', $adoption->application_data['step4']['ages_of_visiting_children'] ?? '') == '3-5' ? 'selected' : '' }}>3-5 years</option>
                            <option value="6-10" {{ old('ages_of_visiting_children', $adoption->application_data['step4']['ages_of_visiting_children'] ?? '') == '6-10' ? 'selected' : '' }}>6-10 years</option>
                            <option value="11-15" {{ old('ages_of_visiting_children', $adoption->application_data['step4']['ages_of_visiting_children'] ?? '') == '11-15' ? 'selected' : '' }}>11-15 years</option>
                            <option value="16+" {{ old('ages_of_visiting_children', $adoption->application_data['step4']['ages_of_visiting_children'] ?? '') == '16+' ? 'selected' : '' }}>16+ years</option>
                            <option value="mixed" {{ old('ages_of_visiting_children', $adoption->application_data['step4']['ages_of_visiting_children'] ?? '') == 'mixed' ? 'selected' : '' }}>Mixed ages</option>
                        </select>
                        @error('ages_of_visiting_children')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Do you have any flatmates or lodgers? -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-3">
                            Do you have any flatmates or lodgers? <span class="text-red-500">*</span>
                        </label>
                        <div class="flex space-x-6">
                            <label class="flex items-center">
                                <input type="radio" 
                                       name="flatmates_lodgers" 
                                       value="yes" 
                                       {{ old('flatmates_lodgers', $adoption->application_data['step4']['flatmates_lodgers'] ?? '') == 'yes' ? 'checked' : '' }}
                                       class="mr-2 text-purple-600 focus:ring-purple-500" 
                                       required>
                                <span class="text-gray-700">Yes</span>
                            </label>
                            <label class="flex items-center">
                                <input type="radio" 
                                       name="flatmates_lodgers" 
                                       value="no" 
                                       {{ old('flatmates_lodgers', $adoption->application_data['step4']['flatmates_lodgers'] ?? '') == 'no' ? 'checked' : '' }}
                                       class="mr-2 text-purple-600 focus:ring-purple-500" 
                                       required>
                                <span class="text-gray-700">No</span>
                            </label>
                        </div>
                        @error('flatmates_lodgers')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Navigation Buttons -->
                <div class="flex justify-between mt-8">
                    <a href="{{ route('adoption.step3', $pet) }}" 
                       class="bg-gray-300 hover:bg-gray-400 text-gray-700 px-6 py-3 rounded-lg font-medium transition-colors">
                        ← Back
                    </a>
                    <button type="submit" 
                            class="bg-purple-600 hover:bg-purple-700 text-white px-8 py-3 rounded-lg font-medium transition-colors">
                        Continue →
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection