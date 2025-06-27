<?php
// File: step2.blade.php
// Path: /resources/views/rehoming/step2.blade.php
?>

@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50">
            <!-- Progress Steps -->
    <div class="bg-white shadow-sm">
        <div class="max-w-4xl mx-auto px-4 py-6">
            <div class="flex items-center justify-center">
                <div class="flex items-center space-x-8">
                    <img src="{{ asset('images/steps2.png') }}" alt="">
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="max-w-4xl mx-auto px-4 py-8">
        <div class="bg-white rounded-lg shadow-md p-8">
            <form method="POST" action="{{ route('rehoming.step2.store') }}">
                @csrf

                <!-- Are you rehoming a dog or cat? -->
                <div class="mb-8">
                    <label class="block text-sm font-medium text-gray-700 mb-4">Are you rehoming a dog or cat?</label>
                    <div class="flex space-x-6">
                        <label class="flex items-center">
                            <input type="radio" name="species" value="dog" class="mr-3 text-purple-600 focus:ring-purple-500" 
                                   {{ old('species', $rehoming->species) === 'dog' ? 'checked' : '' }} required>
                            <span class="text-gray-700">Dog</span>
                        </label>
                        <label class="flex items-center">
                            <input type="radio" name="species" value="cat" class="mr-3 text-purple-600 focus:ring-purple-500"
                                   {{ old('species', $rehoming->species) === 'cat' ? 'checked' : '' }} required>
                            <span class="text-gray-700">Cat</span>
                        </label>
                    </div>
                    @error('species')
                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Is your pet spayed or neutered? -->
                <div class="mb-8">
                    <label class="block text-sm font-medium text-gray-700 mb-4">Is your pet spayed or neutered?</label>
                    <div class="flex space-x-6">
                        <label class="flex items-center">
                            <input type="radio" name="spayed_neutered" value="yes" class="mr-3 text-purple-600 focus:ring-purple-500"
                                   {{ old('spayed_neutered', $rehoming->spayed_neutered) === 'yes' ? 'checked' : '' }} required>
                            <span class="text-gray-700">Yes</span>
                        </label>
                        <label class="flex items-center">
                            <input type="radio" name="spayed_neutered" value="no" class="mr-3 text-purple-600 focus:ring-purple-500"
                                   {{ old('spayed_neutered', $rehoming->spayed_neutered) === 'no' ? 'checked' : '' }} required>
                            <span class="text-gray-700">No</span>
                        </label>
                    </div>
                    @error('spayed_neutered')
                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Why do you need to rehome your cat? -->
                <div class="mb-8">
                    <label class="block text-sm font-medium text-gray-700 mb-4">Why do you need to rehome your pet?</label>
                    <select name="reason_for_rehoming" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500" required>
                        <option value="">Pick a value</option>
                        <option value="moving" {{ old('reason_for_rehoming', $rehoming->reason_for_rehoming) === 'moving' ? 'selected' : '' }}>Moving/Relocation</option>
                        <option value="allergies" {{ old('reason_for_rehoming', $rehoming->reason_for_rehoming) === 'allergies' ? 'selected' : '' }}>Allergies</option>
                        <option value="financial" {{ old('reason_for_rehoming', $rehoming->reason_for_rehoming) === 'financial' ? 'selected' : '' }}>Financial Reasons</option>
                        <option value="time" {{ old('reason_for_rehoming', $rehoming->reason_for_rehoming) === 'time' ? 'selected' : '' }}>Not Enough Time</option>
                        <option value="behavior" {{ old('reason_for_rehoming', $rehoming->reason_for_rehoming) === 'behavior' ? 'selected' : '' }}>Behavioral Issues</option>
                        <option value="health" {{ old('reason_for_rehoming', $rehoming->reason_for_rehoming) === 'health' ? 'selected' : '' }}>Health Issues</option>
                        <option value="other" {{ old('reason_for_rehoming', $rehoming->reason_for_rehoming) === 'other' ? 'selected' : '' }}>Other</option>
                    </select>
                    @error('reason_for_rehoming')
                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <!-- How long are you able to keep your pet while we help find a suitable new home? -->
                <div class="mb-8">
                    <label class="block text-sm font-medium text-gray-700 mb-4">How long are you able to keep your pet while we help find a suitable new home?</label>
                    <select name="how_long_keep" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500" required>
                        <option value="">Please Select</option>
                        <option value="immediate" {{ old('how_long_keep', $rehoming->how_long_keep) === 'immediate' ? 'selected' : '' }}>Need to rehome immediately</option>
                        <option value="1_week" {{ old('how_long_keep', $rehoming->how_long_keep) === '1_week' ? 'selected' : '' }}>1 week</option>
                        <option value="2_weeks" {{ old('how_long_keep', $rehoming->how_long_keep) === '2_weeks' ? 'selected' : '' }}>2 weeks</option>
                        <option value="1_month" {{ old('how_long_keep', $rehoming->how_long_keep) === '1_month' ? 'selected' : '' }}>1 month</option>
                        <option value="2_months" {{ old('how_long_keep', $rehoming->how_long_keep) === '2_months' ? 'selected' : '' }}>2 months</option>
                        <option value="3_months" {{ old('how_long_keep', $rehoming->how_long_keep) === '3_months' ? 'selected' : '' }}>3+ months</option>
                    </select>
                    @error('how_long_keep')
                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Action Buttons -->
                <div class="flex justify-between">
                    <a href="{{ route('rehoming.step1') }}" class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors">
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