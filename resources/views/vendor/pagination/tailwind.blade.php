@if ($paginator->hasPages())
    <nav role="navigation" aria-label="{{ __('Pagination Navigation') }}" class="flex items-center justify-between">
        <div class="flex justify-between flex-1 sm:hidden">
            @if ($paginator->onFirstPage())
                <span
                    class="flex justify-center items-center rounded-md border border-slate-300 py-2 px-3 text-sm transition shadow-sm text-slate-600 disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none ml-2">
                    @svg('tabler-chevron-left', 'w-4 h-4') Trước
                </span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}"
                    class="flex justify-center items-center rounded-md border border-slate-300 py-2 px-3 text-sm transition shadow-sm hover:shadow-lg text-slate-600 hover:text-white hover:bg-red-700 hover:border-red-700 focus:text-white focus:bg-red-700 focus:border-red-700 active:border-red-700 active:text-white active:bg-red-700 disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none ml-2">
                    @svg('tabler-chevron-left', 'w-4 h-4') Trước
                </a>
            @endif

            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}"
                    class="flex justify-center items-center rounded-md border border-slate-300 py-2 px-3 text-sm transition shadow-sm hover:shadow-lg text-slate-600 hover:text-white hover:bg-red-700 hover:border-red-700 focus:text-white focus:bg-red-700 focus:border-red-700 active:border-red-700 active:text-white active:bg-red-700 disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none ml-2">
                    <span>Tiếp</span>@svg('tabler-chevron-right', 'w-4 h-4')
                </a>
            @else
                <span
                    class="flex justify-center items-center rounded-md border border-slate-300 py-2 px-3 text-sm transition shadow-sm text-slate-600 disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none ml-2">
                    <span>Tiếp</span>@svg('tabler-chevron-right', 'w-4 h-4')
                </span>
            @endif
        </div>

        <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
            <div>
                <p class="text-sm text-gray-700 leading-5">
                    Đang hiển thị trang
                    @if ($paginator->firstItem())
                        <span class="font-medium">{{ $paginator->firstItem() }} - {{ $paginator->lastItem() }}</span>
                    @else
                        {{ $paginator->count() }}
                    @endif
                    của
                    <span class="font-medium">{{ $paginator->total() }}</span> trang
                </p>
            </div>

            <div class="flex space-x-1">
                {{-- Previous Page Link --}}
                @if ($paginator->onFirstPage())
                    <span aria-disabled="true" aria-label="{{ __('pagination.previous') }}"
                        class="flex justify-center items-center rounded-md border border-slate-300 py-2 px-3 text-sm transition shadow-sm text-slate-600 disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none ml-2"
                        aria-hidden="true">
                        @svg('tabler-chevron-left', 'w-4 h-4')
                    </span>
                @else
                    <a href="{{ $paginator->previousPageUrl() }}" rel="prev"
                        class="flex justify-center items-center rounded-md border border-slate-300 py-2 px-3 text-sm transition shadow-sm hover:shadow-lg text-slate-600 hover:text-white hover:bg-red-700 hover:border-red-700 focus:text-white focus:bg-red-700 focus:border-red-700 active:border-red-700 active:text-white active:bg-red-700 disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none ml-2"
                        aria-label="{{ __('pagination.previous') }}">
                        @svg('tabler-chevron-left', 'w-4 h-4')
                    </a>
                @endif

                {{-- Pagination Elements --}}
                @foreach ($elements as $element)
                    {{-- "Three Dots" Separator --}}
                    @if (is_string($element))
                        <span aria-disabled="true">
                            <span
                                class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium text-gray-700 bg-white cursor-default leading-5">{{ $element }}</span>
                        </span>
                    @endif

                    {{-- Array Of Links --}}
                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $paginator->currentPage())
                                <button aria-current="page"
                                    class="min-w-9 rounded-md bg-red-700 py-2 px-3 border border-transparent text-center text-sm text-white transition shadow-md hover:shadow-lg focus:bg-slate-700 focus:shadow-none active:bg-slate-700 hover:bg-slate-700 active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none ml-2">
                                    {{ $page }}
                                </button>
                            @else
                                <a href="{{ $url }}"
                                    class="min-w-9 rounded-md border border-slate-300 py-2 px-3 text-center text-sm transition-all shadow-sm hover:shadow-lg text-slate-600 hover:text-white hover:bg-red-700 hover:border-red-700 focus:text-white focus:bg-red-700 focus:border-red-700 active:border-red-700 active:text-white active:bg-red-700 disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none ml-2"
                                    aria-label="{{ __('Go to page :page', ['page' => $page]) }}">
                                    {{ $page }}
                                </a>
                            @endif
                        @endforeach
                    @endif
                @endforeach

                {{-- Next Page Link --}}
                @if ($paginator->hasMorePages())
                    <a href="{{ $paginator->nextPageUrl() }}" rel="next"
                        class="flex justify-center items-center rounded-md border border-slate-300 py-2 px-3 text-sm transition shadow-sm hover:shadow-lg text-slate-600 hover:text-white hover:bg-red-700 hover:border-red-700 focus:text-white focus:bg-red-700 focus:border-red-700 active:border-red-700 active:text-white active:bg-red-700 disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none ml-2"
                        aria-label="{{ __('pagination.next') }}">
                        @svg('tabler-chevron-right', 'w-4 h-4')
                    </a>
                @else
                    <span aria-disabled="true" aria-label="{{ __('pagination.next') }}"
                        class="flex justify-center items-center rounded-md border border-slate-300 py-2 px-3 text-sm transition shadow-sm text-slate-600 disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none ml-2"
                        aria-hidden="true">
                        @svg('tabler-chevron-right', 'w-4 h-4')
                    </span>
                @endif
            </div>
        </div>
    </nav>
@endif
