@if ($paginator->hasPages())
<nav class="flex flex-col md:flex-row justify-between items-start md:items-center space-y-3 md:space-y-0" aria-label="Table navigation">
    <span class="text-sm font-normal text-gray-500 dark:text-gray-400">
        Đang hiển thị
        <span class="font-semibold text-gray-900 dark:text-white">{{ $paginator->firstItem() }}-{{ $paginator->lastItem() }}</span>
        của
        <span class="font-semibold text-gray-900 dark:text-white">{{ $paginator->total() }}</span>
    </span>
    <ul class="inline-flex items-stretch -space-x-px">
        <li>
            @if ($paginator->onFirstPage())
            <span class="flex items-center justify-center h-full py-1.5 px-3 ml-0 text-gray-500 bg-white rounded-l-lg border border-gray-300 cursor-default">
                @svg('tabler-chevron-left', 'w-4 h-4')
            </span>
            @else
            <a href="{{ $paginator->previousPageUrl() }}" class="flex items-center justify-center h-full py-1.5 px-3 ml-0 text-gray-500 bg-white rounded-l-lg border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                @svg('tabler-chevron-left', 'w-4 h-4')
            </a>
            @endif
        </li>

        @foreach ($paginator->getUrlRange(1, $paginator->lastPage()) as $page => $url)
        <li>
            @if ($page == $paginator->currentPage())
            <span aria-current="page" class="flex items-center justify-center text-sm z-10 py-2 px-3 leading-tight text-red-600 bg-red-50 border border-red-300">{{ $page }}</span>
            @else
            <a href="{{ $url }}" class="flex items-center justify-center text-sm py-2 px-3 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">{{ $page }}</a>
            @endif
        </li>
        @endforeach

        <li>
            @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" class="flex items-center justify-center h-full py-1.5 px-3 leading-tight text-gray-500 bg-white rounded-r-lg border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                @svg('tabler-chevron-right', 'w-4 h-4')
            </a>
            @else
            <span class="flex items-center justify-center h-full py-1.5 px-3 leading-tight text-gray-500 bg-white rounded-r-lg border border-gray-300 cursor-default">
                @svg('tabler-chevron-right', 'w-4 h-4')
            </span>
            @endif
        </li>
    </ul>
</nav>
@endif