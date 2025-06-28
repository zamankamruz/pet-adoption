<?php
// File: show.blade.php
// Path: /resources/views/admin/newsletter/show.blade.php
?>

@extends('layouts.admin')

@section('content')
<div class="container mx-auto px-4 py-6">
    <!-- Header -->
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Subscriber Details</h1>
            <p class="text-gray-600">View and manage subscriber information</p>
        </div>
        <div class="flex space-x-3">
            <a href="{{ route('admin.newsletter.edit', $subscriber) }}" 
               class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg font-medium transition-colors duration-200">
                <i class="fas fa-edit mr-2"></i>Edit Subscriber
            </a>
            <a href="{{ route('admin.newsletter.index') }}" 
               class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg font-medium transition-colors duration-200">
                <i class="fas fa-arrow-left mr-2"></i>Back to List
            </a>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Main Information -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Subscriber Information -->
            <div class="bg-white rounded-lg shadow">
                <div class="p-6">
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="text-lg font-semibold text-gray-900">
                            <i class="fas fa-user mr-2"></i>Subscriber Information
                        </h3>
                        
                        <!-- Status Badge -->
                        @if($subscriber->is_active)
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                                <i class="fas fa-check-circle mr-1"></i>Active
                            </span>
                        @else
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-red-100 text-red-800">
                                <i class="fas fa-times-circle mr-1"></i>Inactive
                            </span>
                        @endif
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Email -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
                            <div class="flex items-center">
                                <i class="fas fa-envelope text-gray-400 mr-3"></i>
                                <span class="text-gray-900 font-medium">{{ $subscriber->email }}</span>
                                <button onclick="copyToClipboard('{{ $subscriber->email }}')" 
                                        class="ml-2 text-gray-400 hover:text-gray-600">
                                    <i class="fas fa-copy"></i>
                                </button>
                            </div>
                        </div>

                        <!-- Name -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Name</label>
                            <div class="flex items-center">
                                <i class="fas fa-user text-gray-400 mr-3"></i>
                                <span class="text-gray-900">{{ $subscriber->name ?: 'Not provided' }}</span>
                            </div>
                        </div>

                        <!-- Subscriber ID -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Subscriber ID</label>
                            <div class="flex items-center">
                                <i class="fas fa-hashtag text-gray-400 mr-3"></i>
                                <span class="text-gray-900 font-mono">#{{ str_pad($subscriber->id, 6, '0', STR_PAD_LEFT) }}</span>
                            </div>
                        </div>

                        <!-- Status -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Current Status</label>
                            <div class="flex items-center">
                                <i class="fas {{ $subscriber->is_active ? 'fa-toggle-on text-green-500' : 'fa-toggle-off text-red-500' }} mr-3"></i>
                                <span class="text-gray-900">{{ $subscriber->is_active ? 'Active' : 'Inactive' }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Subscription Timeline -->
            <div class="bg-white rounded-lg shadow">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-6">
                        <i class="fas fa-clock mr-2"></i>Subscription Timeline
                    </h3>

                    <div class="space-y-4">
                        <!-- Subscribed -->
                        <div class="flex items-start">
                            <div class="flex-shrink-0">
                                <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center">
                                    <i class="fas fa-plus text-green-600 text-sm"></i>
                                </div>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-900">Subscribed to Newsletter</p>
                                <p class="text-sm text-gray-500">
                                    {{ $subscriber->subscribed_at->format('F j, Y \a\t g:i A') }}
                                    <span class="text-gray-400">
                                        ({{ $subscriber->subscribed_at->diffForHumans() }})
                                    </span>
                                </p>
                            </div>
                        </div>

                        @if($subscriber->unsubscribed_at)
                            <!-- Unsubscribed -->
                            <div class="flex items-start">
                                <div class="flex-shrink-0">
                                    <div class="w-8 h-8 bg-red-100 rounded-full flex items-center justify-center">
                                        <i class="fas fa-minus text-red-600 text-sm"></i>
                                    </div>
                                </div>
                                <div class="ml-4">
                                    <p class="text-sm font-medium text-gray-900">Unsubscribed</p>
                                    <p class="text-sm text-gray-500">
                                        {{ $subscriber->unsubscribed_at->format('F j, Y \a\t g:i A') }}
                                        <span class="text-gray-400">
                                            ({{ $subscriber->unsubscribed_at->diffForHumans() }})
                                        </span>
                                    </p>
                                </div>
                            </div>
                        @endif

                        <!-- Last Updated -->
                        @if($subscriber->updated_at != $subscriber->created_at)
                            <div class="flex items-start">
                                <div class="flex-shrink-0">
                                    <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center">
                                        <i class="fas fa-edit text-blue-600 text-sm"></i>
                                    </div>
                                </div>
                                <div class="ml-4">
                                    <p class="text-sm font-medium text-gray-900">Last Updated</p>
                                    <p class="text-sm text-gray-500">
                                        {{ $subscriber->updated_at->format('F j, Y \a\t g:i A') }}
                                        <span class="text-gray-400">
                                            ({{ $subscriber->updated_at->diffForHumans() }})
                                        </span>
                                    </p>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Technical Details -->
            <div class="bg-white rounded-lg shadow">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-6">
                        <i class="fas fa-cog mr-2"></i>Technical Details
                    </h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Unsubscribe Token</label>
                            <div class="flex items-center">
                                <code class="text-xs bg-gray-100 px-2 py-1 rounded font-mono">
                                    {{ Str::limit($subscriber->unsubscribe_token, 20) }}...
                                </code>
                                <button onclick="copyToClipboard('{{ $subscriber->unsubscribe_token }}')" 
                                        class="ml-2 text-gray-400 hover:text-gray-600">
                                    <i class="fas fa-copy"></i>
                                </button>
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Unsubscribe URL</label>
                            <div class="flex items-center">
                                <a href="{{ route('newsletter.unsubscribe', $subscriber->unsubscribe_token) }}" 
                                   target="_blank" 
                                   class="text-blue-600 hover:text-blue-800 text-sm">
                                    View Unsubscribe Page
                                    <i class="fas fa-external-link-alt ml-1"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar Actions -->
        <div class="space-y-6">
            <!-- Quick Actions -->
            <div class="bg-white rounded-lg shadow">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">
                        <i class="fas fa-bolt mr-2"></i>Quick Actions
                    </h3>

                    <div class="space-y-3">
                        @if($subscriber->is_active)
                            <form method="POST" action="{{ route('admin.newsletter.deactivate', $subscriber) }}">
                                @csrf
                                <button type="submit" 
                                        onclick="return confirm('Deactivate this subscriber?')"
                                        class="w-full bg-yellow-600 hover:bg-yellow-700 text-white px-4 py-2 rounded-lg font-medium transition-colors duration-200">
                                    <i class="fas fa-pause mr-2"></i>Deactivate Subscriber
                                </button>
                            </form>
                        @else
                            <form method="POST" action="{{ route('admin.newsletter.activate', $subscriber) }}">
                                @csrf
                                <button type="submit" 
                                        class="w-full bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg font-medium transition-colors duration-200">
                                    <i class="fas fa-play mr-2"></i>Activate Subscriber
                                </button>
                            </form>
                        @endif

                        <a href="{{ route('admin.newsletter.edit', $subscriber) }}" 
                           class="block w-full bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg font-medium text-center transition-colors duration-200">
                            <i class="fas fa-edit mr-2"></i>Edit Details
                        </a>

                        <button onclick="sendTestEmail()" 
                                class="w-full bg-purple-600 hover:bg-purple-700 text-white px-4 py-2 rounded-lg font-medium transition-colors duration-200">
                            <i class="fas fa-envelope mr-2"></i>Send Test Email
                        </button>
                    </div>
                </div>
            </div>

            <!-- Danger Zone -->
            <div class="bg-white rounded-lg shadow border border-red-200">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-red-900 mb-4">
                        <i class="fas fa-exclamation-triangle mr-2"></i>Danger Zone
                    </h3>

                    <p class="text-sm text-gray-600 mb-4">
                        Permanently delete this subscriber. This action cannot be undone.
                    </p>

                    <form method="POST" action="{{ route('admin.newsletter.destroy', $subscriber) }}" onsubmit="return confirmDelete()">
                        @csrf
                        @method('DELETE')
                        <button type="submit" 
                                class="w-full bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg font-medium transition-colors duration-200">
                            <i class="fas fa-trash mr-2"></i>Delete Subscriber
                        </button>
                    </form>
                </div>
            </div>

            <!-- Statistics -->
            <div class="bg-white rounded-lg shadow">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">
                        <i class="fas fa-chart-bar mr-2"></i>Statistics
                    </h3>

                    <div class="space-y-3">
                        <div class="flex justify-between">
                            <span class="text-sm text-gray-600">Days Subscribed:</span>
                            <span class="text-sm font-medium text-gray-900">
                                {{ $subscriber->subscribed_at->diffInDays(now()) }}
                            </span>
                        </div>

                        <div class="flex justify-between">
                            <span class="text-sm text-gray-600">Status:</span>
                            <span class="text-sm font-medium {{ $subscriber->is_active ? 'text-green-600' : 'text-red-600' }}">
                                {{ $subscriber->is_active ? 'Active' : 'Inactive' }}
                            </span>
                        </div>

                        <div class="flex justify-between">
                            <span class="text-sm text-gray-600">Last Updated:</span>
                            <span class="text-sm font-medium text-gray-900">
                                {{ $subscriber->updated_at->diffForHumans() }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function copyToClipboard(text) {
    navigator.clipboard.writeText(text).then(function() {
        // Show success message
        const originalText = event.target.innerHTML;
        event.target.innerHTML = '<i class="fas fa-check"></i>';
        event.target.classList.add('text-green-600');
        
        setTimeout(() => {
            event.target.innerHTML = originalText;
            event.target.classList.remove('text-green-600');
        }, 2000);
    }).catch(function(err) {
        alert('Failed to copy to clipboard');
    });
}

function sendTestEmail() {
    alert('Test email functionality would be implemented here');
}

function confirmDelete() {
    return confirm('Are you sure you want to permanently delete this subscriber?\n\nThis action cannot be undone and will remove:\n- Subscriber information\n- Subscription history\n- All related data');
}
</script>
@endsection