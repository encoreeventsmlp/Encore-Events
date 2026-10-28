<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EventTeam;
use App\Models\District;
use Illuminate\Http\Request;

class EventTeamController extends Controller
{
    public function index(Request $request)
    {
        $query = EventTeam::with('districts');

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where('name', 'like', "%{$search}%")
                  ->orWhereHas('districts', function($q) use ($search) {
                      $q->where('name', 'like', "%{$search}%");
                  });
        }

        $eventTeams = $query->paginate(10)->withQueryString();
        return view('admin.event-teams.index', compact('eventTeams'));
    }

    public function create()
    {
        $districts = District::all();
        return view('admin.event-teams.create', compact('districts'));
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'districts' => 'required|array|min:1',
                'districts.*' => 'exists:districts,id'
            ]);

            $eventTeam = EventTeam::create($request->only('name'));
            $eventTeam->districts()->attach($request->districts);

            return redirect()->route('admin.event-teams.index')
                ->with('success', 'Event team created successfully.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Failed to create event team. Please try again.');
        }
    }

    public function show(EventTeam $eventTeam)
    {
        $eventTeam->load('districts', 'decorationItems', 'serviceItems');
        return view('admin.event-teams.show', compact('eventTeam'));
    }

    public function edit(EventTeam $eventTeam)
    {
        $districts = District::all();
        $eventTeam->load('districts');
        return view('admin.event-teams.edit', compact('eventTeam', 'districts'));
    }

    public function update(Request $request, EventTeam $eventTeam)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'districts' => 'required|array|min:1',
                'districts.*' => 'exists:districts,id'
            ]);

            $eventTeam->update($request->only('name'));
            $eventTeam->districts()->sync($request->districts);

            return redirect()->route('admin.event-teams.index')
                ->with('success', 'Event team updated successfully.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Failed to update event team. Please try again.');
        }
    }

    public function destroy(EventTeam $eventTeam)
    {
        try {
            $eventTeam->delete();
            return redirect()->route('admin.event-teams.index')
                ->with('success', 'Event team deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Failed to delete event team. Please try again.');
        }
    }

    public function restore($id)
    {
        $eventTeam = EventTeam::withTrashed()->findOrFail($id);
        $eventTeam->restore();

        return redirect()->route('admin.event-teams.index')
            ->with('success', 'Event team restored successfully.');
    }
}
