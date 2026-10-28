@extends('admin.layout')

@section('content')
<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="card-title mb-0">Event Team Details</h5>
        <div class="d-flex gap-2">
          <a href="{{ route('admin.event-teams.edit', $eventTeam) }}" class="btn btn-outline-primary">
            <i class="bx bx-edit me-1"></i>
            Edit
          </a>
          <a href="{{ route('admin.event-teams.index') }}" class="btn btn-outline-secondary">
            <i class="bx bx-arrow-back me-1"></i>
            Back to Teams
          </a>
        </div>
      </div>
      <div class="card-body">
        <div class="row">
          <div class="col-md-6">
            <div class="mb-4">
              <h6 class="text-muted mb-2">Team Name</h6>
              <h4 class="mb-0">{{ $eventTeam->name }}</h4>
            </div>
          </div>
          <div class="col-md-6">
            <div class="mb-4">
              <h6 class="text-muted mb-2">Created At</h6>
              <p class="mb-0">{{ $eventTeam->created_at->format('M d, Y \a\t h:i A') }}</p>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-12">
            <h6 class="text-muted mb-3">Assigned Districts</h6>
            @if($eventTeam->districts->count() > 0)
              <div class="d-flex flex-wrap gap-2">
                @foreach($eventTeam->districts as $district)
                  <span class="badge bg-label-primary fs-6">{{ $district->name }}</span>
                @endforeach
              </div>
            @else
              <div class="alert alert-warning">
                <i class="bx bx-info-circle me-2"></i>
                No districts assigned to this team.
              </div>
            @endif
          </div>
        </div>

        <div class="row mt-4">
          <div class="col-12">
            <h6 class="text-muted mb-3">Related Items</h6>
            <div class="row">
              <div class="col-md-4">
                <div class="card border">
                  <div class="card-body text-center">
                    <i class="bx bx-palette fs-1 text-primary mb-2"></i>
                    <h5 class="card-title">{{ $eventTeam->decorationItems->count() }}</h5>
                    <p class="card-text">Decoration Items</p>
                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="card border">
                  <div class="card-body text-center">
                    <i class="bx bx-cog fs-1 text-success mb-2"></i>
                    <h5 class="card-title">{{ $eventTeam->serviceItems->count() }}</h5>
                    <p class="card-text">Service Items</p>
                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="card border">
                  <div class="card-body text-center">
                    <i class="bx bx-food-menu fs-1 text-warning mb-2"></i>
                    <h5 class="card-title">0</h5>
                    <p class="card-text">Food Items</p>
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
