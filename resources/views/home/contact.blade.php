@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50">

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">

            <!-- Left Column -->
            <div class="space-y-8">

                <!-- Header -->
                <div>
                    <h1 class="text-xl font-bold text-gray-900 mb-3">Contact Us</h1>
                    <p class="text-sm text-gray-600">
                        Get in touch with our team by choosing what kind of our services you are looking for.
                    </p>
                </div>

                <!-- Contact Image -->
                <div class="relative">
                    <img src="{{ asset('images/dog.jpeg') }}" 
                         alt="Woman with pets" 
                         class="w-full h-96 object-cover rounded-2xl shadow-lg">
                </div>

                <!-- Contact Information -->
                <div class="bg-white rounded-2xl p-6 shadow-lg border">
                    <div class="space-y-4 text-sm">
                        <!-- Address -->
                        <div class="flex items-start space-x-3">
                            <div class="w-6 h-6 text-purple-600 mt-1">
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                            </div>
                            <p class="text-gray-900 font-medium">123 Main Street, Anytown,USA</p>
                        </div>

                        <!-- Phone -->
                        <div class="flex items-start space-x-3">
                            <div class="w-6 h-6 text-purple-600 mt-1">
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                </svg>
                            </div>
                            <p class="text-gray-900 font-medium">+1 (555) 123-4567</p>
                        </div>

                        <!-- Email -->
                        <div class="flex items-start space-x-3">
                            <div class="w-6 h-6 text-purple-600 mt-1">
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                </svg>
                            </div>
                            <p class="text-gray-900 font-medium">FurryFriendsSupport@gmail.com</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Column - Contact Form -->
            <div class="bg-white rounded-2xl p-8 shadow-lg border h-fit text-sm">
                <div class="flex items-center space-x-3 mb-6">
                    <div class="w-8 h-8 text-purple-600">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                        </svg>
                    </div>
                    <h2 class="text-base font-semibold text-gray-900">Ready to help you</h2>
                </div>

                <form action="{{ route('contact.store') }}" method="POST" class="space-y-6">
                    @csrf

                    <!-- Name -->
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Name</label>
                        <input type="text" name="name" id="name"
                            value="{{ old('name') }}"
                            placeholder="Your Name"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-colors @error('name') border-red-500 @enderror"
                            required>
                        @error('name')
                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                        <input type="email" name="email" id="email"
                            value="{{ old('email') }}"
                            placeholder="Your E-mail address"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-colors @error('email') border-red-500 @enderror"
                            required>
                        @error('email')
                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Phone -->
                    <div>
                        <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">Phone number</label>
                        <input type="tel" name="phone" id="phone"
                            value="{{ old('phone') }}"
                            placeholder="US +1 (555)..."
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-colors @error('phone') border-red-500 @enderror">
                        @error('phone')
                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Subject -->
                    <div>
                        <label for="subject" class="block text-sm font-medium text-gray-700 mb-1">Subject</label>
                        <input type="text" name="subject" id="subject"
                            value="{{ old('subject') }}"
                            placeholder="Subject of your message"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-colors @error('subject') border-red-500 @enderror"
                            required>
                        @error('subject')
                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Message -->
                    <div>
                        <label for="message" class="block text-sm font-medium text-gray-700 mb-1">Message</label>
                        <textarea name="message" id="message" rows="5"
                            placeholder="Tell us about your request"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent resize-none transition-colors @error('message') border-red-500 @enderror"
                            required>{{ old('message') }}</textarea>
                        @error('message')
                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Submit Button -->
                    <button type="submit"
                        class="w-full bg-purple-600 text-white py-2 px-4 rounded-lg font-medium hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-offset-2 transition-colors">
                        Send
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

@if(session('success'))
    <div id="success-message" class="fixed top-4 right-4 bg-green-500 text-white px-6 py-4 rounded-lg shadow-lg z-50 text-sm">
        <div class="flex items-center">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
            </svg>
            {{ session('success') }}
        </div>
    </div>
    <script>
        setTimeout(function () {
            document.getElementById('success-message')?.remove();
        }, 5000);
    </script>
@endif
@endsection
