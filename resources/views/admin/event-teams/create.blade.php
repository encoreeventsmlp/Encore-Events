@extends('admin.layout')

@section('content')
<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="card-title mb-0">Create New Event Team</h5>
        <a href="{{ route('admin.event-teams.index') }}" class="btn btn-outline-secondary">
          <i class="bx bx-arrow-back me-1"></i>
          Back to Teams
        </a>
      </div>
      <div class="card-body">
        <form action="{{ route('admin.event-teams.store') }}" method="POST">
          @csrf

          <div class="row">
            <div class="col-md-6">
              <div class="mb-3">
                <label for="name" class="form-label">Team Name <span class="text-danger">*</span></label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" placeholder="Enter team name" required>
                @error('name')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
            </div>
          </div>

          <div class="mb-3">
            <label class="form-label">Assign Districts <span class="text-danger">*</span></label>
            <div class="row">
              @foreach($districts as $district)
                <div class="col-md-3 mb-2">
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="districts[]" value="{{ $district->id }}" id="district_{{ $district->id }}" {{ in_array($district->id, old('districts', [])) ? 'checked' : '' }}>
                    <label class="form-check-label" for="district_{{ $district->id }}">
                      {{ $district->name }}
                    </label>
                  </div>
                </div>
              @endforeach
            </div>
            @error('districts')
              <div class="text-danger small">{{ $message }}</div>
            @enderror
          </div>

          <div class="d-flex justify-content-end gap-2">
            <a href="{{ route('admin.event-teams.index') }}" class="btn btn-outline-secondary">Cancel</a>
            <button type="submit" class="btn btn-primary">
              <i class="bx bx-save me-1"></i>
              Create Team
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
