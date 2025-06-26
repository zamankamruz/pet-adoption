<?php
// File: faq-rehomers.blade.php
// Path: /resources/views/rehoming/faq-rehomers.blade.php
?>

@extends('layouts.app')

@section('content')
<div class="bg-gray-50 min-h-screen">

    <!-- Main Content -->
    <div class="max-w-4xl mx-auto px-4 py-16">
        <!-- Header -->
        <div class="text-center mb-12">
            <h1 class="text-2xl font-bold text-gray-900">FAQ's for Rehoming a Pet</h1>
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
                        We're focusing on dogs and cats because they're the most popular types of pet in our country. We plan to help rehome other types of pets in the future.
                    </p>
                </div>
            </div>

            <!-- FAQ 2 -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                <button class="w-full px-6 py-4 text-left flex items-center justify-between focus:outline-none" onclick="toggleFaq(2)">
                    <span class="text-sm font-medium text-gray-900">2. Do I have to pay a fee to rehome my pet through PetRehomer?</span>
                    <svg id="icon-2" class="w-5 h-5 text-gray-400 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                </button>
                <div id="content-2" class="px-6 pb-4 hidden">
                    <p class="text-sm text-gray-600">
                        No, our rehoming service is completely free for pet owners. We believe that finding a loving home for your pet shouldn't come with financial stress.
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
                        Yes, we conduct thorough home checks for all potential adopters to ensure they can provide a safe and suitable environment for your pet.
                    </p>
                </div>
            </div>

            <!-- FAQ 4 -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                <button class="w-full px-6 py-4 text-left flex items-center justify-between focus:outline-none" onclick="toggleFaq(4)">
                    <span class="text-sm font-medium text-gray-900">4. My pet has behavioural problems. Can I use the PetRehomer website to find them a new home?</span>
                    <svg id="icon-4" class="w-5 h-5 text-gray-400 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                </button>
                <div id="content-4" class="px-6 pb-4 hidden">
                    <p class="text-sm text-gray-600">
                        Yes, but it's important to be completely honest about any behavioral issues. This helps us find adopters who are experienced and equipped to handle your pet's specific needs.
                    </p>
                </div>
            </div>

            <!-- FAQ 5 -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                <button class="w-full px-6 py-4 text-left flex items-center justify-between focus:outline-none" onclick="toggleFaq(5)">
                    <span class="text-sm font-medium text-gray-900">5. I've heard of people adopting dogs online then using them as bait. What will you do to make sure my pet is rehomed safely? How can I trust you?</span>
                    <svg id="icon-5" class="w-5 h-5 text-gray-400 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                </button>
                <div id="content-5" class="px-6 pb-4 hidden">
                    <p class="text-sm text-gray-600">
                        We take pet safety very seriously. All potential adopters go through a thorough screening process including background checks, home visits, and reference verification. We also provide guidance on safe meeting practices.
                    </p>
                </div>
            </div>

            <!-- FAQ 6 -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                <button class="w-full px-6 py-4 text-left flex items-center justify-between focus:outline-none" onclick="toggleFaq(6)">
                    <span class="text-sm font-medium text-gray-900">6. What do I need to do when I hand over my pet to the new Adopter?</span>
                    <svg id="icon-6" class="w-5 h-5 text-gray-400 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                </button>
                <div id="content-6" class="px-6 pb-4 hidden">
                    <p class="text-sm text-gray-600">
                        Provide all medical records, vaccination certificates, any medications, favorite toys, food, and detailed care instructions. We'll provide you with a complete handover checklist.
                    </p>
                </div>
            </div>

            <!-- FAQ 7 -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                <button class="w-full px-6 py-4 text-left flex items-center justify-between focus:outline-none" onclick="toggleFaq(7)">
                    <span class="text-sm font-medium text-gray-900">7. I can't complete the forms online - Can somebody help me please?</span>
                    <svg id="icon-7" class="w-5 h-5 text-gray-400 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                </button>
                <div id="content-7" class="px-6 pb-4 hidden">
                    <p class="text-sm text-gray-600">
                        Absolutely! Our support team is here to help. You can call us at +1 (555) 123-4567 or email us at support@furryfriends.com and we'll guide you through the process step by step.
                    </p>
                </div>
            </div>

            <!-- FAQ 8 -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                <button class="w-full px-6 py-4 text-left flex items-center justify-between focus:outline-none" onclick="toggleFaq(8)">
                    <span class="text-sm font-medium text-gray-900">8. How do I delete my User Account?</span>
                    <svg id="icon-8" class="w-5 h-5 text-gray-400 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                </button>
                <div id="content-8" class="px-6 pb-4 hidden">
                    <p class="text-sm text-gray-600">
                        You can delete your account by going to your account settings and clicking "Delete Account" or by contacting our support team who can help you with the process.
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