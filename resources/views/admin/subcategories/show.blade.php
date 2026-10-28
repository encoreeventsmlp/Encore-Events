@extends('admin.layout')

@section('content')

<div class="breadcrumb-container">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('admin.dashboard') }}">
                    <i class="fas fa-home"></i>Dashboard
                </a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{ route('admin.subcategories.index') }}">
                    <i class="fas fa-tags"></i>Subcategories
                </a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">
                <i class="fas fa-eye"></i>View Subcategory
            </li>
        </ol>
    </nav>
</div>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0">Subcategory Details: {{ $subcategory->name }}</h5>
                <div class="btn-group">
                    <a href="{{ route('admin.subcategories.edit', $subcategory) }}" class="btn btn-outline-primary">
                        <i class="bx bx-edit me-1"></i>
                        Edit
                    </a>
                    <a href="{{ route('admin.subcategories.index') }}" class="btn btn-outline-secondary">
                        <i class="bx bx-arrow-back me-1"></i>
                        Back to Subcategories
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Subcategory Name:</label>
                            <p class="form-control-plaintext">{{ $subcategory->name }}</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Parent Category:</label>
                            <p class="form-control-plaintext">
                                <span class="badge bg-info">{{ $subcategory->category->name }}</span>
                                <span class="badge bg-{{ $subcategory->category->type === 'decoration' ? 'primary' : ($subcategory->category->type === 'service' ? 'success' : 'warning') }} ms-2">
                                    {{ ucfirst($subcategory->category->type) }}
                                </span>
                            </p>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Created:</label>
                            <p class="form-control-plaintext">{{ $subcategory->created_at->format('M d, Y \a\t g:i A') }}</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Last Updated:</label>
                            <p class="form-control-plaintext">{{ $subcategory->updated_at->format('M d, Y \a\t g:i A') }}</p>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Items Count:</label>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="card bg-light">
                                        <div class="card-body text-center">
                                            <h5 class="card-title text-primary">{{ $subcategory->decorationItems->count() }}</h5>
                                            <p class="card-text">Decoration Items</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="card bg-light">
                                        <div class="card-body text-center">
                                            <h5 class="card-title text-success">{{ $subcategory->serviceItems->count() }}</h5>
                                            <p class="card-text">Service Items</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="card bg-light">
                                        <div class="card-body text-center">
                                            <h5 class="card-title text-warning">{{ $subcategory->foodItems->count() }}</h5>
                                            <p class="card-text">Food Items</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                @if($subcategory->decorationItems->count() > 0 || $subcategory->serviceItems->count() > 0 || $subcategory->foodItems->count() > 0)
                <div class="mt-4">
                    <h6 class="fw-bold mb-3">Related Items</h6>

                    @if($subcategory->decorationItems->count() > 0)
                    <div class="mb-3">
                        <h6 class="text-primary">Decoration Items ({{ $subcategory->decorationItems->count() }})</h6>
                        <div class="table-responsive">
                            <table class="table table-sm">
                                <thead>
                                    <tr>
                                        <th>Title</th>
                                        <th>Amount</th>
                                        <th>Created</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($subcategory->decorationItems->take(5) as $item)
                                    <tr>
                                        <td>{{ $item->title }}</td>
                                        <td>₹{{ number_format($item->fixed_amount, 2) }}</td>
                                        <td>{{ $item->created_at->format('M d, Y') }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        @if($subcategory->decorationItems->count() > 5)
                        <p class="text-muted small">... and {{ $subcategory->decorationItems->count() - 5 }} more items</p>
                        @endif
                    </div>
                    @endif

                    @if($subcategory->serviceItems->count() > 0)
                    <div class="mb-3">
                        <h6 class="text-success">Service Items ({{ $subcategory->serviceItems->count() }})</h6>
                        <div class="table-responsive">
                            <table class="table table-sm">
                                <thead>
                                    <tr>
                                        <th>Title</th>
                                        <th>Amount</th>
                                        <th>Created</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($subcategory->serviceItems->take(5) as $item)
                                    <tr>
                                        <td>{{ $item->title }}</td>
                                        <td>₹{{ number_format($item->fixed_amount, 2) }}</td>
                                        <td>{{ $item->created_at->format('M d, Y') }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        @if($subcategory->serviceItems->count() > 5)
                        <p class="text-muted small">... and {{ $subcategory->serviceItems->count() - 5 }} more items</p>
                        @endif
                    </div>
                    @endif

                    @if($subcategory->foodItems->count() > 0)
                    <div class="mb-3">
                        <h6 class="text-warning">Food Items ({{ $subcategory->foodItems->count() }})</h6>
                        <div class="table-responsive">
                            <table class="table table-sm">
                                <thead>
                                    <tr>
                                        <th>Title</th>
                                        <th>Amount/Person</th>
                                        <th>Created</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($subcategory->foodItems->take(5) as $item)
                                    <tr>
                                        <td>{{ $item->title }}</td>
                                        <td>₹{{ number_format($item->amount_per_person, 2) }}</td>
                                        <td>{{ $item->created_at->format('M d, Y') }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        @if($subcategory->foodItems->count() > 5)
                        <p class="text-muted small">... and {{ $subcategory->foodItems->count() - 5 }} more items</p>
                        @endif
                    </div>
                    @endif
                </div>
                @else
                <div class="alert alert-info">
                    <i class="fas fa-info-circle me-2"></i>
                    No items are currently assigned to this subcategory.
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection