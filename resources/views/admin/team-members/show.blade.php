@extends('admin.layout')

@section('content')
<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="card-title mb-0">Team Member Details</h5>
        <div class="d-flex gap-2">
          <a href="{{ route('admin.team-members.edit', $teamMember) }}" class="btn btn-primary">
            <i class="fas fa-edit me-1"></i>
            Edit
          </a>
          <a href="{{ route('admin.team-members.index') }}" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left me-1"></i>
            Back to Team Members
          </a>
        </div>
      </div>
      <div class="card-body">
        <div class="row">
          <div class="col-md-4 text-center">
            @if($teamMember->photo)
              <img src="{{ asset('storage/' . $teamMember->photo) }}" alt="{{ $teamMember->name }}"
                   class="rounded-circle mb-3" width="200" height="200" style="object-fit: cover;">
            @else
              <div class="avatar avatar-xxl mx-auto mb-3">
                <span class="avatar-initial rounded-circle bg-label-primary" style="font-size: 4rem;">
                  {{ substr($teamMember->name, 0, 1) }}
                </span>
              </div>
            @endif
          </div>

          <div class="col-md-8">
            <div class="row">
              <div class="col-sm-4">
                <h6 class="text-muted">Name</h6>
                <p class="mb-3">{{ $teamMember->name }}</p>
              </div>

              <div class="col-sm-4">
                <h6 class="text-muted">Designation</h6>
                <p class="mb-3">{{ $teamMember->designation }}</p>
              </div>

              <div class="col-sm-4">
                <h6 class="text-muted">Member Since</h6>
                <p class="mb-3">{{ $teamMember->created_at->format('M d, Y') }}</p>
              </div>
            </div>

            <div class="row">
              <div class="col-sm-6">
                <h6 class="text-muted">Created At</h6>
                <p class="mb-3">{{ $teamMember->created_at->format('M d, Y \a\t h:i A') }}</p>
              </div>

              <div class="col-sm-6">
                <h6 class="text-muted">Last Updated</h6>
                <p class="mb-3">{{ $teamMember->updated_at->format('M d, Y \a\t h:i A') }}</p>
              </div>
            </div>
          </div>
        </div>

        <div class="mt-4 pt-4 border-top">
          <div class="d-flex gap-2">
            <a href="{{ route('admin.team-members.edit', $teamMember) }}" class="btn btn-primary">
              <i class="fas fa-edit me-1"></i>
              Edit Team Member
            </a>
            <form action="{{ route('admin.team-members.destroy', $teamMember) }}" method="POST" class="d-inline">
              @csrf
              @method('DELETE')
              <button type="submit" class="btn btn-outline-danger" onclick="return confirm('Are you sure you want to delete this team member?')">
                <i class="fas fa-trash me-1"></i>
                Delete Team Member
              </button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
