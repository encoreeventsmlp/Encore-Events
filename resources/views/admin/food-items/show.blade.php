@extends('admin.layout')

@section('content')
<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="card-title mb-0">Food Item Details</h5>
        <div class="d-flex gap-2">
          <a href="{{ route('admin.food-items.edit', $foodItem) }}" class="btn btn-outline-primary">
            <i class="bx bx-edit me-1"></i>
            Edit
          </a>
          <a href="{{ route('admin.food-items.index') }}" class="btn btn-outline-secondary">
            <i class="bx bx-arrow-back me-1"></i>
            Back to Items
          </a>
        </div>
      </div>
      <div class="card-body">
        <div class="row">
          <div class="col-md-8">
            <div class="row">
              <div class="col-md-6">
                <div class="mb-4">
                  <h6 class="text-muted mb-2">Item Title</h6>
                  <h4 class="mb-0">{{ $foodItem->title }}</h4>
                </div>
              </div>
              <div class="col-md-6">
                <div class="mb-4">
                  <h6 class="text-muted mb-2">Amount per Person</h6>
                  <h4 class="mb-0 text-warning">₹{{ number_format($foodItem->amount_per_person, 2) }}</h4>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-6">
                <div class="mb-4">
                  <h6 class="text-muted mb-2">Category</h6>
                  <span class="badge bg-label-warning fs-6">{{ $foodItem->category->name }}</span>
                </div>
              </div>
              <div class="col-md-6">
                <div class="mb-4">
                  <h6 class="text-muted mb-2">Total for 100 People</h6>
                  <h5 class="mb-0 text-primary">₹{{ number_format($foodItem->amount_per_person * 100, 2) }}</h5>
                </div>
              </div>
            </div>

            @if($foodItem->short_description)
              <div class="mb-4">
                <h6 class="text-muted mb-2">Description</h6>
                <p class="mb-0">{{ $foodItem->short_description }}</p>
              </div>
            @endif

            <div class="row">
              <div class="col-md-6">
                <div class="mb-4">
                  <h6 class="text-muted mb-2">Created At</h6>
                  <p class="mb-0">{{ $foodItem->created_at->format('M d, Y \a\t h:i A') }}</p>
                </div>
              </div>
              <div class="col-md-6">
                <div class="mb-4">
                  <h6 class="text-muted mb-2">Last Updated</h6>
                  <p class="mb-0">{{ $foodItem->updated_at->format('M d, Y \a\t h:i A') }}</p>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="text-center">
              @if($foodItem->image)
                <img src="{{ asset('storage/' . $foodItem->image) }}" alt="{{ $foodItem->title }}" class="img-fluid rounded mb-3" style="max-width: 300px;">
              @else
                <div class="d-flex justify-content-center align-items-center bg-light rounded mb-3" style="height: 200px;">
                  <div class="text-center">
                    <i class="bx bx-food-menu fs-1 text-muted"></i>
                    <p class="text-muted mt-2">No image available</p>
                  </div>
                </div>
              @endif
            </div>
          </div>
        </div>

        <div class="row mt-4">
          <div class="col-12">
            <h6 class="text-muted mb-3">Pricing Calculator</h6>
            <div class="row">
              <div class="col-md-3">
                <div class="card border">
                  <div class="card-body text-center">
                    <h6 class="card-title">50 People</h6>
                    <h5 class="text-primary">₹{{ number_format($foodItem->amount_per_person * 50, 2) }}</h5>
                  </div>
                </div>
              </div>
              <div class="col-md-3">
                <div class="card border">
                  <div class="card-body text-center">
                    <h6 class="card-title">100 People</h6>
                    <h5 class="text-primary">₹{{ number_format($foodItem->amount_per_person * 100, 2) }}</h5>
                  </div>
                </div>
              </div>
              <div class="col-md-3">
                <div class="card border">
                  <div class="card-body text-center">
                    <h6 class="card-title">200 People</h6>
                    <h5 class="text-primary">₹{{ number_format($foodItem->amount_per_person * 200, 2) }}</h5>
                  </div>
                </div>
              </div>
              <div class="col-md-3">
                <div class="card border">
                  <div class="card-body text-center">
                    <h6 class="card-title">500 People</h6>
                    <h5 class="text-primary">₹{{ number_format($foodItem->amount_per_person * 500, 2) }}</h5>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
