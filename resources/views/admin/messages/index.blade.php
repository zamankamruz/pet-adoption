<?php
// File: index.blade.php
// Path: /resources/views/admin/messages/index.blade.php
?>

@extends('layouts.admin')

@section('title', 'Messages Management')

@section('content')
<div class="p-6">
    <!-- Header -->
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Messages Management</h1>
            <p class="text-gray-600">Manage all user messages and conversations</p>
        </div>
        <div class="flex space-x-3">
            <a href="{{ route('admin.messages.conversations') }}" 
               class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors">
                <i class="fas fa-comments mr-2"></i>View Conversations
            </a>
            <button onclick="exportMessages()" 
                    class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition-colors">
                <i class="fas fa-download mr-2"></i>Export
            </button>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-5 gap-6 mb-6">
        <div class="bg-white rounded-lg shadow-sm border p-4">
            <div class="flex items-center">
                <div class="flex-1">
                    <p class="text-sm font-medium text-gray-600">Total Messages</p>
                    <p class="text-2xl font-bold text-gray-900">{{ number_format($stats['total']) }}</p>
                </div>
                <div class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center">
                    <i class="fas fa-envelope text-blue-600"></i>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-sm border p-4">
            <div class="flex items-center">
                <div class="flex-1">
                    <p class="text-sm font-medium text-gray-600">Unread</p>
                    <p class="text-2xl font-bold text-red-600">{{ number_format($stats['unread']) }}</p>
                </div>
                <div class="w-8 h-8 bg-red-100 rounded-lg flex items-center justify-center">
                    <i class="fas fa-envelope-open text-red-600"></i>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-sm border p-4">
            <div class="flex items-center">
                <div class="flex-1">
                    <p class="text-sm font-medium text-gray-600">Today</p>
                    <p class="text-2xl font-bold text-green-600">{{ number_format($stats['today']) }}</p>
                </div>
                <div class="w-8 h-8 bg-green-100 rounded-lg flex items-center justify-center">
                    <i class="fas fa-calendar-day text-green-600"></i>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-sm border p-4">
            <div class="flex items-center">
                <div class="flex-1">
                    <p class="text-sm font-medium text-gray-600">This Week</p>
                    <p class="text-2xl font-bold text-blue-600">{{ number_format($stats['this_week']) }}</p>
                </div>
                <div class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center">
                    <i class="fas fa-calendar-week text-blue-600"></i>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-sm border p-4">
            <div class="flex items-center">
                <div class="flex-1">
                    <p class="text-sm font-medium text-gray-600">This Month</p>
                    <p class="text-2xl font-bold text-purple-600">{{ number_format($stats['this_month']) }}</p>
                </div>
                <div class="w-8 h-8 bg-purple-100 rounded-lg flex items-center justify-center">
                    <i class="fas fa-calendar-alt text-purple-600"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Filters -->
    <div class="bg-white rounded-lg shadow-sm border mb-6">
        <div class="p-4 border-b border-gray-200">
            <h3 class="text-lg font-medium text-gray-900">Filters</h3>
        </div>
        <div class="p-4">
            <form method="GET" action="{{ route('admin.messages.index') }}" class="grid grid-cols-1 md:grid-cols-6 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Search</label>
                    <input type="text" name="search" value="{{ request('search') }}" 
                           placeholder="Subject, message, user..."
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">From User</label>
                    <select name="sender_id" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="">All Senders</option>
                        @foreach($senders as $sender)
                            <option value="{{ $sender->id }}" {{ request('sender_id') == $sender->id ? 'selected' : '' }}>
                                {{ $sender->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">To User</label>
                    <select name="receiver_id" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="">All Recipients</option>
                        @foreach($receivers as $receiver)
                            <option value="{{ $receiver->id }}" {{ request('receiver_id') == $receiver->id ? 'selected' : '' }}>
                                {{ $receiver->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                    <select name="is_read" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="">All Status</option>
                        <option value="1" {{ request('is_read') === '1' ? 'selected' : '' }}>Read</option>
                        <option value="0" {{ request('is_read') === '0' ? 'selected' : '' }}>Unread</option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Date From</label>
                    <input type="date" name="date_from" value="{{ request('date_from') }}" 
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Date To</label>
                    <input type="date" name="date_to" value="{{ request('date_to') }}" 
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <div class="md:col-span-6 flex justify-between">
                    <div class="flex space-x-2">
                        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors">
                            <i class="fas fa-filter mr-2"></i>Apply Filters
                        </button>
                        <a href="{{ route('admin.messages.index') }}" 
                           class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600 transition-colors">
                            <i class="fas fa-times mr-2"></i>Clear
                        </a>
                    </div>
                    <div class="flex space-x-2">
                        <select name="sort" onchange="this.form.submit()" 
                                class="px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="latest" {{ request('sort') === 'latest' ? 'selected' : '' }}>Latest First</option>
                            <option value="oldest" {{ request('sort') === 'oldest' ? 'selected' : '' }}>Oldest First</option>
                            <option value="sender" {{ request('sort') === 'sender' ? 'selected' : '' }}>By Sender</option>
                            <option value="unread" {{ request('sort') === 'unread' ? 'selected' : '' }}>Unread First</option>
                        </select>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Messages Table -->
    <div class="bg-white rounded-lg shadow-sm border">
        <div class="p-4 border-b border-gray-200">
            <div class="flex justify-between items-center">
                <h3 class="text-lg font-medium text-gray-900">
                    Messages ({{ $messages->total() }})
                </h3>
                <div class="flex items-center space-x-2">
                    <button onclick="toggleBulkActions()" 
                            class="text-sm text-gray-600 hover:text-gray-900">
                        <i class="fas fa-check-square mr-1"></i>Bulk Actions
                    </button>
                </div>
            </div>
        </div>

        <!-- Bulk Actions Bar (hidden by default) -->
        <div id="bulkActionsBar" class="hidden bg-gray-50 p-4 border-b border-gray-200">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-4">
                    <span class="text-sm text-gray-600">
                        <span id="selectedCount">0</span> messages selected
                    </span>
                    <div class="flex space-x-2">
                        <button onclick="bulkAction('mark_read')" 
                                class="text-sm bg-green-600 text-white px-3 py-1 rounded hover:bg-green-700">
                            Mark as Read
                        </button>
                        <button onclick="bulkAction('mark_unread')" 
                                class="text-sm bg-yellow-600 text-white px-3 py-1 rounded hover:bg-yellow-700">
                            Mark as Unread
                        </button>
                        <button onclick="bulkAction('delete')" 
                                class="text-sm bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700">
                            Delete
                        </button>
                    </div>
                </div>
                <button onclick="toggleBulkActions()" class="text-gray-400 hover:text-gray-600">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="w-8 px-4 py-3">
                            <input type="checkbox" id="selectAll" onchange="toggleAllMessages(this)" 
                                   class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                        </th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">From</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">To</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Subject</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Pet</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Date</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($messages as $message)
                        <tr class="hover:bg-gray-50 {{ !$message->is_read ? 'bg-blue-50' : '' }}">
                            <td class="px-4 py-3">
                                <input type="checkbox" name="message_ids[]" value="{{ $message->id }}" 
                                       class="message-checkbox rounded border-gray-300 text-blue-600 focus:ring-blue-500"
                                       onchange="updateSelectedCount()">
                            </td>
                            <td class="px-4 py-3">
                                @if($message->is_read)
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                        <i class="fas fa-envelope-open mr-1"></i>Read
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                        <i class="fas fa-envelope mr-1"></i>Unread
                                    </span>
                                @endif
                            </td>
                            <td class="px-4 py-3">
                                <div class="text-sm font-medium text-gray-900">{{ $message->sender->name }}</div>
                                <div class="text-sm text-gray-500">{{ $message->sender->email }}</div>
                            </td>
                            <td class="px-4 py-3">
                                <div class="text-sm font-medium text-gray-900">{{ $message->receiver->name }}</div>
                                <div class="text-sm text-gray-500">{{ $message->receiver->email }}</div>
                            </td>
                            <td class="px-4 py-3">
                                <div class="text-sm font-medium text-gray-900">
                                    {{ $message->subject ?: 'No Subject' }}
                                </div>
                                <div class="text-sm text-gray-500">
                                    {{ Str::limit(strip_tags($message->body), 50) }}
                                </div>
                            </td>
                            <td class="px-4 py-3">
                                @if($message->pet)
                                    <a href="{{ route('admin.pets.show', $message->pet) }}" 
                                       class="text-sm text-blue-600 hover:text-blue-900">
                                        {{ $message->pet->name }}
                                    </a>
                                @else
                                    <span class="text-sm text-gray-400">-</span>
                                @endif
                            </td>
                            <td class="px-4 py-3">
                                <div class="text-sm text-gray-900">
                                    {{ $message->created_at->format('M d, Y') }}
                                </div>
                                <div class="text-sm text-gray-500">
                                    {{ $message->created_at->format('H:i') }}
                                </div>
                            </td>
                            <td class="px-4 py-3">
                                <div class="flex items-center space-x-2">
                                    <a href="{{ route('admin.messages.show', $message) }}" 
                                       class="text-blue-600 hover:text-blue-900 text-sm">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    @if(!$message->is_read)
                                        <button onclick="markAsRead({{ $message->id }})" 
                                                class="text-green-600 hover:text-green-900 text-sm" 
                                                title="Mark as Read">
                                            <i class="fas fa-check"></i>
                                        </button>
                                    @else
                                        <button onclick="markAsUnread({{ $message->id }})" 
                                                class="text-yellow-600 hover:text-yellow-900 text-sm" 
                                                title="Mark as Unread">
                                            <i class="fas fa-undo"></i>
                                        </button>
                                    @endif
                                    <button onclick="deleteMessage({{ $message->id }})" 
                                            class="text-red-600 hover:text-red-900 text-sm" 
                                            title="Delete">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="px-4 py-12 text-center text-gray-500">
                                <i class="fas fa-envelope text-4xl text-gray-300 mb-4"></i>
                                <p class="text-lg font-medium mb-2">No messages found</p>
                                <p>Try adjusting your filters to see more results.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($messages->hasPages())
            <div class="px-4 py-3 border-t border-gray-200">
                {{ $messages->withQueryString()->links() }}
            </div>
        @endif
    </div>
</div>

<script>
let bulkActionsVisible = false;

function toggleBulkActions() {
    bulkActionsVisible = !bulkActionsVisible;
    const bar = document.getElementById('bulkActionsBar');
    
    if (bulkActionsVisible) {
        bar.classList.remove('hidden');
    } else {
        bar.classList.add('hidden');
        document.getElementById('selectAll').checked = false;
        document.querySelectorAll('.message-checkbox').forEach(cb => cb.checked = false);
        updateSelectedCount();
    }
}

function toggleAllMessages(selectAllCheckbox) {
    const checkboxes = document.querySelectorAll('.message-checkbox');
    checkboxes.forEach(checkbox => {
        checkbox.checked = selectAllCheckbox.checked;
    });
    updateSelectedCount();
}

function updateSelectedCount() {
    const selectedCheckboxes = document.querySelectorAll('.message-checkbox:checked');
    document.getElementById('selectedCount').textContent = selectedCheckboxes.length;
    
    // Update select all checkbox state
    const allCheckboxes = document.querySelectorAll('.message-checkbox');
    const selectAllCheckbox = document.getElementById('selectAll');
    
    if (selectedCheckboxes.length === 0) {
        selectAllCheckbox.indeterminate = false;
        selectAllCheckbox.checked = false;
    } else if (selectedCheckboxes.length === allCheckboxes.length) {
        selectAllCheckbox.indeterminate = false;
        selectAllCheckbox.checked = true;
    } else {
        selectAllCheckbox.indeterminate = true;
    }
}

function bulkAction(action) {
    const selectedMessages = Array.from(document.querySelectorAll('.message-checkbox:checked'))
        .map(cb => cb.value);
    
    if (selectedMessages.length === 0) {
        alert('Please select at least one message.');
        return;
    }
    
    let actionText = '';
    switch(action) {
        case 'delete':
            actionText = 'delete';
            break;
        case 'mark_read':
            actionText = 'mark as read';
            break;
        case 'mark_unread':
            actionText = 'mark as unread';
            break;
    }
    
    if (action === 'delete' && !confirm(`Are you sure you want to ${actionText} ${selectedMessages.length} message(s)?`)) {
        return;
    }
    
    const formData = new FormData();
    formData.append('_token', document.querySelector('meta[name="csrf-token"]').content);
    formData.append('_method', 'POST');
    formData.append('action', action);
    selectedMessages.forEach(id => formData.append('message_ids[]', id));
    
    fetch('{{ route("admin.messages.bulk-action") }}', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.message) {
            alert(data.message);
            location.reload();
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('An error occurred. Please try again.');
    });
}

function markAsRead(messageId) {
    fetch(`/admin/messages/${messageId}/mark-read`, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            'Content-Type': 'application/json',
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.message) {
            location.reload();
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('An error occurred. Please try again.');
    });
}

function markAsUnread(messageId) {
    fetch(`/admin/messages/${messageId}/mark-unread`, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            'Content-Type': 'application/json',
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.message) {
            location.reload();
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('An error occurred. Please try again.');
    });
}

function deleteMessage(messageId) {
    if (!confirm('Are you sure you want to delete this message?')) {
        return;
    }
    
    fetch(`/admin/messages/${messageId}`, {
        method: 'DELETE',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            'Content-Type': 'application/json',
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.message) {
            location.reload();
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('An error occurred. Please try again.');
    });
}

function exportMessages() {
    const params = new URLSearchParams(window.location.search);
    params.append('export', '1');
    window.location.href = '{{ route("admin.messages.export") }}?' + params.toString();
}
</script>
@endsection