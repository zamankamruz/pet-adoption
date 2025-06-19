<?php
// File: login.blade.php
// Path: /resources/views/auth/login.blade.php
?>

@extends('layouts.app')

@section('content')
<style>
    .auth-container {
        min-height: 100vh;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 2rem 1rem;
    }
    
    .auth-card {
        background: white;
        border-radius: 20px;
        box-shadow: 0 20px 40px rgba(0,0,0,0.1);
        overflow: hidden;
        max-width: 1000px;
        width: 100%;
        display: grid;
        grid-template-columns: 1fr 1fr;
        min-height: 600px;
    }
    
    .auth-left {
        background: linear-gradient(135deg, #8B5CF6, #A855F7);
        padding: 3rem;
        display: flex;
        flex-direction: column;
        justify-content: center;
        color: white;
        position: relative;
        overflow: hidden;
    }
    
    .auth-left::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -50%;
        width: 200%;
        height: 200%;
        background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.1'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E") repeat;
        opacity: 0.1;
    }
    
    .auth-right {
        padding: 3rem;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }
    
    .auth-logo {
        display: flex;
        align-items: center;
        font-size: 2rem;
        font-weight: bold;
        margin-bottom: 2rem;
        color: #8B5CF6;
    }
    
    .auth-logo i {
        margin-right: 10px;
        background: #8B5CF6;
        color: white;
        padding: 10px;
        border-radius: 50%;
        font-size: 1.5rem;
    }
    
    .form-group {
        margin-bottom: 1.5rem;
    }
    
    .form-group label {
        display: block;
        margin-bottom: 0.5rem;
        font-weight: 600;
        color: #374151;
    }
    
    .form-control {
        width: 100%;
        padding: 12px 16px;
        border: 2px solid #e5e7eb;
        border-radius: 10px;
        font-size: 1rem;
        transition: all 0.3s;
        background: #f9fafb;
    }
    
    .form-control:focus {
        outline: none;
        border-color: #8B5CF6;
        background: white;
        box-shadow: 0 0 0 3px rgba(139, 92, 246, 0.1);
    }
    
    .form-control.is-invalid {
        border-color: #ef4444;
        background: #fef2f2;
    }
    
    .invalid-feedback {
        color: #ef4444;
        font-size: 0.875rem;
        margin-top: 0.25rem;
    }
    
    .btn {
        width: 100%;
        padding: 12px;
        border: none;
        border-radius: 10px;
        font-size: 1rem;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
    }
    
    .btn-primary {
        background: linear-gradient(135deg, #8B5CF6, #A855F7);
        color: white;
    }
    
    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 20px rgba(139, 92, 246, 0.3);
    }
    
    .btn-primary:disabled {
        opacity: 0.6;
        cursor: not-allowed;
        transform: none;
    }
    
    .social-login {
        margin: 2rem 0;
    }
    
    .social-divider {
        text-align: center;
        margin: 2rem 0;
        position: relative;
        color: #6b7280;
    }
    
    .social-divider::before {
        content: '';
        position: absolute;
        top: 50%;
        left: 0;
        right: 0;
        height: 1px;
        background: #e5e7eb;
    }
    
    .social-divider span {
        background: white;
        padding: 0 1rem;
    }
    
    .social-buttons {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 1rem;
    }
    
    .btn-social {
        padding: 12px;
        border: 2px solid #e5e7eb;
        background: white;
        color: #374151;
        border-radius: 10px;
        text-decoration: none;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
        transition: all 0.3s;
    }
    
    .btn-social:hover {
        border-color: #8B5CF6;
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }
    
    .checkbox-container {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        margin-bottom: 1.5rem;
    }
    
    .checkbox {
        width: 18px;
        height: 18px;
        accent-color: #8B5CF6;
    }
    
    .auth-links {
        text-align: center;
        margin-top: 2rem;
    }
    
    .auth-links a {
        color: #8B5CF6;
        text-decoration: none;
        font-weight: 500;
    }
    
    .auth-links a:hover {
        text-decoration: underline;
    }
    
    .loading-spinner {
        display: none;
        width: 20px;
        height: 20px;
        border: 2px solid transparent;
        border-top: 2px solid currentColor;
        border-radius: 50%;
        animation: spin 1s linear infinite;
    }
    
    @keyframes spin {
        to { transform: rotate(360deg); }
    }
    
    .hero-illustration {
        margin-top: 2rem;
        text-align: center;
    }
    
    .hero-illustration i {
        font-size: 4rem;
        opacity: 0.8;
    }
    
    @media (max-width: 768px) {
        .auth-card {
            grid-template-columns: 1fr;
            margin: 1rem;
        }
        
        .auth-left {
            padding: 2rem;
            text-align: center;
        }
        
        .auth-right {
            padding: 2rem;
        }
        
        .social-buttons {
            grid-template-columns: 1fr;
        }
    }
</style>

<div class="auth-container">
    <div class="auth-card">
        <div class="auth-left">
            <div class="auth-content">
                <h1>Welcome Back!</h1>
                <p style="font-size: 1.1rem; opacity: 0.9; margin: 1rem 0;">
                    Sign in to your account to continue your pet adoption journey. 
                    Find your perfect furry companion today!
                </p>
                <div class="hero-illustration">
                    <i class="fas fa-heart"></i>
                </div>
            </div>
        </div>
        
        <div class="auth-right">
            <div class="auth-logo">
                <i class="fas fa-paw"></i>
                Furry Friends
            </div>
            
            <h2 style="margin-bottom: 0.5rem; color: #1f2937;">Sign In</h2>
            <p style="color: #6b7280; margin-bottom: 2rem;">Enter your credentials to access your account</p>

            @if (session('status'))
                <div class="alert alert-success" style="background: #d1fae5; color: #065f46; padding: 1rem; border-radius: 10px; margin-bottom: 1.5rem;">
                    {{ session('status') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger" style="background: #fee2e2; color: #dc2626; padding: 1rem; border-radius: 10px; margin-bottom: 1.5rem;">
                    @foreach ($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}" id="loginForm">
                @csrf

                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input id="email" type="email" 
                           class="form-control @error('email') is-invalid @enderror" 
                           name="email" 
                           value="{{ old('email') }}" 
                           required 
                           autocomplete="email" 
                           autofocus
                           placeholder="Enter your email">
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input id="password" type="password" 
                           class="form-control @error('password') is-invalid @enderror" 
                           name="password" 
                           required 
                           autocomplete="current-password"
                           placeholder="Enter your password">
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="checkbox-container">
                    <input class="checkbox" type="checkbox" name="remember" id="remember" 
                           {{ old('remember') ? 'checked' : '' }}>
                    <label for="remember">Remember me</label>
                </div>

                <button type="submit" class="btn btn-primary" id="loginButton">
                    <span class="button-text">Sign In</span>
                    <div class="loading-spinner"></div>
                </button>
            </form>

            <div class="social-divider">
                <span>Or sign in with</span>
            </div>

            <div class="social-buttons">
                <a href="{{ route('auth.google') }}" class="btn-social">
                    <i class="fab fa-google"></i>
                    Google
                </a>
                <a href="{{ route('auth.facebook') }}" class="btn-social">
                    <i class="fab fa-facebook-f"></i>
                    Facebook
                </a>
            </div>

            <div class="auth-links">
                <div style="margin-bottom: 1rem;">
                    <a href="{{ route('password.request') }}">Forgot your password?</a>
                </div>
                <div>
                    Don't have an account? 
                    <a href="{{ route('register') }}">Sign up here</a>
                </div>
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

    form.addEventListener('submit', function() {
        button.disabled = true;
        buttonText.style.display = 'none';
        spinner.style.display = 'block';
    });

    // Email validation on blur
    const emailInput = document.getElementById('email');
    emailInput.addEventListener('blur', function() {
        const email = this.value;
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        
        if (email && !emailRegex.test(email)) {
            this.classList.add('is-invalid');
            let feedback = this.parentNode.querySelector('.invalid-feedback');
            if (!feedback) {
                feedback = document.createElement('div');
                feedback.className = 'invalid-feedback';
                this.parentNode.appendChild(feedback);
            }
            feedback.textContent = 'Please enter a valid email address';
        } else {
            this.classList.remove('is-invalid');
            const feedback = this.parentNode.querySelector('.invalid-feedback');
            if (feedback) {
                feedback.remove();
            }
        }
    });
});
</script>
@endsection