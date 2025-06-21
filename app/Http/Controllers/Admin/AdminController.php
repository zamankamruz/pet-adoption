<?php
// File: AdminController.php
// Path: /app/Http/Controllers/Admin/AdminController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pet;
use App\Models\User;
use App\Models\Adoption;
use App\Models\Rehoming;
use App\Models\Contact;
use App\Models\Message;
use App\Models\Category;
use App\Models\Breed;
use App\Models\Location;
use App\Models\News;
use App\Models\Testimonial;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AdminController extends Controller
{

    public function dashboard()
    {
        // Get main statistics
        $stats = [
            'total_pets' => Pet::count(),
            'available_pets' => Pet::available()->count(),
            'adopted_pets' => Pet::where('status', 'adopted')->count(),
            'pending_pets' => Pet::where('status', 'pending')->count(),
            'total_users' => User::where('is_admin', false)->count(),
            'verified_users' => User::where('is_admin', false)->where('is_verified', true)->count(),
            'total_adoptions' => Adoption::count(),
            'pending_adoptions' => Adoption::where('status', 'pending')->count(),
            'approved_adoptions' => Adoption::where('status', 'approved')->count(),
            'completed_adoptions' => Adoption::where('status', 'completed')->count(),
            'total_contacts' => Contact::count(),
            'pending_contacts' => Contact::where('status', 'pending')->count(),
            'rehoming_requests' => Rehoming::count(),
            'pending_rehoming' => Rehoming::where('status', 'pending')->count(),
        ];

        // Monthly adoption trends (last 12 months)
        $adoptionTrends = Adoption::where('status', 'completed')
            ->where('completed_at', '>=', now()->subYear())
            ->selectRaw('MONTH(completed_at) as month, YEAR(completed_at) as year, COUNT(*) as count')
            ->groupBy('year', 'month')
            ->orderBy('year')
            ->orderBy('month')
            ->get();

        // Recent activities
        $recentPets = Pet::with(['breed', 'owner', 'location'])
            ->latest()
            ->take(5)
            ->get();

        $recentAdoptions = Adoption::with(['user', 'pet'])
            ->where('status', 'pending')
            ->latest()
            ->take(5)
            ->get();

        $recentContacts = Contact::where('status', 'pending')
            ->latest()
            ->take(5)
            ->get();

        // Pet statistics by category
        $petsByCategory = Pet::join('categories', 'pets.category_id', '=', 'categories.id')
            ->selectRaw('categories.name as category, COUNT(*) as count')
            ->groupBy('categories.id', 'categories.name')
            ->get();

        // Adoption fee statistics
        $adoptionFeeStats = [
            'average' => Pet::available()->avg('adoption_fee'),
            'min' => Pet::available()->min('adoption_fee'),
            'max' => Pet::available()->max('adoption_fee'),
            'total_potential' => Pet::available()->sum('adoption_fee')
        ];

        return view('admin.dashboard', compact(
            'stats',
            'adoptionTrends', 
            'recentPets', 
            'recentAdoptions', 
            'recentContacts',
            'petsByCategory',
            'adoptionFeeStats'
        ));
    }

    public function analytics()
    {
        // User registration trends
        $userTrends = User::where('is_admin', false)
            ->where('created_at', '>=', now()->subYear())
            ->selectRaw('MONTH(created_at) as month, YEAR(created_at) as year, COUNT(*) as count')
            ->groupBy('year', 'month')
            ->orderBy('year')
            ->orderBy('month')
            ->get();

        // Pet listing trends
        $petTrends = Pet::where('created_at', '>=', now()->subYear())
            ->selectRaw('MONTH(created_at) as month, YEAR(created_at) as year, COUNT(*) as count')
            ->groupBy('year', 'month')
            ->orderBy('year')
            ->orderBy('month')
            ->get();

        // Top breeds
        $topBreeds = Pet::join('breeds', 'pets.breed_id', '=', 'breeds.id')
            ->selectRaw('breeds.name as breed, COUNT(*) as count')
            ->groupBy('breeds.id', 'breeds.name')
            ->orderByDesc('count')
            ->take(10)
            ->get();

        // Adoption success rate by location
        $adoptionsByLocation = Adoption::join('pets', 'adoptions.pet_id', '=', 'pets.id')
            ->join('locations', 'pets.location_id', '=', 'locations.id')
            ->selectRaw('locations.city, locations.state, COUNT(*) as total_adoptions, 
                        SUM(CASE WHEN adoptions.status = "completed" THEN 1 ELSE 0 END) as completed_adoptions')
            ->groupBy('locations.id', 'locations.city', 'locations.state')
            ->having('total_adoptions', '>', 0)
            ->get();

        // Average adoption time
        $averageAdoptionTime = Adoption::where('status', 'completed')
            ->whereNotNull('completed_at')
            ->selectRaw('AVG(DATEDIFF(completed_at, requested_at)) as avg_days')
            ->value('avg_days');

        return view('admin.analytics', compact(
            'userTrends',
            'petTrends',
            'topBreeds',
            'adoptionsByLocation',
            'averageAdoptionTime'
        ));
    }

    public function reports()
    {
        return view('admin.reports');
    }

    public function settings()
    {
        $settings = Setting::all()->keyBy('key');
        
        return view('admin.settings.index', compact('settings'));
    }

    public function updateSettings(Request $request)
    {
        $request->validate([
            'settings' => 'required|array',
        ]);

        foreach ($request->settings as $key => $value) {
            Setting::updateOrCreate(
                ['key' => $key],
                ['value' => $value]
            );
        }

        return redirect()->route('admin.settings.index')
            ->with('success', 'Settings updated successfully!');
    }

    public function breeds()
    {
        $breeds = Breed::with('category')->paginate(20);
        $categories = Category::active()->get();
        
        return view('admin.settings.breeds', compact('breeds', 'categories'));
    }

    public function storeBreed(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'description' => 'nullable|string',
            'characteristics' => 'nullable|array',
            'average_size' => 'nullable|string',
            'life_expectancy' => 'nullable|string',
            'temperament' => 'nullable|string',
        ]);

        Breed::create($request->all());

        return redirect()->route('admin.settings.breeds')
            ->with('success', 'Breed created successfully!');
    }

    public function deleteBreed(Breed $breed)
    {
        if ($breed->pets()->count() > 0) {
            return redirect()->back()
                ->with('error', 'Cannot delete breed that has associated pets.');
        }

        $breed->delete();

        return redirect()->route('admin.settings.breeds')
            ->with('success', 'Breed deleted successfully!');
    }

    public function categories()
    {
        $categories = Category::withCount('pets')->paginate(20);
        
        return view('admin.settings.categories', compact('categories'));
    }

    public function storeCategory(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:categories',
            'description' => 'nullable|string',
            'icon' => 'nullable|string',
            'sort_order' => 'integer|min:0',
        ]);

        Category::create($request->all());

        return redirect()->route('admin.settings.categories')
            ->with('success', 'Category created successfully!');
    }

    public function deleteCategory(Category $category)
    {
        if ($category->pets()->count() > 0) {
            return redirect()->back()
                ->with('error', 'Cannot delete category that has associated pets.');
        }

        $category->delete();

        return redirect()->route('admin.settings.categories')
            ->with('success', 'Category deleted successfully!');
    }

    public function locations()
    {
        $locations = Location::withCount('pets')->paginate(20);
        
        return view('admin.settings.locations', compact('locations'));
    }

    public function storeLocation(Request $request)
    {
        $request->validate([
            'city' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'zip_code' => 'nullable|string|max:10',
            'latitude' => 'nullable|numeric|between:-90,90',
            'longitude' => 'nullable|numeric|between:-180,180',
        ]);

        Location::create($request->all());

        return redirect()->route('admin.settings.locations')
            ->with('success', 'Location created successfully!');
    }

    public function deleteLocation(Location $location)
    {
        if ($location->pets()->count() > 0) {
            return redirect()->back()
                ->with('error', 'Cannot delete location that has associated pets.');
        }

        $location->delete();

        return redirect()->route('admin.settings.locations')
            ->with('success', 'Location deleted successfully!');
    }

    public function pages()
    {
        // Static page management would go here
        return view('admin.content.pages');
    }

    public function news()
    {
        $news = News::with('author')->latest()->paginate(20);
        
        return view('admin.content.news.index', compact('news'));
    }

    public function createNews()
    {
        return view('admin.content.news.create');
    }

    public function storeNews(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:news',
            'excerpt' => 'required|string',
            'content' => 'required|string',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|in:draft,published,archived',
            'tags' => 'nullable|array',
            'published_at' => 'nullable|date',
        ]);

        $data = $request->all();
        $data['author_id'] = auth()->id();

        if ($request->hasFile('featured_image')) {
            $data['featured_image'] = $request->file('featured_image')->store('news', 'public');
        }

        News::create($data);

        return redirect()->route('admin.content.news.index')
            ->with('success', 'News article created successfully!');
    }

    public function testimonials()
    {
        $testimonials = Testimonial::with(['user', 'pet'])->latest()->paginate(20);
        
        return view('admin.content.testimonials', compact('testimonials'));
    }

    public function storeTestimonial(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email',
            'testimonial' => 'required|string',
            'rating' => 'required|integer|min:1|max:5',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_featured' => 'boolean',
            'is_approved' => 'boolean',
        ]);

        $data = $request->all();

        if ($request->hasFile('avatar')) {
            $data['avatar'] = $request->file('avatar')->store('testimonials', 'public');
        }

        Testimonial::create($data);

        return redirect()->route('admin.content.testimonials')
            ->with('success', 'Testimonial created successfully!');
    }

    public function deleteTestimonial(Testimonial $testimonial)
    {
        if ($testimonial->avatar) {
            Storage::disk('public')->delete($testimonial->avatar);
        }

        $testimonial->delete();

        return redirect()->route('admin.content.testimonials')
            ->with('success', 'Testimonial deleted successfully!');
    }

    public function getDashboardData()
    {
        $today = now();
        $lastWeek = now()->subWeek();
        $lastMonth = now()->subMonth();

        $data = [
            'pets' => [
                'total' => Pet::count(),
                'this_week' => Pet::where('created_at', '>=', $lastWeek)->count(),
                'available' => Pet::available()->count(),
                'adopted' => Pet::where('status', 'adopted')->count(),
            ],
            'adoptions' => [
                'total' => Adoption::count(),
                'pending' => Adoption::where('status', 'pending')->count(),
                'this_week' => Adoption::where('created_at', '>=', $lastWeek)->count(),
                'completed' => Adoption::where('status', 'completed')->count(),
            ],
            'users' => [
                'total' => User::where('is_admin', false)->count(),
                'this_week' => User::where('is_admin', false)->where('created_at', '>=', $lastWeek)->count(),
                'verified' => User::where('is_admin', false)->where('is_verified', true)->count(),
            ],
            'contacts' => [
                'total' => Contact::count(),
                'pending' => Contact::where('status', 'pending')->count(),
                'this_week' => Contact::where('created_at', '>=', $lastWeek)->count(),
            ]
        ];

        return response()->json($data);
    }
}