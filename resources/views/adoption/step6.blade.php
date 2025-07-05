<?php
// File: step6.blade.php
// Path: /resources/views/adoption/step6.blade.php
?>

@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50">
        <!-- Progress Steps -->
    <div class="bg-white shadow-sm">
        <div class="max-w-4xl mx-auto px-4 py-6">
            <div class="flex items-center justify-center">
                <div class="flex items-center space-x-8">
                    <img src="{{ asset('images/step6.png') }}" alt="">

                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="max-w-4xl mx-auto px-4 py-8">
        <div class="bg-white rounded-xl shadow-sm border border-gray-200">
            
            <!-- Header -->
            <div class="px-8 py-6 border-b border-gray-200">
                <h1 class="text-2xl font-bold text-gray-900">Review Your Application</h1>
                <p class="mt-2 text-gray-600">Please review all details before submitting your adoption application.</p>
            </div>

            <div class="p-8">
                <!-- Data helpers -->
                @php
                    $app = $adoption->application_data ?? [];
                    $s1 = $app['step1'] ?? [];
                    $s2 = $app['step2'] ?? [];
                    $s3 = $app['step3'] ?? [];
                    $s4 = $app['step4'] ?? [];
                    $s5 = $app['step5'] ?? [];
                @endphp

                <!-- Applicant Summary -->
                <div class="mb-8">
                    <h2 class="text-lg font-semibold text-gray-900 mb-4">Applicant Information</h2>
                    <div class="bg-gray-50 rounded-lg p-6">
                        <div class="flex items-center space-x-4">
                            <div class="w-16 h-16 rounded-full overflow-hidden bg-gray-200">
                                <img src="{{ auth()->user()->avatar_url }}" alt="{{ auth()->user()->name }}" 
                                     class="w-full h-full object-cover">
                            </div>
                            <div>
                                <h3 class="font-medium text-gray-900">{{ auth()->user()->name }}</h3>
                                <p class="text-gray-600">{{ auth()->user()->email }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Application Details -->
                <div class="space-y-8">
                    
                    <!-- Step 1 - Address -->
                    <div class="border border-gray-200 rounded-lg p-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-4 flex items-center">
                            <div class="w-8 h-8 bg-purple-100 text-purple-600 rounded-full flex items-center justify-center text-sm font-medium mr-3">1</div>
                            Contact Details
                        </h3>
                        <div class="grid md:grid-cols-2 gap-4 text-sm">
                            <div>
                                <p class="font-medium text-gray-700 mb-1">Address</p>
                                <p class="text-gray-600">{{ $s1['address_line_1'] ?? 'Not provided' }}</p>
                                @if($s1['address_line_2'] ?? '')
                                    <p class="text-gray-600">{{ $s1['address_line_2'] }}</p>
                                @endif
                                <p class="text-gray-600">{{ $s1['town'] ?? '' }}, {{ $s1['postcode'] ?? '' }}</p>
                            </div>
                            <div>
                                <p class="font-medium text-gray-700 mb-1">Phone Numbers</p>
                                <p class="text-gray-600">Telephone: {{ $s1['telephone'] ?? 'Not provided' }}</p>
                                <p class="text-gray-600">Mobile: {{ $s1['mobile'] ?? 'Not provided' }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Step 2 - Home & Living -->
                    <div class="border border-gray-200 rounded-lg p-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-4 flex items-center">
                            <div class="w-8 h-8 bg-purple-100 text-purple-600 rounded-full flex items-center justify-center text-sm font-medium mr-3">2</div>
                            Home & Living Situation
                        </h3>
                        <div class="grid md:grid-cols-2 gap-4 text-sm">
                            <div class="space-y-2">
                                <div class="flex justify-between">
                                    <span class="font-medium text-gray-700">Garden:</span>
                                    <span class="text-gray-600">{{ ucfirst($s2['has_garden'] ?? 'Not specified') }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="font-medium text-gray-700">Living Situation:</span>
                                    <span class="text-gray-600">{{ str_replace('_', ' ', ucfirst($s2['living_situation'] ?? 'Not specified')) }}</span>
                                </div>
                            </div>
                            <div class="space-y-2">
                                <div class="flex justify-between">
                                    <span class="font-medium text-gray-700">Household:</span>
                                    <span class="text-gray-600">{{ str_replace('_', ' ', ucfirst($s2['household_setting'] ?? 'Not specified')) }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="font-medium text-gray-700">Activity Level:</span>
                                    <span class="text-gray-600">{{ str_replace('_', ' ', ucfirst($s2['activity_level'] ?? 'Not specified')) }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Step 3 - Home Photos -->
                    <div class="border border-gray-200 rounded-lg p-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-4 flex items-center">
                            <div class="w-8 h-8 bg-purple-100 text-purple-600 rounded-full flex items-center justify-center text-sm font-medium mr-3">3</div>
                            Home Photos
                            <span class="ml-2 text-sm font-normal text-gray-500">({{ count($s3['home_images'] ?? []) }}/4 uploaded)</span>
                        </h3>
                        @if(!empty($s3['home_images']))
                            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                                @foreach($s3['home_images'] ?? [] as $img)
                                    <div class="aspect-square rounded-lg overflow-hidden bg-gray-100">
                                        <img src="{{ asset('storage/'.$img) }}" 
                                             class="w-full h-full object-cover" 
                                             alt="Home photo">
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <p class="text-gray-500 text-sm">No photos uploaded</p>
                        @endif
                    </div>

                    <!-- Step 4 - Household Members -->
                    <div class="border border-gray-200 rounded-lg p-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-4 flex items-center">
                            <div class="w-8 h-8 bg-purple-100 text-purple-600 rounded-full flex items-center justify-center text-sm font-medium mr-3">4</div>
                            Household Members
                        </h3>
                        <div class="grid md:grid-cols-2 gap-4 text-sm">
                            <div class="space-y-2">
                                <div class="flex justify-between">
                                    <span class="font-medium text-gray-700">Adults:</span>
                                    <span class="text-gray-600">{{ $s4['number_of_adults'] ?? '0' }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="font-medium text-gray-700">Children:</span>
                                    <span class="text-gray-600">{{ $s4['number_of_children'] ?? '0' }}</span>
                                </div>
                                @if(!empty($s4['age_of_youngest_children']))
                                    <div class="flex justify-between">
                                        <span class="font-medium text-gray-700">Youngest Child Age:</span>
                                        <span class="text-gray-600">{{ $s4['age_of_youngest_children'] }}</span>
                                    </div>
                                @endif
                            </div>
                            <div class="space-y-2">
                                <div class="flex justify-between">
                                    <span class="font-medium text-gray-700">Visiting Children:</span>
                                    <span class="text-gray-600">{{ ucfirst($s4['visiting_children'] ?? 'No') }}</span>
                                </div>
                                @if(($s4['visiting_children'] ?? '') === 'yes' && !empty($s4['ages_of_visiting_children']))
                                    <div class="flex justify-between">
                                        <span class="font-medium text-gray-700">Visitor Ages:</span>
                                        <span class="text-gray-600">{{ $s4['ages_of_visiting_children'] }}</span>
                                    </div>
                                @endif
                                <div class="flex justify-between">
                                    <span class="font-medium text-gray-700">Flatmates/Lodgers:</span>
                                    <span class="text-gray-600">{{ ucfirst($s4['flatmates_lodgers'] ?? 'No') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Step 5 - Pets & Allergies -->
                    <div class="border border-gray-200 rounded-lg p-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-4 flex items-center">
                            <div class="w-8 h-8 bg-purple-100 text-purple-600 rounded-full flex items-center justify-center text-sm font-medium mr-3">5</div>
                            Pets & Allergies
                        </h3>
                        <div class="space-y-4 text-sm">
                            <div class="grid md:grid-cols-2 gap-4">
                                <div>
                                    <p class="font-medium text-gray-700 mb-1">Household Allergies</p>
                                    <p class="text-gray-600">{{ ucfirst($s5['household_allergies'] ?? 'No') }}</p>
                                    @if(($s5['household_allergies'] ?? '') === 'yes' && !empty($s5['allergy_details']))
                                        <p class="text-gray-500 mt-1 italic">{{ $s5['allergy_details'] }}</p>
                                    @endif
                                </div>
                                <div>
                                    <p class="font-medium text-gray-700 mb-1">Other Animals at Home</p>
                                    <p class="text-gray-600">{{ ucfirst($s5['other_animals'] ?? 'No') }}</p>
                                </div>
                            </div>

                            @if(($s5['other_animals'] ?? '') === 'yes')
                                <div class="bg-gray-50 rounded-lg p-4">
                                    <p class="font-medium text-gray-700 mb-2">Animal Details</p>
                                    <p class="text-gray-600 mb-2">{{ $s5['other_animals_details'] ?? 'Not specified' }}</p>
                                    <div class="grid grid-cols-2 gap-4 text-sm">
                                        <div class="flex justify-between">
                                            <span class="font-medium text-gray-700">Neutered:</span>
                                            <span class="text-gray-600">{{ ucfirst($s5['animals_neutered'] ?? 'Not specified') }}</span>
                                        </div>
                                        <div class="flex justify-between">
                                            <span class="font-medium text-gray-700">Vaccinated (12 months):</span>
                                            <span class="text-gray-600">{{ ucfirst($s5['animals_vaccinated'] ?? 'Not specified') }}</span>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            @if(!empty($s5['previous_pet_experience']))
                                <div>
                                    <p class="font-medium text-gray-700 mb-2">Previous Pet Experience & Home Plan</p>
                                    <div class="bg-gray-50 rounded-lg p-4">
                                        <p class="text-gray-600">{{ $s5['previous_pet_experience'] }}</p>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Form Submission -->
                <form action="{{ route('adoption.step6.store', $pet) }}" method="POST" class="mt-8">
                    @csrf

                    <!-- Terms Agreement -->
                    <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-6 mb-6">
                        <div class="flex items-start">
                            <input type="checkbox" id="terms_agreement" name="terms_agreement" value="1" 
                                   class="mt-1 h-4 w-4 text-purple-600 focus:ring-purple-500 border-gray-300 rounded" required>
                            <label for="terms_agreement" class="ml-3 text-sm text-gray-700 leading-relaxed">
                                I confirm that all information provided is accurate and complete. I agree to the
                                <a href="#" class="text-purple-600 hover:text-purple-700 underline font-medium">Terms of Service</a> and
                                <a href="#" class="text-purple-600 hover:text-purple-700 underline font-medium">Privacy Policy</a>.
                                I understand that providing false information may result in the rejection of my application.
                            </label>
                        </div>
                        @error('terms_agreement')
                            <p class="text-red-600 text-sm mt-2 ml-7">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex items-center justify-between pt-6 border-t border-gray-200">
                        <a href="{{ route('adoption.step5', $pet) }}"
                           class="inline-flex items-center px-6 py-3 border border-gray-300 shadow-sm text-sm font-medium rounded-lg text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500 transition-colors">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                            </svg>
                            Back to Previous Step
                        </a>
                        <button type="submit"
                                class="inline-flex items-center px-8 py-3 border border-transparent text-sm font-medium rounded-lg text-white bg-purple-600 hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500 shadow-sm transition-colors">
                            Submit Application
                            <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                            </svg>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection