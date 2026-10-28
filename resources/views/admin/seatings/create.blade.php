@extends('admin.layout')

@section('content')
<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="card-title mb-0">Create New Seating</h5>
        <a href="{{ route('admin.seatings.index') }}" class="btn btn-outline-secondary">
          <i class="bx bx-arrow-back me-1"></i>
          Back to Seatings
        </a>
      </div>
      <div class="card-body">
        <form action="{{ route('admin.seatings.store') }}" method="POST" enctype="multipart/form-data">
          @csrf

          <div class="row">
            <div class="col-md-6">
              <div class="mb-3">
                <label for="title" class="form-label">Seating Title <span class="text-danger">*</span></label>
                <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title') }}" placeholder="Enter seating title" required>
                @error('title')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
            </div>
            <div class="col-md-6">
              <div class="mb-3">
                <label for="catering_boy_per_head" class="form-label">Catering Boy Per Head Amount <span class="text-danger">*</span></label>
                <div class="input-group">
                  <span class="input-group-text">₹</span>
                  <input type="number" step="0.01" class="form-control @error('catering_boy_per_head') is-invalid @enderror" id="catering_boy_per_head" name="catering_boy_per_head" value="{{ old('catering_boy_per_head') }}" placeholder="0.00" required>
                </div>
                @error('catering_boy_per_head')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
            </div>
          </div>

          <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="3" placeholder="Enter description">{{ old('description') }}</textarea>
            @error('description')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          <div class="mb-3">
            <label for="images" class="form-label">Seating Images</label>
            <input type="file" class="form-control @error('images') is-invalid @enderror" id="images" name="images[]" accept="image/*" multiple>
            <div class="form-text">Upload multiple images for this seating arrangement (optional)</div>
            @error('images')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
            @error('images.*')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          <div class="d-flex justify-content-end gap-2">
            <a href="{{ route('admin.seatings.index') }}" class="btn btn-outline-secondary">Cancel</a>
            <button type="submit" class="btn btn-primary">
              <i class="bx bx-save me-1"></i>
              Create Seating
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
