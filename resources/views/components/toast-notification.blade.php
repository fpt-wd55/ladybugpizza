<div class="animate-slide-out-right absolute right-4 top-20 z-50">
    @if (session('success'))
        <div id="toast-success"
            class="flex items-center w-full max-w-sm p-4 mb-4 text-gray-500 bg-white rounded-lg shadow " role="alert">
            <div
                class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-green-500 bg-green-100 rounded-lg">
                @svg('tabler-circle-check-filled', 'w-6 h-6')
                <span class="sr-only">Check icon</span>
            </div>
            <div class="ms-3 text-sm font-normal">
                {{ session('success') }}
            </div>
            <button type="button"
                class="ms-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg focus:ring-0 p-1.5 hover:bg-gray-100 inline-flex items-center justify-center h-8 w-8 transition"
                data-dismiss-target="#toast-success" aria-label="Close">
                <span class="sr-only">Close</span>
                @svg('tabler-x', 'w-6 h-6')
            </button>
        </div>
    @endif
    @if (session('error'))
        <div id="toast-danger"
            class="flex items-center w-full max-w-sm p-4 mb-4 text-gray-500 bg-white rounded-lg shadow " role="alert">
            <div
                class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-red-500 bg-red-100 rounded-lg ">
                @svg('tabler-circle-x-filled', 'w-6 h-6')
                <span class="sr-only">Error icon</span>
            </div>
            <div class="ms-3 text-sm font-normal">
                {{ session('error') }}
            </div>
            <button type="button"
                class="ms-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg focus:ring-0 p-1.5 hover:bg-gray-100 inline-flex items-center justify-center h-8 w-8 transition"
                data-dismiss-target="#toast-danger" aria-label="Close">
                <span class="sr-only">Close</span>
                @svg('tabler-x', 'w-6 h-6')
            </button>
        </div>
    @endif
</div>
