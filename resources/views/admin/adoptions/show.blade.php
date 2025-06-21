<?php
// File: show.blade.php
// Path: /resources/views/admin/adoptions/show.blade.php
?>

@extends('layouts.app')

@section('title', 'Adoption Request Details')

@section('content')
<div class="min-h-screen bg-gray-50">
    <!-- Header -->
    <div class="bg-white shadow">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">Adoption Request Details</h1>
                    <p class="mt-1 text-sm text-gray-600">
                        Reference: {{ $adoption->reference_number ?? 'ADO-' . str_pad($adoption->id, 6, '0', STR_PAD_LEFT) }} • 
                        Submitted {{ $adoption->requested_at->format('M d, Y \a\t g:i A') }}
                    </p>
                </div>
                <div class="flex space-x-3">
                    @if($adoption->status === 'pending')
                        <button onclick="approveAdoption()" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-green-600 hover:bg-green-700">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            Approve
                        </button>
                        <button onclick="rejectAdoption()" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-red-600 hover:bg-red-700">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                            Reject
                        </button>
                    @elseif($adoption->status === 'approved')
                        <button onclick="completeAdoption()" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            Mark Complete
                        </button>
                    @endif

                    <a href="{{ route('admin.adoptions.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                        </svg>
                        Back to Adoptions
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        <!-- Status Badge -->
        <div class="mb-6">
            <span class="inline-flex items-center px-4 py-2 rounded-full text-sm font-medium
                {{ $adoption->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : 
                   ($adoption->status === 'approved' ? 'bg-green-100 text-green-800' : 
                   ($adoption->status === 'completed' ? 'bg-blue-100 text-blue-800' : 
                   ($adoption->status === 'rejected' ? 'bg-red-100 text-red-800' : 'bg-gray-100 text-gray-800'))) }}">
                <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                    @if($adoption->status === 'pending')
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
                    @elseif($adoption->status === 'approved')
                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                    @elseif($adoption->status === 'completed')
                        <path d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z"/>
                    @else
                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/>
                    @endif
                </svg>
                {{ ucfirst($adoption->status) }}
            </span>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Main Content -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Pet Information -->
                <div class="bg-white shadow rounded-lg">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h3 class="text-lg font-medium text-gray-900">Pet Information</h3>
                    </div>
                    <div class="px-6 py-4">
                        <div class="flex items-start space-x-6">
                            <div class="flex-shrink-0">
                                <img class="h-24 w-24 rounded-lg object-cover" src="{{ $adoption->pet->main_image_url }}" alt="{{ $adoption->pet->name }}">
                            </div>
                            <div class="flex-1">
                                <h4 class="text-xl font-semibold text-gray-900 mb-2">{{ $adoption->pet->name }}</h4>
                                <div class="grid grid-cols-2 gap-4 text-sm">
                                    <div>
                                        <span class="text-gray-500">Breed:</span>
                                        <span class="ml-2 text-gray-900">{{ $adoption->pet->breed->name }}</span>
                                    </div>
                                    <div>
                                        <span class="text-gray-500">Age:</span>
                                        <span class="ml-2 text-gray-900">{{ $adoption->pet->age_display }}</span>
                                    </div>
                                    <div>
                                        <span class="text-gray-500">Gender:</span>
                                        <span class="ml-2 text-gray-900">{{ ucfirst($adoption->pet->gender) }}</span>
                                    </div>
                                    <div>
                                        <span class="text-gray-500">Size:</span>
                                        <span class="ml-2 text-gray-900">{{ ucfirst($adoption->pet->size) }}</span>
                                    </div>
                                    <div>
                                        <span class="text-gray-500">Location:</span>
                                        <span class="ml-2 text-gray-900">{{ $adoption->pet->location->city }}, {{ $adoption->pet->location->state }}</span>
                                    </div>
                                    <div>
                                        <span class="text-gray-500">Adoption Fee:</span>
                                        <span class="ml-2 text-gray-900">${{ number_format($adoption->pet->adoption_fee, 2) }}</span>
                                    </div>
                                </div>
                                <div class="mt-4">
                                    <a href="{{ route('admin.pets.show', $adoption->pet) }}" class="text-blue-600 hover:text-blue-900 text-sm font-medium">
                                        View Full Pet Profile →
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Adopter Information -->
                <div class="bg-white shadow rounded-lg">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h3 class="text-lg font-medium text-gray-900">Adopter Information</h3>
                    </div>
                    <div class="px-6 py-4">
                        <div class="flex items-start space-x-6">
                            <div class="flex-shrink-0">
                                <img class="h-16 w-16 rounded-full object-cover" src="{{ $adoption->user->avatar_url }}" alt="{{ $adoption->user->name }}">
                            </div>
                            <div class="flex-1">
                                <h4 class="text-lg font-semibold text-gray-900 mb-2">{{ $adoption->user->name }}</h4>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
                                    <div>
                                        <span class="text-gray-500">Email:</span>
                                        <span class="ml-2 text-gray-900">{{ $adoption->user->email }}</span>
                                    </div>
                                    @if($adoption->user->phone)
                                        <div>
                                            <span class="text-gray-500">Phone:</span>
                                            <span class="ml-2 text-gray-900">{{ $adoption->user->phone }}</span>
                                        </div>
                                    @endif
                                    @if($adoption->user->city)
                                        <div>
                                            <span class="text-gray-500">Location:</span>
                                            <span class="ml-2 text-gray-900">{{ $adoption->user->city }}, {{ $adoption->user->state }}</span>
                                        </div>
                                    @endif
                                    <div>
                                        <span class="text-gray-500">Member Since:</span>
                                        <span class="ml-2 text-gray-900">{{ $adoption->user->created_at->format('M Y') }}</span>
                                    </div>
                                </div>
                                <div class="mt-4">
                                    <a href="{{ route('admin.users.show', $adoption->user) }}" class="text-blue-600 hover:text-blue-900 text-sm font-medium">
                                        View Full User Profile →
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Application Details -->
                <div class="bg-white shadow rounded-lg">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h3 class="text-lg font-medium text-gray-900">Application Details</h3>
                    </div>
                    <div class="px-6 py-4">
                        @if($adoption->application_data)
                            <div class="space-y-6">
                                @foreach($adoption->application_data as $key => $value)
                                    @if($value)
                                        <div>
                                            <h5 class="text-sm font-medium text-gray-700 mb-2">{{ ucwords(str_replace('_', ' ', $key)) }}</h5>
                                            <div class="text-gray-900 text-sm">
                                                @if(is_array($value))
                                                    <ul class="list-disc list-inside space-y-1">
                                                        @foreach($value as $item)
                                                            <li>{{ $item }}</li>
                                                        @endforeach
                                                    </ul>
                                                @elseif(is_bool($value))
                                                    {{ $value ? 'Yes' : 'No' }}
                                                @else
                                                    {{ $value }}
                                                @endif
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        @else
                            <p class="text-gray-500 text-sm">No application data available.</p>
                        @endif
                    </div>
                </div>

                <!-- Timeline -->
                <div class="bg-white shadow rounded-lg">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h3 class="text-lg font-medium text-gray-900">Timeline</h3>
                    </div>
                    <div class="px-6 py-4">
                        <div class="flow-root">
                            <ul class="-mb-8">
                                <!-- Request Submitted -->
                                <li>
                                    <div class="relative pb-8">
                                        <span class="absolute top-4 left-4 -ml-px h-full w-0.5 bg-gray-200"></span>
                                        <div class="relative flex space-x-3">
                                            <div>
                                                <span class="h-8 w-8 rounded-full bg-blue-500 flex items-center justify-center ring-8 ring-white">
                                                    <svg class="h-5 w-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"/>
                                                    </svg>
                                                </span>
                                            </div>
                                            <div class="min-w-0 flex-1 pt-1.5 flex justify-between space-x-4">
                                                <div>
                                                    <p class="text-sm text-gray-500">Adoption request submitted</p>
                                                </div>
                                                <div class="text-right text-sm whitespace-nowrap text-gray-500">
                                                    {{ $adoption->requested_at->format('M d, Y g:i A') }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>

                                <!-- Approval -->
                                @if($adoption->approved_at)
                                    <li>
                                        <div class="relative pb-8">
                                            @if($adoption->completed_at || $adoption->rejected_at)
                                                <span class="absolute top-4 left-4 -ml-px h-full w-0.5 bg-gray-200"></span>
                                            @endif
                                            <div class="relative flex space-x-3">
                                                <div>
                                                    <span class="h-8 w-8 rounded-full bg-green-500 flex items-center justify-center ring-8 ring-white">
                                                        <svg class="h-5 w-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                                                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                                        </svg>
                                                    </span>
                                                </div>
                                                <div class="min-w-0 flex-1 pt-1.5 flex justify-between space-x-4">
                                                    <div>
                                                        <p class="text-sm text-gray-500">Adoption request approved</p>
                                                    </div>
                                                    <div class="text-right text-sm whitespace-nowrap text-gray-500">
                                                        {{ $adoption->approved_at->format('M d, Y g:i A') }}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                @endif

                                <!-- Completion -->
                                @if($adoption->completed_at)
                                    <li>
                                        <div class="relative">
                                            <div class="relative flex space-x-3">
                                                <div>
                                                    <span class="h-8 w-8 rounded-full bg-blue-500 flex items-center justify-center ring-8 ring-white">
                                                        <svg class="h-5 w-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                                                            <path d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z"/>
                                                        </svg>
                                                    </span>
                                                </div>
                                                <div class="min-w-0 flex-1 pt-1.5 flex justify-between space-x-4">
                                                    <div>
                                                        <p class="text-sm text-gray-500">Adoption completed</p>
                                                        @if($adoption->final_fee)
                                                            <p class="text-sm text-gray-400">Final fee: ${{ number_format($adoption->final_fee, 2) }}</p>
                                                        @endif
                                                    </div>
                                                    <div class="text-right text-sm whitespace-nowrap text-gray-500">
                                                        {{ $adoption->completed_at->format('M d, Y g:i A') }}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                @endif

                                <!-- Rejection -->
                                @if($adoption->rejected_at)
                                    <li>
                                        <div class="relative">
                                            <div class="relative flex space-x-3">
                                                <div>
                                                    <span class="h-8 w-8 rounded-full bg-red-500 flex items-center justify-center ring-8 ring-white">
                                                        <svg class="h-5 w-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                                                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/>
                                                        </svg>
                                                    </span>
                                                </div>
                                                <div class="min-w-0 flex-1 pt-1.5 flex justify-between space-x-4">
                                                    <div>
                                                        <p class="text-sm text-gray-500">Adoption request rejected</p>
                                                        @if($adoption->rejection_reason)
                                                            <p class="text-sm text-gray-400">{{ $adoption->rejection_reason }}</p>
                                                        @endif
                                                    </div>
                                                    <div class="text-right text-sm whitespace-nowrap text-gray-500">
                                                        {{ $adoption->rejected_at->format('M d, Y g:i A') }}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="space-y-6">
                <!-- Quick Actions -->
                <div class="bg-white shadow rounded-lg">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h3 class="text-lg font-medium text-gray-900">Quick Actions</h3>
                    </div>
                    <div class="px-6 py-4 space-y-3">
                        @if($adoption->status === 'pending')
                            <button onclick="approveAdoption()" class="w-full inline-flex justify-center items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-green-600 hover:bg-green-700">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                                Approve Request
                            </button>
                            <button onclick="rejectAdoption()" class="w-full inline-flex justify-center items-center px-4 py-2 border border-red-300 rounded-md shadow-sm text-sm font-medium text-red-700 bg-white hover:bg-red-50">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                                Reject Request
                            </button>
                        @elseif($adoption->status === 'approved')
                            <button onclick="completeAdoption()" class="w-full inline-flex justify-center items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                Mark Complete
                            </button>
                        @endif

                        @if(in_array($adoption->status, ['pending', 'approved']))
                            <form method="POST" action="{{ route('admin.adoptions.cancel', $adoption) }}" class="w-full">
                                @csrf
                                <button type="submit" onclick="return confirm('Are you sure you want to cancel this adoption?')" class="w-full inline-flex justify-center items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                                    Cancel Adoption
                                </button>
                            </form>
                        @endif
                    </div>
                </div>

                <!-- Request Details -->
                <div class="bg-white shadow rounded-lg">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h3 class="text-lg font-medium text-gray-900">Request Details</h3>
                    </div>
                    <div class="px-6 py-4">
                        <dl class="space-y-3">
                            <div class="flex justify-between text-sm">
                                <dt class="text-gray-500">Reference Number:</dt>
                                <dd class="text-gray-900 font-medium">{{ $adoption->reference_number ?? 'ADO-' . str_pad($adoption->id, 6, '0', STR_PAD_LEFT) }}</dd>
                            </div>
                            <div class="flex justify-between text-sm">
                                <dt class="text-gray-500">Request ID:</dt>
                                <dd class="text-gray-900 font-medium">{{ $adoption->id }}</dd>
                            </div>
                            <div class="flex justify-between text-sm">
                                <dt class="text-gray-500">Status:</dt>
                                <dd class="text-gray-900 font-medium">{{ ucfirst($adoption->status) }}</dd>
                            </div>
                            <div class="flex justify-between text-sm">
                                <dt class="text-gray-500">Submitted:</dt>
                                <dd class="text-gray-900 font-medium">{{ $adoption->requested_at->format('M d, Y') }}</dd>
                            </div>
                            @if($adoption->approved_at)
                                <div class="flex justify-between text-sm">
                                    <dt class="text-gray-500">Approved:</dt>
                                    <dd class="text-gray-900 font-medium">{{ $adoption->approved_at->format('M d, Y') }}</dd>
                                </div>
                            @endif
                            @if($adoption->completed_at)
                                <div class="flex justify-between text-sm">
                                    <dt class="text-gray-500">Completed:</dt>
                                    <dd class="text-gray-900 font-medium">{{ $adoption->completed_at->format('M d, Y') }}</dd>
                                </div>
                            @endif
                            @if($adoption->final_fee)
                                <div class="flex justify-between text-sm">
                                    <dt class="text-gray-500">Final Fee:</dt>
                                    <dd class="text-gray-900 font-medium">${{ number_format($adoption->final_fee, 2) }}</dd>
                                </div>
                            @endif
                        </dl>
                    </div>
                </div>

                <!-- Admin Notes -->
                <div class="bg-white shadow rounded-lg">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h3 class="text-lg font-medium text-gray-900">Admin Notes</h3>
                    </div>
                    <div class="px-6 py-4">
                        <form method="POST" action="{{ route('admin.adoptions.update-notes', $adoption) }}">
                            @csrf
                            <textarea name="admin_notes" rows="4" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500" placeholder="Add internal notes about this adoption...">{{ $adoption->admin_notes }}</textarea>
                            <button type="submit" class="mt-3 w-full inline-flex justify-center items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                                Update Notes
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Action Modals (same as in index.blade.php) -->
<!-- Approve Modal -->
<div id="approveModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50">
    <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
        <div class="mt-3">
            <h3 class="text-lg font-medium text-gray-900 mb-4">Approve Adoption Request</h3>
            <form method="POST" action="{{ route('admin.adoptions.approve', $adoption) }}">
                @csrf
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Admin Notes (Optional)</label>
                    <textarea name="admin_notes" rows="3" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500" placeholder="Add any notes about this approval..."></textarea>
                </div>
                <div class="flex justify-end space-x-3">
                    <button type="button" onclick="closeModal('approveModal')" class="px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-50">
                        Cancel
                    </button>
                    <button type="submit" class="px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-green-600 hover:bg-green-700">
                        Approve Adoption
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Reject Modal -->
<div id="rejectModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50">
    <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
        <div class="mt-3">
            <h3 class="text-lg font-medium text-gray-900 mb-4">Reject Adoption Request</h3>
            <form method="POST" action="{{ route('admin.adoptions.reject', $adoption) }}">
                @csrf
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Rejection Reason *</label>
                    <textarea name="rejection_reason" required rows="4" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500" placeholder="Please provide a reason for rejection..."></textarea>
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Admin Notes (Optional)</label>
                    <textarea name="admin_notes" rows="3" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500" placeholder="Add any internal notes..."></textarea>
                </div>
                <div class="flex justify-end space-x-3">
                    <button type="button" onclick="closeModal('rejectModal')" class="px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-50">
                        Cancel
                    </button>
                    <button type="submit" class="px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-red-600 hover:bg-red-700">
                        Reject Adoption
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Complete Modal -->
<div id="completeModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50">
    <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
        <div class="mt-3">
            <h3 class="text-lg font-medium text-gray-900 mb-4">Complete Adoption</h3>
            <form method="POST" action="{{ route('admin.adoptions.complete', $adoption) }}">
                @csrf
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Final Adoption Fee</label>
                    <div class="relative">
                        <span class="absolute left-3 top-2 text-gray-500">$</span>
                        <input type="number" name="final_fee" value="{{ $adoption->pet->adoption_fee }}" step="0.01" min="0" class="w-full pl-8 pr-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                    </div>
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Admin Notes (Optional)</label>
                    <textarea name="admin_notes" rows="3" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500" placeholder="Add any completion notes..."></textarea>
                </div>
                <div class="flex justify-end space-x-3">
                    <button type="button" onclick="closeModal('completeModal')" class="px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-50">
                        Cancel
                    </button>
                    <button type="submit" class="px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700">
                        Complete Adoption
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
// Modal functions
function approveAdoption() {
    document.getElementById('approveModal').classList.remove('hidden');
}

function rejectAdoption() {
    document.getElementById('rejectModal').classList.remove('hidden');
}

function completeAdoption() {
    document.getElementById('completeModal').classList.remove('hidden');
}

function closeModal(modalId) {
    document.getElementById(modalId).classList.add('hidden');
}

// Close modal when clicking outside
document.addEventListener('click', function(e) {
    if (e.target.classList.contains('fixed')) {
        e.target.classList.add('hidden');
    }
});
</script>
@endsection