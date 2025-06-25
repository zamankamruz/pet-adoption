<?php
// File: contact.blade.php
// Path: /resources/views/contact/index.blade.php
?>

@extends('layouts.app')

@section('title', 'Contact Us - FurryFriends')

@section('content')
<style>
    .contact-container {
        background: #f8fafc;
        min-height: 100vh;
    }
    
    .contact-header {
        background: linear-gradient(135deg, #8B5CF6 0%, #A855F7 100%);
        padding: 1rem 0;
        margin-bottom: 0;
    }
    
    .breadcrumb-nav {
        color: rgba(255, 255, 255, 0.8);
        font-size: 0.9rem;
    }
    
    .breadcrumb-nav a {
        color: rgba(255, 255, 255, 0.9);
        text-decoration: none;
        transition: color 0.3s;
    }
    
    .breadcrumb-nav a:hover {
        color: white;
    }
    
    .contact-main {
        background: white;
        padding: 3rem 0;
    }
    
    .contact-content {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 1rem;
    }
    
    .contact-title {
        font-size: 2.5rem;
        font-weight: bold;
        color: #1f2937;
        margin-bottom: 1rem;
    }
    
    .contact-subtitle {
        color: #6b7280;
        font-size: 1.1rem;
        margin-bottom: 3rem;
        line-height: 1.6;
    }
    
    .contact-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 4rem;
        align-items: start;
    }
    
    .contact-left {
        display: flex;
        flex-direction: column;
    }
    
    .contact-image {
        width: 100%;
        border-radius: 15px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        margin-bottom: 2rem;
    }
    
    .contact-info {
        background: #f8fafc;
        padding: 2rem;
        border-radius: 15px;
        border-left: 4px solid #8B5CF6;
    }
    
    .contact-info-item {
        display: flex;
        align-items: center;
        margin-bottom: 1.5rem;
        padding: 0.75rem;
        background: white;
        border-radius: 10px;
        transition: all 0.3s;
    }
    
    .contact-info-item:hover {
        transform: translateX(5px);
        box-shadow: 0 5px 15px rgba(139, 92, 246, 0.1);
    }
    
    .contact-info-item:last-child {
        margin-bottom: 0;
    }
    
    .contact-icon {
        width: 50px;
        height: 50px;
        background: linear-gradient(135deg, #8B5CF6, #A855F7);
        color: white;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 1rem;
        flex-shrink: 0;
    }
    
    .contact-icon i {
        font-size: 1.2rem;
    }
    
    .contact-details h4 {
        font-weight: 600;
        color: #1f2937;
        margin-bottom: 0.25rem;
    }
    
    .contact-details p {
        color: #6b7280;
        margin: 0;
    }
    
    .contact-form-section {
        background: linear-gradient(135deg, #8B5CF6 0%, #A855F7 100%);
        padding: 2rem;
        border-radius: 20px;
        box-shadow: 0 15px 35px rgba(139, 92, 246, 0.2);
    }
    
    .form-header {
        display: flex;
        align-items: center;
        margin-bottom: 2rem;
    }
    
    .form-header-icon {
        width: 40px;
        height: 40px;
        background: rgba(255, 255, 255, 0.2);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 1rem;
    }
    
    .form-header h3 {
        color: white;
        font-size: 1.5rem;
        font-weight: 600;
        margin: 0;
    }
    
    .form-group {
        margin-bottom: 1.5rem;
    }
    
    .form-group label {
        display: block;
        color: white;
        font-weight: 500;
        margin-bottom: 0.5rem;
    }
    
    .form-control {
        width: 100%;
        padding: 1rem;
        border: 2px solid rgba(255, 255, 255, 0.2);
        border-radius: 10px;
        background: rgba(255, 255, 255, 0.1);
        color: white;
        font-size: 1rem;
        transition: all 0.3s;
        backdrop-filter: blur(10px);
    }
    
    .form-control::placeholder {
        color: rgba(255, 255, 255, 0.7);
    }
    
    .form-control:focus {
        outline: none;
        border-color: rgba(255, 255, 255, 0.5);
        background: rgba(255, 255, 255, 0.15);
        box-shadow: 0 0 0 3px rgba(255, 255, 255, 0.1);
    }
    
    .form-control.textarea {
        min-height: 120px;
        resize: vertical;
    }
    
    .submit-btn {
        width: 100%;
        background: white;
        color: #8B5CF6;
        border: none;
        padding: 1rem 2rem;
        border-radius: 10px;
        font-size: 1.1rem;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    
    .submit-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 20px rgba(255, 255, 255, 0.2);
        background: #f8fafc;
    }
    
    .footer-sections {
        background: #f8fafc;
        padding: 3rem 0 1rem;
    }
    
    .footer-content {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 1rem;
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 3rem;
    }
    
    .footer-section h4 {
        color: #1f2937;
        font-size: 1.2rem;
        font-weight: 600;
        margin-bottom: 1.5rem;
    }
    
    .footer-links {
        list-style: none;
        padding: 0;
        margin: 0;
    }
    
    .footer-links li {
        margin-bottom: 0.75rem;
    }
    
    .footer-links a {
        color: #6b7280;
        text-decoration: none;
        transition: color 0.3s;
    }
    
    .footer-links a:hover {
        color: #8B5CF6;
    }
    
    .newsletter-form {
        display: flex;
        gap: 0.75rem;
        margin-top: 1rem;
    }
    
    .newsletter-input {
        flex: 1;
        padding: 0.75rem;
        border: 2px solid #e5e7eb;
        border-radius: 8px;
        font-size: 0.9rem;
    }
    
    .newsletter-input:focus {
        outline: none;
        border-color: #8B5CF6;
    }
    
    .newsletter-btn {
        background: #8B5CF6;
        color: white;
        border: none;
        padding: 0.75rem 1.5rem;
        border-radius: 8px;
        font-weight: 500;
        cursor: pointer;
        transition: background 0.3s;
    }
    
    .newsletter-btn:hover {
        background: #7C3AED;
    }
    
    .footer-bottom {
        background: #8B5CF6;
        padding: 1.5rem 0;
        text-align: center;
    }
    
    .footer-bottom-content {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 1rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    
    .copyright {
        color: rgba(255, 255, 255, 0.9);
    }
    
    .social-icons {
        display: flex;
        gap: 1rem;
    }
    
    .social-icon {
        width: 40px;
        height: 40px;
        background: rgba(255, 255, 255, 0.1);
        color: white;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        text-decoration: none;
        transition: all 0.3s;
    }
    
    .social-icon:hover {
        background: rgba(255, 255, 255, 0.2);
        transform: translateY(-2px);
    }
    
    .alert {
        padding: 1rem;
        border-radius: 10px;
        margin-bottom: 1rem;
    }
    
    .alert-success {
        background: #d1fae5;
        color: #065f46;
        border: 1px solid #a7f3d0;
    }
    
    .alert-error {
        background: #fee2e2;
        color: #991b1b;
        border: 1px solid #fca5a5;
    }
    
    @media (max-width: 1024px) {
        .contact-grid {
            grid-template-columns: 1fr;
            gap: 2rem;
        }
        
        .footer-content {
            grid-template-columns: 1fr;
            gap: 2rem;
            text-align: center;
        }
        
        .footer-bottom-content {
            flex-direction: column;
            gap: 1rem;
        }
    }
    
    @media (max-width: 768px) {
        .contact-title {
            font-size: 2rem;
        }
        
        .contact-form-section {
            padding: 1.5rem;
        }
        
        .newsletter-form {
            flex-direction: column;
        }
        
        .newsletter-btn {
            width: 100%;
        }
    }
</style>

<div class="contact-container">
    <!-- Header with Breadcrumb -->
    <div class="contact-header">
        <div class="contact-content">
            <nav class="breadcrumb-nav">
                <a href="{{ route('home') }}">Home</a> > 
                <a href="{{ route('about') }}">About us</a> > 
                <span>Contact us</span>
            </nav>
        </div>
    </div>

    <!-- Main Contact Section -->
    <div class="contact-main">
        <div class="contact-content">
            <h1 class="contact-title">Contact Us</h1>
            <p class="contact-subtitle">
                Get in touch with our team by choosing what kind of our services you are looking for.
            </p>

            <!-- Success/Error Messages -->
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if($errors->any())
                <div class="alert alert-error">
                    <ul style="margin: 0; padding-left: 1rem;">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="contact-grid">
                <!-- Left Side - Image and Contact Info -->
                <div class="contact-left">
                    <img src="{{ asset('images/contact-hero.jpg') }}" 
                         alt="Woman with pets" 
                         class="contact-image"
                         onerror="this.src='{{ asset('images/default-contact.jpg') }}'">
                    
                    <div class="contact-info">
                        <div class="contact-info-item">
                            <div class="contact-icon">
                                <i class="fas fa-map-marker-alt"></i>
                            </div>
                            <div class="contact-details">
                                <h4>Address</h4>
                                <p>123 Main Street, Anytown, USA</p>
                            </div>
                        </div>

                        <div class="contact-info-item">
                            <div class="contact-icon">
                                <i class="fas fa-phone"></i>
                            </div>
                            <div class="contact-details">
                                <h4>Phone</h4>
                                <p>+1 (555) 123-4567</p>
                            </div>
                        </div>

                        <div class="contact-info-item">
                            <div class="contact-icon">
                                <i class="fas fa-envelope"></i>
                            </div>
                            <div class="contact-details">
                                <h4>Email</h4>
                                <p>FurryFriendsSupport@gmail.com</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Side - Contact Form -->
                <div class="contact-form-section">
                    <div class="form-header">
                        <div class="form-header-icon">
                            <i class="fas fa-paw"></i>
                        </div>
                        <h3>Ready to help you</h3>
                    </div>

                    <form action="{{ route('contact.store') }}" method="POST" id="contactForm">
                        @csrf
                        
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" 
                                   id="name" 
                                   name="name" 
                                   class="form-control" 
                                   placeholder="Your Name" 
                                   value="{{ old('name') }}" 
                                   required>
                        </div>

                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" 
                                   id="email" 
                                   name="email" 
                                   class="form-control" 
                                   placeholder="Your E-mail address" 
                                   value="{{ old('email') }}" 
                                   required>
                        </div>

                        <div class="form-group">
                            <label for="phone">Phone number</label>
                            <input type="tel" 
                                   id="phone" 
                                   name="phone" 
                                   class="form-control" 
                                   placeholder="US +1 (555)..." 
                                   value="{{ old('phone') }}">
                        </div>

                        <div class="form-group">
                            <label for="subject">Subject</label>
                            <input type="text" 
                                   id="subject" 
                                   name="subject" 
                                   class="form-control" 
                                   placeholder="Subject of your message" 
                                   value="{{ old('subject') }}" 
                                   required>
                        </div>

                        <div class="form-group">
                            <label for="message">Message</label>
                            <textarea id="message" 
                                      name="message" 
                                      class="form-control textarea" 
                                      placeholder="Tell us about your request..." 
                                      required>{{ old('message') }}</textarea>
                        </div>

                        <button type="submit" class="submit-btn">
                            Send
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer Sections -->
    <div class="footer-sections">
        <div class="footer-content">
            <!-- How Can We Help -->
            <div class="footer-section">
                <h4>How Can We Help?</h4>
                <ul class="footer-links">
                    <li><a href="{{ route('adoption.index') }}">Adopt a pet</a></li>
                    <li><a href="{{ route('rehoming.index') }}">Rehome a pet</a></li>
                    <li><a href="{{ route('faq.adopters') }}">Adopt FAQ's</a></li>
                    <li><a href="{{ route('rehoming.faq-rehomers') }}">Rehome FAQ's</a></li>
                </ul>
            </div>

            <!-- Contact Us -->
            <div class="footer-section">
                <h4>Contact Us</h4>
                <ul class="footer-links">
                    <li>
                        <i class="fas fa-map-marker-alt" style="margin-right: 0.5rem; color: #8B5CF6;"></i>
                        123 Main Street, Anytown, USA
                    </li>
                    <li>
                        <i class="fas fa-phone" style="margin-right: 0.5rem; color: #8B5CF6;"></i>
                        +1 (555) 123-4567
                    </li>
                    <li>
                        <i class="fas fa-envelope" style="margin-right: 0.5rem; color: #8B5CF6;"></i>
                        FurryFriendsSupport@gmail.com
                    </li>
                </ul>
            </div>

            <!-- Keep In Touch -->
            <div class="footer-section">
                <h4>Keep In Touch With Us</h4>
                <p style="color: #6b7280; margin-bottom: 1rem;">
                    Join the FurryFriends magazine and be first to hear about news
                </p>
                <form action="{{ route('newsletter.subscribe') }}" method="POST" class="newsletter-form">
                    @csrf
                    <input type="email" 
                           name="email" 
                           class="newsletter-input" 
                           placeholder="E-mail Address" 
                           required>
                    <button type="submit" class="newsletter-btn">Subscribe</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Footer Bottom -->
    <div class="footer-bottom">
        <div class="footer-bottom-content">
            <div class="copyright">
                ©2024 Furryfriends.com
            </div>
            <div class="social-icons">
                <a href="#" class="social-icon" aria-label="Facebook">
                    <i class="fab fa-facebook-f"></i>
                </a>
                <a href="#" class="social-icon" aria-label="Pinterest">
                    <i class="fab fa-pinterest-p"></i>
                </a>
                <a href="#" class="social-icon" aria-label="Tumblr">
                    <i class="fab fa-tumblr"></i>
                </a>
                <a href="#" class="social-icon" aria-label="Instagram">
                    <i class="fab fa-instagram"></i>
                </a>
                <a href="#" class="social-icon" aria-label="YouTube">
                    <i class="fab fa-youtube"></i>
                </a>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Form submission with loading state
    const form = document.getElementById('contactForm');
    const submitBtn = form.querySelector('.submit-btn');
    const originalText = submitBtn.textContent;
    
    form.addEventListener('submit', function() {
        submitBtn.textContent = 'Sending...';
        submitBtn.disabled = true;
        
        // Re-enable after 3 seconds in case of slow response
        setTimeout(() => {
            submitBtn.textContent = originalText;
            submitBtn.disabled = false;
        }, 3000);
    });
    
    // Phone number formatting
    const phoneInput = document.getElementById('phone');
    phoneInput.addEventListener('input', function(e) {
        let value = e.target.value.replace(/\D/g, '');
        if (value.length >= 10) {
            value = value.replace(/(\d{3})(\d{3})(\d{4})/, '($1) $2-$3');
        }
        e.target.value = value;
    });
    
    // Newsletter form submission
    const newsletterForm = document.querySelector('.newsletter-form');
    if (newsletterForm) {
        newsletterForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const formData = new FormData(this);
            const submitBtn = this.querySelector('.newsletter-btn');
            const originalText = submitBtn.textContent;
            
            submitBtn.textContent = 'Subscribing...';
            submitBtn.disabled = true;
            
            fetch(this.action, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.message) {
                    alert('Thank you for subscribing!');
                    this.reset();
                }
            })
            .catch(error => {
                alert('Something went wrong. Please try again.');
            })
            .finally(() => {
                submitBtn.textContent = originalText;
                submitBtn.disabled = false;
            });
        });
    }
});
</script>
@endsection