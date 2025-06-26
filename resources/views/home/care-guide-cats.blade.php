<?php
// File: care-guide.blade.php
// Path: /resources/views/home/care-guide.blade.php
?>

@extends('layouts.app')

@section('content')
<!-- Hero Section with Dog Food -->
<div class="bg-gray-50 py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <!-- Left Image -->
            <div class="order-2 lg:order-1">
                <img src="{{ asset('images/care-guide/pet-nutrition.jpg') }}" 
                     alt="Pet nutrition and food" 
                     class="w-full h-96 object-cover rounded-lg shadow-lg">
            </div>

            <!-- Right Content -->
            <div class="order-1 lg:order-2">
                <h1 class="text-2xl font-bold text-gray-900 mb-6">Consequences of obesity in pets</h1>
                <p class="text-gray-600 leading-relaxed mb-6 text-sm">
                    La obesidad es un factor de riesgo para la mortalidad, tanto o más que el tabaco ansiedad en los 
                    seres humanos. En los perros no es diferente, ya que la obesidad puede causar una condición 
                    ansiedad en todo el cuerpo del animal, por lo que es responsable de una serie de otros problemas 
                    de salud. En este artículo, vamos a explicar las principales consecuencias de la obesidad en las 
                    mascotas.
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

<!-- Care Guide Topics Section -->
<div class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            <!-- Topic 1: Step by step to develop your dogs -->
            <div class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300">
                <div class="h-48 overflow-hidden">
                    <img src="{{ asset('images/care-guide/dog-training.jpg') }}" 
                         alt="Dog training steps" 
                         class="w-full h-full object-cover hover:scale-105 transition-transform duration-300">
                </div>
                <div class="p-6">
                    <h3 class="text-sm font-semibold text-gray-900 mb-3">Step by step to develop your dogs</h3>
                    <p class="text-gray-600 text-sm mb-4">
                        Dog training does not have a set time and depends on various factors. Our post today is all about it.
                    </p>
                    <a href="#" class="text-purple-600 text-sm font-medium hover:text-purple-700">
                        Learn More →
                    </a>
                </div>
            </div>

            <!-- Topic 2: Create feelings in pets -->
            <div class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300">
                <div class="h-48 overflow-hidden">
                    <img src="{{ asset('images/care-guide/pet-emotions.jpg') }}" 
                         alt="Pet emotional care" 
                         class="w-full h-full object-cover hover:scale-105 transition-transform duration-300">
                </div>
                <div class="p-6">
                    <h3 class="text-sm font-semibold text-gray-900 mb-3">Create feelings in pets</h3>
                    <p class="text-gray-600 text-sm mb-4">
                        Many dogs have anxieties and stress. Here we explain the appropriate way to deal with a fearful puppy.
                    </p>
                    <a href="#" class="text-purple-600 text-sm font-medium hover:text-purple-700">
                        Learn More →
                    </a>
                </div>
            </div>

            <!-- Topic 3: The language of cats -->
            <div class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300">
                <div class="h-48 overflow-hidden">
                    <img src="{{ asset('images/care-guide/cat-communication.jpg') }}" 
                         alt="Cat language and behavior" 
                         class="w-full h-full object-cover hover:scale-105 transition-transform duration-300">
                </div>
                <div class="p-6">
                    <h3 class="text-sm font-semibold text-gray-900 mb-3">The language of cats</h3>
                    <p class="text-gray-600 text-sm mb-4">
                        Cats have a complex way of communicating. Understanding their body language helps build better relationships.
                    </p>
                    <a href="#" class="text-purple-600 text-sm font-medium hover:text-purple-700">
                        Learn More →
                    </a>
                </div>
            </div>

            <!-- Topic 4: How many times Do Cats need Bathing -->
            <div class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300">
                <div class="h-48 overflow-hidden">
                    <img src="{{ asset('images/care-guide/cat-grooming.jpg') }}" 
                         alt="Cat grooming and bathing" 
                         class="w-full h-full object-cover hover:scale-105 transition-transform duration-300">
                </div>
                <div class="p-6">
                    <h3 class="text-sm font-semibold text-gray-900 mb-3">How many times Do Cats need Bathing</h3>
                    <p class="text-gray-600 text-sm mb-4">
                        Most cats groom themselves, but sometimes they need a little help. Here's when and how often to bathe your cat.
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
                        <h3 class="text-white text-sm font-bold leading-tight">Pet Health & Nutrition Guide</h3>
                    </div>
                    <div class="flex items-center">
                        <img src="{{ asset('images/magazine/health-nutrition.jpg') }}" 
                             alt="Pet health and nutrition" 
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
                        <h3 class="text-white text-sm font-bold leading-tight">Training & Behavior Tips</h3>
                    </div>
                    <div class="flex items-center">
                        <img src="{{ asset('images/magazine/training-behavior.jpg') }}" 
                             alt="Pet training and behavior" 
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
                        <h3 class="text-white text-sm font-bold leading-tight">Adoption Success Stories</h3>
                    </div>
                    <div class="flex items-center">
                        <img src="{{ asset('images/magazine/adoption-success.jpg') }}" 
                             alt="Adoption success stories" 
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
                        <h3 class="text-white text-sm font-bold leading-tight">Seasonal Pet Care</h3>
                    </div>
                    <div class="flex items-center">
                        <img src="{{ asset('images/magazine/seasonal-pet-care.jpg') }}" 
                             alt="Seasonal pet care" 
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

<!-- Additional Resources Section -->
<div class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-xl font-bold text-gray-900 mb-4">More Pet Care Resources</h2>
            <p class="text-gray-600 max-w-2xl mx-auto text-sm">
                Explore our comprehensive guides and expert advice to ensure your furry friends live their happiest, healthiest lives.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <!-- Cat Care Guide -->
            <div class="bg-gradient-to-r from-purple-50 to-pink-50 rounded-lg p-8 border border-purple-100">
                <div class="flex items-center mb-4">
                    <div class="w-12 h-12 bg-purple-100 rounded-full flex items-center justify-center mr-4">
                        <svg class="w-6 h-6 text-purple-600" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2C13.1 2 14 2.9 14 4C14 5.1 13.1 6 12 6C10.9 6 10 5.1 10 4C10 2.9 10.9 2 12 2M21 9V7L15 1L13.5 2.5C13.1 1.9 12.6 1.4 12 1.1C11.4 1.4 10.9 1.9 10.5 2.5L9 1L3 7V9H21Z"/>
                        </svg>
                    </div>
                    <h3 class="text-sm font-bold text-gray-900">Cat Care Guide</h3>
                </div>
                <p class="text-gray-600 mb-4 text-sm">
                    Everything you need to know about caring for your feline friend, from nutrition to grooming and health tips.
                </p>
                <a href="{{ route('care-guide.cats') }}" 
                   class="inline-flex items-center text-purple-600 text-sm font-semibold hover:text-purple-700">
                    View Cat Guide
                    <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </a>
            </div>

            <!-- Dog Care Guide -->
            <div class="bg-gradient-to-r from-blue-50 to-indigo-50 rounded-lg p-8 border border-blue-100">
                <div class="flex items-center mb-4">
                    <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center mr-4">
                        <svg class="w-6 h-6 text-blue-600" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M4.5 12C3.12 12 2 13.12 2 14.5S3.12 17 4.5 17 7 15.88 7 14.5 5.88 12 4.5 12M19.5 12C18.12 12 17 13.12 17 14.5S18.12 17 19.5 17 22 15.88 22 14.5 20.88 12 19.5 12M12 3.5C10.62 3.5 9.5 4.62 9.5 6S10.62 8.5 12 8.5 14.5 7.38 14.5 6 13.38 3.5 12 3.5M12 20.5C10.9 20.5 10 19.6 10 18.5S10.9 16.5 12 16.5 14 17.4 14 18.5 13.1 20.5 12 20.5Z"/>
                        </svg>
                    </div>
                    <h3 class="text-sm font-bold text-gray-900">Dog Care Guide</h3>
                </div>
                <p class="text-gray-600 mb-4 text-sm">
                    Comprehensive information about dog care, training, exercise, and keeping your canine companion happy and healthy.
                </p>
                <a href="{{ route('care-guide.dogs') }}" 
                   class="inline-flex items-center text-blue-600 text-sm font-semibold hover:text-blue-700">
                    View Dog Guide
                    <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </a>
            </div>
        </div>
    </div>
</div>
@endsection