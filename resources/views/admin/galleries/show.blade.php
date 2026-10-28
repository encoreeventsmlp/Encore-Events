@extends('admin.layout')

@section('title', 'View Gallery Image')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Gallery Image Details</h3>
                    <div class="card-tools">
                        <a href="{{ route('admin.galleries.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Back to Gallery
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-4">
                                <img src="{{ $gallery->image_url }}" alt="{{ $gallery->alt_text }}"
                                    class="img-fluid rounded shadow" style="max-height: 400px;">
                            </div>
                        </div>
                        <div class="col-md-6">

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <h5>Status</h5>
                                        @if($gallery->is_active)
                                        <span class="badge bg-success">Active</span>
                                        @else
                                        <span class="badge bg-secondary">Inactive</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <h5>Sort Order</h5>
                                        <p class="text-muted">{{ $gallery->sort_order }}</p>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <h5>Created</h5>
                                <p class="text-muted">{{ $gallery->created_at->format('M d, Y H:i') }}</p>
                            </div>

                            <div class="mb-3">
                                <h5>Last Updated</h5>
                                <p class="text-muted">{{ $gallery->updated_at->format('M d, Y H:i') }}</p>
                            </div>

                            <div class="d-flex gap-2">
                                <a href="{{ route('admin.galleries.edit', $gallery) }}" class="btn btn-primary">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <form action="{{ route('admin.galleries.destroy', $gallery) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this image?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">
                                        <i class="fas fa-trash"></i> Delete
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection