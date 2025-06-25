<?php
// File: AdminNewsController.php
// Path: /app/Http/Controllers/Admin/AdminNewsController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AdminNewsController extends Controller
{


    public function index(Request $request)
    {
        $query = News::with('author');

        // Apply filters
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'LIKE', "%{$search}%")
                  ->orWhere('content', 'LIKE', "%{$search}%");
            });
        }

        // Sorting
        $sortBy = $request->get('sort', 'latest');
        switch ($sortBy) {
            case 'title':
                $query->orderBy('title');
                break;
            case 'views':
                $query->orderByDesc('views_count');
                break;
            case 'oldest':
                $query->orderBy('created_at');
                break;
            default:
                $query->orderByDesc('created_at');
        }

        $news = $query->paginate(20)->withQueryString();

        $categories = ['general', 'dog', 'cat', 'health', 'training', 'nutrition'];
        $statuses = ['draft', 'published', 'archived'];

        return view('admin.news.index', compact('news', 'categories', 'statuses'));
    }

    public function create()
    {
        $categories = ['general', 'dog', 'cat', 'health', 'training', 'nutrition'];
        return view('admin.news.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'excerpt' => 'nullable|string|max:500',
            'content' => 'required|string',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|in:draft,published,archived',
            'category' => 'required|string',
            'tags' => 'nullable|string',
            'published_at' => 'nullable|date',
        ]);

        $validated['author_id'] = auth()->id();
        $validated['slug'] = Str::slug($validated['title']);

        if ($request->hasFile('featured_image')) {
            $validated['featured_image'] = $request->file('featured_image')->store('news', 'public');
        }

        if ($validated['status'] === 'published' && !$validated['published_at']) {
            $validated['published_at'] = now();
        }

        if ($request->filled('tags')) {
            $validated['tags'] = array_map('trim', explode(',', $request->tags));
        }

        $news = News::create($validated);

        return redirect()->route('admin.news.index')
            ->with('success', 'News article created successfully!');
    }

    public function show(News $news)
    {
        $news->load('author');
        return view('admin.news.show', compact('news'));
    }

    public function edit(News $news)
    {
        $categories = ['general', 'dog', 'cat', 'health', 'training', 'nutrition'];
        return view('admin.news.edit', compact('news', 'categories'));
    }

    public function update(Request $request, News $news)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'excerpt' => 'nullable|string|max:500',
            'content' => 'required|string',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|in:draft,published,archived',
            'category' => 'required|string',
            'tags' => 'nullable|string',
            'published_at' => 'nullable|date',
        ]);

        $validated['slug'] = Str::slug($validated['title']);

        if ($request->hasFile('featured_image')) {
            if ($news->featured_image) {
                Storage::disk('public')->delete($news->featured_image);
            }
            $validated['featured_image'] = $request->file('featured_image')->store('news', 'public');
        }

        if ($validated['status'] === 'published' && !$news->published_at && !$validated['published_at']) {
            $validated['published_at'] = now();
        }

        if ($request->filled('tags')) {
            $validated['tags'] = array_map('trim', explode(',', $request->tags));
        }

        $news->update($validated);

        return redirect()->route('admin.news.index')
            ->with('success', 'News article updated successfully!');
    }

    public function destroy(News $news)
    {
        if ($news->featured_image) {
            Storage::disk('public')->delete($news->featured_image);
        }

        $news->delete();

        return redirect()->route('admin.news.index')
            ->with('success', 'News article deleted successfully!');
    }

    public function bulkAction(Request $request)
    {
        $request->validate([
            'action' => 'required|in:delete,publish,draft,archive',
            'news_ids' => 'required|array',
            'news_ids.*' => 'exists:news,id'
        ]);

        $news = News::whereIn('id', $request->news_ids);
        $count = $news->count();

        switch ($request->action) {
            case 'delete':
                foreach ($news->get() as $article) {
                    if ($article->featured_image) {
                        Storage::disk('public')->delete($article->featured_image);
                    }
                }
                $news->delete();
                $message = "{$count} articles deleted successfully";
                break;
                
            case 'publish':
                $news->update(['status' => 'published', 'published_at' => now()]);
                $message = "{$count} articles published successfully";
                break;
                
            case 'draft':
                $news->update(['status' => 'draft']);
                $message = "{$count} articles moved to draft";
                break;
                
            case 'archive':
                $news->update(['status' => 'archived']);
                $message = "{$count} articles archived successfully";
                break;
        }

        return redirect()->back()->with('success', $message);
    }
}