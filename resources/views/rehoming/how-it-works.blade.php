<?php
// File: how-it-works.blade.php
// Path: /resources/views/rehoming/how-it-works.blade.php
?>

@extends('layouts.app')

@section('content')
<div class="bg-gray-50 min-h-screen">
    <!-- Header Section -->
    <div class="bg-white py-16">
        <div class="max-w-4xl mx-auto px-4 text-center">
            <!-- Paw Icon -->
            <div class="w-24 h-24 mx-auto mb-6 bg-purple-100 rounded-full flex items-center justify-center">
                <svg class="w-12 h-12 text-purple-600" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M8.5 1C7.1 1 6 2.1 6 3.5S7.1 6 8.5 6 11 4.9 11 3.5 9.9 1 8.5 1M15.5 1C14.1 1 13 2.1 13 3.5S14.1 6 15.5 6 18 4.9 18 3.5 16.9 1 15.5 1M12 6.5C10.6 6.5 9.5 7.6 9.5 9S10.6 11.5 12 11.5 14.5 10.4 14.5 9 13.4 6.5 12 6.5M4 9C2.6 9 1.5 10.1 1.5 11.5S2.6 14 4 14 6.5 12.9 6.5 11.5 5.4 9 4 9M20 9C18.6 9 17.5 10.1 17.5 11.5S18.6 14 20 14 22.5 12.9 22.5 11.5 21.4 9 20 9M12 12.5C9.8 12.5 8 14.3 8 16.5V20C8 21.1 8.9 22 10 22H14C15.1 22 16 21.1 16 20V16.5C16 14.3 14.2 12.5 12 12.5Z"/>
                </svg>
            </div>
            
            <h1 class="text-2xl font-bold text-gray-900 mb-4">How It Works For Rehomers</h1>
            <p class="text-sm text-gray-600 max-w-xl mx-auto">
                For most people, rehoming a pet is a really difficult but necessary decision.
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
                    <h3 class="text-xl font-bold text-gray-900">Create your pet's profile</h3>
                </div>
                <ul class="text-sm text-gray-600 space-y-2 ml-16">
                    <li>• Their breed, age, size, any health conditions, microchip status and if they've been neutered.</li>
                    <li>• Description of their personality, habits, likes and dislikes, how much exercise they're used to.</li>
                    <li>• The type of home they need. Could they potentially live with other pets or children?</li>
                    <li>• Are they used to having a garden or outdoor access?</li>
                </ul>
            </div>
            <div class="flex-1 pl-8">
                <img src="{{ asset('images/rehoming/step1-cats.png') }}" 
                     alt="Create pet profile" 
                     class="w-full max-w-sm mx-auto">
            </div>
        </div>

        <!-- Dotted Line -->
        <div class="flex justify-center mb-16">
            <div class="w-px h-16 border-l-2 border-dashed border-gray-300"></div>
        </div>

        <!-- Step 2 -->
        <div class="flex items-center mb-16">
            <div class="flex-1 pr-8">
                <img src="{{ asset('images/rehoming/step2-dog-card.png') }}" 
                     alt="Dog ID card" 
                     class="w-full max-w-sm mx-auto">
            </div>
            <div class="flex-1 pl-8">
                <div class="flex items-center mb-4">
                    <div class="w-12 h-12 bg-purple-600 text-white rounded-full flex items-center justify-center text-xl font-bold mr-4">
                        2
                    </div>
                    <h3 class="text-xl font-bold text-gray-900">Get your pet's profile approved</h3>
                </div>
                <ul class="text-sm text-gray-600 space-y-2 ml-16">
                    <li>• Check your pet's profile thoroughly.</li>
                    <li>• If we're happy, we'll post your pet's profile on the site</li>
                    <li>• We may call you to clarify any points that we need to</li>
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
                    <h3 class="text-xl font-bold text-gray-900">Choose an adopter to take to the next stage</h3>
                </div>
                <ul class="text-sm text-gray-600 space-y-2 ml-16">
                    <li>• We'll let you know if we find any potentially good matches.</li>
                    <li>• You review the shortlist then decide who you want to take to the next stage, if anyone, and turn down the rest.</li>
                </ul>
            </div>
            <div class="flex-1 pl-8">
                <img src="{{ asset('images/rehoming/step3-computer.png') }}" 
                     alt="Choose adopter" 
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
                <img src="{{ asset('images/rehoming/step4-home-check.png') }}" 
                     alt="Home check" 
                     class="w-full max-w-sm mx-auto">
            </div>
            <div class="flex-1 pl-8">
                <div class="flex items-center mb-4">
                    <div class="w-12 h-12 bg-purple-600 text-white rounded-full flex items-center justify-center text-xl font-bold mr-4">
                        4
                    </div>
                    <h3 class="text-xl font-bold text-gray-900">The adopter reserves your pet & has a home check</h3>
                </div>
                <ul class="text-sm text-gray-600 space-y-2 ml-16">
                    <li>• Arrange for them to have a home check to make sure their living environment is suitable for your pet.</li>
                    <li>• We use the results of the home check to make a recommendation.</li>
                    <li>• If the adopter fails the home check, we'll get in touch to discuss it with you.</li>
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
                    <h3 class="text-xl font-bold text-gray-900">Chat with the adopter</h3>
                </div>
                <ul class="text-sm text-gray-600 space-y-2 ml-16">
                    <li>• Feel free to ask lots of questions. You're not locked into anything at this stage, so it's ok to change your mind if it doesn't feel right.</li>
                    <li>• To keep all pets and humans safe, do not take the conversation off FurryFriends, share your contact details or ask the adopter for theirs.</li>
                </ul>
            </div>
            <div class="flex-1 pl-8">
                <img src="{{ asset('images/rehoming/step5-chat.png') }}" 
                     alt="Chat with adopter" 
                     class="w-full max-w-sm mx-auto">
            </div>
        </div>

        <!-- Dotted Line -->
        <div class="flex justify-center mb-16">
            <div class="w-px h-16 border-l-2 border-dashed border-gray-300"></div>
        </div>

        <!-- Step 6 -->
        <div class="flex items-center mb-16">
            <div class="flex-1 pr-8">
                <img src="{{ asset('images/rehoming/step6-adoption.png') }}" 
                     alt="Confirm adoption" 
                     class="w-full max-w-sm mx-auto">
            </div>
            <div class="flex-1 pl-8">
                <div class="flex items-center mb-4">
                    <div class="w-12 h-12 bg-purple-600 text-white rounded-full flex items-center justify-center text-xl font-bold mr-4">
                        6
                    </div>
                    <h3 class="text-xl font-bold text-gray-900">Confirm the Adoption</h3>
                </div>
                <p class="text-sm text-gray-600 mb-4 ml-16">When an adopter passes the home check...</p>
                <ul class="text-sm text-gray-600 space-y-2 ml-16">
                    <li>• Arrange for the adopter to meet the pet at your house.</li>
                    <li>• If everyone is happy on the day, the adopter can take the pet home or you can agree to meet up again before finalising.</li>
                    <li>• If something doesn't feel right, you don't have to go through with the adoption.</li>
                    <li>• Though you become the legal owner of your pet as soon as they leave your house with the pet. So please make sure you're comfortable with everything before allowing them to take your pet home.</li>
                </ul>
            </div>
        </div>

        <!-- Start Button -->
        <div class="text-center mt-16">
            <a href="{{ route('rehoming.start') }}" 
               class="bg-purple-600 text-white px-8 py-3 rounded-lg font-semibold text-sm hover:bg-purple-700 transition-colors">
                Start the Process
            </a>
        </div>
    </div>
</div>
@endsection