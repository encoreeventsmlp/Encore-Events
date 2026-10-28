@extends('admin.layout')

@section('title', 'Categories')

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
                <i class="fas fa-tags"></i>Categories
            </li>
        </ol>
    </nav>
</div>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Categories</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <a href="{{ route('admin.categories.create') }}" class="btn btn-primary">
            <i class="align-middle me-1" data-feather="plus"></i>
            Add New Category
        </a>
    </div>
</div>

<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <h5 class="card-title mb-0">All Categories</h5>
      </div>
      <div class="card-body">

        <form method="GET" action="{{ route('admin.categories.index') }}" class="mb-4">
          <div class="row g-3">
            <div class="col-md-6">
              <div class="input-group">
                <span class="input-group-text"><i class="align-middle" data-feather="search"></i></span>
                <input type="text" class="form-control" name="search" value="{{ request('search') }}" placeholder="Search by name or type...">
              </div>
            </div>
            <div class="col-md-3">
              <select class="form-select" name="type">
                <option value="">All Types</option>
                <option value="decoration" {{ request('type') === 'decoration' ? 'selected' : '' }}>Decoration</option>
                <option value="service" {{ request('type') === 'service' ? 'selected' : '' }}>Service</option>
                <option value="food" {{ request('type') === 'food' ? 'selected' : '' }}>Food</option>
              </select>
            </div>
            <div class="col-md-3">
              <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">
                  <i class="align-middle me-1" data-feather="search"></i> Search
                </button>
                <a href="{{ route('admin.categories.index') }}" class="btn btn-outline-secondary">
                  <i class="align-middle me-1" data-feather="x"></i> Clear
                </a>
              </div>
            </div>
          </div>
        </form>

        @if($categories->count() > 0)
          <div class="table-responsive">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Type</th>
                  <th>Name</th>
                  <th>Items Count</th>
                  <th>Created At</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
                @foreach($categories as $category)
                  <tr>
                    <td>{{ $category->id }}</td>
                    <td>
                      @if($category->type === 'decoration')
                        <span class="badge bg-label-primary">
                          <i class="fas fa-palette me-1"></i>Decoration
                        </span>
                      @elseif($category->type === 'service')
                        <span class="badge bg-label-success">
                          <i class="fas fa-cog me-1"></i>Service
                        </span>
                      @elseif($category->type === 'food')
                        <span class="badge bg-label-warning">
                          <i class="fas fa-utensils me-1"></i>Food
                        </span>
                      @endif
                    </td>
                    <td>
                      <div class="d-flex align-items-center">
                        <div class="avatar avatar-sm me-2">
                          <span class="avatar-initial rounded bg-label-{{ $category->type === 'decoration' ? 'primary' : ($category->type === 'service' ? 'success' : 'warning') }}">
                            {{ substr($category->name, 0, 1) }}
                          </span>
                        </div>
                        <div>
                          <h6 class="mb-0">{{ $category->name }}</h6>
                        </div>
                      </div>
                    </td>
                    <td>
                      @php
                        $itemCount = 0;
                        if($category->type === 'decoration') {
                          $itemCount = $category->decorationItems->count();
                        } elseif($category->type === 'service') {
                          $itemCount = $category->serviceItems->count();
                        } elseif($category->type === 'food') {
                          $itemCount = $category->foodItems->count();
                        }
                      @endphp
                      <span class="badge bg-label-info">{{ $itemCount }} items</span>
                    </td>
                    <td>{{ $category->created_at->format('M d, Y') }}</td>
                    <td>
                      <div class="dropdown">
                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                          <i class="fas fa-ellipsis-v"></i>
                        </button>
                        <div class="dropdown-menu">
                          <a class="dropdown-item" href="{{ route('admin.categories.show', $category) }}">
                            <i class="align-middle me-1" data-feather="eye"></i> View
                          </a>
                          <a class="dropdown-item" href="{{ route('admin.categories.edit', $category) }}">
                            <i class="align-middle me-1" data-feather="edit"></i> Edit
                          </a>
                          <div class="dropdown-divider"></div>
                          <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="dropdown-item text-danger" onclick="return confirm('Are you sure you want to delete this category?')">
                              <i class="align-middle me-1" data-feather="trash-2"></i> Delete
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

          @include('admin.components.pagination', ['paginator' => $categories])

        @else
          <div class="text-center py-4">
            <div class="mb-3">
              <i class="align-middle" data-feather="tag" style="width: 64px; height: 64px;" class="text-muted"></i>
            </div>
            <h5 class="mb-2">No Categories Found</h5>
            <p class="text-muted mb-3">Get started by creating your first category.</p>
            <a href="{{ route('admin.categories.create') }}" class="btn btn-primary">
              <i class="align-middle me-1" data-feather="plus"></i>
              Add First Category
            </a>
          </div>
        @endif
      </div>
    </div>
  </div>
</div>
@endsection
