<?php
// File: step4.blade.php
// Path: /resources/views/rehoming/step4.blade.php
?>

@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50">
            <!-- Progress Steps -->
    <div class="bg-white shadow-sm">
        <div class="max-w-4xl mx-auto px-4 py-6">
            <div class="flex items-center justify-center">
                <div class="flex items-center space-x-8">
                    <img src="{{ asset('images/steps4.png') }}" alt="">
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="max-w-4xl mx-auto px-4 py-8">
        <div class="bg-white rounded-lg shadow-md p-8">
            <form method="POST" action="{{ route('rehoming.step4.store') }}">
                @csrf

                <!-- Characteristics Grid -->
                <div class="grid grid-cols-1 gap-6">
                    <!-- Shots up to date -->
                    <div class="flex items-center justify-between border-b pb-4">
                        <label class="text-gray-700 font-medium">Shots up to date</label>
                        <div class="flex space-x-6">
                            <label class="flex items-center">
                                <input type="radio" name="shots_up_to_date" value="yes" class="mr-2 text-purple-600 focus:ring-purple-500"
                                       {{ old('shots_up_to_date', $rehoming->shots_up_to_date) === 'yes' ? 'checked' : '' }} required>
                                <span class="text-gray-600">Yes</span>
                            </label>
                            <label class="flex items-center">
                                <input type="radio" name="shots_up_to_date" value="no" class="mr-2 text-purple-600 focus:ring-purple-500"
                                       {{ old('shots_up_to_date', $rehoming->shots_up_to_date) === 'no' ? 'checked' : '' }} required>
                                <span class="text-gray-600">No</span>
                            </label>
                            <label class="flex items-center">
                                <input type="radio" name="shots_up_to_date" value="unknown" class="mr-2 text-purple-600 focus:ring-purple-500"
                                       {{ old('shots_up_to_date', $rehoming->shots_up_to_date) === 'unknown' ? 'checked' : '' }} required>
                                <span class="text-gray-600">Unknown</span>
                            </label>
                        </div>
                    </div>

                    <!-- Microchipped -->
                    <div class="flex items-center justify-between border-b pb-4">
                        <label class="text-gray-700 font-medium">Microchipped</label>
                        <div class="flex space-x-6">
                            <label class="flex items-center">
                                <input type="radio" name="microchipped" value="yes" class="mr-2 text-purple-600 focus:ring-purple-500"
                                       {{ old('microchipped', $rehoming->microchipped) === 'yes' ? 'checked' : '' }} required>
                                <span class="text-gray-600">Yes</span>
                            </label>
                            <label class="flex items-center">
                                <input type="radio" name="microchipped" value="no" class="mr-2 text-purple-600 focus:ring-purple-500"
                                       {{ old('microchipped', $rehoming->microchipped) === 'no' ? 'checked' : '' }} required>
                                <span class="text-gray-600">No</span>
                            </label>
                            <label class="flex items-center">
                                <input type="radio" name="microchipped" value="unknown" class="mr-2 text-purple-600 focus:ring-purple-500"
                                       {{ old('microchipped', $rehoming->microchipped) === 'unknown' ? 'checked' : '' }} required>
                                <span class="text-gray-600">Unknown</span>
                            </label>
                        </div>
                    </div>

                    <!-- House-trained -->
                    <div class="flex items-center justify-between border-b pb-4">
                        <label class="text-gray-700 font-medium">House-trained</label>
                        <div class="flex space-x-6">
                            <label class="flex items-center">
                                <input type="radio" name="house_trained" value="yes" class="mr-2 text-purple-600 focus:ring-purple-500"
                                       {{ old('house_trained', $rehoming->house_trained) === 'yes' ? 'checked' : '' }} required>
                                <span class="text-gray-600">Yes</span>
                            </label>
                            <label class="flex items-center">
                                <input type="radio" name="house_trained" value="no" class="mr-2 text-purple-600 focus:ring-purple-500"
                                       {{ old('house_trained', $rehoming->house_trained) === 'no' ? 'checked' : '' }} required>
                                <span class="text-gray-600">No</span>
                            </label>
                            <label class="flex items-center">
                                <input type="radio" name="house_trained" value="unknown" class="mr-2 text-purple-600 focus:ring-purple-500"
                                       {{ old('house_trained', $rehoming->house_trained) === 'unknown' ? 'checked' : '' }} required>
                                <span class="text-gray-600">Unknown</span>
                            </label>
                        </div>
                    </div>

                    <!-- Good with Dogs -->
                    <div class="flex items-center justify-between border-b pb-4">
                        <label class="text-gray-700 font-medium">Good with Dogs</label>
                        <div class="flex space-x-6">
                            <label class="flex items-center">
                                <input type="radio" name="good_with_dogs" value="yes" class="mr-2 text-purple-600 focus:ring-purple-500"
                                       {{ old('good_with_dogs', $rehoming->good_with_dogs) === 'yes' ? 'checked' : '' }} required>
                                <span class="text-gray-600">Yes</span>
                            </label>
                            <label class="flex items-center">
                                <input type="radio" name="good_with_dogs" value="no" class="mr-2 text-purple-600 focus:ring-purple-500"
                                       {{ old('good_with_dogs', $rehoming->good_with_dogs) === 'no' ? 'checked' : '' }} required>
                                <span class="text-gray-600">No</span>
                            </label>
                            <label class="flex items-center">
                                <input type="radio" name="good_with_dogs" value="unknown" class="mr-2 text-purple-600 focus:ring-purple-500"
                                       {{ old('good_with_dogs', $rehoming->good_with_dogs) === 'unknown' ? 'checked' : '' }} required>
                                <span class="text-gray-600">Unknown</span>
                            </label>
                        </div>
                    </div>

                    <!-- Good with Cats -->
                    <div class="flex items-center justify-between border-b pb-4">
                        <label class="text-gray-700 font-medium">Good with Cats</label>
                        <div class="flex space-x-6">
                            <label class="flex items-center">
                                <input type="radio" name="good_with_cats" value="yes" class="mr-2 text-purple-600 focus:ring-purple-500"
                                       {{ old('good_with_cats', $rehoming->good_with_cats) === 'yes' ? 'checked' : '' }} required>
                                <span class="text-gray-600">Yes</span>
                            </label>
                            <label class="flex items-center">
                                <input type="radio" name="good_with_cats" value="no" class="mr-2 text-purple-600 focus:ring-purple-500"
                                       {{ old('good_with_cats', $rehoming->good_with_cats) === 'no' ? 'checked' : '' }} required>
                                <span class="text-gray-600">No</span>
                            </label>
                            <label class="flex items-center">
                                <input type="radio" name="good_with_cats" value="unknown" class="mr-2 text-purple-600 focus:ring-purple-500"
                                       {{ old('good_with_cats', $rehoming->good_with_cats) === 'unknown' ? 'checked' : '' }} required>
                                <span class="text-gray-600">Unknown</span>
                            </label>
                        </div>
                    </div>

                    <!-- Good with Kids -->
                    <div class="flex items-center justify-between border-b pb-4">
                        <label class="text-gray-700 font-medium">Good with Kids</label>
                        <div class="flex space-x-6">
                            <label class="flex items-center">
                                <input type="radio" name="good_with_kids" value="yes" class="mr-2 text-purple-600 focus:ring-purple-500"
                                       {{ old('good_with_kids', $rehoming->good_with_kids) === 'yes' ? 'checked' : '' }} required>
                                <span class="text-gray-600">Yes</span>
                            </label>
                            <label class="flex items-center">
                                <input type="radio" name="good_with_kids" value="no" class="mr-2 text-purple-600 focus:ring-purple-500"
                                       {{ old('good_with_kids', $rehoming->good_with_kids) === 'no' ? 'checked' : '' }} required>
                                <span class="text-gray-600">No</span>
                            </label>
                            <label class="flex items-center">
                                <input type="radio" name="good_with_kids" value="unknown" class="mr-2 text-purple-600 focus:ring-purple-500"
                                       {{ old('good_with_kids', $rehoming->good_with_kids) === 'unknown' ? 'checked' : '' }} required>
                                <span class="text-gray-600">Unknown</span>
                            </label>
                        </div>
                    </div>

                    <!-- Purebred -->
                    <div class="flex items-center justify-between border-b pb-4">
                        <label class="text-gray-700 font-medium">Purebred</label>
                        <div class="flex space-x-6">
                            <label class="flex items-center">
                                <input type="radio" name="purebred" value="yes" class="mr-2 text-purple-600 focus:ring-purple-500"
                                       {{ old('purebred', $rehoming->purebred) === 'yes' ? 'checked' : '' }} required>
                                <span class="text-gray-600">Yes</span>
                            </label>
                            <label class="flex items-center">
                                <input type="radio" name="purebred" value="no" class="mr-2 text-purple-600 focus:ring-purple-500"
                                       {{ old('purebred', $rehoming->purebred) === 'no' ? 'checked' : '' }} required>
                                <span class="text-gray-600">No</span>
                            </label>
                            <label class="flex items-center">
                                <input type="radio" name="purebred" value="unknown" class="mr-2 text-purple-600 focus:ring-purple-500"
                                       {{ old('purebred', $rehoming->purebred) === 'unknown' ? 'checked' : '' }} required>
                                <span class="text-gray-600">Unknown</span>
                            </label>
                        </div>
                    </div>

                    <!-- Has Special Needs -->
                    <div class="flex items-center justify-between border-b pb-4">
                        <label class="text-gray-700 font-medium">Has Special Needs</label>
                        <div class="flex space-x-6">
                            <label class="flex items-center">
                                <input type="radio" name="has_special_needs" value="yes" class="mr-2 text-purple-600 focus:ring-purple-500"
                                       {{ old('has_special_needs', $rehoming->has_special_needs) === 'yes' ? 'checked' : '' }} required>
                                <span class="text-gray-600">Yes</span>
                            </label>
                            <label class="flex items-center">
                                <input type="radio" name="has_special_needs" value="no" class="mr-2 text-purple-600 focus:ring-purple-500"
                                       {{ old('has_special_needs', $rehoming->has_special_needs) === 'no' ? 'checked' : '' }} required>
                                <span class="text-gray-600">No</span>
                            </label>
                            <label class="flex items-center">
                                <input type="radio" name="has_special_needs" value="unknown" class="mr-2 text-purple-600 focus:ring-purple-500"
                                       {{ old('has_special_needs', $rehoming->has_special_needs) === 'unknown' ? 'checked' : '' }} required>
                                <span class="text-gray-600">Unknown</span>
                            </label>
                        </div>
                    </div>

                    <!-- Has Behavioural Issues -->
                    <div class="flex items-center justify-between">
                        <label class="text-gray-700 font-medium">Has Behavioural Issues</label>
                        <div class="flex space-x-6">
                            <label class="flex items-center">
                                <input type="radio" name="has_behavioral_issues" value="yes" class="mr-2 text-purple-600 focus:ring-purple-500"
                                       {{ old('has_behavioral_issues', $rehoming->has_behavioral_issues) === 'yes' ? 'checked' : '' }} required>
                                <span class="text-gray-600">Yes</span>
                            </label>
                            <label class="flex items-center">
                                <input type="radio" name="has_behavioral_issues" value="no" class="mr-2 text-purple-600 focus:ring-purple-500"
                                       {{ old('has_behavioral_issues', $rehoming->has_behavioral_issues) === 'no' ? 'checked' : '' }} required>
                                <span class="text-gray-600">No</span>
                            </label>
                            <label class="flex items-center">
                                <input type="radio" name="has_behavioral_issues" value="unknown" class="mr-2 text-purple-600 focus:ring-purple-500"
                                       {{ old('has_behavioral_issues', $rehoming->has_behavioral_issues) === 'unknown' ? 'checked' : '' }} required>
                                <span class="text-gray-600">Unknown</span>
                            </label>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex justify-between mt-8">
                    <a href="{{ route('rehoming.step3') }}" class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors">
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