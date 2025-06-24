<?php
// File: register.blade.php
// Path: /resources/views/auth/register.blade.php
?>

@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-purple-400 via-pink-300 to-blue-300 flex items-center justify-center p-4">
    <div class="bg-white rounded-3xl shadow-2xl w-[600px] h-[400px] overflow-hidden">
        <div class="flex h-full">
            <!-- Left Side - Image Section -->
            <div class="w-[250px] bg-gradient-to-br from-purple-100 to-blue-100 p-5 flex flex-col justify-center relative">
                <!-- Logo -->
                <div class="flex items-center mb-4">
                    <div class="w-8 h-8 bg-purple-600 rounded-full flex items-center justify-center mr-2">
                        <i class="fas fa-paw text-white text-sm"></i>
                    </div>
                    <span class="text-lg font-bold text-gray-800">Furry Friends</span>
                </div>

                <div class="text-center">
                    <!-- Dog Image -->
                    <div class="mb-3">
                        <img src="/images/dog-register.png" alt="Cute Dog" class="w-20 h-20 object-cover rounded-full mx-auto">
                    </div>
                    
                    <!-- Register Now Text -->
                    <h3 class="text-lg font-bold text-gray-800 mb-3">Register Now</h3>
                    
                    <!-- Bone Icon -->
                    <div class="flex justify-center">
                        <svg class="w-8 h-6 text-orange-400" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M7 4C5.9 4 5 4.9 5 6s.9 2 2 2c.4 0 .7-.1 1-.3L16 15.7c-.3.3-.3.7-.3 1 0 1.1.9 2 2 2s2-.9 2-2-.9-2-2-2c-.4 0-.7.1-1 .3L8 7.3C8.3 7 8.3 6.6 8.3 6.3 8.3 5.2 7.4 4.3 6.3 4.3S4.3 5.2 4.3 6.3 5.2 8.3 6.3 8.3c.4 0 .7-.1 1-.3L15.3 16c-.3.3-.3.7-.3 1 0 1.1.9 2 2 2s2-.9 2-2-.9-2-2-2c-.4 0-.7.1-1 .3L8.3 7.3C8.6 7 8.6 6.6 8.6 6.3 8.6 5.2 7.7 4.3 6.6 4.3S4.6 5.2 4.6 6.3 5.5 8.3 6.6 8.3z"/>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Right Side - Form Section -->
            <div class="w-[350px] p-5 flex flex-col justify-center">
                <!-- Form Header -->
                <h2 class="text-xl font-semibold text-gray-800 mb-3">Create your account</h2>

                <!-- Error Messages -->
                @if ($errors->any())
                    <div class="bg-red-50 border border-red-200 text-red-700 px-3 py-2 rounded-lg mb-3 text-xs">
                        <ul class="space-y-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- Registration Form -->
                <form method="POST" action="{{ route('register') }}" id="registerForm" class="space-y-2.5">
                    @csrf

                    <!-- Full Name -->
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-user text-gray-400 text-sm"></i>
                        </div>
                        <input id="name" type="text" 
                               class="w-full pl-9 pr-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500 @error('name') border-red-500 @enderror" 
                               name="name" 
                               value="{{ old('name') }}" 
                               required 
                               autocomplete="name" 
                               autofocus
                               placeholder="Full Name">
                        @error('name')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-envelope text-gray-400 text-sm"></i>
                        </div>
                        <input id="email" type="email" 
                               class="w-full pl-9 pr-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500 @error('email') border-red-500 @enderror" 
                               name="email" 
                               value="{{ old('email') }}" 
                               required 
                               autocomplete="email"
                               placeholder="E-mail">
                        @error('email')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-lock text-gray-400 text-sm"></i>
                        </div>
                        <input id="password" type="password" 
                               class="w-full pl-9 pr-10 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500 @error('password') border-red-500 @enderror" 
                               name="password" 
                               required 
                               autocomplete="new-password"
                               placeholder="Password">
                        <button type="button" class="absolute inset-y-0 right-0 pr-3 flex items-center" onclick="togglePassword()">
                            <i class="fas fa-eye text-gray-400 text-sm" id="toggleIcon"></i>
                        </button>
                        @error('password')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Terms Checkbox -->
                    <div class="flex items-center space-x-2">
                        <input class="w-3 h-3 text-purple-600 border-gray-300 rounded focus:ring-purple-500" 
                               type="checkbox" name="terms" id="terms" required>
                        <label for="terms" class="text-xs text-gray-600">
                            I agree to all <a href="/terms" target="_blank" class="text-purple-600 hover:underline">Terms & Conditions</a>
                        </label>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" 
                            class="w-full bg-gradient-to-r from-purple-600 to-indigo-600 text-white py-2 px-4 rounded-lg text-sm font-medium hover:from-purple-700 hover:to-indigo-700 focus:ring-2 focus:ring-purple-500 focus:ring-offset-2 transition-all duration-200 disabled:opacity-50 flex items-center justify-center space-x-2" 
                            id="registerButton">
                        <span class="button-text">Create Account</span>
                        <div class="loading-spinner hidden w-4 h-4 border-2 border-white border-t-transparent rounded-full animate-spin"></div>
                    </button>
                </form>

                <!-- Social Login -->
                <div class="mt-3">
                    <div class="relative">
                        <div class="absolute inset-0 flex items-center">
                            <div class="w-full border-t border-gray-300"></div>
                        </div>
                        <div class="relative flex justify-center text-xs">
                            <span class="px-3 bg-white text-gray-500">Or Sign Up with</span>
                        </div>
                    </div>

                    <div class="mt-2 flex space-x-3">
                        <a href="{{ route('auth.google') }}" 
                           class="flex-1 flex items-center justify-center px-3 py-1.5 border border-gray-300 rounded-lg shadow-sm text-xs font-medium text-gray-700 bg-white hover:bg-gray-50 transition-colors">
                            <svg class="w-4 h-4 mr-1" viewBox="0 0 24 24">
                                <path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/>
                                <path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/>
                                <path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z"/>
                                <path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"/>
                            </svg>
                        </a>
                        <a href="{{ route('auth.facebook') }}" 
                           class="flex-1 flex items-center justify-center px-3 py-1.5 border border-gray-300 rounded-lg shadow-sm text-xs font-medium text-gray-700 bg-white hover:bg-gray-50 transition-colors">
                            <svg class="w-4 h-4 mr-1 text-blue-600" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                            </svg>
                        </a>
                    </div>
                </div>

                <!-- Login Link -->
                <div class="text-center mt-2">
                    <p class="text-xs text-gray-600">
                        Already have an account? 
                        <a href="{{ route('login') }}" class="text-purple-600 hover:underline font-medium">Sign in</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function togglePassword() {
    const passwordInput = document.getElementById('password');
    const toggleIcon = document.getElementById('toggleIcon');
    
    if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        toggleIcon.classList.remove('fa-eye');
        toggleIcon.classList.add('fa-eye-slash');
    } else {
        passwordInput.type = 'password';
        toggleIcon.classList.remove('fa-eye-slash');
        toggleIcon.classList.add('fa-eye');
    }
}

document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('registerForm');
    const button = document.getElementById('registerButton');
    const buttonText = button.querySelector('.button-text');
    const spinner = button.querySelector('.loading-spinner');
    const emailInput = document.getElementById('email');

    // Form submission loading state
    form.addEventListener('submit', function() {
        button.disabled = true;
        buttonText.classList.add('hidden');
        spinner.classList.remove('hidden');
    });

    // Email validation
    emailInput.addEventListener('blur', function() {
        const email = this.value;
        if (email) {
            fetch('/api/check-email', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({ email: email })
            })
            .then(response => response.json())
            .then(data => {
                if (!data.available) {
                    emailInput.classList.remove('border-gray-300');
                    emailInput.classList.add('border-red-500');
                    
                    let feedback = emailInput.parentNode.querySelector('.email-feedback');
                    if (!feedback) {
                        feedback = document.createElement('p');
                        feedback.className = 'email-feedback text-red-500 text-xs mt-1';
                        emailInput.parentNode.appendChild(feedback);
                    }
                    feedback.textContent = 'This email is already registered';
                } else {
                    emailInput.classList.remove('border-red-500');
                    emailInput.classList.add('border-green-500');
                    
                    const feedback = emailInput.parentNode.querySelector('.email-feedback');
                    if (feedback) {
                        feedback.remove();
                    }
                }
            })
            .catch(error => {
                console.log('Email check failed:', error);
            });
        }
    });
});
</script>
@endsection