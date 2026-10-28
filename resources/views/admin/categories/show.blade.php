@extends('admin.layout')

@section('content')
<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="card-title mb-0">Category Details</h5>
        <div class="d-flex gap-2">
          <a href="{{ route('admin.categories.edit', $category) }}" class="btn btn-outline-primary">
            <i class="bx bx-edit me-1"></i>
            Edit
          </a>
          <a href="{{ route('admin.categories.index') }}" class="btn btn-outline-secondary">
            <i class="bx bx-arrow-back me-1"></i>
            Back to Categories
          </a>
        </div>
      </div>
      <div class="card-body">
        <div class="row">
          <div class="col-md-6">
            <div class="mb-4">
              <h6 class="text-muted mb-2">Category Name</h6>
              <h4 class="mb-0">{{ $category->name }}</h4>
            </div>
          </div>
          <div class="col-md-6">
            <div class="mb-4">
              <h6 class="text-muted mb-2">Category Type</h6>
              @if($category->type === 'decoration')
                <span class="badge bg-label-primary fs-6">
                  <i class="bx bx-palette me-1"></i>Decoration
                </span>
              @elseif($category->type === 'service')
                <span class="badge bg-label-success fs-6">
                  <i class="bx bx-cog me-1"></i>Service
                </span>
              @elseif($category->type === 'food')
                <span class="badge bg-label-warning fs-6">
                  <i class="bx bx-food-menu me-1"></i>Food
                </span>
              @endif
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-6">
            <div class="mb-4">
              <h6 class="text-muted mb-2">Created At</h6>
              <p class="mb-0">{{ $category->created_at->format('M d, Y \a\t h:i A') }}</p>
            </div>
          </div>
          <div class="col-md-6">
            <div class="mb-4">
              <h6 class="text-muted mb-2">Last Updated</h6>
              <p class="mb-0">{{ $category->updated_at->format('M d, Y \a\t h:i A') }}</p>
            </div>
          </div>
        </div>

        <div class="row mt-4">
          <div class="col-12">
            <h6 class="text-muted mb-3">Related Items</h6>
            <div class="row">
              @if($category->type === 'decoration')
                <div class="col-md-4">
                  <div class="card border">
                    <div class="card-body text-center">
                      <i class="bx bx-palette fs-1 text-primary mb-2"></i>
                      <h5 class="card-title">{{ $category->decorationItems->count() }}</h5>
                      <p class="card-text">Decoration Items</p>
                      @if($category->decorationItems->count() > 0)
                        <a href="{{ route('admin.decoration-items.index') }}?category={{ $category->id }}" class="btn btn-sm btn-outline-primary">View Items</a>
                      @endif
                    </div>
                  </div>
                </div>
              @elseif($category->type === 'service')
                <div class="col-md-4">
                  <div class="card border">
                    <div class="card-body text-center">
                      <i class="bx bx-cog fs-1 text-success mb-2"></i>
                      <h5 class="card-title">{{ $category->serviceItems->count() }}</h5>
                      <p class="card-text">Service Items</p>
                      @if($category->serviceItems->count() > 0)
                        <a href="{{ route('admin.service-items.index') }}?category={{ $category->id }}" class="btn btn-sm btn-outline-success">View Items</a>
                      @endif
                    </div>
                  </div>
                </div>
              @elseif($category->type === 'food')
                <div class="col-md-4">
                  <div class="card border">
                    <div class="card-body text-center">
                      <i class="bx bx-food-menu fs-1 text-warning mb-2"></i>
                      <h5 class="card-title">{{ $category->foodItems->count() }}</h5>
                      <p class="card-text">Food Items</p>
                      @if($category->foodItems->count() > 0)
                        <a href="{{ route('admin.food-items.index') }}?category={{ $category->id }}" class="btn btn-sm btn-outline-warning">View Items</a>
                      @endif
                    </div>
                  </div>
                </div>
              @endif
            </div>
          </div>
        </div>

        @if($category->type === 'decoration' && $category->decorationItems->count() > 0)
          <div class="row mt-4">
            <div class="col-12">
              <h6 class="text-muted mb-3">Recent Decoration Items</h6>
              <div class="table-responsive">
                <table class="table table-sm">
                  <thead>
                    <tr>
                      <th>Title</th>
                      <th>Event Team</th>
                      <th>Fixed Amount</th>
                      <th>Created</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($category->decorationItems->take(5) as $item)
                      <tr>
                        <td>{{ $item->title }}</td>
                        <td>{{ $item->eventTeam->name }}</td>
                        <td>₹{{ number_format($item->fixed_amount, 2) }}</td>
                        <td>{{ $item->created_at->format('M d, Y') }}</td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        @endif
      </div>
    </div>
  </div>
</div>
@endsection
