<?php
// File: index.blade.php
// Path: /resources/views/news/index.blade.php
?>

@extends('layouts.app')

@section('title', 'Pet News & Articles')

@section('content')
<!-- Hero Section -->
<div class="bg-gradient-to-r from-purple-600 to-blue-600 text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="text-center">
            <h1 class="text-4xl md:text-5xl font-bold mb-4">Pet News & Articles</h1>
            <p class="text-xl md:text-2xl text-purple-100 mb-8">Stay updated with the latest pet care tips, news, and stories</p>
            
            <!-- Search Bar -->
            <div class="max-w-2xl mx-auto">
                <form action="{{ route('news.search') }}" method="GET" class="flex">
                    <input type="text" name="q" placeholder="Search articles..." 
                           class="flex-1 px-4 py-3 rounded-l-lg border-0 text-gray-900 placeholder-gray-500 focus:ring-2 focus:ring-purple-500"
                           value="{{ request('search') }}">
                    <button type="submit" class="px-6 py-3 bg-purple-700 hover:bg-purple-800 rounded-r-lg transition duration-200">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Featured Articles -->
@if($featuredNews->count() > 0)
<section class="py-12 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-8">
            <h2 class="text-3xl font-bold text-gray-900 mb-4">Featured Articles</h2>
            <p class="text-lg text-gray-600">Our most popular pet care articles this month</p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @foreach($featuredNews as $article)
                <article class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition duration-300">
                    <div class="relative">
                        <img src="{{ $article->featured_image_url }}" alt="{{ $article->title }}" 
                             class="w-full h-48 object-cover">
                        <div class="absolute top-4 left-4">
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-purple-600 text-white">
                                {{ ucfirst($article->category) }}
                            </span>
                        </div>
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
    </div>
</section>
@endif

<!-- Main Content -->
<section class="py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
            <!-- Main Articles -->
            <div class="lg:col-span-3">
                <!-- Filters -->
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 mb-8">
                    <form method="GET" action="{{ route('news.index') }}" class="flex flex-wrap items-center gap-4">
                        <div class="flex-1 min-w-0">
                            <input type="text" name="search" placeholder="Search articles..." 
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500"
                                   value="{{ request('search') }}">
                        </div>
                        
                        <select name="category" class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500">
                            <option value="">All Categories</option>
                            @foreach($categories as $cat => $data)
                                <option value="{{ $cat }}" {{ request('category') === $cat ? 'selected' : '' }}>
                                    {{ ucfirst($cat) }} ({{ $data->count }})
                                </option>
                            @endforeach
                        </select>
                        
                        <select name="sort" class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500">
                            <option value="latest" {{ request('sort') === 'latest' ? 'selected' : '' }}>Latest</option>
                            <option value="popular" {{ request('sort') === 'popular' ? 'selected' : '' }}>Most Popular</option>
                            <option value="title" {{ request('sort') === 'title' ? 'selected' : '' }}>Title A-Z</option>
                            <option value="oldest" {{ request('sort') === 'oldest' ? 'selected' : '' }}>Oldest</option>
                        </select>
                        
                        <button type="submit" class="px-6 py-2 bg-purple-600 hover:bg-purple-700 text-white rounded-lg transition duration-200">
                            Filter
                        </button>
                        
                        @if(request()->hasAny(['search', 'category', 'sort', 'tag']))
                            <a href="{{ route('news.index') }}" class="px-6 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-lg transition duration-200">
                                Reset
                            </a>
                        @endif
                    </form>
                </div>

                <!-- Articles Grid -->
                @if($news->count() > 0)
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        @foreach($news as $article)
                            <article class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition duration-300">
                                <div class="relative">
                                    <img src="{{ $article->featured_image_url }}" alt="{{ $article->title }}" 
                                         class="w-full h-48 object-cover">
                                    <div class="absolute top-4 left-4">
                                        <a href="{{ route('news.category', $article->category) }}" 
                                           class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-purple-600 text-white hover:bg-purple-700 transition duration-200">
                                            {{ ucfirst($article->category) }}
                                        </a>
                                    </div>
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
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                        </svg>
                        <h3 class="text-lg font-medium text-gray-900 mb-2">No articles found</h3>
                        <p class="text-gray-600 mb-4">Try adjusting your search or filter criteria.</p>
                        <a href="{{ route('news.index') }}" class="inline-flex items-center px-4 py-2 bg-purple-600 hover:bg-purple-700 text-white rounded-lg transition duration-200">
                            View All Articles
                        </a>
                    </div>
                @endif
            </div>

            <!-- Sidebar -->
            <div class="lg:col-span-1">
                <!-- Categories -->
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 mb-8">
                    <h3 class="text-lg font-bold text-gray-900 mb-4">Categories</h3>
                    <ul class="space-y-2">
                        @foreach($categories as $category => $data)
                            <li>
                                <a href="{{ route('news.category', $category) }}" 
                                   class="flex items-center justify-between py-2 px-3 rounded-lg hover:bg-purple-50 hover:text-purple-600 transition duration-200 {{ request('category') === $category ? 'bg-purple-50 text-purple-600' : 'text-gray-700' }}">
                                    <span>{{ ucfirst($category) }}</span>
                                    <span class="text-sm bg-gray-100 text-gray-600 px-2 py-1 rounded-full">{{ $data->count }}</span>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <!-- Popular Tags -->
                @if($popularTags->count() > 0)
                    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 mb-8">
                        <h3 class="text-lg font-bold text-gray-900 mb-4">Popular Tags</h3>
                        <div class="flex flex-wrap gap-2">
                            @foreach($popularTags as $tag)
                                <a href="{{ route('news.tag', $tag) }}" 
                                   class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-gray-100 text-gray-700 hover:bg-purple-100 hover:text-purple-600 transition duration-200">
                                    #{{ $tag }}
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endif

                <!-- Recent Articles -->
                @if($recentNews->count() > 0)
                    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                        <h3 class="text-lg font-bold text-gray-900 mb-4">Recent Articles</h3>
                        <ul class="space-y-4">
                            @foreach($recentNews as $article)
                                <li class="flex space-x-3">
                                    <img src="{{ $article->featured_image_url }}" alt="{{ $article->title }}" 
                                         class="w-16 h-16 object-cover rounded-lg">
                                    <div class="flex-1 min-w-0">
                                        <h4 class="text-sm font-medium text-gray-900 line-clamp-2 mb-1">
                                            <a href="{{ route('news.show', $article->slug) }}" class="hover:text-purple-600 transition duration-200">
                                                {{ $article->title }}
                                            </a>
                                        </h4>
                                        <p class="text-xs text-gray-500">{{ $article->published_at->format('M d, Y') }}</p>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
        </div>
    </div>
</section>

<!-- Newsletter Signup -->
<section class="bg-purple-600 text-white py-12">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-3xl font-bold mb-4">Stay Updated</h2>
        <p class="text-xl text-purple-100 mb-8">Get the latest pet care tips and news delivered to your inbox</p>
        
        <form id="newsletter-form" class="max-w-md mx-auto flex">
            <input type="email" name="email" placeholder="Enter your email" required
                   class="flex-1 px-4 py-3 rounded-l-lg border-0 text-gray-900 placeholder-gray-500 focus:ring-2 focus:ring-purple-300">
            <button type="submit" class="px-6 py-3 bg-purple-700 hover:bg-purple-800 rounded-r-lg transition duration-200">
                Subscribe
            </button>
        </form>
        <p class="text-sm text-purple-200 mt-2">No spam, unsubscribe anytime</p>
    </div>
</section>

<script>
document.getElementById('newsletter-form').addEventListener('submit', function(e) {
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