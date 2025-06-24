<?php
// File: AdminRehomingController.php
// Path: /app/Http/Controllers/Admin/AdminRehomingController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Rehoming;
use App\Models\Pet;
use App\Models\User;
use App\Models\Breed;
use App\Models\Category;
use App\Models\Location;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\RehomingApprovedMail;
use App\Mail\RehomingRejectedMail;
use App\Notifications\RehomingApprovedNotification;
use App\Notifications\RehomingRejectedNotification;

class AdminRehomingController extends Controller
{

    public function index(Request $request)
    {
        $query = Rehoming::with(['user']);

        // Apply filters
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('species')) {
            $query->where('species', $request->species);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('pet_name', 'LIKE', "%{$search}%")
                  ->orWhere('breed', 'LIKE', "%{$search}%")
                  ->orWhere('description', 'LIKE', "%{$search}%")
                  ->orWhereHas('user', function($userQuery) use ($search) {
                      $userQuery->where('name', 'LIKE', "%{$search}%")
                               ->orWhere('email', 'LIKE', "%{$search}%");
                  });
            });
        }

        if ($request->filled('date_from')) {
            $query->whereDate('submitted_at', '>=', $request->date_from);
        }

        if ($request->filled('date_to')) {
            $query->whereDate('submitted_at', '<=', $request->date_to);
        }

        if ($request->filled('user_id')) {
            $query->where('user_id', $request->user_id);
        }

        // Sorting
        $sortBy = $request->get('sort', 'latest');
        switch ($sortBy) {
            case 'pet_name':
                $query->orderBy('pet_name');
                break;
            case 'user_name':
                $query->join('users', 'rehomings.user_id', '=', 'users.id')
                      ->orderBy('users.name')
                      ->select('rehomings.*');
                break;
            case 'status':
                $query->orderBy('status');
                break;
            case 'oldest':
                $query->orderBy('submitted_at');
                break;
            default:
                $query->orderByDesc('submitted_at');
        }

        $rehomings = $query->paginate(20)->withQueryString();

        // Get filter options
        $statuses = ['draft', 'pending', 'approved', 'rejected', 'published', 'completed'];
        $species = Rehoming::distinct()->pluck('species')->filter();

        // Get stats for dashboard cards
        $stats = [
            'total' => Rehoming::count(),
            'pending' => Rehoming::where('status', 'pending')->count(),
            'approved' => Rehoming::where('status', 'approved')->count(),
            'published' => Rehoming::where('status', 'published')->count(),
            'completed' => Rehoming::where('status', 'completed')->count(),
            'today' => Rehoming::whereDate('submitted_at', today())->count(),
            'this_week' => Rehoming::whereBetween('submitted_at', [now()->startOfWeek(), now()->endOfWeek()])->count(),
        ];

        return view('admin.rehoming.index', compact('rehomings', 'statuses', 'species', 'stats'));
    }

    public function show(Rehoming $rehoming)
    {
        $rehoming->load(['user']);
        
        // Get similar pets if this rehoming is published
        $similarPets = collect();
        if ($rehoming->status === 'published') {
            $similarPets = Pet::where('species', $rehoming->species)
                ->where('breed_id', function($query) use ($rehoming) {
                    $query->select('id')
                          ->from('breeds')
                          ->where('name', 'LIKE', "%{$rehoming->breed}%")
                          ->limit(1);
                })
                ->available()
                ->take(3)
                ->get();
        }

        return view('admin.rehoming.show', compact('rehoming', 'similarPets'));
    }

    public function approve(Request $request, Rehoming $rehoming)
    {
        if ($rehoming->status !== 'pending') {
            return redirect()->back()
                ->with('error', 'Only pending rehoming requests can be approved.');
        }

        $rehoming->update([
            'status' => 'approved',
            'approved_at' => now(),
            'admin_notes' => $request->admin_notes
        ]);

        // Send notification to user
        try {
            $rehoming->user->notify(new RehomingApprovedNotification($rehoming));
            Mail::to($rehoming->user->email)->send(new RehomingApprovedMail($rehoming));
        } catch (\Exception $e) {
            \Log::error('Failed to send rehoming approval notification: ' . $e->getMessage());
        }

        return redirect()->back()
            ->with('success', 'Rehoming request approved successfully!');
    }

    public function reject(Request $request, Rehoming $rehoming)
    {
        $request->validate([
            'rejection_reason' => 'required|string|max:1000'
        ]);

        if ($rehoming->status !== 'pending') {
            return redirect()->back()
                ->with('error', 'Only pending rehoming requests can be rejected.');
        }

        $rehoming->update([
            'status' => 'rejected',
            'admin_notes' => $request->rejection_reason
        ]);

        // Send notification to user
        try {
            $rehoming->user->notify(new RehomingRejectedNotification($rehoming, $request->rejection_reason));
            Mail::to($rehoming->user->email)->send(new RehomingRejectedMail($rehoming, $request->rejection_reason));
        } catch (\Exception $e) {
            \Log::error('Failed to send rehoming rejection notification: ' . $e->getMessage());
        }

        return redirect()->back()
            ->with('success', 'Rehoming request rejected successfully!');
    }

    public function publish(Request $request, Rehoming $rehoming)
    {
        if ($rehoming->status !== 'approved') {
            return redirect()->back()
                ->with('error', 'Only approved rehoming requests can be published.');
        }

        // Find or create breed
        $breed = Breed::where('name', 'LIKE', "%{$rehoming->breed}%")->first();
        if (!$breed) {
            // Create a default category if none exists
            $category = Category::where('name', 'LIKE', "%{$rehoming->species}%")->first();
            if (!$category) {
                $category = Category::create([
                    'name' => ucfirst($rehoming->species),
                    'slug' => strtolower($rehoming->species),
                    'description' => ucfirst($rehoming->species) . ' category',
                    'is_active' => true,
                    'sort_order' => 0
                ]);
            }

            $breed = Breed::create([
                'name' => $rehoming->breed,
                'category_id' => $category->id,
                'description' => 'Auto-created breed from rehoming request',
                'is_active' => true
            ]);
        }

        // Find a default location or use the user's location
        $location = Location::first();
        if ($rehoming->user->city && $rehoming->user->state) {
            $userLocation = Location::where('city', $rehoming->user->city)
                ->where('state', $rehoming->user->state)
                ->first();
            if ($userLocation) {
                $location = $userLocation;
            }
        }

        // Parse age
        $ageYears = 0;
        $ageMonths = 0;
        if (preg_match('/(\d+)\s*year/i', $rehoming->age, $matches)) {
            $ageYears = (int) $matches[1];
        }
        if (preg_match('/(\d+)\s*month/i', $rehoming->age, $matches)) {
            $ageMonths = (int) $matches[1];
        }

        // Create pet listing
        $pet = Pet::create([
            'name' => $rehoming->pet_name,
            'species' => $rehoming->species,
            'breed_id' => $breed->id,
            'category_id' => $breed->category_id,
            'age_years' => $ageYears,
            'age_months' => $ageMonths,
            'gender' => $rehoming->gender,
            'size' => $rehoming->size,
            'color' => 'Mixed', // Default since rehoming doesn't have color
            'description' => $rehoming->description,
            'personality' => null,
            'good_with_kids' => $rehoming->good_with_kids,
            'good_with_pets' => $rehoming->good_with_pets,
            'good_with_strangers' => false, // Default
            'energy_level' => 'moderate', // Default
            'training_level' => 'basic', // Default
            'health_status' => 'healthy', // Default
            'special_needs' => $rehoming->special_needs,
            'adoption_fee' => 0, // Default for rehoming
            'status' => 'available',
            'is_featured' => false,
            'is_urgent' => false,
            'owner_id' => $rehoming->user_id,
            'location_id' => $location->id,
            'vaccination_status' => $rehoming->vaccination_status,
            'spayed_neutered' => $rehoming->spayed_neutered,
            'house_trained' => $rehoming->house_trained,
        ]);

        $rehoming->update([
            'status' => 'published',
            'published_at' => now(),
            'admin_notes' => $request->admin_notes
        ]);

        return redirect()->route('admin.pets.show', $pet)
            ->with('success', 'Rehoming request published as pet listing successfully!');
    }

    public function updateStatus(Request $request, Rehoming $rehoming)
    {
        $request->validate([
            'status' => 'required|in:draft,pending,approved,rejected,published,completed'
        ]);

        $rehoming->update(['status' => $request->status]);

        return response()->json([
            'message' => 'Rehoming status updated successfully!',
            'status' => $rehoming->status
        ]);
    }

    public function addNote(Request $request, Rehoming $rehoming)
    {
        $request->validate([
            'admin_notes' => 'required|string|max:2000'
        ]);

        $currentNotes = $rehoming->admin_notes ? $rehoming->admin_notes . "\n\n" : '';
        $newNote = "[" . now()->format('Y-m-d H:i') . " - " . auth()->user()->name . "]\n" . $request->admin_notes;

        $rehoming->update([
            'admin_notes' => $currentNotes . $newNote
        ]);

        return redirect()->back()
            ->with('success', 'Note added successfully!');
    }

    public function destroy(Rehoming $rehoming)
    {
        if (in_array($rehoming->status, ['published', 'completed'])) {
            return redirect()->back()
                ->with('error', 'Cannot delete published or completed rehoming requests.');
        }

        $rehoming->delete();

        return redirect()->route('admin.rehoming.index')
            ->with('success', 'Rehoming request deleted successfully!');
    }

    public function bulkAction(Request $request)
    {
        $request->validate([
            'action' => 'required|in:approve,reject,delete,publish',
            'rehoming_ids' => 'required|array',
            'rehoming_ids.*' => 'exists:rehomings,id',
            'bulk_reason' => 'nullable|string|max:1000'
        ]);

        $rehomings = Rehoming::whereIn('id', $request->rehoming_ids);
        $count = $rehomings->count();

        switch ($request->action) {
            case 'approve':
                $updated = $rehomings->where('status', 'pending')
                    ->update([
                        'status' => 'approved',
                        'approved_at' => now(),
                        'admin_notes' => $request->bulk_reason ?? 'Bulk approval'
                    ]);
                $message = "{$updated} rehoming requests approved successfully";
                break;
                
            case 'reject':
                if (!$request->bulk_reason) {
                    return redirect()->back()
                        ->with('error', 'Rejection reason is required for bulk rejection.');
                }
                
                $updated = $rehomings->where('status', 'pending')
                    ->update([
                        'status' => 'rejected',
                        'admin_notes' => $request->bulk_reason
                    ]);
                $message = "{$updated} rehoming requests rejected successfully";
                break;
                
            case 'delete':
                $deleted = 0;
                foreach ($rehomings->get() as $rehoming) {
                    if (!in_array($rehoming->status, ['published', 'completed'])) {
                        $rehoming->delete();
                        $deleted++;
                    }
                }
                $message = "{$deleted} rehoming requests deleted successfully";
                break;
                
            case 'publish':
                $published = 0;
                foreach ($rehomings->where('status', 'approved')->get() as $rehoming) {
                    try {
                        $this->publishRehoming($rehoming);
                        $published++;
                    } catch (\Exception $e) {
                        \Log::error("Failed to publish rehoming {$rehoming->id}: " . $e->getMessage());
                    }
                }
                $message = "{$published} rehoming requests published successfully";
                break;
        }

        return redirect()->back()->with('success', $message);
    }

    private function publishRehoming(Rehoming $rehoming)
    {
        // Same logic as publish method but without request validation
        $breed = Breed::where('name', 'LIKE', "%{$rehoming->breed}%")->first();
        if (!$breed) {
            $category = Category::where('name', 'LIKE', "%{$rehoming->species}%")->first();
            if (!$category) {
                $category = Category::create([
                    'name' => ucfirst($rehoming->species),
                    'slug' => strtolower($rehoming->species),
                    'description' => ucfirst($rehoming->species) . ' category',
                    'is_active' => true,
                    'sort_order' => 0
                ]);
            }

            $breed = Breed::create([
                'name' => $rehoming->breed,
                'category_id' => $category->id,
                'description' => 'Auto-created breed from rehoming request',
                'is_active' => true
            ]);
        }

        $location = Location::first();
        if ($rehoming->user->city && $rehoming->user->state) {
            $userLocation = Location::where('city', $rehoming->user->city)
                ->where('state', $rehoming->user->state)
                ->first();
            if ($userLocation) {
                $location = $userLocation;
            }
        }

        $ageYears = 0;
        $ageMonths = 0;
        if (preg_match('/(\d+)\s*year/i', $rehoming->age, $matches)) {
            $ageYears = (int) $matches[1];
        }
        if (preg_match('/(\d+)\s*month/i', $rehoming->age, $matches)) {
            $ageMonths = (int) $matches[1];
        }

        Pet::create([
            'name' => $rehoming->pet_name,
            'species' => $rehoming->species,
            'breed_id' => $breed->id,
            'category_id' => $breed->category_id,
            'age_years' => $ageYears,
            'age_months' => $ageMonths,
            'gender' => $rehoming->gender,
            'size' => $rehoming->size,
            'color' => 'Mixed',
            'description' => $rehoming->description,
            'good_with_kids' => $rehoming->good_with_kids,
            'good_with_pets' => $rehoming->good_with_pets,
            'good_with_strangers' => false,
            'energy_level' => 'moderate',
            'training_level' => 'basic',
            'health_status' => 'healthy',
            'special_needs' => $rehoming->special_needs,
            'adoption_fee' => 0,
            'status' => 'available',
            'owner_id' => $rehoming->user_id,
            'location_id' => $location->id,
            'vaccination_status' => $rehoming->vaccination_status,
            'spayed_neutered' => $rehoming->spayed_neutered,
            'house_trained' => $rehoming->house_trained,
        ]);

        $rehoming->update([
            'status' => 'published',
            'published_at' => now()
        ]);
    }

    public function export(Request $request)
    {
        $query = Rehoming::with(['user']);

        // Apply same filters as index
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('species')) {
            $query->where('species', $request->species);
        }

        if ($request->filled('date_from')) {
            $query->whereDate('submitted_at', '>=', $request->date_from);
        }

        if ($request->filled('date_to')) {
            $query->whereDate('submitted_at', '<=', $request->date_to);
        }

        $rehomings = $query->orderByDesc('submitted_at')->get();

        $csvData = [];
        $csvData[] = [
            'ID', 'Pet Name', 'Species', 'Breed', 'Age', 'Gender', 'Size', 
            'Owner Name', 'Owner Email', 'Status', 'Reason for Rehoming', 
            'Good with Kids', 'Good with Pets', 'House Trained', 'Spayed/Neutered',
            'Submitted At', 'Approved At', 'Published At'
        ];

        foreach ($rehomings as $rehoming) {
            $csvData[] = [
                $rehoming->id,
                $rehoming->pet_name,
                $rehoming->species,
                $rehoming->breed,
                $rehoming->age,
                ucfirst($rehoming->gender),
                ucfirst($rehoming->size),
                $rehoming->user->name,
                $rehoming->user->email,
                ucfirst($rehoming->status),
                $rehoming->reason_for_rehoming,
                $rehoming->good_with_kids ? 'Yes' : 'No',
                $rehoming->good_with_pets ? 'Yes' : 'No',
                $rehoming->house_trained ? 'Yes' : 'No',
                $rehoming->spayed_neutered ? 'Yes' : 'No',
                $rehoming->submitted_at ? $rehoming->submitted_at->format('Y-m-d H:i:s') : '',
                $rehoming->approved_at ? $rehoming->approved_at->format('Y-m-d H:i:s') : '',
                $rehoming->published_at ? $rehoming->published_at->format('Y-m-d H:i:s') : ''
            ];
        }

        $filename = 'rehoming-requests-export-' . now()->format('Y-m-d-H-i-s') . '.csv';

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];

        $callback = function() use ($csvData) {
            $file = fopen('php://output', 'w');
            foreach ($csvData as $row) {
                fputcsv($file, $row);
            }
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function getStats()
    {
        $stats = [
            'total' => Rehoming::count(),
            'pending' => Rehoming::where('status', 'pending')->count(),
            'approved' => Rehoming::where('status', 'approved')->count(),
            'rejected' => Rehoming::where('status', 'rejected')->count(),
            'published' => Rehoming::where('status', 'published')->count(),
            'completed' => Rehoming::where('status', 'completed')->count(),
            'today' => Rehoming::whereDate('submitted_at', today())->count(),
            'this_week' => Rehoming::whereBetween('submitted_at', [now()->startOfWeek(), now()->endOfWeek()])->count(),
            'this_month' => Rehoming::whereMonth('submitted_at', now()->month)->count(),
        ];

        return response()->json($stats);
    }
}