<?php
// File: edit.blade.php
// Path: /resources/views/admin/newsletter/edit.blade.php
?>

@extends('layouts.admin')

@section('content')
<div class="container mx-auto px-4 py-6">
    <!-- Header -->
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Edit Subscriber</h1>
            <p class="text-gray-600">Update subscriber information</p>
        </div>
        <div class="flex space-x-3">
            <a href="{{ route('admin.newsletter.show', $subscriber) }}" 
               class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg font-medium transition-colors duration-200">
                <i class="fas fa-eye mr-2"></i>View Details
            </a>
            <a href="{{ route('admin.newsletter.index') }}" 
               class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg font-medium transition-colors duration-200">
                <i class="fas fa-arrow-left mr-2"></i>Back to List
            </a>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Edit Form -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-lg shadow">
                <form method="POST" action="{{ route('admin.newsletter.update', $subscriber) }}">
                    @csrf
                    @method('PUT')
                    
                    <div class="p-6 space-y-6">
                        <!-- Current Status Info -->
                        <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                            <div class="flex items-center">
                                <i class="fas fa-info-circle text-blue-600 mr-2"></i>
                                <span class="text-sm font-medium text-blue-900">
                                    Currently editing subscriber #{{ str_pad($subscriber->id, 6, '0', STR_PAD_LEFT) }}
                                </span>
                            </div>
                            <p class="text-sm text-blue-800 mt-1">
                                Subscribed {{ $subscriber->subscribed_at->diffForHumans() }} • 
                                Status: {{ $subscriber->is_active ? 'Active' : 'Inactive' }}
                            </p>
                        </div>

                        <!-- Email Address -->
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                                Email Address *
                            </label>
                            <input type="email" 
                                   id="email" 
                                   name="email" 
                                   value="{{ old('email', $subscriber->email) }}"
                                   required 
                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('email') border-red-500 @enderror"
                                   placeholder="subscriber@example.com">
                            @error('email')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                            <p class="mt-1 text-sm text-gray-500">
                                The email address must be unique across all subscribers.
                            </p>
                        </div>

                        <!-- Name -->
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                                Name (Optional)
                            </label>
                            <input type="text" 
                                   id="name" 
                                   name="name" 
                                   value="{{ old('name', $subscriber->name) }}"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('name') border-red-500 @enderror"
                                   placeholder="Subscriber's full name">
                            @error('name')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                            <p class="mt-1 text-sm text-gray-500">
                                Name helps personalize newsletter emails.
                            </p>
                        </div>

                        <!-- Status -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Subscription Status
                            </label>
                            <div class="space-y-3">
                                <label class="flex items-center">
                                    <input type="radio" 
                                           name="is_active" 
                                           value="1" 
                                           {{ old('is_active', $subscriber->is_active) ? 'checked' : '' }}
                                           class="text-blue-600 focus:ring-blue-500">
                                    <span class="ml-2 text-sm">
                                        <span class="font-medium text-green-600">Active</span> - 
                                        Subscriber will receive newsletters
                                    </span>
                                </label>
                                <label class="flex items-center">
                                    <input type="radio" 
                                           name="is_active" 
                                           value="0" 
                                           {{ !old('is_active', $subscriber->is_active) ? 'checked' : '' }}
                                           class="text-blue-600 focus:ring-blue-500">
                                    <span class="ml-2 text-sm">
                                        <span class="font-medium text-red-600">Inactive</span> - 
                                        Subscriber will not receive newsletters
                                    </span>
                                </label>
                            </div>
                            @if($subscriber->unsubscribed_at)
                                <div class="mt-3 p-3 bg-yellow-50 border border-yellow-200 rounded-lg">
                                    <p class="text-sm text-yellow-800">
                                        <i class="fas fa-exclamation-triangle mr-1"></i>
                                        This subscriber unsubscribed on {{ $subscriber->unsubscribed_at->format('M j, Y') }}.
                                        Activating them will clear the unsubscribe date.
                                    </p>
                                </div>
                            @endif
                        </div>

                        <!-- Advanced Options -->
                        <div class="border-t pt-6">
                            <h4 class="text-lg font-medium text-gray-900 mb-4">Advanced Options</h4>
                            
                            <div class="space-y-4">
                                <!-- Reset Unsubscribe Token -->
                                <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                                    <div>
                                        <h5 class="text-sm font-medium text-gray-900">Reset Unsubscribe Token</h5>
                                        <p class="text-sm text-gray-600">Generate a new unsubscribe token for security</p>
                                    </div>
                                    <button type="button" 
                                            onclick="resetToken()"
                                            class="bg-gray-600 hover:bg-gray-700 text-white px-3 py-1 rounded text-sm font-medium transition-colors duration-200">
                                        Reset Token
                                    </button>
                                </div>

                                <!-- Subscription Date -->
                                <div>
                                    <label for="subscribed_at" class="block text-sm font-medium text-gray-700 mb-2">
                                        Subscription Date
                                    </label>
                                    <input type="datetime-local" 
                                           id="subscribed_at" 
                                           name="subscribed_at" 
                                           value="{{ old('subscribed_at', $subscriber->subscribed_at->format('Y-m-d\TH:i')) }}"
                                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                    <p class="mt-1 text-sm text-gray-500">
                                        When this subscriber originally signed up.
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Change Log -->
                        <div class="bg-gray-50 border border-gray-200 rounded-lg p-4">
                            <h5 class="text-sm font-medium text-gray-900 mb-2">
                                <i class="fas fa-history mr-1"></i>Change History
                            </h5>
                            <div class="text-sm text-gray-600 space-y-1">
                                <p>Created: {{ $subscriber->created_at->format('M j, Y g:i A') }}</p>
                                @if($subscriber->updated_at != $subscriber->created_at)
                                    <p>Last Modified: {{ $subscriber->updated_at->format('M j, Y g:i A') }}</p>
                                @endif
                                @if($subscriber->unsubscribed_at)
                                    <p>Unsubscribed: {{ $subscriber->unsubscribed_at->format('M j, Y g:i A') }}</p>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Form Actions -->
                    <div class="px-6 py-4 bg-gray-50 border-t border-gray-200 flex justify-between items-center">
                        <div class="text-sm text-gray-600">
                            <i class="fas fa-asterisk text-red-500 text-xs mr-1"></i>
                            Fields marked with * are required
                        </div>
                        
                        <div class="flex space-x-3">
                            <a href="{{ route('admin.newsletter.show', $subscriber) }}" 
                               class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 font-medium transition-colors duration-200">
                                Cancel
                            </a>
                            <button type="submit" 
                                    class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg font-medium transition-colors duration-200">
                                <i class="fas fa-save mr-2"></i>Update Subscriber
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Sidebar Info -->
        <div class="space-y-6">
            <!-- Current Information -->
            <div class="bg-white rounded-lg shadow">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">
                        <i class="fas fa-info-circle mr-2"></i>Current Information
                    </h3>

                    <div class="space-y-3">
                        <div>
                            <label class="block text-xs font-medium text-gray-500 uppercase tracking-wider">Email</label>
                            <p class="text-sm text-gray-900 font-medium">{{ $subscriber->email }}</p>
                        </div>

                        <div>
                            <label class="block text-xs font-medium text-gray-500 uppercase tracking-wider">Name</label>
                            <p class="text-sm text-gray-900">{{ $subscriber->name ?: 'Not provided' }}</p>
                        </div>

                        <div>
                            <label class="block text-xs font-medium text-gray-500 uppercase tracking-wider">Status</label>
                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium {{ $subscriber->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                {{ $subscriber->is_active ? 'Active' : 'Inactive' }}
                            </span>
                        </div>

                        <div>
                            <label class="block text-xs font-medium text-gray-500 uppercase tracking-wider">Subscribed</label>
                            <p class="text-sm text-gray-900">{{ $subscriber->subscribed_at->format('M j, Y') }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Help & Tips -->
            <div class="bg-white rounded-lg shadow">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">
                        <i class="fas fa-lightbulb mr-2"></i>Tips
                    </h3>

                    <div class="space-y-3 text-sm text-gray-600">
                        <div class="flex items-start">
                            <i class="fas fa-check text-green-500 mr-2 mt-0.5"></i>
                            <span>Email changes will take effect immediately</span>
                        </div>
                        <div class="flex items-start">
                            <i class="fas fa-check text-green-500 mr-2 mt-0.5"></i>
                            <span>Status changes affect newsletter delivery</span>
                        </div>
                        <div class="flex items-start">
                            <i class="fas fa-check text-green-500 mr-2 mt-0.5"></i>
                            <span>Names help personalize email content</span>
                        </div>
                        <div class="flex items-start">
                            <i class="fas fa-exclamation-triangle text-yellow-500 mr-2 mt-0.5"></i>
                            <span>Token reset will invalidate existing unsubscribe links</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="bg-white rounded-lg shadow">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">
                        <i class="fas fa-bolt mr-2"></i>Quick Actions
                    </h3>

                    <div class="space-y-3">
                        <button onclick="sendTestEmail()" 
                                class="w-full bg-purple-600 hover:bg-purple-700 text-white px-4 py-2 rounded-lg font-medium text-sm transition-colors duration-200">
                            <i class="fas fa-envelope mr-2"></i>Send Test Email
                        </button>

                        <a href="{{ route('newsletter.unsubscribe', $subscriber->unsubscribe_token) }}" 
                           target="_blank"
                           class="block w-full bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg font-medium text-sm text-center transition-colors duration-200">
                            <i class="fas fa-external-link-alt mr-2"></i>View Unsubscribe Page
                        </a>
                    </div>
                </div>
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

function resetToken() {
    if (confirm('Are you sure you want to reset the unsubscribe token?\n\nThis will invalidate any existing unsubscribe links sent to this subscriber.')) {
        // Add a hidden input to trigger token reset
        const form = document.querySelector('form');
        const input = document.createElement('input');
        input.type = 'hidden';
        input.name = 'reset_token';
        input.value = '1';
        form.appendChild(input);
        
        alert('Token will be reset when you save the form.');
    }
}

function sendTestEmail() {
    const email = document.getElementById('email').value;
    if (!email) {
        alert('Please enter an email address first');
        return;
    }
    
    if (confirm(`Send a test newsletter to ${email}?`)) {
        alert('Test email functionality would be implemented here');
    }
}

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

// Auto-save draft (optional feature)
let autoSaveTimer;
function autoSave() {
    clearTimeout(autoSaveTimer);
    autoSaveTimer = setTimeout(() => {
        // Auto-save logic could be implemented here
        console.log('Auto-saving draft...');
    }, 3000);
}

// Trigger auto-save on input changes
document.querySelectorAll('input, textarea, select').forEach(element => {
    element.addEventListener('input', autoSave);
});
</script>
@endsection