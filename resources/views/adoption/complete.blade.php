<?php
// File: complete.blade.php
// Path: /resources/views/adoption/complete.blade.php
?>

@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50">
       <div class="bg-white shadow-sm">
        <div class="max-w-4xl mx-auto px-4 py-6">
            <div class="flex items-center justify-center">
                <div class="flex items-center space-x-8">
                    <img src="{{ asset('images/step6.png') }}" alt="">

                </div>
            </div>
        </div>
    </div>


    <!-- Main Content -->
    <div class="max-w-4xl mx-auto px-4 py-8">
        <div class="bg-white rounded-lg shadow-sm p-8 text-center">
            <h2 class="text-2xl font-bold text-gray-900 mb-4">Thanks For Submitting</h2>
            
            <p class="text-gray-600 mb-8">
                The pet's current owner will be sent a link to your profile when your application has been approved by Furry Friends.
            </p>

            <!-- Success Illustration -->
            <div class="mb-8 flex justify-center">
                <div class="relative">
                    <!-- Purple cats illustration placeholder -->
                    <svg class="w-32 h-32" viewBox="0 0 128 128" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <!-- Cat 1 -->
                        <ellipse cx="45" cy="80" rx="20" ry="15" fill="#8B5CF6"/>
                        <circle cx="40" cy="75" r="3" fill="white"/>
                        <circle cx="50" cy="75" r="3" fill="white"/>
                        <circle cx="40" cy="75" r="1" fill="black"/>
                        <circle cx="50" cy="75" r="1" fill="black"/>
                        <path d="M35 70 L40 65 L45 70" stroke="#8B5CF6" stroke-width="2" fill="none"/>
                        <path d="M50 70 L55 65 L60 70" stroke="#8B5CF6" stroke-width="2" fill="none"/>
                        
                        <!-- Cat 2 -->
                        <ellipse cx="80" cy="70" rx="18" ry="13" fill="#A855F7"/>
                        <circle cx="76" cy="67" r="2.5" fill="white"/>
                        <circle cx="84" cy="67" r="2.5" fill="white"/>
                        <circle cx="76" cy="67" r="1" fill="black"/>
                        <circle cx="84" cy="67" r="1" fill="black"/>
                        <path d="M68 62 L73 58 L78 62" stroke="#A855F7" stroke-width="2" fill="none"/>
                        <path d="M82 62 L87 58 L92 62" stroke="#A855F7" stroke-width="2" fill="none"/>
                        
                        <!-- Hearts -->
                        <path d="M25 45 C25 40, 30 35, 35 40 C40 35, 45 40, 45 45 C45 50, 35 60, 35 60 C35 60, 25 50, 25 45 Z" fill="#EF4444"/>
                        <path d="M85 45 C85 42, 88 40, 90 42 C92 40, 95 42, 95 45 C95 47, 90 52, 90 52 C90 52, 85 47, 85 45 Z" fill="#EF4444"/>
                    </svg>
                    
                    <!-- Success checkmark -->
                    <div class="absolute -top-2 -right-2 w-8 h-8 bg-green-500 rounded-full flex items-center justify-center">
                        <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                        </svg>
                    </div>
                </div>
            </div>

            @if($adoption && $adoption->reference_number)
                <div class="mb-8 p-4 bg-purple-50 rounded-lg">
                    <p class="text-purple-800 font-semibold">
                        Reference Number: {{ $adoption->reference_number }}
                    </p>
                    <p class="text-purple-600 text-sm mt-2">
                        Please save this reference number for your records.
                    </p>
                </div>
            @endif

            <!-- Go to Profile Button -->
            <a href="{{ route('dashboard') }}" 
               class="inline-block bg-purple-600 hover:bg-purple-700 text-white px-8 py-3 rounded-lg font-semibold transition-colors">
                Go To My Profile
            </a>

            <!-- Additional Info -->
            <div class="mt-8 text-sm text-gray-500">
                <p>You will receive an email confirmation shortly.</p>
                <p>The pet owner will be notified of your application.</p>
            </div>
        </div>
    </div>
</div>
@endsection