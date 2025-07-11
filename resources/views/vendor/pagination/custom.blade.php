@if ($paginator->hasPages())
        <ul class="pagination pagination-sm m-0 float-end">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                {{-- <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                    <span class="page-link" aria-hidden="true">&lsaquo;</span>
                </li> --}}
                <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.previous')"><a class="page-link" href="javascript:void(0)">«</a> </li>
            @else
                {{-- <li class="page-item">
                    <a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')">&lsaquo;</a>
                </li> --}}
                <li class="page-item"> <a class="page-link" href="{{ $paginator->previousPageUrl() }}">«</a> </li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    {{-- <li class="page-item disabled" aria-disabled="true"><span class="page-link">{{ $element }}</span></li> --}}
                    <li class="page-item disabled" aria-disabled="true"> <a class="page-link" href="javascript:void(0)">{{ $element }}</a> </li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            {{-- <li class="page-item active" aria-current="page"><span class="page-link">{{ $page }}</span></li> --}}
                            <li class="page-item active"> <a class="page-link" href="javascript:void(0)">{{ $page }}</a></li>
                        @else
                            {{-- <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li> --}}
                            <li class="page-item"> <a class="page-link" href="{{ $url }}">{{ $page }}</a> </li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                {{-- <li class="page-item">
                    <a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')">&rsaquo;</a>
                </li> --}}
                <li class="page-item"> <a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')">»</a></li>
            @else
                {{-- <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
                    <span class="page-link" aria-hidden="true">&rsaquo;</span>
                </li> --}}
                <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.next')"> <a class="page-link" aria-hidden="true" href="javascript:void(0)">»</a> </li>
            @endif
        </ul>
@endif
