<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="{{ asset('favicon.svg') }}" type="image/x-icon">
    <title>@yield('title')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    {{-- OpenSan --}}
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap"
        rel="stylesheet">
    {{-- Dancing Script  --}}
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400..700&display=swap" rel="stylesheet">
    {{-- Berkshire Swash --}}
    <link
        href="https://fonts.googleapis.com/css2?family=Alex+Brush&family=Berkshire+Swash&family=Dancing+Script:wght@400..700&display=swap"
        rel="stylesheet">
    {{-- Vujahday Script --}}
    <link
        href="https://fonts.googleapis.com/css2?family=Alex+Brush&family=Berkshire+Swash&family=Dancing+Script:wght@400..700&family=Vujahday+Script&display=swap"
        rel="stylesheet">
    {{-- Quick Sand --}}
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300..700&display=swap" rel="stylesheet">
</head>

<body class="open-sans">
    @include('partials.clients.header')

    <div class="">
        @yield('content')
    </div>

    @include('partials.clients.bottom-nav')

    @include('partials.clients.footer')

    {{-- Float button --}}

    <div class="fixed bottom-16 lg:bottom-0 right-0 p-4">
        <button class="bg-red-600 border border-white text-white rounded-full w-10 h-10 flex items-center justify-center mb-4">
            @svg('tabler-message', 'icon-sm')
        </button>
        <button id="back-to-top" class="bg-gray-800 text-white rounded-full w-10 h-10 flex items-center justify-center">
            @svg('tabler-arrow-up', 'icon-sm')
        </button>
    </div>

    {{-- Search Modal --}}
    <div id="searchModal" tabindex="-1" aria-hidden="true"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-2xl max-h-full">
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                    <p class="font-semibold text-gray-900 dark:text-white">
                        Tìm kiếm
                    </p>
                    <button type="button"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                        data-modal-hide="searchModal">
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
