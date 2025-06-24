<?php
// File: AdminUserController.php
// Path: /app/Http/Controllers/Admin/AdminUserController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Adoption;
use App\Models\Pet;
use App\Models\Rehoming;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class AdminUserController extends Controller
{

    public function index(Request $request)
    {
        $query = User::where('is_admin', false);

        // Apply filters
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'LIKE', "%{$search}%")
                  ->orWhere('email', 'LIKE', "%{$search}%")
                  ->orWhere('phone', 'LIKE', "%{$search}%");
            });
        }

        if ($request->filled('is_verified')) {
            $query->where('is_verified', $request->is_verified);
        }

        if ($request->filled('is_active')) {
            $query->where('is_active', $request->is_active);
        }

        if ($request->filled('city')) {
            $query->where('city', 'LIKE', "%{$request->city}%");
        }

        if ($request->filled('state')) {
            $query->where('state', 'LIKE', "%{$request->state}%");
        }

        // Sorting
        $sortBy = $request->get('sort', 'latest');
        switch ($sortBy) {
            case 'name':
                $query->orderBy('name');
                break;
            case 'email':
                $query->orderBy('email');
                break;
            case 'oldest':
                $query->orderBy('created_at');
                break;
            default:
                $query->orderByDesc('created_at');
        }

        $users = $query->withCount(['adoptionRequests', 'pets', 'favorites'])
                      ->paginate(20)
                      ->withQueryString();

        return view('admin.users.index', compact('users'));
    }

    public function show(User $user)
    {
        if ($user->is_admin) {
            abort(403, 'Cannot view admin user details');
        }

        $user->load(['adoptionRequests.pet', 'pets', 'rehomingRequests']);

        $stats = [
            'adoption_requests' => $user->adoptionRequests()->count(),
            'pending_adoptions' => $user->adoptionRequests()->where('status', 'pending')->count(),
            'completed_adoptions' => $user->adoptionRequests()->where('status', 'completed')->count(),
            'pets_listed' => $user->pets()->count(),
            'active_pets' => $user->pets()->available()->count(),
            'favorites' => $user->favorites()->count(),
            'rehoming_requests' => $user->rehomingRequests()->count(),
        ];

        $recentActivity = collect()
            ->merge($user->adoptionRequests()->latest()->take(5)->get()->map(function($adoption) {
                return (object)[
                    'type' => 'adoption_request',
                    'description' => "Requested to adopt {$adoption->pet->name}",
                    'date' => $adoption->requested_at,
                    'status' => $adoption->status
                ];
            }))
            ->merge($user->pets()->latest()->take(5)->get()->map(function($pet) {
                return (object)[
                    'type' => 'pet_listed',
                    'description' => "Listed {$pet->name} for adoption",
                    'date' => $pet->created_at,
                    'status' => $pet->status
                ];
            }))
            ->sortByDesc('date')
            ->take(10);

        return view('admin.users.show', compact('user', 'stats', 'recentActivity'));
    }

    public function edit(User $user)
    {
        if ($user->is_admin) {
            abort(403, 'Cannot edit admin user');
        }

        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        if ($user->is_admin) {
            abort(403, 'Cannot edit admin user');
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => ['required', 'email', Rule::unique('users')->ignore($user->id)],
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:500',
            'city' => 'nullable|string|max:100',
            'state' => 'nullable|string|max:100',
            'zip_code' => 'nullable|string|max:10',
            'bio' => 'nullable|string|max:1000',
            'is_verified' => 'boolean',
            'is_active' => 'boolean',
            'password' => 'nullable|min:8|confirmed',
        ]);

        if ($request->filled('password')) {
            $validated['password'] = Hash::make($request->password);
        } else {
            unset($validated['password']);
        }

        $user->update($validated);

        return redirect()->route('admin.users.show', $user)
            ->with('success', 'User updated successfully!');
    }

    public function destroy(User $user)
    {
        if ($user->is_admin) {
            abort(403, 'Cannot delete admin user');
        }

        // Check if user has pending adoptions
        if ($user->adoptionRequests()->whereIn('status', ['pending', 'approved'])->exists()) {
            return redirect()->back()
                ->with('error', 'Cannot delete user with pending adoption requests.');
        }

        // Check if user has active pets
        if ($user->pets()->available()->exists()) {
            return redirect()->back()
                ->with('error', 'Cannot delete user with active pet listings.');
        }

        // Delete avatar if exists
        if ($user->avatar) {
            Storage::disk('public')->delete($user->avatar);
        }

        $user->delete();

        return redirect()->route('admin.users.index')
            ->with('success', 'User deleted successfully!');
    }

    public function ban(User $user)
    {
        if ($user->is_admin) {
            abort(403, 'Cannot ban admin user');
        }

        $user->update(['is_active' => false]);

        return redirect()->back()
            ->with('success', 'User banned successfully!');
    }

    public function unban(User $user)
    {
        if ($user->is_admin) {
            abort(403, 'Cannot unban admin user');
        }

        $user->update(['is_active' => true]);

        return redirect()->back()
            ->with('success', 'User unbanned successfully!');
    }

    public function verify(User $user)
    {
        if ($user->is_admin) {
            abort(403, 'Cannot verify admin user');
        }

        $user->update([
            'is_verified' => true,
            'email_verified_at' => now()
        ]);

        return redirect()->back()
            ->with('success', 'User verified successfully!');
    }

    public function adoptions(User $user)
    {
        if ($user->is_admin) {
            abort(403, 'Cannot view admin user adoptions');
        }

        $adoptions = $user->adoptionRequests()
            ->with(['pet.breed', 'pet.location'])
            ->latest()
            ->paginate(10);

        return view('admin.users.adoptions', compact('user', 'adoptions'));
    }

    public function pets(User $user)
    {
        if ($user->is_admin) {
            abort(403, 'Cannot view admin user pets');
        }

        $pets = $user->pets()
            ->with(['breed', 'category', 'location'])
            ->latest()
            ->paginate(10);

        return view('admin.users.pets', compact('user', 'pets'));
    }

    public function bulkAction(Request $request)
    {
        $request->validate([
            'action' => 'required|in:delete,ban,unban,verify,unverify',
            'user_ids' => 'required|array',
            'user_ids.*' => 'exists:users,id'
        ]);

        $users = User::whereIn('id', $request->user_ids)->where('is_admin', false);
        $count = $users->count();

        switch ($request->action) {
            case 'delete':
                foreach ($users->get() as $user) {
                    // Check constraints before deleting
                    if (!$user->adoptionRequests()->whereIn('status', ['pending', 'approved'])->exists() &&
                        !$user->pets()->available()->exists()) {
                        $this->destroy($user);
                    }
                }
                $message = "Users deletion process completed";
                break;
                
            case 'ban':
                $users->update(['is_active' => false]);
                $message = "{$count} users banned successfully";
                break;
                
            case 'unban':
                $users->update(['is_active' => true]);
                $message = "{$count} users unbanned successfully";
                break;
                
            case 'verify':
                $users->update(['is_verified' => true, 'email_verified_at' => now()]);
                $message = "{$count} users verified successfully";
                break;
                
            case 'unverify':
                $users->update(['is_verified' => false, 'email_verified_at' => null]);
                $message = "{$count} users unverified successfully";
                break;
        }

        return redirect()->back()->with('success', $message);
    }

    public function export(Request $request)
    {
        $query = User::where('is_admin', false);

        // Apply same filters as index
        if ($request->filled('is_verified')) {
            $query->where('is_verified', $request->is_verified);
        }

        if ($request->filled('is_active')) {
            $query->where('is_active', $request->is_active);
        }

        $users = $query->withCount(['adoptionRequests', 'pets'])->get();

        $csvData = [];
        $csvData[] = [
            'ID', 'Name', 'Email', 'Phone', 'City', 'State', 'Verified', 'Active', 
            'Adoption Requests', 'Pets Listed', 'Joined Date', 'Last Login'
        ];

        foreach ($users as $user) {
            $csvData[] = [
                $user->id,
                $user->name,
                $user->email,
                $user->phone,
                $user->city,
                $user->state,
                $user->is_verified ? 'Yes' : 'No',
                $user->is_active ? 'Yes' : 'No',
                $user->adoption_requests_count,
                $user->pets_count,
                $user->created_at->format('Y-m-d'),
                $user->last_login_at ? $user->last_login_at->format('Y-m-d H:i:s') : 'Never'
            ];
        }

        $filename = 'users-export-' . now()->format('Y-m-d-H-i-s') . '.csv';

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

    public function impersonate(User $user)
    {
        if ($user->is_admin) {
            abort(403, 'Cannot impersonate admin user');
        }

        session(['impersonate' => $user->id]);
        auth()->login($user);

        return redirect()->route('dashboard')
            ->with('warning', 'You are now impersonating ' . $user->name);
    }

    public function stopImpersonating()
    {
        if (!session()->has('impersonate')) {
            return redirect()->route('admin.dashboard');
        }

        session()->forget('impersonate');
        auth()->login(User::where('is_admin', true)->first());

        return redirect()->route('admin.dashboard')
            ->with('success', 'Stopped impersonating user');
    }
}