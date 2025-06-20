<?php
// File: step1.blade.php
// Path: /resources/views/rehoming/step1.blade.php
?>

@extends('layouts.app')

@section('content')
<style>
    .rehoming-step-container {
        background: #f8fafc;
        min-height: 100vh;
        padding: 2rem 0;
    }
    
    .step-header {
        background: white;
        padding: 2rem 0;
        margin-bottom: 2rem;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }
    
    .step-header .container {
        max-width: 1000px;
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
    
    .step-title {
        font-size: 2rem;
        font-weight: bold;
        color: #1f2937;
        margin-bottom: 0.5rem;
    }
    
    .step-subtitle {
        color: #6b7280;
        font-size: 1.1rem;
    }
    
    .step-content {
        max-width: 800px;
        margin: 0 auto;
        padding: 0 1rem;
    }
    
    .form-container {
        background: white;
        border-radius: 15px;
        padding: 2rem;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    }
    
    .progress-bar {
        background: #e5e7eb;
        height: 8px;
        border-radius: 4px;
        margin-bottom: 2rem;
        overflow: hidden;
    }
    
    .progress-fill {
        background: linear-gradient(135deg, #8B5CF6, #A855F7);
        height: 100%;
        width: 33.33%;
        border-radius: 4px;
        transition: width 0.3s;
    }
    
    .progress-text {
        text-align: center;
        color: #6b7280;
        font-size: 0.9rem;
        margin-bottom: 2rem;
    }
    
    .form-section {
        margin-bottom: 2rem;
    }
    
    .section-title {
        font-size: 1.3rem;
        font-weight: bold;
        color: #1f2937;
        margin-bottom: 1rem;
        padding-bottom: 0.5rem;
        border-bottom: 2px solid #f1f5f9;
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
    
    .form-textarea {
        resize: vertical;
        min-height: 120px;
        font-family: inherit;
    }
    
    .help-text {
        font-size: 0.875rem;
        color: #6b7280;
        margin-top: 0.25rem;
        line-height: 1.4;
    }
    
    .species-selection {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 1rem;
        margin-bottom: 1.5rem;
    }
    
    .species-option {
        text-align: center;
        padding: 1.5rem 1rem;
        border: 2px solid #e5e7eb;
        border-radius: 10px;
        cursor: pointer;
        transition: all 0.3s;
        background: white;
    }
    
    .species-option:hover {
        border-color: #8B5CF6;
        transform: translateY(-2px);
    }
    
    .species-option.selected {
        border-color: #8B5CF6;
        background: #f3f4f6;
        color: #8B5CF6;
    }
    
    .species-option i {
        font-size: 2rem;
        margin-bottom: 0.5rem;
        display: block;
    }
    
    .species-option .species-name {
        font-weight: 600;
        font-size: 0.9rem;
    }
    
    .size-options {
        display: flex;
        gap: 1rem;
        margin-bottom: 1rem;
    }
    
    .size-option {
        flex: 1;
        text-align: center;
        padding: 1rem;
        border: 2px solid #e5e7eb;
        border-radius: 10px;
        cursor: pointer;
        transition: all 0.3s;
        background: white;
    }
    
    .size-option:hover {
        border-color: #8B5CF6;
    }
    
    .size-option.selected {
        border-color: #8B5CF6;
        background: #8B5CF6;
        color: white;
    }
    
    .size-option i {
        font-size: 1.5rem;
        margin-bottom: 0.5rem;
        display: block;
    }
    
    .size-option .size-name {
        font-weight: 600;
        font-size: 0.9rem;
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
    
    .tips-box {
        background: #f0f9ff;
        border: 1px solid #0ea5e9;
        border-radius: 10px;
        padding: 1.5rem;
        margin-bottom: 2rem;
    }
    
    .tips-box h4 {
        color: #0c4a6e;
        font-weight: 600;
        margin-bottom: 1rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }
    
    .tips-list {
        list-style: none;
        padding: 0;
        margin: 0;
    }
    
    .tips-list li {
        color: #0c4a6e;
        margin-bottom: 0.5rem;
        display: flex;
        align-items: flex-start;
        gap: 0.5rem;
    }
    
    .tips-list li i {
        color: #10b981;
        margin-top: 0.25rem;
    }
    
    @media (max-width: 768px) {
        .form-row {
            grid-template-columns: 1fr;
        }
        
        .species-selection {
            grid-template-columns: repeat(2, 1fr);
        }
        
        .size-options {
            flex-direction: column;
        }
        
        .form-buttons {
            flex-direction: column;
        }
    }
</style>

<div class="rehoming-step-container">
    <!-- Header -->
    <div class="step-header">
        <div class="container">
            <div class="breadcrumb">
                <a href="{{ route('home') }}">Home</a> > 
                <a href="{{ route('rehoming.index') }}">Rehoming</a> > 
                Step 1 of 3
            </div>
            
            <h1 class="step-title">Tell Us About Your Pet</h1>
            <p class="step-subtitle">Help us create a profile that showcases your pet's unique personality and needs.</p>
        </div>
    </div>

    <!-- Content -->
    <div class="step-content">
        <div class="form-container">
            <!-- Progress Bar -->
            <div class="progress-bar">
                <div class="progress-fill"></div>
            </div>
            <p class="progress-text">Step 1 of 3: Basic Information</p>

            <!-- Tips Box -->
            <div class="tips-box">
                <h4>
                    <i class="fas fa-lightbulb"></i>
                    Tips for Step 1
                </h4>
                <ul class="tips-list">
                    <li><i class="fas fa-check"></i> Use your pet's actual name - it helps potential adopters connect</li>
                    <li><i class="fas fa-check"></i> Be specific about breed if known, or your best guess if mixed</li>
                    <li><i class="fas fa-check"></i> Honest descriptions help find the right match for your pet</li>
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

            <form method="POST" action="{{ route('rehoming.step1.store') }}" id="step1Form">
                @csrf

                <!-- Basic Information -->
                <div class="form-section">
                    <h3 class="section-title">Basic Information</h3>

                    <div class="form-group">
                        <label for="pet_name">Pet's Name <span class="required">*</span></label>
                        <input type="text" id="pet_name" name="pet_name" class="form-control @error('pet_name') is-invalid @enderror" 
                               value="{{ old('pet_name', $rehoming->pet_name ?? '') }}" required 
                               placeholder="What do you call your pet?">
                        @error('pet_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Species <span class="required">*</span></label>
                        <div class="species-selection">
                            <div class="species-option {{ old('species', $rehoming->species ?? '') === 'dog' ? 'selected' : '' }}" 
                                 onclick="selectSpecies('dog')">
                                <i class="fas fa-dog"></i>
                                <div class="species-name">Dog</div>
                            </div>
                            <div class="species-option {{ old('species', $rehoming->species ?? '') === 'cat' ? 'selected' : '' }}" 
                                 onclick="selectSpecies('cat')">
                                <i class="fas fa-cat"></i>
                                <div class="species-name">Cat</div>
                            </div>
                            <div class="species-option {{ old('species', $rehoming->species ?? '') === 'bird' ? 'selected' : '' }}" 
                                 onclick="selectSpecies('bird')">
                                <i class="fas fa-dove"></i>
                                <div class="species-name">Bird</div>
                            </div>
                            <div class="species-option {{ old('species', $rehoming->species ?? '') === 'other' ? 'selected' : '' }}" 
                                 onclick="selectSpecies('other')">
                                <i class="fas fa-paw"></i>
                                <div class="species-name">Other</div>
                            </div>
                        </div>
                        <input type="hidden" id="species" name="species" value="{{ old('species', $rehoming->species ?? '') }}" required>
                        @error('species')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="breed">Breed <span class="required">*</span></label>
                            <input type="text" id="breed" name="breed" class="form-control @error('breed') is-invalid @enderror" 
                                   value="{{ old('breed', $rehoming->breed ?? '') }}" required 
                                   placeholder="e.g., Golden Retriever, Mixed Breed">
                            <div class="help-text">If mixed breed, list the primary breeds if known</div>
                            @error('breed')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="age">Age <span class="required">*</span></label>
                            <select id="age" name="age" class="form-select @error('age') is-invalid @enderror" required>
                                <option value="">Select age</option>
                                <option value="Less than 1 year" {{ old('age', $rehoming->age ?? '') === 'Less than 1 year' ? 'selected' : '' }}>Less than 1 year</option>
                                <option value="1 year" {{ old('age', $rehoming->age ?? '') === '1 year' ? 'selected' : '' }}>1 year</option>
                                <option value="2 years" {{ old('age', $rehoming->age ?? '') === '2 years' ? 'selected' : '' }}>2 years</option>
                                <option value="3 years" {{ old('age', $rehoming->age ?? '') === '3 years' ? 'selected' : '' }}>3 years</option>
                                <option value="4 years" {{ old('age', $rehoming->age ?? '') === '4 years' ? 'selected' : '' }}>4 years</option>
                                <option value="5 years" {{ old('age', $rehoming->age ?? '') === '5 years' ? 'selected' : '' }}>5 years</option>
                                <option value="6 years" {{ old('age', $rehoming->age ?? '') === '6 years' ? 'selected' : '' }}>6 years</option>
                                <option value="7 years" {{ old('age', $rehoming->age ?? '') === '7 years' ? 'selected' : '' }}>7 years</option>
                                <option value="8+ years" {{ old('age', $rehoming->age ?? '') === '8+ years' ? 'selected' : '' }}>8+ years</option>
                            </select>
                            @error('age')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="gender">Gender <span class="required">*</span></label>
                            <select id="gender" name="gender" class="form-select @error('gender') is-invalid @enderror" required>
                                <option value="">Select gender</option>
                                <option value="male" {{ old('gender', $rehoming->gender ?? '') === 'male' ? 'selected' : '' }}>Male</option>
                                <option value="female" {{ old('gender', $rehoming->gender ?? '') === 'female' ? 'selected' : '' }}>Female</option>
                            </select>
                            @error('gender')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Size <span class="required">*</span></label>
                            <div class="size-options">
                                <div class="size-option {{ old('size', $rehoming->size ?? '') === 'small' ? 'selected' : '' }}" 
                                     onclick="selectSize('small')">
                                    <i class="fas fa-paw" style="font-size: 1rem;"></i>
                                    <div class="size-name">Small</div>
                                </div>
                                <div class="size-option {{ old('size', $rehoming->size ?? '') === 'medium' ? 'selected' : '' }}" 
                                     onclick="selectSize('medium')">
                                    <i class="fas fa-paw"></i>
                                    <div class="size-name">Medium</div>
                                </div>
                                <div class="size-option {{ old('size', $rehoming->size ?? '') === 'large' ? 'selected' : '' }}" 
                                     onclick="selectSize('large')">
                                    <i class="fas fa-paw" style="font-size: 2rem;"></i>
                                    <div class="size-name">Large</div>
                                </div>
                                <div class="size-option {{ old('size', $rehoming->size ?? '') === 'extra_large' ? 'selected' : '' }}" 
                                     onclick="selectSize('extra_large')">
                                    <i class="fas fa-paw" style="font-size: 2.5rem;"></i>
                                    <div class="size-name">X-Large</div>
                                </div>
                            </div>
                            <input type="hidden" id="size" name="size" value="{{ old('size', $rehoming->size ?? '') }}" required>
                            @error('size')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Description -->
                <div class="form-section">
                    <h3 class="section-title">About Your Pet</h3>

                    <div class="form-group">
                        <label for="description">Pet Description <span class="required">*</span></label>
                        <textarea id="description" name="description" class="form-control form-textarea @error('description') is-invalid @enderror" 
                                  required placeholder="Tell potential adopters about your pet's personality, habits, favorite activities, and what makes them special...">{{ old('description', $rehoming->description ?? '') }}</textarea>
                        <div class="help-text">Be descriptive! This helps potential adopters understand your pet's unique personality.</div>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Form Buttons -->
                <div class="form-buttons">
                    <a href="{{ route('rehoming.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i>
                        Back to Rehoming
                    </a>
                    <button type="submit" class="btn btn-primary">
                        Continue to Step 2
                        <i class="fas fa-arrow-right"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function selectSpecies(species) {
    // Remove selected class from all options
    document.querySelectorAll('.species-option').forEach(option => {
        option.classList.remove('selected');
    });
    
    // Add selected class to clicked option
    event.target.closest('.species-option').classList.add('selected');
    
    // Update hidden input
    document.getElementById('species').value = species;
}

function selectSize(size) {
    // Remove selected class from all options
    document.querySelectorAll('.size-option').forEach(option => {
        option.classList.remove('selected');
    });
    
    // Add selected class to clicked option
    event.target.closest('.size-option').classList.add('selected');
    
    // Update hidden input
    document.getElementById('size').value = size;
}

// Form validation
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('step1Form');
    
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