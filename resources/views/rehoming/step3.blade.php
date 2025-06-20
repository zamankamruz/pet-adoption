<?php
// File: step3.blade.php
// Path: /resources/views/rehoming/step3.blade.php
?>

@extends('layouts.app')

@section('title', 'Rehoming Step 3 - Furry Friends')

@section('content')
<div class="min-h-screen bg-gray-50">
    <!-- Header -->
    <div class="bg-white shadow-sm border-b border-gray-200">
        <div class="max-w-4xl mx-auto px-4 py-8">
            <div class="text-sm text-gray-500 mb-4">
                <a href="{{ route('home') }}" class="text-purple-600 hover:text-purple-700">Home</a> > 
                <a href="{{ route('rehoming.index') }}" class="text-purple-600 hover:text-purple-700">Rehoming</a> > 
                Step 3 of 3
            </div>
            
            <h1 class="text-3xl font-bold text-gray-900 mb-2">Contact Preferences & Review</h1>
            <p class="text-lg text-gray-600">Almost done! Set your contact preferences and review your listing.</p>
        </div>
    </div>

    <!-- Content -->
    <div class="max-w-4xl mx-auto px-4 py-8">
        <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
            <div class="p-8">
                <!-- Progress Bar -->
                <div class="mb-8">
                    <div class="bg-gray-200 h-2 rounded-full overflow-hidden">
                        <div class="bg-gradient-to-r from-purple-500 to-purple-600 h-full rounded-full transition-all duration-300" style="width: 100%"></div>
                    </div>
                    <p class="text-center text-gray-500 text-sm mt-3">Step 3 of 3: Contact Preferences</p>
                </div>

                <!-- Tips Box -->
                <div class="bg-green-50 border border-green-200 rounded-xl p-6 mb-8">
                    <h4 class="flex items-center text-green-900 font-semibold mb-4">
                        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                        </svg>
                        Final Step Tips
                    </h4>
                    <ul class="space-y-2">
                        <li class="flex items-start text-green-800">
                            <svg class="w-4 h-4 mr-2 mt-1 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                            </svg>
                            Choose how you'd like potential adopters to contact you
                        </li>
                        <li class="flex items-start text-green-800">
                            <svg class="w-4 h-4 mr-2 mt-1 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                            </svg>
                            You can always update your preferences later
                        </li>
                        <li class="flex items-start text-green-800">
                            <svg class="w-4 h-4 mr-2 mt-1 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                            </svg>
                            We'll review your listing and get back to you within 24 hours
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

                <form method="POST" action="{{ route('rehoming.step3.store') }}" id="step3Form">
                    @csrf

                    <!-- Contact Preferences -->
                    <div class="mb-8">
                        <h3 class="text-xl font-bold text-gray-900 mb-6 pb-3 border-b border-gray-200">How would you like to be contacted?</h3>

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <label class="relative flex flex-col p-6 border-2 border-gray-200 rounded-xl hover:border-purple-300 transition-colors cursor-pointer group">
                                <input type="checkbox" name="contact_preferences[]" value="email" 
                                       {{ in_array('email', old('contact_preferences', $rehoming->contact_preferences ?? [])) ? 'checked' : '' }}
                                       class="sr-only peer">
                                <div class="flex flex-col items-center text-center">
                                    <div class="w-16 h-16 bg-blue-100 group-hover:bg-blue-200 peer-checked:bg-blue-500 rounded-full flex items-center justify-center mb-4 transition-colors">
                                        <svg class="w-8 h-8 text-blue-600 peer-checked:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                        </svg>
                                    </div>
                                    <h4 class="font-semibold text-gray-900 mb-2 peer-checked:text-purple-600">Email</h4>
                                    <p class="text-sm text-gray-600">Receive inquiries via email</p>
                                </div>
                                <div class="absolute top-3 right-3 w-6 h-6 border-2 border-gray-300 rounded-full peer-checked:bg-purple-500 peer-checked:border-purple-500 flex items-center justify-center">
                                    <svg class="w-4 h-4 text-white opacity-0 peer-checked:opacity-100" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                            </label>

                            <label class="relative flex flex-col p-6 border-2 border-gray-200 rounded-xl hover:border-purple-300 transition-colors cursor-pointer group">
                                <input type="checkbox" name="contact_preferences[]" value="phone" 
                                       {{ in_array('phone', old('contact_preferences', $rehoming->contact_preferences ?? [])) ? 'checked' : '' }}
                                       class="sr-only peer">
                                <div class="flex flex-col items-center text-center">
                                    <div class="w-16 h-16 bg-green-100 group-hover:bg-green-200 peer-checked:bg-green-500 rounded-full flex items-center justify-center mb-4 transition-colors">
                                        <svg class="w-8 h-8 text-green-600 peer-checked:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                        </svg>
                                    </div>
                                    <h4 class="font-semibold text-gray-900 mb-2 peer-checked:text-purple-600">Phone Call</h4>
                                    <p class="text-sm text-gray-600">Direct phone conversations</p>
                                </div>
                                <div class="absolute top-3 right-3 w-6 h-6 border-2 border-gray-300 rounded-full peer-checked:bg-purple-500 peer-checked:border-purple-500 flex items-center justify-center">
                                    <svg class="w-4 h-4 text-white opacity-0 peer-checked:opacity-100" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                            </label>

                            <label class="relative flex flex-col p-6 border-2 border-gray-200 rounded-xl hover:border-purple-300 transition-colors cursor-pointer group">
                                <input type="checkbox" name="contact_preferences[]" value="text" 
                                       {{ in_array('text', old('contact_preferences', $rehoming->contact_preferences ?? [])) ? 'checked' : '' }}
                                       class="sr-only peer">
                                <div class="flex flex-col items-center text-center">
                                    <div class="w-16 h-16 bg-purple-100 group-hover:bg-purple-200 peer-checked:bg-purple-500 rounded-full flex items-center justify-center mb-4 transition-colors">
                                        <svg class="w-8 h-8 text-purple-600 peer-checked:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                                        </svg>
                                    </div>
                                    <h4 class="font-semibold text-gray-900 mb-2 peer-checked:text-purple-600">Text Message</h4>
                                    <p class="text-sm text-gray-600">Quick text messages</p>
                                </div>
                                <div class="absolute top-3 right-3 w-6 h-6 border-2 border-gray-300 rounded-full peer-checked:bg-purple-500 peer-checked:border-purple-500 flex items-center justify-center">
                                    <svg class="w-4 h-4 text-white opacity-0 peer-checked:opacity-100" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                            </label>
                        </div>

                        <p class="text-sm text-gray-500 mt-4">
                            <span class="text-red-500">*</span> Select at least one contact method. You can choose multiple options.
                        </p>
                        @error('contact_preferences')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Review Section -->
                    <div class="mb-8">
                        <h3 class="text-xl font-bold text-gray-900 mb-6 pb-3 border-b border-gray-200">Review Your Information</h3>

                        <div class="bg-gray-50 rounded-xl p-6">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <h4 class="font-semibold text-gray-700 mb-3">Pet Information</h4>
                                    <dl class="space-y-2">
                                        <div class="flex justify-between">
                                            <dt class="text-sm text-gray-600">Name:</dt>
                                            <dd class="text-sm font-medium text-gray-900">{{ $rehoming->pet_name }}</dd>
                                        </div>
                                        <div class="flex justify-between">
                                            <dt class="text-sm text-gray-600">Species:</dt>
                                            <dd class="text-sm font-medium text-gray-900">{{ ucfirst($rehoming->species) }}</dd>
                                        </div>
                                        <div class="flex justify-between">
                                            <dt class="text-sm text-gray-600">Breed:</dt>
                                            <dd class="text-sm font-medium text-gray-900">{{ $rehoming->breed }}</dd>
                                        </div>
                                        <div class="flex justify-between">
                                            <dt class="text-sm text-gray-600">Age:</dt>
                                            <dd class="text-sm font-medium text-gray-900">{{ $rehoming->age }}</dd>
                                        </div>
                                        <div class="flex justify-between">
                                            <dt class="text-sm text-gray-600">Gender:</dt>
                                            <dd class="text-sm font-medium text-gray-900">{{ ucfirst($rehoming->gender) }}</dd>
                                        </div>
                                        <div class="flex justify-between">
                                            <dt class="text-sm text-gray-600">Size:</dt>
                                            <dd class="text-sm font-medium text-gray-900">{{ ucfirst($rehoming->size) }}</dd>
                                        </div>
                                    </dl>
                                </div>

                                <div>
                                    <h4 class="font-semibold text-gray-700 mb-3">Health & Behavior</h4>
                                    <dl class="space-y-2">
                                        <div class="flex justify-between">
                                            <dt class="text-sm text-gray-600">Vaccinations:</dt>
                                            <dd class="text-sm font-medium text-gray-900">{{ ucfirst(str_replace('_', ' ', $rehoming->vaccination_status)) }}</dd>
                                        </div>
                                        <div class="flex justify-between">
                                            <dt class="text-sm text-gray-600">Spayed/Neutered:</dt>
                                            <dd class="text-sm font-medium text-gray-900">{{ $rehoming->spayed_neutered ? 'Yes' : 'No' }}</dd>
                                        </div>
                                        <div class="flex justify-between">
                                            <dt class="text-sm text-gray-600">House Trained:</dt>
                                            <dd class="text-sm font-medium text-gray-900">{{ $rehoming->house_trained ? 'Yes' : 'No' }}</dd>
                                        </div>
                                        <div class="flex justify-between">
                                            <dt class="text-sm text-gray-600">Good with Kids:</dt>
                                            <dd class="text-sm font-medium text-gray-900">{{ $rehoming->good_with_kids ? 'Yes' : 'No' }}</dd>
                                        </div>
                                        <div class="flex justify-between">
                                            <dt class="text-sm text-gray-600">Good with Pets:</dt>
                                            <dd class="text-sm font-medium text-gray-900">{{ $rehoming->good_with_pets ? 'Yes' : 'No' }}</dd>
                                        </div>
                                    </dl>
                                </div>
                            </div>

                            <div class="mt-6 pt-6 border-t border-gray-200">
                                <h4 class="font-semibold text-gray-700 mb-2">Description</h4>
                                <p class="text-sm text-gray-600">{{ Str::limit($rehoming->description, 200) }}</p>
                            </div>

                            <div class="mt-4">
                                <h4 class="font-semibold text-gray-700 mb-2">Reason for Rehoming</h4>
                                <p class="text-sm text-gray-600">{{ Str::limit($rehoming->reason_for_rehoming, 200) }}</p>
                            </div>
                        </div>

                        <div class="mt-4 text-center">
                            <a href="{{ route('rehoming.step2') }}" class="text-purple-600 hover:text-purple-700 text-sm font-medium">
                                Need to make changes? Go back to edit your information
                            </a>
                        </div>
                    </div>

                    <!-- Terms and Conditions -->
                    <div class="mb-8">
                        <div class="bg-yellow-50 border border-yellow-200 rounded-xl p-6">
                            <h4 class="font-semibold text-yellow-900 mb-3">Important Information</h4>
                            <ul class="space-y-2 text-sm text-yellow-800">
                                <li class="flex items-start">
                                    <svg class="w-4 h-4 mr-2 mt-0.5 text-yellow-600" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                                    </svg>
                                    Our team will review your listing within 24 hours
                                </li>
                                <li class="flex items-start">
                                    <svg class="w-4 h-4 mr-2 mt-0.5 text-yellow-600" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                                    </svg>
                                    We may contact you for additional information or photos
                                </li>
                                <li class="flex items-start">
                                    <svg class="w-4 h-4 mr-2 mt-0.5 text-yellow-600" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                                    </svg>
                                    All potential adopters will be screened by our team
                                </li>
                                <li class="flex items-start">
                                    <svg class="w-4 h-4 mr-2 mt-0.5 text-yellow-600" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                                    </svg>
                                    You maintain full control over the adoption process
                                </li>
                            </ul>
                        </div>
                    </div>

                    <!-- Form Buttons -->
                    <div class="flex flex-col sm:flex-row gap-4 justify-between pt-8 border-t border-gray-200">
                        <a href="{{ route('rehoming.step2') }}" 
                           class="inline-flex items-center justify-center px-6 py-3 border-2 border-gray-300 text-gray-700 font-semibold rounded-xl hover:bg-gray-50 transition-all duration-200">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                            </svg>
                            Back to Step 2
                        </a>
                        <button type="submit" 
                                class="inline-flex items-center justify-center px-8 py-3 bg-gradient-to-r from-green-500 to-green-600 text-white font-semibold rounded-xl hover:from-green-600 hover:to-green-700 transform hover:scale-105 transition-all duration-200">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            Submit for Review
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
    const form = document.getElementById('step3Form');
    
    form.addEventListener('submit', function(e) {
        const checkboxes = form.querySelectorAll('input[name="contact_preferences[]"]');
        const isChecked = Array.from(checkboxes).some(checkbox => checkbox.checked);
        
        if (!isChecked) {
            e.preventDefault();
            alert('Please select at least one contact method.');
            checkboxes[0].closest('.grid').scrollIntoView({ behavior: 'smooth', block: 'center' });
        }
    });
});
</script>
@endsection