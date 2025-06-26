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
                <img src="{{ asset('images/dog-guide/dog-nutrition-care.jpg') }}" 
                     alt="Dog nutrition and healthy feeding" 
                     class="w-full h-96 object-cover rounded-lg shadow-lg">
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
                    <img src="{{ asset('images/dog-guide/dog-training-basics.jpg') }}" 
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
                    <img src="{{ asset('images/dog-guide/dog-exercise-activity.jpg') }}" 
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
                    <img src="{{ asset('images/dog-guide/dog-health-wellness.jpg') }}" 
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
                    <img src="{{ asset('images/dog-guide/dog-grooming-hygiene.jpg') }}" 
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
<div class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-2xl font-bold text-gray-900 mb-4">FURRY FRIENDS Magazine</h2>
        </div>

        <!-- Magazine Cards Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <!-- Magazine Card 1 - Blue -->
            <div class="relative bg-gradient-to-br from-blue-400 to-blue-600 rounded-lg overflow-hidden shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2">
                <div class="absolute inset-0 bg-black bg-opacity-20"></div>
                <div class="relative p-6 h-80 flex flex-col justify-between">
                    <div>
                        <div class="text-white text-xs font-semibold mb-2 opacity-90">FURRY FRIENDS</div>
                        <h3 class="text-white text-sm font-bold leading-tight">Dog Training Mastery</h3>
                    </div>
                    <div class="flex items-center">
                        <img src="{{ asset('images/magazine/dog-training-magazine.jpg') }}" 
                             alt="Dog training magazine" 
                             class="w-16 h-16 rounded-full object-cover border-2 border-white mr-3">
                        <div class="text-white text-sm">
                            <div class="font-semibold text-sm">Latest Issue</div>
                            <div class="opacity-90 text-sm">2024</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Magazine Card 2 - Red -->
            <div class="relative bg-gradient-to-br from-red-400 to-red-600 rounded-lg overflow-hidden shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2">
                <div class="absolute inset-0 bg-black bg-opacity-20"></div>
                <div class="relative p-6 h-80 flex flex-col justify-between">
                    <div>
                        <div class="text-white text-xs font-semibold mb-2 opacity-90">FURRY FRIENDS</div>
                        <h3 class="text-white text-sm font-bold leading-tight">Dog Health & Nutrition</h3>
                    </div>
                    <div class="flex items-center">
                        <img src="{{ asset('images/magazine/dog-health-nutrition.jpg') }}" 
                             alt="Dog health and nutrition magazine" 
                             class="w-16 h-16 rounded-full object-cover border-2 border-white mr-3">
                        <div class="text-white text-sm">
                            <div class="font-semibold text-sm">Spring Edition</div>
                            <div class="opacity-90 text-sm">2024</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Magazine Card 3 - Black/White -->
            <div class="relative bg-gradient-to-br from-gray-800 to-black rounded-lg overflow-hidden shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2">
                <div class="absolute inset-0 bg-black bg-opacity-30"></div>
                <div class="relative p-6 h-80 flex flex-col justify-between">
                    <div>
                        <div class="text-white text-xs font-semibold mb-2 opacity-90">FURRY FRIENDS</div>
                        <h3 class="text-white text-sm font-bold leading-tight">Dog Breed Spotlight</h3>
                    </div>
                    <div class="flex items-center">
                        <img src="{{ asset('images/magazine/dog-breeds-spotlight.jpg') }}" 
                             alt="Dog breeds spotlight magazine" 
                             class="w-16 h-16 rounded-full object-cover border-2 border-white mr-3">
                        <div class="text-white text-sm">
                            <div class="font-semibold text-sm">Special Issue</div>
                            <div class="opacity-90 text-sm">2024</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Magazine Card 4 - Orange/Yellow -->
            <div class="relative bg-gradient-to-br from-yellow-400 to-orange-500 rounded-lg overflow-hidden shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2">
                <div class="absolute inset-0 bg-black bg-opacity-20"></div>
                <div class="relative p-6 h-80 flex flex-col justify-between">
                    <div>
                        <div class="text-white text-xs font-semibold mb-2 opacity-90">FURRY FRIENDS</div>
                        <h3 class="text-white text-sm font-bold leading-tight">Dog Exercise & Fun</h3>
                    </div>
                    <div class="flex items-center">
                        <img src="{{ asset('images/magazine/dog-exercise-fun.jpg') }}" 
                             alt="Dog exercise and fun activities" 
                             class="w-16 h-16 rounded-full object-cover border-2 border-white mr-3">
                        <div class="text-white text-sm">
                            <div class="font-semibold text-sm">Summer Guide</div>
                            <div class="opacity-90 text-sm">2024</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Subscribe Section -->
        <div class="text-center mt-12">
            <p class="text-gray-600 mb-6 text-sm">Join the FurryFriends magazine and be first to hear about news.</p>
            <form action="{{ route('newsletter.subscribe') }}" method="POST" class="max-w-md mx-auto flex">
                @csrf
                <input type="email" 
                       name="email" 
                       placeholder="Enter your email" 
                       class="flex-1 px-4 py-3 border border-gray-300 rounded-l-lg focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent text-sm">
                <button type="submit" 
                        class="px-8 py-3 bg-purple-600 text-white rounded-r-lg hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-purple-500 font-semibold text-sm">
                    Subscribe
                </button>
            </form>
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