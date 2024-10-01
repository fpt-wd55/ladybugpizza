<aside
    class="fixed z-40 w-64 h-screen shadow-sm pt-14 transition-transform -translate-x-full bg-white border-r border-gray-200 md:translate-x-0"
    aria-label="Sidebar" id="logo-sidebar">
    <div class="overflow-y-auto py-5 px-3 h-full bg-white">
        {{-- Menu sidebar --}}
        <ul class="space-y-2">
            <li>
                <a href="#"
                    class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-gray-100 group">
                    @svg('tabler-chart-pie', 'text-gray-500')
                    <span class="ml-3">Thống kê</span>
                </a>
            </li>
            <li>
                <a href="#"
                    class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-gray-100 group">
                    @svg('tabler-moneybag', 'text-gray-500')
                    <span class="ml-3">Doanh thu</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.users.index') }}"
                    class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-gray-100 group">
                    @svg('tabler-user', 'text-gray-500')
                    <span class="ml-3">Người dùng</span>
                </a>
            </li>
            <li>
                <button type="button"
                    class="flex items-center p-2 w-full text-gray-900 rounded-lg transition duration-75 group hover:bg-gray-100"
                    aria-controls="dropdown-pages" data-collapse-toggle="dropdown-pages">
                    @svg('tabler-category', 'text-gray-500')
                    <span class="flex-1 ml-3 text-left whitespace-nowrap">Sản phẩm</span>
                    @svg('tabler-chevron-down', 'w-4 h-4 text-gray-500')
                </button>
                <ul id="dropdown-pages" class="hidden py-2 space-y-2">
                    <li>
                        <a href="#"
                            class="flex items-center p-2 pl-11 w-full text-gray-900 rounded-lg transition duration-75 group hover:bg-gray-100">Danh
                            mục</a>
                    </li>
                    <li>
                        <a href="#"
                            class="flex items-center p-2 pl-11 w-full text-gray-900 rounded-lg transition duration-75 group hover:bg-gray-100">Sản
                            phẩm</a>
                    </li>
                    <li>
                        <a href="#"
                            class="flex items-center p-2 pl-11 w-full text-gray-900 rounded-lg transition duration-75 group hover:bg-gray-100">Thuộc
                            tính</a>
                    </li> 
                    <li>
                        <a href="#"
                            class="flex items-center p-2 pl-11 w-full text-gray-900 rounded-lg transition duration-75 group hover:bg-gray-100">Topping</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="#"
                    class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-gray-100 group">
                    @svg('tabler-package', 'text-gray-500')
                    <span class="ml-3">Đơn hàng</span>
                </a>
            </li>
            <li>
                <a href="#"
                    class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-gray-100 group">
                    @svg('tabler-file-invoice', 'text-gray-500')
                    <span class="ml-3">Hóa đơn</span>
                </a>
            </li>
            <li>
                <a href="#"
                    class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-gray-100 group">
                    @svg('tabler-truck-delivery', 'text-gray-500')
                    <span class="ml-3">Giao hàng</span>
                </a>
            </li>
            <li>
                <a href="#"
                    class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-gray-100 group">
                    @svg('tabler-discount-2', 'text-gray-500')
                    <span class="ml-3">Mã giảm giá</span>
                </a>
            </li>
            <li>
                <a href="#"
                    class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-gray-100 group">
                    @svg('tabler-slideshow', 'text-gray-500')
                    <span class="ml-3">Banner</span>
                </a>
            </li> 
            <li>
                <a href="#"
                    class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-gray-100 group">
                    @svg('tabler-password-user', 'text-gray-500')
                    <span class="ml-3">Phân quyền</span>
                </a>
            </li> 
            <li>
                <a href="#"
                    class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-gray-100 group">
                    @svg('tabler-credit-card', 'text-gray-500')
                    <span class="ml-3">Điểm thành viên</span>
                </a>
            </li> 
        </ul>
    </div>
    <div
        class="flex absolute bottom-0 left-0 justify-center p-4 space-x-4 w-full bg-white z-20">
        <a href="#"
            class="inline-flex justify-center p-2 text-gray-500 rounded cursor-pointer hover:text-gray-900 hover:bg-gray-100">
            @svg('tabler-logout', 'w-6 h-6 text-red-500')
        </a>
        <a href="#" data-tooltip-target="tooltip-settings"
            class="inline-flex justify-center p-2 text-gray-500 rounded cursor-pointer hover:text-gray-900 hover:bg-gray-100">
            @svg('tabler-settings', 'w-6 h-6')
        </a>
        <div id="tooltip-settings" role="tooltip"
            class="inline-block absolute invisible z-10 py-2 px-3 text-white bg-gray-900 rounded-lg shadow-sm opacity-0 transition-opacity duration-300 tooltip">
            Settings page
            <div class="tooltip-arrow" data-popper-arrow></div>
        </div> 
    </div>
</aside>
