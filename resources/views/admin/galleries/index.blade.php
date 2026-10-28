@extends('admin.layout')

@section('title', 'Gallery Management')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="card-title">Gallery Management</h3>
                    <a href="{{ route('admin.galleries.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i> Add New Image
                    </a>
                </div>
                <div class="card-body">
                    @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                    @endif

                    @if($galleries->count() > 0)
                    <div class="mb-3">
                        <small class="text-muted">
                            <i class="fas fa-info-circle"></i> Drag and drop images to reorder them
                        </small>
                    </div>
                    <div class="row" id="sortable-gallery">
                        @foreach($galleries as $gallery)
                        <div class="col-md-4 col-lg-3 mb-4" data-id="{{ $gallery->id }}">
                            <div class="card h-100 sortable-item" style="cursor: move;">
                                <div class="position-relative">
                                    <img src="{{ $gallery->image_url }}" class="card-img-top" alt="Gallery Image" style="height: 200px; object-fit: cover;">
                                    <div class="position-absolute top-0 end-0 p-2">
                                        @if($gallery->is_active)
                                        <span class="badge bg-success">Active</span>
                                        @else
                                        <span class="badge bg-secondary">Inactive</span>
                                        @endif
                                    </div>
                                    <div class="position-absolute top-0 start-0 p-2">
                                        <i class="fas fa-grip-vertical text-white" style="text-shadow: 1px 1px 2px rgba(0,0,0,0.5);"></i>
                                    </div>
                                </div>
                                <div class="card-body d-flex flex-column">
                                    <div class="mt-auto">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <small class="text-muted">#{{ $gallery->sort_order }}</small>
                                            <div class="btn-group btn-group-sm">
                                                <a href="{{ route('admin.galleries.show', $gallery) }}" class="btn btn-outline-info" title="View">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a href="{{ route('admin.galleries.edit', $gallery) }}" class="btn btn-outline-primary" title="Edit">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form action="{{ route('admin.galleries.destroy', $gallery) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this image?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-outline-danger" title="Delete">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>

                    <div class="d-flex justify-content-center">
                        {{ $galleries->links() }}
                    </div>
                    @else
                    <div class="text-center py-5">
                        <i class="fas fa-images fa-3x text-muted mb-3"></i>
                        <h5 class="text-muted">No gallery images found</h5>
                        <p class="text-muted">Start by adding your first gallery image.</p>
                        <a href="{{ route('admin.galleries.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus"></i> Add First Image
                        </a>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const sortable = Sortable.create(document.getElementById('sortable-gallery'), {
            animation: 150,
            ghostClass: 'sortable-ghost',
            chosenClass: 'sortable-chosen',
            dragClass: 'sortable-drag',
            onEnd: function(evt) {
                const order = [];
                document.querySelectorAll('#sortable-gallery [data-id]').forEach(function(item) {
                    order.push(item.getAttribute('data-id'));
                });

                fetch('{{ route("admin.galleries.update-order") }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                        body: JSON.stringify({
                            order: order
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {

                            document.querySelectorAll('#sortable-gallery [data-id]').forEach(function(item, index) {
                                const orderElement = item.querySelector('.text-muted');
                                if (orderElement) {
                                    orderElement.textContent = '#' + (index + 1);
                                }
                            });
                        }
                    })
                    .catch(error => {
                        console.error('Error updating order:', error);

                        location.reload();
                    });
            }
        });
    });
</script>

<style>
    .sortable-ghost {
        opacity: 0.4;
    }

    .sortable-chosen {
        transform: scale(1.05);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
    }

    .sortable-drag {
        transform: rotate(5deg);
    }
</style>
@endsection