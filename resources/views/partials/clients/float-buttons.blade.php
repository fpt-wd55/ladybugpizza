<div class="fixed bottom-32 right-0 p-4 lg:bottom-16 lg:right-8">
    <button class="chat-open mb-4 flex h-10 w-10 items-center justify-center rounded-full border border-white bg-red-600 text-white" onclick="chatboxToogleHandler()">
        @svg('tabler-message', 'icon-sm')
    </button>
    <button class="flex h-10 w-10 items-center justify-center rounded-full bg-gray-800 text-white" id="back-to-top">
        @svg('tabler-arrow-up', 'icon-sm')
    </button>
</div>

{{-- Box chat --}}
<div class="chat-box fixed bottom-20 left-4 right-4 z-50 hidden h-[600px] rounded-lg border border-[#e5e7eb] bg-white p-5 shadow-lg sm:left-auto sm:right-8 sm:w-[440px]">
    <!-- Heading -->
    <div class="flex items-center justify-between border-b pb-4">
        <h2 class="text-lg font-semibold tracking-tight">Ladybug Pizza</h2>
        <button class="chat-close rounded-md bg-gray-50 p-2 hover:bg-gray-100" onclick="chatboxToogleHandler()">
            @svg('tabler-minus', 'icon-sm')
        </button>
    </div>

    <!-- Chat Container -->
    <div class="no-scrollbar block h-[474px] min-w-full overflow-y-auto">
        @for ($i = 0; $i < 10; $i++)
            <div class="my-5 flex items-start gap-2.5">
                <img class="h-8 w-8 rounded-full" src="https://blade-ui-kit.com/images/icon.svg">
                <div class="flex w-full max-w-[320px] flex-col gap-1">
                    <div class="flex items-center justify-start space-x-2 rtl:space-x-reverse">
                        <span class="text-sm font-semibold text-gray-900">Bonnie Green</span>
                        <span class="text-sm font-normal text-gray-500">11:46</span>
                    </div>
                    <div class="leading-1.5 flex flex-col rounded-xl border-gray-200 bg-gray-100 p-4">
                        <p class="text-sm font-normal text-gray-900"> That's awesome. I think our users
                            will really appreciate the improvements.</p>
                    </div>
                </div>
            </div>
            <div class="my-5 flex items-start gap-2.5">
                <div class="flex w-full max-w-[320px] flex-col gap-1">
                    <div class="flex items-center justify-end space-x-2 rtl:space-x-reverse">
                        <span class="text-sm font-semibold text-gray-900">Bonnie Green</span>
                        <span class="text-sm font-normal text-gray-500">11:46</span>
                    </div>
                    <div class="leading-1.5 flex flex-col rounded-xl border-gray-200 bg-gray-100 p-4">
                        <p class="text-sm font-normal text-gray-900"> That's awesome. I think our users
                            will really appreciate the improvements.</p>
                    </div>
                </div>
                <img class="h-8 w-8 rounded-full" src="https://blade-ui-kit.com/images/icon.svg">
            </div>
        @endfor
    </div>
    <!-- Input box  -->
    <div class="flex items-center pt-0">
        <form class="flex w-full items-center justify-center space-x-2">
            <input class="flex h-10 w-full rounded-md border border-[#e5e7eb] px-3 py-2 text-sm text-[#030712] placeholder-[#6b7280] focus:outline-none focus:ring-2 focus:ring-red-500 focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50" placeholder="Nhập tin nhắn" value="">
            <button class="inline-flex h-10 items-center justify-center rounded-md bg-red-600 px-4 py-2 text-sm font-medium text-[#f9fafb] hover:bg-red-700 disabled:pointer-events-none disabled:opacity-50">
                Gửi</button>
        </form>
    </div>
</div>

{{-- Back to top & Chat --}}
<script>
    const backToTopButton = document.getElementById('back-to-top');

    backToTopButton.addEventListener('click', () => {
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        })
    })
</script>

{{-- chat --}}
<script>
    const chatBox = document.querySelector('.chat-box');
    const chatOpen = document.querySelector('.chat-open');

    function chatboxToogleHandler() {
        chatBox.classList.toggle("hidden");
        chatOpen.classList.toggle("hidden");
    }
</script>
