<div class="fixed right-4 top-20 z-50 animate-slide-out-right">
    @if (session('success'))
        <div class="mb-4 flex w-full max-w-sm items-center rounded-lg bg-white p-4 text-gray-500 shadow" id="toast-success" role="alert">
            <div class="inline-flex h-8 w-8 flex-shrink-0 items-center justify-center rounded-lg bg-green-100 text-green-500">
                @svg('tabler-circle-check-filled', 'w-6 h-6')
            </div>
            <div class="ms-3 text-sm font-normal">
                {{ session('success') }}
            </div>
            <button aria-label="Close" class="-mx-1.5 -my-1.5 ms-auto inline-flex h-8 w-8 items-center justify-center rounded-lg bg-white p-1.5 text-gray-400 transition hover:bg-gray-100 hover:text-gray-900 focus:ring-0" data-dismiss-target="#toast-success" type="button">
                @svg('tabler-x', 'w-6 h-6')
            </button>
        </div>
    @endif
    @if (session('error'))
        <div class="mb-4 flex w-full max-w-sm items-center rounded-lg bg-white p-4 text-gray-500 shadow" id="toast-danger" role="alert">
            <div class="inline-flex h-8 w-8 flex-shrink-0 items-center justify-center rounded-lg bg-red-100 text-red-500">
                @svg('tabler-circle-x-filled', 'w-6 h-6')
            </div>
            <div class="ms-3 text-sm font-normal">
                {{ session('error') }}
            </div>
            <button aria-label="Close" class="-mx-1.5 -my-1.5 ms-auto inline-flex h-8 w-8 items-center justify-center rounded-lg bg-white p-1.5 text-gray-400 transition hover:bg-gray-100 hover:text-gray-900 focus:ring-0" data-dismiss-target="#toast-danger" type="button">
                @svg('tabler-x', 'w-6 h-6')
            </button>
        </div>
    @endif
</div>
<script>
    // setTimeout to remove the toast notification after 5 seconds
    setTimeout(() => {
        const toastSuccess = document.getElementById('toast-success');
        const toastDanger = document.getElementById('toast-danger');
        if (toastSuccess) {
            toastSuccess.remove();
        }
        if (toastDanger) {
            toastDanger.remove();
        }
    }, 5000);
</script>
