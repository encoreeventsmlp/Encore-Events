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
                <i class="fas fa-edit"></i>Edit Category
            </li>
        </ol>
    </nav>
</div>

<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="card-title mb-0">Edit Category: {{ $category->name }}</h5>
        <a href="{{ route('admin.categories.index') }}" class="btn btn-outline-secondary">
          <i class="bx bx-arrow-back me-1"></i>
          Back to Categories
        </a>
      </div>
      <div class="card-body">
        <form action="{{ route('admin.categories.update', $category) }}" method="POST">
          @csrf
          @method('PUT')

          <div class="row">
            <div class="col-md-6">
              <div class="mb-3">
                <label for="type" class="form-label">Category Type <span class="text-danger">*</span></label>
                <select class="form-select @error('type') is-invalid @enderror" id="type" name="type" required>
                  <option value="">Select Type</option>
                  <option value="decoration" {{ old('type', $category->type) === 'decoration' ? 'selected' : '' }}>
                    Decoration
                  </option>
                  <option value="service" {{ old('type', $category->type) === 'service' ? 'selected' : '' }}>
                    Service
                  </option>
                  <option value="food" {{ old('type', $category->type) === 'food' ? 'selected' : '' }}>
                    Food
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
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $category->name) }}" placeholder="Enter category name" required>
                @error('name')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
            </div>
          </div>

          <div class="alert alert-warning">
            <h6 class="alert-heading fw-bold mb-1">Warning:</h6>
            <p class="mb-0">Changing the category type may affect existing items. Please review all related items after making changes.</p>
          </div>

          <div class="d-flex justify-content-end gap-2">
            <a href="{{ route('admin.categories.index') }}" class="btn btn-outline-secondary">Cancel</a>
            <button type="submit" class="btn btn-primary">
              <i class="bx bx-save me-1"></i>
              Update Category
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
