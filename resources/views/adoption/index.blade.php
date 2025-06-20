<?php
// File: index.blade.php
// Path: /resources/views/adoption/index.blade.php
?>

@extends('layouts.app')

@section('content')
<style>
    .adoption-container {
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
    
    .hero-stats {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 2rem;
        margin-top: 3rem;
    }
    
    .stat-item {
        text-align: center;
    }
    
    .stat-number {
        font-size: 2.5rem;
        font-weight: bold;
        margin-bottom: 0.5rem;
    }
    
    .stat-label {
        font-size: 1rem;
        opacity: 0.9;
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
    
    .pets-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        gap: 2rem;
        margin-bottom: 3rem;
    }
    
    .pet-card {
        background: white;
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        transition: all 0.3s;
        border: 2px solid transparent;
    }
    
    .pet-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 25px rgba(0,0,0,0.15);
        border-color: #8B5CF6;
    }
    
    .pet-image {
        width: 100%;
        height: 250px;
        object-fit: cover;
        transition: transform 0.3s;
    }
    
    .pet-card:hover .pet-image {
        transform: scale(1.05);
    }
    
    .pet-info {
        padding: 1.5rem;
    }
    
    .pet-name {
        font-size: 1.3rem;
        font-weight: bold;
        color: #1f2937;
        margin-bottom: 0.5rem;
    }
    
    .pet-breed {
        color: #8B5CF6;
        font-weight: 500;
        margin-bottom: 0.5rem;
    }
    
    .pet-location {
        color: #6b7280;
        font-size: 0.9rem;
        margin-bottom: 1rem;
        display: flex;
        align-items: center;
        gap: 0.25rem;
    }
    
    .pet-description {
        color: #6b7280;
        line-height: 1.5;
        margin-bottom: 1rem;
        font-size: 0.95rem;
    }
    
    .pet-tags {
        display: flex;
        flex-wrap: wrap;
        gap: 0.5rem;
        margin-bottom: 1rem;
    }
    
    .pet-tag {
        background: #f3f4f6;
        color: #374151;
        padding: 0.25rem 0.75rem;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 500;
    }
    
    .pet-tag.featured {
        background: #fef3c7;
        color: #92400e;
    }
    
    .pet-tag.urgent {
        background: #fee2e2;
        color: #dc2626;
    }
    
    .adopt-btn {
        width: 100%;
        background: linear-gradient(135deg, #8B5CF6, #A855F7);
        color: white;
        border: none;
        padding: 0.75rem 1rem;
        border-radius: 8px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s;
        text-decoration: none;
        display: block;
        text-align: center;
    }
    
    .adopt-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(139, 92, 246, 0.3);
    }
    
    .view-all-btn {
        display: block;
        margin: 0 auto;
        padding: 1rem 2rem;
        background: transparent;
        border: 2px solid #8B5CF6;
        color: #8B5CF6;
        border-radius: 10px;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.3s;
    }
    
    .view-all-btn:hover {
        background: #8B5CF6;
        color: white;
        transform: translateY(-2px);
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
    
    .info-cards {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 2rem;
        margin-top: 3rem;
    }
    
    .info-card {
        background: white;
        border-radius: 15px;
        padding: 2rem;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        text-align: center;
    }
    
    .info-card-icon {
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
    
    .info-card h3 {
        font-size: 1.3rem;
        font-weight: bold;
        color: #1f2937;
        margin-bottom: 1rem;
    }
    
    .info-card p {
        color: #6b7280;
        line-height: 1.6;
    }
    
    .cta-section {
        background: linear-gradient(135deg, #f8fafc, #e5e7eb);
        border-radius: 20px;
        padding: 3rem;
        text-align: center;
        margin-top: 3rem;
    }
    
    .cta-section h2 {
        font-size: 2rem;
        font-weight: bold;
        color: #1f2937;
        margin-bottom: 1rem;
    }
    
    .cta-section p {
        color: #6b7280;
        font-size: 1.1rem;
        margin-bottom: 2rem;
    }
    
    .cta-buttons {
        display: flex;
        justify-content: center;
        gap: 1rem;
        flex-wrap: wrap;
    }
    
    .cta-btn {
        padding: 1rem 2rem;
        border-radius: 10px;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.3s;
    }
    
    .cta-btn.primary {
        background: linear-gradient(135deg, #8B5CF6, #A855F7);
        color: white;
    }
    
    .cta-btn.primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(139, 92, 246, 0.3);
    }
    
    .cta-btn.secondary {
        background: white;
        color: #8B5CF6;
        border: 2px solid #8B5CF6;
    }
    
    .cta-btn.secondary:hover {
        background: #8B5CF6;
        color: white;
    }
    
    @media (max-width: 768px) {
        .hero-content h1 {
            font-size: 2rem;
        }
        
        .hero-stats {
            grid-template-columns: 1fr;
            gap: 1rem;
        }
        
        .pets-grid {
            grid-template-columns: 1fr;
        }
        
        .process-steps {
            grid-template-columns: 1fr;
        }
        
        .process-step:not(:last-child)::after {
            display: none;
        }
        
        .info-cards {
            grid-template-columns: 1fr;
        }
        
        .cta-buttons {
            flex-direction: column;
            align-items: center;
        }
    }
</style>

<div class="adoption-container">
    <!-- Hero Section -->
    <div class="hero-section">
        <div class="hero-content">
            <h1>Find Your Perfect Companion</h1>
            <p>Every pet deserves a loving home. Browse our amazing animals waiting for their forever families and start your adoption journey today.</p>
            
            <div class="hero-stats">
                <div class="stat-item">
                    <div class="stat-number">{{ $stats['available_pets'] ?? 0 }}</div>
                    <div class="stat-label">Pets Available</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number">{{ $stats['happy_families'] ?? 0 }}</div>
                    <div class="stat-label">Happy Families</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number">{{ $stats['success_rate'] ?? 95 }}%</div>
                    <div class="stat-label">Success Rate</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <!-- Featured Pets Section -->
        <div class="section-header">
            <h2 class="section-title">Featured Pets</h2>
            <p class="section-subtitle">
                Meet some of our special animals who are looking for their forever homes. 
                Each one has a unique personality and is ready to bring joy to your family.
            </p>
        </div>

        @if($featuredPets->count() > 0)
            <div class="pets-grid">
                @foreach($featuredPets as $pet)
                    <div class="pet-card">
                        <img src="{{ $pet->main_image_url }}" alt="{{ $pet->name }}" class="pet-image">
                        <div class="pet-info">
                            <h3 class="pet-name">{{ $pet->name }}</h3>
                            <div class="pet-breed">{{ $pet->breed->name }}</div>
                            <div class="pet-location">
                                <i class="fas fa-map-marker-alt"></i>
                                {{ $pet->location->city }}, {{ $pet->location->state }}
                            </div>
                            <p class="pet-description">{{ Str::limit($pet->description, 120) }}</p>
                            <div class="pet-tags">
                                <span class="pet-tag">{{ ucfirst($pet->gender) }}</span>
                                <span class="pet-tag">{{ $pet->age_display }}</span>
                                <span class="pet-tag">{{ ucfirst($pet->size) }}</span>
                                @if($pet->is_featured)
                                    <span class="pet-tag featured">Featured</span>
                                @endif
                                @if($pet->is_urgent)
                                    <span class="pet-tag urgent">Urgent</span>
                                @endif
                            </div>
                            <a href="{{ route('pets.show', $pet) }}" class="adopt-btn">
                                <i class="fas fa-heart"></i>
                                Meet {{ $pet->name }}
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>

            <a href="{{ route('pets.index') }}" class="view-all-btn">
                <i class="fas fa-paw"></i>
                View All Available Pets
            </a>
        @else
            <div style="text-align: center; padding: 3rem; color: #6b7280;">
                <i class="fas fa-heart" style="font-size: 4rem; margin-bottom: 1rem; color: #d1d5db;"></i>
                <h3>No featured pets at the moment</h3>
                <p>Check back soon for amazing pets looking for homes!</p>
            </div>
        @endif

        <!-- Adoption Process Section -->
        <div class="process-section">
            <div class="section-header">
                <h2 class="section-title">How Adoption Works</h2>
                <p class="section-subtitle">
                    Our simple 3-step process makes it easy to find and adopt your new best friend.
                </p>
            </div>

            <div class="process-steps">
                <div class="process-step">
                    <div class="step-icon">
                        <i class="fas fa-search"></i>
                    </div>
                    <h3 class="step-title">Browse & Choose</h3>
                    <p class="step-description">
                        Browse our available pets and find the one that captures your heart. 
                        Use our filters to find pets that match your lifestyle.
                    </p>
                </div>
                <div class="process-step">
                    <div class="step-icon">
                        <i class="fas fa-file-alt"></i>
                    </div>
                    <h3 class="step-title">Apply & Meet</h3>
                    <p class="step-description">
                        Submit an adoption application and schedule a meet-and-greet. 
                        We'll help ensure it's a perfect match for both you and the pet.
                    </p>
                </div>
                <div class="process-step">
                    <div class="step-icon">
                        <i class="fas fa-home"></i>
                    </div>
                    <h3 class="step-title">Take Home</h3>
                    <p class="step-description">
                        Once approved, complete the adoption process and welcome your new 
                        family member home. We provide ongoing support when needed.
                    </p>
                </div>
            </div>
        </div>

        <!-- Information Cards -->
        <div class="info-cards">
            <div class="info-card">
                <div class="info-card-icon">
                    <i class="fas fa-clipboard-list"></i>
                </div>
                <h3>Adoption Requirements</h3>
                <p>
                    Learn about our adoption requirements and what you need to know 
                    before bringing a pet home. We want to ensure every adoption is successful.
                </p>
                <a href="{{ route('adoption.requirements') }}" style="color: #8B5CF6; text-decoration: none; font-weight: 500; margin-top: 1rem; display: inline-block;">
                    View Requirements <i class="fas fa-arrow-right"></i>
                </a>
            </div>
            <div class="info-card">
                <div class="info-card-icon">
                    <i class="fas fa-question-circle"></i>
                </div>
                <h3>Adoption FAQs</h3>
                <p>
                    Have questions about the adoption process? Check out our frequently 
                    asked questions to get answers to common adoption concerns.
                </p>
                <a href="{{ route('faq.adopters') }}" style="color: #8B5CF6; text-decoration: none; font-weight: 500; margin-top: 1rem; display: inline-block;">
                    Read FAQs <i class="fas fa-arrow-right"></i>
                </a>
            </div>
        </div>

        <!-- Call to Action Section -->
        <div class="cta-section">
            <h2>Ready to Change a Life?</h2>
            <p>
                Start your adoption journey today and give a deserving pet the loving home they've been waiting for.
            </p>
            <div class="cta-buttons">
                <a href="{{ route('pets.index') }}" class="cta-btn primary">
                    <i class="fas fa-search"></i>
                    Browse Available Pets
                </a>
                <a href="{{ route('adoption.how-it-works') }}" class="cta-btn secondary">
                    <i class="fas fa-info-circle"></i>
                    Learn More
                </a>
            </div>
        </div>
    </div>
</div>
@endsection