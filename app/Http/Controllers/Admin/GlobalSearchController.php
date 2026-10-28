<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EventTeam;
use App\Models\Category;
use App\Models\DecorationItem;
use App\Models\ServiceItem;
use App\Models\FoodItem;
use Illuminate\Http\Request;

class GlobalSearchController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->get('q', '');

        if (empty($query)) {
            return response()->json([
                'results' => [],
                'total' => 0
            ]);
        }

        $results = [];

        $eventTeams = EventTeam::with('districts')
            ->where('name', 'like', "%{$query}%")
            ->orWhereHas('districts', function($q) use ($query) {
                $q->where('name', 'like', "%{$query}%");
            })
            ->limit(5)
            ->get();

        foreach ($eventTeams as $team) {
            $results[] = [
                'type' => 'Event Team',
                'title' => $team->name,
                'description' => 'Districts: ' . $team->districts->pluck('name')->join(', '),
                'url' => route('admin.event-teams.show', $team),
                'icon' => 'fas fa-users',
                'color' => 'primary'
            ];
        }

        $categories = Category::where('name', 'like', "%{$query}%")
            ->orWhere('type', 'like', "%{$query}%")
            ->limit(5)
            ->get();

        foreach ($categories as $category) {
            $results[] = [
                'type' => 'Category',
                'title' => $category->name,
                'description' => ucfirst($category->type) . ' category',
                'url' => route('admin.categories.show', $category),
                'icon' => $category->type === 'decoration' ? 'fas fa-palette' :
                         ($category->type === 'service' ? 'fas fa-cog' : 'fas fa-utensils'),
                'color' => $category->type === 'decoration' ? 'primary' :
                          ($category->type === 'service' ? 'success' : 'warning')
            ];
        }

        $decorationItems = DecorationItem::with(['eventTeam', 'category'])
            ->where('title', 'like', "%{$query}%")
            ->orWhere('short_description', 'like', "%{$query}%")
            ->orWhereHas('eventTeam', function($q) use ($query) {
                $q->where('name', 'like', "%{$query}%");
            })
            ->limit(5)
            ->get();

        foreach ($decorationItems as $item) {
            $results[] = [
                'type' => 'Decoration Item',
                'title' => $item->title,
                'description' => $item->eventTeam->name . ' - ₹' . number_format($item->fixed_amount, 2),
                'url' => route('admin.decoration-items.show', $item),
                'icon' => 'fas fa-palette',
                'color' => 'primary'
            ];
        }

        $serviceItems = ServiceItem::with(['eventTeam', 'category'])
            ->where('title', 'like', "%{$query}%")
            ->orWhere('short_description', 'like', "%{$query}%")
            ->orWhereHas('eventTeam', function($q) use ($query) {
                $q->where('name', 'like', "%{$query}%");
            })
            ->limit(5)
            ->get();

        foreach ($serviceItems as $item) {
            $results[] = [
                'type' => 'Service Item',
                'title' => $item->title,
                'description' => $item->eventTeam->name . ' - ₹' . number_format($item->fixed_amount, 2),
                'url' => route('admin.service-items.show', $item),
                'icon' => 'fas fa-cog',
                'color' => 'success'
            ];
        }

        $foodItems = FoodItem::with('category')
            ->where('title', 'like', "%{$query}%")
            ->orWhere('short_description', 'like', "%{$query}%")
            ->orWhereHas('category', function($q) use ($query) {
                $q->where('name', 'like', "%{$query}%");
            })
            ->limit(5)
            ->get();

        foreach ($foodItems as $item) {
            $results[] = [
                'type' => 'Food Item',
                'title' => $item->title,
                'description' => $item->category->name . ' - ₹' . number_format($item->amount_per_person, 2) . '/person',
                'url' => route('admin.food-items.show', $item),
                'icon' => 'fas fa-utensils',
                'color' => 'warning'
            ];
        }

        return response()->json([
            'results' => $results,
            'total' => count($results)
        ]);
    }
}
