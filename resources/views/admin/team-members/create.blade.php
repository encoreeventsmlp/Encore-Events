@extends('admin.layout')

@section('content')
<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="card-title mb-0">Add New Team Member</h5>
        <a href="{{ route('admin.team-members.index') }}" class="btn btn-outline-secondary">
          <i class="fas fa-arrow-left me-1"></i>
          Back to Team Members
        </a>
      </div>
      <div class="card-body">
        <form action="{{ route('admin.team-members.store') }}" method="POST" enctype="multipart/form-data">
          @csrf

          <div class="row">
            <div class="col-md-6">
              <div class="mb-3">
                <label for="name" class="form-label">Name <span class="text-danger">*</span></label>
                <input type="text" class="form-control @error('name') is-invalid @enderror"
                       id="name" name="name" value="{{ old('name') }}" required>
                @error('name')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
            </div>

            <div class="col-md-6">
              <div class="mb-3">
                <label for="designation" class="form-label">Designation <span class="text-danger">*</span></label>
                <input type="text" class="form-control @error('designation') is-invalid @enderror"
                       id="designation" name="designation" value="{{ old('designation') }}" required>
                @error('designation')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
            </div>
          </div>

          <div class="mb-3">
            <label for="photo" class="form-label">Photo</label>
            <input type="file" class="form-control @error('photo') is-invalid @enderror"
                   id="photo" name="photo" accept="image/*">
            @error('photo')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
            <div class="form-text">Upload a profile photo (JPEG, PNG, JPG, GIF - Max 2MB)</div>
          </div>

          <div class="d-flex gap-2">
            <button type="submit" class="btn btn-primary">
              <i class="fas fa-save me-1"></i>
              Create Team Member
            </button>
            <a href="{{ route('admin.team-members.index') }}" class="btn btn-outline-secondary">
              Cancel
            </a>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
