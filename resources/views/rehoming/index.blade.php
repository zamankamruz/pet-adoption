<?php
// File: index.blade.php
// Path: /resources/views/rehoming/index.blade.php
?>

@extends('layouts.app')

@section('content')
<div class="bg-gray-50 min-h-screen">
    <!-- Hero Section -->
<div class="bg-gradient-to-br from-white to-gray-100 text-gray-900 py-16">
    <div class="max-w-4xl mx-auto px-4 text-center">
        <h1 class="text-2xl font-bold mb-4">Find a Loving Home for Your Pet</h1>
        <p class="text-sm opacity-90 mb-8 leading-relaxed max-w-2xl mx-auto">
            Sometimes life circumstances change, and you need to find a new home for your beloved pet. 
            We're here to help you through this difficult process with care and compassion.
        </p>
        <div class="flex justify-center gap-4 flex-wrap">
            <a href="{{ route('rehoming.step1') }}" class="bg-purple-600 text-white px-6 py-3 rounded-lg font-semibold text-sm hover:bg-purple-700 transition-colors inline-flex items-center gap-2">
                <i class="fas fa-paw"></i>
                Start Rehoming Process
            </a>
            <a href="{{ route('rehoming.how-it-works') }}" class="border-2 border-purple-600 text-purple-600 px-6 py-3 rounded-lg font-semibold text-sm hover:bg-purple-50 transition-colors inline-flex items-center gap-2">
                <i class="fas fa-info-circle"></i>
                How It Works
            </a>
        </div>
    </div>
</div>



    <!-- Main Content -->
    <div class="max-w-6xl mx-auto px-4 py-12">

        <!-- Tips Section -->
        <div class="bg-gray-100 rounded-lg p-8 mb-12">
            <div class="text-center mb-8">
                <h2 class="text-2xl font-bold text-gray-900 mb-4">Rehoming Tips</h2>
                <p class="text-sm text-gray-600 max-w-2xl mx-auto">
                    Helpful advice to make the rehoming process as smooth as possible for you and your pet.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="bg-white rounded-lg p-6 shadow-sm">
                    <h4 class="text-sm font-semibold text-purple-600 mb-3 flex items-center gap-2">
                        <i class="fas fa-camera"></i>
                        Great Photos
                    </h4>
                    <p class="text-sm text-gray-600">
                        Use high-quality, well-lit photos that show your pet's personality. 
                        Include photos of them playing, relaxing, and interacting with people.
                    </p>
                </div>
                <div class="bg-white rounded-lg p-6 shadow-sm">
                    <h4 class="text-sm font-semibold text-purple-600 mb-3 flex items-center gap-2">
                        <i class="fas fa-heart"></i>
                        Honest Descriptions
                    </h4>
                    <p class="text-sm text-gray-600">
                        Be honest about your pet's personality, energy level, and any special needs. 
                        This helps ensure they find the right home for their unique qualities.
                    </p>
                </div>
                <div class="bg-white rounded-lg p-6 shadow-sm">
                    <h4 class="text-sm font-semibold text-purple-600 mb-3 flex items-center gap-2">
                        <i class="fas fa-medical-kit"></i>
                        Health Records
                    </h4>
                    <p class="text-sm text-gray-600">
                        Gather all veterinary records, vaccination history, and any medical information. 
                        This helps adopters understand your pet's health status.
                    </p>
                </div>
                <div class="bg-white rounded-lg p-6 shadow-sm">
                    <h4 class="text-sm font-semibold text-purple-600 mb-3 flex items-center gap-2">
                        <i class="fas fa-handshake"></i>
                        Meet & Greet
                    </h4>
                    <p class="text-sm text-gray-600">
                        Always arrange in-person meetings before finalizing any adoption. 
                        This ensures compatibility between your pet and their potential new family.
                    </p>
                </div>
            </div>
        </div>

        <!-- Support Section -->
        <div class="bg-white rounded-lg p-8 mb-12 shadow-sm text-center">
            <div class="max-w-2xl mx-auto">
                <h2 class="text-2xl font-bold text-gray-900 mb-4">We're Here to Help</h2>
                <p class="text-sm text-gray-600 mb-8">
                    Have questions about the rehoming process? Our team is here to support you every step of the way.
                </p>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="flex flex-col items-center">
                        <div class="w-12 h-12 bg-purple-600 text-white rounded-full flex items-center justify-center text-lg mb-2">
                            <i class="fas fa-phone"></i>
                        </div>
                        <div class="text-sm font-semibold text-gray-900">Call Us</div>
                        <div class="text-sm text-gray-600">+1 (555) 123-4567</div>
                    </div>
                    <div class="flex flex-col items-center">
                        <div class="w-12 h-12 bg-purple-600 text-white rounded-full flex items-center justify-center text-lg mb-2">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <div class="text-sm font-semibold text-gray-900">Email Us</div>
                        <div class="text-sm text-gray-600">rehoming@furryfriends.com</div>
                    </div>
                    <div class="flex flex-col items-center">
                        <div class="w-12 h-12 bg-purple-600 text-white rounded-full flex items-center justify-center text-lg mb-2">
                            <i class="fas fa-clock"></i>
                        </div>
                        <div class="text-sm font-semibold text-gray-900">Hours</div>
                        <div class="text-sm text-gray-600">Mon-Fri: 9AM-6PM</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection