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

<body class="open-sans">
    @include('partials.clients.header')

    <div class="">
        @yield('content')
    </div>

    @include('partials.clients.bottom-nav')

    @include('partials.clients.footer')

    {{-- Float button --}}

    <div class="fixed bottom-32 right-0 p-4 lg:bottom-16 lg:right-8">
        <button class="mb-4 flex h-10 w-10 items-center justify-center rounded-full border border-white bg-red-600 text-white">
            @svg('tabler-message', 'icon-sm')
        </button>
        <button class="flex h-10 w-10 items-center justify-center rounded-full bg-gray-800 text-white" id="back-to-top">
            @svg('tabler-arrow-up', 'icon-sm')
        </button>
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
