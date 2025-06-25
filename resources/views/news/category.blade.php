<?php
// File: category.blade.php
// Path: /resources/views/news/category.blade.php
?>

@extends('layouts.app')

@section('title', ucfirst($category) . ' Articles - Pet News')
@section('meta_description', 'Browse our collection of ' . $category . ' articles about pet care, health, and wellness.')

@section('content')
<!-- Category Header -->
<div class="bg-gradient-to-r from-purple-600 to-blue-600 text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="text-center">
            <!-- Breadcrumb -->
            <nav class="mb-6" aria-label="Breadcrumb">
                <ol class="flex items-center justify-center space-x-2 text-sm text-purple-100">
                    <li><a href="{{ route('home') }}" class="hover:text-white transition duration-200">Home</a></li>
                    <li><span>/</span></li>
                    <li><a href="{{ route('news.index') }}" class="hover:text-white transition duration-200">News</a></li>
                    <li><span>/</span></li>
                    <li class="text-white font-medium">{{ ucfirst($category) }}</li>
                </ol>
            </nav>

            <h1 class="text-4xl md:text-5xl font-bold mb-4">{{ ucfirst($category) }} Articles</h1>
            <p class="text-xl md:text-2xl text-purple-100 mb-8">Everything you need to know about {{ $category }}</p>
            
            <!-- Category Stats -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 max-w-2xl mx-auto">
                <div class="bg-white bg-opacity-10 backdrop-blur-sm rounded-lg p-4">
                    <div class="text-2xl font-bold">{{ number_format($categoryStats['total_articles']) }}</div>
                    <div class="text-sm text-purple-100">Total Articles</div>
                </div>
                <div class="bg-white bg-opacity-10 backdrop-blur-sm rounded-lg p-4">
                    <div class="text-2xl font-bold">{{ number_format($categoryStats['total_views']) }}</div>
                    <div class="text-sm text-purple-100">Total Views</div>
                </div>
                <div class="bg-white bg-opacity-10 backdrop-blur-sm rounded-lg p-4">
                    <div class="text-2xl font-bold">
                        {{ $categoryStats['latest_article'] ? $categoryStats['latest_article']->published_at->format('M Y') : 'N/A' }}
                    </div>
                    <div class="text-sm text-purple-100">Latest Article</div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Main Content -->
<section class="py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
            <!-- Main Articles -->
            <div class="lg:col-span-3">
                <!-- Filters -->
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 mb-8">
                    <form method="GET" action="{{ route('news.category', $category) }}" class="flex flex-wrap items-center gap-4">
                        <div class="flex-1 min-w-0">
                            <input type="text" name="search" placeholder="Search in {{ $category }} articles..." 
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500"
                                   value="{{ request('search') }}">
                        </div>
                        
                        <select name="sort" class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500">
                            <option value="latest" {{ request('sort') === 'latest' ? 'selected' : '' }}>Latest</option>
                            <option value="popular" {{ request('sort') === 'popular' ? 'selected' : '' }}>Most Popular</option>
                            <option value="title" {{ request('sort') === 'title' ? 'selected' : '' }}>Title A-Z</option>
                            <option value="oldest" {{ request('sort') === 'oldest' ? 'selected' : '' }}>Oldest</option>
                        </select>
                        
                        <button type="submit" class="px-6 py-2 bg-purple-600 hover:bg-purple-700 text-white rounded-lg transition duration-200">
                            Filter
                        </button>
                        
                        @if(request()->hasAny(['search', 'sort']))
                            <a href="{{ route('news.category', $category) }}" class="px-6 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-lg transition duration-200">
                                Reset
                            </a>
                        @endif
                    </form>
                </div>

                <!-- Results Info -->
                <div class="flex items-center justify-between mb-6">
                    <div class="text-gray-600">
                        <span class="font-medium">{{ $news->total() }}</span> articles found in 
                        <span class="font-medium text-purple-600">{{ ucfirst($category) }}</span>
                        @if(request('search'))
                            matching "<span class="font-medium">{{ request('search') }}</span>"
                        @endif
                    </div>
                    <div class="text-sm text-gray-500">
                        Showing {{ $news->firstItem() }}-{{ $news->lastItem() }} of {{ $news->total() }}
                    </div>
                </div>

                <!-- Articles Grid -->
                @if($news->count() > 0)
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        @foreach($news as $article)
                            <article class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition duration-300">
                                <div class="relative">
                                    <img src="{{ $article->featured_image_url }}" alt="{{ $article->title }}" 
                                         class="w-full h-48 object-cover">
                                    <div class="absolute top-4 right-4">
                                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-black bg-opacity-50 text-white">
                                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                            </svg>
                                            {{ number_format($article->views_count) }}
                                        </span>
                                    </div>
                                </div>
                                <div class="p-6">
                                    <h3 class="text-xl font-bold text-gray-900 mb-2 line-clamp-2">
                                        <a href="{{ route('news.show', $article->slug) }}" class="hover:text-purple-600 transition duration-200">
                                            {{ $article->title }}
                                        </a>
                                    </h3>
                                    <p class="text-gray-600 mb-4 line-clamp-3">{{ $article->excerpt }}</p>
                                    
                                    @if($article->tags && count($article->tags) > 0)
                                        <div class="flex flex-wrap gap-2 mb-4">
                                            @foreach(array_slice($article->tags, 0, 3) as $tag)
                                                <a href="{{ route('news.tag', $tag) }}" 
                                                   class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-700 hover:bg-gray-200 transition duration-200">
                                                    #{{ $tag }}
                                                </a>
                                            @endforeach
                                        </div>
                                    @endif
                                    
                                    <div class="flex items-center justify-between text-sm text-gray-500">
                                        <span class="flex items-center">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                            </svg>
                                            {{ $article->author->name }}
                                        </span>
                                        <span>{{ $article->published_at->format('M d, Y') }}</span>
                                    </div>
                                </div>
                            </article>
                        @endforeach
                    </div>

                    <!-- Pagination -->
                    @if($news->hasPages())
                        <div class="mt-12">
                            {{ $news->links() }}
                        </div>
                    @endif
                @else
                    <!-- Empty State -->
                    <div class="text-center py-12">
                        <svg class="mx-auto h-12 w-12 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                        <h3 class="text-lg font-medium text-gray-900 mb-2">No articles found</h3>
                        <p class="text-gray-600 mb-4">
                            @if(request('search'))
                                No articles found matching your search in {{ $category }}.
                            @else
                                No articles available in this category yet.
                            @endif
                        </p>
                        <div class="flex items-center justify-center space-x-3">
                            @if(request('search'))
                                <a href="{{ route('news.category', $category) }}" class="inline-flex items-center px-4 py-2 bg-purple-600 hover:bg-purple-700 text-white rounded-lg transition duration-200">
                                    View All {{ ucfirst($category) }} Articles
                                </a>
                            @endif
                            <a href="{{ route('news.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-lg transition duration-200">
                                Browse All Articles
                            </a>
                        </div>
                    </div>
                @endif
            </div>

            <!-- Sidebar -->
            <div class="lg:col-span-1">
                <!-- All Categories -->
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 mb-8">
                    <h3 class="text-lg font-bold text-gray-900 mb-4">All Categories</h3>
                    <ul class="space-y-2">
                        @foreach($allCategories as $cat => $data)
                            <li>
                                <a href="{{ route('news.category', $cat) }}" 
                                   class="flex items-center justify-between py-2 px-3 rounded-lg hover:bg-purple-50 hover:text-purple-600 transition duration-200 {{ $category === $cat ? 'bg-purple-50 text-purple-600' : 'text-gray-700' }}">
                                    <span>{{ ucfirst($cat) }}</span>
                                    <span class="text-sm bg-gray-100 text-gray-600 px-2 py-1 rounded-full">{{ $data->count }}</span>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <!-- Quick Actions -->
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 mb-8">
                    <h3 class="text-lg font-bold text-gray-900 mb-4">Quick Actions</h3>
                    <div class="space-y-3">
                        <a href="{{ route('news.index') }}" 
                           class="flex items-center px-4 py-3 bg-gray-50 hover:bg-gray-100 rounded-lg transition duration-200">
                            <svg class="w-5 h-5 mr-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                            </svg>
                            <span class="text-gray-700">All Articles</span>
                        </a>
                        <a href="{{ route('news.trending') }}" 
                           class="flex items-center px-4 py-3 bg-gray-50 hover:bg-gray-100 rounded-lg transition duration-200">
                            <svg class="w-5 h-5 mr-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>
                            </svg>
                            <span class="text-gray-700">Trending Articles</span>
                        </a>
                        <a href="{{ route('news.archive') }}" 
                           class="flex items-center px-4 py-3 bg-gray-50 hover:bg-gray-100 rounded-lg transition duration-200">
                            <svg class="w-5 h-5 mr-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"/>
                            </svg>
                            <span class="text-gray-700">Archive</span>
                        </a>
                    </div>
                </div>

                <!-- Newsletter Signup -->
                <div class="bg-purple-600 text-white rounded-lg p-6">
                    <h3 class="text-lg font-bold mb-2">Stay Updated</h3>
                    <p class="text-purple-100 text-sm mb-4">Get the latest {{ $category }} articles delivered to your inbox</p>
                    
                    <form id="category-newsletter-form">
                        <input type="email" name="email" placeholder="Enter your email" required
                               class="w-full px-3 py-2 rounded-lg border-0 text-gray-900 placeholder-gray-500 focus:ring-2 focus:ring-purple-300 mb-3">
                        <button type="submit" class="w-full px-4 py-2 bg-purple-700 hover:bg-purple-800 rounded-lg transition duration-200">
                            Subscribe
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
// Newsletter form submission
document.getElementById('category-newsletter-form').addEventListener('submit', function(e) {
    e.preventDefault();
    const email = this.querySelector('input[name="email"]').value;
    
    fetch('{{ route("news.subscribe") }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({ email: email })
    })
    .then(response => response.json())
    .then(data => {
        alert(data.message);
        this.reset();
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Something went wrong. Please try again.');
    });
});
</script>
@endsection