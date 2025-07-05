<?php
// File: faq-adopters.blade.php
// Path: /resources/views/home/faq-adopters.blade.php
?>

@extends('layouts.app')

@section('content')
<div class="bg-gray-50 min-h-screen">

    <!-- Main Content -->
    <div class="max-w-4xl mx-auto px-4 py-16">
        <!-- Header -->
        <div class="text-center mb-12">
            <h1 class="text-2xl font-bold text-gray-900">FAQ's for Adopting a Pet</h1>
        </div>

        <!-- FAQ Items -->
        <div class="space-y-4">
            <!-- FAQ 1 - Expanded -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                <button class="w-full px-6 py-4 text-left flex items-center justify-between focus:outline-none" onclick="toggleFaq(1)">
                    <span class="text-sm font-medium text-gray-900">1. why are you only helping dogs and cats?</span>
                    <svg id="icon-1" class="w-5 h-5 text-gray-400 transform rotate-45 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                </button>
                <div id="content-1" class="px-6 pb-4">
                    <p class="text-sm text-gray-600">
                        We're focusing on dogs, cats and rabbits because they're the most popular types of pet in the UK. We plan to help rehome other types of pets in the future.
                    </p>
                </div>
            </div>

            <!-- FAQ 2 -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                <button class="w-full px-6 py-4 text-left flex items-center justify-between focus:outline-none" onclick="toggleFaq(2)">
                    <span class="text-sm font-medium text-gray-900">2. I see That some pets listed haven't been neutered, microchipped or vaccinated. Why is this?</span>
                    <svg id="icon-2" class="w-5 h-5 text-gray-400 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                </button>
                <div id="content-2" class="px-6 pb-4 hidden">
                    <p class="text-sm text-gray-600">
                        Some pets may not have received all medical treatments due to age, health conditions, or other circumstances. We always recommend discussing medical needs with the current owner and your veterinarian.
                    </p>
                </div>
            </div>

            <!-- FAQ 3 -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                <button class="w-full px-6 py-4 text-left flex items-center justify-between focus:outline-none" onclick="toggleFaq(3)">
                    <span class="text-sm font-medium text-gray-900">3. Will you carry out a home check?</span>
                    <svg id="icon-3" class="w-5 h-5 text-gray-400 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                </button>
                <div id="content-3" class="px-6 pb-4 hidden">
                    <p class="text-sm text-gray-600">
                        Yes, we conduct thorough home checks for all potential adopters to ensure they can provide a safe and suitable environment for the pet.
                    </p>
                </div>
            </div>

            <!-- FAQ 4 -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                <button class="w-full px-6 py-4 text-left flex items-center justify-between focus:outline-none" onclick="toggleFaq(4)">
                    <span class="text-sm font-medium text-gray-900">4. Why do I have to pay an adoption fee?</span>
                    <svg id="icon-4" class="w-5 h-5 text-gray-400 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                </button>
                <div id="content-4" class="px-6 pb-4 hidden">
                    <p class="text-sm text-gray-600">
                        Adoption fees help cover the cost of medical care, vaccinations, microchipping, and other expenses. This also helps ensure that adopters are committed to providing proper care.
                    </p>
                </div>
            </div>

            <!-- FAQ 5 -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                <button class="w-full px-6 py-4 text-left flex items-center justify-between focus:outline-none" onclick="toggleFaq(5)">
                    <span class="text-sm font-medium text-gray-900">5. What do I need to know about dog microchipping?</span>
                    <svg id="icon-5" class="w-5 h-5 text-gray-400 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                </button>
                <div id="content-5" class="px-6 pb-4 hidden">
                    <p class="text-sm text-gray-600">
                        Microchipping is a legal requirement for dogs. The microchip contains your contact information and helps reunite lost pets with their owners. Make sure to update the chip registration when you adopt.
                    </p>
                </div>
            </div>

            <!-- FAQ 6 -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                <button class="w-full px-6 py-4 text-left flex items-center justify-between focus:outline-none" onclick="toggleFaq(6)">
                    <span class="text-sm font-medium text-gray-900">6. What do I need to know about cat microchipping?</span>
                    <svg id="icon-6" class="w-5 h-5 text-gray-400 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                </button>
                <div id="content-6" class="px-6 pb-4 hidden">
                    <p class="text-sm text-gray-600">
                        Cat microchipping is strongly recommended for identification. Even indoor cats can escape, and a microchip greatly increases the chances of being reunited if they get lost.
                    </p>
                </div>
            </div>

            <!-- FAQ 7 -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                <button class="w-full px-6 py-4 text-left flex items-center justify-between focus:outline-none" onclick="toggleFaq(7)">
                    <span class="text-sm font-medium text-gray-900">7. How do I delete my User Account?</span>
                    <svg id="icon-7" class="w-5 h-5 text-gray-400 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                </button>
                <div id="content-7" class="px-6 pb-4 hidden">
                    <p class="text-sm text-gray-600">
                        You can delete your account by going to your account settings and clicking "Delete Account" or by contacting our support team who can help you with the process.
                    </p>
                </div>
            </div>

            <!-- FAQ 8 -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                <button class="w-full px-6 py-4 text-left flex items-center justify-between focus:outline-none" onclick="toggleFaq(8)">
                    <span class="text-sm font-medium text-gray-900">8. I can't complete the forms online - Can somebody help me please?</span>
                    <svg id="icon-8" class="w-5 h-5 text-gray-400 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                </button>
                <div id="content-8" class="px-6 pb-4 hidden">
                    <p class="text-sm text-gray-600">
                        Absolutely! Our support team is here to help. You can call us at +1 (555) 123-4567 or email us at support@furryfriends.com and we'll guide you through the process step by step.
                    </p>
                </div>
            </div>

            <!-- FAQ 9 -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                <button class="w-full px-6 py-4 text-left flex items-center justify-between focus:outline-none" onclick="toggleFaq(9)">
                    <span class="text-sm font-medium text-gray-900">9. Where can I get my cat neutered? I'm on a low income and need help.</span>
                    <svg id="icon-9" class="w-5 h-5 text-gray-400 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                </button>
                <div id="content-9" class="px-6 pb-4 hidden">
                    <p class="text-sm text-gray-600">
                        Many animal charities and veterinary clinics offer low-cost neutering programs. Contact your local animal shelter or search for "low-cost spay/neuter clinics" in your area for affordable options.
                    </p>
                </div>
            </div>

            <!-- FAQ 10 -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                <button class="w-full px-6 py-4 text-left flex items-center justify-between focus:outline-none" onclick="toggleFaq(10)">
                    <span class="text-sm font-medium text-gray-900">10. Can you help me with behavioural issues relating to cats?</span>
                    <svg id="icon-10" class="w-5 h-5 text-gray-400 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                </button>
                <div id="content-10" class="px-6 pb-4 hidden">
                    <p class="text-sm text-gray-600">
                        While we can provide basic guidance, we recommend consulting with a qualified animal behaviorist or your veterinarian for serious behavioral issues. They can provide personalized training plans and support.
                    </p>
                </div>
            </div>
        </div>
    </div>

   
</div>

<script>
function toggleFaq(faqNumber) {
    const content = document.getElementById(`content-${faqNumber}`);
    const icon = document.getElementById(`icon-${faqNumber}`);
    
    if (content.classList.contains('hidden')) {
        content.classList.remove('hidden');
        icon.classList.add('rotate-45');
    } else {
        content.classList.add('hidden');
        icon.classList.remove('rotate-45');
    }
}
</script>
@endsection