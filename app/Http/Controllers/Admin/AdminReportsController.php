<?php
// File: AdminReportsController.php
// Path: /app/Http/Controllers/Admin/AdminReportsController.php

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
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;

class AdminReportsController extends Controller
{

    public function index()
    {
        return view('admin.reports.index');
    }

    public function getData(Request $request)
    {
        $startDate = $request->get('start', now()->subDays(30));
        $endDate = $request->get('end', now());
        
        try {
            $data = [
                // Quick stats
                'totalPets' => Pet::count(),
                'totalAdoptions' => Adoption::where('status', 'completed')->count(),
                'activeUsers' => User::where('is_active', true)->where('last_login_at', '>=', now()->subDays(30))->count(),
                'totalRevenue' => Adoption::where('status', 'completed')->sum('final_fee'),
                
                // Growth percentages
                'petsGrowth' => $this->calculateGrowth('pets', $startDate, $endDate),
                'adoptionsGrowth' => $this->calculateGrowth('adoptions', $startDate, $endDate),
                'userEngagement' => $this->calculateUserEngagement(),
                'revenueGrowth' => $this->calculateGrowth('revenue', $startDate, $endDate),
                
                // Chart data
                'adoptionTrends' => $this->getAdoptionTrends($startDate, $endDate),
                'categoriesData' => $this->getCategoriesData(),
                
                // Additional metrics
                'availablePets' => Pet::available()->count(),
                'adoptedThisMonth' => Adoption::where('status', 'completed')
                    ->whereMonth('completed_at', now()->month)
                    ->count(),
                'avgAdoptionTime' => $this->getAverageAdoptionTime(),
            ];
            
            return response()->json($data);
            
        } catch (\Exception $e) {
            \Log::error('Reports data error: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to load report data'], 500);
        }
    }

    public function getChartData(Request $request)
    {
        $period = $request->get('period', 'monthly');
        $startDate = $request->get('start', now()->subDays(30));
        $endDate = $request->get('end', now());
        
        return response()->json([
            'adoptionTrends' => $this->getAdoptionTrends($startDate, $endDate, $period),
            'categoriesData' => $this->getCategoriesData(),
        ]);
    }

    public function getPetsData(Request $request)
    {
        $query = Pet::with(['breed', 'category', 'location', 'owner'])
            ->select(['id', 'name', 'species', 'breed_id', 'category_id', 'age_years', 'age_months', 'status', 'created_at', 'views_count'])
            ->withCount('adoptionRequests as inquiries_count');

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('species')) {
            $query->where('species', $request->species);
        }

        $pets = $query->latest()->paginate(50);

        return response()->json([
            'data' => $pets->items(),
            'pagination' => [
                'current_page' => $pets->currentPage(),
                'last_page' => $pets->lastPage(),
                'per_page' => $pets->perPage(),
                'total' => $pets->total()
            ]
        ]);
    }

    public function getAdoptionsData(Request $request)
    {
        $data = [
            'totalAdoptions' => Adoption::count(),
            'pendingAdoptions' => Adoption::where('status', 'pending')->count(),
            'successRate' => $this->getAdoptionSuccessRate(),
            'avgProcessTime' => $this->getAverageProcessTime(),
            'statusDistribution' => $this->getAdoptionStatusDistribution(),
            'monthlyTrend' => $this->getMonthlyAdoptionTrend(),
        ];

        return response()->json($data);
    }

    public function getUsersData(Request $request)
    {
        $data = [
            'totalUsers' => User::where('is_admin', false)->count(),
            'activeUsers' => User::where('is_active', true)->where('last_login_at', '>=', now()->subDays(30))->count(),
            'newUsersMonth' => User::whereMonth('created_at', now()->month)->count(),
            'verifiedUsers' => User::where('is_verified', true)->count(),
            'registrationTrend' => $this->getUserRegistrationTrend(),
            'activityData' => $this->getUserActivityData(),
        ];

        return response()->json($data);
    }

    public function getFinancialData(Request $request)
    {
        $data = [
            'totalRevenue' => Adoption::where('status', 'completed')->sum('final_fee'),
            'monthlyRevenue' => Adoption::where('status', 'completed')
                ->whereMonth('completed_at', now()->month)
                ->sum('final_fee'),
            'avgAdoptionFee' => Adoption::where('status', 'completed')->avg('final_fee'),
            'totalTransactions' => Adoption::where('status', 'completed')->count(),
            'revenueTrend' => $this->getRevenueTrend(),
            'feeDistribution' => $this->getFeeDistribution(),
        ];

        return response()->json($data);
    }

    public function getPerformanceData(Request $request)
    {
        $data = [
            'databasePerformance' => $this->getDatabasePerformance(),
            'serverResponse' => $this->getServerResponseTime(),
            'storageUsage' => $this->getStorageUsage(),
            'topPages' => $this->getTopPages(),
            'errorRate' => $this->getErrorRate(),
        ];

        return response()->json($data);
    }

    public function export(Request $request)
    {
        $type = $request->get('type', 'pdf');
        $startDate = $request->get('start', now()->subDays(30));
        $endDate = $request->get('end', now());
        
        $data = $this->getExportData($startDate, $endDate);
        
        switch ($type) {
            case 'pdf':
                return $this->exportPDF($data);
            case 'excel':
                return $this->exportExcel($data);
            case 'csv':
                return $this->exportCSV($data);
            default:
                return redirect()->back()->with('error', 'Invalid export type');
        }
    }

    // Private helper methods

    private function calculateGrowth($type, $startDate, $endDate)
    {
        $currentPeriodStart = Carbon::parse($startDate);
        $currentPeriodEnd = Carbon::parse($endDate);
        $previousPeriodStart = $currentPeriodStart->copy()->subDays($currentPeriodEnd->diffInDays($currentPeriodStart));
        $previousPeriodEnd = $currentPeriodStart->copy();

        switch ($type) {
            case 'pets':
                $current = Pet::whereBetween('created_at', [$currentPeriodStart, $currentPeriodEnd])->count();
                $previous = Pet::whereBetween('created_at', [$previousPeriodStart, $previousPeriodEnd])->count();
                break;
            case 'adoptions':
                $current = Adoption::where('status', 'completed')
                    ->whereBetween('completed_at', [$currentPeriodStart, $currentPeriodEnd])->count();
                $previous = Adoption::where('status', 'completed')
                    ->whereBetween('completed_at', [$previousPeriodStart, $previousPeriodEnd])->count();
                break;
            case 'revenue':
                $current = Adoption::where('status', 'completed')
                    ->whereBetween('completed_at', [$currentPeriodStart, $currentPeriodEnd])->sum('final_fee');
                $previous = Adoption::where('status', 'completed')
                    ->whereBetween('completed_at', [$previousPeriodStart, $previousPeriodEnd])->sum('final_fee');
                break;
            default:
                return 0;
        }

        if ($previous == 0) {
            return $current > 0 ? 100 : 0;
        }

        return round((($current - $previous) / $previous) * 100, 1);
    }

    private function calculateUserEngagement()
    {
        $totalUsers = User::where('is_admin', false)->count();
        $activeUsers = User::where('is_active', true)
            ->where('last_login_at', '>=', now()->subDays(30))
            ->count();

        if ($totalUsers == 0) {
            return 0;
        }

        return round(($activeUsers / $totalUsers) * 100, 1);
    }

    private function getAdoptionTrends($startDate, $endDate, $period = 'daily')
    {
        $format = $period === 'monthly' ? '%Y-%m' : ($period === 'weekly' ? '%Y-%u' : '%Y-%m-%d');
        
        $adoptions = Adoption::where('status', 'completed')
            ->whereBetween('completed_at', [$startDate, $endDate])
            ->selectRaw("DATE_FORMAT(completed_at, '{$format}') as date, COUNT(*) as count")
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        return [
            'labels' => $adoptions->pluck('date')->toArray(),
            'data' => $adoptions->pluck('count')->toArray()
        ];
    }

    private function getCategoriesData()
    {
        $categories = Pet::join('categories', 'pets.category_id', '=', 'categories.id')
            ->selectRaw('categories.name as category, COUNT(*) as count')
            ->groupBy('categories.id', 'categories.name')
            ->get();

        return $categories->pluck('count')->toArray();
    }

    private function getAverageAdoptionTime()
    {
        $avgDays = Adoption::where('status', 'completed')
            ->whereNotNull('completed_at')
            ->selectRaw('AVG(DATEDIFF(completed_at, requested_at)) as avg_days')
            ->value('avg_days');

        return round($avgDays ?? 0);
    }

    private function getAdoptionSuccessRate()
    {
        $total = Adoption::count();
        $successful = Adoption::where('status', 'completed')->count();

        if ($total == 0) {
            return 0;
        }

        return round(($successful / $total) * 100, 1);
    }

    private function getAverageProcessTime()
    {
        $avgDays = Adoption::where('status', 'completed')
            ->whereNotNull('completed_at')
            ->whereNotNull('approved_at')
            ->selectRaw('AVG(DATEDIFF(completed_at, approved_at)) as avg_days')
            ->value('avg_days');

        return round($avgDays ?? 0);
    }

    private function getAdoptionStatusDistribution()
    {
        return Adoption::selectRaw('status, COUNT(*) as count')
            ->groupBy('status')
            ->pluck('count', 'status')
            ->toArray();
    }

    private function getMonthlyAdoptionTrend()
    {
        $months = collect();
        for ($i = 11; $i >= 0; $i--) {
            $month = now()->subMonths($i);
            $count = Adoption::where('status', 'completed')
                ->whereYear('completed_at', $month->year)
                ->whereMonth('completed_at', $month->month)
                ->count();
            
            $months->push([
                'month' => $month->format('M Y'),
                'count' => $count
            ]);
        }

        return [
            'labels' => $months->pluck('month')->toArray(),
            'data' => $months->pluck('count')->toArray()
        ];
    }

    private function getUserRegistrationTrend()
    {
        $months = collect();
        for ($i = 11; $i >= 0; $i--) {
            $month = now()->subMonths($i);
            $count = User::where('is_admin', false)
                ->whereYear('created_at', $month->year)
                ->whereMonth('created_at', $month->month)
                ->count();
            
            $months->push([
                'month' => $month->format('M Y'),
                'count' => $count
            ]);
        }

        return [
            'labels' => $months->pluck('month')->toArray(),
            'data' => $months->pluck('count')->toArray()
        ];
    }

    private function getUserActivityData()
    {
        $active = User::where('last_login_at', '>=', now()->subDays(7))->count();
        $inactive = User::where('last_login_at', '<', now()->subDays(7))
            ->orWhereNull('last_login_at')->count();

        return [
            'labels' => ['Active', 'Inactive'],
            'data' => [$active, $inactive]
        ];
    }

    private function getRevenueTrend()
    {
        $months = collect();
        for ($i = 11; $i >= 0; $i--) {
            $month = now()->subMonths($i);
            $revenue = Adoption::where('status', 'completed')
                ->whereYear('completed_at', $month->year)
                ->whereMonth('completed_at', $month->month)
                ->sum('final_fee');
            
            $months->push([
                'month' => $month->format('M Y'),
                'revenue' => $revenue
            ]);
        }

        return [
            'labels' => $months->pluck('month')->toArray(),
            'data' => $months->pluck('revenue')->toArray()
        ];
    }

    private function getFeeDistribution()
    {
        $ranges = [
            '0-50' => Adoption::where('status', 'completed')->whereBetween('final_fee', [0, 50])->count(),
            '51-100' => Adoption::where('status', 'completed')->whereBetween('final_fee', [51, 100])->count(),
            '101-200' => Adoption::where('status', 'completed')->whereBetween('final_fee', [101, 200])->count(),
            '201+' => Adoption::where('status', 'completed')->where('final_fee', '>', 200)->count(),
        ];

        return [
            'labels' => array_keys($ranges),
            'data' => array_values($ranges)
        ];
    }

    private function getDatabasePerformance()
    {
        try {
            $start = microtime(true);
            DB::select('SELECT 1');
            $queryTime = (microtime(true) - $start) * 1000;
            
            if ($queryTime < 10) {
                return ['status' => 'excellent', 'score' => 95];
            } elseif ($queryTime < 50) {
                return ['status' => 'good', 'score' => 85];
            } elseif ($queryTime < 100) {
                return ['status' => 'fair', 'score' => 70];
            } else {
                return ['status' => 'poor', 'score' => 50];
            }
        } catch (\Exception $e) {
            return ['status' => 'error', 'score' => 0];
        }
    }

    private function getServerResponseTime()
    {
        // Simulate server response time check
        return ['time' => rand(50, 200), 'status' => 'good'];
    }

    private function getStorageUsage()
    {
        try {
            $totalSpace = disk_total_space(storage_path());
            $freeSpace = disk_free_space(storage_path());
            $usedSpace = $totalSpace - $freeSpace;
            $percentage = ($usedSpace / $totalSpace) * 100;

            return [
                'used' => round($percentage, 1),
                'free' => round(100 - $percentage, 1),
                'total_gb' => round($totalSpace / (1024**3), 2),
                'used_gb' => round($usedSpace / (1024**3), 2)
            ];
        } catch (\Exception $e) {
            return ['used' => 0, 'free' => 100, 'total_gb' => 0, 'used_gb' => 0];
        }
    }

    private function getTopPages()
    {
        // This would integrate with your analytics service
        return [
            ['page' => '/pets', 'views' => 15420, 'bounce_rate' => 25],
            ['page' => '/adoption', 'views' => 8945, 'bounce_rate' => 30],
            ['page' => '/', 'views' => 12350, 'bounce_rate' => 40],
            ['page' => '/about', 'views' => 3200, 'bounce_rate' => 60],
        ];
    }

    private function getErrorRate()
    {
        // This would check your error logs
        return ['rate' => 0.5, 'total_errors' => 12];
    }

    private function getExportData($startDate, $endDate)
    {
        return [
            'period' => [
                'start' => $startDate,
                'end' => $endDate
            ],
            'summary' => [
                'total_pets' => Pet::count(),
                'total_adoptions' => Adoption::where('status', 'completed')->count(),
                'total_users' => User::where('is_admin', false)->count(),
                'total_revenue' => Adoption::where('status', 'completed')->sum('final_fee'),
            ],
            'pets' => Pet::with(['breed', 'category', 'location'])
                ->whereBetween('created_at', [$startDate, $endDate])
                ->get(),
            'adoptions' => Adoption::with(['user', 'pet'])
                ->whereBetween('created_at', [$startDate, $endDate])
                ->get(),
            'revenue_by_month' => $this->getRevenueTrend(),
        ];
    }

    private function exportPDF($data)
    {
        $pdf = PDF::loadView('admin.reports.pdf', $data);
        return $pdf->download('furry-friends-report-' . now()->format('Y-m-d') . '.pdf');
    }

    private function exportExcel($data)
    {
        return Excel::download(new ReportsExport($data), 'furry-friends-report-' . now()->format('Y-m-d') . '.xlsx');
    }

    private function exportCSV($data)
    {
        $filename = 'furry-friends-report-' . now()->format('Y-m-d') . '.csv';
        
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];

        $callback = function() use ($data) {
            $file = fopen('php://output', 'w');
            
            // Write headers
            fputcsv($file, ['Report Period', $data['period']['start'] . ' to ' . $data['period']['end']]);
            fputcsv($file, []);
            
            // Write summary
            fputcsv($file, ['Summary']);
            fputcsv($file, ['Total Pets', $data['summary']['total_pets']]);
            fputcsv($file, ['Total Adoptions', $data['summary']['total_adoptions']]);
            fputcsv($file, ['Total Users', $data['summary']['total_users']]);
            fputcsv($file, ['Total Revenue', '$' . number_format($data['summary']['total_revenue'], 2)]);
            fputcsv($file, []);
            
            // Write pets data
            fputcsv($file, ['Pets']);
            fputcsv($file, ['Name', 'Species', 'Breed', 'Status', 'Created At']);
            foreach ($data['pets'] as $pet) {
                fputcsv($file, [
                    $pet->name,
                    $pet->species,
                    $pet->breed->name,
                    $pet->status,
                    $pet->created_at->format('Y-m-d')
                ]);
            }
            
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}