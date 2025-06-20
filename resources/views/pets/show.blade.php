<?php
// File: show.blade.php
// Path: /resources/views/pets/show.blade.php
?>

@extends('layouts.app')

@section('content')
<style>
    .pet-detail-container {
        background: #f8fafc;
        min-height: 100vh;
        padding: 2rem 0;
    }
    
    .pet-header {
        background: white;
        padding: 2rem 0;
        margin-bottom: 2rem;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }
    
    .pet-header .container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 1rem;
    }
    
    .pet-breadcrumb {
        color: #6b7280;
        margin-bottom: 1rem;
    }
    
    .pet-breadcrumb a {
        color: #8B5CF6;
        text-decoration: none;
    }
    
    .pet-title-section {
        display: flex;
        align-items: center;
        gap: 1rem;
    }
    
    .pet-avatar {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        object-fit: cover;
        border: 4px solid #8B5CF6;
    }
    
    .pet-title-info h1 {
        font-size: 2.5rem;
        font-weight: bold;
        color: #1f2937;
        margin-bottom: 0.5rem;
    }
    
    .pet-id {
        color: #6b7280;
        font-size: 1rem;
        margin-bottom: 0.5rem;
    }
    
    .pet-location-header {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        color: #8B5CF6;
        font-weight: 500;
    }
    
    .pet-content {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 1rem;
        display: grid;
        grid-template-columns: 2fr 1fr;
        gap: 2rem;
    }
    
    .pet-main {
        background: white;
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    }
    
    .pet-image-gallery {
        position: relative;
        height: 400px;
        overflow: hidden;
    }
    
    .main-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    
    .image-nav {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        background: rgba(0,0,0,0.5);
        color: white;
        border: none;
        padding: 1rem;
        cursor: pointer;
        border-radius: 50%;
        font-size: 1.2rem;
        transition: all 0.3s;
    }
    
    .image-nav:hover {
        background: rgba(0,0,0,0.7);
    }
    
    .image-nav.prev {
        left: 1rem;
    }
    
    .image-nav.next {
        right: 1rem;
    }
    
    .favorite-btn {
        position: absolute;
        top: 1rem;
        right: 1rem;
        background: rgba(255,255,255,0.9);
        border: none;
        padding: 0.75rem;
        border-radius: 50%;
        cursor: pointer;
        font-size: 1.5rem;
        transition: all 0.3s;
    }
    
    .favorite-btn:hover {
        background: #8B5CF6;
        color: white;
        transform: scale(1.1);
    }
    
    .favorite-btn.favorited {
        background: #ef4444;
        color: white;
    }
    
    .image-thumbnails {
        display: flex;
        gap: 0.5rem;
        padding: 1rem;
        overflow-x: auto;
    }
    
    .thumbnail {
        width: 80px;
        height: 80px;
        object-fit: cover;
        border-radius: 8px;
        cursor: pointer;
        opacity: 0.7;
        transition: all 0.3s;
        border: 2px solid transparent;
    }
    
    .thumbnail.active {
        opacity: 1;
        border-color: #8B5CF6;
    }
    
    .pet-info-section {
        padding: 2rem;
    }
    
    .pet-story h2 {
        font-size: 1.5rem;
        font-weight: bold;
        color: #1f2937;
        margin-bottom: 1rem;
    }
    
    .pet-description {
        color: #6b7280;
        line-height: 1.6;
        margin-bottom: 2rem;
    }
    
    .pet-characteristics {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 1rem;
        margin-bottom: 2rem;
    }
    
    .characteristic {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        padding: 1rem;
        background: #f8fafc;
        border-radius: 10px;
        border-left: 4px solid #8B5CF6;
    }
    
    .characteristic i {
        font-size: 1.5rem;
        color: #8B5CF6;
    }
    
    .characteristic.active i {
        color: #10b981;
    }
    
    .characteristic-text {
        font-weight: 500;
        color: #374151;
    }
    
    .pet-sidebar {
        display: flex;
        flex-direction: column;
        gap: 1.5rem;
    }
    
    .pet-info-card {
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
    
    .pet-stats {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 1rem;
    }
    
    .stat-item {
        text-align: center;
        padding: 1rem;
        background: #f8fafc;
        border-radius: 10px;
    }
    
    .stat-icon {
        font-size: 1.5rem;
        color: #8B5CF6;
        margin-bottom: 0.5rem;
    }
    
    .stat-label {
        font-size: 0.9rem;
        color: #6b7280;
        margin-bottom: 0.25rem;
    }
    
    .stat-value {
        font-weight: bold;
        color: #1f2937;
    }
    
    .adoption-btn {
        width: 100%;
        background: linear-gradient(135deg, #8B5CF6, #A855F7);
        color: white;
        border: none;
        padding: 1rem 1.5rem;
        border-radius: 10px;
        font-size: 1.1rem;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s;
        text-decoration: none;
        display: block;
        text-align: center;
        margin-bottom: 1rem;
    }
    
    .adoption-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 20px rgba(139, 92, 246, 0.3);
    }
    
    .adoption-btn:disabled {
        opacity: 0.6;
        cursor: not-allowed;
        transform: none;
    }
    
    .contact-btn {
        width: 100%;
        background: transparent;
        border: 2px solid #8B5CF6;
        color: #8B5CF6;
        padding: 0.75rem 1.5rem;
        border-radius: 10px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s;
        text-decoration: none;
        display: block;
        text-align: center;
    }
    
    .contact-btn:hover {
        background: #8B5CF6;
        color: white;
    }
    
    .vaccination-schedule {
        margin-top: 1.5rem;
    }
    
    .vaccination-table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 1rem;
    }
    
    .vaccination-table th,
    .vaccination-table td {
        padding: 0.75rem;
        text-align: left;
        border-bottom: 1px solid #e5e7eb;
    }
    
    .vaccination-table th {
        background: #f8fafc;
        font-weight: 600;
        color: #374151;
    }
    
    .vaccination-table td {
        color: #6b7280;
    }
    
    .status-badge {
        padding: 0.25rem 0.75rem;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 500;
    }
    
    .status-completed {
        background: #d1fae5;
        color: #065f46;
    }
    
    .status-due {
        background: #fef3c7;
        color: #92400e;
    }
    
    .similar-pets {
        margin-top: 2rem;
        padding: 2rem 0;
        background: white;
    }
    
    .similar-pets .container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 1rem;
    }
    
    .similar-pets h2 {
        text-align: center;
        font-size: 2rem;
        font-weight: bold;
        color: #1f2937;
        margin-bottom: 2rem;
    }
    
    .similar-pets-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 1.5rem;
    }
    
    .similar-pet-card {
        background: white;
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        transition: all 0.3s;
    }
    
    .similar-pet-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 25px rgba(0,0,0,0.15);
    }
    
    .similar-pet-image {
        width: 100%;
        height: 200px;
        object-fit: cover;
    }
    
    .similar-pet-info {
        padding: 1rem;
        text-align: center;
    }
    
    .similar-pet-name {
        font-weight: bold;
        color: #1f2937;
        margin-bottom: 0.5rem;
    }
    
    .similar-pet-details {
        color: #6b7280;
        font-size: 0.9rem;
        margin-bottom: 1rem;
    }
    
    @media (max-width: 1024px) {
        .pet-content {
            grid-template-columns: 1fr;
        }
        
        .pet-sidebar {
            order: -1;
        }
    }
    
    @media (max-width: 768px) {
        .pet-title-section {
            flex-direction: column;
            text-align: center;
        }
        
        .pet-title-info h1 {
            font-size: 2rem;
        }
        
        .pet-stats {
            grid-template-columns: 1fr;
        }
        
        .pet-characteristics {
            grid-template-columns: 1fr;
        }
        
        .image-thumbnails {
            justify-content: center;
        }
    }
</style>

<div class="pet-detail-container">
    <!-- Pet Header -->
    <div class="pet-header">
        <div class="container">
            <div class="pet-breadcrumb">
                <a href="{{ route('home') }}">Home</a> > 
                <a href="{{ route('pets.index') }}">Adopt</a> > 
                {{ $pet->name }}
            </div>
            
            <div class="pet-title-section">
                <img src="{{ $pet->main_image_url }}" alt="{{ $pet->name }}" class="pet-avatar">
                <div class="pet-title-info">
                    <h1>{{ $pet->name }}</h1>
                    <div class="pet-id">Pet ID: {{ str_pad($pet->id, 7, '0', STR_PAD_LEFT) }}</div>
                    <div class="pet-location-header">
                        <i class="fas fa-map-marker-alt"></i>
                        {{ $pet->location->city }}, {{ $pet->location->state }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Pet Content -->
    <div class="pet-content">
        <!-- Main Content -->
        <div class="pet-main">
            <!-- Image Gallery -->
            <div class="pet-image-gallery">
                <img src="{{ $pet->main_image_url }}" alt="{{ $pet->name }}" class="main-image" id="mainImage">
                
                @if($pet->getAllImages()->count() > 1)
                    <button class="image-nav prev" onclick="previousImage()">
                        <i class="fas fa-chevron-left"></i>
                    </button>
                    <button class="image-nav next" onclick="nextImage()">
                        <i class="fas fa-chevron-right"></i>
                    </button>
                @endif
                
                <button class="favorite-btn {{ $isFavorited ? 'favorited' : '' }}" 
                        onclick="toggleFavorite({{ $pet->id }}, this)">
                    <i class="fas fa-heart"></i>
                </button>
            </div>

            @if($pet->getAllImages()->count() > 1)
                <div class="image-thumbnails">
                    @foreach($pet->getAllImages() as $index => $image)
                        <img src="{{ $image['url'] }}" 
                             alt="{{ $pet->name }}" 
                             class="thumbnail {{ $index === 0 ? 'active' : '' }}"
                             onclick="showImage({{ $index }}, '{{ $image['url'] }}', this)">
                    @endforeach
                </div>
            @endif

            <!-- Pet Information -->
            <div class="pet-info-section">
                <div class="pet-story">
                    <h2>{{ $pet->name }}'s Story</h2>
                    <p class="pet-description">{{ $pet->description }}</p>
                    
                    @if($pet->personality)
                        <h3 style="margin-top: 2rem; margin-bottom: 1rem; color: #374151;">Personality</h3>
                        <p class="pet-description">{{ $pet->personality }}</p>
                    @endif
                </div>

                <div class="pet-characteristics">
                    <div class="characteristic {{ $pet->good_with_kids ? 'active' : '' }}">
                        <i class="fas fa-child"></i>
                        <span class="characteristic-text">
                            {{ $pet->good_with_kids ? 'Good with kids' : 'Not suitable for kids' }}
                        </span>
                    </div>
                    <div class="characteristic {{ $pet->good_with_pets ? 'active' : '' }}">
                        <i class="fas fa-paw"></i>
                        <span class="characteristic-text">
                            {{ $pet->good_with_pets ? 'Good with pets' : 'Prefers to be alone' }}
                        </span>
                    </div>
                    <div class="characteristic {{ $pet->house_trained ? 'active' : '' }}">
                        <i class="fas fa-home"></i>
                        <span class="characteristic-text">
                            {{ $pet->house_trained ? 'House trained' : 'Needs house training' }}
                        </span>
                    </div>
                    <div class="characteristic {{ $pet->spayed_neutered ? 'active' : '' }}">
                        <i class="fas fa-check-circle"></i>
                        <span class="characteristic-text">
                            {{ $pet->spayed_neutered ? 'Spayed/Neutered' : 'Not spayed/neutered' }}
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="pet-sidebar">
            <!-- Pet Stats -->
            <div class="pet-info-card">
                <h3 class="card-title">Pet Details</h3>
                <div class="pet-stats">
                    <div class="stat-item">
                        <div class="stat-icon"><i class="fas fa-venus-mars"></i></div>
                        <div class="stat-label">Gender</div>
                        <div class="stat-value">{{ ucfirst($pet->gender) }}</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-icon"><i class="fas fa-birthday-cake"></i></div>
                        <div class="stat-label">Age</div>
                        <div class="stat-value">{{ $pet->age_display }}</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-icon"><i class="fas fa-ruler"></i></div>
                        <div class="stat-label">Size</div>
                        <div class="stat-value">{{ ucfirst($pet->size) }}</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-icon"><i class="fas fa-palette"></i></div>
                        <div class="stat-label">Color</div>
                        <div class="stat-value">{{ $pet->color }}</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-icon"><i class="fas fa-weight"></i></div>
                        <div class="stat-label">Weight</div>
                        <div class="stat-value">{{ $pet->weight ? $pet->weight . ' lbs' : 'Unknown' }}</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-icon"><i class="fas fa-dna"></i></div>
                        <div class="stat-label">Breed</div>
                        <div class="stat-value">{{ $pet->breed->name }}</div>
                    </div>
                </div>
            </div>

            <!-- Adoption Actions -->
            <div class="pet-info-card">
                @if($canAdopt)
                    <a href="{{ route('adoption.request', $pet) }}" class="adoption-btn">
                        <i class="fas fa-heart"></i>
                        Adopt {{ $pet->name }}
                    </a>
                @else
                    <button class="adoption-btn" disabled>
                        @if(!auth()->check())
                            <i class="fas fa-sign-in-alt"></i>
                            Login to Adopt
                        @else
                            <i class="fas fa-clock"></i>
                            Adoption Pending
                        @endif
                    </button>
                @endif
                
                <a href="{{ route('user.messages.create', ['user' => $pet->owner_id, 'pet' => $pet->id]) }}" 
                   class="contact-btn">
                    <i class="fas fa-envelope"></i>
                    Contact Owner
                </a>
            </div>

            <!-- Vaccination Schedule -->
            @if($pet->vaccinations->count() > 0)
                <div class="pet-info-card">
                    <h3 class="card-title">Vaccination Schedule</h3>
                    <div class="vaccination-schedule">
                        <table class="vaccination-table">
                            <thead>
                                <tr>
                                    <th>Vaccine</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($pet->vaccinations as $vaccination)
                                    <tr>
                                        <td>{{ $vaccination->vaccine_name }}</td>
                                        <td>{{ $vaccination->vaccination_date->format('M d, Y') }}</td>
                                        <td>
                                            <span class="status-badge status-completed">Completed</span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>

<!-- Similar Pets -->
@if($similarPets->count() > 0)
    <div class="similar-pets">
        <div class="container">
            <h2>Similar Pets</h2>
            <div class="similar-pets-grid">
                @foreach($similarPets as $similarPet)
                    <a href="{{ route('pets.show', $similarPet) }}" class="similar-pet-card">
                        <img src="{{ $similarPet->main_image_url }}" alt="{{ $similarPet->name }}" class="similar-pet-image">
                        <div class="similar-pet-info">
                            <div class="similar-pet-name">{{ $similarPet->name }}</div>
                            <div class="similar-pet-details">
                                {{ $similarPet->breed->name }} • {{ $similarPet->age_display }} • {{ ucfirst($similarPet->gender) }}
                            </div>
                            <div class="more-info-btn" style="margin-top: 0.5rem; padding: 0.5rem;">More Info</div>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </div>
@endif

<script>
let currentImageIndex = 0;
const images = @json($pet->getAllImages()->toArray());

function showImage(index, url, thumbnail) {
    currentImageIndex = index;
    document.getElementById('mainImage').src = url;
    
    // Update thumbnail active state
    document.querySelectorAll('.thumbnail').forEach(thumb => thumb.classList.remove('active'));
    thumbnail.classList.add('active');
}

function nextImage() {
    currentImageIndex = (currentImageIndex + 1) % images.length;
    const nextImage = images[currentImageIndex];
    document.getElementById('mainImage').src = nextImage.url;
    
    // Update thumbnail active state
    document.querySelectorAll('.thumbnail').forEach((thumb, index) => {
        thumb.classList.toggle('active', index === currentImageIndex);
    });
}

function previousImage() {
    currentImageIndex = currentImageIndex === 0 ? images.length - 1 : currentImageIndex - 1;
    const prevImage = images[currentImageIndex];
    document.getElementById('mainImage').src = prevImage.url;
    
    // Update thumbnail active state
    document.querySelectorAll('.thumbnail').forEach((thumb, index) => {
        thumb.classList.toggle('active', index === currentImageIndex);
    });
}

function toggleFavorite(petId, button) {
    @auth
        fetch(`/ajax/favorite/${petId}`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Content-Type': 'application/json',
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.favorited) {
                button.classList.add('favorited');
            } else {
                button.classList.remove('favorited');
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
    @else
        window.location.href = '{{ route("login") }}';
    @endauth
}

// Keyboard navigation for images
document.addEventListener('keydown', function(e) {
    if (images.length > 1) {
        if (e.key === 'ArrowLeft') {
            previousImage();
        } else if (e.key === 'ArrowRight') {
            nextImage();
        }
    }
});
</script>
@endsection