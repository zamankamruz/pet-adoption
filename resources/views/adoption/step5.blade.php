<?php
// File: step5.blade.php
// Path: /resources/views/adoption/step5.blade.php
?>

@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50">
    <!-- Progress Steps -->
    <div class="bg-white shadow-sm">
        <div class="max-w-4xl mx-auto px-4 py-6">
            <div class="flex items-center justify-center">
                <div class="flex items-center space-x-8">
                    <!-- All previous steps completed -->
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

                    <div class="flex items-center">
                        <div class="w-10 h-10 bg-purple-600 text-white rounded-full flex items-center justify-center font-semibold">
                            ✓
                        </div>
                        <span class="ml-2 text-sm font-medium text-purple-600">Roommate</span>
                    </div>

                    <div class="w-8 h-0.5 bg-purple-600"></div>

                    <!-- Other Animals (Current) -->
                    <div class="flex items-center">
                        <div class="w-10 h-10 bg-green-500 text-white rounded-full flex items-center justify-center font-semibold">
                            6
                        </div>
                        <span class="ml-2 text-sm font-medium text-green-500">Other Animals</span>
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
            <form action="{{ route('adoption.step5.store', $pet) }}" method="POST">
                @csrf
                
                <div class="space-y-6">
                    <!-- Does anyone in the household have any allergies to pets? -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-3">
                            Does anyone in the household have any allergies to pets? <span class="text-red-500">*</span>
                        </label>
                        <div class="flex space-x-6">
                            <label class="flex items-center">
                                <input type="radio" 
                                       name="household_allergies" 
                                       value="yes" 
                                       {{ old('household_allergies', $adoption->application_data['step5']['household_allergies'] ?? '') == 'yes' ? 'checked' : '' }}
                                       class="mr-2 text-purple-600 focus:ring-purple-500" 
                                       required>
                                <span class="text-gray-700">Yes</span>
                            </label>
                            <label class="flex items-center">
                                <input type="radio" 
                                       name="household_allergies" 
                                       value="no" 
                                       {{ old('household_allergies', $adoption->application_data['step5']['household_allergies'] ?? '') == 'no' ? 'checked' : '' }}
                                       class="mr-2 text-purple-600 focus:ring-purple-500" 
                                       required>
                                <span class="text-gray-700">No</span>
                            </label>
                        </div>
                        @error('household_allergies')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Allergy details -->
                    <div id="allergyDetails" class="hidden">
                        <label for="allergy_details" class="block text-sm font-medium text-gray-700 mb-2">
                            Please provide details about the allergies
                        </label>
                        <textarea name="allergy_details" 
                                  id="allergy_details"
                                  rows="3"
                                  class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500"
                                  placeholder="Please describe the allergies and how they are managed">{{ old('allergy_details', $adoption->application_data['step5']['allergy_details'] ?? '') }}</textarea>
                        @error('allergy_details')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Are there any other animals at your home? -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-3">
                            Are there any other animals at your home? <span class="text-red-500">*</span>
                        </label>
                        <div class="flex space-x-6">
                            <label class="flex items-center">
                                <input type="radio" 
                                       name="other_animals" 
                                       value="yes" 
                                       {{ old('other_animals', $adoption->application_data['step5']['other_animals'] ?? '') == 'yes' ? 'checked' : '' }}
                                       class="mr-2 text-purple-600 focus:ring-purple-500" 
                                       required>
                                <span class="text-gray-700">Yes</span>
                            </label>
                            <label class="flex items-center">
                                <input type="radio" 
                                       name="other_animals" 
                                       value="no" 
                                       {{ old('other_animals', $adoption->application_data['step5']['other_animals'] ?? '') == 'no' ? 'checked' : '' }}
                                       class="mr-2 text-purple-600 focus:ring-purple-500" 
                                       required>
                                <span class="text-gray-700">No</span>
                            </label>
                        </div>
                        @error('other_animals')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- If yes, please state their species, age and gender -->
                    <div id="otherAnimalsDetails" class="hidden">
                        <label for="other_animals_details" class="block text-sm font-medium text-gray-700 mb-2">
                            If yes, please state their species, age and gender
                        </label>
                        <textarea name="other_animals_details" 
                                  id="other_animals_details"
                                  rows="3"
                                  class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500"
                                  placeholder="Please describe your other animals (species, age, gender, temperament)">{{ old('other_animals_details', $adoption->application_data['step5']['other_animals_details'] ?? '') }}</textarea>
                        @error('other_animals_details')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- If yes, are they neutered? -->
                    <div id="neuteredSection" class="hidden">
                        <label class="block text-sm font-medium text-gray-700 mb-3">
                            If yes, are they neutered? <span class="text-red-500">*</span>
                        </label>
                        <div class="flex space-x-6">
                            <label class="flex items-center">
                                <input type="radio" 
                                       name="animals_neutered" 
                                       value="yes" 
                                       {{ old('animals_neutered', $adoption->application_data['step5']['animals_neutered'] ?? '') == 'yes' ? 'checked' : '' }}
                                       class="mr-2 text-purple-600 focus:ring-purple-500">
                                <span class="text-gray-700">Yes</span>
                            </label>
                            <label class="flex items-center">
                                <input type="radio" 
                                       name="animals_neutered" 
                                       value="no" 
                                       {{ old('animals_neutered', $adoption->application_data['step5']['animals_neutered'] ?? '') == 'no' ? 'checked' : '' }}
                                       class="mr-2 text-purple-600 focus:ring-purple-500">
                                <span class="text-gray-700">No</span>
                            </label>
                            <label class="flex items-center">
                                <input type="radio" 
                                       name="animals_neutered" 
                                       value="not_applicable" 
                                       {{ old('animals_neutered', $adoption->application_data['step5']['animals_neutered'] ?? '') == 'not_applicable' ? 'checked' : '' }}
                                       class="mr-2 text-purple-600 focus:ring-purple-500">
                                <span class="text-gray-700">Not Applicable</span>
                            </label>
                        </div>
                        @error('animals_neutered')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- If yes, have they been vaccinated in the last 12 months? -->
                    <div id="vaccinatedSection" class="hidden">
                        <label class="block text-sm font-medium text-gray-700 mb-3">
                            If yes, have they been vaccinated in the last 12 months? <span class="text-red-500">*</span>
                        </label>
                        <div class="flex space-x-6">
                            <label class="flex items-center">
                                <input type="radio" 
                                       name="animals_vaccinated" 
                                       value="yes" 
                                       {{ old('animals_vaccinated', $adoption->application_data['step5']['animals_vaccinated'] ?? '') == 'yes' ? 'checked' : '' }}
                                       class="mr-2 text-purple-600 focus:ring-purple-500">
                                <span class="text-gray-700">Yes</span>
                            </label>
                            <label class="flex items-center">
                                <input type="radio" 
                                       name="animals_vaccinated" 
                                       value="no" 
                                       {{ old('animals_vaccinated', $adoption->application_data['step5']['animals_vaccinated'] ?? '') == 'no' ? 'checked' : '' }}
                                       class="mr-2 text-purple-600 focus:ring-purple-500">
                                <span class="text-gray-700">No</span>
                            </label>
                            <label class="flex items-center">
                                <input type="radio" 
                                       name="animals_vaccinated" 
                                       value="not_applicable" 
                                       {{ old('animals_vaccinated', $adoption->application_data['step5']['animals_vaccinated'] ?? '') == 'not_applicable' ? 'checked' : '' }}
                                       class="mr-2 text-purple-600 focus:ring-purple-500">
                                <span class="text-gray-700">Not Applicable</span>
                            </label>
                        </div>
                        @error('animals_vaccinated')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Please describe your experience of any previous pet ownership -->
                    <div>
                        <label for="previous_pet_experience" class="block text-sm font-medium text-gray-700 mb-2">
                            Please describe your experience of any previous pet ownership and tell us about the type of home you plan to offer your new pet
                        </label>
                        <textarea name="previous_pet_experience" 
                                  id="previous_pet_experience"
                                  rows="4"
                                  class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500"
                                  placeholder="Please describe your previous experience with pets and your plans for this pet">{{ old('previous_pet_experience', $adoption->application_data['step5']['previous_pet_experience'] ?? '') }}</textarea>
                        @error('previous_pet_experience')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Navigation Buttons -->
                <div class="flex justify-between mt-8">
                    <a href="{{ route('adoption.step4', $pet) }}" 
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

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Handle allergy details visibility
    const allergyInputs = document.querySelectorAll('input[name="household_allergies"]');
    const allergyDetails = document.getElementById('allergyDetails');

    allergyInputs.forEach(input => {
        input.addEventListener('change', function() {
            if (this.value === 'yes') {
                allergyDetails.classList.remove('hidden');
            } else {
                allergyDetails.classList.add('hidden');
            }
        });
    });

    // Handle other animals details visibility
    const animalInputs = document.querySelectorAll('input[name="other_animals"]');
    const animalDetails = document.getElementById('otherAnimalsDetails');
    const neuteredSection = document.getElementById('neuteredSection');
    const vaccinatedSection = document.getElementById('vaccinatedSection');

    animalInputs.forEach(input => {
        input.addEventListener('change', function() {
            if (this.value === 'yes') {
                animalDetails.classList.remove('hidden');
                neuteredSection.classList.remove('hidden');
                vaccinatedSection.classList.remove('hidden');
            } else {
                animalDetails.classList.add('hidden');
                neuteredSection.classList.add('hidden');
                vaccinatedSection.classList.add('hidden');
            }
        });
    });

    // Initialize visibility based on existing values
    const selectedAllergy = document.querySelector('input[name="household_allergies"]:checked');
    if (selectedAllergy && selectedAllergy.value === 'yes') {
        allergyDetails.classList.remove('hidden');
    }

    const selectedAnimals = document.querySelector('input[name="other_animals"]:checked');
    if (selectedAnimals && selectedAnimals.value === 'yes') {
        animalDetails.classList.remove('hidden');
        neuteredSection.classList.remove('hidden');
        vaccinatedSection.classList.remove('hidden');
    }
});
</script>
@endsection