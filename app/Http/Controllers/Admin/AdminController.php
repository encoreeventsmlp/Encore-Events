<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EventTeam;
use App\Models\Category;
use App\Models\DecorationItem;
use App\Models\ServiceItem;
use App\Models\FoodItem;
use App\Models\TeamMember;
use App\Models\EventEstimation;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        $stats = [
            'event_teams' => EventTeam::count(),
            'categories' => Category::count(),
            'decoration_items' => DecorationItem::count(),
            'service_items' => ServiceItem::count(),
            'food_items' => FoodItem::count(),
            'team_members' => TeamMember::count(),
        ];

        $months = collect(range(5, 0))->map(function ($i) {
            return Carbon::now()->subMonths($i)->startOfMonth();
        });

        $monthlyEstimations = $months->map(function ($month) {
            return EventEstimation::whereBetween('created_at', [$month, (clone $month)->endOfMonth()])->count();
        });

        $monthlyRevenue = $months->map(function ($month) {
            return (float) EventEstimation::whereBetween('created_at', [$month, (clone $month)->endOfMonth()])->sum('total_cost');
        });

        $kpis = [
            'total_clients' => User::where('is_admin', false)->count(),
            'total_estimations' => EventEstimation::count(),
            'revenue_this_month' => (float) EventEstimation::whereMonth('created_at', now()->month)->whereYear('created_at', now()->year)->sum('total_cost'),
            'avg_estimation' => (float) EventEstimation::avg('total_cost') ?: 0,
        ];

        $chartLabels = $months->map(fn($m) => $m->format('M Y'));

        return view('admin.dashboard', compact('stats', 'kpis', 'chartLabels', 'monthlyEstimations', 'monthlyRevenue'));
    }
}
