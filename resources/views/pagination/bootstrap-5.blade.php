@if ($paginator->hasPages())
    <div class="custom-pagination">

        @if ($paginator->onFirstPage())
            <span class="pagination-btn disabled">
                <i class="fas fa-chevron-left"></i>
            </span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" class="pagination-btn" rel="prev">
                <i class="fas fa-chevron-left"></i>
            </a>
        @endif

        @foreach ($elements as $element)

            @if (is_string($element))
                <span class="pagination-dots">{{ $element }}</span>
            @endif

            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <span class="pagination-btn active">{{ $page }}</span>
                    @else
                        <a href="{{ $url }}" class="pagination-btn">{{ $page }}</a>
                    @endif
                @endforeach
            @endif
        @endforeach

        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" class="pagination-btn" rel="next">
                <i class="fas fa-chevron-right"></i>
            </a>
        @else
            <span class="pagination-btn disabled">
                <i class="fas fa-chevron-right"></i>
            </span>
        @endif
    </div>
@endif
