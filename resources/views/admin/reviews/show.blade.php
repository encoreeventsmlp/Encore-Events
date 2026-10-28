@extends('admin.layout')

@section('title', 'Review Details')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">

    <div class="breadcrumb-container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.dashboard') }}">
                        <i class="fas fa-home"></i>Dashboard
                    </a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.reviews.index') }}">
                        <i class="fas fa-star"></i>Reviews
                    </a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    <i class="fas fa-eye"></i>Review Details
                </li>
            </ol>
        </nav>
    </div>

    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h4 class="fw-bold py-3 mb-2">
                        <span class="text-muted fw-light">Reviews /</span> Details
                    </h4>
                    <p class="text-muted">Review details and management</p>
                </div>
                <div>
                    <a href="{{ route('admin.reviews.index') }}" class="btn btn-outline-secondary">
                        <i class="fas fa-arrow-left"></i> Back to Reviews
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="row">

        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Review Information</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-4">
                                <label class="form-label fw-semibold">Rating</label>
                                <div class="d-flex align-items-center">
                                    @for($i = 1; $i <= 5; $i++)
                                        <i class="fas fa-star{{ $i <= $review->rating ? '' : '-o' }} text-warning me-1 fs-4"></i>
                                    @endfor
                                    <span class="ms-3 fs-5 fw-bold">{{ $review->rating }}/5</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-4">
                                <label class="form-label fw-semibold">Status</label>
                                <div>
                                    @switch($review->status)
                                        @case('pending')
                                            <span class="badge bg-warning fs-6">Pending Review</span>
                                            @break
                                        @case('approved')
                                            <span class="badge bg-success fs-6">Approved</span>
                                            @break
                                        @case('rejected')
                                            <span class="badge bg-danger fs-6">Rejected</span>
                                            @break
                                    @endswitch
                                </div>
                            </div>
                        </div>
                    </div>

                    @if($review->comment)
                    <div class="mb-4">
                        <label class="form-label fw-semibold">Customer Comment</label>
                        <div class="border rounded p-3 bg-light">
                            <p class="mb-0">{{ $review->comment }}</p>
                        </div>
                    </div>
                    @endif

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-4">
                                <label class="form-label fw-semibold">Submitted Date</label>
                                <p class="mb-0">{{ $review->created_at->format('F j, Y \a\t g:i A') }}</p>
                            </div>
                        </div>
                        @if($review->reviewed_at)
                        <div class="col-md-6">
                            <div class="mb-4">
                                <label class="form-label fw-semibold">Reviewed Date</label>
                                <p class="mb-0">{{ $review->reviewed_at->format('F j, Y \a\t g:i A') }}</p>
                            </div>
                        </div>
                        @endif
                    </div>

                    @if($review->admin_notes)
                    <div class="mb-4">
                        <label class="form-label fw-semibold">Admin Notes</label>
                        <div class="border rounded p-3 bg-light">
                            <p class="mb-0">{{ $review->admin_notes }}</p>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Customer Information</h5>
                </div>
                <div class="card-body">
                    <div class="d-flex align-items-center mb-3">
                        <div class="avatar avatar-lg me-3">
                            <span class="avatar-initial rounded-circle bg-label-primary fs-4">
                                {{ substr($review->user->name, 0, 1) }}
                            </span>
                        </div>
                        <div>
                            <h6 class="mb-0">{{ $review->user->name }}</h6>
                            <small class="text-muted">{{ $review->user->email }}</small>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Phone</label>
                        <p class="mb-0">{{ $review->user->phone ?? 'Not provided' }}</p>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Member Since</label>
                        <p class="mb-0">{{ $review->user->created_at->format('F j, Y') }}</p>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Total Estimations</label>
                        <p class="mb-0">{{ $review->user->events->count() }}</p>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Actions</h5>
                </div>
                <div class="card-body">
                    @if($review->status === 'pending')
                        <div class="d-grid gap-2">
                            <form action="{{ route('admin.reviews.approve', $review) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-success w-100"
                                        onclick="return confirm('Approve this review?')">
                                    <i class="fas fa-check"></i> Approve Review
                                </button>
                            </form>
                            <form action="{{ route('admin.reviews.reject', $review) }}" method="POST">
                                @csrf
                                <div class="mb-2">
                                    <input type="text" name="admin_notes" class="form-control"
                                           placeholder="Rejection reason..." required>
                                </div>
                                <button type="submit" class="btn btn-danger w-100"
                                        onclick="return confirm('Reject this review?')">
                                    <i class="fas fa-times"></i> Reject Review
                                </button>
                            </form>
                        </div>
                    @else
                        <div class="d-grid gap-2">
                            <form action="{{ route('admin.reviews.reset', $review) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-warning w-100"
                                        onclick="return confirm('Reset this review to pending?')">
                                    <i class="fas fa-undo"></i> Reset to Pending
                                </button>
                            </form>
                        </div>
                    @endif

                    <hr>

                    <div class="d-grid">
                        <form action="{{ route('admin.reviews.destroy', $review) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-outline-danger w-100"
                                    onclick="return confirm('Are you sure you want to delete this review?')">
                                <i class="fas fa-trash"></i> Delete Review
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('styles')
<link href="{{ asset('admin/css/breadcrumbs.css') }}" rel="stylesheet">
@endsection
