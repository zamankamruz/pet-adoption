<?php
// File: AdminAdoptionController.php
// Path: /app/Http/Controllers/Admin/AdminAdoptionController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Adoption;
use App\Models\Pet;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\AdoptionApprovedMail;
use App\Mail\AdoptionRejectedMail;
use App\Mail\AdoptionCompletedMail;
use App\Notifications\AdoptionStatusNotification;

class AdminAdoptionController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'admin']);
    }

    public function index(Request $request)
    {
        $query = Adoption::with(['user', 'pet.breed', 'pet.location', 'pet.images']);

        // Apply filters
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('user_search')) {
            $search = $request->user_search;
            $query->whereHas('user', function($q) use ($search) {
                $q->where('name', 'LIKE', "%{$search}%")
                  ->orWhere('email', 'LIKE', "%{$search}%");
            });
        }

        if ($request->filled('pet_search')) {
            $search = $request->pet_search;
            $query->whereHas('pet', function($q) use ($search) {
                $q->where('name', 'LIKE', "%{$search}%");
            });
        }

        if ($request->filled('date_from')) {
            $query->whereDate('requested_at', '>=', $request->date_from);
        }

        if ($request->filled('date_to')) {
            $query->whereDate('requested_at', '<=', $request->date_to);
        }

        // Sorting
        $sortBy = $request->get('sort', 'latest');
        switch ($sortBy) {
            case 'user_name':
                $query->join('users', 'adoptions.user_id', '=', 'users.id')
                      ->orderBy('users.name')
                      ->select('adoptions.*');
                break;
            case 'pet_name':
                $query->join('pets', 'adoptions.pet_id', '=', 'pets.id')
                      ->orderBy('pets.name')
                      ->select('adoptions.*');
                break;
            case 'oldest':
                $query->orderBy('requested_at');
                break;
            case 'status':
                $query->orderBy('status');
                break;
            default:
                $query->orderByDesc('requested_at');
        }

        $adoptions = $query->paginate(20)->withQueryString();

        $statuses = ['pending', 'approved', 'rejected', 'completed', 'cancelled'];

        return view('admin.adoptions.index', compact('adoptions', 'statuses'));
    }

    public function show(Adoption $adoption)
    {
        $adoption->load(['user', 'pet.breed', 'pet.category', 'pet.location', 'pet.images', 'pet.vaccinations']);
        
        return view('admin.adoptions.show', compact('adoption'));
    }

    public function approve(Request $request, Adoption $adoption)
    {
        if ($adoption->status !== 'pending') {
            return redirect()->back()
                ->with('error', 'Only pending adoptions can be approved.');
        }

        $validated = $request->validate([
            'admin_notes' => 'nullable|string|max:1000'
        ]);

        $adoption->update([
            'status' => 'approved',
            'approved_at' => now(),
            'admin_notes' => $validated['admin_notes'] ?? null
        ]);

        // Update pet status
        $adoption->pet->update(['status' => 'on_hold']);

        // Send notification to user
        try {
            $adoption->user->notify(new AdoptionStatusNotification($adoption));
            Mail::to($adoption->user->email)->send(new AdoptionApprovedMail($adoption));
        } catch (\Exception $e) {
            \Log::error('Failed to send adoption approval notification: ' . $e->getMessage());
        }

        return redirect()->back()
            ->with('success', 'Adoption request approved successfully!');
    }

    public function reject(Request $request, Adoption $adoption)
    {
        if ($adoption->status !== 'pending') {
            return redirect()->back()
                ->with('error', 'Only pending adoptions can be rejected.');
        }

        $validated = $request->validate([
            'rejection_reason' => 'required|string|max:1000',
            'admin_notes' => 'nullable|string|max:1000'
        ]);

        $adoption->update([
            'status' => 'rejected',
            'rejected_at' => now(),
            'rejection_reason' => $validated['rejection_reason'],
            'admin_notes' => $validated['admin_notes'] ?? null
        ]);

        // Send notification to user
        try {
            $adoption->user->notify(new AdoptionStatusNotification($adoption));
            Mail::to($adoption->user->email)->send(new AdoptionRejectedMail($adoption));
        } catch (\Exception $e) {
            \Log::error('Failed to send adoption rejection notification: ' . $e->getMessage());
        }

        return redirect()->back()
            ->with('success', 'Adoption request rejected successfully!');
    }

    public function complete(Request $request, Adoption $adoption)
    {
        if ($adoption->status !== 'approved') {
            return redirect()->back()
                ->with('error', 'Only approved adoptions can be completed.');
        }

        $validated = $request->validate([
            'final_fee' => 'nullable|numeric|min:0',
            'admin_notes' => 'nullable|string|max:1000'
        ]);

        $adoption->update([
            'status' => 'completed',
            'completed_at' => now(),
            'final_fee' => $validated['final_fee'] ?? $adoption->pet->adoption_fee,
            'admin_notes' => $validated['admin_notes'] ?? null
        ]);

        // Update pet status
        $adoption->pet->update(['status' => 'adopted']);

        // Send notification to user
        try {
            $adoption->user->notify(new AdoptionStatusNotification($adoption));
            Mail::to($adoption->user->email)->send(new AdoptionCompletedMail($adoption));
        } catch (\Exception $e) {
            \Log::error('Failed to send adoption completion notification: ' . $e->getMessage());
        }

        return redirect()->back()
            ->with('success', 'Adoption completed successfully!');
    }

    public function cancel(Adoption $adoption)
    {
        if (!in_array($adoption->status, ['pending', 'approved'])) {
            return redirect()->back()
                ->with('error', 'Only pending or approved adoptions can be cancelled.');
        }

        $adoption->update(['status' => 'cancelled']);

        // Reset pet status if it was on hold
        if ($adoption->pet->status === 'on_hold') {
            $adoption->pet->update(['status' => 'available']);
        }

        return redirect()->back()
            ->with('success', 'Adoption cancelled successfully!');
    }

    public function updateNotes(Request $request, Adoption $adoption)
    {
        $validated = $request->validate([
            'admin_notes' => 'required|string|max:1000'
        ]);

        $adoption->update(['admin_notes' => $validated['admin_notes']]);

        if ($request->ajax()) {
            return response()->json(['message' => 'Notes updated successfully']);
        }

        return redirect()->back()
            ->with('success', 'Admin notes updated successfully!');
    }

    public function bulkAction(Request $request)
    {
        $request->validate([
            'action' => 'required|in:approve,reject,complete,cancel,delete',
            'adoption_ids' => 'required|array',
            'adoption_ids.*' => 'exists:adoptions,id'
        ]);

        $adoptions = Adoption::whereIn('id', $request->adoption_ids);
        $count = $adoptions->count();

        switch ($request->action) {
            case 'approve':
                $updated = $adoptions->where('status', 'pending')->update([
                    'status' => 'approved',
                    'approved_at' => now()
                ]);
                
                // Update pet statuses
                $petIds = $adoptions->where('status', 'approved')->pluck('pet_id');
                Pet::whereIn('id', $petIds)->update(['status' => 'on_hold']);
                
                $message = "{$updated} adoptions approved successfully";
                break;
                
            case 'reject':
                $updated = $adoptions->where('status', 'pending')->update([
                    'status' => 'rejected',
                    'rejected_at' => now(),
                    'rejection_reason' => 'Bulk rejection by admin'
                ]);
                $message = "{$updated} adoptions rejected successfully";
                break;
                
            case 'complete':
                $updated = $adoptions->where('status', 'approved')->update([
                    'status' => 'completed',
                    'completed_at' => now()
                ]);
                
                // Update pet statuses
                $petIds = $adoptions->where('status', 'completed')->pluck('pet_id');
                Pet::whereIn('id', $petIds)->update(['status' => 'adopted']);
                
                $message = "{$updated} adoptions completed successfully";
                break;
                
            case 'cancel':
                $updated = $adoptions->whereIn('status', ['pending', 'approved'])->update([
                    'status' => 'cancelled'
                ]);
                $message = "{$updated} adoptions cancelled successfully";
                break;
                
            case 'delete':
                $adoptions->delete();
                $message = "{$count} adoptions deleted successfully";
                break;
        }

        return redirect()->back()->with('success', $message);
    }

    public function export(Request $request)
    {
        $query = Adoption::with(['user', 'pet.breed']);

        // Apply same filters as index
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('date_from')) {
            $query->whereDate('requested_at', '>=', $request->date_from);
        }

        if ($request->filled('date_to')) {
            $query->whereDate('requested_at', '<=', $request->date_to);
        }

        $adoptions = $query->get();

        $csvData = [];
        $csvData[] = [
            'ID', 'Reference', 'User Name', 'User Email', 'Pet Name', 'Pet Breed', 
            'Status', 'Requested Date', 'Approved Date', 'Completed Date', 
            'Final Fee', 'Admin Notes'
        ];

        foreach ($adoptions as $adoption) {
            $csvData[] = [
                $adoption->id,
                $adoption->reference_number,
                $adoption->user->name,
                $adoption->user->email,
                $adoption->pet->name,
                $adoption->pet->breed->name,
                ucfirst($adoption->status),
                $adoption->requested_at->format('Y-m-d H:i:s'),
                $adoption->approved_at ? $adoption->approved_at->format('Y-m-d H:i:s') : '',
                $adoption->completed_at ? $adoption->completed_at->format('Y-m-d H:i:s') : '',
                $adoption->final_fee ? '$' . number_format($adoption->final_fee, 2) : '',
                $adoption->admin_notes
            ];
        }

        $filename = 'adoptions-export-' . now()->format('Y-m-d-H-i-s') . '.csv';

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

    public function statistics()
    {
        $stats = [
            'total' => Adoption::count(),
            'pending' => Adoption::where('status', 'pending')->count(),
            'approved' => Adoption::where('status', 'approved')->count(),
            'completed' => Adoption::where('status', 'completed')->count(),
            'rejected' => Adoption::where('status', 'rejected')->count(),
            'cancelled' => Adoption::where('status', 'cancelled')->count(),
            'this_month' => Adoption::whereMonth('requested_at', now()->month)->count(),
            'this_week' => Adoption::whereBetween('requested_at', [now()->startOfWeek(), now()->endOfWeek()])->count(),
            'today' => Adoption::whereDate('requested_at', today())->count(),
        ];

        // Monthly adoption trends
        $monthlyTrends = Adoption::where('requested_at', '>=', now()->subYear())
            ->selectRaw('MONTH(requested_at) as month, COUNT(*) as count')
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        // Top breeds being adopted
        $topBreeds = Adoption::join('pets', 'adoptions.pet_id', '=', 'pets.id')
            ->join('breeds', 'pets.breed_id', '=', 'breeds.id')
            ->selectRaw('breeds.name as breed, COUNT(*) as count')
            ->where('adoptions.status', 'completed')
            ->groupBy('breeds.id', 'breeds.name')
            ->orderByDesc('count')
            ->take(10)
            ->get();

        return view('admin.adoptions.statistics', compact('stats', 'monthlyTrends', 'topBreeds'));
    }

    public function getApplicationData(Adoption $adoption)
    {
        return response()->json([
            'application_data' => $adoption->application_data,
            'user' => $adoption->user,
            'pet' => $adoption->pet
        ]);
    }
}