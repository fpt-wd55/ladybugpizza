<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
    {{-- ApexCharts Script --}}
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
</head>

<body class="text-sm">
    {{-- header --}}
    @include('partials.admins.header')
    {{-- sidebar --}}
    @include('partials.admins.sidebar')

    <div class="mt-20 sm:ml-64">
        {{-- breadcrumb --}}
        <nav class="mb-4 flex px-4 pt-2" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
                <li class="inline-flex items-center">
                    <a href="#"
                        class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-primary-600">
                        @svg('tabler-home', 'h-4 w-4 text-gray-400 me-2')
                        Home
                    </a>
                </li>
                <li>
                    <div class="flex items-center">
                        @svg('tabler-chevron-right', 'h-4 w-4 text-gray-400 me-2')
                        <a href="#"
                            class="ms-1 text-sm font-medium text-gray-700 hover:text-primary-600 md:ms-2">My
                            account</a>
                    </div>
                </li>
                <li aria-current="page">
                    <div class="flex items-center">
                        @svg('tabler-chevron-right', 'h-4 w-4 text-gray-400 me-2')
                        <span class="ms-1 text-sm font-medium text-gray-500 md:ms-2">Account</span>
                    </div>
                </li>
            </ol>
        </nav>
        <div class="px-4">
            @yield('content')
        </div>
        {{-- footer --}}
        @include('partials.admins.footer')
    </div>
</body>

</html>
