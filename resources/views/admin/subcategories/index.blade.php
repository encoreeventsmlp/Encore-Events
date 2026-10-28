@extends('admin.layout')

@section('title', 'Subcategories')

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
                <i class="fas fa-tags"></i>Subcategories
            </li>
        </ol>
    </nav>
</div>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Subcategories</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <a href="{{ route('admin.subcategories.create') }}" class="btn btn-primary">
            <i class="align-middle me-1" data-feather="plus"></i>
            Add New Subcategory
        </a>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">All Subcategories</h5>
            </div>
            <div class="card-body">

                <form method="GET" action="{{ route('admin.subcategories.index') }}" class="mb-4">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="input-group">
                                <span class="input-group-text"><i class="align-middle" data-feather="search"></i></span>
                                <input type="text" class="form-control" name="search" value="{{ request('search') }}" placeholder="Search by name or category...">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <select class="form-select" name="category_id">
                                <option value="">All Categories</option>
                                @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }} ({{ ucfirst($category->type) }})
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <div class="d-flex gap-2">
                                <button type="submit" class="btn btn-primary">
                                    <i class="align-middle me-1" data-feather="search"></i> Search
                                </button>
                                <a href="{{ route('admin.subcategories.index') }}" class="btn btn-outline-secondary">
                                    <i class="align-middle me-1" data-feather="x"></i> Clear
                                </a>
                            </div>
                        </div>
                    </div>
                </form>

                @if($subcategories->count() > 0)
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Category</th>
                                <th>Type</th>
                                <th>Items Count</th>
                                <th>Created</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($subcategories as $subcategory)
                            <tr>
                                <td>{{ $subcategory->id }}</td>
                                <td>
                                    <strong>{{ $subcategory->name }}</strong>
                                </td>
                                <td>{{ $subcategory->category->name }}</td>
                                <td>{{ ucfirst($subcategory->category->type) }}</td>
                                <td>
                                    {{ $subcategory->decorationItems->count() + $subcategory->serviceItems->count() + $subcategory->foodItems->count() }}
                                </td>
                                <td>{{ $subcategory->created_at->format('M d, Y') }}</td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('admin.subcategories.show', $subcategory) }}" class="btn btn-sm btn-outline-info">
                                            <i class="align-middle" data-feather="eye"></i>
                                        </a>
                                        <a href="{{ route('admin.subcategories.edit', $subcategory) }}" class="btn btn-sm btn-outline-primary">
                                            <i class="align-middle" data-feather="edit"></i>
                                        </a>
                                        <form action="{{ route('admin.subcategories.destroy', $subcategory) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this subcategory?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger">
                                                <i class="align-middle" data-feather="trash-2"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="d-flex justify-content-center">
                    {{ $subcategories->links() }}
                </div>
                @else
                <div class="text-center py-5">
                    <i class="fas fa-tags fa-3x text-muted mb-3"></i>
                    <h5 class="text-muted">No subcategories found</h5>
                    <p class="text-muted">Get started by creating your first subcategory.</p>
                    <a href="{{ route('admin.subcategories.create') }}" class="btn btn-primary">
                        <i class="align-middle me-1" data-feather="plus"></i>
                        Add New Subcategory
                    </a>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection