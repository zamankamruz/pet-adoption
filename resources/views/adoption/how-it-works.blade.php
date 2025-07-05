<?php
// File: how-it-works.blade.php
// Path: /resources/views/adoption/how-it-works.blade.php
?>

@extends('layouts.app')

@section('content')
<div class="bg-gray-50 min-h-screen px-4 sm:px-6 lg:px-8">
    <!-- Header Section -->
    <div class="bg-white py-16 ">
        <div class="max-w-4xl mx-auto px-4 text-center">
            <!-- Paw Icon -->
            <div class="w-24 h-24 mx-auto mb-6 bg-purple-100 rounded-full flex items-center justify-center">
                <img src="{{ asset('images/Group.png') }}" 
                     alt="Let us know when you find a pet" 
                     class="w-full max-w-sm mx-auto">
            </div>
            
            <h1 class="text-2xl font-bold text-gray-900 mb-4">How It Work For Adapters</h1>
            <p class="text-sm text-gray-600 max-w-xl mx-auto">
                To guide you through adoption, and so you know what to expect, we've broken the process down into 5 steps.
            </p>
        </div>
    </div>

    <!-- Steps Section -->
    <div class="max-w-6xl mx-auto px-4 py-16">
        <!-- Step 1 -->
        <div class="flex items-center mb-16">
            <div class="flex-1 pr-8">
                <div class="flex items-center mb-4">
                    <div class="w-12 h-12 bg-purple-600 text-white rounded-full flex items-center justify-center text-xl font-bold mr-4">
                        1
                    </div>
                    <h3 class="text-xl font-bold text-gray-900">Create your profile and search for a pet</h3>
                </div>
                <ul class="text-sm text-gray-600 space-y-2 ml-16">
                    <li>• Set up your profile (including photos) in minutes</li>
                    <li>• Describe your home and routine so rehomers can see if it's right for their pet</li>
                    <li>• Start your search!</li>
                </ul>
            </div>
            <div class="flex-1 pl-8">
                <div class="relative">
                    <div class="absolute top-4 right-4 bg-purple-600 text-white px-3 py-1 rounded-full text-xs font-semibold">
                        Adopt Pet
                    </div>
                    <img src="{{ asset('images/Group1.png') }}" 
                         alt="Create profile and search" 
                         class="w-full max-w-sm mx-auto">
                </div>
            </div>
        </div>

        <!-- Dotted Line -->
        <div class="flex justify-center mb-16">
            <div class="w-px h-16 border-l-2 border-dashed border-gray-300"></div>
        </div>

        <!-- Step 2 -->
        <div class="flex items-center mb-16">
            <div class="flex-1 pr-8">
                <img src="{{ asset('images/Group2.png') }}" 
                     alt="Let us know when you find a pet" 
                     class="w-full max-w-sm mx-auto">
            </div>
            <div class="flex-1 pl-8">
                <div class="flex items-center mb-4">
                    <div class="w-12 h-12 bg-purple-600 text-white rounded-full flex items-center justify-center text-xl font-bold mr-4">
                        2
                    </div>
                    <h3 class="text-xl font-bold text-gray-900">Let us know when you find a pet you're interested in</h3>
                </div>
                <p class="text-sm text-gray-600 mb-3 ml-16">When you find a pet you're interested in...</p>
                <ul class="text-sm text-gray-600 space-y-2 ml-16">
                    <li>• Make your application using our online enquiry service</li>
                    <li>• If we think you're a good match, we'll approve your application,</li>
                    <li>• and profile, and pass it on to the rehomer</li>
                    <li>• If we need to ask for more information at this stage we'll contact you.</li>
                </ul>
            </div>
        </div>

        <!-- Dotted Line -->
        <div class="flex justify-center mb-16">
            <div class="w-px h-16 border-l-2 border-dashed border-gray-300"></div>
        </div>

        <!-- Step 3 -->
        <div class="flex items-center mb-16">
            <div class="flex-1 pr-8">
                <div class="flex items-center mb-4">
                    <div class="w-12 h-12 bg-purple-600 text-white rounded-full flex items-center justify-center text-xl font-bold mr-4">
                        3
                    </div>
                    <h3 class="text-xl font-bold text-gray-900">The rehomer will review your application</h3>
                </div>
                <ul class="text-sm text-gray-600 space-y-2 ml-16">
                    <li>• The rehomer will decide if they want to take your application to the next stage.</li>
                    <li>• A member of our team will contact you to discuss next steps and answer any questions you may have.</li>
                </ul>
            </div>
            <div class="flex-1 pl-8">
                <img src="{{ asset('images/Group3.png') }}" 
                     alt="Rehomer reviews application" 
                     class="w-full max-w-sm mx-auto">
            </div>
        </div>

        <!-- Dotted Line -->
        <div class="flex justify-center mb-16">
            <div class="w-px h-16 border-l-2 border-dashed border-gray-300"></div>
        </div>

        <!-- Step 4 -->
        <div class="flex items-center mb-16">
            <div class="flex-1 pr-8">
                <img src="{{ asset('images/Group4.png') }}" 
                     alt="Home check and chat" 
                     class="w-full max-w-sm mx-auto">
            </div>
            <div class="flex-1 pl-8">
                <div class="flex items-center mb-4">
                    <div class="w-12 h-12 bg-purple-600 text-white rounded-full flex items-center justify-center text-xl font-bold mr-4">
                        4
                    </div>
                    <h3 class="text-xl font-bold text-gray-900">Have a home check and chat to the rehomer</h3>
                </div>
                <ul class="text-sm text-gray-600 space-y-2 ml-16">
                    <li>• You can chat with the rehomer. We suggest you ask lots of questions about the pet's personality, diet, health and habits.</li>
                    <li>• We'll arrange for one of the home check to make our recommendations to the rehomer.</li>
                    <li>• Equally, if you change your mind or don't think you can give this pet the home they need, now is a good time to say!</li>
                </ul>
            </div>
        </div>

        <!-- Dotted Line -->
        <div class="flex justify-center mb-16">
            <div class="w-px h-16 border-l-2 border-dashed border-gray-300"></div>
        </div>

        <!-- Step 5 -->
        <div class="flex items-center mb-16">
            <div class="flex-1 pr-8">
                <div class="flex items-center mb-4">
                    <div class="w-12 h-12 bg-purple-600 text-white rounded-full flex items-center justify-center text-xl font-bold mr-4">
                        5
                    </div>
                    <h3 class="text-xl font-bold text-gray-900">Adopt your new pet</h3>
                </div>
                <ul class="text-sm text-gray-600 space-y-2 ml-16">
                    <li>• We'll let you know</li>
                    <li>• Get in touch with the rehomer to arrange to meet and collect the pet</li>
                    <li>• You may wish to visit the pet more than once before adopting, and please refer to our pre-adoption check lists for dogs, cats to make sure you are adopting the right pet for your household</li>
                    <li>• As soon as you collect the pet, you become their legal owner.</li>
                    <li>• Take your pet to their new home!</li>
                </ul>
            </div>
            <div class="flex-1 pl-8">
                <img src="{{ asset('images/Group5.png') }}" 
                     alt="Adopt your new pet" 
                     class="w-full max-w-sm mx-auto">
            </div>
        </div>

        <!-- Search Button -->
        <div class="text-center mt-16">
            <a href="{{ route('adoption.index') }}" 
               class="bg-purple-600 text-white px-8 py-3 rounded-lg font-semibold text-sm hover:bg-purple-700 transition-colors">
                Search a pet
            </a>
        </div>
    </div>

</div>
@endsection