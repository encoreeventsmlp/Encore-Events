@extends('admin.layout')

@section('title', 'Seatings')

@section('content')

<div class="breadcrumb-container">
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a href="{{ route('admin.dashboard') }}">
          <i class="fas fa-home"></i>Dashboard
        </a>
      </li>
      <li class="breadcrumb-item active" aria-current="page">
        <i class="fas fa-chair"></i>Seatings
      </li>
    </ol>
  </nav>
</div>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
  <h1 class="h2">Seatings</h1>
  <div class="btn-toolbar mb-2 mb-md-0">
    <a href="{{ route('admin.seatings.create') }}" class="btn btn-primary">
      <i class="align-middle me-1" data-feather="plus"></i>
      Add New Seating
    </a>
  </div>
</div>

<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <h5 class="card-title mb-0">All Seatings</h5>
      </div>
      <div class="card-body">
        @if($seatings->count() > 0)
        <div class="table-responsive">
          <table class="table table-striped">
            <thead>
              <tr>
                <th>ID</th>
                <th>Image</th>
                <th>Title</th>
                <th>Catering Boy Price</th>
                <th>Created At</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              @foreach($seatings as $seating)
              <tr>
                <td>{{ $seating->id }}</td>
                <td>
                  @if($seating->images->count() > 0)
                  <img src="{{ asset('storage/' . $seating->images->first()->image_path) }}" alt="{{ $seating->title }}" class="rounded" style="width: 50px; height: 50px; object-fit: cover;">
                  @else
                  <div class="avatar avatar-sm">
                    <span class="avatar-initial rounded bg-label-primary">
                      <i class="fas fa-chair"></i>
                    </span>
                  </div>
                  @endif
                </td>
                <td>
                  <div>
                    <h6 class="mb-0">{{ $seating->title }}</h6>
                    @if($seating->description)
                    <small class="text-muted">{{ Str::limit($seating->description, 50) }}</small>
                    @endif
                  </div>
                </td>
                <td>
                  <span class="fw-semibold">@money($seating->catering_boy_per_head)</span>
                </td>
                <td>{{ $seating->created_at->format('M d, Y') }}</td>
                <td>
                  <div class="dropdown">
                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                      <i class="fas fa-ellipsis-v"></i>
                    </button>
                    <div class="dropdown-menu">
                      <a class="dropdown-item" href="{{ route('admin.seatings.edit', $seating) }}">
                        <i class="fas fa-edit me-1"></i> Edit
                      </a>
                      <div class="dropdown-divider"></div>
                      <form action="{{ route('admin.seatings.destroy', $seating) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="dropdown-item text-danger" onclick="return confirm('Are you sure you want to delete this seating?')">
                          <i class="fas fa-trash me-1"></i> Delete
                        </button>
                      </form>
                    </div>
                  </div>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>

        @include('admin.components.pagination', ['paginator' => $seatings])

        @else
        <div class="text-center py-4">
          <div class="mb-3">
            <i class="fas fa-chair display-1 text-muted"></i>
          </div>
          <h5 class="mb-2">No Seatings Found</h5>
          <p class="text-muted mb-3">Get started by creating your first seating arrangement.</p>
          <a href="{{ route('admin.seatings.create') }}" class="btn btn-primary">
            <i class="fas fa-plus me-1"></i>
            Add First Seating
          </a>
        </div>
        @endif
      </div>
    </div>
  </div>
</div>
@endsection
