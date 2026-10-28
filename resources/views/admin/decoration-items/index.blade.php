@extends('admin.layout')

@section('title', 'Decoration Items')

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
        <i class="fas fa-palette"></i>Decoration Items
      </li>
    </ol>
  </nav>
</div>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
  <h1 class="h2">Decoration Items</h1>
  <div class="btn-toolbar mb-2 mb-md-0">
    <a href="{{ route('admin.decoration-items.create') }}" class="btn btn-primary">
      <i class="align-middle me-1" data-feather="plus"></i>
      Add New Item
    </a>
  </div>
</div>

<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <h5 class="card-title mb-0">All Decoration Items</h5>
      </div>
      <div class="card-body">

        <form method="GET" action="{{ route('admin.decoration-items.index') }}" class="mb-4">
          <div class="row g-3">
            <div class="col-md-4">
              <div class="input-group">
                <span class="input-group-text"><i class="fas fa-search"></i></span>
                <input type="text" class="form-control" name="search" value="{{ request('search') }}" placeholder="Search items...">
              </div>
            </div>
            <div class="col-md-3">
              <select class="form-select" name="event_team_id">
                <option value="">All Event Teams</option>
                @foreach($eventTeams as $team)
                <option value="{{ $team->id }}" {{ request('event_team_id') == $team->id ? 'selected' : '' }}>
                  {{ $team->name }}
                </option>
                @endforeach
              </select>
            </div>
            <div class="col-md-3">
              <select class="form-select" name="category_id">
                <option value="">All Categories</option>
                @foreach($categories as $category)
                <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                  {{ $category->name }}
                </option>
                @endforeach
              </select>
            </div>
            <div class="col-md-2">
              <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">
                  <i class="fas fa-search me-1"></i> Search
                </button>
                <a href="{{ route('admin.decoration-items.index') }}" class="btn btn-outline-secondary">
                  <i class="fas fa-times me-1"></i> Clear
                </a>
              </div>
            </div>
          </div>
        </form>

        @if($decorationItems->count() > 0)
        <div class="table-responsive">
          <table class="table table-striped">
            <thead>
              <tr>
                <th>ID</th>
                <th>Image</th>
                <th>Title</th>
                <th>Event Teams</th>
                <th>Category</th>
                <th>Fixed Amount</th>
                <th>Created At</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              @foreach($decorationItems as $item)
              <tr>
                <td>{{ $item->id }}</td>
                <td>
                  @if($item->image)
                  <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->title }}" class="rounded" style="width: 50px; height: 50px; object-fit: cover;">
                  @else
                  <div class="avatar avatar-sm">
                    <span class="avatar-initial rounded bg-label-primary">
                      <i class="fas fa-palette"></i>
                    </span>
                  </div>
                  @endif
                </td>
                <td>
                  <div>
                    <h6 class="mb-0">{{ $item->title }}</h6>
                    @if($item->short_description)
                    <small class="text-muted">{{ Str::limit($item->short_description, 50) }}</small>
                    @endif
                  </div>
                </td>
                <td>
                  @if($item->eventTeams->count() > 0)
                  @foreach($item->eventTeams as $team)
                  <span class="badge bg-label-info me-1 mb-1">{{ $team->name }}</span>
                  @endforeach
                  @else
                  <span class="text-muted">No teams assigned</span>
                  @endif
                </td>
                <td>
                  <span class="badge bg-label-primary">{{ $item->category->name }}</span>
                </td>
                <td>
                  <span class="fw-semibold">@money($item->fixed_amount)</span>
                </td>
                <td>{{ $item->created_at->format('M d, Y') }}</td>
                <td>
                  <div class="dropdown">
                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                      <i class="fas fa-ellipsis-v"></i>
                    </button>
                    <div class="dropdown-menu">
                      <a class="dropdown-item" href="{{ route('admin.decoration-items.show', $item) }}">
                        <i class="fas fa-eye me-1"></i> View
                      </a>
                      <a class="dropdown-item" href="{{ route('admin.decoration-items.edit', $item) }}">
                        <i class="fas fa-edit me-1"></i> Edit
                      </a>
                      <div class="dropdown-divider"></div>
                      <form action="{{ route('admin.decoration-items.destroy', $item) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="dropdown-item text-danger" onclick="return confirm('Are you sure you want to delete this item?')">
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

        @include('admin.components.pagination', ['paginator' => $decorationItems])

        @else
        <div class="text-center py-4">
          <div class="mb-3">
            <i class="fas fa-palette display-1 text-muted"></i>
          </div>
          <h5 class="mb-2">No Decoration Items Found</h5>
          <p class="text-muted mb-3">Get started by creating your first decoration item.</p>
          <a href="{{ route('admin.decoration-items.create') }}" class="btn btn-primary">
            <i class="fas fa-plus me-1"></i>
            Add First Item
          </a>
        </div>
        @endif
      </div>
    </div>
  </div>
</div>
@endsection