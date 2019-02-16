@if ($paginator->hasPages())
    <ul class="pagination" style="list-style-type: none; padding: 0px;">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <li class="page-item disabled" style="display: inline-block;"><span class="page-link">@lang('pagination.previous')</span></li>
        @else
            <li class="page-item" style="display: inline-block;"><a class="ui button primary page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev">@lang('pagination.previous')</a></li>
        @endif

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <li class="page-item" style="display: inline-block;"><a class="ui button primary page-link" href="{{ $paginator->nextPageUrl() }}" rel="next">@lang('pagination.next')</a></li>
        @else
            <li class="page-item disabled" style="display: inline-block;"><span class="page-link">@lang('pagination.next')</span></li>
        @endif
    </ul>
@endif
