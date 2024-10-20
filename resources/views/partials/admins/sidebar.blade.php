<aside
    class="fixed z-40 w-64 h-screen shadow-sm pt-14 transition-transform -translate-x-full bg-white border-r border-gray-200 md:translate-x-0   top-0 left-0  sm:translate-x-0"
    aria-label="Sidebar" id="logo-sidebar">
    <div class="overflow-y-auto py-5 px-3 h-full bg-white no-scrollbar">
        {{-- Menu sidebar --}}
        <ul class="space-y-2">
            <li>
                <a href="{{ route('admin.dashboard') }}"
                    class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-gray-100 group {{ request()->is('admin/dashboard*') ? 'is-active' : '' }}">
                    @svg('tabler-chart-pie', 'text-gray-500')
                    <span class="ml-3">Thống kê</span>
                </a>
            </li>
            <li>
                <button type="button"
                    class="flex items-center p-2 w-full text-gray-900 rounded-lg transition duration-75 group hover:bg-gray-100"
                    aria-controls="dropdown-user" data-collapse-toggle="dropdown-user">
                    @svg('tabler-user', 'text-gray-500')
                    <span class="flex-1 ml-3 text-left whitespace-nowrap">Tài
                        khoản</span>
                    @svg('tabler-chevron-down', 'w-4 h-4 text-gray-500')
                </button>
                <ul id="dropdown-user" class="hidden py-2 space-y-2">
                    <li>
                        <a href="{{ route('admin.users.index') }}"
                            class="flex items-center p-2 pl-11 w-full text-gray-900 rounded-lg transition duration-75 group hover:bg-gray-100 {{ request()->is('admin/users*') ? 'is-active' : '' }}">Tài
                            khoản</a>
                    </li>
                    <li>
                        <a href="{{ route('admin.memberships.index') }}"
                            class="flex items-center p-2 pl-11 w-full text-gray-900 rounded-lg transition duration-75 group hover:bg-gray-100 {{ request()->is('admin/memberships*') ? 'is-active' : '' }}">Điểm
                            thành viên</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="{{ route('admin.categories.index') }}"
                    class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-gray-100 group {{ request()->is('admin/categories*') ? 'is-active' : '' }}">
                    @svg('tabler-category', 'text-gray-500')
                    <span class="ml-3">Danh mục</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.attributes.index') }}"
                    class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-gray-100 group {{ request()->is('admin/attributes*') ? 'is-active' : '' }}">
                    @svg('tabler-sort-deacending-small-big', 'text-gray-500')
                    <span class="ml-3">Thuộc tính</span>
                </a>
            </li>
            <li>
                <button type="button"
                    class="flex items-center p-2 w-full text-gray-900 rounded-lg transition duration-75 group hover:bg-gray-100"
                    aria-controls="dropdown-shop" data-collapse-toggle="dropdown-shop">
                    @svg('tabler-pizza', 'text-gray-500')
                    <span class="flex-1 ml-3 text-left whitespace-nowrap">Sản phẩm</span>
                    @svg('tabler-chevron-down', 'w-4 h-4 text-gray-500')
                </button>
                <ul id="dropdown-shop" class="hidden py-2 space-y-2">
                    <li>
                        <a href="{{ route('admin.products.index') }}"
                            class="flex items-center p-2 pl-11 w-full text-gray-900 rounded-lg transition duration-75 group hover:bg-gray-100 {{ request()->is('admin/products*') ? 'is-active' : '' }}">Sản
                            phẩm</a>
                    </li>
                    <li>
                        <a href="{{ route('admin.evaluations.index') }}"
                            class="flex items-center p-2 pl-11 w-full text-gray-900 rounded-lg transition duration-75 group hover:bg-gray-100 {{ request()->is('admin/evaluations*') ? 'is-active' : '' }}">Đánh
                            giá</a>
                    </li>
                    <li>
                        <a href="{{ route('admin.combos.index') }}"
                    </li>
                    <li>
                        <a href="{{ route('admin.toppings.index') }}"
                            class="flex items-center p-2 pl-11 w-full text-gray-900 rounded-lg transition duration-75 group hover:bg-gray-100 {{ request()->is('admin/toppings*') ? 'is-active' : '' }}">Topping</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="{{ route('admin.orders.index') }}"
                    class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-gray-100 group {{ request()->is('admin/orders*') ? 'is-active' : '' }}">
                    @svg('tabler-package', 'text-gray-500')
                    <span class="ml-3">Đơn hàng</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.shippings.index') }}"
                    class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-gray-100 group {{ request()->is('admin/shippings*') ? 'is-active' : '' }}">
                    @svg('tabler-truck-delivery', 'text-gray-500')
                    <span class="ml-3">Giao hàng</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.promotions.index') }}"
                    class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-gray-100 group {{ request()->is('admin/promotions*') ? 'is-active' : '' }}">
                    @svg('tabler-discount-2', 'text-gray-500')
                    <span class="ml-3">Mã giảm giá</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.banners.index') }}"
                    class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-gray-100 group {{ request()->is('admin/banners*') ? 'is-active' : '' }}">
                    @svg('tabler-slideshow', 'text-gray-500')
                    <span class="ml-3">Banner</span>
                </a>
            </li>
        </ul>
    </div>
</aside>
