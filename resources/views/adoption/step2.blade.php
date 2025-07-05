<?php
// File: step2.blade.php
// Path: /resources/views/adoption/step2.blade.php
?>

@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50">
    <!-- Progress Steps -->
    <div class="bg-white shadow-sm">
        <div class="max-w-4xl mx-auto px-4 py-6">
            <div class="flex items-center justify-center">
                <div class="flex items-center space-x-8">
                    <img src="{{ asset('images/step2.png') }}" alt="">

                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="max-w-4xl mx-auto px-4 py-8">
        <div class="bg-white rounded-lg shadow-sm p-8">
            <form action="{{ route('adoption.step2.store', $pet) }}" method="POST">
                @csrf
                
                <div class="border-4 border-blue-200 rounded-lg p-6 space-y-6">
                    <!-- Do you have a garden? -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-3">
                            Do you have a garden? <span class="text-red-500">*</span>
                        </label>
                        <div class="flex space-x-6">
                            <label class="flex items-center">
                                <input type="radio" 
                                       name="has_garden" 
                                       value="yes" 
                                       {{ old('has_garden', $adoption->application_data['step2']['has_garden'] ?? '') == 'yes' ? 'checked' : '' }}
                                       class="mr-2 text-purple-600 focus:ring-purple-500" 
                                       required>
                                <span class="text-gray-700">Yes</span>
                            </label>
                            <label class="flex items-center">
                                <input type="radio" 
                                       name="has_garden" 
                                       value="no" 
                                       {{ old('has_garden', $adoption->application_data['step2']['has_garden'] ?? '') == 'no' ? 'checked' : '' }}
                                       class="mr-2 text-purple-600 focus:ring-purple-500" 
                                       required>
                                <span class="text-gray-700">No</span>
                            </label>
                        </div>
                        @error('has_garden')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Please describe your living/home situation -->
                    <div>
                        <label for="living_situation" class="block text-sm font-medium text-gray-700 mb-3">
                            Please describe your living/home situation <span class="text-red-500">*</span>
                        </label>
                        <select name="living_situation" 
                                id="living_situation"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500"
                                required>
                            <option value="">Please Select</option>
                            <option value="house_owner" {{ old('living_situation', $adoption->application_data['step2']['living_situation'] ?? '') == 'house_owner' ? 'selected' : '' }}>House Owner</option>
                            <option value="house_rental" {{ old('living_situation', $adoption->application_data['step2']['living_situation'] ?? '') == 'house_rental' ? 'selected' : '' }}>House Rental</option>
                            <option value="apartment_owner" {{ old('living_situation', $adoption->application_data['step2']['living_situation'] ?? '') == 'apartment_owner' ? 'selected' : '' }}>Apartment Owner</option>
                            <option value="apartment_rental" {{ old('living_situation', $adoption->application_data['step2']['living_situation'] ?? '') == 'apartment_rental' ? 'selected' : '' }}>Apartment Rental</option>
                            <option value="shared_housing" {{ old('living_situation', $adoption->application_data['step2']['living_situation'] ?? '') == 'shared_housing' ? 'selected' : '' }}>Shared Housing</option>
                            <option value="other" {{ old('living_situation', $adoption->application_data['step2']['living_situation'] ?? '') == 'other' ? 'selected' : '' }}>Other</option>
                        </select>
                        @error('living_situation')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Can you describe your household setting? -->
                    <div>
                        <label for="household_setting" class="block text-sm font-medium text-gray-700 mb-3">
                            Can you describe your household setting? <span class="text-red-500">*</span>
                        </label>
                        <select name="household_setting" 
                                id="household_setting"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500"
                                required>
                            <option value="">Please Select</option>
                            <option value="quiet_peaceful" {{ old('household_setting', $adoption->application_data['step2']['household_setting'] ?? '') == 'quiet_peaceful' ? 'selected' : '' }}>Quiet and Peaceful</option>
                            <option value="moderately_active" {{ old('household_setting', $adoption->application_data['step2']['household_setting'] ?? '') == 'moderately_active' ? 'selected' : '' }}>Moderately Active</option>
                            <option value="busy_active" {{ old('household_setting', $adoption->application_data['step2']['household_setting'] ?? '') == 'busy_active' ? 'selected' : '' }}>Busy and Active</option>
                            <option value="very_busy" {{ old('household_setting', $adoption->application_data['step2']['household_setting'] ?? '') == 'very_busy' ? 'selected' : '' }}>Very Busy</option>
                        </select>
                        @error('household_setting')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Can you describe the household's typical activity level? -->
                    <div>
                        <label for="activity_level" class="block text-sm font-medium text-gray-700 mb-3">
                            Can you describe the household's typical activity level? <span class="text-red-500">*</span>
                        </label>
                        <select name="activity_level" 
                                id="activity_level"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500"
                                required>
                            <option value="">Please Select</option>
                            <option value="low" {{ old('activity_level', $adoption->application_data['step2']['activity_level'] ?? '') == 'low' ? 'selected' : '' }}>Low Activity</option>
                            <option value="moderate" {{ old('activity_level', $adoption->application_data['step2']['activity_level'] ?? '') == 'moderate' ? 'selected' : '' }}>Moderate Activity</option>
                            <option value="high" {{ old('activity_level', $adoption->application_data['step2']['activity_level'] ?? '') == 'high' ? 'selected' : '' }}>High Activity</option>
                            <option value="very_high" {{ old('activity_level', $adoption->application_data['step2']['activity_level'] ?? '') == 'very_high' ? 'selected' : '' }}>Very High Activity</option>
                        </select>
                        @error('activity_level')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Navigation Buttons -->
                <div class="flex justify-between mt-8">
                    <a href="{{ route('adoption.step1', $pet) }}" 
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