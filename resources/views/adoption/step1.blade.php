<?php
// File: step1.blade.php 
// Path: /resources/views/adoption/step1.blade.php
?>

@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50">
    <!-- Progress Steps -->
    <div class="bg-white shadow-sm">
        <div class="max-w-4xl mx-auto px-4 py-6">
            <div class="flex items-center justify-center">
                <div class="flex items-center space-x-8">
                    <img src="{{ asset('images/step1.png') }}" alt="">
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="max-w-4xl mx-auto px-4 py-8">
        <div class="bg-white rounded-lg shadow-sm p-8">
            <p class="text-gray-600 mb-6">Please note, all these details must be complete in order to apply for adopt a pet.</p>

            <form action="{{ route('adoption.step1.store', $pet) }}" method="POST" id="addressForm">
                @csrf
                
                <div class="border-4 border-blue-200 rounded-lg p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Address Line 1 -->
                        <div>
                            <label for="address_line_1" class="block text-sm font-medium text-gray-700 mb-2">
                                Address line 1 <span class="text-red-500">*</span>
                            </label>
                            <input type="text" 
                                   id="address_line_1" 
                                   name="address_line_1" 
                                   value="{{ old('address_line_1', $adoption->application_data['step1']['address_line_1'] ?? '') }}"
                                   placeholder="Line1"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500"
                                   required>
                            @error('address_line_1')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Address Line 2 -->
                        <div>
                            <label for="address_line_2" class="block text-sm font-medium text-gray-700 mb-2">
                                Address line 2 <span class="text-red-500">*</span>
                            </label>
                            <input type="text" 
                                   id="address_line_2" 
                                   name="address_line_2" 
                                   value="{{ old('address_line_2', $adoption->application_data['step1']['address_line_2'] ?? '') }}"
                                   placeholder="Line2"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500">
                            @error('address_line_2')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Postcode -->
                        <div>
                            <label for="postcode" class="block text-sm font-medium text-gray-700 mb-2">
                                Postcode <span class="text-red-500">*</span>
                            </label>
                            <input type="text" 
                                   id="postcode" 
                                   name="postcode" 
                                   value="{{ old('postcode', $adoption->application_data['step1']['postcode'] ?? '') }}"
                                   placeholder="Postcode"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500"
                                   required>
                            @error('postcode')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Town -->
                        <div>
                            <label for="town" class="block text-sm font-medium text-gray-700 mb-2">
                                Town <span class="text-red-500">*</span>
                            </label>
                            <input type="text" 
                                   id="town" 
                                   name="town" 
                                   value="{{ old('town', $adoption->application_data['step1']['town'] ?? '') }}"
                                   placeholder="Town/City"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500"
                                   required>
                            @error('town')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Telephone Number -->
                    <div class="mt-6">
                        <label for="telephone" class="block text-sm font-medium text-gray-700 mb-2">
                            Telephone Number (either a landline or mobile number) <span class="text-red-500">*</span>
                        </label>
                        <input type="tel" 
                               id="telephone" 
                               name="telephone" 
                               value="{{ old('telephone', $adoption->application_data['step1']['telephone'] ?? '') }}"
                               placeholder="Landline Telephone"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500"
                               required>
                        @error('telephone')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Mobile -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
                        <div>
                            <label for="mobile" class="block text-sm font-medium text-gray-700 mb-2">
                                Mobile
                            </label>
                            <input type="tel" 
                                   id="mobile" 
                                   name="mobile" 
                                   value="{{ old('mobile', $adoption->application_data['step1']['mobile'] ?? '') }}"
                                   placeholder="Mobile"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500"
                                   required>
                            @error('mobile')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>


                    </div>
                </div>

                <!-- Navigation Buttons -->
                <div class="flex justify-between mt-8">
                    <a href="{{ route('adoption.start', $pet) }}" 
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

<!-- OTP Verification Modal -->
<div id="otpModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
    <div class="bg-white rounded-lg p-6 w-96 relative">
        <button type="button" id="closeModal" class="absolute top-2 right-2 text-gray-500 hover:text-gray-700">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </button>
        
        <h3 class="text-lg font-semibold text-center mb-4">OTP Verification</h3>
        <p class="text-sm text-gray-600 text-center mb-6">
            Please enter the OTP sent to your mobile number to complete your verification.
        </p>
        
        <div class="flex justify-center space-x-2 mb-6">
            <input type="text" class="w-12 h-12 text-center text-xl border-2 border-gray-300 rounded-lg focus:border-purple-500" maxlength="1">
            <input type="text" class="w-12 h-12 text-center text-xl border-2 border-gray-300 rounded-lg focus:border-purple-500" maxlength="1">
            <input type="text" class="w-12 h-12 text-center text-xl border-2 border-gray-300 rounded-lg focus:border-purple-500" maxlength="1">
            <input type="text" class="w-12 h-12 text-center text-xl border-2 border-gray-300 rounded-lg focus:border-purple-500" maxlength="1">
            <input type="text" class="w-12 h-12 text-center text-xl border-2 border-gray-300 rounded-lg focus:border-purple-500" maxlength="1">
            <input type="text" class="w-12 h-12 text-center text-xl border-2 border-gray-300 rounded-lg focus:border-purple-500" maxlength="1">
        </div>
        
        <p class="text-sm text-center text-gray-600 mb-4">
            Remaining time: <span id="timer" class="font-semibold">1:59</span>
        </p>
        
        <p class="text-sm text-center text-gray-600 mb-6">
            Don't get the code? <a href="#" class="text-purple-600 underline">Resend</a>
        </p>
        
        <button type="button" id="verifyBtn" class="w-full bg-purple-600 hover:bg-purple-700 text-white py-3 rounded-lg font-semibold">
            Verify
        </button>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const sendCodeBtn = document.getElementById('sendCodeBtn');
    const otpModal = document.getElementById('otpModal');
    const closeModal = document.getElementById('closeModal');
    const verifyBtn = document.getElementById('verifyBtn');
    const otpInputs = document.querySelectorAll('#otpModal input[type="text"]');

    sendCodeBtn.addEventListener('click', function() {
        const mobileInput = document.getElementById('mobile');
        if (!mobileInput.value) {
            alert('Please enter your mobile number first.');
            return;
        }

        // Send verification code
        fetch('{{ route("adoption.send-verification") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify({
                mobile: mobileInput.value
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                otpModal.classList.remove('hidden');
                startTimer();
                // For demo purposes, show the code
                alert('Verification code: ' + data.code);
            } else {
                alert('Failed to send verification code. Please try again.');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An error occurred. Please try again.');
        });
    });

    closeModal.addEventListener('click', function() {
        otpModal.classList.add('hidden');
    });

    // Handle OTP input
    otpInputs.forEach((input, index) => {
        input.addEventListener('input', function() {
            if (this.value.length === 1 && index < otpInputs.length - 1) {
                otpInputs[index + 1].focus();
            }
        });

        input.addEventListener('keydown', function(e) {
            if (e.key === 'Backspace' && this.value === '' && index > 0) {
                otpInputs[index - 1].focus();
            }
        });
    });

    verifyBtn.addEventListener('click', function() {
        const code = Array.from(otpInputs).map(input => input.value).join('');
        
        if (code.length !== 6) {
            alert('Please enter the complete 6-digit code.');
            return;
        }

        fetch('{{ route("adoption.verify-code") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify({
                code: code
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                document.getElementById('verification_code').value = code;
                otpModal.classList.add('hidden');
                alert('Mobile number verified successfully!');
            } else {
                alert(data.message || 'Invalid verification code. Please try again.');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An error occurred. Please try again.');
        });
    });

    function startTimer() {
        let time = 119; // 1:59
        const timer = document.getElementById('timer');
        
        const countdown = setInterval(function() {
            const minutes = Math.floor(time / 60);
            const seconds = time % 60;
            timer.textContent = `${minutes}:${seconds.toString().padStart(2, '0')}`;
            
            if (time <= 0) {
                clearInterval(countdown);
                timer.textContent = '0:00';
            }
            time--;
        }, 1000);
    }
});
</script>
@endsection