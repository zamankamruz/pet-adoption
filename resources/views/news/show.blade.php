@extends('layouts.app')
@section('title', $news->title)

@section('content')
<article class="py-6 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-6">
            <!-- Main Article Content -->
            <div class="lg:col-span-3">
                <!-- Article Header -->
                <header class="mb-6">
                <!-- Title -->
                <h1 class="text-xl md:text-2xl font-bold text-gray-900 mb-4 leading-tight">{{ $news->title }}</h1>

                <!-- Article Meta -->
                <div class="flex flex-wrap items-center gap-4 text-xs text-gray-600 mb-4 pb-4 border-b border-gray-200">
     
                    <div class="flex items-center bg-gray-50 px-2 py-1 rounded">
                        <svg class="w-3 h-3 mr-1 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        <span>{{ $news->published_at->format('M d, Y') }}</span>
                    </div>
                    
                    <div class="flex items-center bg-gray-50 px-2 py-1 rounded">
                        <svg class="w-3 h-3 mr-1 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                        </svg>
                        <span>{{ number_format($news->views_count) }} views</span>
                    </div>
                    
                    <div class="flex items-center bg-gray-50 px-2 py-1 rounded">
                        <svg class="w-3 h-3 mr-1 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <span>{{ ceil(str_word_count($news->content) / 200) }} min read</span>
                    </div>
                </div>

                <!-- Social Share -->
                <div class="flex items-center space-x-2 mb-6">
                    <span class="text-xs font-medium text-gray-700">Share Article:</span>
                    <div class="flex space-x-1">
                        <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->url()) }}" 
                           target="_blank" rel="noopener"
                           class="inline-flex items-center px-3 py-1.5 bg-blue-600 hover:bg-blue-700 text-white text-xs rounded-lg transition duration-200 shadow-sm">
                            <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                            </svg>
                            Facebook
                        </a>
                        <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->url()) }}&text={{ urlencode($news->title) }}" 
                           target="_blank" rel="noopener"
                           class="inline-flex items-center px-3 py-1.5 bg-slate-600 hover:bg-slate-700 text-white text-xs rounded-lg transition duration-200 shadow-sm">
                            <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/>
                            </svg>
                            Twitter
                        </a>
                        <button onclick="copyToClipboard()" 
                                class="inline-flex items-center px-3 py-1.5 bg-gray-600 hover:bg-gray-700 text-white text-xs rounded-lg transition duration-200 shadow-sm">
                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                            </svg>
                            Copy Link
                        </button>
                    </div>
                </div>
            </header>

            <!-- Featured Image -->
            @if($news->featured_image)
                <div class="mb-6">
                    <div class="relative overflow-hidden rounded-xl border border-gray-200 shadow-lg">
                        <img src="{{ $news->featured_image_url }}" alt="{{ $news->title }}" 
                             class="w-full h-64 md:h-80 object-cover">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent"></div>
                    </div>
                </div>
            @endif

            <!-- Article Excerpt -->
            @if($news->excerpt)
                <div class="bg-gradient-to-r from-blue-50 to-indigo-50 border-l-4 border-blue-500 p-4 mb-6 rounded-r-lg">
                    <div class="flex items-start">
                        <svg class="w-4 h-4 text-blue-500 mr-2 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <p class="text-sm text-gray-700 italic leading-relaxed">{{ $news->excerpt }}</p>
                    </div>
                </div>
            @endif

            <!-- Article Content -->
            <div class="prose-sm max-w-none mb-6">
                <div class="text-sm text-gray-700 leading-relaxed space-y-4 article-content">
                    {!! nl2br(e($news->content)) !!}
                </div>
            </div>

            <!-- Tags -->
            @if($news->tags && count($news->tags) > 0)
                <div class="mb-6 pb-6 border-b border-gray-200">
                    <div class="flex items-center mb-3">
                        <h3 class="text-sm font-bold text-gray-900">Article Tags</h3>
                        <div class="h-px bg-gradient-to-r from-blue-500 to-transparent flex-1 ml-3"></div>
                    </div>
                    <div class="flex flex-wrap gap-2">
                        @foreach($news->tags as $tag)
                            <a href="{{ route('news.tag', $tag) }}" 
                               class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-gradient-to-r from-gray-100 to-gray-50 text-gray-700 hover:from-blue-100 hover:to-blue-50 hover:text-blue-700 transition duration-200 border border-gray-200 hover:border-blue-300">
                                <svg class="w-2.5 h-2.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                                </svg>
                                {{ $tag }}
                            </a>
                        @endforeach
                    </div>
                </div>
            @endif

            <!-- Article Navigation -->
            <div class="border-t border-gray-200 pt-6 mb-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    @if($prevArticle)
                        <div>
                            <p class="text-xs font-medium text-gray-500 mb-2 flex items-center">
                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                                </svg>
                                Previous Article
                            </p>
                            <a href="{{ route('news.show', $prevArticle->slug) }}" 
                               class="group block p-4 bg-gradient-to-r from-gray-50 to-gray-100 rounded-lg border border-gray-200 hover:from-blue-50 hover:to-blue-100 hover:border-blue-300 transition duration-200">
                                <h4 class="text-xs font-medium text-gray-900 line-clamp-2 group-hover:text-blue-700">{{ $prevArticle->title }}</h4>
                            </a>
                        </div>
                    @endif
                    
                    @if($nextArticle)
                        <div class="text-right">
                            <p class="text-xs font-medium text-gray-500 mb-2 flex items-center justify-end">
                                Next Article
                                <svg class="w-3 h-3 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                </svg>
                            </p>
                            <a href="{{ route('news.show', $nextArticle->slug) }}" 
                               class="group block p-4 bg-gradient-to-l from-gray-50 to-gray-100 rounded-lg border border-gray-200 hover:from-blue-50 hover:to-blue-100 hover:border-blue-300 transition duration-200">
                                <h4 class="text-xs font-medium text-gray-900 line-clamp-2 group-hover:text-blue-700">{{ $nextArticle->title }}</h4>
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="lg:col-span-1 space-y-6">
            <!-- Categories -->
            <div class="bg-white rounded-lg border border-gray-200 p-4 shadow-sm">
                <div class="flex items-center mb-4">
                    <h3 class="text-sm font-bold text-gray-900">Categories</h3>
                    <div class="h-px bg-gradient-to-r from-blue-500 to-transparent flex-1 ml-3"></div>
                </div>
                <ul class="space-y-1">
                    @foreach($categories as $category => $data)
                        <li>
                            <a href="{{ route('news.category', $category) }}" 
                               class="flex items-center justify-between py-2 px-3 text-xs rounded-lg hover:bg-blue-50 hover:text-blue-700 transition duration-200 {{ $news->category === $category ? 'bg-blue-50 text-blue-700 border border-blue-200' : 'text-gray-700 hover:border-blue-200' }}">
                                <span class="font-medium">{{ ucfirst($category) }}</span>
                                <span class="text-xs bg-gray-100 text-gray-600 px-2 py-0.5 rounded-full">{{ $data->count }}</span>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>

            <!-- Popular Articles -->
            @if($popularNews->count() > 0)
                <div class="bg-white rounded-lg border border-gray-200 p-4 shadow-sm">
                    <div class="flex items-center mb-4">
                        <h3 class="text-sm font-bold text-gray-900">Popular Articles</h3>
                        <div class="h-px bg-gradient-to-r from-green-500 to-transparent flex-1 ml-3"></div>
                    </div>
                    <ul class="space-y-3">
                        @foreach($popularNews as $article)
                            <li class="group">
                                <div class="flex space-x-3">
                                    <div class="relative overflow-hidden rounded-lg border border-gray-200 group-hover:border-green-300 transition-colors duration-200">
                                        <img src="{{ $article->featured_image_url }}" alt="{{ $article->title }}" 
                                             class="w-16 h-16 object-cover">
                                        <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-200"></div>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <h4 class="text-xs font-medium text-gray-900 line-clamp-2 mb-1 group-hover:text-green-700 transition-colors duration-200">
                                            <a href="{{ route('news.show', $article->slug) }}">
                                                {{ $article->title }}
                                            </a>
                                        </h4>
                                        <div class="flex items-center justify-between text-xs text-gray-500">
                                            <span>{{ $article->published_at->format('M d, Y') }}</span>
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
            <div class="bg-gradient-to-br from-blue-600 via-blue-700 to-indigo-800 text-white rounded-lg p-4 shadow-lg">
                <div class="text-center mb-4">
                    <div class="w-10 h-10 bg-white/20 rounded-full flex items-center justify-center mx-auto mb-3 backdrop-blur-sm">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <h3 class="text-sm font-bold mb-2">Stay Updated</h3>
                    <p class="text-xs text-blue-100 leading-relaxed">Get the latest pet care tips and news delivered directly to your inbox</p>
                </div>
                
                <form id="sidebar-newsletter-form" class="space-y-3">
                    <div class="relative">
                        <input type="email" name="email" placeholder="Enter your email address" required
                               class="w-full px-4 py-2.5 text-xs rounded-lg border-0 text-gray-900 placeholder-gray-500 focus:ring-2 focus:ring-blue-300 bg-white/95 backdrop-blur-sm">
                        <div class="absolute inset-y-0 right-0 flex items-center pr-3">
                            <svg class="w-3 h-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"/>
                            </svg>
                        </div>
                    </div>
                    <button type="submit" class="w-full px-4 py-2.5 text-xs bg-white text-blue-600 rounded-lg font-medium hover:bg-gray-50 transition-colors duration-200 shadow-sm">
                        Subscribe to Newsletter
                    </button>
                    <p class="text-xs text-blue-200 text-center">✓ No spam • ✓ Unsubscribe anytime</p>
                </form>
            </div>
        </div>
    </div>
</div>
</article>
<!-- Related Articles -->
@if($relatedNews->count() > 0)
<section class="bg-gradient-to-b from-gray-50 to-white py-8">
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
<div class="flex items-center mb-6">
<h2 class="text-xl font-bold text-gray-900">Related Articles</h2>
<div class="h-px bg-gradient-to-r from-blue-500 to-transparent flex-1 ml-4"></div>
</div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
            @foreach($relatedNews as $article)
                <article class="group bg-white rounded-lg border border-gray-200 overflow-hidden hover:shadow-md hover:border-blue-300 transition-all duration-300 transform hover:-translate-y-1">
                    <div class="relative overflow-hidden">
                        <img src="{{ $article->featured_image_url }}" alt="{{ $article->title }}" 
                             class="w-full h-40 object-cover group-hover:scale-105 transition-transform duration-300">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/40 to-transparent"></div>
                        <div class="absolute bottom-2 right-2">
                            <span class="inline-flex items-center px-2 py-1 rounded text-xs font-medium bg-white/90 text-gray-800 backdrop-blur-sm">
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
                        <p class="text-gray-600 text-xs mb-3 line-clamp-2">{{ $article->excerpt }}</p>
                        <div class="flex items-center justify-between">
                            <span class="flex items-center text-xs text-gray-500">
                                <div class="w-3 h-3 bg-gradient-to-r from-blue-500 to-indigo-500 rounded-full mr-1.5"></div>
                                {{ $article->author->name }}
                            </span>
                            <span class="text-xs text-gray-500">{{ $article->published_at->format('M d, Y') }}</span>
                        </div>
                    </div>
                </article>
            @endforeach
        </div>
    </div>
</section>
@endif
<style>
.article-content p {
    margin-bottom: 1rem;
}

.article-content p:first-child {
    font-size: 1.125rem;
    font-weight: 500;
    color: #374151;
}
</style>
<script>
function copyToClipboard() {
    navigator.clipboard.writeText(window.location.href).then(function() {
        // Create a modern notification
        const notification = document.createElement('div');
        notification.className = 'fixed top-6 right-6 bg-green-500 text-white px-4 py-3 rounded-lg text-sm z-50 flex items-center shadow-lg';
        notification.innerHTML = `
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
            </svg>
            Link copied to clipboard!
        `;
        document.body.appendChild(notification);
        
        setTimeout(() => {
            notification.style.transform = 'translateX(100%)';
            setTimeout(() => document.body.removeChild(notification), 300);
        }, 2500);
    }, function(err) {
        console.error('Could not copy text: ', err);
        alert('Could not copy link. Please try again.');
    });
}

// Newsletter form submission
document.getElementById('sidebar-newsletter-form').addEventListener('submit', function(e) {
    e.preventDefault();
    const email = this.querySelector('input[name="email"]').value;
    const button = this.querySelector('button[type="submit"]');
    
    // Loading state
    button.innerHTML = 'Subscribing...';
    button.disabled = true;
    
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
        // Create success notification
        const notification = document.createElement('div');
        notification.className = 'fixed top-6 right-6 bg-blue-500 text-white px-4 py-3 rounded-lg text-sm z-50 flex items-center shadow-lg';
        notification.innerHTML = `
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
            </svg>
            ${data.message}
        `;
        document.body.appendChild(notification);
        
        setTimeout(() => {
            notification.style.transform = 'translateX(100%)';
            setTimeout(() => document.body.removeChild(notification), 300);
        }, 3000);
        
        this.reset();
        button.innerHTML = 'Subscribe to Newsletter';
        button.disabled = false;
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Something went wrong. Please try again.');
        button.innerHTML = 'Subscribe to Newsletter';
        button.disabled = false;
    });
});

// Add smooth scrolling for anchor links
document.addEventListener('DOMContentLoaded', function() {
    const links = document.querySelectorAll('a[href^="#"]');
    links.forEach(link => {
        link.addEventListener('click', function(e) {
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                e.preventDefault();
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });
});
</script>
@endsection