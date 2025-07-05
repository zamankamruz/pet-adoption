<?php
// File: start.blade.php
// Path: /resources/views/adoption/start.blade.php
?>

@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50">
    <!-- Progress Steps -->
    <div class="bg-white shadow-sm">
        <div class="max-w-4xl mx-auto px-4 py-6">
            <div class="flex items-center justify-center">
                <div class="flex items-center space-x-8">
                    <img src="{{ asset('images/step.png') }}" alt="">
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="max-w-4xl mx-auto px-4 py-8">
        <div class="bg-white rounded-lg shadow-sm p-8">
            <!-- User Profile Section -->
            <div class="flex items-center mb-8">
                <div class="w-20 h-20 rounded-full overflow-hidden mr-6">
                    <img src="{{ auth()->user()->avatar_url }}" alt="{{ auth()->user()->name }}" class="w-full h-full object-cover">
                </div>
                <div>
                    <div class="mb-2">
                        <span class="text-gray-600">Email/Username:</span>
                        <span class="ml-2 font-medium">{{ auth()->user()->email }}</span>
                    </div>
                    <div class="mb-2">
                        <span class="text-gray-600">First name:</span>
                        <span class="ml-2 font-medium">{{ explode(' ', auth()->user()->name)[0] }}</span>
                    </div>
                    <div>
                        <span class="text-gray-600">Last name:</span>
                        <span class="ml-2 font-medium">{{ explode(' ', auth()->user()->name)[1] ?? '' }}</span>
                    </div>
                </div>
            </div>

            <!-- Terms and Agreement -->
            <div class="mb-8">
                <div class="flex items-start">
                    <input type="checkbox" id="terms" class="mt-1 mr-3" required>
                    <label for="terms" class="text-sm text-gray-600">
                        I have read and agree to the Terms and Privacy Policy!
                    </label>
                </div>
            </div>

            <!-- Start Info -->
            <div class="mb-8">
                <p class="text-gray-600">
                    To apply for <a href="{{ route('adoption.show', $pet) }}" class="text-purple-600 underline">Adopt a pet</a> 
                    you need to complete some fields. Click Start...
                </p>
            </div>

            <!-- Start Button -->
            <div class="flex justify-end">
                <a href="{{ route('adoption.step1', $pet) }}" 
                   class="bg-purple-600 hover:bg-purple-700 text-white px-8 py-3 rounded-lg font-semibold transition-colors"
                   onclick="return validateStart()">
                    Start
                </a>
            </div>
        </div>
    </div>
</div>

<script>
function validateStart() {
    const termsCheckbox = document.getElementById('terms');
    if (!termsCheckbox.checked) {
        alert('Please agree to the Terms and Privacy Policy to continue.');
        return false;
    }
    return true;
}
</script>
@endsection