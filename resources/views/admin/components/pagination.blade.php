@if($paginator->hasPages())
<div class="d-flex justify-content-between align-items-center mt-4">
    <div class="text-muted">
        Showing {{ $paginator->firstItem() }} to {{ $paginator->lastItem() }} of {{ $paginator->total() }} results
    </div>
    <div>
        {{ $paginator->links('pagination.bootstrap-5') }}
    </div>
</div>
@endif