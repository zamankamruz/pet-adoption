<?php
// File: register.blade.php
// Path: /resources/views/auth/register.blade.php
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
        min-height: 700px;
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
        max-height: 700px;
        overflow-y: auto;
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
    
    .form-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 1rem;
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
    
    .form-control.is-valid {
        border-color: #10b981;
        background: #f0fdf4;
    }
    
    .invalid-feedback {
        color: #ef4444;
        font-size: 0.875rem;
        margin-top: 0.25rem;
    }
    
    .valid-feedback {
        color: #10b981;
        font-size: 0.875rem;
        margin-top: 0.25rem;
    }
    
    .password-strength {
        margin-top: 0.5rem;
    }
    
    .strength-meter {
        height: 4px;
        background: #e5e7eb;
        border-radius: 2px;
        overflow: hidden;
        margin-bottom: 0.5rem;
    }
    
    .strength-fill {
        height: 100%;
        transition: all 0.3s;
        width: 0%;
    }
    
    .strength-weak { background: #ef4444; }
    .strength-fair { background: #f59e0b; }
    .strength-good { background: #10b981; }
    .strength-strong { background: #059669; }
    
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
        align-items: flex-start;
        gap: 0.5rem;
        margin-bottom: 1.5rem;
    }
    
    .checkbox {
        width: 18px;
        height: 18px;
        accent-color: #8B5CF6;
        margin-top: 2px;
    }
    
    .checkbox-label {
        font-size: 0.9rem;
        line-height: 1.4;
    }
    
    .checkbox-label a {
        color: #8B5CF6;
        text-decoration: none;
    }
    
    .checkbox-label a:hover {
        text-decoration: underline;
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
        
        .form-row {
            grid-template-columns: 1fr;
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
                <h1>Join Our Community!</h1>
                <p style="font-size: 1.1rem; opacity: 0.9; margin: 1rem 0;">
                    Create your account and start your journey to find the perfect pet. 
                    Help animals find their forever homes!
                </p>
                <div class="hero-illustration">
                    <i class="fas fa-users"></i>
                </div>
            </div>
        </div>
        
        <div class="auth-right">
            <div class="auth-logo">
                <i class="fas fa-paw"></i>
                Furry Friends
            </div>
            
            <h2 style="margin-bottom: 0.5rem; color: #1f2937;">Create Account</h2>
            <p style="color: #6b7280; margin-bottom: 2rem;">Fill in your information to get started</p>

            @if ($errors->any())
                <div class="alert alert-danger" style="background: #fee2e2; color: #dc2626; padding: 1rem; border-radius: 10px; margin-bottom: 1.5rem;">
                    <ul style="margin: 0; padding-left: 1rem;">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('register') }}" id="registerForm">
                @csrf

                <div class="form-row">
                    <div class="form-group">
                        <label for="name">Full Name</label>
                        <input id="name" type="text" 
                               class="form-control @error('name') is-invalid @enderror" 
                               name="name" 
                               value="{{ old('name') }}" 
                               required 
                               autocomplete="name" 
                               autofocus
                               placeholder="Enter your full name">
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="email">Email Address</label>
                        <input id="email" type="email" 
                               class="form-control @error('email') is-invalid @enderror" 
                               name="email" 
                               value="{{ old('email') }}" 
                               required 
                               autocomplete="email"
                               placeholder="Enter your email">
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <label for="phone">Phone Number (Optional)</label>
                    <input id="phone" type="tel" 
                           class="form-control @error('phone') is-invalid @enderror" 
                           name="phone" 
                           value="{{ old('phone') }}" 
                           autocomplete="tel"
                           placeholder="Enter your phone number">
                    @error('phone')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="city">City (Optional)</label>
                        <input id="city" type="text" 
                               class="form-control @error('city') is-invalid @enderror" 
                               name="city" 
                               value="{{ old('city') }}" 
                               placeholder="Your city">
                        @error('city')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="state">State (Optional)</label>
                        <input id="state" type="text" 
                               class="form-control @error('state') is-invalid @enderror" 
                               name="state" 
                               value="{{ old('state') }}" 
                               placeholder="Your state">
                        @error('state')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input id="password" type="password" 
                               class="form-control @error('password') is-invalid @enderror" 
                               name="password" 
                               required 
                               autocomplete="new-password"
                               placeholder="Create a password">
                        <div class="password-strength">
                            <div class="strength-meter">
                                <div class="strength-fill" id="strengthFill"></div>
                            </div>
                            <div class="strength-text" id="strengthText"></div>
                        </div>
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="password-confirm">Confirm Password</label>
                        <input id="password-confirm" type="password" 
                               class="form-control" 
                               name="password_confirmation" 
                               required 
                               autocomplete="new-password"
                               placeholder="Confirm your password">
                    </div>
                </div>

                <div class="checkbox-container">
                    <input class="checkbox" type="checkbox" name="terms" id="terms" required>
                    <label for="terms" class="checkbox-label">
                        I agree to the <a href="/terms" target="_blank">Terms of Service</a> 
                        and <a href="/privacy" target="_blank">Privacy Policy</a>
                    </label>
                </div>

                <div class="checkbox-container">
                    <input class="checkbox" type="checkbox" name="marketing_emails" id="marketing_emails">
                    <label for="marketing_emails" class="checkbox-label">
                        I would like to receive marketing emails about pet adoption tips and updates
                    </label>
                </div>

                <button type="submit" class="btn btn-primary" id="registerButton">
                    <span class="button-text">Create Account</span>
                    <div class="loading-spinner"></div>
                </button>
            </form>

            <div class="social-divider">
                <span>Or sign up with</span>
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
                Already have an account? 
                <a href="{{ route('login') }}">Sign in here</a>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('registerForm');
    const button = document.getElementById('registerButton');
    const buttonText = button.querySelector('.button-text');
    const spinner = button.querySelector('.loading-spinner');
    const passwordInput = document.getElementById('password');
    const confirmPasswordInput = document.getElementById('password-confirm');
    const emailInput = document.getElementById('email');

    form.addEventListener('submit', function() {
        button.disabled = true;
        buttonText.style.display = 'none';
        spinner.style.display = 'block';
    });

    // Password strength checker
    passwordInput.addEventListener('input', function() {
        const password = this.value;
        const strengthFill = document.getElementById('strengthFill');
        const strengthText = document.getElementById('strengthText');
        
        let strength = 0;
        let feedback = [];

        if (password.length >= 8) strength += 25;
        else feedback.push('At least 8 characters');

        if (/[a-z]/.test(password)) strength += 25;
        else feedback.push('lowercase letter');

        if (/[A-Z]/.test(password)) strength += 25;
        else feedback.push('uppercase letter');

        if (/\d/.test(password)) strength += 25;
        else feedback.push('number');

        if (/[^a-zA-Z\d]/.test(password)) strength += 25;
        else feedback.push('special character');

        // Update strength meter
        strengthFill.style.width = Math.min(strength, 100) + '%';
        
        if (strength < 50) {
            strengthFill.className = 'strength-fill strength-weak';
            strengthText.textContent = 'Weak - Add: ' + feedback.join(', ');
            strengthText.style.color = '#ef4444';
        } else if (strength < 75) {
            strengthFill.className = 'strength-fill strength-fair';
            strengthText.textContent = 'Fair - Add: ' + feedback.join(', ');
            strengthText.style.color = '#f59e0b';
        } else if (strength < 100) {
            strengthFill.className = 'strength-fill strength-good';
            strengthText.textContent = 'Good';
            strengthText.style.color = '#10b981';
        } else {
            strengthFill.className = 'strength-fill strength-strong';
            strengthText.textContent = 'Strong';
            strengthText.style.color = '#059669';
        }
    });

    // Password confirmation validation
    confirmPasswordInput.addEventListener('input', function() {
        if (this.value && this.value !== passwordInput.value) {
            this.classList.add('is-invalid');
            let feedback = this.parentNode.querySelector('.invalid-feedback');
            if (!feedback) {
                feedback = document.createElement('div');
                feedback.className = 'invalid-feedback';
                this.parentNode.appendChild(feedback);
            }
            feedback.textContent = 'Passwords do not match';
        } else {
            this.classList.remove('is-invalid');
            const feedback = this.parentNode.querySelector('.invalid-feedback');
            if (feedback) {
                feedback.remove();
            }
        }
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
                    emailInput.classList.add('is-invalid');
                    let feedback = emailInput.parentNode.querySelector('.invalid-feedback');
                    if (!feedback) {
                        feedback = document.createElement('div');
                        feedback.className = 'invalid-feedback';
                        emailInput.parentNode.appendChild(feedback);
                    }
                    feedback.textContent = 'This email is already registered';
                } else {
                    emailInput.classList.remove('is-invalid');
                    emailInput.classList.add('is-valid');
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