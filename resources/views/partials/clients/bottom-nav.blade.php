<div class="fixed bottom-0 left-0 z-50 w-full h-16 bg-white border-t border-gray-200 lg:hidden">
    <div class="grid h-full max-w-lg grid-cols-4 mx-auto font-medium">
        <a href="{{ route('client.home') }}"
            class="inline-flex flex-col items-center justify-center text-gray-800 px-5 hover:text-red-600 trasition">
            @svg('tabler-home', 'icon-md mb-1')
            <span class="text-xs">Trang chủ</span>
        </a>
        <a href="{{ route('client.product.menu') }}"
            class="inline-flex flex-col items-center justify-center text-gray-800 px-5 hover:text-red-600 trasition">
            @svg('tabler-tools-kitchen-2', 'icon-md mb-1')
            <span class="text-xs">Thực đơn</span>
        </a>
        <button data-modal-target="searchModal" data-modal-toggle="searchModal"
            class="inline-flex flex-col items-center justify-center text-gray-800 px-5 hover:text-red-600 trasition">
            @svg('tabler-search', 'icon-md mb-1')
            <span class="text-xs">Tìm kiếm</span>
        </button>
        <button data-drawer-target="menu" data-drawer-show="menu" data-drawer-hide="menu"
            data-drawer-placement="right" aria-controls="menu"
            class="inline-flex flex-col items-center justify-center text-gray-800 px-5 hover:text-red-600 trasition">
            @svg('tabler-menu', 'icon-md mb-1')
            <span class="text-xs">Menu</span>
        </button>

        <div id="menu"
            class="fixed bottom-16 right-0 z-10 p-4 overflow-y-auto transition-transform translate-x-full bg-white w-80 dark:bg-gray-800"
            tabindex="-1" aria-labelledby="drawer-right-label">
            <h5 id="drawer-right-label"
                class="inline-flex items-center mb-4 text-sm text-gray-7">
                Menu
            </h5>
            <button type="button" data-drawer-hide="menu" aria-controls="menu"
                class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 absolute top-2.5 end-2.5 inline-flex items-center justify-center dark:hover:bg-gray-600 dark:hover:text-white">
                @svg('tabler-x', 'icon-sm')
            </button>
            <ul class="space-y-2 font-medium text-sm">
                <li>
                    <a href="{{ route('client.about-us') }}"
                        class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100">
                        @svg('tabler-info-circle', 'icon-sm mr-2')
                        <span>Về chúng tôi</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('client.contact') }}"
                        class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100">
                        @svg('tabler-phone', 'icon-sm mr-2')
                        <span>Liên hệ</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('client.manual') }}"
                        class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100">
                        @svg('tabler-help', 'icon-sm mr-2')
                        <span>Hướng dẫn mua hàng</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('client.policies') }}"
                        class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100">
                        @svg('tabler-shield-check', 'icon-sm mr-2')
                        <span>Chính sách và điều khoản</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
