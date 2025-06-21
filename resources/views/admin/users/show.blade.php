<?php
// File: show.blade.php
// Path: /resources/views/admin/users/show.blade.php
?>

@extends('layouts.admin')

@section('title', 'User Details - ' . $user->name)

@section('content')
<div class="min-h-screen bg-gray-50">
    <!-- Header -->
    <div class="bg-white shadow">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">{{ $user->name }}</h1>
                    <p class="mt-1 text-sm text-gray-600">User ID: {{ $user->id }} • Member since {{ $user->created_at->format('M d, Y') }}</p>
                </div>
                <div class="flex space-x-3">
                    @if(!$user->is_verified)
                        <form method="POST" action="{{ route('admin.users.verify', $user) }}" class="inline">
                            @csrf
                            <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-green-600 hover:bg-green-700">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                Verify User
                            </button>
                        </form>
                    @endif
                    
                    @if($user->is_active)
                        <form method="POST" action="{{ route('admin.users.ban', $user) }}" class="inline">
                            @csrf
                            <button type="submit" onclick="return confirm('Are you sure you want to ban this user?')" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-red-600 hover:bg-red-700">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728L5.636 5.636m12.728 12.728L18.364 5.636M5.636 18.364l12.728-12.728"/>
                                </svg>
                                Ban User
                            </button>
                        </form>
                    @else
                        <form method="POST" action="{{ route('admin.users.unban', $user) }}" class="inline">
                            @csrf
                            <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-green-600 hover:bg-green-700">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                Unban User
                            </button>
                        </form>
                    @endif

                    <form method="POST" action="{{ route('admin.users.impersonate', $user) }}" class="inline">
                        @csrf
                        <button type="submit" onclick="return confirm('Do you want to impersonate this user?')" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"/>
                            </svg>
                            Impersonate
                        </button>
                    </form>

                    <a href="{{ route('admin.users.edit', $user) }}" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                        </svg>
                        Edit User
                    </a>

                    <a href="{{ route('admin.users.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                        </svg>
                        Back to Users
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        <!-- Status Badges -->
        <div class="flex items-center space-x-3 mb-6">
            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium
                {{ $user->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                {{ $user->is_active ? 'Active' : 'Banned' }}
            </span>
            
            @if($user->is_verified)
                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                    </svg>
                    Verified
                </span>
            @else
                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-yellow-100 text-yellow-800">
                    Unverified
                </span>
            @endif
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Main Content -->
            <div class="lg:col-span-2 space-y-6">
                <!-- User Profile Information -->
                <div class="bg-white shadow rounded-lg">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h3 class="text-lg font-medium text-gray-900">Profile Information</h3>
                    </div>
                    <div class="px-6 py-4">
                        <div class="flex items-center space-x-6 mb-6">
                            <img class="h-20 w-20 rounded-full object-cover" src="{{ $user->avatar_url }}" alt="{{ $user->name }}">
                            <div>
                                <h4 class="text-xl font-semibold text-gray-900">{{ $user->name }}</h4>
                                <p class="text-gray-600">{{ $user->email }}</p>
                                @if($user->phone)
                                    <p class="text-gray-600">{{ $user->phone }}</p>
                                @endif
                            </div>
                        </div>

                        @if($user->bio)
                            <div class="mb-4">
                                <h5 class="text-sm font-medium text-gray-700 mb-2">Bio</h5>
                                <p class="text-gray-600">{{ $user->bio }}</p>
                            </div>
                        @endif

                        @if($user->address || $user->city || $user->state)
                            <div>
                                <h5 class="text-sm font-medium text-gray-700 mb-2">Address</h5>
                                <div class="text-gray-600">
                                    @if($user->address)
                                        <p>{{ $user->address }}</p>
                                    @endif
                                    @if($user->city || $user->state)
                                        <p>
                                            {{ $user->city }}{{ $user->city && $user->state ? ', ' : '' }}{{ $user->state }}
                                            {{ $user->zip_code ? ' ' . $user->zip_code : '' }}
                                        </p>
                                    @endif
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Recent Activity -->
                @if($recentActivity->count() > 0)
                    <div class="bg-white shadow rounded-lg">
                        <div class="px-6 py-4 border-b border-gray-200">
                            <h3 class="text-lg font-medium text-gray-900">Recent Activity</h3>
                        </div>
                        <div class="divide-y divide-gray-200">
                            @foreach($recentActivity as $activity)
                                <div class="px-6 py-4">
                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center space-x-3">
                                            <div class="flex-shrink-0">
                                                @if($activity->type === 'adoption_request')
                                                    <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center">
                                                        <svg class="w-4 h-4 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                                            <path d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z"/>
                                                        </svg>
                                                    </div>
                                                @else
                                                    <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center">
                                                        <svg class="w-4 h-4 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                                            <path d="M10 12a2 2 0 100-4 2 2 0 000 4z"/>
                                                            <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"/>
                                                        </svg>
                                                    </div>
                                                @endif
                                            </div>
                                            <div>
                                                <p class="text-sm font-medium text-gray-900">{{ $activity->description }}</p>
                                                <p class="text-sm text-gray-500">{{ $activity->date->diffForHumans() }}</p>
                                            </div>
                                        </div>
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                            {{ $activity->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : 
                                               ($activity->status === 'completed' ? 'bg-green-100 text-green-800' : 
                                               ($activity->status === 'available' ? 'bg-blue-100 text-blue-800' : 'bg-gray-100 text-gray-800')) }}">
                                            {{ ucfirst($activity->status) }}
                                        </span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                <!-- User's Pets -->
                @if($user->pets->count() > 0)
                    <div class="bg-white shadow rounded-lg">
                        <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
                            <h3 class="text-lg font-medium text-gray-900">Listed Pets ({{ $user->pets->count() }})</h3>
                            <a href="{{ route('admin.users.pets', $user) }}" class="text-blue-600 hover:text-blue-900 text-sm font-medium">View All</a>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 p-6">
                            @foreach($user->pets->take(4) as $pet)
                                <div class="flex items-center space-x-4 p-4 border border-gray-200 rounded-lg">
                                    <img src="{{ $pet->main_image_url }}" alt="{{ $pet->name }}" class="w-16 h-16 rounded-lg object-cover">
                                    <div class="flex-1 min-w-0">
                                        <p class="text-sm font-medium text-gray-900">{{ $pet->name }}</p>
                                        <p class="text-sm text-gray-500">{{ $pet->breed->name }}</p>
                                        <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium
                                            {{ $pet->status === 'available' ? 'bg-green-100 text-green-800' : 
                                               ($pet->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : 'bg-gray-100 text-gray-800') }}">
                                            {{ ucfirst($pet->status) }}
                                        </span>
                                    </div>
                                    <a href="{{ route('admin.pets.show', $pet) }}" class="text-blue-600 hover:text-blue-900 text-sm">View</a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                <!-- Adoption Requests -->
                @if($user->adoptionRequests->count() > 0)
                    <div class="bg-white shadow rounded-lg">
                        <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
                            <h3 class="text-lg font-medium text-gray-900">Adoption Requests ({{ $user->adoptionRequests->count() }})</h3>
                            <a href="{{ route('admin.users.adoptions', $user) }}" class="text-blue-600 hover:text-blue-900 text-sm font-medium">View All</a>
                        </div>
                        <div class="divide-y divide-gray-200">
                            @foreach($user->adoptionRequests->take(5) as $adoption)
                                <div class="px-6 py-4">
                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center space-x-3">
                                            <img src="{{ $adoption->pet->main_image_url }}" alt="{{ $adoption->pet->name }}" class="w-10 h-10 rounded-lg object-cover">
                                            <div>
                                                <p class="text-sm font-medium text-gray-900">{{ $adoption->pet->name }}</p>
                                                <p class="text-sm text-gray-500">{{ $adoption->requested_at->format('M d, Y') }}</p>
                                            </div>
                                        </div>
                                        <div class="flex items-center space-x-3">
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                                {{ $adoption->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : 
                                                   ($adoption->status === 'approved' ? 'bg-green-100 text-green-800' : 
                                                   ($adoption->status === 'completed' ? 'bg-blue-100 text-blue-800' : 'bg-red-100 text-red-800')) }}">
                                                {{ ucfirst($adoption->status) }}
                                            </span>
                                            <a href="{{ route('admin.adoptions.show', $adoption) }}" class="text-blue-600 hover:text-blue-900 text-sm">View</a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>

            <!-- Sidebar -->
            <div class="space-y-6">
                <!-- User Statistics -->
                <div class="bg-white shadow rounded-lg">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h3 class="text-lg font-medium text-gray-900">User Statistics</h3>
                    </div>
                    <div class="px-6 py-4">
                        <dl class="space-y-4">
                            <div class="flex justify-between">
                                <dt class="text-sm text-gray-500">Adoption Requests:</dt>
                                <dd class="text-sm font-medium text-gray-900">{{ $stats['adoption_requests'] }}</dd>
                            </div>
                            <div class="flex justify-between">
                                <dt class="text-sm text-gray-500">Pending Adoptions:</dt>
                                <dd class="text-sm font-medium text-gray-900">{{ $stats['pending_adoptions'] }}</dd>
                            </div>
                            <div class="flex justify-between">
                                <dt class="text-sm text-gray-500">Completed Adoptions:</dt>
                                <dd class="text-sm font-medium text-gray-900">{{ $stats['completed_adoptions'] }}</dd>
                            </div>
                            <div class="flex justify-between">
                                <dt class="text-sm text-gray-500">Pets Listed:</dt>
                                <dd class="text-sm font-medium text-gray-900">{{ $stats['pets_listed'] }}</dd>
                            </div>
                            <div class="flex justify-between">
                                <dt class="text-sm text-gray-500">Active Pets:</dt>
                                <dd class="text-sm font-medium text-gray-900">{{ $stats['active_pets'] }}</dd>
                            </div>
                            <div class="flex justify-between">
                                <dt class="text-sm text-gray-500">Favorites:</dt>
                                <dd class="text-sm font-medium text-gray-900">{{ $stats['favorites'] }}</dd>
                            </div>
                            <div class="flex justify-between">
                                <dt class="text-sm text-gray-500">Rehoming Requests:</dt>
                                <dd class="text-sm font-medium text-gray-900">{{ $stats['rehoming_requests'] }}</dd>
                            </div>
                        </dl>
                    </div>
                </div>

                <!-- Account Information -->
                <div class="bg-white shadow rounded-lg">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h3 class="text-lg font-medium text-gray-900">Account Information</h3>
                    </div>
                    <div class="px-6 py-4">
                        <dl class="space-y-3">
                            <div class="flex justify-between text-sm">
                                <dt class="text-gray-500">User ID:</dt>
                                <dd class="text-gray-900 font-medium">{{ $user->id }}</dd>
                            </div>
                            <div class="flex justify-between text-sm">
                                <dt class="text-gray-500">Email Verified:</dt>
                                <dd class="text-gray-900 font-medium">
                                    {{ $user->email_verified_at ? $user->email_verified_at->format('M d, Y') : 'No' }}
                                </dd>
                            </div>
                            <div class="flex justify-between text-sm">
                                <dt class="text-gray-500">Joined:</dt>
                                <dd class="text-gray-900 font-medium">{{ $user->created_at->format('M d, Y') }}</dd>
                            </div>
                            <div class="flex justify-between text-sm">
                                <dt class="text-gray-500">Last Login:</dt>
                                <dd class="text-gray-900 font-medium">
                                    {{ $user->last_login_at ? $user->last_login_at->diffForHumans() : 'Never' }}
                                </dd>
                            </div>
                            <div class="flex justify-between text-sm">
                                <dt class="text-gray-500">Last Updated:</dt>
                                <dd class="text-gray-900 font-medium">{{ $user->updated_at->diffForHumans() }}</dd>
                            </div>
                        </dl>
                    </div>
                </div>

                <!-- Quick Actions -->
                <div class="bg-white shadow rounded-lg">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h3 class="text-lg font-medium text-gray-900">Quick Actions</h3>
                    </div>
                    <div class="px-6 py-4 space-y-3">
                        <a href="{{ route('admin.users.adoptions', $user) }}" class="w-full inline-flex justify-center items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                            View All Adoptions
                        </a>
                        
                        <a href="{{ route('admin.users.pets', $user) }}" class="w-full inline-flex justify-center items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                            View All Pets
                        </a>
                        
                        <button onclick="deleteUser()" class="w-full inline-flex justify-center items-center px-4 py-2 border border-red-300 rounded-md shadow-sm text-sm font-medium text-red-700 bg-white hover:bg-red-50">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                            </svg>
                            Delete User
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function deleteUser() {
    if (confirm('Are you sure you want to delete this user? This action cannot be undone.')) {
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = '{{ route("admin.users.destroy", $user) }}';
        
        const csrfToken = document.createElement('input');
        csrfToken.type = 'hidden';
        csrfToken.name = '_token';
        csrfToken.value = document.querySelector('meta[name="csrf-token"]').content;
        
        const methodField = document.createElement('input');
        methodField.type = 'hidden';
        methodField.name = '_method';
        methodField.value = 'DELETE';
        
        form.appendChild(csrfToken);
        form.appendChild(methodField);
        document.body.appendChild(form);
        form.submit();
    }
}
</script>
@endsection