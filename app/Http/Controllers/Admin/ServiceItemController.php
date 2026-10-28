<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ServiceItem;
use App\Models\EventTeam;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ServiceItemController extends Controller
{
    public function index(Request $request)
    {
        $query = ServiceItem::with(['eventTeams', 'category']);

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where('title', 'like', "%{$search}%")
                ->orWhere('short_description', 'like', "%{$search}%")
                ->orWhereHas('eventTeams', function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%");
                })
                ->orWhereHas('category', function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%");
                });
        }

        if ($request->filled('event_team_id')) {
            $query->whereHas('eventTeams', function ($q) use ($request) {
                $q->where('event_team_id', $request->event_team_id);
            });
        }

        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        $serviceItems = $query->paginate(10)->withQueryString();

        $eventTeams = EventTeam::all();
        $categories = Category::where('type', 'service')->get();

        return view('admin.service-items.index', compact('serviceItems', 'eventTeams', 'categories'));
    }

    public function create()
    {
        $eventTeams = EventTeam::all();
        $categories = Category::where('type', 'service')->get();
        return view('admin.service-items.create', compact('eventTeams', 'categories'));
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'title' => 'required|string|max:255',
                'event_team_ids' => 'required|array|min:1',
                'event_team_ids.*' => 'exists:event_teams,id',
                'category_id' => 'required|exists:categories,id',
                'short_description' => 'nullable|string',
                'fixed_amount' => 'required|numeric|min:0',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
            ]);

            $data = $request->only('title', 'category_id', 'short_description', 'fixed_amount');

            if ($request->hasFile('image')) {
                $data['image'] = $request->file('image')->store('service-items', 'public');
            }

            $serviceItem = ServiceItem::create($data);
            $serviceItem->eventTeams()->attach($request->event_team_ids);

            return redirect()->route('admin.service-items.index')
                ->with('success', 'Service item created successfully.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Failed to create service item. Please try again.');
        }
    }

    public function show(ServiceItem $serviceItem)
    {
        $serviceItem->load(['eventTeams.districts', 'category']);
        return view('admin.service-items.show', compact('serviceItem'));
    }

    public function edit(ServiceItem $serviceItem)
    {
        $serviceItem->load('eventTeams');
        $eventTeams = EventTeam::all();
        $categories = Category::where('type', 'service')->get();
        return view('admin.service-items.edit', compact('serviceItem', 'eventTeams', 'categories'));
    }

    public function update(Request $request, ServiceItem $serviceItem)
    {
        try {
            $request->validate([
                'title' => 'required|string|max:255',
                'event_team_ids' => 'required|array|min:1',
                'event_team_ids.*' => 'exists:event_teams,id',
                'category_id' => 'required|exists:categories,id',
                'short_description' => 'nullable|string',
                'fixed_amount' => 'required|numeric|min:0',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
            ]);

            $data = $request->only('title', 'category_id', 'short_description', 'fixed_amount');

            if ($request->hasFile('image')) {
                if ($serviceItem->image) {
                    Storage::disk('public')->delete($serviceItem->image);
                }
                $data['image'] = $request->file('image')->store('service-items', 'public');
            }

            $serviceItem->update($data);
            $serviceItem->eventTeams()->sync($request->event_team_ids);

            return redirect()->route('admin.service-items.index')
                ->with('success', 'Service item updated successfully.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Failed to update service item. Please try again.');
        }
    }

    public function destroy(ServiceItem $serviceItem)
    {
        if ($serviceItem->image) {
            Storage::disk('public')->delete($serviceItem->image);
        }

        $serviceItem->delete();
        return redirect()->route('admin.service-items.index')
            ->with('success', 'Service item deleted successfully.');
    }

    public function restore($id)
    {
        $serviceItem = ServiceItem::withTrashed()->findOrFail($id);
        $serviceItem->restore();

        return redirect()->route('admin.service-items.index')
            ->with('success', 'Service item restored successfully.');
    }
}
