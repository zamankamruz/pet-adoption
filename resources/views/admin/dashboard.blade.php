<?php
// File: dashboard.blade.php
// Path: /resources/views/admin/dashboard.blade.php
?>

@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
<div class="min-h-screen bg-gray-50">
    <!-- Header -->
    <div class="bg-white shadow">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">Dashboard</h1>
                    <p class="mt-1 text-sm text-gray-600">Welcome back! Here's what's happening with Furry Friends.</p>
                </div>
                <div class="text-sm text-gray-500">
                    Last updated: {{ now()->format('M d, Y \a\t g:i A') }}
                </div>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        <!-- Statistics Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <!-- Total Pets -->
            <div class="bg-white overflow-hidden shadow-lg rounded-lg border-l-4 border-blue-500">
                <div class="p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.5 12C3.12 12 2 13.12 2 14.5S3.12 17 4.5 17 7 15.88 7 14.5 5.88 12 4.5 12M19.5 12C18.12 12 17 13.12 17 14.5S18.12 17 19.5 17 22 15.88 22 14.5 20.88 12 19.5 12M12 3.5C10.62 3.5 9.5 4.62 9.5 6S10.62 8.5 12 8.5 14.5 7.38 14.5 6 13.38 3.5 12 3.5M12 20.5C10.9 20.5 10 19.6 10 18.5S10.9 16.5 12 16.5 14 17.4 14 18.5 13.1 20.5 12 20.5Z"/>
                                </svg>
                            </div>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-lg font-semibold text-gray-900">Total Pets</h3>
                            <p class="text-3xl font-bold text-blue-600">{{ number_format($stats['total_pets']) }}</p>
                            <p class="text-sm text-gray-600">{{ $stats['available_pets'] }} available</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Total Users -->
            <div class="bg-white overflow-hidden shadow-lg rounded-lg border-l-4 border-green-500">
                <div class="p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                                <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"/>
                                </svg>
                            </div>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-lg font-semibold text-gray-900">Total Users</h3>
                            <p class="text-3xl font-bold text-green-600">{{ number_format($stats['total_users']) }}</p>
                            <p class="text-sm text-gray-600">{{ $stats['verified_users'] }} verified</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pending Adoptions -->
            <div class="bg-white overflow-hidden shadow-lg rounded-lg border-l-4 border-yellow-500">
                <div class="p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="w-12 h-12 bg-yellow-100 rounded-lg flex items-center justify-center">
                                <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-lg font-semibold text-gray-900">Pending Adoptions</h3>
                            <p class="text-3xl font-bold text-yellow-600">{{ number_format($stats['pending_adoptions']) }}</p>
                            <p class="text-sm text-gray-600">Need review</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Completed Adoptions -->
            <div class="bg-white overflow-hidden shadow-lg rounded-lg border-l-4 border-purple-500">
                <div class="p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center">
                                <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                                </svg>
                            </div>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-lg font-semibold text-gray-900">Successful Adoptions</h3>
                            <p class="text-3xl font-bold text-purple-600">{{ number_format($stats['completed_adoptions']) }}</p>
                            <p class="text-sm text-gray-600">Happy families created</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-6 mb-8">
            <a href="{{ route('admin.pets.create') }}" class="bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 text-white p-6 rounded-lg shadow-lg transition-all duration-200 transform hover:scale-105">
                <div class="flex items-center">
                    <svg class="w-8 h-8 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                    </svg>
                    <div>
                        <h4 class="text-lg font-semibold">Add Pet</h4>
                        <p class="text-sm opacity-90">List new pet</p>
                    </div>
                </div>
            </a>

            <a href="{{ route('admin.adoptions.index') }}" class="bg-gradient-to-r from-green-500 to-green-600 hover:from-green-600 hover:to-green-700 text-white p-6 rounded-lg shadow-lg transition-all duration-200 transform hover:scale-105">
                <div class="flex items-center">
                    <svg class="w-8 h-8 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                    </svg>
                    <div>
                        <h4 class="text-lg font-semibold">Review Adoptions</h4>
                        <p class="text-sm opacity-90">{{ $stats['pending_adoptions'] }} pending</p>
                    </div>
                </div>
            </a>

            <a href="{{ route('admin.users.index') }}" class="bg-gradient-to-r from-yellow-500 to-yellow-600 hover:from-yellow-600 hover:to-yellow-700 text-white p-6 rounded-lg shadow-lg transition-all duration-200 transform hover:scale-105">
                <div class="flex items-center">
                    <svg class="w-8 h-8 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"/>
                    </svg>
                    <div>
                        <h4 class="text-lg font-semibold">Manage Users</h4>
                        <p class="text-sm opacity-90">View all users</p>
                    </div>
                </div>
            </a>

            <a href="{{ route('admin.contacts.index') }}" class="bg-gradient-to-r from-purple-500 to-purple-600 hover:from-purple-600 hover:to-purple-700 text-white p-6 rounded-lg shadow-lg transition-all duration-200 transform hover:scale-105">
                <div class="flex items-center">
                    <svg class="w-8 h-8 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                    <div>
                        <h4 class="text-lg font-semibold">Contact Messages</h4>
                        <p class="text-sm opacity-90">{{ $stats['pending_contacts'] }} pending</p>
                    </div>
                </div>
            </a>
        </div>

        <!-- Charts and Recent Activity -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
            <!-- Adoption Trends Chart -->
            <div class="bg-white rounded-lg shadow-lg p-6">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-xl font-semibold text-gray-900">Adoption Trends</h3>
                    <span class="text-sm text-gray-500">Last 12 months</span>
                </div>
                <canvas id="adoptionTrendsChart" height="300"></canvas>
            </div>

            <!-- Pets by Category -->
            <div class="bg-white rounded-lg shadow-lg p-6">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-xl font-semibold text-gray-900">Pets by Category</h3>
                    <a href="{{ route('admin.pets.index') }}" class="text-blue-600 hover:text-blue-800 text-sm font-medium">View All</a>
                </div>
                <div class="space-y-4">
                    @foreach($petsByCategory as $category)
                        <div class="flex justify-between items-center">
                            <span class="text-gray-600">{{ $category->category }}</span>
                            <div class="flex items-center">
                                <div class="w-32 bg-gray-200 rounded-full h-2 mr-3">
                                    <div class="bg-blue-600 h-2 rounded-full" style="width: {{ ($category->count / $stats['total_pets']) * 100 }}%"></div>
                                </div>
                                <span class="text-gray-900 font-semibold">{{ $category->count }}</span>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Recent Activity Tables -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Recent Pets -->
            <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
                    <h3 class="text-lg font-semibold text-gray-900">Recent Pets</h3>
                    <a href="{{ route('admin.pets.index') }}" class="text-blue-600 hover:text-blue-800 text-sm font-medium">View All</a>
                </div>
                <div class="divide-y divide-gray-200">
                    @forelse($recentPets as $pet)
                        <div class="p-4 hover:bg-gray-50">
                            <div class="flex items-center space-x-3">
                                <img src="{{ $pet->main_image_url }}" alt="{{ $pet->name }}" class="w-12 h-12 rounded-full object-cover">
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-medium text-gray-900 truncate">{{ $pet->name }}</p>
                                    <p class="text-sm text-gray-500">{{ $pet->breed->name }} • {{ $pet->location->city }}</p>
                                </div>
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                    {{ $pet->status === 'available' ? 'bg-green-100 text-green-800' : 
                                       ($pet->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : 'bg-gray-100 text-gray-800') }}">
                                    {{ ucfirst($pet->status) }}
                                </span>
                            </div>
                        </div>
                    @empty
                        <div class="p-4 text-center text-gray-500">No recent pets</div>
                    @endforelse
                </div>
            </div>

            <!-- Recent Adoptions -->
            <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
                    <h3 class="text-lg font-semibold text-gray-900">Pending Adoptions</h3>
                    <a href="{{ route('admin.adoptions.index') }}" class="text-blue-600 hover:text-blue-800 text-sm font-medium">View All</a>
                </div>
                <div class="divide-y divide-gray-200">
                    @forelse($recentAdoptions as $adoption)
                        <div class="p-4 hover:bg-gray-50">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center space-x-3">
                                    <div class="flex-shrink-0">
                                        <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center">
                                            <span class="text-blue-600 font-semibold text-sm">{{ substr($adoption->user->name, 0, 2) }}</span>
                                        </div>
                                    </div>
                                    <div class="min-w-0 flex-1">
                                        <p class="text-sm font-medium text-gray-900">{{ $adoption->user->name }}</p>
                                        <p class="text-sm text-gray-500">wants to adopt {{ $adoption->pet->name }}</p>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <p class="text-xs text-gray-500">{{ $adoption->requested_at->diffForHumans() }}</p>
                                    <a href="{{ route('admin.adoptions.show', $adoption) }}" class="text-blue-600 hover:text-blue-800 text-xs font-medium">Review</a>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="p-4 text-center text-gray-500">No pending adoptions</div>
                    @endforelse
                </div>
            </div>

            <!-- Recent Contacts -->
            <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
                    <h3 class="text-lg font-semibold text-gray-900">Recent Messages</h3>
                    <a href="{{ route('admin.contacts.index') }}" class="text-blue-600 hover:text-blue-800 text-sm font-medium">View All</a>
                </div>
                <div class="divide-y divide-gray-200">
                    @forelse($recentContacts as $contact)
                        <div class="p-4 hover:bg-gray-50">
                            <div class="flex items-center justify-between">
                                <div class="min-w-0 flex-1">
                                    <p class="text-sm font-medium text-gray-900">{{ $contact->name }}</p>
                                    <p class="text-sm text-gray-500 truncate">{{ $contact->subject }}</p>
                                </div>
                                <div class="text-right">
                                    <p class="text-xs text-gray-500">{{ $contact->created_at->diffForHumans() }}</p>
                                    <a href="{{ route('admin.contacts.show', $contact) }}" class="text-blue-600 hover:text-blue-800 text-xs font-medium">View</a>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="p-4 text-center text-gray-500">No recent messages</div>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- System Status -->
        <div class="mt-8 bg-white rounded-lg shadow-lg p-6">
            <h3 class="text-xl font-semibold text-gray-900 mb-4">System Status</h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="text-center">
                    <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-2">
                        <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                    </div>
                    <h4 class="text-lg font-semibold text-gray-900">System Health</h4>
                    <p class="text-sm text-green-600">All systems operational</p>
                </div>
                <div class="text-center">
                    <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-2">
                        <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4"/>
                        </svg>
                    </div>
                    <h4 class="text-lg font-semibold text-gray-900">Database</h4>
                    <p class="text-sm text-blue-600">Connected and optimized</p>
                </div>
                <div class="text-center">
                    <div class="w-16 h-16 bg-purple-100 rounded-full flex items-center justify-center mx-auto mb-2">
                        <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <h4 class="text-lg font-semibold text-gray-900">Backup Status</h4>
                    <p class="text-sm text-purple-600">Last backup: Today</p>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
// Adoption Trends Chart
const adoptionCtx = document.getElementById('adoptionTrendsChart').getContext('2d');
const adoptionData = @json($adoptionTrends);

const months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
const chartLabels = adoptionData.map(item => months[item.month - 1] + ' ' + item.year);
const chartData = adoptionData.map(item => item.count);

new Chart(adoptionCtx, {
    type: 'line',
    data: {
        labels: chartLabels,
        datasets: [{
            label: 'Completed Adoptions',
            data: chartData,
            borderColor: 'rgb(139, 92, 246)',
            backgroundColor: 'rgba(139, 92, 246, 0.1)',
            tension: 0.1,
            fill: true
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: {
                display: false
            }
        },
        scales: {
            y: {
                beginAtZero: true,
                ticks: {
                    stepSize: 1
                }
            }
        }
    }
});

// Auto-refresh data every 5 minutes
setInterval(function() {
    fetch('{{ route("admin.dashboard.data") }}')
        .then(response => response.json())
        .then(data => {
            // Update statistics cards
            document.querySelector('.text-blue-600').textContent = data.pets.total.toLocaleString();
            document.querySelector('.text-green-600').textContent = data.users.total.toLocaleString();
            document.querySelector('.text-yellow-600').textContent = data.adoptions.pending.toLocaleString();
            document.querySelector('.text-purple-600').textContent = data.adoptions.completed.toLocaleString();
        })
        .catch(error => console.error('Error refreshing data:', error));
}, 300000); // 5 minutes
</script>
@endsection