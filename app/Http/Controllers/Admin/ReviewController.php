<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function index(Request $request)
    {
        $query = Review::with(['user', 'reviewer']);

        if ($request->has('status') && $request->status !== '') {
            $query->where('status', $request->status);
        }

        if ($request->has('search') && $request->search !== '') {
            $search = $request->search;
            $query->whereHas('user', function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        $reviews = $query->orderBy('created_at', 'desc')->paginate(15);

        $statusCounts = [
            'all' => Review::count(),
            'pending' => Review::pending()->count(),
            'approved' => Review::approved()->count(),
            'rejected' => Review::rejected()->count(),
        ];

        return view('admin.reviews.index', compact('reviews', 'statusCounts'));
    }

    public function show(Review $review)
    {
        $review->load(['user', 'reviewer']);
        return view('admin.reviews.show', compact('review'));
    }

    public function approve(Request $request, Review $review)
    {
        $request->validate([
            'admin_notes' => 'nullable|string|max:500',
        ]);

        $review->update([
            'status' => 'approved',
            'admin_notes' => $request->admin_notes,
            'reviewed_at' => now(),
            'reviewed_by' => Auth::id(),
        ]);

        return redirect()->route('admin.reviews.index')
            ->with('success', 'Review approved successfully.');
    }

    public function reject(Request $request, Review $review)
    {
        $request->validate([
            'admin_notes' => 'required|string|max:500',
        ]);

        $review->update([
            'status' => 'rejected',
            'admin_notes' => $request->admin_notes,
            'reviewed_at' => now(),
            'reviewed_by' => Auth::id(),
        ]);

        return redirect()->route('admin.reviews.index')
            ->with('success', 'Review rejected successfully.');
    }

    public function reset(Review $review)
    {
        $review->update([
            'status' => 'pending',
            'admin_notes' => null,
            'reviewed_at' => null,
            'reviewed_by' => null,
        ]);

        return redirect()->route('admin.reviews.index')
            ->with('success', 'Review status reset to pending.');
    }

    public function destroy(Review $review)
    {
        $review->delete();

        return redirect()->route('admin.reviews.index')
            ->with('success', 'Review deleted successfully.');
    }
}
