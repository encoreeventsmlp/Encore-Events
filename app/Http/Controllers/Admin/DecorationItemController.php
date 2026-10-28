<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DecorationItem;
use App\Models\EventTeam;
use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DecorationItemController extends Controller
{
    public function index(Request $request)
    {
        $query = DecorationItem::with(['eventTeams', 'category']);

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

        $decorationItems = $query->paginate(10)->withQueryString();

        $eventTeams = EventTeam::all();
        $categories = Category::where('type', 'decoration')->get();

        return view('admin.decoration-items.index', compact('decorationItems', 'eventTeams', 'categories'));
    }

    public function create()
    {
        $eventTeams = EventTeam::all();
        $categories = Category::where('type', 'decoration')->get();
        $subcategories = Subcategory::whereIn('category_id', $categories->pluck('id'))->orderBy('name')->get();
        return view('admin.decoration-items.create', compact('eventTeams', 'categories', 'subcategories'));
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'title' => 'required|string|max:255',
                'event_team_ids' => 'required|array|min:1',
                'event_team_ids.*' => 'exists:event_teams,id',
                'category_id' => 'required|exists:categories,id',
                'subcategory_id' => 'nullable|exists:subcategories,id',
                'short_description' => 'nullable|string',
                'fixed_amount' => 'required|numeric|min:0',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
            ]);

            $data = $request->only('title', 'category_id', 'subcategory_id', 'short_description', 'fixed_amount');

            if ($request->hasFile('image')) {
                $data['image'] = $request->file('image')->store('decoration-items', 'public');
            }

            $decorationItem = DecorationItem::create($data);
            $decorationItem->eventTeams()->attach($request->event_team_ids);

            return redirect()->route('admin.decoration-items.index')
                ->with('success', 'Decoration item created successfully.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Failed to create decoration item. Please try again.');
        }
    }

    public function show(DecorationItem $decorationItem)
    {
        $decorationItem->load(['eventTeams.districts', 'category']);
        return view('admin.decoration-items.show', compact('decorationItem'));
    }

    public function edit(DecorationItem $decorationItem)
    {
        $decorationItem->load('eventTeams');
        $eventTeams = EventTeam::all();
        $categories = Category::where('type', 'decoration')->get();
        $subcategories = Subcategory::whereIn('category_id', $categories->pluck('id'))->orderBy('name')->get();
        return view('admin.decoration-items.edit', compact('decorationItem', 'eventTeams', 'categories', 'subcategories'));
    }

    public function update(Request $request, DecorationItem $decorationItem)
    {
        try {
            $request->validate([
                'title' => 'required|string|max:255',
                'event_team_ids' => 'required|array|min:1',
                'event_team_ids.*' => 'exists:event_teams,id',
                'category_id' => 'required|exists:categories,id',
                'subcategory_id' => 'nullable|exists:subcategories,id',
                'short_description' => 'nullable|string',
                'fixed_amount' => 'required|numeric|min:0',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
            ]);

            $data = $request->only('title', 'category_id', 'subcategory_id', 'short_description', 'fixed_amount');

            if ($request->hasFile('image')) {
                if ($decorationItem->image) {
                    Storage::disk('public')->delete($decorationItem->image);
                }
                $data['image'] = $request->file('image')->store('decoration-items', 'public');
            }

            $decorationItem->update($data);
            $decorationItem->eventTeams()->sync($request->event_team_ids);

            return redirect()->route('admin.decoration-items.index')
                ->with('success', 'Decoration item updated successfully.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Failed to update decoration item. Please try again.');
        }
    }

    public function destroy(DecorationItem $decorationItem)
    {
        try {
            if ($decorationItem->image) {
                Storage::disk('public')->delete($decorationItem->image);
            }

            $decorationItem->delete();
            return redirect()->route('admin.decoration-items.index')
                ->with('success', 'Decoration item deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Failed to delete decoration item. Please try again.');
        }
    }

    public function restore($id)
    {
        $decorationItem = DecorationItem::withTrashed()->findOrFail($id);
        $decorationItem->restore();

        return redirect()->route('admin.decoration-items.index')
            ->with('success', 'Decoration item restored successfully.');
    }
}
