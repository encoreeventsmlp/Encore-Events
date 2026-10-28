<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Subcategory;
use App\Models\Category;
use Illuminate\Http\Request;

class SubcategoryController extends Controller
{
    public function index(Request $request)
    {
        $query = Subcategory::with(['category']);

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where('name', 'like', "%{$search}%")
                ->orWhereHas('category', function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%");
                });
        }

        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        $subcategories = $query->paginate(10)->withQueryString();
        $categories = Category::orderBy('name')->get();

        return view('admin.subcategories.index', compact('subcategories', 'categories'));
    }

    public function create()
    {
        $categories = Category::orderBy('name')->get();
        return view('admin.subcategories.create', compact('categories'));
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'category_id' => 'required|exists:categories,id',
                'name' => 'required|string|max:255'
            ]);

            Subcategory::create($request->only('category_id', 'name'));

            return redirect()->route('admin.subcategories.index')
                ->with('success', 'Subcategory created successfully.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Failed to create subcategory. Please try again.');
        }
    }

    public function show(Subcategory $subcategory)
    {
        $subcategory->load(['category', 'decorationItems', 'serviceItems', 'foodItems']);
        return view('admin.subcategories.show', compact('subcategory'));
    }

    public function edit(Subcategory $subcategory)
    {
        $categories = Category::orderBy('name')->get();
        return view('admin.subcategories.edit', compact('subcategory', 'categories'));
    }

    public function update(Request $request, Subcategory $subcategory)
    {
        try {
            $request->validate([
                'category_id' => 'required|exists:categories,id',
                'name' => 'required|string|max:255'
            ]);

            $subcategory->update($request->only('category_id', 'name'));

            return redirect()->route('admin.subcategories.index')
                ->with('success', 'Subcategory updated successfully.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Failed to update subcategory. Please try again.');
        }
    }

    public function destroy(Subcategory $subcategory)
    {
        try {
            $subcategory->delete();
            return redirect()->route('admin.subcategories.index')
                ->with('success', 'Subcategory deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Failed to delete subcategory. Please try again.');
        }
    }

    public function getByCategory($categoryId)
    {
        $subcategories = Subcategory::where('category_id', $categoryId)
            ->orderBy('name')
            ->get(['id', 'name']);

        return response()->json($subcategories);
    }

    public function restore($id)
    {
        $subcategory = Subcategory::withTrashed()->findOrFail($id);
        $subcategory->restore();

        return redirect()->route('admin.subcategories.index')
            ->with('success', 'Subcategory restored successfully.');
    }
}
