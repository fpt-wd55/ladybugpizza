<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <link href="{{ asset('favicon.svg') }}" rel="shortcut icon" type="image/x-icon">
    <title>@yield('title')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link crossorigin href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&family=Dancing+Script:wght@400..700&family=Berkshire+Swash&family=Vujahday+Script&family=Quicksand:wght@300..700&display=swap" rel="stylesheet">

</head>

<body class="open-sans text-sm">
    @include('partials.clients.header')

    <div class="">
        @yield('content')
    </div>

    @include('partials.clients.bottom-nav')

    @include('partials.clients.footer')

    {{-- Float button --}}

    <div class="fixed bottom-16 right-0 p-4 lg:bottom-8 lg:right-8">
        <button class="mb-4 flex h-10 w-10 items-center justify-center rounded-full border border-white bg-red-600 text-white">
            @svg('tabler-message', 'icon-sm')
        </button>
        <button class="flex h-10 w-10 items-center justify-center rounded-full bg-gray-800 text-white" id="back-to-top">
            @svg('tabler-arrow-up', 'icon-sm')
        </button>
    </div>

    {{-- Search Modal --}}
    <div aria-hidden="true" class="fixed left-0 right-0 top-0 z-50 hidden h-[calc(100%-1rem)] max-h-full w-full items-center justify-center overflow-y-auto overflow-x-hidden md:inset-0" id="searchModal" tabindex="-1">
        <div class="relative max-h-full w-full max-w-2xl p-4">
            <div class="relative rounded-lg bg-white shadow dark:bg-gray-700">
                <div class="flex items-center justify-between rounded-t border-b p-4 dark:border-gray-600 md:p-5">
                    <p class="font-semibold text-gray-900 dark:text-white">
                        Tìm kiếm
                    </p>
                    <button class="ms-auto inline-flex h-8 w-8 items-center justify-center rounded-lg bg-transparent text-sm text-gray-400 hover:bg-gray-200 hover:text-gray-900 dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="searchModal" type="button">
                        @svg('tabler-x', 'icon-sm')
                    </button>
                </div>

                <div class="p-4 md:p-8">
                    <div class="ais-InstantSearch transition">
                        <div id="searchbox"></div>
                        <div id="hits"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Back to top --}}
    <script>
        const backToTopButton = document.getElementById('back-to-top');

        backToTopButton.addEventListener('click', () => {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            })
        })
    </script>

</body>

</html>
