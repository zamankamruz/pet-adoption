<?php
// File: login.blade.php
// Path: /resources/views/auth/login.blade.php
?>

@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-purple-400 via-pink-300 to-blue-300 flex items-center justify-center p-4">
    <div class="bg-white rounded-3xl shadow-2xl w-[450px] h-[400px] overflow-hidden">
        <div class="p-6 flex flex-col justify-center h-full">
            <!-- Logo -->
            <div class="flex items-center justify-center mb-4">
                <div class="w-8 h-8 bg-purple-600 rounded-full flex items-center justify-center mr-2">
                    <i class="fas fa-paw text-white text-sm"></i>
                </div>
                <span class="text-xl font-bold text-gray-800">Furry Friends</span>
            </div>

            <!-- Header -->
            <div class="text-center mb-4">
                <h2 class="text-xl font-semibold text-gray-800 mb-1">Sign In</h2>
                <p class="text-gray-600 text-sm">Welcome back to your account</p>
            </div>

            <!-- Status Messages -->
            @if (session('status'))
                <div class="bg-green-50 border border-green-200 text-green-700 px-3 py-2 rounded-lg mb-3 text-xs">
                    {{ session('status') }}
                </div>
            @endif

            <!-- Error Messages -->
            @if ($errors->any())
                <div class="bg-red-50 border border-red-200 text-red-700 px-3 py-2 rounded-lg mb-3 text-xs">
                    @foreach ($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </div>
            @endif

            <!-- Login Form -->
            <form method="POST" action="{{ route('login') }}" id="loginForm" class="space-y-3">
                @csrf

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
                           autofocus
                           placeholder="Enter your email">
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
                           class="w-full pl-9 pr-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500 @error('password') border-red-500 @enderror" 
                           name="password" 
                           required 
                           autocomplete="current-password"
                           placeholder="Enter your password">
                    @error('password')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Remember Me -->
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-2">
                        <input class="w-3 h-3 text-purple-600 border-gray-300 rounded focus:ring-purple-500" 
                               type="checkbox" name="remember" id="remember" 
                               {{ old('remember') ? 'checked' : '' }}>
                        <label for="remember" class="text-xs text-gray-600">Remember me</label>
                    </div>
                    <a href="{{ route('password.request') }}" class="text-xs text-purple-600 hover:underline">Forgot password?</a>
                </div>

                <!-- Submit Button -->
                <button type="submit" 
                        class="w-full bg-gradient-to-r from-purple-600 to-indigo-600 text-white py-2 px-4 rounded-lg text-sm font-medium hover:from-purple-700 hover:to-indigo-700 focus:ring-2 focus:ring-purple-500 focus:ring-offset-2 transition-all duration-200 disabled:opacity-50 flex items-center justify-center space-x-2" 
                        id="loginButton">
                    <span class="button-text">Sign In</span>
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
                        <span class="px-3 bg-white text-gray-500">Or sign in with</span>
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

            <!-- Register Link -->
            <div class="text-center mt-3">
                <p class="text-xs text-gray-600">
                    Don't have an account? 
                    <a href="{{ route('register') }}" class="text-purple-600 hover:underline font-medium">Sign up here</a>
                </p>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('loginForm');
    const button = document.getElementById('loginButton');
    const buttonText = button.querySelector('.button-text');
    const spinner = button.querySelector('.loading-spinner');

    // Form submission loading state
    form.addEventListener('submit', function() {
        button.disabled = true;
        buttonText.classList.add('hidden');
        spinner.classList.remove('hidden');
    });

    // Email validation on blur
    const emailInput = document.getElementById('email');
    emailInput.addEventListener('blur', function() {
        const email = this.value;
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        
        if (email && !emailRegex.test(email)) {
            this.classList.add('border-red-500');
            this.classList.remove('border-gray-300');
            
            let feedback = this.parentNode.querySelector('.email-feedback');
            if (!feedback) {
                feedback = document.createElement('p');
                feedback.className = 'email-feedback text-red-500 text-xs mt-1';
                this.parentNode.appendChild(feedback);
            }
            feedback.textContent = 'Please enter a valid email address';
        } else {
            this.classList.remove('border-red-500');
            this.classList.add('border-gray-300');
            
            const feedback = this.parentNode.querySelector('.email-feedback');
            if (feedback) {
                feedback.remove();
            }
        }
    });
});
</script>
@endsection