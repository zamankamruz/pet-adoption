<?php
// File: care-guide-dogs.blade.php
// Path: /resources/views/home/care-guide-dogs.blade.php
?>

@extends('layouts.app')

@section('content')
<!-- Hero Section with Dog Care -->
<div class="bg-gray-50 py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <!-- Left Image -->
            <div class="order-2 lg:order-1">
                <img src="{{ asset('images/Group-dog.jpeg') }}" 
                     alt="Dog nutrition and healthy feeding" 
                     class="w-full h-86 object-cover rounded-lg shadow-lg">
            </div>

            <!-- Right Content -->
            <div class="order-1 lg:order-2">
                <h1 class="text-2xl font-bold text-gray-900 mb-6">Essential Dog Nutrition Guide</h1>
                <p class="text-gray-600 leading-relaxed mb-6 text-sm">
                    Proper nutrition is fundamental to your dog's health and well-being. A balanced diet provides the 
                    energy and nutrients your canine companion needs to maintain optimal health, support growth, and 
                    prevent disease. From puppyhood through their senior years, understanding your dog's nutritional 
                    needs is crucial for ensuring they live a long, healthy, and happy life.
                </p>
                <a href="#" class="inline-flex items-center text-purple-600 text-sm font-semibold hover:text-purple-700">
                    Read More
                    <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Dog Care Topics Section -->
<div class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            <!-- Topic 1: Dog Training Fundamentals -->
            <div class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300">
                <div class="h-48 overflow-hidden">
                    <img src="{{ asset('images/dog1.png') }}" 
                         alt="Dog training fundamentals" 
                         class="w-full h-full object-cover hover:scale-105 transition-transform duration-300">
                </div>
                <div class="p-6">
                    <h3 class="text-sm font-semibold text-gray-900 mb-3">Dog Training Fundamentals</h3>
                    <p class="text-gray-600 text-sm mb-4">
                        Learn the essential training techniques every dog owner should know. From basic commands to house training.
                    </p>
                    <a href="#" class="text-purple-600 text-sm font-medium hover:text-purple-700">
                        Learn More →
                    </a>
                </div>
            </div>

            <!-- Topic 2: Exercise and Activity -->
            <div class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300">
                <div class="h-48 overflow-hidden">
                    <img src="{{ asset('images/dog2.png') }}" 
                         alt="Dog exercise and activities" 
                         class="w-full h-full object-cover hover:scale-105 transition-transform duration-300">
                </div>
                <div class="p-6">
                    <h3 class="text-sm font-semibold text-gray-900 mb-3">Exercise and Activity</h3>
                    <p class="text-gray-600 text-sm mb-4">
                        Discover the right amount and type of exercise for your dog's breed, age, and energy level.
                    </p>
                    <a href="#" class="text-purple-600 text-sm font-medium hover:text-purple-700">
                        Learn More →
                    </a>
                </div>
            </div>

            <!-- Topic 3: Dog Health and Wellness -->
            <div class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300">
                <div class="h-48 overflow-hidden">
                    <img src="{{ asset('images/dog3.png') }}" 
                         alt="Dog health and wellness care" 
                         class="w-full h-full object-cover hover:scale-105 transition-transform duration-300">
                </div>
                <div class="p-6">
                    <h3 class="text-sm font-semibold text-gray-900 mb-3">Dog Health and Wellness</h3>
                    <p class="text-gray-600 text-sm mb-4">
                        Comprehensive guide to maintaining your dog's health through preventive care and early detection.
                    </p>
                    <a href="#" class="text-purple-600 text-sm font-medium hover:text-purple-700">
                        Learn More →
                    </a>
                </div>
            </div>

            <!-- Topic 4: Grooming and Hygiene -->
            <div class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300">
                <div class="h-48 overflow-hidden">
                    <img src="{{ asset('images/dog4.png') }}" 
                         alt="Dog grooming and hygiene" 
                         class="w-full h-full object-cover hover:scale-105 transition-transform duration-300">
                </div>
                <div class="p-6">
                    <h3 class="text-sm font-semibold text-gray-900 mb-3">Grooming and Hygiene</h3>
                    <p class="text-gray-600 text-sm mb-4">
                        Essential grooming tips to keep your dog clean, healthy, and looking their best year-round.
                    </p>
                    <a href="#" class="text-purple-600 text-sm font-medium hover:text-purple-700">
                        Learn More →
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- FURRY FRIENDS Magazine Section -->
<div class="py-16 bg-white">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <!-- Section Title -->
    <h2 class="text-3xl font-bold text-gray-900 text-center mb-12">
      FURRY FRIENDS <span class="text-teal-600">Magazine</span>
    </h2>

    <!-- Cards Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
      <!-- Card 1 -->
      <div class="bg-white rounded-lg overflow-hidden shadow">
        <!-- Header -->
        <div class="bg-gray-100 px-4 py-3">
          <h3 class="uppercase text-sm font-bold text-gray-900">Furry Friends</h3>
          <p class="text-xs text-gray-600">Fashionable Pets</p>
        </div>
        <!-- Cover Image + Date -->
        <div class="relative">
          <img src="{{ asset('images/dog5.jpeg') }}" alt="Fashionable Pets" class="w-full h-48 object-cover">
          <span class="absolute bottom-2 right-2 text-xs uppercase text-gray-400">Jan 2023</span>
        </div>
      </div>

      <!-- Card 2 -->
      <div class="bg-white rounded-lg overflow-hidden shadow">
        <div class="bg-teal-600 px-4 py-3">
          <h3 class="uppercase text-sm font-bold text-white">Furry Friends</h3>
          <p class="text-xs text-teal-100">Behavior of dogs</p>
        </div>
        <div class="relative">
          <img src="{{ asset('images/dog6.jpeg') }}" alt="Behavior of dogs" class="w-full h-48 object-cover">
          <span class="absolute bottom-2 right-2 text-xs uppercase text-gray-200">Apr 2023</span>
        </div>
      </div>

      <!-- Card 3 -->
      <div class="bg-white rounded-lg overflow-hidden shadow">
        <div class="bg-gray-50 px-4 py-3">
          <h3 class="uppercase text-sm font-bold text-gray-900">Furry Friends</h3>
          <p class="text-xs text-gray-600">Play with your cat</p>
        </div>
        <div class="relative">
          <img src="{{ asset('images/dog7.jpeg') }}" alt="Play with your cat" class="w-full h-48 object-cover">
          <span class="absolute bottom-2 right-2 text-xs uppercase text-gray-400">Apr 2023</span>
        </div>
      </div>

      <!-- Card 4 -->
      <div class="bg-white rounded-lg overflow-hidden shadow">
        <div class="bg-yellow-400 px-4 py-3">
          <h3 class="uppercase text-sm font-bold text-gray-900">Furry Friends</h3>
          <p class="text-xs text-gray-800">How to Train your Cat</p>
        </div>
        <div class="relative">
          <img src="{{ asset('images/dog9.jpeg') }}" alt="How to Train your Cat" class="w-full h-48 object-cover">
          <span class="absolute bottom-2 right-2 text-xs uppercase text-gray-700">Apr 2023</span>
        </div>
      </div>
    </div>

    <!-- Subscribe CTA -->
    <div class="mt-12 text-center">
      <p class="text-sm text-gray-700 mb-4">
        Join the FurryFriends magazine and be the first to hear about news
      </p>
      <div class="inline-flex">
        <input 
          type="email" 
          placeholder="E-mail Address" 
          class="px-4 py-2 border border-gray-300 rounded-l-lg focus:outline-none text-sm"
        />
        <button 
          class="px-6 py-2 bg-purple-600 text-white rounded-r-lg text-sm font-medium hover:bg-purple-700 transition-colors"
        >
          Subscribe
        </button>
      </div>
    </div>
  </div>
</div>


<!-- Dog Care Resources Section -->
<div class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-xl font-bold text-gray-900 mb-4">Complete Dog Care Resources</h2>
            <p class="text-gray-600 max-w-2xl mx-auto text-sm">
                Everything you need to know about raising, training, and caring for your canine companion throughout their life.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <!-- Puppy Care Guide -->
            <div class="bg-gradient-to-r from-blue-50 to-indigo-50 rounded-lg p-8 border border-blue-100">
                <div class="flex items-center mb-4">
                    <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center mr-4">
                        <svg class="w-6 h-6 text-blue-600" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M4.5 12C3.12 12 2 13.12 2 14.5S3.12 17 4.5 17 7 15.88 7 14.5 5.88 12 4.5 12M19.5 12C18.12 12 17 13.12 17 14.5S18.12 17 19.5 17 22 15.88 22 14.5 20.88 12 19.5 12M12 3.5C10.62 3.5 9.5 4.62 9.5 6S10.62 8.5 12 8.5 14.5 7.38 14.5 6 13.38 3.5 12 3.5M12 20.5C10.9 20.5 10 19.6 10 18.5S10.9 16.5 12 16.5 14 17.4 14 18.5 13.1 20.5 12 20.5Z"/>
                        </svg>
                    </div>
                    <h3 class="text-sm font-bold text-gray-900">Puppy Care Guide</h3>
                </div>
                <p class="text-gray-600 mb-4 text-sm">
                    Essential information for new puppy owners including feeding, training, socialization, and health care for the first year.
                </p>
                <a href="#" 
                   class="inline-flex items-center text-blue-600 text-sm font-semibold hover:text-blue-700">
                    View Puppy Guide
                    <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </a>
            </div>

            <!-- Senior Dog Care -->
            <div class="bg-gradient-to-r from-green-50 to-emerald-50 rounded-lg p-8 border border-green-100">
                <div class="flex items-center mb-4">
                    <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center mr-4">
                        <svg class="w-6 h-6 text-green-600" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2C13.1 2 14 2.9 14 4C14 5.1 13.1 6 12 6C10.9 6 10 5.1 10 4C10 2.9 10.9 2 12 2M21 9V7L15 1L13.5 2.5C13.1 1.9 12.6 1.4 12 1.1C11.4 1.4 10.9 1.9 10.5 2.5L9 1L3 7V9H21Z"/>
                        </svg>
                    </div>
                    <h3 class="text-sm font-bold text-gray-900">Senior Dog Care</h3>
                </div>
                <p class="text-gray-600 mb-4 text-sm">
                    Specialized care tips for aging dogs including diet adjustments, exercise modifications, and health monitoring.
                </p>
                <a href="#" 
                   class="inline-flex items-center text-green-600 text-sm font-semibold hover:text-green-700">
                    View Senior Guide
                    <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </a>
            </div>
        </div>

    
    </div>
</div>
@endsection