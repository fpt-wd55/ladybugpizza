<div class="sticky top-14 z-40" id="alert">

    @if (session('success'))
        <div class="flex items-center justify-center bg-red-600 p-2 text-sm text-white">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="flex items-center justify-center bg-red-600 p-2 text-sm text-white">
            {{ session('error') }}
        </div>
    @endif
</div>

<script>
    // Show alert with animation
    document.addEventListener('DOMContentLoaded', () => {
        const alert = document.getElementById('alert');

        setTimeout(() => {
            if (alert) {
                alert.remove();
            }
        }, 5000);
    });
</script>
