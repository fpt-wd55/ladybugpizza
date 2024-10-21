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
        href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&family=Dancing+Script:wght@400..700&family=Berkshire+Swash&family=Vujahday+Script&family=Quicksand:wght@300..700&display=swap"
        rel="stylesheet">

</head>

<body class="open-sans">
    @include('partials.clients.header')

    @include('partials.clients.alert')
    <div class="">
        @yield('content')
    </div>

    @include('partials.clients.bottom-nav')

    @include('partials.clients.footer')

    {{-- Float button --}}

    <div class="fixed bottom-32 right-0 p-4 lg:bottom-16 lg:right-8">
        <button onclick="chatboxToogleHandler()"
            class="chat-open mb-4 flex h-10 w-10 items-center justify-center rounded-full border border-white bg-red-600 text-white">
            @svg('tabler-message', 'icon-sm')
        </button>
        <button class="flex h-10 w-10 items-center justify-center rounded-full bg-gray-800 text-white" id="back-to-top">
            @svg('tabler-arrow-up', 'icon-sm')
        </button>
    </div>

    {{-- Box chat --}}
    <div style="box-shadow: 0 0 #0000, 0 0 #0000, 0 1px 2px 0 rgb(0 0 0 / 0.05); z-index: 50;"
        class="chat-box fixed bottom-20 right-0 mr-4 bg-white p-5 rounded-lg border border-[#e5e7eb] w-[440px] h-[634px] hidden">

        <!-- Heading -->
        <div class="flex justify-between space-y-1.5 pb-3 border-b">
            <h2 class="font-semibold text-lg tracking-tight">Ladybug Pizza</h2>
            <button class="chat-close p-2 bg-gray-50 rounded-md hover:bg-gray-100" onclick="chatboxToogleHandler()">
                @svg('tabler-minus', 'icon-sm')
            </button>
        </div>

        <!-- Chat Container -->
        <div class="pr-4 h-[474px] block overflow-y-auto no-scrollbar min-w-full">
            @for ($i = 0; $i < 10; $i++)
                <div class="flex items-start gap-2.5 my-5">
                    <img class="w-8 h-8 rounded-full" src="https://blade-ui-kit.com/images/icon.svg">
                    <div class="flex flex-col gap-1 w-full max-w-[320px]">
                        <div class="flex justify-start items-center space-x-2 rtl:space-x-reverse">
                            <span class="text-sm font-semibold text-gray-900">Bonnie Green</span>
                            <span class="text-sm font-normal text-gray-500">11:46</span>
                        </div>
                        <div class="flex flex-col leading-1.5 p-4 border-gray-200 bg-gray-100 rounded-xl">
                            <p class="text-sm font-normal text-gray-900"> That's awesome. I think our users
                                will really appreciate the improvements.</p>
                        </div>
                    </div>
                </div>
                <div class="flex items-start gap-2.5 my-5">
                    <div class="flex flex-col gap-1 w-full max-w-[320px]">
                        <div class="flex justify-end items-center space-x-2 rtl:space-x-reverse">
                            <span class="text-sm font-semibold text-gray-900">Bonnie Green</span>
                            <span class="text-sm font-normal text-gray-500">11:46</span>
                        </div>
                        <div class="flex flex-col leading-1.5 p-4 border-gray-200 bg-gray-100 rounded-xl">
                            <p class="text-sm font-normal text-gray-900"> That's awesome. I think our users
                                will really appreciate the improvements.</p>
                        </div>
                    </div>
                    <img class="w-8 h-8 rounded-full" src="https://blade-ui-kit.com/images/icon.svg">
                </div>
            @endfor
        </div>
        <!-- Input box  -->
        <div class="flex items-center pt-0">
            <form class="flex items-center justify-center w-full space-x-2">
                <input
                    class="flex h-10 w-full rounded-md border border-[#e5e7eb] px-3 py-2 text-sm placeholder-[#6b7280] focus:outline-none focus:ring-2 focus:ring-red-500 disabled:cursor-not-allowed disabled:opacity-50 text-[#030712] focus-visible:ring-offset-2"
                    placeholder="Nhập tin nhắn" value="">
                <button
                    class="inline-flex items-center justify-center rounded-md text-sm font-medium text-[#f9fafb] disabled:pointer-events-none disabled:opacity-50 bg-red-600 hover:bg-red-700 h-10 px-4 py-2">
                    Gửi</button>
            </form>
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

        const chatBox = document.querySelector('.chat-box');
        const chatOpen = document.querySelector('.chat-open');
        const chatClose = document.querySelector('.chat-close');

        function chatboxToogleHandler() {
            chatBox.classList.toggle("hidden");
            chatOpen.classList.toggle("hidden");
            chatClose.classList.toggle("hidden");
        }
    </script>

</body>

</html>
