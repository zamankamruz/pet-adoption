<?php
// File: reset-password.blade.php
// Path: /resources/views/auth/reset-password.blade.php
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
        max-width: 800px;
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
        position: relative;
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
    
    .password-container {
        position: relative;
    }
    
    .password-toggle {
        position: absolute;
        right: 12px;
        top: 50%;
        transform: translateY(-50%);
        background: none;
        border: none;
        color: #6b7280;
        cursor: pointer;
        font-size: 1.1rem;
    }
    
    .password-toggle:hover {
        color: #8B5CF6;
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
    
    .password-requirements {
        font-size: 0.875rem;
        color: #6b7280;
        margin-top: 0.5rem;
    }
    
    .requirement {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        margin-bottom: 0.25rem;
    }
    
    .requirement.met {
        color: #10b981;
    }
    
    .requirement.met i {
        color: #10b981;
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
    
    .alert {
        padding: 1rem;
        border-radius: 10px;
        margin-bottom: 1.5rem;
    }
    
    .alert-error {
        background: #fee2e2;
        color: #dc2626;
        border: 1px solid #fca5a5;
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
    }
</style>

<div class="auth-container">
    <div class="auth-card">
        <div class="auth-left">
            <div class="auth-content">
                <h1>Reset Your Password</h1>
                <p style="font-size: 1.1rem; opacity: 0.9; margin: 1rem 0;">
                    Create a new secure password for your account. Make sure it's strong and unique!
                </p>
                <div class="hero-illustration">
                    <i class="fas fa-shield-alt"></i>
                </div>
            </div>
        </div>
        
        <div class="auth-right">
            <div class="auth-logo">
                <i class="fas fa-paw"></i>
                Furry Friends
            </div>
            
            <h2 style="margin-bottom: 0.5rem; color: #1f2937;">Create New Password</h2>
            <p style="color: #6b7280; margin-bottom: 2rem;">Enter your new password below</p>

            @if ($errors->any())
                <div class="alert alert-error">
                    @foreach ($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </div>
            @endif

            <form method="POST" action="{{ route('password.update') }}" id="resetPasswordForm">
                @csrf

                <input type="hidden" name="token" value="{{ $token }}">
                <input type="hidden" name="email" value="{{ $email ?? old('email') }}">

                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input id="email" type="email" 
                           class="form-control" 
                           value="{{ $email ?? old('email') }}" 
                           disabled
                           style="background: #f3f4f6; color: #6b7280;">
                </div>

                <div class="form-group">
                    <label for="password">New Password</label>
                    <div class="password-container">
                        <input id="password" type="password" 
                               class="form-control @error('password') is-invalid @enderror" 
                               name="password" 
                               required 
                               autocomplete="new-password"
                               placeholder="Enter your new password">
                        <button type="button" class="password-toggle" id="togglePassword">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                    <div class="password-strength">
                        <div class="strength-meter">
                            <div class="strength-fill" id="strengthFill"></div>
                        </div>
                        <div class="strength-text" id="strengthText"></div>
                    </div>
                    <div class="password-requirements">
                        <div class="requirement" id="req-length">
                            <i class="fas fa-circle"></i>
                            <span>At least 8 characters</span>
                        </div>
                        <div class="requirement" id="req-lower">
                            <i class="fas fa-circle"></i>
                            <span>One lowercase letter</span>
                        </div>
                        <div class="requirement" id="req-upper">
                            <i class="fas fa-circle"></i>
                            <span>One uppercase letter</span>
                        </div>
                        <div class="requirement" id="req-number">
                            <i class="fas fa-circle"></i>
                            <span>One number</span>
                        </div>
                    </div>
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password-confirm">Confirm New Password</label>
                    <div class="password-container">
                        <input id="password-confirm" type="password" 
                               class="form-control" 
                               name="password_confirmation" 
                               required 
                               autocomplete="new-password"
                               placeholder="Confirm your new password">
                        <button type="button" class="password-toggle" id="togglePasswordConfirm">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary" id="resetButton">
                    <span class="button-text">Reset Password</span>
                    <div class="loading-spinner"></div>
                </button>
            </form>

            <div class="auth-links">
                <div>
                    <a href="{{ route('login') }}">
                        <i class="fas fa-arrow-left"></i> Back to Login
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('resetPasswordForm');
    const button = document.getElementById('resetButton');
    const buttonText = button.querySelector('.button-text');
    const spinner = button.querySelector('.loading-spinner');
    const passwordInput = document.getElementById('password');
    const confirmPasswordInput = document.getElementById('password-confirm');
    const togglePassword = document.getElementById('togglePassword');
    const togglePasswordConfirm = document.getElementById('togglePasswordConfirm');

    form.addEventListener('submit', function() {
        button.disabled = true;
        buttonText.style.display = 'none';
        spinner.style.display = 'block';
    });

    // Password visibility toggle
    togglePassword.addEventListener('click', function() {
        const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordInput.setAttribute('type', type);
        this.querySelector('i').classList.toggle('fa-eye');
        this.querySelector('i').classList.toggle('fa-eye-slash');
    });

    togglePasswordConfirm.addEventListener('click', function() {
        const type = confirmPasswordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        confirmPasswordInput.setAttribute('type', type);
        this.querySelector('i').classList.toggle('fa-eye');
        this.querySelector('i').classList.toggle('fa-eye-slash');
    });

    // Password strength checker
    passwordInput.addEventListener('input', function() {
        const password = this.value;
        const strengthFill = document.getElementById('strengthFill');
        const strengthText = document.getElementById('strengthText');
        
        let strength = 0;
        let metRequirements = 0;

        // Check length
        const lengthReq = document.getElementById('req-length');
        if (password.length >= 8) {
            strength += 25;
            metRequirements++;
            lengthReq.classList.add('met');
            lengthReq.querySelector('i').classList.replace('fa-circle', 'fa-check-circle');
        } else {
            lengthReq.classList.remove('met');
            lengthReq.querySelector('i').classList.replace('fa-check-circle', 'fa-circle');
        }

        // Check lowercase
        const lowerReq = document.getElementById('req-lower');
        if (/[a-z]/.test(password)) {
            strength += 25;
            metRequirements++;
            lowerReq.classList.add('met');
            lowerReq.querySelector('i').classList.replace('fa-circle', 'fa-check-circle');
        } else {
            lowerReq.classList.remove('met');
            lowerReq.querySelector('i').classList.replace('fa-check-circle', 'fa-circle');
        }

        // Check uppercase
        const upperReq = document.getElementById('req-upper');
        if (/[A-Z]/.test(password)) {
            strength += 25;
            metRequirements++;
            upperReq.classList.add('met');
            upperReq.querySelector('i').classList.replace('fa-circle', 'fa-check-circle');
        } else {
            upperReq.classList.remove('met');
            upperReq.querySelector('i').classList.replace('fa-check-circle', 'fa-circle');
        }

        // Check numbers
        const numberReq = document.getElementById('req-number');
        if (/\d/.test(password)) {
            strength += 25;
            metRequirements++;
            numberReq.classList.add('met');
            numberReq.querySelector('i').classList.replace('fa-circle', 'fa-check-circle');
        } else {
            numberReq.classList.remove('met');
            numberReq.querySelector('i').classList.replace('fa-check-circle', 'fa-circle');
        }

        // Update strength meter
        strengthFill.style.width = strength + '%';
        
        if (strength < 50) {
            strengthFill.className = 'strength-fill strength-weak';
            strengthText.textContent = 'Weak';
            strengthText.style.color = '#ef4444';
        } else if (strength < 75) {
            strengthFill.className = 'strength-fill strength-fair';
            strengthText.textContent = 'Fair';
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

        // Enable/disable submit button based on requirements
        button.disabled = metRequirements < 4;
    });

    // Password confirmation validation
    confirmPasswordInput.addEventListener('input', function() {
        if (this.value && this.value !== passwordInput.value) {
            this.classList.add('is-invalid');
            this.classList.remove('is-valid');
            let feedback = this.parentNode.parentNode.querySelector('.invalid-feedback');
            if (!feedback) {
                feedback = document.createElement('div');
                feedback.className = 'invalid-feedback';
                this.parentNode.parentNode.appendChild(feedback);
            }
            feedback.textContent = 'Passwords do not match';
        } else if (this.value && this.value === passwordInput.value) {
            this.classList.remove('is-invalid');
            this.classList.add('is-valid');
            const feedback = this.parentNode.parentNode.querySelector('.invalid-feedback');
            if (feedback) {
                feedback.remove();
            }
        }
    });
});
</script>
@endsection