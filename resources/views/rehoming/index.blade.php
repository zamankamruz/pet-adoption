<?php
// File: index.blade.php
// Path: /resources/views/rehoming/index.blade.php
?>

@extends('layouts.app')

@section('content')
<style>
    .rehoming-container {
        background: #f8fafc;
        min-height: 100vh;
    }
    
    .hero-section {
        background: linear-gradient(135deg, #8B5CF6, #A855F7);
        color: white;
        padding: 4rem 0;
        text-align: center;
        position: relative;
        overflow: hidden;
    }
    
    .hero-section::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -50%;
        width: 200%;
        height: 200%;
        background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.1'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E") repeat;
        opacity: 0.1;
    }
    
    .hero-content {
        max-width: 800px;
        margin: 0 auto;
        padding: 0 1rem;
        position: relative;
        z-index: 1;
    }
    
    .hero-content h1 {
        font-size: 3rem;
        font-weight: bold;
        margin-bottom: 1rem;
    }
    
    .hero-content p {
        font-size: 1.2rem;
        opacity: 0.9;
        margin-bottom: 2rem;
        line-height: 1.6;
    }
    
    .hero-buttons {
        display: flex;
        justify-content: center;
        gap: 1rem;
        flex-wrap: wrap;
    }
    
    .btn {
        padding: 1rem 2rem;
        border-radius: 10px;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.3s;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }
    
    .btn-primary {
        background: white;
        color: #8B5CF6;
        border: 2px solid white;
    }
    
    .btn-primary:hover {
        background: #f3f4f6;
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(255,255,255,0.3);
    }
    
    .btn-outline {
        background: transparent;
        color: white;
        border: 2px solid white;
    }
    
    .btn-outline:hover {
        background: white;
        color: #8B5CF6;
    }
    
    .main-content {
        max-width: 1200px;
        margin: 0 auto;
        padding: 3rem 1rem;
    }
    
    .section-header {
        text-align: center;
        margin-bottom: 3rem;
    }
    
    .section-title {
        font-size: 2.5rem;
        font-weight: bold;
        color: #1f2937;
        margin-bottom: 1rem;
    }
    
    .section-subtitle {
        font-size: 1.1rem;
        color: #6b7280;
        max-width: 600px;
        margin: 0 auto;
        line-height: 1.6;
    }
    
    .process-section {
        background: white;
        border-radius: 20px;
        padding: 3rem;
        margin: 3rem 0;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    }
    
    .process-steps {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 2rem;
        margin-top: 2rem;
    }
    
    .process-step {
        text-align: center;
        position: relative;
    }
    
    .process-step:not(:last-child)::after {
        content: '';
        position: absolute;
        top: 30px;
        right: -50%;
        width: 100%;
        height: 2px;
        background: #e5e7eb;
        z-index: 0;
    }
    
    .step-icon {
        width: 60px;
        height: 60px;
        background: linear-gradient(135deg, #8B5CF6, #A855F7);
        color: white;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        margin: 0 auto 1rem;
        position: relative;
        z-index: 1;
    }
    
    .step-title {
        font-size: 1.1rem;
        font-weight: bold;
        color: #1f2937;
        margin-bottom: 0.5rem;
    }
    
    .step-description {
        color: #6b7280;
        line-height: 1.5;
        font-size: 0.95rem;
    }
    
    .benefits-section {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 2rem;
        margin-top: 3rem;
    }
    
    .benefit-card {
        background: white;
        border-radius: 15px;
        padding: 2rem;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        text-align: center;
    }
    
    .benefit-icon {
        width: 80px;
        height: 80px;
        background: linear-gradient(135deg, #8B5CF6, #A855F7);
        color: white;
        border-radius: 15px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2rem;
        margin: 0 auto 1rem;
    }
    
    .benefit-card h3 {
        font-size: 1.3rem;
        font-weight: bold;
        color: #1f2937;
        margin-bottom: 1rem;
    }
    
    .benefit-card p {
        color: #6b7280;
        line-height: 1.6;
    }
    
    .tips-section {
        background: linear-gradient(135deg, #f8fafc, #e5e7eb);
        border-radius: 20px;
        padding: 3rem;
        margin-top: 3rem;
    }
    
    .tips-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 2rem;
        margin-top: 2rem;
    }
    
    .tip-card {
        background: white;
        border-radius: 15px;
        padding: 1.5rem;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    }
    
    .tip-card h4 {
        color: #8B5CF6;
        font-weight: 600;
        margin-bottom: 1rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }
    
    .tip-card p {
        color: #6b7280;
        line-height: 1.5;
        margin: 0;
    }
    
    .support-section {
        background: white;
        border-radius: 20px;
        padding: 3rem;
        margin-top: 3rem;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        text-align: center;
    }
    
    .support-content {
        max-width: 600px;
        margin: 0 auto;
    }
    
    .support-contact {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 2rem;
        margin-top: 2rem;
    }
    
    .contact-item {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 0.5rem;
    }
    
    .contact-icon {
        width: 50px;
        height: 50px;
        background: #8B5CF6;
        color: white;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.2rem;
    }
    
    .contact-label {
        font-weight: 600;
        color: #374151;
    }
    
    .contact-value {
        color: #6b7280;
        font-size: 0.9rem;
    }
    
    .cta-section {
        background: linear-gradient(135deg, #8B5CF6, #A855F7);
        color: white;
        border-radius: 20px;
        padding: 3rem;
        text-align: center;
        margin-top: 3rem;
    }
    
    .cta-section h2 {
        font-size: 2rem;
        font-weight: bold;
        margin-bottom: 1rem;
    }
    
    .cta-section p {
        font-size: 1.1rem;
        opacity: 0.9;
        margin-bottom: 2rem;
    }
    
    .start-btn {
        background: white;
        color: #8B5CF6;
        padding: 1rem 2rem;
        border-radius: 10px;
        font-weight: 600;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        transition: all 0.3s;
    }
    
    .start-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(255,255,255,0.3);
    }
    
    @media (max-width: 768px) {
        .hero-content h1 {
            font-size: 2rem;
        }
        
        .hero-buttons {
            flex-direction: column;
            align-items: center;
        }
        
        .process-steps {
            grid-template-columns: 1fr;
        }
        
        .process-step:not(:last-child)::after {
            display: none;
        }
        
        .benefits-section {
            grid-template-columns: 1fr;
        }
        
        .tips-grid {
            grid-template-columns: 1fr;
        }
        
        .support-contact {
            grid-template-columns: 1fr;
        }
    }
</style>

<div class="rehoming-container">
    <!-- Hero Section -->
    <div class="hero-section">
        <div class="hero-content">
            <h1>Find a Loving Home for Your Pet</h1>
            <p>
                Sometimes life circumstances change, and you need to find a new home for your beloved pet. 
                We're here to help you through this difficult process with care and compassion.
            </p>
            <div class="hero-buttons">
                <a href="{{ route('rehoming.start') }}" class="btn btn-primary">
                    <i class="fas fa-paw"></i>
                    Start Rehoming Process
                </a>
                <a href="{{ route('rehoming.how-it-works') }}" class="btn btn-outline">
                    <i class="fas fa-info-circle"></i>
                    How It Works
                </a>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <!-- How It Works Section -->
        <div class="process-section">
            <div class="section-header">
                <h2 class="section-title">How Rehoming Works</h2>
                <p class="section-subtitle">
                    Our simple 3-step process helps you find the perfect new family for your pet while ensuring their safety and wellbeing.
                </p>
            </div>

            <div class="process-steps">
                <div class="process-step">
                    <div class="step-icon">
                        <i class="fas fa-clipboard-list"></i>
                    </div>
                    <h3 class="step-title">Create Profile</h3>
                    <p class="step-description">
                        Tell us about your pet, including their personality, health status, and care requirements. 
                        Add photos to help them find the perfect match.
                    </p>
                </div>
                <div class="process-step">
                    <div class="step-icon">
                        <i class="fas fa-search"></i>
                    </div>
                    <h3 class="step-title">Review & Approve</h3>
                    <p class="step-description">
                        We review your pet's profile and help you screen potential adopters. 
                        You stay in control of who can contact you about your pet.
                    </p>
                </div>
                <div class="process-step">
                    <div class="step-icon">
                        <i class="fas fa-heart"></i>
                    </div>
                    <h3 class="step-title">Find Perfect Match</h3>
                    <p class="step-description">
                        Connect with qualified adopters, arrange meet-and-greets, and ensure your pet 
                        goes to a loving, permanent home.
                    </p>
                </div>
            </div>
        </div>

        <!-- Benefits Section -->
        <div class="section-header">
            <h2 class="section-title">Why Choose Our Rehoming Service?</h2>
            <p class="section-subtitle">
                We provide a safe, supportive platform that prioritizes your pet's wellbeing throughout the process.
            </p>
        </div>

        <div class="benefits-section">
            <div class="benefit-card">
                <div class="benefit-icon">
                    <i class="fas fa-shield-alt"></i>
                </div>
                <h3>Safe & Secure</h3>
                <p>
                    We screen all potential adopters and provide guidance on safe meet-and-greet practices. 
                    Your privacy and your pet's safety are our top priorities.
                </p>
            </div>
            <div class="benefit-card">
                <div class="benefit-icon">
                    <i class="fas fa-users"></i>
                </div>
                <h3>Qualified Adopters</h3>
                <p>
                    Our platform attracts serious pet lovers who are committed to providing loving, 
                    permanent homes. We help you find the right match for your pet's needs.
                </p>
            </div>
            <div class="benefit-card">
                <div class="benefit-icon">
                    <i class="fas fa-headset"></i>
                </div>
                <h3>Expert Support</h3>
                <p>
                    Our team of pet care experts is here to guide you through every step of the process, 
                    from creating your pet's profile to finalizing the adoption.
                </p>
            </div>
            <div class="benefit-card">
                <div class="benefit-icon">
                    <i class="fas fa-dollar-sign"></i>
                </div>
                <h3>No Hidden Fees</h3>
                <p>
                    Our rehoming service is completely free for pet owners. We believe that finding a 
                    loving home for your pet shouldn't come with financial stress.
                </p>
            </div>
        </div>

        <!-- Tips Section -->
        <div class="tips-section">
            <div class="section-header">
                <h2 class="section-title">Rehoming Tips</h2>
                <p class="section-subtitle">
                    Helpful advice to make the rehoming process as smooth as possible for you and your pet.
                </p>
            </div>

            <div class="tips-grid">
                <div class="tip-card">
                    <h4>
                        <i class="fas fa-camera"></i>
                        Great Photos
                    </h4>
                    <p>
                        Use high-quality, well-lit photos that show your pet's personality. 
                        Include photos of them playing, relaxing, and interacting with people.
                    </p>
                </div>
                <div class="tip-card">
                    <h4>
                        <i class="fas fa-heart"></i>
                        Honest Descriptions
                    </h4>
                    <p>
                        Be honest about your pet's personality, energy level, and any special needs. 
                        This helps ensure they find the right home for their unique qualities.
                    </p>
                </div>
                <div class="tip-card">
                    <h4>
                        <i class="fas fa-medical-kit"></i>
                        Health Records
                    </h4>
                    <p>
                        Gather all veterinary records, vaccination history, and any medical information. 
                        This helps adopters understand your pet's health status.
                    </p>
                </div>
                <div class="tip-card">
                    <h4>
                        <i class="fas fa-handshake"></i>
                        Meet & Greet
                    </h4>
                    <p>
                        Always arrange in-person meetings before finalizing any adoption. 
                        This ensures compatibility between your pet and their potential new family.
                    </p>
                </div>
            </div>
        </div>

        <!-- Support Section -->
        <div class="support-section">
            <div class="support-content">
                <h2 class="section-title">We're Here to Help</h2>
                <p class="section-subtitle">
                    Have questions about the rehoming process? Our team is here to support you every step of the way.
                </p>

                <div class="support-contact">
                    <div class="contact-item">
                        <div class="contact-icon">
                            <i class="fas fa-phone"></i>
                        </div>
                        <div class="contact-label">Call Us</div>
                        <div class="contact-value">+1 (555) 123-4567</div>
                    </div>
                    <div class="contact-item">
                        <div class="contact-icon">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <div class="contact-label">Email Us</div>
                        <div class="contact-value">rehoming@furryfriends.com</div>
                    </div>
                    <div class="contact-item">
                        <div class="contact-icon">
                            <i class="fas fa-clock"></i>
                        </div>
                        <div class="contact-label">Hours</div>
                        <div class="contact-value">Mon-Fri: 9AM-6PM</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Call to Action -->
        <div class="cta-section">
            <h2>Ready to Start the Rehoming Process?</h2>
            <p>
                Take the first step toward finding your pet a loving new home. Our caring team will guide you through the entire process.
            </p>
            <a href="{{ route('rehoming.start') }}" class="start-btn">
                <i class="fas fa-play"></i>
                Get Started Now
            </a>
        </div>
    </div>
</div>
@endsection