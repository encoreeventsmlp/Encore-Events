<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FoodItem;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FoodItemController extends Controller
{
    public function index(Request $request)
    {
        $query = FoodItem::with('category');

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where('title', 'like', "%{$search}%")
                  ->orWhere('short_description', 'like', "%{$search}%")
                  ->orWhereHas('category', function($q) use ($search) {
                      $q->where('name', 'like', "%{$search}%");
                  });
        }

        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        if ($request->filled('min_price')) {
            $query->where('amount_per_person', '>=', $request->min_price);
        }

        if ($request->filled('max_price')) {
            $query->where('amount_per_person', '<=', $request->max_price);
        }

        $foodItems = $query->paginate(10)->withQueryString();

        $categories = Category::where('type', 'food')->get();

        return view('admin.food-items.index', compact('foodItems', 'categories'));
    }

    public function create()
    {
        $categories = Category::where('type', 'food')->get();
        return view('admin.food-items.create', compact('categories'));
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'title' => 'required|string|max:255',
                'category_id' => 'required|exists:categories,id',
                'short_description' => 'nullable|string',
                'amount_per_person' => 'required|numeric|min:0',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
            ]);

            $data = $request->only('title', 'category_id', 'short_description', 'amount_per_person');

            if ($request->hasFile('image')) {
                $data['image'] = $request->file('image')->store('food-items', 'public');
            }

            FoodItem::create($data);

            return redirect()->route('admin.food-items.index')
                ->with('success', 'Food item created successfully.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Failed to create food item. Please try again.');
        }
    }

    public function show(FoodItem $foodItem)
    {
        $foodItem->load('category');
        return view('admin.food-items.show', compact('foodItem'));
    }

    public function edit(FoodItem $foodItem)
    {
        $categories = Category::where('type', 'food')->get();
        return view('admin.food-items.edit', compact('foodItem', 'categories'));
    }

    public function update(Request $request, FoodItem $foodItem)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'short_description' => 'nullable|string',
            'amount_per_person' => 'required|numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $data = $request->only('title', 'category_id', 'short_description', 'amount_per_person');

        if ($request->hasFile('image')) {
            if ($foodItem->image) {
                Storage::disk('public')->delete($foodItem->image);
            }
            $data['image'] = $request->file('image')->store('food-items', 'public');
        }

        $foodItem->update($data);

        return redirect()->route('admin.food-items.index')
            ->with('success', 'Food item updated successfully.');
    }

    public function destroy(FoodItem $foodItem)
    {
        if ($foodItem->image) {
            Storage::disk('public')->delete($foodItem->image);
        }

        $foodItem->delete();
        return redirect()->route('admin.food-items.index')
            ->with('success', 'Food item deleted successfully.');
    }

    public function restore($id)
    {
        $foodItem = FoodItem::withTrashed()->findOrFail($id);
        $foodItem->restore();

        return redirect()->route('admin.food-items.index')
            ->with('success', 'Food item restored successfully.');
    }
}
