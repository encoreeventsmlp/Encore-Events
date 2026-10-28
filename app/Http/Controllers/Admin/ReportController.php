<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EventEstimation;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function estimationReport(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $estimationsQuery = EventEstimation::with(['user', 'event']);

        if ($startDate && $endDate) {
            $estimationsQuery->whereBetween('created_at', [$startDate, $endDate]);
        }

        $estimations = $estimationsQuery->latest()->get();

        $stats = [
            'total_estimations' => $estimations->count(),
            'total_revenue' => $estimations->sum('total_cost'),
            'average_estimation' => $estimations->avg('total_cost') ?? 0,
            'total_guests' => $estimations->sum('guest_count'),
            'with_catering' => $estimations->where('catering_boys', true)->count(),
            'catering_revenue' => $estimations->sum('catering_boys_cost'),
        ];

        $monthlyQuery = EventEstimation::select(
            DB::raw('DATE_FORMAT(created_at, "%Y-%m") as month'),
            DB::raw('COUNT(*) as count'),
            DB::raw('SUM(total_cost) as revenue')
        );

        if ($startDate && $endDate) {
            $monthlyQuery->whereBetween('created_at', [$startDate, $endDate]);
        }

        $monthlyData = $monthlyQuery->groupBy('month')
            ->orderBy('month', 'desc')
            ->get();

        $topClientsQuery = EventEstimation::select('user_id', DB::raw('SUM(total_cost) as total_spent'), DB::raw('COUNT(*) as estimation_count'));

        if ($startDate && $endDate) {
            $topClientsQuery->whereBetween('created_at', [$startDate, $endDate]);
        }

        $topClients = $topClientsQuery->groupBy('user_id')
            ->orderBy('total_spent', 'desc')
            ->limit(10)
            ->with('user')
            ->get();

        $categoryStats = [
            'total_food_cost' => $estimations->sum('food_cost'),
            'total_decoration_cost' => $estimations->sum('decoration_cost'),
            'total_service_cost' => $estimations->sum('service_cost'),
        ];

        $recentEstimationsQuery = EventEstimation::with(['user', 'event']);

        if ($startDate && $endDate) {
            $recentEstimationsQuery->whereBetween('created_at', [$startDate, $endDate]);
        }

        $recentEstimations = $recentEstimationsQuery->latest()->paginate(20);

        return view('admin.reports.estimations', compact(
            'stats',
            'monthlyData',
            'topClients',
            'categoryStats',
            'recentEstimations',
            'startDate',
            'endDate'
        ));
    }
}
