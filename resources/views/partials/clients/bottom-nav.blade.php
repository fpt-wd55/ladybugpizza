<div class="fixed bottom-0 left-0 z-50 h-16 w-full border-t border-gray-200 bg-white lg:hidden">
    <div class="mx-auto grid h-full max-w-lg grid-cols-4 font-medium">
        <a class="trasition inline-flex flex-col items-center justify-center px-5 text-gray-800 hover:text-red-600" href="{{ route('client.home') }}">
            @svg('tabler-home', 'icon-md mb-1')
            <span class="text-xs">Trang chủ</span>
        </a>
        <a class="trasition inline-flex flex-col items-center justify-center px-5 text-gray-800 hover:text-red-600" href="{{ route('client.product.menu') }}">
            @svg('tabler-tools-kitchen-2', 'icon-md mb-1')
            <span class="text-xs">Thực đơn</span>
        </a>
        <button class="trasition inline-flex flex-col items-center justify-center px-5 text-gray-800 hover:text-red-600" data-modal-target="searchModal" data-modal-toggle="searchModal">
            @svg('tabler-search', 'icon-md mb-1')
            <span class="text-xs">Tìm kiếm</span>
        </button>
        <button aria-controls="menu" class="trasition inline-flex flex-col items-center justify-center px-5 text-gray-800 hover:text-red-600" data-drawer-hide="menu" data-drawer-placement="right" data-drawer-show="menu" data-drawer-target="menu" id="toggle-menu-button">
            @svg('tabler-menu', 'icon-md mb-1')
            <span class="text-xs">Menu</span>
        </button>

        <div aria-labelledby="drawer-right-label" class="fixed bottom-16 right-0 z-10 w-80 translate-x-full overflow-y-auto bg-white p-4 pt-16 transition-transform  " id="menu" tabindex="-1">
            <h5 class="text-gray-7 mb-4 inline-flex items-center text-sm" id="drawer-right-label">
                Menu
            </h5>
            <button aria-controls="menu" class="absolute end-2.5 top-2.5 inline-flex h-8 w-8 items-center justify-center rounded-lg bg-transparent text-sm text-gray-400 hover:bg-gray-200 hover:text-gray-900  " data-drawer-hide="menu" type="button">
                @svg('tabler-x', 'icon-sm')
            </button>
            <ul class="space-y-2 text-sm font-medium">
                <li>
                    <a class="flex items-center rounded-lg p-2 text-gray-900 hover:bg-gray-100 " href="{{ route('client.dynamic-page', 've-chung-toi') }}">
                        @svg('tabler-info-circle', 'icon-sm mr-2')
                        <span>Về chúng tôi</span>
                    </a>
                </li>
                <li>
                    <a class="flex items-center rounded-lg p-2 text-gray-900 hover:bg-gray-100 " href="{{ route('client.contact') }}">
                        @svg('tabler-phone', 'icon-sm mr-2')
                        <span>Liên hệ</span>
                    </a>
                </li>
                <li>
                    <a class="flex items-center rounded-lg p-2 text-gray-900 hover:bg-gray-100 " href="{{ route('client.dynamic-page', 'huong-dan-mua-hang') }}">
                        @svg('tabler-help', 'icon-sm mr-2')
                        <span>Hướng dẫn mua hàng</span>
                    </a>
                </li>
                <li>
                    <a class="flex items-center rounded-lg p-2 text-gray-900 hover:bg-gray-100 " href="{{ route('client.dynamic-page', 'chinh-sach-va-dieu-khoan') }}">
                        @svg('tabler-shield-check', 'icon-sm mr-2')
                        <span>Chính sách và điều khoản</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
