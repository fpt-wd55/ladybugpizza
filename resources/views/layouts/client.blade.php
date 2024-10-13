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
    {{-- OpenSan --}}
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap" rel="stylesheet">
    {{-- Dancing Script  --}}
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400..700&display=swap" rel="stylesheet">
    {{-- Berkshire Swash --}}
    <link href="https://fonts.googleapis.com/css2?family=Alex+Brush&family=Berkshire+Swash&family=Dancing+Script:wght@400..700&display=swap" rel="stylesheet">
    {{-- Vujahday Script --}}
    <link href="https://fonts.googleapis.com/css2?family=Alex+Brush&family=Berkshire+Swash&family=Dancing+Script:wght@400..700&family=Vujahday+Script&display=swap" rel="stylesheet">
    {{-- Quick Sand --}}
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300..700&display=swap" rel="stylesheet">
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


    {{-- Message Modal --}}
    <div aria-hidden="true" class="fixed left-0 right-0 top-0 z-50 hidden h-[calc(100%-1rem)] max-h-full w-full items-center justify-center overflow-y-auto overflow-x-hidden md:inset-0" id="default-modal" tabindex="-1">
        <div class="relative max-h-full w-full max-w-2xl p-4">
            <!-- Modal content -->
            <div class="relative rounded-lg bg-white shadow dark:bg-gray-700">
                <!-- Modal header -->
                <div class="flex items-center justify-between rounded-t border-b p-4 dark:border-gray-600 md:p-5">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                        Terms of Service
                    </h3>
                    <button class="ms-auto inline-flex h-8 w-8 items-center justify-center rounded-lg bg-transparent text-sm text-gray-400 hover:bg-gray-200 hover:text-gray-900 dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="default-modal" type="button">
                        <svg aria-hidden="true" class="h-3 w-3" fill="none" viewBox="0 0 14 14" xmlns="http://www.w3.org/2000/svg">
                            <path d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" stroke="currentColor" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <div class="space-y-4 p-4 md:p-5">
                    <p class="text-base leading-relaxed text-gray-500 dark:text-gray-400">
                        With less than a month to go before the European Union enacts new consumer privacy laws for its
                        citizens, companies around the world are updating their terms of service agreements to comply.
                    </p>
                    <p class="text-base leading-relaxed text-gray-500 dark:text-gray-400">
                        The European Union’s General Data Protection Regulation (G.D.P.R.) goes into effect on May 25
                        and is meant to ensure a common set of data rights in the European Union. It requires
                        organizations to notify users as soon as possible of high-risk data breaches that could
                        personally affect them.
                    </p>
                </div>
                <!-- Modal footer -->
                <div class="flex items-center rounded-b border-t border-gray-200 p-4 dark:border-gray-600 md:p-5">
                    <button class="rounded-lg bg-blue-700 px-5 py-2.5 text-center text-sm font-medium text-white hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" data-modal-hide="default-modal" type="button">I
                        accept</button>
                    <button class="ms-3 rounded-lg border border-gray-200 bg-white px-5 py-2.5 text-sm font-medium text-gray-900 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:outline-none focus:ring-4 focus:ring-gray-100 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white dark:focus:ring-gray-700" data-modal-hide="default-modal" type="button">Decline</button>
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
