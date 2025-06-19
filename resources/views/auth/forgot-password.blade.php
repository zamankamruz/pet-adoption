<?php
// File: forgot-password.blade.php
// Path: /resources/views/auth/forgot-password.blade.php
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
        min-height: 500px;
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
    
    .btn-outline {
        background: transparent;
        border: 2px solid #8B5CF6;
        color: #8B5CF6;
    }
    
    .btn-outline:hover {
        background: #8B5CF6;
        color: white;
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
    
    .alert-success {
        background: #d1fae5;
        color: #065f46;
        border: 1px solid #a7f3d0;
    }
    
    .alert-error {
        background: #fee2e2;
        color: #dc2626;
        border: 1px solid #fca5a5;
    }
    
    .success-icon {
        display: inline-block;
        width: 60px;
        height: 60px;
        background: #10b981;
        border-radius: 50%;
        color: white;
        line-height: 60px;
        text-align: center;
        font-size: 1.5rem;
        margin-bottom: 1rem;
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
                <h1>Forgot Password?</h1>
                <p style="font-size: 1.1rem; opacity: 0.9; margin: 1rem 0;">
                    No worries! Enter your email address and we'll send you a link to reset your password.
                </p>
                <div class="hero-illustration">
                    <i class="fas fa-key"></i>
                </div>
            </div>
        </div>
        
        <div class="auth-right">
            <div class="auth-logo">
                <i class="fas fa-paw"></i>
                Furry Friends
            </div>
            
            <div id="form-container">
                <h2 style="margin-bottom: 0.5rem; color: #1f2937;">Reset Password</h2>
                <p style="color: #6b7280; margin-bottom: 2rem;">Enter your email to receive reset instructions</p>

                @if (session('status'))
                    <div class="alert alert-success">
                        <div class="success-icon">
                            <i class="fas fa-check"></i>
                        </div>
                        <div>
                            <strong>Email Sent!</strong><br>
                            {{ session('status') }}
                        </div>
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-error">
                        @foreach ($errors->all() as $error)
                            <div>{{ $error }}</div>
                        @endforeach
                    </div>
                @endif

                <form method="POST" action="{{ route('password.email') }}" id="forgotPasswordForm">
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
                               placeholder="Enter your email address">
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary" id="submitButton">
                        <span class="button-text">Send Reset Link</span>
                        <div class="loading-spinner"></div>
                    </button>
                </form>

                <div style="margin: 1.5rem 0; text-align: center;">
                    <button type="button" class="btn btn-outline" id="resendButton" style="display: none;">
                        <i class="fas fa-redo"></i>
                        Resend Email
                    </button>
                </div>
            </div>

            <div class="auth-links">
                <div style="margin-bottom: 1rem;">
                    <a href="{{ route('login') }}">
                        <i class="fas fa-arrow-left"></i> Back to Login
                    </a>
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
    const form = document.getElementById('forgotPasswordForm');
    const button = document.getElementById('submitButton');
    const buttonText = button.querySelector('.button-text');
    const spinner = button.querySelector('.loading-spinner');
    const resendButton = document.getElementById('resendButton');
    const emailInput = document.getElementById('email');

    let emailSent = false;

    form.addEventListener('submit', function(e) {
        if (emailSent) {
            e.preventDefault();
            resendEmail();
            return;
        }

        button.disabled = true;
        buttonText.style.display = 'none';
        spinner.style.display = 'block';
    });

    // Email validation
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

    // Check if email was sent successfully
    @if (session('status'))
        emailSent = true;
        buttonText.textContent = 'Email Sent!';
        button.disabled = true;
        resendButton.style.display = 'block';
        
        // Show resend option after 60 seconds
        setTimeout(function() {
            button.disabled = false;
            buttonText.textContent = 'Resend Reset Link';
        }, 60000);
    @endif

    // Resend email function
    function resendEmail() {
        fetch('{{ route("password.email") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify({
                email: emailInput.value
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.message) {
                // Show success message
                const alertDiv = document.createElement('div');
                alertDiv.className = 'alert alert-success';
                alertDiv.innerHTML = `
                    <div class="success-icon">
                        <i class="fas fa-check"></i>
                    </div>
                    <div>
                        <strong>Email Sent!</strong><br>
                        ${data.message}
                    </div>
                `;
                
                const existingAlert = document.querySelector('.alert');
                if (existingAlert) {
                    existingAlert.replaceWith(alertDiv);
                } else {
                    form.parentNode.insertBefore(alertDiv, form);
                }
            }
        })
        .catch(error => {
            console.error('Error:', error);
            // Show error message
            const alertDiv = document.createElement('div');
            alertDiv.className = 'alert alert-error';
            alertDiv.textContent = 'Failed to send email. Please try again.';
            
            const existingAlert = document.querySelector('.alert');
            if (existingAlert) {
                existingAlert.replaceWith(alertDiv);
            } else {
                form.parentNode.insertBefore(alertDiv, form);
            }
        });
    }

    resendButton.addEventListener('click', resendEmail);
});
</script>
@endsection