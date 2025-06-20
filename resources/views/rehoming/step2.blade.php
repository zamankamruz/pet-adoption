<?php
// File: step2.blade.php
// Path: /resources/views/rehoming/step2.blade.php
?>

@extends('layouts.app')

@section('title', 'Rehoming Step 2 - Furry Friends')

@section('content')
<div class="min-h-screen bg-gray-50">
    <!-- Header -->
    <div class="bg-white shadow-sm border-b border-gray-200">
        <div class="max-w-4xl mx-auto px-4 py-8">
            <div class="text-sm text-gray-500 mb-4">
                <a href="{{ route('home') }}" class="text-purple-600 hover:text-purple-700">Home</a> > 
                <a href="{{ route('rehoming.index') }}" class="text-purple-600 hover:text-purple-700">Rehoming</a> > 
                Step 2 of 3
            </div>
            
            <h1 class="text-3xl font-bold text-gray-900 mb-2">Health & Behavior Information</h1>
            <p class="text-lg text-gray-600">Help us understand your pet's health status and behavioral traits.</p>
        </div>
    </div>

    <!-- Content -->
    <div class="max-w-4xl mx-auto px-4 py-8">
        <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
            <div class="p-8">
                <!-- Progress Bar -->
                <div class="mb-8">
                    <div class="bg-gray-200 h-2 rounded-full overflow-hidden">
                        <div class="bg-gradient-to-r from-purple-500 to-purple-600 h-full rounded-full transition-all duration-300" style="width: 66.66%"></div>
                    </div>
                    <p class="text-center text-gray-500 text-sm mt-3">Step 2 of 3: Health & Behavior</p>
                </div>

                <!-- Tips Box -->
                <div class="bg-blue-50 border border-blue-200 rounded-xl p-6 mb-8">
                    <h4 class="flex items-center text-blue-900 font-semibold mb-4">
                        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                        </svg>
                        Tips for Step 2
                    </h4>
                    <ul class="space-y-2">
                        <li class="flex items-start text-blue-800">
                            <svg class="w-4 h-4 mr-2 mt-1 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                            </svg>
                            Be honest about your pet's health and behavior - it helps find the right match
                        </li>
                        <li class="flex items-start text-blue-800">
                            <svg class="w-4 h-4 mr-2 mt-1 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                            </svg>
                            Include any special needs or medical requirements
                        </li>
                        <li class="flex items-start text-blue-800">
                            <svg class="w-4 h-4 mr-2 mt-1 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                            </svg>
                            Explain your reason for rehoming to help adopters understand
                        </li>
                    </ul>
                </div>

                @if ($errors->any())
                    <div class="bg-red-50 border border-red-200 rounded-xl p-4 mb-8">
                        <h4 class="text-red-800 font-semibold mb-2">Please correct the following errors:</h4>
                        <ul class="text-red-700 space-y-1">
                            @foreach ($errors->all() as $error)
                                <li class="flex items-start">
                                    <span class="mr-2">•</span>
                                    {{ $error }}
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('rehoming.step2.store') }}" id="step2Form">
                    @csrf

                    <!-- Reason for Rehoming -->
                    <div class="mb-8">
                        <h3 class="text-xl font-bold text-gray-900 mb-6 pb-3 border-b border-gray-200">Rehoming Information</h3>

                        <div class="mb-6">
                            <label for="reason_for_rehoming" class="block text-sm font-semibold text-gray-700 mb-3">
                                Reason for Rehoming <span class="text-red-500">*</span>
                            </label>
                            <textarea id="reason_for_rehoming" name="reason_for_rehoming" rows="4" 
                                      class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-purple-500 focus:ring-0 bg-gray-50 focus:bg-white transition-all duration-200 @error('reason_for_rehoming') border-red-300 bg-red-50 @enderror" 
                                      required placeholder="Please explain why you need to rehome your pet. This helps potential adopters understand the situation and provides important context.">{{ old('reason_for_rehoming', $rehoming->reason_for_rehoming ?? '') }}</textarea>
                            <p class="text-sm text-gray-500 mt-2">Minimum 20 characters. Be honest and detailed - this helps build trust with potential adopters.</p>
                            @error('reason_for_rehoming')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Health Information -->
                    <div class="mb-8">
                        <h3 class="text-xl font-bold text-gray-900 mb-6 pb-3 border-b border-gray-200">Health Information</h3>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                            <div>
                                <label for="vaccination_status" class="block text-sm font-semibold text-gray-700 mb-3">
                                    Vaccination Status <span class="text-red-500">*</span>
                                </label>
                                <select id="vaccination_status" name="vaccination_status" 
                                        class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-purple-500 focus:ring-0 bg-gray-50 focus:bg-white transition-all duration-200 @error('vaccination_status') border-red-300 bg-red-50 @enderror" required>
                                    <option value="">Select vaccination status</option>
                                    <option value="up_to_date" {{ old('vaccination_status', $rehoming->vaccination_status ?? '') === 'up_to_date' ? 'selected' : '' }}>Up to Date</option>
                                    <option value="partial" {{ old('vaccination_status', $rehoming->vaccination_status ?? '') === 'partial' ? 'selected' : '' }}>Partially Vaccinated</option>
                                    <option value="none" {{ old('vaccination_status', $rehoming->vaccination_status ?? '') === 'none' ? 'selected' : '' }}>Not Vaccinated</option>
                                    <option value="unknown" {{ old('vaccination_status', $rehoming->vaccination_status ?? '') === 'unknown' ? 'selected' : '' }}>Unknown</option>
                                </select>
                                @error('vaccination_status')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-3">Medical Status</label>
                                <div class="space-y-3">
                                    <label class="flex items-center">
                                        <input type="checkbox" name="spayed_neutered" value="1" 
                                               {{ old('spayed_neutered', $rehoming->spayed_neutered ?? false) ? 'checked' : '' }}
                                               class="w-5 h-5 text-purple-600 border-2 border-gray-300 rounded focus:ring-purple-500 focus:ring-2">
                                        <span class="ml-3 text-sm text-gray-700">Spayed/Neutered</span>
                                    </label>
                                    <label class="flex items-center">
                                        <input type="checkbox" name="house_trained" value="1" 
                                               {{ old('house_trained', $rehoming->house_trained ?? false) ? 'checked' : '' }}
                                               class="w-5 h-5 text-purple-600 border-2 border-gray-300 rounded focus:ring-purple-500 focus:ring-2">
                                        <span class="ml-3 text-sm text-gray-700">House Trained</span>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="mb-6">
                            <label for="special_needs" class="block text-sm font-semibold text-gray-700 mb-3">
                                Special Needs or Medical Requirements
                            </label>
                            <textarea id="special_needs" name="special_needs" rows="3" 
                                      class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-purple-500 focus:ring-0 bg-gray-50 focus:bg-white transition-all duration-200" 
                                      placeholder="Describe any special medical needs, medications, dietary restrictions, or ongoing health conditions...">{{ old('special_needs', $rehoming->special_needs ?? '') }}</textarea>
                            <p class="text-sm text-gray-500 mt-2">Leave blank if your pet has no special needs.</p>
                            @error('special_needs')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Behavior & Compatibility -->
                    <div class="mb-8">
                        <h3 class="text-xl font-bold text-gray-900 mb-6 pb-3 border-b border-gray-200">Behavior & Compatibility</h3>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <div class="space-y-4">
                                <h4 class="font-semibold text-gray-700">Good with:</h4>
                                <label class="flex items-center p-4 border-2 border-gray-200 rounded-xl hover:border-purple-300 transition-colors cursor-pointer">
                                    <input type="checkbox" name="good_with_kids" value="1" 
                                           {{ old('good_with_kids', $rehoming->good_with_kids ?? false) ? 'checked' : '' }}
                                           class="w-5 h-5 text-purple-600 border-2 border-gray-300 rounded focus:ring-purple-500 focus:ring-2">
                                    <div class="ml-3">
                                        <div class="flex items-center">
                                            <svg class="w-5 h-5 mr-2 text-blue-500" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3z"></path>
                                            </svg>
                                            <span class="font-medium text-gray-700">Children</span>
                                        </div>
                                        <p class="text-sm text-gray-500">Gets along well with kids of all ages</p>
                                    </div>
                                </label>
                                
                                <label class="flex items-center p-4 border-2 border-gray-200 rounded-xl hover:border-purple-300 transition-colors cursor-pointer">
                                    <input type="checkbox" name="good_with_pets" value="1" 
                                           {{ old('good_with_pets', $rehoming->good_with_pets ?? false) ? 'checked' : '' }}
                                           class="w-5 h-5 text-purple-600 border-2 border-gray-300 rounded focus:ring-purple-500 focus:ring-2">
                                    <div class="ml-3">
                                        <div class="flex items-center">
                                            <svg class="w-5 h-5 mr-2 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z"></path>
                                            </svg>
                                            <span class="font-medium text-gray-700">Other Pets</span>
                                        </div>
                                        <p class="text-sm text-gray-500">Friendly with dogs, cats, and other animals</p>
                                    </div>
                                </label>
                            </div>

                            <div class="bg-gray-50 rounded-xl p-6">
                                <h4 class="font-semibold text-gray-700 mb-3">Compatibility Note</h4>
                                <p class="text-sm text-gray-600 leading-relaxed">
                                    Being honest about your pet's compatibility helps ensure they find the right family environment. 
                                    If your pet isn't good with kids or other pets, that's perfectly fine - many families are looking 
                                    for a pet that will be their only companion.
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Form Buttons -->
                    <div class="flex flex-col sm:flex-row gap-4 justify-between pt-8 border-t border-gray-200">
                        <a href="{{ route('rehoming.step1') }}" 
                           class="inline-flex items-center justify-center px-6 py-3 border-2 border-gray-300 text-gray-700 font-semibold rounded-xl hover:bg-gray-50 transition-all duration-200">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                            </svg>
                            Back to Step 1
                        </a>
                        <button type="submit" 
                                class="inline-flex items-center justify-center px-8 py-3 bg-gradient-to-r from-purple-500 to-purple-600 text-white font-semibold rounded-xl hover:from-purple-600 hover:to-purple-700 transform hover:scale-105 transition-all duration-200">
                            Continue to Step 3
                            <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
// Form validation
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('step2Form');
    const reasonTextarea = document.getElementById('reason_for_rehoming');
    
    // Character count for reason
    function updateCharCount() {
        const count = reasonTextarea.value.length;
        const minLength = 20;
        
        if (count < minLength) {
            reasonTextarea.classList.add('border-red-300', 'bg-red-50');
            reasonTextarea.classList.remove('border-gray-200', 'bg-gray-50');
        } else {
            reasonTextarea.classList.remove('border-red-300', 'bg-red-50');
            reasonTextarea.classList.add('border-gray-200', 'bg-gray-50');
        }
    }
    
    reasonTextarea.addEventListener('input', updateCharCount);
    
    form.addEventListener('submit', function(e) {
        const requiredFields = form.querySelectorAll('[required]');
        let isValid = true;
        
        requiredFields.forEach(field => {
            if (!field.value.trim()) {
                field.classList.add('border-red-300', 'bg-red-50');
                isValid = false;
            } else {
                field.classList.remove('border-red-300', 'bg-red-50');
            }
        });
        
        if (!isValid) {
            e.preventDefault();
            document.querySelector('.border-red-300').scrollIntoView({ behavior: 'smooth', block: 'center' });
        }
    });
});
</script>
@endsection