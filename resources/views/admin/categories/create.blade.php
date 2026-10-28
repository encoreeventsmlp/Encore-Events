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
        <a href="{{ route('admin.categories.index') }}">
          <i class="fas fa-tags"></i>Categories
        </a>
      </li>
      <li class="breadcrumb-item active" aria-current="page">
        <i class="fas fa-plus"></i>Create Category
      </li>
    </ol>
  </nav>
</div>

<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="card-title mb-0">Create New Category</h5>
        <a href="{{ route('admin.categories.index') }}" class="btn btn-outline-secondary">
          <i class="bx bx-arrow-back me-1"></i>
          Back to Categories
        </a>
      </div>
      <div class="card-body">
        <form action="{{ route('admin.categories.store') }}" method="POST">
          @csrf

          <div class="row">
            <div class="col-md-6">
              <div class="mb-3">
                <label for="type" class="form-label">Category Type <span class="text-danger">*</span></label>
                <select class="form-select @error('type') is-invalid @enderror" id="type" name="type" required>
                  <option value="">Select Type</option>
                  <option value="decoration" {{ old('type') === 'decoration' ? 'selected' : '' }}>
                    <i class="bx bx-palette"></i> Decoration
                  </option>
                  <option value="service" {{ old('type') === 'service' ? 'selected' : '' }}>
                    <i class="bx bx-cog"></i> Service
                  </option>
                  <option value="food" {{ old('type') === 'food' ? 'selected' : '' }}>
                    <i class="bx bx-food-menu"></i> Food
                  </option>
                </select>
                @error('type')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
            </div>
            <div class="col-md-6">
              <div class="mb-3">
                <label for="name" class="form-label">Category Name <span class="text-danger">*</span></label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" placeholder="Enter category name" required>
                @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
            </div>
          </div>

          <div class="alert alert-info">
            <h6 class="alert-heading fw-bold mb-1">Category Types:</h6>
            <ul class="mb-0">
              <li><strong>Decoration:</strong> For decoration items like flowers, lights, banners</li>
              <li><strong>Service:</strong> For services like photography, music, transportation</li>
              <li><strong>Food:</strong> For food items and catering services</li>
            </ul>
          </div>

          <div class="d-flex justify-content-end gap-2">
            <a href="{{ route('admin.categories.index') }}" class="btn btn-outline-secondary">Cancel</a>
            <button type="submit" class="btn btn-primary">
              <i class="bx bx-save me-1"></i>
              Create Category
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection