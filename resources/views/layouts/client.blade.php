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
    <link
        href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&family=Dancing+Script:wght@400..700&family=Berkshire+Swash&family=Vujahday+Script&family=Quicksand:wght@300..700&family=Baloo+2:wght@400..800&family=Playwrite+GB+S:ital,wght@0,100..400;1,100..400&display=swap"
        rel="stylesheet">
    @yield('styles')
    @livewireStyles
</head>

<body class="open-sans">
    @include('partials.clients.header')

    @include('partials.clients.alert')
    <div class="">
        @yield('content')
    </div>

    @include('partials.clients.bottom-nav')

    @include('partials.clients.footer')

    {{-- FABs --}}
    @include('partials.clients.float-buttons')

    @yield('scripts')
    @livewireScripts
</body>

</html>
