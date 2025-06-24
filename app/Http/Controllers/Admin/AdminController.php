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

    try {
        DB::beginTransaction();
        
        foreach ($request->settings as $key => $value) {
            Setting::updateOrCreate(
                ['key' => $key],
                [
                    'value' => $value,
                    'type' => $this->getSettingType($value),
                    'group' => $this->getSettingGroup($key)
                ]
            );
        }
        
        DB::commit();
        
        // Clear settings cache
        Cache::forget('app_settings');
        
        return redirect()->route('admin.settings.index')
            ->with('success', 'Settings updated successfully!');
            
    } catch (\Exception $e) {
        DB::rollback();
        Log::error('Settings update failed: ' . $e->getMessage());
        
        return redirect()->back()
            ->with('error', 'Failed to update settings. Please try again.')
            ->withInput();
    }
}

private function getSettingType($value)
{
    if (is_bool($value) || in_array($value, ['0', '1', 'true', 'false'])) {
        return 'boolean';
    } elseif (is_numeric($value)) {
        return 'number';
    } elseif (is_array($value)) {
        return 'json';
    } else {
        return 'string';
    }
}

private function getSettingGroup($key)
{
    $groups = [
        'app_' => 'general',
        'site_' => 'site',
        'adoption_' => 'adoption',
        'email_' => 'email',
        'upload_' => 'uploads',
        'notify_' => 'notifications',
        'security_' => 'security',
        'maintenance_' => 'maintenance',
    ];
    
    foreach ($groups as $prefix => $group) {
        if (strpos($key, $prefix) === 0) {
            return $group;
        }
    }
    
    return 'general';
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