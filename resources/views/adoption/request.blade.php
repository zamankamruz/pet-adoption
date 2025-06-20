<?php
// File: request.blade.php
// Path: /resources/views/adoption/request.blade.php
?>

@extends('layouts.app')

@section('content')
<style>
    .adoption-request-container {
        background: #f8fafc;
        min-height: 100vh;
        padding: 2rem 0;
    }
    
    .request-header {
        background: white;
        padding: 2rem 0;
        margin-bottom: 2rem;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }
    
    .request-header .container {
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
    
    .pet-header-info {
        display: flex;
        align-items: center;
        gap: 1.5rem;
    }
    
    .pet-header-image {
        width: 100px;
        height: 100px;
        border-radius: 15px;
        object-fit: cover;
        border: 3px solid #8B5CF6;
    }
    
    .pet-header-details h1 {
        font-size: 2rem;
        font-weight: bold;
        color: #1f2937;
        margin-bottom: 0.5rem;
    }
    
    .pet-header-details .pet-breed {
        color: #8B5CF6;
        font-weight: 500;
        margin-bottom: 0.5rem;
    }
    
    .pet-header-details .pet-location {
        color: #6b7280;
        display: flex;
        align-items: center;
        gap: 0.25rem;
    }
    
    .request-content {
        max-width: 1000px;
        margin: 0 auto;
        padding: 0 1rem;
    }
    
    .form-container {
        background: white;
        border-radius: 15px;
        padding: 2rem;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    }
    
    .form-progress {
        display: flex;
        justify-content: space-between;
        margin-bottom: 3rem;
        position: relative;
    }
    
    .form-progress::before {
        content: '';
        position: absolute;
        top: 15px;
        left: 0;
        right: 0;
        height: 2px;
        background: #e5e7eb;
        z-index: 0;
    }
    
    .form-progress::after {
        content: '';
        position: absolute;
        top: 15px;
        left: 0;
        width: 50%;
        height: 2px;
        background: #8B5CF6;
        z-index: 1;
        transition: width 0.3s;
    }
    
    .progress-step {
        position: relative;
        z-index: 2;
        background: white;
        text-align: center;
        padding: 0 1rem;
    }
    
    .progress-circle {
        width: 30px;
        height: 30px;
        border-radius: 50%;
        background: #e5e7eb;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 0.5rem;
        font-weight: bold;
        color: #6b7280;
    }
    
    .progress-step.active .progress-circle {
        background: #8B5CF6;
        color: white;
    }
    
    .progress-step.completed .progress-circle {
        background: #10b981;
        color: white;
    }
    
    .progress-label {
        font-size: 0.9rem;
        color: #6b7280;
    }
    
    .progress-step.active .progress-label {
        color: #8B5CF6;
        font-weight: 500;
    }
    
    .form-section {
        margin-bottom: 2rem;
    }
    
    .section-title {
        font-size: 1.5rem;
        font-weight: bold;
        color: #1f2937;
        margin-bottom: 0.5rem;
    }
    
    .section-subtitle {
        color: #6b7280;
        margin-bottom: 2rem;
        line-height: 1.5;
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
    
    .required {
        color: #ef4444;
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
    
    .form-select {
        width: 100%;
        padding: 12px 16px;
        border: 2px solid #e5e7eb;
        border-radius: 10px;
        font-size: 1rem;
        background: #f9fafb;
        transition: all 0.3s;
    }
    
    .form-select:focus {
        outline: none;
        border-color: #8B5CF6;
        background: white;
    }
    
    .checkbox-group {
        display: flex;
        flex-direction: column;
        gap: 0.75rem;
    }
    
    .checkbox-item {
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }
    
    .checkbox-item input {
        accent-color: #8B5CF6;
    }
    
    .radio-group {
        display: flex;
        gap: 2rem;
        flex-wrap: wrap;
    }
    
    .radio-item {
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }
    
    .radio-item input {
        accent-color: #8B5CF6;
    }
    
    .form-textarea {
        resize: vertical;
        min-height: 120px;
    }
    
    .form-buttons {
        display: flex;
        gap: 1rem;
        justify-content: flex-end;
        margin-top: 2rem;
        padding-top: 2rem;
        border-top: 1px solid #e5e7eb;
    }
    
    .btn {
        padding: 12px 24px;
        border-radius: 10px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        border: none;
    }
    
    .btn-primary {
        background: linear-gradient(135deg, #8B5CF6, #A855F7);
        color: white;
    }
    
    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(139, 92, 246, 0.3);
    }
    
    .btn-secondary {
        background: transparent;
        border: 2px solid #6b7280;
        color: #6b7280;
    }
    
    .btn-secondary:hover {
        background: #6b7280;
        color: white;
    }
    
    .help-text {
        font-size: 0.875rem;
        color: #6b7280;
        margin-top: 0.25rem;
        line-height: 1.4;
    }
    
    .requirements-box {
        background: #f0f9ff;
        border: 1px solid #0ea5e9;
        border-radius: 10px;
        padding: 1.5rem;
        margin-bottom: 2rem;
    }
    
    .requirements-box h4 {
        color: #0c4a6e;
        font-weight: 600;
        margin-bottom: 1rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }
    
    .requirements-list {
        list-style: none;
        padding: 0;
        margin: 0;
    }
    
    .requirements-list li {
        color: #0c4a6e;
        margin-bottom: 0.5rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }
    
    .requirements-list li i {
        color: #10b981;
    }
    
    @media (max-width: 768px) {
        .pet-header-info {
            flex-direction: column;
            text-align: center;
        }
        
        .form-row {
            grid-template-columns: 1fr;
        }
        
        .form-progress {
            flex-direction: column;
            align-items: center;
            gap: 1rem;
        }
        
        .form-progress::before,
        .form-progress::after {
            display: none;
        }
        
        .radio-group {
            flex-direction: column;
            gap: 1rem;
        }
        
        .form-buttons {
            flex-direction: column;
        }
    }
</style>

<div class="adoption-request-container">
    <!-- Header -->
    <div class="request-header">
        <div class="container">
            <div class="breadcrumb">
                <a href="{{ route('home') }}">Home</a> > 
                <a href="{{ route('pets.show', $pet) }}">{{ $pet->name }}</a> > 
                Adoption Request
            </div>
            
            <div class="pet-header-info">
                <img src="{{ $pet->main_image_url }}" alt="{{ $pet->name }}" class="pet-header-image">
                <div class="pet-header-details">
                    <h1>Adopt {{ $pet->name }}</h1>
                    <div class="pet-breed">{{ $pet->breed->name }}</div>
                    <div class="pet-location">
                        <i class="fas fa-map-marker-alt"></i>
                        {{ $pet->location->city }}, {{ $pet->location->state }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Content -->
    <div class="request-content">
        <div class="form-container">
            <!-- Progress Steps -->
            <div class="form-progress">
                <div class="progress-step active">
                    <div class="progress-circle">1</div>
                    <div class="progress-label">Application</div>
                </div>
                <div class="progress-step">
                    <div class="progress-circle">2</div>
                    <div class="progress-label">Review</div>
                </div>
                <div class="progress-step">
                    <div class="progress-circle">3</div>
                    <div class="progress-label">Meet & Greet</div>
                </div>
                <div class="progress-step">
                    <div class="progress-circle">4</div>
                    <div class="progress-label">Adoption</div>
                </div>
            </div>

            <!-- Requirements Box -->
            <div class="requirements-box">
                <h4>
                    <i class="fas fa-info-circle"></i>
                    Before You Apply
                </h4>
                <ul class="requirements-list">
                    <li><i class="fas fa-check"></i> You must be 18 years or older</li>
                    <li><i class="fas fa-check"></i> All family members must agree to the adoption</li>
                    <li><i class="fas fa-check"></i> If renting, you must have landlord permission</li>
                    <li><i class="fas fa-check"></i> Be prepared for a home visit if approved</li>
                    <li><i class="fas fa-check"></i> Have a plan for veterinary care</li>
                </ul>
            </div>

            @if ($errors->any())
                <div style="background: #fee2e2; color: #dc2626; padding: 1rem; border-radius: 10px; margin-bottom: 2rem;">
                    <h4 style="margin: 0 0 0.5rem 0;">Please correct the following errors:</h4>
                    <ul style="margin: 0; padding-left: 1.5rem;">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('adoption.request.submit', $pet) }}" id="adoptionForm">
                @csrf

                <!-- Personal Information -->
                <div class="form-section">
                    <h2 class="section-title">Personal Information</h2>
                    <p class="section-subtitle">Tell us about yourself and your living situation.</p>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="full_name">Full Name <span class="required">*</span></label>
                            <input type="text" id="full_name" name="full_name" class="form-control @error('full_name') is-invalid @enderror" 
                                   value="{{ old('full_name', auth()->user()->name) }}" required>
                            @error('full_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="email">Email Address <span class="required">*</span></label>
                            <input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror" 
                                   value="{{ old('email', auth()->user()->email) }}" required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="phone">Phone Number <span class="required">*</span></label>
                            <input type="tel" id="phone" name="phone" class="form-control @error('phone') is-invalid @enderror" 
                                   value="{{ old('phone', auth()->user()->phone) }}" required>
                            @error('phone')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="age">Age <span class="required">*</span></label>
                            <select id="age" name="age" class="form-select @error('age') is-invalid @enderror" required>
                                <option value="">Select your age range</option>
                                <option value="18-25" {{ old('age') === '18-25' ? 'selected' : '' }}>18-25</option>
                                <option value="26-35" {{ old('age') === '26-35' ? 'selected' : '' }}>26-35</option>
                                <option value="36-45" {{ old('age') === '36-45' ? 'selected' : '' }}>36-45</option>
                                <option value="46-55" {{ old('age') === '46-55' ? 'selected' : '' }}>46-55</option>
                                <option value="56-65" {{ old('age') === '56-65' ? 'selected' : '' }}>56-65</option>
                                <option value="65+" {{ old('age') === '65+' ? 'selected' : '' }}>65+</option>
                            </select>
                            @error('age')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="address">Address <span class="required">*</span></label>
                        <input type="text" id="address" name="address" class="form-control @error('address') is-invalid @enderror" 
                               value="{{ old('address', auth()->user()->address) }}" required>
                        @error('address')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Housing Information -->
                <div class="form-section">
                    <h2 class="section-title">Housing Information</h2>
                    <p class="section-subtitle">Help us understand your living environment.</p>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="housing_type">Type of Housing <span class="required">*</span></label>
                            <select id="housing_type" name="housing_type" class="form-select @error('housing_type') is-invalid @enderror" required>
                                <option value="">Select housing type</option>
                                <option value="house" {{ old('housing_type') === 'house' ? 'selected' : '' }}>House</option>
                                <option value="apartment" {{ old('housing_type') === 'apartment' ? 'selected' : '' }}>Apartment</option>
                                <option value="condo" {{ old('housing_type') === 'condo' ? 'selected' : '' }}>Condo</option>
                                <option value="townhouse" {{ old('housing_type') === 'townhouse' ? 'selected' : '' }}>Townhouse</option>
                                <option value="other" {{ old('housing_type') === 'other' ? 'selected' : '' }}>Other</option>
                            </select>
                            @error('housing_type')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="own_rent">Do you own or rent? <span class="required">*</span></label>
                            <select id="own_rent" name="own_rent" class="form-select @error('own_rent') is-invalid @enderror" required>
                                <option value="">Select option</option>
                                <option value="own" {{ old('own_rent') === 'own' ? 'selected' : '' }}>Own</option>
                                <option value="rent" {{ old('own_rent') === 'rent' ? 'selected' : '' }}>Rent</option>
                            </select>
                            @error('own_rent')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Do you have a yard?</label>
                        <div class="radio-group">
                            <div class="radio-item">
                                <input type="radio" id="yard_yes" name="has_yard" value="1" 
                                       {{ old('has_yard') === '1' ? 'checked' : '' }}>
                                <label for="yard_yes">Yes</label>
                            </div>
                            <div class="radio-item">
                                <input type="radio" id="yard_no" name="has_yard" value="0" 
                                       {{ old('has_yard') === '0' ? 'checked' : '' }}>
                                <label for="yard_no">No</label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group" id="yardTypeGroup" style="display: none;">
                        <label for="yard_type">Yard Type</label>
                        <select id="yard_type" name="yard_type" class="form-select">
                            <option value="">Select yard type</option>
                            <option value="fenced" {{ old('yard_type') === 'fenced' ? 'selected' : '' }}>Fully Fenced</option>
                            <option value="partially_fenced" {{ old('yard_type') === 'partially_fenced' ? 'selected' : '' }}>Partially Fenced</option>
                            <option value="unfenced" {{ old('yard_type') === 'unfenced' ? 'selected' : '' }}>Unfenced</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="household_members">Number of people in household</label>
                        <select id="household_members" name="household_members" class="form-select">
                            <option value="">Select number</option>
                            <option value="1" {{ old('household_members') === '1' ? 'selected' : '' }}>1</option>
                            <option value="2" {{ old('household_members') === '2' ? 'selected' : '' }}>2</option>
                            <option value="3" {{ old('household_members') === '3' ? 'selected' : '' }}>3</option>
                            <option value="4" {{ old('household_members') === '4' ? 'selected' : '' }}>4</option>
                            <option value="5+" {{ old('household_members') === '5+' ? 'selected' : '' }}>5+</option>
                        </select>
                    </div>
                </div>

                <!-- Pet Experience -->
                <div class="form-section">
                    <h2 class="section-title">Pet Experience</h2>
                    <p class="section-subtitle">Tell us about your experience with pets.</p>

                    <div class="form-group">
                        <label>Have you owned pets before?</label>
                        <div class="radio-group">
                            <div class="radio-item">
                                <input type="radio" id="prev_pets_yes" name="previous_pets" value="1" 
                                       {{ old('previous_pets') === '1' ? 'checked' : '' }}>
                                <label for="prev_pets_yes">Yes</label>
                            </div>
                            <div class="radio-item">
                                <input type="radio" id="prev_pets_no" name="previous_pets" value="0" 
                                       {{ old('previous_pets') === '0' ? 'checked' : '' }}>
                                <label for="prev_pets_no">No</label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group" id="prevPetsDetails" style="display: none;">
                        <label for="previous_pets_details">Please describe your previous pets</label>
                        <textarea id="previous_pets_details" name="previous_pets_details" class="form-control form-textarea" 
                                  placeholder="Tell us about the types of pets you've had, how long you had them, etc.">{{ old('previous_pets_details') }}</textarea>
                    </div>

                    <div class="form-group">
                        <label for="current_pets">Do you currently have any pets? (Describe them)</label>
                        <textarea id="current_pets" name="current_pets" class="form-control form-textarea" 
                                  placeholder="List any current pets, their ages, breeds, etc. If none, write 'None'">{{ old('current_pets') }}</textarea>
                    </div>

                    <div class="form-group">
                        <label for="veterinarian">Do you have a veterinarian?</label>
                        <input type="text" id="veterinarian" name="veterinarian" class="form-control" 
                               value="{{ old('veterinarian') }}" placeholder="Veterinarian name and contact (if applicable)">
                        <div class="help-text">If you don't have one yet, that's okay! We can provide recommendations.</div>
                    </div>
                </div>

                <!-- Adoption Details -->
                <div class="form-section">
                    <h2 class="section-title">About This Adoption</h2>
                    <p class="section-subtitle">Help us understand why {{ $pet->name }} is right for you.</p>

                    <div class="form-group">
                        <label for="adoption_reason">Why do you want to adopt {{ $pet->name }}? <span class="required">*</span></label>
                        <textarea id="adoption_reason" name="adoption_reason" class="form-control form-textarea @error('adoption_reason') is-invalid @enderror" 
                                  placeholder="Tell us what drew you to {{ $pet->name }} and why you think you'd be a good match" required>{{ old('adoption_reason') }}</textarea>
                        @error('adoption_reason')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="daily_routine">Describe {{ $pet->name }}'s typical day with you</label>
                        <textarea id="daily_routine" name="daily_routine" class="form-control form-textarea" 
                                  placeholder="Where will {{ $pet->name }} sleep? How much exercise will they get? Who will care for them during the day?">{{ old('daily_routine') }}</textarea>
                    </div>

                    <div class="form-group">
                        <label for="emergency_plan">What's your plan if you can no longer care for {{ $pet->name }}?</label>
                        <textarea id="emergency_plan" name="emergency_plan" class="form-control form-textarea" 
                                  placeholder="Life circumstances can change. What would you do to ensure {{ $pet->name }}'s wellbeing?">{{ old('emergency_plan') }}</textarea>
                    </div>
                </div>

                <!-- Agreement -->
                <div class="form-section">
                    <div class="checkbox-group">
                        <div class="checkbox-item">
                            <input type="checkbox" id="agree_terms" name="agree_terms" value="1" required 
                                   {{ old('agree_terms') ? 'checked' : '' }}>
                            <label for="agree_terms">
                                I agree to the <a href="/terms" target="_blank" style="color: #8B5CF6;">adoption terms and conditions</a> 
                                and understand that providing false information may result in application rejection.
                            </label>
                        </div>
                        <div class="checkbox-item">
                            <input type="checkbox" id="agree_contact" name="agree_contact" value="1" required 
                                   {{ old('agree_contact') ? 'checked' : '' }}>
                            <label for="agree_contact">
                                I agree to be contacted by phone or email regarding this application and understand 
                                that a home visit may be required.
                            </label>
                        </div>
                    </div>
                </div>

                <!-- Form Buttons -->
                <div class="form-buttons">
                    <a href="{{ route('pets.show', $pet) }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i>
                        Back to {{ $pet->name }}
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-paper-plane"></i>
                        Submit Application
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Show/hide yard type based on yard selection
    const yardRadios = document.querySelectorAll('input[name="has_yard"]');
    const yardTypeGroup = document.getElementById('yardTypeGroup');
    
    yardRadios.forEach(radio => {
        radio.addEventListener('change', function() {
            if (this.value === '1') {
                yardTypeGroup.style.display = 'block';
            } else {
                yardTypeGroup.style.display = 'none';
            }
        });
    });
    
    // Show/hide previous pets details
    const prevPetsRadios = document.querySelectorAll('input[name="previous_pets"]');
    const prevPetsDetails = document.getElementById('prevPetsDetails');
    
    prevPetsRadios.forEach(radio => {
        radio.addEventListener('change', function() {
            if (this.value === '1') {
                prevPetsDetails.style.display = 'block';
            } else {
                prevPetsDetails.style.display = 'none';
            }
        });
    });
    
    // Initialize visibility based on old values
    if (document.querySelector('input[name="has_yard"]:checked')?.value === '1') {
        yardTypeGroup.style.display = 'block';
    }
    
    if (document.querySelector('input[name="previous_pets"]:checked')?.value === '1') {
        prevPetsDetails.style.display = 'block';
    }
    
    // Form validation
    const form = document.getElementById('adoptionForm');
    form.addEventListener('submit', function(e) {
        const requiredFields = form.querySelectorAll('[required]');
        let isValid = true;
        
        requiredFields.forEach(field => {
            if (!field.value.trim()) {
                field.classList.add('is-invalid');
                isValid = false;
            } else {
                field.classList.remove('is-invalid');
            }
        });
        
        if (!isValid) {
            e.preventDefault();
            document.querySelector('.is-invalid').scrollIntoView({ behavior: 'smooth', block: 'center' });
        }
    });
});
</script>
@endsection