@extends('admin.layout')

@section('content')
<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="card-title mb-0">Service Item Details</h5>
        <div class="d-flex gap-2">
          <a href="{{ route('admin.service-items.edit', $serviceItem) }}" class="btn btn-outline-primary">
            <i class="bx bx-edit me-1"></i>
            Edit
          </a>
          <a href="{{ route('admin.service-items.index') }}" class="btn btn-outline-secondary">
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
                  <h4 class="mb-0">{{ $serviceItem->title }}</h4>
                </div>
              </div>
              <div class="col-md-6">
                <div class="mb-4">
                  <h6 class="text-muted mb-2">Fixed Amount</h6>
                  <h4 class="mb-0 text-success">₹{{ number_format($serviceItem->fixed_amount, 2) }}</h4>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-6">
                <div class="mb-4">
                  <h6 class="text-muted mb-2">Event Teams</h6>
                  @if($serviceItem->eventTeams->count() > 0)
                  <div class="d-flex flex-wrap gap-2">
                    @foreach($serviceItem->eventTeams as $team)
                    <span class="badge bg-label-info fs-6">{{ $team->name }}</span>
                    @endforeach
                  </div>
                  @else
                  <span class="text-muted">No teams assigned</span>
                  @endif
                </div>
              </div>
              <div class="col-md-6">
                <div class="mb-4">
                  <h6 class="text-muted mb-2">Category</h6>
                  <span class="badge bg-label-success fs-6">{{ $serviceItem->category->name }}</span>
                </div>
              </div>
            </div>

            @if($serviceItem->short_description)
            <div class="mb-4">
              <h6 class="text-muted mb-2">Description</h6>
              <p class="mb-0">{{ $serviceItem->short_description }}</p>
            </div>
            @endif

            <div class="row">
              <div class="col-md-6">
                <div class="mb-4">
                  <h6 class="text-muted mb-2">Created At</h6>
                  <p class="mb-0">{{ $serviceItem->created_at->format('M d, Y \a\t h:i A') }}</p>
                </div>
              </div>
              <div class="col-md-6">
                <div class="mb-4">
                  <h6 class="text-muted mb-2">Last Updated</h6>
                  <p class="mb-0">{{ $serviceItem->updated_at->format('M d, Y \a\t h:i A') }}</p>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="text-center">
              @if($serviceItem->image)
              <img src="{{ asset('storage/' . $serviceItem->image) }}" alt="{{ $serviceItem->title }}" class="img-fluid rounded mb-3" style="max-width: 300px;">
              @else
              <div class="d-flex justify-content-center align-items-center bg-light rounded mb-3" style="height: 200px;">
                <div class="text-center">
                  <i class="bx bx-cog fs-1 text-muted"></i>
                  <p class="text-muted mt-2">No image available</p>
                </div>
              </div>
              @endif
            </div>
          </div>
        </div>

        <div class="row mt-4">
          <div class="col-12">
            <h6 class="text-muted mb-3">Event Team Districts</h6>
            @if($serviceItem->eventTeams->count() > 0)
            @php
            $allDistricts = collect();
            foreach($serviceItem->eventTeams as $team) {
            $allDistricts = $allDistricts->merge($team->districts);
            }
            $uniqueDistricts = $allDistricts->unique('id');
            @endphp
            @if($uniqueDistricts->count() > 0)
            <div class="d-flex flex-wrap gap-2">
              @foreach($uniqueDistricts as $district)
              <span class="badge bg-label-secondary fs-6">{{ $district->name }}</span>
              @endforeach
            </div>
            @else
            <div class="alert alert-warning">
              <i class="bx bx-info-circle me-2"></i>
              No districts assigned to any of the event teams.
            </div>
            @endif
            @else
            <div class="alert alert-warning">
              <i class="bx bx-info-circle me-2"></i>
              No event teams assigned to this item.
            </div>
            @endif
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection