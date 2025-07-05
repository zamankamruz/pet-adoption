<?php
// File: search.blade.php
// Path: /resources/views/news/search.blade.php
?>

@extends('layouts.app')

@section('title', 'Search Results for "' . $searchTerm . '" - Pet News')
@section('meta_description', 'Search results for "' . $searchTerm . '" in our pet care articles and news.')

@section('content')
<!-- Search Header -->
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
                    <li class="text-white font-medium">Search Results</li>
                </ol>
            </nav>

            <h1 class="text-4xl md:text-5xl font-bold mb-4">Search Results</h1>
            <p class="text-xl md:text-2xl text-purple-100 mb-8">
                Found {{ $news->total() }} {{ Str::plural('result', $news->total()) }} for 
                <span class="font-semibold">"{{ $searchTerm }}"</span>
            </p>
            
            <!-- Enhanced Search Bar -->
            <div class="max-w-3xl mx-auto">
                <form action="{{ route('news.search') }}" method="GET" class="space-y-4">
                    <div class="flex">
                        <input type="text" name="q" placeholder="Search articles..." 
                               class="flex-1 px-4 py-3 rounded-l-lg border-0 text-gray-900 placeholder-gray-500 focus:ring-2 focus:ring-purple-500"
                               value="{{ $searchTerm }}">
                        <button type="submit" class="px-6 py-3 bg-purple-700 hover:bg-purple-800 rounded-r-lg transition duration-200">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                        </button>
                    </div>
                    
                    <!-- Category Filter -->
                    @if($categories->count() > 0)
                        <div class="flex justify-center">
                            <select name="category" class="px-4 py-2 rounded-lg border-0 text-gray-900 focus:ring-2 focus:ring-purple-300 bg-white bg-opacity-90">
                                <option value="">All Categories</option>
                                @foreach($categories as $category => $data)
                                    <option value="{{ $category }}" {{ request('category') === $category ? 'selected' : '' }}>
                                        {{ ucfirst($category) }} ({{ $data->count }})
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    @endif
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Search Suggestions -->
@if($suggestions->count() > 0 && $news->count() > 0)
    <div class="bg-gray-50 py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <p class="text-gray-600 mb-3">Related searches:</p>
                <div class="flex flex-wrap justify-center gap-2">
                    @foreach($suggestions as $suggestion)
                        <a href="{{ route('news.search', ['q' => $suggestion]) }}" 
                           class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-white text-gray-700 hover:bg-purple-100 hover:text-purple-600 transition duration-200 shadow-sm">
                            {{ $suggestion }}
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endif

<!-- Main Content -->
<section class="py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
            <!-- Search Results -->
            <div class="lg:col-span-3">
                <!-- Search Filters -->
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 mb-8">
                    <form method="GET" action="{{ route('news.search') }}" class="flex flex-wrap items-center gap-4">
                        <input type="hidden" name="q" value="{{ $searchTerm }}">
                        
                        <div class="flex-1 min-w-0">
                            <div class="relative">
                                <svg class="w-5 h-5 absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                                </svg>
                                <span class="pl-10 pr-4 py-2 bg-gray-50 border border-gray-300 rounded-lg text-gray-700 text-sm">
                                    Searching for: <strong>"{{ $searchTerm }}"</strong>
                                </span>
                            </div>
                        </div>
                        
                        <select name="category" class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500">
                            <option value="">All Categories</option>
                            @foreach($categories as $category => $data)
                                <option value="{{ $category }}" {{ request('category') === $category ? 'selected' : '' }}>
                                    {{ ucfirst($category) }} ({{ $data->count }})
                                </option>
                            @endforeach
                        </select>
                        
                        <button type="submit" class="px-6 py-2 bg-purple-600 hover:bg-purple-700 text-white rounded-lg transition duration-200">
                            Refine Search
                        </button>
                        
                        <a href="{{ route('news.search', ['q' => $searchTerm]) }}" class="px-6 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-lg transition duration-200">
                            Clear Filters
                        </a>
                    </form>
                </div>

                <!-- Results Info -->
                <div class="flex items-center justify-between mb-6">
                    <div class="text-gray-600">
                        <span class="font-medium">{{ $news->total() }}</span> {{ Str::plural('result', $news->total()) }} found
                        @if(request('category'))
                            in <span class="font-medium text-purple-600">{{ ucfirst(request('category')) }}</span>
                        @endif
                    </div>
                    @if($news->total() > 0)
                        <div class="text-sm text-gray-500">
                            Showing {{ $news->firstItem() }}-{{ $news->lastItem() }} of {{ $news->total() }}
                        </div>
                    @endif
                </div>

                <!-- Search Results -->
                @if($news->count() > 0)
                    <div class="space-y-8">
                        @foreach($news as $article)
                            <article class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition duration-300">
                                <div class="md:flex">
                                    <div class="md:w-1/3">
                                        <img src="{{ $article->featured_image_url }}" alt="{{ $article->title }}" 
                                             class="w-full h-48 md:h-full object-cover">
                                    </div>
                                    <div class="md:w-2/3 p-6">
                                        <div class="flex items-center mb-3">
                                            <a href="{{ route('news.category', $article->category) }}" 
                                               class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-purple-100 text-purple-800 hover:bg-purple-200 transition duration-200">
                                                {{ ucfirst($article->category) }}
                                            </a>
                                            <span class="ml-3 text-sm text-gray-500">{{ $article->published_at->format('M d, Y') }}</span>
                                        </div>
                                        
                                        <h3 class="text-xl md:text-2xl font-bold text-gray-900 mb-3 line-clamp-2">
                                            <a href="{{ route('news.show', $article->slug) }}" class="hover:text-purple-600 transition duration-200">
                                                {!! str_ireplace($searchTerm, '<mark class="bg-yellow-200 px-1 rounded">' . $searchTerm . '</mark>', $article->title) !!}
                                            </a>
                                        </h3>
                                        
                                        <p class="text-gray-600 mb-4 line-clamp-3">
                                            {!! str_ireplace($searchTerm, '<mark class="bg-yellow-200 px-1 rounded">' . $searchTerm . '</mark>', $article->excerpt) !!}
                                        </p>
                                        
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
                                        
                                        <div class="flex items-center justify-between">
                                            <div class="flex items-center text-sm text-gray-500">
                                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                                </svg>
                                                <span class="mr-4">{{ $article->author->name }}</span>
                                                
                                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                                </svg>
                                                <span>{{ number_format($article->views_count) }} views</span>
                                            </div>
                                            
                                            <a href="{{ route('news.show', $article->slug) }}" 
                                               class="inline-flex items-center px-4 py-2 bg-purple-600 hover:bg-purple-700 text-white text-sm rounded-lg transition duration-200">
                                                Read More
                                                <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                                </svg>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </article>
                        @endforeach
                    </div>

                    <!-- Pagination -->
                    @if($news->hasPages())
                        <div class="mt-12">
                            {{ $news->appends(request()->query())->links() }}
                        </div>
                    @endif
                @else
                    <!-- No Results -->
                    <div class="text-center py-12">
                        <svg class="mx-auto h-16 w-16 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                        <h3 class="text-xl font-medium text-gray-900 mb-2">No results found</h3>
                        <p class="text-gray-600 mb-6">We couldn't find any articles matching "<strong>{{ $searchTerm }}</strong>"</p>
                        
                        <div class="space-y-4">
                            <div class="text-sm text-gray-500">
                                <p class="mb-2"><strong>Search Tips:</strong></p>
                                <ul class="text-left max-w-md mx-auto space-y-1">
                                    <li>• Check your spelling</li>
                                    <li>• Try different keywords</li>
                                    <li>• Use more general terms</li>
                                    <li>• Try searching in a specific category</li>
                                </ul>
                            </div>
                            
                            @if($suggestions->count() > 0)
                                <div class="mt-6">
                                    <p class="text-sm text-gray-600 mb-3">Try these related searches:</p>
                                    <div class="flex flex-wrap justify-center gap-2">
                                        @foreach($suggestions as $suggestion)
                                            <a href="{{ route('news.search', ['q' => $suggestion]) }}" 
                                               class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-purple-100 text-purple-800 hover:bg-purple-200 transition duration-200">
                                                {{ $suggestion }}
                                            </a>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                            
                            <div class="flex items-center justify-center space-x-3 mt-6">
                                <a href="{{ route('news.index') }}" class="inline-flex items-center px-6 py-3 bg-purple-600 hover:bg-purple-700 text-white rounded-lg transition duration-200">
                                    Browse All Articles
                                </a>
                                <a href="{{ route('news.trending') }}" class="inline-flex items-center px-6 py-3 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-lg transition duration-200">
                                    View Trending
                                </a>
                            </div>
                        </div>
                    </div>
                @endif
            </div>

            <!-- Sidebar -->
            <div class="lg:col-span-1">
                <!-- Search Categories -->
                @if($categories->count() > 0)
                    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 mb-8">
                        <h3 class="text-lg font-bold text-gray-900 mb-4">Search by Category</h3>
                        <ul class="space-y-2">
                            <li>
                                <a href="{{ route('news.search', ['q' => $searchTerm]) }}" 
                                   class="flex items-center justify-between py-2 px-3 rounded-lg hover:bg-purple-50 hover:text-purple-600 transition duration-200 {{ !request('category') ? 'bg-purple-50 text-purple-600' : 'text-gray-700' }}">
                                    <span>All Categories</span>
                                    <span class="text-sm bg-gray-100 text-gray-600 px-2 py-1 rounded-full">{{ $news->total() }}</span>
                                </a>
                            </li>
                            @foreach($categories as $category => $data)
                                <li>
                                    <a href="{{ route('news.search', ['q' => $searchTerm, 'category' => $category]) }}" 
                                       class="flex items-center justify-between py-2 px-3 rounded-lg hover:bg-purple-50 hover:text-purple-600 transition duration-200 {{ request('category') === $category ? 'bg-purple-50 text-purple-600' : 'text-gray-700' }}">
                                        <span>{{ ucfirst($category) }}</span>
                                        <span class="text-sm bg-gray-100 text-gray-600 px-2 py-1 rounded-full">{{ $data->count }}</span>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- Quick Links -->
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 mb-8">
                    <h3 class="text-lg font-bold text-gray-900 mb-4">Quick Links</h3>
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
                    </div>
                </div>

                <!-- Search Tips -->
                <div class="bg-blue-50 border border-blue-200 rounded-lg p-6">
                    <h3 class="text-lg font-bold text-blue-900 mb-3">Search Tips</h3>
                    <ul class="text-sm text-blue-800 space-y-2">
                        <li class="flex items-start">
                            <svg class="w-4 h-4 mt-0.5 mr-2 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                            </svg>
                            Use specific keywords for better results
                        </li>
                        <li class="flex items-start">
                            <svg class="w-4 h-4 mt-0.5 mr-2 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                            </svg>
                            Filter by category to narrow results
                        </li>
                        <li class="flex items-start">
                            <svg class="w-4 h-4 mt-0.5 mr-2 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                            </svg>
                            Try different search terms if no results
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection