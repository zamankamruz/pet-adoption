<?php
// File: NewsController.php
// Path: /app/Http/Controllers/NewsController.php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

use Str;
class NewsController extends Controller
{
    public function index(Request $request)
    {
        $query = News::published()->with('author');

        // Apply category filter
        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        // Apply search filter
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'LIKE', "%{$search}%")
                  ->orWhere('content', 'LIKE', "%{$search}%")
                  ->orWhere('excerpt', 'LIKE', "%{$search}%");
            });
        }

        // Apply tag filter
        if ($request->filled('tag')) {
            $query->whereJsonContains('tags', $request->tag);
        }

        // Sorting
        $sortBy = $request->get('sort', 'latest');
        switch ($sortBy) {
            case 'popular':
                $query->orderByDesc('views_count');
                break;
            case 'oldest':
                $query->orderBy('published_at');
                break;
            case 'title':
                $query->orderBy('title');
                break;
            default: // latest
                $query->orderByDesc('published_at');
        }

        $news = $query->paginate(12)->withQueryString();

        // Get featured articles (most viewed in last 30 days)
        $featuredNews = Cache::remember('featured_news', 3600, function () {
            return News::published()
                ->where('published_at', '>=', now()->subDays(30))
                ->orderByDesc('views_count')
                ->take(3)
                ->get();
        });

        // Get categories with article counts
        $categories = Cache::remember('news_categories', 3600, function () {
            return News::published()
                ->selectRaw('category, COUNT(*) as count')
                ->groupBy('category')
                ->orderBy('category')
                ->get()
                ->keyBy('category');
        });

        // Get popular tags
        $popularTags = Cache::remember('popular_tags', 3600, function () {
            return News::published()
                ->whereNotNull('tags')
                ->get()
                ->pluck('tags')
                ->flatten()
                ->countBy()
                ->sortDesc()
                ->take(20)
                ->keys();
        });

        // Get recent articles for sidebar
        $recentNews = Cache::remember('recent_news', 1800, function () {
            return News::published()
                ->orderByDesc('published_at')
                ->take(5)
                ->get(['id', 'title', 'slug', 'published_at', 'featured_image']);
        });

        return view('news.index', compact(
            'news', 
            'featuredNews', 
            'categories', 
            'popularTags', 
            'recentNews'
        ));
    }

    public function show($slug, Request $request)
    {
        $news = News::where('slug', $slug)
            ->published()
            ->with('author')
            ->firstOrFail();

        // Increment view count (only once per session per article)
        $viewKey = "news_viewed_{$news->id}";
        if (!session()->has($viewKey)) {
            $news->incrementViews();
            session()->put($viewKey, true);
        }

        // Get related articles (same category, excluding current)
        $relatedNews = News::published()
            ->where('category', $news->category)
            ->where('id', '!=', $news->id)
            ->orderByDesc('published_at')
            ->take(4)
            ->get();

        // Get next and previous articles
        $nextArticle = News::published()
            ->where('published_at', '>', $news->published_at)
            ->orderBy('published_at')
            ->first(['id', 'title', 'slug']);

        $prevArticle = News::published()
            ->where('published_at', '<', $news->published_at)
            ->orderByDesc('published_at')
            ->first(['id', 'title', 'slug']);

        // Get popular articles for sidebar
        $popularNews = Cache::remember('popular_news_sidebar', 1800, function () {
            return News::published()
                ->orderByDesc('views_count')
                ->take(5)
                ->get(['id', 'title', 'slug', 'published_at', 'featured_image', 'views_count']);
        });

        // Get categories for sidebar
        $categories = Cache::remember('news_categories_sidebar', 3600, function () {
            return News::published()
                ->selectRaw('category, COUNT(*) as count')
                ->groupBy('category')
                ->orderBy('category')
                ->get()
                ->keyBy('category');
        });

        return view('news.show', compact(
            'news', 
            'relatedNews', 
            'nextArticle', 
            'prevArticle', 
            'popularNews',
            'categories'
        ));
    }

    public function category($category, Request $request)
    {
        // Validate category exists
        $categoryExists = News::published()
            ->where('category', $category)
            ->exists();

        if (!$categoryExists) {
            abort(404, 'Category not found');
        }

        $query = News::published()
            ->where('category', $category)
            ->with('author');

        // Apply search filter
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'LIKE', "%{$search}%")
                  ->orWhere('content', 'LIKE', "%{$search}%")
                  ->orWhere('excerpt', 'LIKE', "%{$search}%");
            });
        }

        // Sorting
        $sortBy = $request->get('sort', 'latest');
        switch ($sortBy) {
            case 'popular':
                $query->orderByDesc('views_count');
                break;
            case 'oldest':
                $query->orderBy('published_at');
                break;
            case 'title':
                $query->orderBy('title');
                break;
            default: // latest
                $query->orderByDesc('published_at');
        }

        $news = $query->paginate(12)->withQueryString();

        // Get category statistics
        $categoryStats = [
            'total_articles' => News::published()->where('category', $category)->count(),
            'total_views' => News::published()->where('category', $category)->sum('views_count'),
            'latest_article' => News::published()
                ->where('category', $category)
                ->latest('published_at')
                ->first(['published_at']),
        ];

        // Get all categories for navigation
        $allCategories = Cache::remember('all_news_categories', 3600, function () {
            return News::published()
                ->selectRaw('category, COUNT(*) as count')
                ->groupBy('category')
                ->orderBy('category')
                ->get()
                ->keyBy('category');
        });

        return view('news.category', compact(
            'news', 
            'category', 
            'categoryStats', 
            'allCategories'
        ));
    }

    public function search(Request $request)
    {
        $request->validate([
            'q' => 'required|string|min:2|max:100'
        ]);

        $searchTerm = $request->get('q');
        
        $query = News::published()->with('author');

        // Full-text search
        $query->where(function($q) use ($searchTerm) {
            $q->where('title', 'LIKE', "%{$searchTerm}%")
              ->orWhere('content', 'LIKE', "%{$searchTerm}%")
              ->orWhere('excerpt', 'LIKE', "%{$searchTerm}%");
        });

        // Apply category filter if provided
        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        // Sorting by relevance (title matches first, then content)
        $query->orderByRaw("
            CASE 
                WHEN title LIKE '%{$searchTerm}%' THEN 1
                WHEN excerpt LIKE '%{$searchTerm}%' THEN 2
                WHEN content LIKE '%{$searchTerm}%' THEN 3
                ELSE 4
            END
        ")->orderByDesc('published_at');

        $news = $query->paginate(12)->withQueryString();

        // Get search suggestions (related terms)
        $suggestions = $this->getSearchSuggestions($searchTerm);

        // Get categories for filtering
        $categories = Cache::remember('search_categories', 3600, function () {
            return News::published()
                ->selectRaw('category, COUNT(*) as count')
                ->groupBy('category')
                ->orderBy('category')
                ->get()
                ->keyBy('category');
        });

        return view('news.search', compact(
            'news', 
            'searchTerm', 
            'suggestions', 
            'categories'
        ));
    }

    public function tag($tag, Request $request)
    {
        $query = News::published()
            ->whereJsonContains('tags', $tag)
            ->with('author');

        // Apply search filter
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'LIKE', "%{$search}%")
                  ->orWhere('content', 'LIKE', "%{$search}%")
                  ->orWhere('excerpt', 'LIKE', "%{$search}%");
            });
        }

        // Sorting
        $sortBy = $request->get('sort', 'latest');
        switch ($sortBy) {
            case 'popular':
                $query->orderByDesc('views_count');
                break;
            case 'oldest':
                $query->orderBy('published_at');
                break;
            case 'title':
                $query->orderBy('title');
                break;
            default: // latest
                $query->orderByDesc('published_at');
        }

        $news = $query->paginate(12)->withQueryString();

        // Get related tags
        $relatedTags = News::published()
            ->whereJsonContains('tags', $tag)
            ->get()
            ->pluck('tags')
            ->flatten()
            ->filter(function($t) use ($tag) {
                return $t !== $tag;
            })
            ->countBy()
            ->sortDesc()
            ->take(10)
            ->keys();

        return view('news.tag', compact('news', 'tag', 'relatedTags'));
    }

    public function archive(Request $request)
    {
        $year = $request->get('year');
        $month = $request->get('month');

        $query = News::published()->with('author');

        if ($year) {
            $query->whereYear('published_at', $year);
            
            if ($month) {
                $query->whereMonth('published_at', $month);
            }
        }

        $news = $query->orderByDesc('published_at')
            ->paginate(12)
            ->withQueryString();

        // Get archive statistics
        $archiveData = News::published()
            ->selectRaw('YEAR(published_at) as year, MONTH(published_at) as month, COUNT(*) as count')
            ->groupBy('year', 'month')
            ->orderByDesc('year')
            ->orderByDesc('month')
            ->get()
            ->groupBy('year');

        return view('news.archive', compact('news', 'archiveData', 'year', 'month'));
    }

    public function rss()
    {
        $news = News::published()
            ->orderByDesc('published_at')
            ->take(20)
            ->get();

        return response()->view('news.rss', compact('news'))
            ->header('Content-Type', 'application/rss+xml; charset=UTF-8');
    }

    public function sitemap()
    {
        $news = News::published()
            ->orderByDesc('published_at')
            ->get(['slug', 'updated_at']);

        return response()->view('news.sitemap', compact('news'))
            ->header('Content-Type', 'text/xml; charset=UTF-8');
    }

    /**
     * Get related search suggestions
     */
    private function getSearchSuggestions($searchTerm)
    {
        // Get articles with similar titles
        $suggestions = News::published()
            ->where('title', 'LIKE', "%{$searchTerm}%")
            ->where('title', '!=', $searchTerm)
            ->pluck('title')
            ->map(function($title) use ($searchTerm) {
                // Extract relevant words from title
                $words = str_word_count(strtolower($title), 1);
                return array_filter($words, function($word) use ($searchTerm) {
                    return strlen($word) > 3 && 
                           stripos($word, $searchTerm) === false &&
                           !in_array($word, ['with', 'your', 'that', 'this', 'from', 'they']);
                });
            })
            ->flatten()
            ->countBy()
            ->sortDesc()
            ->take(5)
            ->keys();

        return $suggestions;
    }

    /**
     * API endpoint for AJAX search
     */
    public function apiSearch(Request $request)
    {
        $request->validate([
            'q' => 'required|string|min:2|max:100',
            'limit' => 'nullable|integer|min:1|max:20'
        ]);

        $searchTerm = $request->get('q');
        $limit = $request->get('limit', 10);

        $news = News::published()
            ->where(function($q) use ($searchTerm) {
                $q->where('title', 'LIKE', "%{$searchTerm}%")
                  ->orWhere('excerpt', 'LIKE', "%{$searchTerm}%");
            })
            ->orderByRaw("
                CASE 
                    WHEN title LIKE '%{$searchTerm}%' THEN 1
                    WHEN excerpt LIKE '%{$searchTerm}%' THEN 2
                    ELSE 3
                END
            ")
            ->take($limit)
            ->get(['id', 'title', 'slug', 'excerpt', 'published_at', 'featured_image']);

        return response()->json([
            'results' => $news->map(function($article) {
                return [
                    'id' => $article->id,
                    'title' => $article->title,
                    'excerpt' => Str::limit($article->excerpt, 100),
                    'url' => route('news.show', $article->slug),
                    'published_at' => $article->published_at->format('M d, Y'),
                    'image' => $article->featured_image_url
                ];
            }),
            'total' => $news->count()
        ]);
    }

    /**
     * Get trending articles
     */
    public function trending()
    {
        $trendingNews = Cache::remember('trending_news', 1800, function () {
            return News::published()
                ->where('published_at', '>=', now()->subDays(7))
                ->orderByDesc('views_count')
                ->take(10)
                ->get();
        });

        return view('news.trending', compact('trendingNews'));
    }

    /**
     * Subscribe to newsletter
     */
    public function subscribe(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:newsletter_subscribers,email',
            'name' => 'nullable|string|max:255'
        ]);

        // Add newsletter subscription logic here
        // This would typically create a newsletter subscriber record

        return response()->json([
            'message' => 'Successfully subscribed to news updates!'
        ]);
    }
}