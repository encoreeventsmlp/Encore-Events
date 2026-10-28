@extends('admin.layout')

@section('content')
<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="card-title mb-0">Edit Seating</h5>
        <a href="{{ route('admin.seatings.index') }}" class="btn btn-outline-secondary">
          <i class="bx bx-arrow-back me-1"></i>
          Back to Seatings
        </a>
      </div>
      <div class="card-body">
        <form action="{{ route('admin.seatings.update', $seating) }}" method="POST" enctype="multipart/form-data">
          @csrf
          @method('PUT')

          <div class="row">
            <div class="col-md-6">
              <div class="mb-3">
                <label for="title" class="form-label">Seating Title <span class="text-danger">*</span></label>
                <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title', $seating->title) }}" placeholder="Enter seating title" required>
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
                  <input type="number" step="0.01" class="form-control @error('catering_boy_per_head') is-invalid @enderror" id="catering_boy_per_head" name="catering_boy_per_head" value="{{ old('catering_boy_per_head', $seating->catering_boy_per_head) }}" placeholder="0.00" required>
                </div>
                @error('catering_boy_per_head')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
            </div>
          </div>

          <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="3" placeholder="Enter description">{{ old('description', $seating->description) }}</textarea>
            @error('description')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          <div class="mb-3">
            <label for="images" class="form-label">Add New Images</label>
            <input type="file" class="form-control @error('images') is-invalid @enderror" id="images" name="images[]" accept="image/*" multiple>
            <div class="form-text">Upload additional images (optional)</div>
            @error('images')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          @if($seating->images->count() > 0)
          <div class="mb-3">
            <label class="form-label">Current Images</label>
            <div class="row g-3">
              @foreach($seating->images as $image)
              <div class="col-md-3 col-sm-6">
                <div class="card h-100">
                  <img src="{{ asset('storage/' . $image->image_path) }}" class="card-img-top" alt="Seating Image" style="height: 150px; object-fit: cover;">
                  <div class="card-body p-2 text-center">
                    <button type="button" class="btn btn-danger btn-sm delete-image" data-id="{{ $image->id }}">
                      <i class="fas fa-trash me-1"></i> Delete
                    </button>
                  </div>
                </div>
              </div>
              @endforeach
            </div>
          </div>
          @endif

          <div class="d-flex justify-content-end gap-2">
            <a href="{{ route('admin.seatings.index') }}" class="btn btn-outline-secondary">Cancel</a>
            <button type="submit" class="btn btn-primary">
              <i class="bx bx-save me-1"></i>
              Update Seating
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<form id="delete-image-form" method="POST" style="display: none;">
    @csrf
    @method('DELETE')
</form>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const deleteButtons = document.querySelectorAll('.delete-image');
    const deleteForm = document.getElementById('delete-image-form');

    deleteButtons.forEach(button => {
        button.addEventListener('click', function() {
            if (confirm('Are you sure you want to delete this image?')) {
                const imageId = this.getAttribute('data-id');
                deleteForm.action = `/admin/seatings/image/${imageId}`;
                deleteForm.submit();
            }
        });
    });
});
</script>
@endsection
