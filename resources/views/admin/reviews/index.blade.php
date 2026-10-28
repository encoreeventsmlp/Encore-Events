@extends('admin.layout')

@section('title', 'Reviews Management')

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
                <li class="breadcrumb-item active" aria-current="page">
                    <i class="fas fa-star"></i>Reviews Management
                </li>
            </ol>
        </nav>
    </div>

    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h4 class="fw-bold py-3 mb-2">
                        <span class="text-muted fw-light">Reviews /</span> Management
                    </h4>
                    <p class="text-muted">Manage customer reviews and feedback</p>
                </div>
                <div class="d-flex gap-2">
                    <span class="badge bg-primary">{{ $statusCounts['all'] }} Total</span>
                    <span class="badge bg-warning">{{ $statusCounts['pending'] }} Pending</span>
                    <span class="badge bg-success">{{ $statusCounts['approved'] }} Approved</span>
                    <span class="badge bg-danger">{{ $statusCounts['rejected'] }} Rejected</span>
                </div>
            </div>
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-body">
            <form method="GET" action="{{ route('admin.reviews.index') }}" class="row g-3">
                <div class="col-md-4">
                    <label for="status" class="form-label">Status</label>
                    <select name="status" id="status" class="form-select">
                        <option value="">All Reviews</option>
                        <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>Approved</option>
                        <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Rejected</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="search" class="form-label">Search by User</label>
                    <input type="text" name="search" id="search" class="form-control"
                           placeholder="Search by user name or email..." value="{{ request('search') }}">
                </div>
                <div class="col-md-2">
                    <label class="form-label">&nbsp;</label>
                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-search"></i> Filter
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h5 class="card-title mb-0">Customer Reviews</h5>
        </div>
        <div class="card-body">
            @if($reviews->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>User</th>
                                <th>Rating</th>
                                <th>Comment</th>
                                <th>Status</th>
                                <th>Submitted</th>
                                <th>Reviewed By</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($reviews as $review)
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="avatar avatar-sm me-3">
                                            <span class="avatar-initial rounded-circle bg-label-primary">
                                                {{ substr($review->user->name, 0, 1) }}
                                            </span>
                                        </div>
                                        <div>
                                            <h6 class="mb-0">{{ $review->user->name }}</h6>
                                            <small class="text-muted">{{ $review->user->email }}</small>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        @for($i = 1; $i <= 5; $i++)
                                            <i class="fas fa-star{{ $i <= $review->rating ? '' : '-o' }} text-warning me-1"></i>
                                        @endfor
                                        <span class="ms-2 fw-semibold">{{ $review->rating }}/5</span>
                                    </div>
                                </td>
                                <td>
                                    @if($review->comment)
                                        <div class="comment-preview">
                                            {{ Str::limit($review->comment, 100) }}
                                            @if(strlen($review->comment) > 100)
                                                <span class="text-muted">...</span>
                                            @endif
                                        </div>
                                    @else
                                        <span class="text-muted">No comment</span>
                                    @endif
                                </td>
                                <td>
                                    @switch($review->status)
                                        @case('pending')
                                            <span class="badge bg-warning">Pending</span>
                                            @break
                                        @case('approved')
                                            <span class="badge bg-success">Approved</span>
                                            @break
                                        @case('rejected')
                                            <span class="badge bg-danger">Rejected</span>
                                            @break
                                    @endswitch
                                </td>
                                <td>
                                    <div>
                                        <span class="fw-semibold">{{ $review->created_at->format('M j, Y') }}</span>
                                        <br>
                                        <small class="text-muted">{{ $review->created_at->format('g:i A') }}</small>
                                    </div>
                                </td>
                                <td>
                                    @if($review->reviewer)
                                        <div>
                                            <span class="fw-semibold">{{ $review->reviewer->name }}</span>
                                            <br>
                                            <small class="text-muted">{{ $review->reviewed_at->format('M j, Y') }}</small>
                                        </div>
                                    @else
                                        <span class="text-muted">Not reviewed</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                data-bs-toggle="dropdown">
                                            <i class="fas fa-ellipsis-v"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="{{ route('admin.reviews.show', $review) }}">
                                                <i class="fas fa-eye me-2"></i> View Details
                                            </a>

                                            @if($review->status === 'pending')
                                                <form action="{{ route('admin.reviews.approve', $review) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    <button type="submit" class="dropdown-item text-success"
                                                            onclick="return confirm('Approve this review?')">
                                                        <i class="fas fa-check me-2"></i> Approve
                                                    </button>
                                                </form>
                                                <form action="{{ route('admin.reviews.reject', $review) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    <div class="dropdown-item">
                                                        <input type="text" name="admin_notes" class="form-control form-control-sm mb-2"
                                                               placeholder="Rejection reason..." required>
                                                        <button type="submit" class="btn btn-danger btn-sm w-100"
                                                                onclick="return confirm('Reject this review?')">
                                                            <i class="fas fa-times me-1"></i> Reject
                                                        </button>
                                                    </div>
                                                </form>
                                            @else
                                                <form action="{{ route('admin.reviews.reset', $review) }}"
                                                      method="POST" class="d-inline">
                                                    @csrf
                                                    <button type="submit" class="dropdown-item text-warning"
                                                            onclick="return confirm('Reset this review to pending?')">
                                                        <i class="fas fa-undo me-2"></i> Reset to Pending
                                                    </button>
                                                </form>
                                            @endif

                                            <div class="dropdown-divider"></div>
                                            <form action="{{ route('admin.reviews.destroy', $review) }}"
                                                  method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="dropdown-item text-danger"
                                                        onclick="return confirm('Are you sure you want to delete this review?')">
                                                    <i class="fas fa-trash me-2"></i> Delete
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </td>
                            </tr>

                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="d-flex justify-content-center mt-4">
                    {{ $reviews->withQueryString()->links() }}
                </div>
            @else
                <div class="text-center py-5">
                    <div class="mb-3">
                        <i class="fas fa-star fa-3x text-muted"></i>
                    </div>
                    <h5 class="text-muted">No reviews found</h5>
                    <p class="text-muted">There are no reviews matching your criteria.</p>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection

@section('styles')
<link href="{{ asset('admin/css/breadcrumbs.css') }}" rel="stylesheet">
@endsection
