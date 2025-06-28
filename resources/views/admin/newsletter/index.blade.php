<?php
// File: index.blade.php
// Path: /resources/views/admin/newsletter/index.blade.php
?>

@extends('layouts.admin')

@section('content')
<div class="container mx-auto px-4 py-6">
    <!-- Header -->
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Newsletter Subscribers</h1>
            <p class="text-gray-600">Manage your newsletter subscribers and send broadcasts</p>
        </div>
        <div class="flex space-x-3">
            <a href="{{ route('admin.newsletter.broadcast') }}" 
               class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg font-medium transition-colors duration-200">
                <i class="fas fa-bullhorn mr-2"></i>Send Broadcast
            </a>
            <a href="{{ route('admin.newsletter.create') }}" 
               class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg font-medium transition-colors duration-200">
                <i class="fas fa-plus mr-2"></i>Add Subscriber
            </a>
            <a href="{{ route('admin.newsletter.export', request()->query()) }}" 
               class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg font-medium transition-colors duration-200">
                <i class="fas fa-download mr-2"></i>Export
            </a>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-blue-100 text-blue-600">
                    <i class="fas fa-users text-xl"></i>
                </div>
                <div class="ml-4">
                    <h3 class="text-lg font-semibold text-gray-900">{{ number_format($stats['total']) }}</h3>
                    <p class="text-gray-600">Total Subscribers</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-green-100 text-green-600">
                    <i class="fas fa-check-circle text-xl"></i>
                </div>
                <div class="ml-4">
                    <h3 class="text-lg font-semibold text-gray-900">{{ number_format($stats['active']) }}</h3>
                    <p class="text-gray-600">Active Subscribers</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-red-100 text-red-600">
                    <i class="fas fa-times-circle text-xl"></i>
                </div>
                <div class="ml-4">
                    <h3 class="text-lg font-semibold text-gray-900">{{ number_format($stats['inactive']) }}</h3>
                    <p class="text-gray-600">Unsubscribed</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-purple-100 text-purple-600">
                    <i class="fas fa-calendar-day text-xl"></i>
                </div>
                <div class="ml-4">
                    <h3 class="text-lg font-semibold text-gray-900">{{ number_format($stats['today']) }}</h3>
                    <p class="text-gray-600">Today's Signups</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Filters -->
    <div class="bg-white rounded-lg shadow mb-6">
        <form method="GET" action="{{ route('admin.newsletter.index') }}" class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Search</label>
                    <input type="text" name="search" value="{{ request('search') }}" 
                           placeholder="Email or name..." 
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                    <select name="status" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <option value="">All Statuses</option>
                        <option value="active" {{ request('status') === 'active' ? 'selected' : '' }}>Active</option>
                        <option value="inactive" {{ request('status') === 'inactive' ? 'selected' : '' }}>Inactive</option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Date From</label>
                    <input type="date" name="date_from" value="{{ request('date_from') }}" 
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Date To</label>
                    <input type="date" name="date_to" value="{{ request('date_to') }}" 
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                </div>

                <div class="flex items-end">
                    <button type="submit" 
                            class="w-full bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg font-medium transition-colors duration-200">
                        <i class="fas fa-search mr-2"></i>Filter
                    </button>
                </div>
            </div>

            @if(request()->hasAny(['search', 'status', 'date_from', 'date_to']))
                <div class="mt-4">
                    <a href="{{ route('admin.newsletter.index') }}" 
                       class="text-blue-600 hover:text-blue-800 font-medium">
                        <i class="fas fa-times mr-1"></i>Clear Filters
                    </a>
                </div>
            @endif
        </form>
    </div>

    <!-- Subscribers Table -->
    <div class="bg-white rounded-lg shadow overflow-hidden">
        <div class="p-6 border-b border-gray-200">
            <div class="flex justify-between items-center">
                <h3 class="text-lg font-semibold text-gray-900">
                    Subscribers ({{ $subscribers->total() }})
                </h3>
                
                <div class="flex items-center space-x-3">
                    <select name="sort" onchange="updateSort(this.value)" 
                            class="px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-blue-500">
                        <option value="latest" {{ request('sort') === 'latest' ? 'selected' : '' }}>Latest First</option>
                        <option value="oldest" {{ request('sort') === 'oldest' ? 'selected' : '' }}>Oldest First</option>
                        <option value="email" {{ request('sort') === 'email' ? 'selected' : '' }}>Email A-Z</option>
                        <option value="name" {{ request('sort') === 'name' ? 'selected' : '' }}>Name A-Z</option>
                    </select>

                    <!-- Bulk Actions -->
                    <div class="flex items-center space-x-2">
                        <button onclick="toggleBulkActions()" 
                                class="text-gray-600 hover:text-gray-800 px-3 py-2 text-sm font-medium">
                            Bulk Actions
                        </button>
                    </div>
                </div>
            </div>

            <!-- Bulk Actions Panel -->
            <div id="bulk-actions-panel" class="hidden mt-4 p-4 bg-gray-50 rounded-lg">
                <form id="bulk-action-form" method="POST" action="{{ route('admin.newsletter.bulk') }}">
                    @csrf
                    <div class="flex items-center space-x-4">
                        <select name="action" class="px-3 py-2 border border-gray-300 rounded-lg text-sm">
                            <option value="">Select Action</option>
                            <option value="activate">Activate</option>
                            <option value="deactivate">Deactivate</option>
                            <option value="delete">Delete</option>
                        </select>
                        
                        <button type="submit" onclick="return confirmBulkAction()" 
                                class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm font-medium">
                            Apply
                        </button>
                        
                        <button type="button" onclick="selectAllSubscribers()" 
                                class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                            Select All
                        </button>
                        
                        <button type="button" onclick="deselectAllSubscribers()" 
                                class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                            Deselect All
                        </button>
                    </div>
                </form>
            </div>
        </div>

        @if($subscribers->count() > 0)
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                <input type="checkbox" id="select-all" onchange="toggleAllSubscribers()">
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Subscriber
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Status
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Subscribed Date
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($subscribers as $subscriber)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <input type="checkbox" name="subscriber_ids[]" value="{{ $subscriber->id }}" 
                                           class="subscriber-checkbox" onchange="updateBulkActions()">
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-10 w-10">
                                            <div class="h-10 w-10 rounded-full bg-gray-300 flex items-center justify-center">
                                                <i class="fas fa-envelope text-gray-600"></i>
                                            </div>
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900">
                                                {{ $subscriber->name ?: 'No Name' }}
                                            </div>
                                            <div class="text-sm text-gray-500">{{ $subscriber->email }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($subscriber->is_active)
                                        <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                                            Active
                                        </span>
                                    @else
                                        <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800">
                                            Inactive
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $subscriber->subscribed_at->format('M d, Y g:i A') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <div class="flex items-center space-x-3">
                                        <a href="{{ route('admin.newsletter.show', $subscriber) }}" 
                                           class="text-blue-600 hover:text-blue-900">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('admin.newsletter.edit', $subscriber) }}" 
                                           class="text-indigo-600 hover:text-indigo-900">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        @if($subscriber->is_active)
                                            <form method="POST" action="{{ route('admin.newsletter.deactivate', $subscriber) }}" class="inline">
                                                @csrf
                                                <button type="submit" onclick="return confirm('Deactivate this subscriber?')" 
                                                        class="text-yellow-600 hover:text-yellow-900">
                                                    <i class="fas fa-pause"></i>
                                                </button>
                                            </form>
                                        @else
                                            <form method="POST" action="{{ route('admin.newsletter.activate', $subscriber) }}" class="inline">
                                                @csrf
                                                <button type="submit" class="text-green-600 hover:text-green-900">
                                                    <i class="fas fa-play"></i>
                                                </button>
                                            </form>
                                        @endif
                                        <form method="POST" action="{{ route('admin.newsletter.destroy', $subscriber) }}" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" onclick="return confirm('Delete this subscriber permanently?')" 
                                                    class="text-red-600 hover:text-red-900">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="px-6 py-4 border-t border-gray-200">
                {{ $subscribers->withQueryString()->links() }}
            </div>
        @else
            <div class="text-center py-12">
                <i class="fas fa-envelope text-4xl text-gray-300 mb-4"></i>
                <h3 class="text-lg font-medium text-gray-900 mb-2">No subscribers found</h3>
                <p class="text-gray-500">
                    @if(request()->hasAny(['search', 'status', 'date_from', 'date_to']))
                        Try adjusting your filters to see more results.
                    @else
                        Newsletter subscribers will appear here when users sign up.
                    @endif
                </p>
            </div>
        @endif
    </div>
</div>

<script>
function updateSort(value) {
    const url = new URL(window.location);
    url.searchParams.set('sort', value);
    window.location.href = url.toString();
}

function toggleBulkActions() {
    const panel = document.getElementById('bulk-actions-panel');
    panel.classList.toggle('hidden');
}

function toggleAllSubscribers() {
    const checkboxes = document.querySelectorAll('.subscriber-checkbox');
    const selectAll = document.getElementById('select-all');
    
    checkboxes.forEach(checkbox => {
        checkbox.checked = selectAll.checked;
    });
    
    updateBulkActions();
}

function selectAllSubscribers() {
    const checkboxes = document.querySelectorAll('.subscriber-checkbox');
    const selectAll = document.getElementById('select-all');
    
    checkboxes.forEach(checkbox => {
        checkbox.checked = true;
    });
    selectAll.checked = true;
    
    updateBulkActions();
}

function deselectAllSubscribers() {
    const checkboxes = document.querySelectorAll('.subscriber-checkbox');
    const selectAll = document.getElementById('select-all');
    
    checkboxes.forEach(checkbox => {
        checkbox.checked = false;
    });
    selectAll.checked = false;
    
    updateBulkActions();
}

function updateBulkActions() {
    const checkedBoxes = document.querySelectorAll('.subscriber-checkbox:checked');
    const bulkForm = document.getElementById('bulk-action-form');
    
    // Add hidden inputs for selected IDs
    const existingInputs = bulkForm.querySelectorAll('input[name="subscriber_ids[]"]');
    existingInputs.forEach(input => input.remove());
    
    checkedBoxes.forEach(checkbox => {
        const input = document.createElement('input');
        input.type = 'hidden';
        input.name = 'subscriber_ids[]';
        input.value = checkbox.value;
        bulkForm.appendChild(input);
    });
}

function confirmBulkAction() {
    const action = document.querySelector('select[name="action"]').value;
    const checkedBoxes = document.querySelectorAll('.subscriber-checkbox:checked');
    
    if (!action) {
        alert('Please select an action');
        return false;
    }
    
    if (checkedBoxes.length === 0) {
        alert('Please select at least one subscriber');
        return false;
    }
    
    return confirm(`Are you sure you want to ${action} ${checkedBoxes.length} subscriber(s)?`);
}
</script>
@endsection