<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Seating;
use App\Models\SeatingImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SeatingController extends Controller
{
    public function index()
    {
        $seatings = Seating::with('images')->latest()->paginate(10);
        return view('admin.seatings.index', compact('seatings'));
    }

    public function create()
    {
        return view('admin.seatings.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'catering_boy_per_head' => 'required|numeric|min:0',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $seating = Seating::create($request->only('title', 'description', 'catering_boy_per_head'));

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('seatings', 'public');
                $seating->images()->create(['image_path' => $path]);
            }
        }

        return redirect()->route('admin.seatings.index')
            ->with('success', 'Seating created successfully.');
    }

    public function edit(Seating $seating)
    {
        return view('admin.seatings.edit', compact('seating'));
    }

    public function update(Request $request, Seating $seating)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'catering_boy_per_head' => 'required|numeric|min:0',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $seating->update($request->only('title', 'description', 'catering_boy_per_head'));

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('seatings', 'public');
                $seating->images()->create(['image_path' => $path]);
            }
        }

        return redirect()->route('admin.seatings.index')
            ->with('success', 'Seating updated successfully.');
    }

    public function destroy(Seating $seating)
    {
        $seating->delete();
        return redirect()->route('admin.seatings.index')
            ->with('success', 'Seating deleted successfully.');
    }

    public function destroyImage($id)
    {
        $image = SeatingImage::findOrFail($id);

        if (Storage::disk('public')->exists($image->image_path)) {
            Storage::disk('public')->delete($image->image_path);
        }

        $image->delete();

        return back()->with('success', 'Image deleted successfully.');
    }
}
