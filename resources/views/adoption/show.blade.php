<?php
// File: show.blade.php
// Path: /resources/views/adoption/show.blade.php
?>

@extends('layouts.app')

@section('content')
<style>
    .adoption-detail-container {
        background: #f8fafc;
        min-height: 100vh;
        padding: 2rem 0;
    }
    
    .adoption-header {
        background: white;
        padding: 2rem 0;
        margin-bottom: 2rem;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }
    
    .adoption-header .container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 1rem;
    }
    
    .breadcrumb {
        color: #6b7280;
        margin-bottom: 1rem;
    }
    
    .breadcrumb a {
        color: #8B5CF6;
        text-decoration: none;
    }
    
    .adoption-title {
        display: flex;
        align-items: center;
        gap: 1rem;
        margin-bottom: 1rem;
    }
    
    .status-badge {
        padding: 0.5rem 1rem;
        border-radius: 20px;
        font-size: 0.9rem;
        font-weight: 600;
        text-transform: uppercase;
    }
    
    .status-pending {
        background: #fef3c7;
        color: #92400e;
    }
    
    .status-approved {
        background: #d1fae5;
        color: #065f46;
    }
    
    .status-rejected {
        background: #fee2e2;
        color: #dc2626;
    }
    
    .status-completed {
        background: #e0e7ff;
        color: #3730a3;
    }
    
    .reference-number {
        color: #6b7280;
        font-size: 1rem;
    }
    
    .adoption-content {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 1rem;
        display: grid;
        grid-template-columns: 2fr 1fr;
        gap: 2rem;
    }
    
    .adoption-main {
        background: white;
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    }
    
    .pet-summary {
        padding: 2rem;
        background: linear-gradient(135deg, #f8fafc, #e5e7eb);
        border-bottom: 1px solid #e5e7eb;
    }
    
    .pet-info-row {
        display: flex;
        align-items: center;
        gap: 1.5rem;
    }
    
    .pet-image {
        width: 120px;
        height: 120px;
        border-radius: 15px;
        object-fit: cover;
        border: 3px solid #8B5CF6;
    }
    
    .pet-details h2 {
        font-size: 1.8rem;
        font-weight: bold;
        color: #1f2937;
        margin-bottom: 0.5rem;
    }
    
    .pet-details .pet-breed {
        color: #8B5CF6;
        font-weight: 500;
        margin-bottom: 0.5rem;
    }
    
    .pet-details .pet-location {
        color: #6b7280;
        display: flex;
        align-items: center;
        gap: 0.25rem;
    }
    
    .application-details {
        padding: 2rem;
    }
    
    .section-title {
        font-size: 1.3rem;
        font-weight: bold;
        color: #1f2937;
        margin-bottom: 1.5rem;
        padding-bottom: 0.5rem;
        border-bottom: 2px solid #f1f5f9;
    }
    
    .form-section {
        margin-bottom: 2rem;
    }
    
    .form-section h4 {
        font-size: 1.1rem;
        font-weight: 600;
        color: #374151;
        margin-bottom: 1rem;
    }
    
    .form-data {
        background: #f8fafc;
        border-radius: 10px;
        padding: 1.5rem;
        border-left: 4px solid #8B5CF6;
    }
    
    .form-row {
        display: grid;
        grid-template-columns: 1fr 2fr;
        gap: 1rem;
        margin-bottom: 1rem;
        align-items: start;
    }
    
    .form-row:last-child {
        margin-bottom: 0;
    }
    
    .form-label {
        font-weight: 500;
        color: #374151;
    }
    
    .form-value {
        color: #6b7280;
        word-wrap: break-word;
    }
    
    .adoption-sidebar {
        display: flex;
        flex-direction: column;
        gap: 1.5rem;
    }
    
    .info-card {
        background: white;
        border-radius: 15px;
        padding: 1.5rem;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    }
    
    .card-title {
        font-size: 1.2rem;
        font-weight: bold;
        color: #1f2937;
        margin-bottom: 1rem;
    }
    
    .timeline {
        position: relative;
    }
    
    .timeline-item {
        position: relative;
        padding-left: 2rem;
        margin-bottom: 1.5rem;
    }
    
    .timeline-item:last-child {
        margin-bottom: 0;
    }
    
    .timeline-item::before {
        content: '';
        position: absolute;
        left: 0;
        top: 0.5rem;
        width: 12px;
        height: 12px;
        border-radius: 50%;
        background: #e5e7eb;
    }
    
    .timeline-item.completed::before {
        background: #10b981;
    }
    
    .timeline-item.current::before {
        background: #8B5CF6;
    }
    
    .timeline-item::after {
        content: '';
        position: absolute;
        left: 5px;
        top: 1.25rem;
        width: 2px;
        height: calc(100% + 0.5rem);
        background: #e5e7eb;
    }
    
    .timeline-item:last-child::after {
        display: none;
    }
    
    .timeline-date {
        font-size: 0.9rem;
        color: #6b7280;
        margin-bottom: 0.25rem;
    }
    
    .timeline-title {
        font-weight: 600;
        color: #374151;
        margin-bottom: 0.25rem;
    }
    
    .timeline-description {
        font-size: 0.9rem;
        color: #6b7280;
    }
    
    .action-buttons {
        display: flex;
        flex-direction: column;
        gap: 1rem;
    }
    
    .btn {
        padding: 0.75rem 1rem;
        border-radius: 8px;
        font-weight: 600;
        text-decoration: none;
        display: block;
        text-align: center;
        transition: all 0.3s;
        border: none;
        cursor: pointer;
    }
    
    .btn-primary {
        background: linear-gradient(135deg, #8B5CF6, #A855F7);
        color: white;
    }
    
    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(139, 92, 246, 0.3);
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
    
    .btn-danger {
        background: transparent;
        border: 2px solid #ef4444;
        color: #ef4444;
    }
    
    .btn-danger:hover {
        background: #ef4444;
        color: white;
    }
    
    .btn:disabled {
        opacity: 0.6;
        cursor: not-allowed;
        transform: none;
    }
    
    .contact-info {
        border-top: 1px solid #e5e7eb;
        padding-top: 1rem;
        margin-top: 1rem;
    }
    
    .contact-item {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        margin-bottom: 0.5rem;
        color: #6b7280;
        font-size: 0.9rem;
    }
    
    .admin-notes {
        background: #fef3c7;
        border: 1px solid #f59e0b;
        border-radius: 8px;
        padding: 1rem;
        margin-top: 1rem;
    }
    
    .admin-notes h5 {
        color: #92400e;
        font-weight: 600;
        margin-bottom: 0.5rem;
    }
    
    .admin-notes p {
        color: #92400e;
        margin: 0;
        font-size: 0.9rem;
    }
    
    @media (max-width: 1024px) {
        .adoption-content {
            grid-template-columns: 1fr;
        }
        
        .adoption-sidebar {
            order: -1;
        }
    }
    
    @media (max-width: 768px) {
        .pet-info-row {
            flex-direction: column;
            text-align: center;
        }
        
        .form-row {
            grid-template-columns: 1fr;
            gap: 0.5rem;
        }
        
        .adoption-title {
            flex-direction: column;
            align-items: flex-start;
        }
    }
</style>

<div class="adoption-detail-container">
    <!-- Header -->
    <div class="adoption-header">
        <div class="container">
            <div class="breadcrumb">
                <a href="{{ route('home') }}">Home</a> > 
                <a href="{{ route('adoption.requests') }}">My Adoptions</a> > 
                Adoption Request
            </div>
            
            <div class="adoption-title">
                <h1>Adoption Request for {{ $adoption->pet->name }}</h1>
                <span class="status-badge status-{{ $adoption->status }}">
                    {{ ucfirst($adoption->status) }}
                </span>
            </div>
            
            <div class="reference-number">
                Reference: {{ $adoption->reference_number }}
            </div>
        </div>
    </div>

    <!-- Content -->
    <div class="adoption-content">
        <!-- Main Content -->
        <div class="adoption-main">
            <!-- Pet Summary -->
            <div class="pet-summary">
                <div class="pet-info-row">
                    <img src="{{ $adoption->pet->main_image_url }}" alt="{{ $adoption->pet->name }}" class="pet-image">
                    <div class="pet-details">
                        <h2>{{ $adoption->pet->name }}</h2>
                        <div class="pet-breed">{{ $adoption->pet->breed->name }}</div>
                        <div class="pet-location">
                            <i class="fas fa-map-marker-alt"></i>
                            {{ $adoption->pet->location->city }}, {{ $adoption->pet->location->state }}
                        </div>
                        <div style="margin-top: 1rem;">
                            <a href="{{ route('pets.show', $adoption->pet) }}" class="btn btn-outline" style="display: inline-block; padding: 0.5rem 1rem;">
                                <i class="fas fa-eye"></i>
                                View Pet Details
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Application Details -->
            <div class="application-details">
                <h3 class="section-title">Application Details</h3>

                <div class="form-section">
                    <h4>Personal Information</h4>
                    <div class="form-data">
                        <div class="form-row">
                            <div class="form-label">Full Name:</div>
                            <div class="form-value">{{ $adoption->application_data['full_name'] ?? 'N/A' }}</div>
                        </div>
                        <div class="form-row">
                            <div class="form-label">Email:</div>
                            <div class="form-value">{{ $adoption->application_data['email'] ?? 'N/A' }}</div>
                        </div>
                        <div class="form-row">
                            <div class="form-label">Phone:</div>
                            <div class="form-value">{{ $adoption->application_data['phone'] ?? 'N/A' }}</div>
                        </div>
                        <div class="form-row">
                            <div class="form-label">Address:</div>
                            <div class="form-value">{{ $adoption->application_data['address'] ?? 'N/A' }}</div>
                        </div>
                    </div>
                </div>

                <div class="form-section">
                    <h4>Housing Information</h4>
                    <div class="form-data">
                        <div class="form-row">
                            <div class="form-label">Housing Type:</div>
                            <div class="form-value">{{ ucfirst($adoption->application_data['housing_type'] ?? 'N/A') }}</div>
                        </div>
                        <div class="form-row">
                            <div class="form-label">Own or Rent:</div>
                            <div class="form-value">{{ ucfirst($adoption->application_data['own_rent'] ?? 'N/A') }}</div>
                        </div>
                        <div class="form-row">
                            <div class="form-label">Yard:</div>
                            <div class="form-value">{{ $adoption->application_data['has_yard'] ? 'Yes' : 'No' }}</div>
                        </div>
                        @if($adoption->application_data['has_yard'] ?? false)
                            <div class="form-row">
                                <div class="form-label">Yard Type:</div>
                                <div class="form-value">{{ ucfirst($adoption->application_data['yard_type'] ?? 'N/A') }}</div>
                            </div>
                        @endif
                    </div>
                </div>

                <div class="form-section">
                    <h4>Experience & Preferences</h4>
                    <div class="form-data">
                        <div class="form-row">
                            <div class="form-label">Previous Pet Experience:</div>
                            <div class="form-value">{{ $adoption->application_data['previous_pets'] ? 'Yes' : 'No' }}</div>
                        </div>
                        @if($adoption->application_data['previous_pets'] ?? false)
                            <div class="form-row">
                                <div class="form-label">Previous Pet Details:</div>
                                <div class="form-value">{{ $adoption->application_data['previous_pets_details'] ?? 'N/A' }}</div>
                            </div>
                        @endif
                        <div class="form-row">
                            <div class="form-label">Current Pets:</div>
                            <div class="form-value">{{ $adoption->application_data['current_pets'] ?? 'None' }}</div>
                        </div>
                        <div class="form-row">
                            <div class="form-label">Reason for Adoption:</div>
                            <div class="form-value">{{ $adoption->application_data['adoption_reason'] ?? 'N/A' }}</div>
                        </div>
                    </div>
                </div>

                @if($adoption->admin_notes)
                    <div class="admin-notes">
                        <h5>Administrator Notes</h5>
                        <p>{{ $adoption->admin_notes }}</p>
                    </div>
                @endif

                @if($adoption->rejection_reason && $adoption->status === 'rejected')
                    <div class="admin-notes" style="background: #fee2e2; border-color: #ef4444;">
                        <h5 style="color: #dc2626;">Rejection Reason</h5>
                        <p style="color: #dc2626;">{{ $adoption->rejection_reason }}</p>
                    </div>
                @endif
            </div>
        </div>

        <!-- Sidebar -->
        <div class="adoption-sidebar">
            <!-- Status Timeline -->
            <div class="info-card">
                <h3 class="card-title">Application Status</h3>
                <div class="timeline">
                    <div class="timeline-item completed">
                        <div class="timeline-date">{{ $adoption->requested_at->format('M d, Y') }}</div>
                        <div class="timeline-title">Application Submitted</div>
                        <div class="timeline-description">Your adoption request was received</div>
                    </div>
                    
                    @if($adoption->status === 'approved' || $adoption->status === 'completed')
                        <div class="timeline-item completed">
                            <div class="timeline-date">{{ $adoption->approved_at->format('M d, Y') }}</div>
                            <div class="timeline-title">Application Approved</div>
                            <div class="timeline-description">Your application has been approved</div>
                        </div>
                    @elseif($adoption->status === 'rejected')
                        <div class="timeline-item completed">
                            <div class="timeline-date">{{ $adoption->rejected_at->format('M d, Y') }}</div>
                            <div class="timeline-title">Application Rejected</div>
                            <div class="timeline-description">Your application was not approved</div>
                        </div>
                    @else
                        <div class="timeline-item current">
                            <div class="timeline-date">Pending</div>
                            <div class="timeline-title">Under Review</div>
                            <div class="timeline-description">We're reviewing your application</div>
                        </div>
                    @endif
                    
                    @if($adoption->status === 'completed')
                        <div class="timeline-item completed">
                            <div class="timeline-date">{{ $adoption->completed_at->format('M d, Y') }}</div>
                            <div class="timeline-title">Adoption Completed</div>
                            <div class="timeline-description">Welcome to the family!</div>
                        </div>
                    @elseif($adoption->status === 'approved')
                        <div class="timeline-item current">
                            <div class="timeline-date">Pending</div>
                            <div class="timeline-title">Final Steps</div>
                            <div class="timeline-description">Complete the adoption process</div>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Actions -->
            <div class="info-card">
                <h3 class="card-title">Actions</h3>
                <div class="action-buttons">
                    @if($adoption->status === 'pending')
                        <form method="POST" action="{{ route('adoption.requests.cancel', $adoption) }}" 
                              onsubmit="return confirm('Are you sure you want to cancel this adoption request?')">
                            @csrf
                            <button type="submit" class="btn btn-danger">
                                <i class="fas fa-times"></i>
                                Cancel Request
                            </button>
                        </form>
                    @endif
                    
                    <a href="{{ route('user.messages.create', ['user' => $adoption->pet->owner_id, 'pet' => $adoption->pet_id]) }}" 
                       class="btn btn-outline">
                        <i class="fas fa-envelope"></i>
                        Contact Owner
                    </a>
                    
                    <a href="{{ route('pets.show', $adoption->pet) }}" class="btn btn-outline">
                        <i class="fas fa-eye"></i>
                        View Pet Details
                    </a>
                </div>
            </div>

            <!-- Contact Information -->
            <div class="info-card">
                <h3 class="card-title">Need Help?</h3>
                <div class="contact-info">
                    <div class="contact-item">
                        <i class="fas fa-phone"></i>
                        <span>+1 (555) 123-4567</span>
                    </div>
                    <div class="contact-item">
                        <i class="fas fa-envelope"></i>
                        <span>adoptions@furryfriends.com</span>
                    </div>
                    <div class="contact-item">
                        <i class="fas fa-clock"></i>
                        <span>Mon-Fri: 9AM-6PM</span>
                    </div>
                </div>
                
                <a href="{{ route('contact') }}" class="btn btn-outline" style="margin-top: 1rem;">
                    <i class="fas fa-question-circle"></i>
                    Contact Support
                </a>
            </div>
        </div>
    </div>
</div>
@endsection