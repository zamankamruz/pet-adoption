<?php
// File: HomeController.php
// Path: /app/Http/Controllers/HomeController.php

namespace App\Http\Controllers;

use App\Models\Pet;
use App\Models\Category;
use App\Models\Adoption;
use App\Models\Breed;
use App\Models\Location;
use App\Models\News;

use Illuminate\Http\Request;

class HomeController extends Controller
{

 public function index(Request $request)
    {
        $query = Pet::with(['breed', 'category', 'location', 'images'])
            ->available();

        // Apply filters
        if ($request->filled('species')) {
            $query->where('species', $request->species);
        }

        if ($request->filled('breed_id')) {
            $query->where('breed_id', $request->breed_id);
        }

        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        if ($request->filled('size')) {
            $query->whereIn('size', (array) $request->size);
        }

        if ($request->filled('age_min') && $request->filled('age_max')) {
            $query->whereBetween('age_years', [$request->age_min, $request->age_max]);
        }

        if ($request->filled('location_id')) {
            $query->where('location_id', $request->location_id);
        }

        if ($request->filled('good_with_kids')) {
            $query->where('good_with_kids', true);
        }

        if ($request->filled('good_with_pets')) {
            $query->where('good_with_pets', true);
        }

        if ($request->filled('gender')) {
            $query->whereIn('gender', (array) $request->gender);
        }

        if ($request->filled('color')) {
            $query->whereIn('color', (array) $request->color);
        }

        // Sorting
        $sortBy = $request->get('sort', 'latest');
        switch ($sortBy) {
            case 'name':
                $query->orderBy('name');
                break;
            case 'age':
                $query->orderBy('age_years')->orderBy('age_months');
                break;
            case 'featured':
                $query->orderByDesc('is_featured')->orderByDesc('created_at');
                break;
            case 'urgent':
                $query->orderByDesc('is_urgent')->orderByDesc('created_at');
                break;
            default:
                $query->orderByDesc('created_at');
        }

        $pets = $query->paginate(12)->withQueryString();
        
        // Get filter options
        $breeds = Breed::active()->orderBy('name')->get();
        $locations = Location::active()->orderBy('city')->get();
        $categories = Category::active()->orderBy('name')->get();


            // Get dynamic news articles
        $news = News::published()
            ->orderBy('published_at', 'desc')
            ->take(4)
            ->get();



        return view('home.index', compact('pets', 'news', 'breeds', 'locations', 'categories'));
    }

    

    public function catGuides()
    {
        return view('home.care-guide-cats');
    }


    public function dogGuides()
    {
        return view('home.care-guide-dogs'); 
    }


    public function about()
    {
        return view('home.about');
    }

    public function mission()
    {
        return view('home.mission'); 
    }

    public function contact()
    {
        return view('home.contact');
    }

    public function careGuide()
    {
        $categories = Category::active()->with('breeds')->get();
        return view('home.care-guide', compact('categories'));
    }

    public function faqAdopters()
    {
        return view('home.faq-adopters');
    }


    public function subscribeNewsletter(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:newsletter_subscribers'
        ]);

        // Newsletter subscription logic here
        
        return response()->json(['message' => 'Successfully subscribed to newsletter']);
    }

    public function unsubscribeNewsletter($token)
    {
        // Newsletter unsubscription logic here
        return view('home.newsletter-unsubscribed');
    }

    public function sitemap()
    {
        $pets = Pet::available()->get();
        $categories = Category::active()->get();
        
        return response()->view('sitemap', compact('pets', 'categories'))
            ->header('Content-Type', 'text/xml');
    }

    public function robots()
    {
        return response()->view('robots')->header('Content-Type', 'text/plain');
    }
}