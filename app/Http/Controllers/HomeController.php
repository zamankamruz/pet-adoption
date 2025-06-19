<?php
// File: HomeController.php
// Path: /app/Http/Controllers/HomeController.php

namespace App\Http\Controllers;

use App\Models\Pet;
use App\Models\Category;
use App\Models\Adoption;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $featuredPets = Pet::with(['breed', 'location', 'images'])
            ->available()
            ->featured()
            ->take(4)
            ->get();

        $recentPets = Pet::with(['breed', 'location'])
            ->available()
            ->latest()
            ->take(8)
            ->get();

        $adoptionStats = [
            'total_pets' => Pet::available()->count(),
            'adopted_this_month' => Adoption::completed()
                ->whereMonth('completed_at', now()->month)
                ->count(),
            'happy_families' => Adoption::completed()->count(),
        ];

        return view('home.index', compact('featuredPets', 'recentPets', 'adoptionStats'));
    }

    public function about()
    {
        return view('home.about');
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

    public function faqRehomers()
    {
        return view('home.faq-rehomers');
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