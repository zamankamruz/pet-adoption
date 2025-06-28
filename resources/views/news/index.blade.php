<?php
// File: index.blade.php
// Path: /resources/views/news/index.blade.php
?>
@extends('layouts.app')
@section('title', 'Pet News & Articles')
@section('content')
<!-- Hero Section -->
<section class="bg-gradient-to-r from-blue-50 to-indigo-100 py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center">
            <h1 class="text-xl md:text-2xl font-bold text-gray-900 mb-2">Pet News & Articles</h1>
            <p class="text-sm text-gray-600 max-w-2xl mx-auto">Stay updated with the latest pet care tips, expert advice, and heartwarming stories from the pet community</p>
        </div>
    </div>
</section>
<!-- Featured Articles -->
@if($featuredNews->count() > 0)
<section class="py-6 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-lg font-bold text-gray-900">Featured Articles</h2>
            <div class="h-px bg-gradient-to-r from-blue-500 to-transparent flex-1 ml-4"></div>
        </div>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        @foreach($featuredNews as $article)
            <article class="group bg-white rounded-lg border border-gray-200 overflow-hidden hover:shadow-lg hover:border-blue-300 transition-all duration-300">
                <div class="relative overflow-hidden">
                    <img src="{{ $article->featured_image_url }}" alt="{{ $article->title }}" 
                         class="w-full h-40 object-cover group-hover:scale-105 transition-transform duration-300">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent"></div>
                    <div class="absolute top-2 left-2">
                        <span class="inline-flex items-center px-2 py-1 rounded text-xs font-medium bg-blue-600 text-white shadow-sm">
                            {{ ucfirst($article->category) }}
                        </span>
                    </div>
                    <div class="absolute top-2 right-2">
                        <span class="inline-flex items-center px-1.5 py-0.5 rounded text-xs font-medium bg-black/60 text-white backdrop-blur-sm">
                            <svg class="w-2.5 h-2.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                            </svg>
                            {{ number_format($article->views_count) }}
                        </span>
                    </div>
                    <div class="absolute bottom-2 left-2 right-2">
                        <span class="inline-flex items-center px-2 py-1 rounded text-xs font-medium bg-white/90 text-gray-800 backdrop-blur-sm">
                            <svg class="w-2.5 h-2.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            {{ ceil(str_word_count($article->content) / 200) }} min read
                        </span>
                    </div>
                </div>
                <div class="p-4">
                    <h3 class="text-sm font-bold text-gray-900 mb-2 line-clamp-2 group-hover:text-blue-600 transition-colors duration-200">
                        <a href="{{ route('news.show', $article->slug) }}">
                            {{ $article->title }}
                        </a>
                    </h3>
                    <p class="text-xs text-gray-600 mb-3 line-clamp-2">{{ $article->excerpt }}</p>
                    <div class="flex items-center justify-between text-xs text-gray-500">
                        <span class="flex items-center">
                            <div class="w-4 h-4 bg-gradient-to-r from-blue-500 to-indigo-500 rounded-full mr-1.5"></div>
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
<section class="py-6 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-6">
            <!-- Main Articles -->
            <div class="lg:col-span-3">
                <!-- Advanced Filters -->
                <div class="bg-white rounded-lg border border-gray-200 p-4 mb-6 shadow-sm">
                    <form method="GET" action="{{ route('news.index') }}" class="space-y-3">
                        <div class="grid grid-cols-1 md:grid-cols-4 gap-3">
                            <div class="md:col-span-2">
                                <label class="block text-xs font-medium text-gray-700 mb-1">Search Articles</label>
                                <input type="text" name="search" placeholder="Search articles, topics, or keywords..." 
                                       class="w-full px-3 py-2 text-sm border border-gray-300 rounded focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                                       value="{{ request('search') }}">
                            </div>
                        <div>
                            <label class="block text-xs font-medium text-gray-700 mb-1">Category</label>
                            <select name="category" class="w-full px-3 py-2 text-sm border border-gray-300 rounded focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
                                <option value="">All Categories</option>
                                @foreach($categories as $cat => $data)
                                    <option value="{{ $cat }}" {{ request('category') === $cat ? 'selected' : '' }}>
                                        {{ ucfirst($cat) }} ({{ $data->count }})
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        
                        <div>
                            <label class="block text-xs font-medium text-gray-700 mb-1">Sort By</label>
                            <select name="sort" class="w-full px-3 py-2 text-sm border border-gray-300 rounded focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
                                <option value="latest" {{ request('sort') === 'latest' ? 'selected' : '' }}>Latest First</option>
                                <option value="popular" {{ request('sort') === 'popular' ? 'selected' : '' }}>Most Popular</option>
                                <option value="title" {{ request('sort') === 'title' ? 'selected' : '' }}>Title A-Z</option>
                                <option value="oldest" {{ request('sort') === 'oldest' ? 'selected' : '' }}>Oldest First</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="flex items-center space-x-2">
                        <button type="submit" class="inline-flex items-center px-4 py-2 text-sm bg-blue-600 hover:bg-blue-700 text-white rounded font-medium transition-colors duration-200">
                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                            Search
                        </button>
                        
                        @if(request()->hasAny(['search', 'category', 'sort', 'tag']))
                            <a href="{{ route('news.index') }}" class="inline-flex items-center px-4 py-2 text-sm bg-gray-100 hover:bg-gray-200 text-gray-700 rounded font-medium transition-colors duration-200">
                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                                Clear
                            </a>
                        @endif
                    </div>
                </form>
            </div>

            <!-- Results Summary -->
            @if($news->count() > 0)
                <div class="flex items-center justify-between mb-4">
                    <div class="text-xs text-gray-600">
                        Showing {{ $news->firstItem() ?? 0 }}-{{ $news->lastItem() ?? 0 }} of {{ $news->total() }} articles
                    </div>
                    <div class="flex items-center space-x-2 text-xs text-gray-500">
                        @if(request('search'))
                            <span class="inline-flex items-center px-2 py-1 bg-blue-100 text-blue-800 rounded">
                                "{{ request('search') }}"
                            </span>
                        @endif
                        @if(request('category'))
                            <span class="inline-flex items-center px-2 py-1 bg-green-100 text-green-800 rounded">
                                {{ ucfirst(request('category')) }}
                            </span>
                        @endif
                    </div>
                </div>
            @endif

            <!-- Articles Grid -->
            @if($news->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    @foreach($news as $article)
                        <article class="group bg-white rounded-lg border border-gray-200 overflow-hidden hover:shadow-md hover:border-blue-300 transition-all duration-300">
                            <div class="relative overflow-hidden">
                                <img src="{{ $article->featured_image_url }}" alt="{{ $article->title }}" 
                                     class="w-full h-36 object-cover group-hover:scale-105 transition-transform duration-300">
                                <div class="absolute inset-0 bg-gradient-to-t from-black/40 to-transparent"></div>
                                <div class="absolute top-2 left-2">
                                    <a href="{{ route('news.category', $article->category) }}" 
                                       class="inline-flex items-center px-2 py-1 rounded text-xs font-medium bg-blue-600 text-white hover:bg-blue-700 transition-colors duration-200">
                                        {{ ucfirst($article->category) }}
                                    </a>
                                </div>
                                <div class="absolute top-2 right-2">
                                    <span class="inline-flex items-center px-1.5 py-0.5 rounded text-xs font-medium bg-black/60 text-white backdrop-blur-sm">
                                        <svg class="w-2.5 h-2.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                        </svg>
                                        {{ number_format($article->views_count) }}
                                    </span>
                                </div>
                                <div class="absolute bottom-2 right-2">
                                    <span class="inline-flex items-center px-1.5 py-0.5 rounded text-xs font-medium bg-white/90 text-gray-800 backdrop-blur-sm">
                                        {{ ceil(str_word_count($article->content) / 200) }} min
                                    </span>
                                </div>
                            </div>
                            <div class="p-4">
                                <h3 class="text-sm font-bold text-gray-900 mb-2 line-clamp-2 group-hover:text-blue-600 transition-colors duration-200">
                                    <a href="{{ route('news.show', $article->slug) }}">
                                        {{ $article->title }}
                                    </a>
                                </h3>
                                <p class="text-xs text-gray-600 mb-3 line-clamp-2">{{ $article->excerpt }}</p>
                                
                                @if($article->tags && count($article->tags) > 0)
                                    <div class="flex flex-wrap gap-1 mb-3">
                                        @foreach(array_slice($article->tags, 0, 2) as $tag)
                                            <a href="{{ route('news.tag', $tag) }}" 
                                               class="inline-flex items-center px-1.5 py-0.5 rounded text-xs font-medium bg-gray-100 text-gray-600 hover:bg-blue-100 hover:text-blue-600 transition-colors duration-200">
                                                #{{ $tag }}
                                            </a>
                                        @endforeach
                                    </div>
                                @endif
                                
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center text-xs text-gray-500">
                                        <div class="w-3 h-3 bg-gradient-to-r from-blue-500 to-indigo-500 rounded-full mr-1.5"></div>
                                        <span>{{ $article->author->name }}</span>
                                    </div>
                                    <div class="flex items-center text-xs text-gray-500">
                                        <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg>
                                        <span>{{ $article->published_at->format('M d, Y') }}</span>
                                    </div>
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>

                <!-- Pagination -->
                @if($news->hasPages())
                    <div class="mt-8 flex justify-center">
                        <div class="bg-white rounded-lg border border-gray-200 p-1">
                            {{ $news->links() }}
                        </div>
                    </div>
                @endif
            @else
                <!-- Empty State -->
                <div class="text-center py-12 bg-white rounded-lg border border-gray-200">
                    <div class="max-w-sm mx-auto">
                        <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                            </svg>
                        </div>
                        <h3 class="text-sm font-medium text-gray-900 mb-2">No articles found</h3>
                        <p class="text-xs text-gray-600 mb-4">Try adjusting your search or filter criteria to find more articles.</p>
                        <a href="{{ route('news.index') }}" class="inline-flex items-center px-3 py-2 text-sm bg-blue-600 hover:bg-blue-700 text-white rounded font-medium transition-colors duration-200">
                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"/>
                            </svg>
                            View All Articles
                        </a>
                    </div>
                </div>
            @endif
        </div>

        <!-- Sidebar -->
        <div class="lg:col-span-1 space-y-6">
            <!-- Categories -->
            <div class="bg-white rounded-lg border border-gray-200 p-4">
                <div class="flex items-center mb-3">
                    <h3 class="text-sm font-bold text-gray-900">Categories</h3>
                    <div class="h-px bg-gradient-to-r from-blue-500 to-transparent flex-1 ml-2"></div>
                </div>
                <ul class="space-y-1">
                    @foreach($categories as $category => $data)
                        <li>
                            <a href="{{ route('news.category', $category) }}" 
                               class="flex items-center justify-between py-1.5 px-2 text-xs rounded hover:bg-blue-50 hover:text-blue-600 transition-colors duration-200 {{ request('category') === $category ? 'bg-blue-50 text-blue-600' : 'text-gray-700' }}">
                                <span class="font-medium">{{ ucfirst($category) }}</span>
                                <span class="text-xs bg-gray-100 text-gray-600 px-1.5 py-0.5 rounded-full">{{ $data->count }}</span>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>

            <!-- Popular Tags -->
            @if($popularTags->count() > 0)
                <div class="bg-white rounded-lg border border-gray-200 p-4">
                    <div class="flex items-center mb-3">
                        <h3 class="text-sm font-bold text-gray-900">Popular Tags</h3>
                        <div class="h-px bg-gradient-to-r from-green-500 to-transparent flex-1 ml-2"></div>
                    </div>
                    <div class="flex flex-wrap gap-1.5">
                        @foreach($popularTags as $tag)
                            <a href="{{ route('news.tag', $tag) }}" 
                               class="inline-flex items-center px-2 py-1 rounded text-xs font-medium bg-gray-100 text-gray-700 hover:bg-green-100 hover:text-green-600 transition-colors duration-200">
                                #{{ $tag }}
                            </a>
                        @endforeach
                    </div>
                </div>
            @endif

            <!-- Recent Articles -->
            @if($recentNews->count() > 0)
                <div class="bg-white rounded-lg border border-gray-200 p-4">
                    <div class="flex items-center mb-3">
                        <h3 class="text-sm font-bold text-gray-900">Recent Articles</h3>
                        <div class="h-px bg-gradient-to-r from-purple-500 to-transparent flex-1 ml-2"></div>
                    </div>
                    <ul class="space-y-3">
                        @foreach($recentNews as $article)
                            <li class="group">
                                <div class="flex space-x-2">
                                    <img src="{{ $article->featured_image_url }}" alt="{{ $article->title }}" 
                                         class="w-12 h-12 object-cover rounded border border-gray-200 group-hover:border-purple-300 transition-colors duration-200">
                                    <div class="flex-1 min-w-0">
                                        <h4 class="text-xs font-medium text-gray-900 line-clamp-2 mb-1 group-hover:text-purple-600 transition-colors duration-200">
                                            <a href="{{ route('news.show', $article->slug) }}">
                                                {{ $article->title }}
                                            </a>
                                        </h4>
                                        <div class="flex items-center justify-between text-xs text-gray-500">
                                            <span>{{ $article->published_at->format('M d') }}</span>
                                            <span class="flex items-center">
                                                <svg class="w-2.5 h-2.5 mr-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                                </svg>
                                                {{ number_format($article->views_count) }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Newsletter Signup -->
            <div class="bg-gradient-to-br from-blue-600 to-indigo-700 text-white rounded-lg p-4">
                <div class="text-center mb-3">
                    <div class="w-8 h-8 bg-white/20 rounded-full flex items-center justify-center mx-auto mb-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <h3 class="text-sm font-bold mb-1">Stay Updated</h3>
                    <p class="text-xs text-blue-100">Get the latest pet care tips and news delivered to your inbox</p>
                </div>
                
                <form id="newsletter-form" class="space-y-2">
                    <input type="email" name="email" placeholder="Enter your email address" required
                           class="w-full px-3 py-2 text-xs rounded border-0 text-gray-900 placeholder-gray-500 focus:ring-2 focus:ring-blue-300">
                    <button type="submit" class="w-full px-3 py-2 text-xs bg-white text-blue-600 rounded font-medium hover:bg-gray-50 transition-colors duration-200">
                        Subscribe Now
                    </button>
                    <p class="text-xs text-blue-200 text-center">No spam, unsubscribe anytime</p>
                </form>
            </div>
        </div>
    </div>
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