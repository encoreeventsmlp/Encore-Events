<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\EventEstimation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ClientController extends Controller
{
    public function index(Request $request)
    {
        $query = User::where('is_admin', false)
            ->withCount(['events as estimations_count' => function($query) {
                $query->join('event_estimations', 'events.id', '=', 'event_estimations.event_id');
            }])
            ->with(['events' => function($query) {
                $query->with('eventEstimation')->latest()->take(1);
            }]);

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('phone', 'like', "%{$search}%");
            });
        }

        if ($request->filled('date_from')) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }

        if ($request->filled('date_to')) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }

        $sortBy = $request->get('sort_by', 'created_at');
        $sortOrder = $request->get('sort_order', 'desc');

        $allowedSortFields = ['name', 'email', 'created_at', 'estimations_count'];
        if (in_array($sortBy, $allowedSortFields)) {
            $query->orderBy($sortBy, $sortOrder);
        } else {
            $query->orderBy('created_at', 'desc');
        }

        $clients = $query->paginate(15)->withQueryString();

        $stats = [
            'total_clients' => User::where('is_admin', false)->count(),
            'new_this_month' => User::where('is_admin', false)
                ->whereMonth('created_at', now()->month)
                ->whereYear('created_at', now()->year)
                ->count(),
            'active_clients' => User::where('is_admin', false)
                ->whereHas('events.eventEstimation')
                ->count(),
            'total_estimations' => EventEstimation::count(),
        ];

        return view('admin.clients.index', compact('clients', 'stats'));
    }

public function show($id)
{
    $client = User::where('is_admin', false)
        ->with(['events'])
        ->findOrFail($id);

    $allEstimations = \App\Models\EventEstimation::where('user_id', $id)
        ->with('event')
        ->latest()
        ->get();

    $clientStats = [
        'total_estimations' => $allEstimations->count(),
        'total_spent' => $allEstimations->sum('total_cost'),
        'last_activity' => $allEstimations->first() ? $allEstimations->first()->created_at : $client->created_at,
        'average_estimation' => $allEstimations->count() > 0
            ? $allEstimations->avg('total_cost')
            : 0,
    ];

    $recentEstimations = $allEstimations;

    return view('admin.clients.show', compact('client', 'clientStats', 'recentEstimations'));
}

    public function showEstimation($id)
    {
        $estimation = EventEstimation::with(['user', 'event.district', 'seating'])->findOrFail($id);

        return view('admin.estimations.show', compact('estimation'));
    }
}
