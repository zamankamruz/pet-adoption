<?php
// File: complete.blade.php
// Path: /resources/views/rehoming/complete.blade.php
?>

@extends('layouts.app')

@section('title', 'Rehoming Complete - Furry Friends')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-green-50 to-blue-50">
    <div class="max-w-4xl mx-auto px-4 py-16">
        <!-- Success Message -->
        <div class="text-center mb-12">
            <div class="inline-flex items-center justify-center w-24 h-24 bg-green-500 rounded-full mb-8">
                <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
            </div>
            
            <h1 class="text-4xl font-bold text-gray-900 mb-4">
                Congratulations! Your listing has been submitted.
            </h1>
            <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                Thank you for choosing Furry Friends to help {{ $rehoming->pet_name }} find a new loving home. 
                We'll take great care in reviewing your listing and connecting you with qualified adopters.
            </p>
        </div>

        <!-- Pet Summary Card -->
        <div class="bg-white rounded-2xl shadow-lg border border-gray-200 p-8 mb-8">
            <div class="flex items-start space-x-6">
                <div class="w-24 h-24 bg-gradient-to-br from-purple-400 to-purple-600 rounded-2xl flex items-center justify-center text-white text-2xl font-bold">
                    {{ strtoupper(substr($rehoming->pet_name, 0, 1)) }}
                </div>
                <div class="flex-1">
                    <h2 class="text-2xl font-bold text-gray-900 mb-2">{{ $rehoming->pet_name }}</h2>
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 text-sm">
                        <div>
                            <span class="text-gray-500">Species:</span>
                            <div class="font-medium text-gray-900">{{ ucfirst($rehoming->species) }}</div>
                        </div>
                        <div>
                            <span class="text-gray-500">Breed:</span>
                            <div class="font-medium text-gray-900">{{ $rehoming->breed }}</div>
                        </div>
                        <div>
                            <span class="text-gray-500">Age:</span>
                            <div class="font-medium text-gray-900">{{ $rehoming->age }}</div>
                        </div>
                        <div>
                            <span class="text-gray-500">Size:</span>
                            <div class="font-medium text-gray-900">{{ ucfirst($rehoming->size) }}</div>
                        </div>
                    </div>
                    <div class="mt-4 flex items-center space-x-4">
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-yellow-100 text-yellow-800">
                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"></path>
                            </svg>
                            Under Review
                        </span>
                        <span class="text-sm text-gray-500">
                            Submitted {{ $rehoming->submitted_at->format('M d, Y \a\t g:i A') }}
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <!-- What Happens Next -->
        <div class="bg-white rounded-2xl shadow-lg border border-gray-200 p-8 mb-8">
            <h3 class="text-2xl font-bold text-gray-900 mb-6">What happens next?</h3>
            
            <div class="space-y-6">
                <div class="flex items-start space-x-4">
                    <div class="flex-shrink-0 w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center">
                        <span class="text-blue-600 font-bold">1</span>
                    </div>
                    <div>
                        <h4 class="font-semibold text-gray-900 mb-1">Review Process (24 hours)</h4>
                        <p class="text-gray-600">Our team will carefully review your listing to ensure it meets our quality standards and provides all necessary information for potential adopters.</p>
                    </div>
                </div>

                <div class="flex items-start space-x-4">
                    <div class="flex-shrink-0 w-10 h-10 bg-green-100 rounded-full flex items-center justify-center">
                        <span class="text-green-600 font-bold">2</span>
                    </div>
                    <div>
                        <h4 class="font-semibold text-gray-900 mb-1">Listing Goes Live</h4>
                        <p class="text-gray-600">Once approved, your pet's profile will be visible to thousands of potential adopters on our platform. We'll send you a confirmation email.</p>
                    </div>
                </div>

                <div class="flex items-start space-x-4">
                    <div class="flex-shrink-0 w-10 h-10 bg-purple-100 rounded-full flex items-center justify-center">
                        <span class="text-purple-600 font-bold">3</span>
                    </div>
                    <div>
                        <h4 class="font-semibold text-gray-900 mb-1">Connect with Adopters</h4>
                        <p class="text-gray-600">Interested families will contact you through your preferred methods. We'll help facilitate introductions and provide guidance throughout the process.</p>
                    </div>
                </div>

                <div class="flex items-start space-x-4">
                    <div class="flex-shrink-0 w-10 h-10 bg-yellow-100 rounded-full flex items-center justify-center">
                        <span class="text-yellow-600 font-bold">4</span>
                    </div>
                    <div>
                        <h4 class="font-semibold text-gray-900 mb-1">Find the Perfect Match</h4>
                        <p class="text-gray-600">Work with potential adopters to find the perfect fit. We recommend meet-and-greets and trial periods to ensure a successful match.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Contact Preferences Reminder -->
        <div class="bg-blue-50 border border-blue-200 rounded-2xl p-6 mb-8">
            <h4 class="font-semibold text-blue-900 mb-3">Your Contact Preferences</h4>
            <p class="text-blue-800 mb-3">Potential adopters will contact you via:</p>
            <div class="flex flex-wrap gap-2">
                @foreach($rehoming->contact_preferences as $preference)
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800">
                        @if($preference === 'email')
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                            Email
                        @elseif($preference === 'phone')
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                            </svg>
                            Phone
                        @elseif($preference === 'text')
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                            </svg>
                            Text Message
                        @endif
                    </span>
                @endforeach
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="text-center space-y-4">
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('user.rehomed') }}" 
                   class="inline-flex items-center justify-center px-8 py-3 bg-gradient-to-r from-purple-500 to-purple-600 text-white font-semibold rounded-xl hover:from-purple-600 hover:to-purple-700 transform hover:scale-105 transition-all duration-200">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                    </svg>
                    View My Listings
                </a>
                <a href="{{ route('pets.index') }}" 
                   class="inline-flex items-center justify-center px-8 py-3 border-2 border-purple-600 text-purple-600 font-semibold rounded-xl hover:bg-purple-600 hover:text-white transition-all duration-200">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                    </svg>
                    Browse Other Pets
                </a>
            </div>
            
            <p class="text-gray-500 text-sm">
                Questions? Contact our support team at 
                <a href="mailto:support@furryfriends.com" class="text-purple-600 hover:text-purple-700">support@furryfriends.com</a>
            </p>
        </div>

        <!-- Tips for Success -->
        <div class="mt-12 bg-gradient-to-r from-purple-500 to-indigo-600 rounded-2xl p-8 text-white">
            <h3 class="text-2xl font-bold mb-4">Tips for a Successful Rehoming</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <h4 class="font-semibold mb-2">📱 Respond Promptly</h4>
                    <p class="text-purple-100 text-sm">Quick responses show you're serious and help maintain adopter interest.</p>
                </div>
                <div>
                    <h4 class="font-semibold mb-2">🤝 Meet in Safe Places</h4>
                    <p class="text-purple-100 text-sm">Arrange meetings in public places or our approved partner locations.</p>
                </div>
                <div>
                    <h4 class="font-semibold mb-2">📋 Ask Questions</h4>
                    <p class="text-purple-100 text-sm">Don't hesitate to ask about living situations, experience, and expectations.</p>
                </div>
                <div>
                    <h4 class="font-semibold mb-2">💝 Trust Your Instincts</h4>
                    <p class="text-purple-100 text-sm">If something doesn't feel right, it's okay to say no. {{ $rehoming->pet_name }}'s happiness comes first.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection