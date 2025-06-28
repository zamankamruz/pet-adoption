<?php
// File: create.blade.php
// Path: /resources/views/admin/newsletter/create.blade.php
?>

@extends('layouts.admin')

@section('content')
<div class="container mx-auto px-4 py-6">
    <!-- Header -->
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Add New Subscriber</h1>
            <p class="text-gray-600">Manually add a new newsletter subscriber</p>
        </div>
        <a href="{{ route('admin.newsletter.index') }}" 
           class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg font-medium transition-colors duration-200">
            <i class="fas fa-arrow-left mr-2"></i>Back to Subscribers
        </a>
    </div>

    <!-- Create Form -->
    <div class="bg-white rounded-lg shadow">
        <form method="POST" action="{{ route('admin.newsletter.store') }}">
            @csrf
            <div class="p-6 space-y-6">
                <!-- Email Address -->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                        Email Address *
                    </label>
                    <input type="email" 
                           id="email" 
                           name="email" 
                           value="{{ old('email') }}"
                           required 
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('email') border-red-500 @enderror"
                           placeholder="subscriber@example.com">
                    @error('email')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                    <p class="mt-1 text-sm text-gray-500">
                        The email address must be unique and not already subscribed.
                    </p>
                </div>

                <!-- Name (Optional) -->
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                        Name (Optional)
                    </label>
                    <input type="text" 
                           id="name" 
                           name="name" 
                           value="{{ old('name') }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('name') border-red-500 @enderror"
                           placeholder="Subscriber's full name">
                    @error('name')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                    <p class="mt-1 text-sm text-gray-500">
                        Name is optional but helps personalize newsletters.
                    </p>
                </div>

                <!-- Status -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Initial Status
                    </label>
                    <div class="space-y-3">
                        <label class="flex items-center">
                            <input type="radio" name="is_active" value="1" checked 
                                   class="text-blue-600 focus:ring-blue-500">
                            <span class="ml-2 text-sm text-gray-700">
                                <span class="font-medium text-green-600">Active</span> - 
                                Subscriber will receive newsletters immediately
                            </span>
                        </label>
                        <label class="flex items-center">
                            <input type="radio" name="is_active" value="0" 
                                   class="text-blue-600 focus:ring-blue-500">
                            <span class="ml-2 text-sm text-gray-700">
                                <span class="font-medium text-red-600">Inactive</span> - 
                                Subscriber will not receive newsletters
                            </span>
                        </label>
                    </div>
                </div>

                <!-- Additional Information -->
                <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                    <h3 class="text-sm font-medium text-blue-900 mb-2">
                        <i class="fas fa-info-circle mr-1"></i>Additional Information
                    </h3>
                    <ul class="text-sm text-blue-800 space-y-1">
                        <li>• The subscriber will be automatically assigned a unique unsubscribe token</li>
                        <li>• Subscription date will be set to the current time</li>
                        <li>• No confirmation email will be sent for manual additions</li>
                        <li>• You can edit subscriber details anytime after creation</li>
                    </ul>
                </div>
            </div>

            <!-- Form Actions -->
            <div class="px-6 py-4 bg-gray-50 border-t border-gray-200 flex justify-between items-center">
                <div class="text-sm text-gray-600">
                    <i class="fas fa-asterisk text-red-500 text-xs mr-1"></i>
                    Fields marked with * are required
                </div>
                
                <div class="flex space-x-3">
                    <a href="{{ route('admin.newsletter.index') }}" 
                       class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 font-medium transition-colors duration-200">
                        Cancel
                    </a>
                    <button type="submit" 
                            class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg font-medium transition-colors duration-200">
                        <i class="fas fa-plus mr-2"></i>Add Subscriber
                    </button>
                </div>
            </div>
        </form>
    </div>

    <!-- Bulk Import Section -->
    <div class="bg-white rounded-lg shadow mt-6">
        <div class="p-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">
                <i class="fas fa-upload mr-2"></i>Bulk Import Subscribers
            </h3>
            <p class="text-gray-600 mb-4">
                Need to add multiple subscribers? You can import them from a CSV file.
            </p>
            
            <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center">
                <i class="fas fa-file-csv text-3xl text-gray-400 mb-3"></i>
                <p class="text-gray-600 mb-4">
                    Drag and drop your CSV file here, or click to browse
                </p>
                <button type="button" 
                        onclick="alert('Bulk import feature coming soon!')"
                        class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg font-medium transition-colors duration-200">
                    <i class="fas fa-folder-open mr-2"></i>Choose File
                </button>
                <p class="text-xs text-gray-500 mt-3">
                    CSV format: email,name (header row required)
                </p>
            </div>
        </div>
    </div>
</div>

<script>
// Email validation as user types
document.getElementById('email').addEventListener('input', function() {
    const email = this.value;
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    
    if (email && !emailRegex.test(email)) {
        this.classList.add('border-red-500');
        this.classList.remove('border-gray-300');
    } else {
        this.classList.remove('border-red-500');
        this.classList.add('border-gray-300');
    }
});

// Form validation before submit
document.querySelector('form').addEventListener('submit', function(e) {
    const email = document.getElementById('email').value.trim();
    
    if (!email) {
        e.preventDefault();
        alert('Please enter an email address');
        document.getElementById('email').focus();
        return false;
    }
    
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailRegex.test(email)) {
        e.preventDefault();
        alert('Please enter a valid email address');
        document.getElementById('email').focus();
        return false;
    }
});
</script>
@endsection