<nav class="fixed top-0 z-50 w-full bg-white border-b border-gray-200">
    <div class="px-3 py-3 lg:px-5 lg:pl-3">
        <div class="flex items-center justify-between">
            <div class="flex items-center justify-start rtl:justify-end">
                <button data-drawer-target="logo-sidebar" data-drawer-toggle="logo-sidebar" aria-controls="logo-sidebar"
                    type="button"
                    class="inline-flex items-center p-2 text-gray-500 rounded-lg sm:hidden hover:bg-gray-100 focus:outline-none ring-0 focus:ring-0">
                    <span class="sr-only">Open sidebar</span>
                    @svg('tabler-baseline-density-medium', 'w-6 h-6 text-gray-500')
                </button>
                <a href="{{ route('admin.dashboard') }}" class="flex ms-2 md:me-24">
                    <img loading="lazy" src="{{ asset('storage/uploads/logos/logo-fill.svg') }}" class="h-11 me-3"
                        alt="Ladybug Pizza Logo" />
                    <span class="self-center text-lg font-semibold whitespace-nowrap">Ladybug
                        Pizza</span>
                </a>
            </div>
            <div class="flex items-center">
                <a href="#"
                    class="p-2 mr-1 text-gray-500 rounded-lg hover:text-gray-900 hover:bg-gray-100 ring-0 focus:ring-0">
                    <!-- Chat icon -->
                    @svg('tabler-message-dots', 'text-gray-500')
                </a>
                <!-- Notifications -->
                <button type="button" data-dropdown-toggle="notification-dropdown"
                    class="p-2 mr-1 text-gray-500 rounded-lg hover:text-gray-900 hover:bg-gray-100 ring-0 focus:ring-0">
                    <span class="sr-only">Xem thông báo</span>
                    <!-- Bell icon -->
                    @svg('tabler-bell', 'w-6 h-6 text-gray-500')
                </button>
                <!-- Dropdown menu -->
                <div class="hidden overflow-hidden z-50 my-4 max-w-sm list-none bg-white rounded divide-y divide-gray-100 shadow-lg text-sm"
                    id="notification-dropdown">
                    <div class="block py-2 px-4 text-base font-medium text-center text-gray-700 bg-gray-50">
                        Thông báo
                    </div>
                    <div>
                        <a href="#" class="flex py-3 px-4 border-b hover:bg-gray-100">
                            <div class="flex-shrink-0">
                                <img loading="lazy" class="w-11 h-11 rounded-full"
                                    src="https://flowbite.s3.amazonaws.com/blocks/marketing-ui/avatars/joseph-mcfall.png"
                                    alt="Joseph McFall avatar">
                            </div>
                            <div class="pl-3 w-full">
                                <div class="text-gray-500 font-normal mb-1.5"><span
                                        class="font-semibold text-gray-900">Joseph Mcfall</span> and
                                    <span class="font-medium text-gray-900">141 others</span> love your
                                    story. See it and view more stories.
                                </div>
                                <div class="text-xs font-medium text-primary-700">44 minutes ago
                                </div>
                            </div>
                        </a>
                        <a href="#" class="flex py-3 px-4 border-b hover:bg-gray-100">
                            <div class="flex-shrink-0">
                                <img loading="lazy" class="w-11 h-11 rounded-full"
                                    src="https://flowbite.s3.amazonaws.com/blocks/marketing-ui/avatars/roberta-casas.png"
                                    alt="Roberta Casas image">
                            </div>
                            <div class="pl-3 w-full">
                                <div class="text-gray-500 font-normal mb-1.5"><span
                                        class="font-semibold text-gray-900">Leslie Livingston</span>
                                    mentioned you in a comment: <span
                                        class="font-medium text-primary-700">@bonnie.green</span>
                                    what do you say?</div>
                                <div class="text-xs font-medium text-primary-700">1 hour ago
                                </div>
                            </div>
                        </a>
                    </div>
                    <a href="#"
                        class="block py-2 text-base font-medium text-center text-gray-900 bg-gray-50 hover:bg-gray-100">
                        <div class="inline-flex items-center">
                            @svg('tabler-eye', 'w-5 h-5 me-1.5 text-gray-500')
                            Xem tất cả
                        </div>
                    </a>
                </div>
                <button data-dropdown-toggle="apps-dropdown" type="button"
                    class="text-gray-500  hover:bg-gray-100 focus:outline-none focus:ring-0 rounded-lg text-sm p-2.5">
                    {{ svg('tabler-columns', 'w-6 h-6 text-gray-500') }}
                </button>
                {{-- App Dropdown menu --}}
                <div class="hidden overflow-hidden z-50 my-4 max-w-sm text-base list-none bg-white rounded divide-y divide-gray-100 shadow-lg"
                    id="apps-dropdown">
                    <div class="block py-2 px-4 text-base font-medium text-center text-gray-700 bg-gray-50">
                        Tiện ích
                    </div>
                    <div class="grid grid-cols-3 gap-4 p-4">
                        <a href="{{ route('admin.dashboard') }}" class="block p-4 text-center rounded-lg hover:bg-gray-100 group">
                            @svg('tabler-chart-pie', 'text-gray-500 mx-auto mb-1 w-7 h-7 group-hover:text-gray-500')
                            <div class="text-sm text-gray-900 ">Thống kê</div>
                        </a>
                        <a href="#" class="block p-4 text-center rounded-lg hover:bg-gray-100 group">
                            @svg('tabler-moneybag', 'text-gray-500 mx-auto mb-1 w-7 h-7 group-hover:text-gray-500')
                            <div class="text-sm text-gray-900 ">Doanh thu</div>
                        </a>
                        <a href="{{ route('admin.users.index') }}" class="block p-4 text-center rounded-lg hover:bg-gray-100 group">
                            @svg('tabler-user', 'text-gray-500 mx-auto mb-1 w-7 h-7 group-hover:text-gray-500')
                            <div class="text-sm text-gray-900 ">Tài khoản</div>
                        </a>
                        <a href="{{route('admin.categories.index')}}" class="block p-4 text-center rounded-lg hover:bg-gray-100 group">
                            @svg('tabler-category', 'text-gray-500 mx-auto mb-1 w-7 h-7 group-hover:text-gray-500')
                            <div class="text-sm text-gray-900 ">Danh mục</div>
                        </a>
                        <a href="{{ route('admin.products.index') }}" class="block p-4 text-center rounded-lg hover:bg-gray-100 group">
                            @svg('tabler-pizza', 'text-gray-500 mx-auto mb-1 w-7 h-7 group-hover:text-gray-500')
                            <div class="text-sm text-gray-900 ">Sản phẩm</div>
                        </a>
                        <a href="{{ route('admin.attributes.index') }}" class="block p-4 text-center rounded-lg hover:bg-gray-100 group">
                            @svg('tabler-sort-deacending-small-big', 'text-gray-500 mx-auto mb-1 w-7 h-7 group-hover:text-gray-500')
                            <div class="text-sm text-gray-900 ">Thuộc tính</div>
                        </a>
                        <a href="{{ route('admin.toppings.index')}}" class="block p-4 text-center rounded-lg hover:bg-gray-100 group">
                            @svg('tabler-egg', 'text-gray-500 mx-auto mb-1 w-7 h-7 group-hover:text-gray-500')
                            <div class="text-sm text-gray-900 ">Topping</div>
                        </a>
                        <a href="{{ route('admin.orders.index') }}" class="block p-4 text-center rounded-lg hover:bg-gray-100 group">
                            @svg('tabler-package', 'text-gray-500 mx-auto mb-1 w-7 h-7 group-hover:text-gray-500')
                            <div class="text-sm text-gray-900 ">Đơn hàng</div>
                        </a>
                        <a href="{{ route('admin.invoices.index') }}" class="block p-4 text-center rounded-lg hover:bg-gray-100 group">
                            @svg('tabler-file-invoice', 'text-gray-500 mx-auto mb-1 w-7 h-7 group-hover:text-gray-500')
                            <div class="text-sm text-gray-900 ">Hóa đơn</div>
                        </a>
                        <a href="{{ route('admin.shippings.index') }}" class="block p-4 text-center rounded-lg hover:bg-gray-100 group">
                            @svg('tabler-truck-delivery', 'text-gray-500 mx-auto mb-1 w-7 h-7 group-hover:text-gray-500')
                            <div class="text-sm text-gray-900 ">Giao hàng</div>
                        </a>
                        <a href="{{ route('admin.promotions.index') }}" class="block p-4 text-center rounded-lg hover:bg-gray-100 group">
                            @svg('tabler-discount-2', 'text-gray-500 mx-auto mb-1 w-7 h-7 group-hover:text-gray-500')
                            <div class="text-sm text-gray-900 ">Mã giảm giá</div>
                        </a>
                        <a href="{{ route('admin.banners.index') }}" class="block p-4 text-center rounded-lg hover:bg-gray-100 group">
                            @svg('tabler-slideshow', 'text-gray-500 mx-auto mb-1 w-7 h-7 group-hover:text-gray-500')
                            <div class="text-sm text-gray-900 ">Banner</div>
                        </a>
                    </div>
                </div>
                <button type="button" class="flex mx-3 bg-gray-800 rounded-full md:mr-0 ring-0 focus:ring-0"
                    id="user-menu-button" aria-expanded="false" data-dropdown-toggle="dropdown">
                    <span class="sr-only">Open user menu</span>
                    <img loading="lazy" class="w-8 h-8 rounded-full"
                        src="https://flowbite.com/docs/images/people/profile-picture-5.jpg" alt="user photo">
                </button>
                <!-- User Dropdown menu -->
                <div class="hidden z-50 my-4 w-56 list-none bg-white rounded divide-y divide-gray-100 shadow text-sm"
                    id="dropdown">
                    <div class="py-3 px-4">
                        <span class="block font-semibold text-gray-900">{{ Auth::user()->fullname }}</span>
                        <span class="block text-gray-500 truncate">{{ Auth::user()->email }}</span>
                    </div>
                    <ul class="py-1 text-gray-500" aria-labelledby="dropdown">
                        <li>
                            <a href="{{ route('client.home') }}" class="block py-2 px-4 hover:bg-gray-100">Trang cửa
                                hàng</a>
                        </li>
                        <li>
                            <a href="#" class="block py-2 px-4 hover:bg-gray-100">Tài
                                khoản</a>
                        </li>
                        <li>
                            <a href="#" class="block py-2 px-4 hover:bg-gray-100">Cài
                                đặt</a>
                        </li>
                    </ul>
                    <ul class="py-1 text-gray-500" aria-labelledby="dropdown">
                        <li>
                            <a href="{{ route('auth.logout') }}"
                                class="block py-2 px-4 hover:bg-gray-100 text-red-500">Đăng
                                xuất</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</nav>
