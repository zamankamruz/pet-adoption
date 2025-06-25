<?php
// File: show.blade.php
// Path: /resources/views/news/show.blade.php
?>

@extends('layouts.app')

@section('title', $news->title)
@section('meta_description', $news->excerpt ?: Str::limit(strip_tags($news->content), 160))

@push('meta')
    <meta property="og:title" content="{{ $news->title }}">
    <meta property="og:description" content="{{ $news->excerpt ?: Str::limit(strip_tags($news->content), 160) }}">
    <meta property="og:image" content="{{ $news->featured_image_url }}">
    <meta property="og:url" content="{{ request()->url() }}">
    <meta property="og:type" content="article">
    <meta property="article:author" content="{{ $news->author->name }}">
    <meta property="article:published_time" content="{{ $news->published_at->toISOString() }}">
    <meta property="article:section" content="{{ ucfirst($news->category) }}">
    @if($news->tags)
        @foreach($news->tags as $tag)
            <meta property="article:tag" content="{{ $tag }}">
        @endforeach
    @endif
@endpush

@section('content')
<article class="py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
            <!-- Main Article Content -->
            <div class="lg:col-span-3">
                <!-- Article Header -->
                <header class="mb-8">
                    <!-- Breadcrumb -->
                    <nav class="mb-6" aria-label="Breadcrumb">
                        <ol class="flex items-center space-x-2 text-sm text-gray-500">
                            <li><a href="{{ route('home') }}" class="hover:text-purple-600 transition duration-200">Home</a></li>
                            <li><span>/</span></li>
                            <li><a href="{{ route('news.index') }}" class="hover:text-purple-600 transition duration-200">News</a></li>
                            <li><span>/</span></li>
                            <li><a href="{{ route('news.category', $news->category) }}" class="hover:text-purple-600 transition duration-200">{{ ucfirst($news->category) }}</a></li>
                            <li><span>/</span></li>
                            <li class="text-gray-900 font-medium">{{ Str::limit($news->title, 50) }}</li>
                        </ol>
                    </nav>

                    <!-- Category Badge -->
                    <div class="mb-4">
                        <a href="{{ route('news.category', $news->category) }}" 
                           class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-purple-100 text-purple-800 hover:bg-purple-200 transition duration-200">
                            {{ ucfirst($news->category) }}
                        </a>
                    </div>

                    <!-- Title -->
                    <h1 class="text-4xl md:text-5xl font-bold text-gray-900 mb-6">{{ $news->title }}</h1>

                    <!-- Article Meta -->
                    <div class="flex flex-wrap items-center gap-6 text-gray-600 mb-6">
                        <div class="flex items-center">
                            <img src="{{ $news->author->avatar_url ?? 'https://ui-avatars.com/api/?name=' . urlencode($news->author->name) }}" 
                                 alt="{{ $news->author->name }}" 
                                 class="w-10 h-10 rounded-full mr-3">
                            <div>
                                <p class="font-medium text-gray-900">{{ $news->author->name }}</p>
                                <p class="text-sm">Author</p>
                            </div>
                        </div>
                        
                        <div class="flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            <span>{{ $news->published_at->format('F d, Y \a\t g:i A') }}</span>
                        </div>
                        
                        <div class="flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                            </svg>
                            <span>{{ number_format($news->views_count) }} views</span>
                        </div>
                        
                        <div class="flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <span>{{ ceil(str_word_count($news->content) / 200) }} min read</span>
                        </div>
                    </div>

                    <!-- Social Share -->
                    <div class="flex items-center space-x-3 mb-8">
                        <span class="text-sm font-medium text-gray-700">Share:</span>
                        <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->url()) }}" 
                           target="_blank" rel="noopener"
                           class="inline-flex items-center px-3 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm rounded-lg transition duration-200">
                            <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                            </svg>
                            Facebook
                        </a>
                        <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->url()) }}&text={{ urlencode($news->title) }}" 
                           target="_blank" rel="noopener"
                           class="inline-flex items-center px-3 py-2 bg-blue-400 hover:bg-blue-500 text-white text-sm rounded-lg transition duration-200">
                            <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/>
                            </svg>
                            Twitter
                        </a>
                        <button onclick="copyToClipboard()" 
                                class="inline-flex items-center px-3 py-2 bg-gray-600 hover:bg-gray-700 text-white text-sm rounded-lg transition duration-200">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                            </svg>
                            Copy Link
                        </button>
                    </div>
                </header>

                <!-- Featured Image -->
                @if($news->featured_image)
                    <div class="mb-8">
                        <img src="{{ $news->featured_image_url }}" alt="{{ $news->title }}" 
                             class="w-full h-64 md:h-96 object-cover rounded-xl shadow-lg">
                    </div>
                @endif

                <!-- Article Excerpt -->
                @if($news->excerpt)
                    <div class="bg-purple-50 border-l-4 border-purple-500 p-6 mb-8 rounded-r-lg">
                        <p class="text-lg text-gray-700 italic">{{ $news->excerpt }}</p>
                    </div>
                @endif

                <!-- Article Content -->
                <div class="prose prose-lg max-w-none mb-8">
                    {!! nl2br(e($news->content)) !!}
                </div>

                <!-- Tags -->
                @if($news->tags && count($news->tags) > 0)
                    <div class="mb-8">
                        <h3 class="text-lg font-bold text-gray-900 mb-4">Tags</h3>
                        <div class="flex flex-wrap gap-2">
                            @foreach($news->tags as $tag)
                                <a href="{{ route('news.tag', $tag) }}" 
                                   class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-gray-100 text-gray-700 hover:bg-purple-100 hover:text-purple-600 transition duration-200">
                                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                                    </svg>
                                    {{ $tag }}
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endif

                <!-- Article Navigation -->
                <div class="border-t border-gray-200 pt-8 mb-8">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        @if($prevArticle)
                            <div>
                                <p class="text-sm font-medium text-gray-500 mb-2">Previous Article</p>
                                <a href="{{ route('news.show', $prevArticle->slug) }}" 
                                   class="block p-4 bg-gray-50 rounded-lg hover:bg-gray-100 transition duration-200">
                                    <div class="flex items-center">
                                        <svg class="w-5 h-5 text-gray-400 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                                        </svg>
                                        <h4 class="text-sm font-medium text-gray-900 line-clamp-2">{{ $prevArticle->title }}</h4>
                                    </div>
                                </a>
                            </div>
                        @endif
                        
                        @if($nextArticle)
                            <div class="text-right">
                                <p class="text-sm font-medium text-gray-500 mb-2">Next Article</p>
                                <a href="{{ route('news.show', $nextArticle->slug) }}" 
                                   class="block p-4 bg-gray-50 rounded-lg hover:bg-gray-100 transition duration-200">
                                    <div class="flex items-center justify-end">
                                        <h4 class="text-sm font-medium text-gray-900 line-clamp-2 mr-3">{{ $nextArticle->title }}</h4>
                                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                        </svg>
                                    </div>
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
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
                                   class="flex items-center justify-between py-2 px-3 rounded-lg hover:bg-purple-50 hover:text-purple-600 transition duration-200 {{ $news->category === $category ? 'bg-purple-50 text-purple-600' : 'text-gray-700' }}">
                                    <span>{{ ucfirst($category) }}</span>
                                    <span class="text-sm bg-gray-100 text-gray-600 px-2 py-1 rounded-full">{{ $data->count }}</span>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <!-- Popular Articles -->
                @if($popularNews->count() > 0)
                    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 mb-8">
                        <h3 class="text-lg font-bold text-gray-900 mb-4">Popular Articles</h3>
                        <ul class="space-y-4">
                            @foreach($popularNews as $article)
                                <li class="flex space-x-3">
                                    <img src="{{ $article->featured_image_url }}" alt="{{ $article->title }}" 
                                         class="w-16 h-16 object-cover rounded-lg">
                                    <div class="flex-1 min-w-0">
                                        <h4 class="text-sm font-medium text-gray-900 line-clamp-2 mb-1">
                                            <a href="{{ route('news.show', $article->slug) }}" class="hover:text-purple-600 transition duration-200">
                                                {{ $article->title }}
                                            </a>
                                        </h4>
                                        <div class="flex items-center text-xs text-gray-500">
                                            <span>{{ $article->published_at->format('M d, Y') }}</span>
                                            <span class="mx-1">•</span>
                                            <span>{{ number_format($article->views_count) }} views</span>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- Newsletter Signup -->
                <div class="bg-purple-600 text-white rounded-lg p-6">
                    <h3 class="text-lg font-bold mb-2">Stay Updated</h3>
                    <p class="text-purple-100 text-sm mb-4">Get the latest pet care tips delivered to your inbox</p>
                    
                    <form id="sidebar-newsletter-form">
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
</article>

<!-- Related Articles -->
@if($relatedNews->count() > 0)
    <section class="bg-gray-50 py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-bold text-gray-900 mb-8">Related Articles</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach($relatedNews as $article)
                    <article class="bg-white rounded-xl shadow-sm hover:shadow-lg transition duration-300">
                        <img src="{{ $article->featured_image_url }}" alt="{{ $article->title }}" 
                             class="w-full h-48 object-cover rounded-t-xl">
                        <div class="p-4">
                            <h3 class="text-lg font-bold text-gray-900 mb-2 line-clamp-2">
                                <a href="{{ route('news.show', $article->slug) }}" class="hover:text-purple-600 transition duration-200">
                                    {{ $article->title }}
                                </a>
                            </h3>
                            <p class="text-gray-600 text-sm mb-3 line-clamp-2">{{ $article->excerpt }}</p>
                            <div class="flex items-center justify-between text-xs text-gray-500">
                                <span>{{ $article->author->name }}</span>
                                <span>{{ $article->published_at->format('M d, Y') }}</span>
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>
        </div>
    </section>
@endif

<script>
function copyToClipboard() {
    navigator.clipboard.writeText(window.location.href).then(function() {
        alert('Link copied to clipboard!');
    }, function(err) {
        console.error('Could not copy text: ', err);
    });
}

// Newsletter form submission
document.getElementById('sidebar-newsletter-form').addEventListener('submit', function(e) {
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