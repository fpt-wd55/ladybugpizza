<aside aria-label="Sidebar"
    class="fixed left-0 top-0 z-40 h-screen w-64 -translate-x-full border-r border-gray-200 bg-white pt-14 shadow-sm transition-transform sm:translate-x-0 md:translate-x-0"
    id="logo-sidebar">
    <div class="no-scrollbar h-full overflow-y-auto bg-white px-3 py-6">
        {{-- Menu sidebar --}}
        <ul class="space-y-2">
            <li>
                <a class="{{ request()->is('admin/dashboard*') ? 'bg-gray-200' : '' }} group flex items-center rounded-lg p-2 text-gray-900 hover:bg-gray-100"
                    href="{{ route('admin.dashboard') }}">
                    @svg('tabler-chart-pie', 'text-gray-500')
                    <span class="ml-3">Thống kê</span>
                </a>
            </li>
            <li>
                <button aria-controls="dropdown-user"
                    class="group flex w-full items-center rounded-lg p-2 text-gray-900 transition duration-75 hover:bg-gray-100"
                    data-collapse-toggle="dropdown-user" type="button">
                    @svg('tabler-user', 'text-gray-500')
                    <span class="ml-3 flex-1 whitespace-nowrap text-left">Tài
                        khoản</span>
                    @svg('tabler-chevron-down', 'w-4 h-4 text-gray-500')
                </button>
                <ul class="{{ request()->is(['admin/user*', 'admin/membership*']) ? 'block' : 'hidden' }} space-y-2 py-2"
                    id="dropdown-user">
                    <li>
                        <a class="{{ request()->is('admin/user*') ? 'bg-gray-200' : '' }} group flex w-full items-center rounded-lg p-2 pl-11 text-gray-900 transition duration-75 hover:bg-gray-100"
                            href="{{ route('admin.users.index') }}">Tài
                            khoản</a>
                    </li>
                    <li>
                        <a class="{{ request()->is('admin/membership*') ? 'bg-gray-200' : '' }} group flex w-full items-center rounded-lg p-2 pl-11 text-gray-900 transition duration-75 hover:bg-gray-100"
                            href="{{ route('admin.memberships.index') }}">Điểm
                            thành viên</a>
                    </li>
                </ul>
            </li>
            <li>
                <a class="{{ request()->is('admin/categor*') ? 'bg-gray-200' : '' }} group flex items-center rounded-lg p-2 text-gray-900 hover:bg-gray-100"
                    href="{{ route('admin.categories.index') }}">
                    @svg('tabler-category', 'text-gray-500')
                    <span class="ml-3">Danh mục</span>
                </a>
            </li>
            <li>
                <a class="{{ request()->is('admin/attribute*') ? 'bg-gray-200' : '' }} group flex items-center rounded-lg p-2 text-gray-900 hover:bg-gray-100"
                    href="{{ route('admin.attributes.index') }}">
                    @svg('tabler-sort-deacending-small-big', 'text-gray-500')
                    <span class="ml-3">Thuộc tính</span>
                </a>
            </li>
            <li>
                <button aria-controls="dropdown-shop"
                    class="group flex w-full items-center rounded-lg p-2 text-gray-900 transition duration-75 hover:bg-gray-100"
                    data-collapse-toggle="dropdown-shop" type="button">
                    @svg('tabler-pizza', 'text-gray-500')
                    <span class="ml-3 flex-1 whitespace-nowrap text-left">Sản phẩm</span>
                    @svg('tabler-chevron-down', 'w-4 h-4 text-gray-500')
                </button>
                <ul class="{{ request()->is(['admin/product*', 'admin/evaluations*', 'admin/combo*', 'admin/toppings*']) ? 'block' : 'hidden' }} space-y-2 py-2"
                    id="dropdown-shop">
                    <li>
                        <a class="{{ request()->is('admin/product*') ? 'bg-gray-200' : '' }} group flex w-full items-center rounded-lg p-2 pl-11 text-gray-900 transition duration-75 hover:bg-gray-100"
                            href="{{ route('admin.products.index') }}">Sản
                            phẩm</a>
                    </li>
                    <li>
                        <a class="{{ request()->is('admin/combo*') ? 'bg-gray-200' : '' }} group flex w-full items-center rounded-lg p-2 pl-11 text-gray-900 transition duration-75 hover:bg-gray-100"
                            href="{{ route('admin.combos.index') }}">Combo</a>
                    </li>
                    <li>
                        <a class="{{ request()->is('admin/topping*') ? 'bg-gray-200' : '' }} group flex w-full items-center rounded-lg p-2 pl-11 text-gray-900 transition duration-75 hover:bg-gray-100"
                            href="{{ route('admin.toppings.index') }}">Topping</a>
                    </li>
                </ul>
            </li>
            <li>
                <a class="{{ request()->is('admin/order*') ? 'bg-gray-200' : '' }} group flex items-center rounded-lg p-2 text-gray-900 hover:bg-gray-100"
                    href="{{ route('admin.orders.index') }}">
                    @svg('tabler-package', 'text-gray-500')
                    <span class="ml-3">Đơn hàng</span>
                </a>
            </li> 
            <li>
                <a class="{{ request()->is('admin/promotion*') ? 'bg-gray-200' : '' }} group flex items-center rounded-lg p-2 text-gray-900 hover:bg-gray-100"
                    href="{{ route('admin.promotions.index') }}">
                    @svg('tabler-discount-2', 'text-gray-500')
                    <span class="ml-3">Mã giảm giá</span>
                </a>
            </li>
            <li>
                <a class="{{ request()->is('admin/page*') ? 'bg-gray-200' : '' }} group flex items-center rounded-lg p-2 text-gray-900 hover:bg-gray-100"
                    href="{{ route('admin.pages.index') }}">
                    @svg('tabler-app-window', 'text-gray-500')
                    <span class="ml-3">Danh sách trang</span>
                </a>
            </li>
            <li>
                <a class="{{ request()->is('admin/banner*') ? 'bg-gray-200' : '' }} group flex items-center rounded-lg p-2 text-gray-900 hover:bg-gray-100"
                    href="{{ route('admin.banners.index') }}">
                    @svg('tabler-slideshow', 'text-gray-500')
                    <span class="ml-3">Banner</span>
                </a>
            </li>
        </ul>
    </div>
</aside>

