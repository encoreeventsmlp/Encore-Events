@extends('admin.layout')

@section('content')
<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="card-title mb-0">Edit Service Item: {{ $serviceItem->title }}</h5>
        <a href="{{ route('admin.service-items.index') }}" class="btn btn-outline-secondary">
          <i class="bx bx-arrow-back me-1"></i>
          Back to Items
        </a>
      </div>
      <div class="card-body">
        <form action="{{ route('admin.service-items.update', $serviceItem) }}" method="POST" enctype="multipart/form-data">
          @csrf
          @method('PUT')

          <div class="row">
            <div class="col-md-6">
              <div class="mb-3">
                <label for="title" class="form-label">Item Title <span class="text-danger">*</span></label>
                <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title', $serviceItem->title) }}" placeholder="Enter item title" required>
                @error('title')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
            </div>
            <div class="col-md-6">
              <div class="mb-3">
                <label for="fixed_amount" class="form-label">Fixed Amount <span class="text-danger">*</span></label>
                <div class="input-group">
                  <span class="input-group-text">₹</span>
                  <input type="number" step="0.01" class="form-control @error('fixed_amount') is-invalid @enderror" id="fixed_amount" name="fixed_amount" value="{{ old('fixed_amount', $serviceItem->fixed_amount) }}" placeholder="0.00" required>
                </div>
                @error('fixed_amount')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-6">
              <div class="mb-3">
                <label class="form-label">Event Teams <span class="text-danger">*</span></label>
                <div class="border rounded p-3 @error('event_team_ids') is-invalid @enderror" style="max-height: 200px; overflow-y: auto;">
                  @foreach($eventTeams as $team)
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="event_team_ids[]" value="{{ $team->id }}" id="event_team_{{ $team->id }}"
                      {{ (is_array(old('event_team_ids')) && in_array($team->id, old('event_team_ids'))) || (!old('event_team_ids') && $serviceItem->eventTeams->contains($team->id)) ? 'checked' : '' }}>
                    <label class="form-check-label" for="event_team_{{ $team->id }}">
                      {{ $team->name }}
                    </label>
                  </div>
                  @endforeach
                </div>
                @error('event_team_ids')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                <div class="form-text">Select one or more event teams for this service item</div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="mb-3">
                <label for="category_id" class="form-label">Category <span class="text-danger">*</span></label>
                <select class="form-select @error('category_id') is-invalid @enderror" id="category_id" name="category_id" required>
                  <option value="">Select Category</option>
                  @foreach($categories as $category)
                  <option value="{{ $category->id }}" {{ old('category_id', $serviceItem->category_id) == $category->id ? 'selected' : '' }}>
                    {{ $category->name }}
                  </option>
                  @endforeach
                </select>
                @error('category_id')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
            </div>
          </div>

          <div class="mb-3">
            <label for="short_description" class="form-label">Short Description</label>
            <textarea class="form-control @error('short_description') is-invalid @enderror" id="short_description" name="short_description" rows="3" placeholder="Enter short description">{{ old('short_description', $serviceItem->short_description) }}</textarea>
            @error('short_description')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          <div class="mb-3">
            <label for="image" class="form-label">Item Image</label>
            @if($serviceItem->image)
            <div class="mb-2">
              <img src="{{ asset('storage/' . $serviceItem->image) }}" alt="{{ $serviceItem->title }}" class="rounded" style="width: 100px; height: 100px; object-fit: cover;">
              <div class="form-text">Current image</div>
            </div>
            @endif
            <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image" accept="image/*">
            <div class="form-text">Upload a new image to replace the current one (optional)</div>
            @error('image')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          <div class="d-flex justify-content-end gap-2">
            <a href="{{ route('admin.service-items.index') }}" class="btn btn-outline-secondary">Cancel</a>
            <button type="submit" class="btn btn-primary">
              <i class="bx bx-save me-1"></i>
              Update Item
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection