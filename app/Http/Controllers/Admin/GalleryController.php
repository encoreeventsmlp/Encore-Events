<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class GalleryController extends Controller
{
    public function index()
    {
        $galleries = Gallery::ordered()->paginate(12);
        return view('admin.galleries.index', compact('galleries'));
    }

    public function create()
    {
        return view('admin.galleries.create');
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'image' => 'required|image|mimes:jpeg,png,jpg,gif',
                'is_active' => 'nullable|in:on'
            ]);

            $imagePath = null;
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                $imagePath = $image->storeAs('gallery', $imageName, 'public');

                \Log::info('Image uploaded to: ' . $imagePath);
            } else {
                \Log::error('No image file found in request');
                return redirect()->back()->with('error', 'No image file was uploaded.');
            }

            $nextSortOrder = Gallery::max('sort_order') + 1;

            Gallery::create([
                'image_path' => $imagePath,
                'is_active' => $request->has('is_active'),
                'sort_order' => $nextSortOrder
            ]);

            return redirect()->route('admin.galleries.index')
                ->with('success', 'Gallery image added successfully!');
        } catch (\Exception $e) {
            \Log::error('Gallery creation error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Error creating gallery image: ' . $e->getMessage());
        }
    }

    public function show(Gallery $gallery)
    {
        return view('admin.galleries.show', compact('gallery'));
    }

    public function edit(Gallery $gallery)
    {
        return view('admin.galleries.edit', compact('gallery'));
    }

    public function update(Request $request, Gallery $gallery)
    {
        $request->validate([
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif',
            'is_active' => 'nullable|in:on'
        ]);

        $data = [
            'is_active' => $request->has('is_active')
        ];

        if ($request->hasFile('image')) {
            if ($gallery->image_path && Storage::disk('public')->exists($gallery->image_path)) {
                Storage::disk('public')->delete($gallery->image_path);
            }

            $image = $request->file('image');
            $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $data['image_path'] = $image->storeAs('gallery', $imageName, 'public');
        }

        $gallery->update($data);

        return redirect()->route('admin.galleries.index')
            ->with('success', 'Gallery image updated successfully!');
    }

    public function destroy(Gallery $gallery)
    {
        if ($gallery->image_path && Storage::disk('public')->exists($gallery->image_path)) {
            Storage::disk('public')->delete($gallery->image_path);
        }

        $gallery->delete();

        return redirect()->route('admin.galleries.index')
            ->with('success', 'Gallery image deleted successfully!');
    }

    public function updateOrder(Request $request)
    {
        $request->validate([
            'order' => 'required|array',
            'order.*' => 'integer|exists:galleries,id'
        ]);

        foreach ($request->order as $index => $galleryId) {
            Gallery::where('id', $galleryId)->update(['sort_order' => $index + 1]);
        }

        return response()->json(['success' => true]);
    }
}
