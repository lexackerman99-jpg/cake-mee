@if ($paginator->hasPages())
  <nav class="admin-pagination" role="navigation" aria-label="{{ __('Pagination Navigation') }}">
    <span class="admin-pagination-summary">
      Menampilkan {{ $paginator->firstItem() }}–{{ $paginator->lastItem() }} dari {{ $paginator->total() }}
    </span>

    <div class="admin-pagination-links">
      @if ($paginator->onFirstPage())
        <span aria-disabled="true" aria-label="{{ __('pagination.previous') }}">Sebelumnya</span>
      @else
        <a href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="{{ __('pagination.previous') }}">Sebelumnya</a>
      @endif

      @foreach ($elements as $element)
        @if (is_string($element))
          <span aria-disabled="true">{{ $element }}</span>
        @endif

        @if (is_array($element))
          @foreach ($element as $page => $url)
            @if ($page == $paginator->currentPage())
              <span aria-current="page">{{ $page }}</span>
            @else
              <a href="{{ $url }}" aria-label="{{ __('Go to page :page', ['page' => $page]) }}">{{ $page }}</a>
            @endif
          @endforeach
        @endif
      @endforeach

      @if ($paginator->hasMorePages())
        <a href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="{{ __('pagination.next') }}">Berikutnya</a>
      @else
        <span aria-disabled="true" aria-label="{{ __('pagination.next') }}">Berikutnya</span>
      @endif
    </div>
  </nav>
@endif
