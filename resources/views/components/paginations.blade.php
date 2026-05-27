@if ($paginator->hasPages())
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-center p-4 border-top border-light w-100">
        <!-- Results Summary Info -->
        <div class="text-muted small mb-3 mb-md-0">
            Showing {{ $paginator->firstItem() }} to {{ $paginator->lastItem() }} of {{ $paginator->total() }} results
        </div>
        
        <!-- Pagination Links -->
        <ul class="pagination mb-0" style="justify-content: right;">
            <!-- Previous Page Link -->
            @if ($paginator->onFirstPage())
                <li class="page-item disabled"><a class="page-link"><span>‹</span></a></li>
            @else
                <li class="page-item"><a href="{{ $paginator->previousPageUrl() }}" class="page-link" rel="prev">‹</a></li>
            @endif

            <!-- Pagination Elements Here -->
            @foreach ($elements as $element)
                <!-- Make three dots -->
                @if (is_string($element))
                    <li class="page-item disabled"><a class="page-link"><span>{{ $element }}</span></a></li>
                @endif

                <!-- Links Array Here -->
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="page-item active"><a class="page-link"><span>{{ $page }}</span></a></li>
                        @else
                            <li class="page-item"><a href="{{ $url }}" class="page-link">{{ $page }}</a></li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            <!-- Next Page Link -->
            @if ($paginator->hasMorePages())
                <li class="page-item"><a href="{{ $paginator->nextPageUrl() }}" class="page-link"><span>›</span></a></li>
            @else
                <li class="page-item disabled"><a class="page-link"><span>›</span></a></li>
            @endif
        </ul>
    </div>
@endif
