<header class="border-b border-gray-300 bg-white px-4 py-2 sticky top-0 z-40">
    <div class="h-auto md:mx-8 lg:mx-20">
        <nav class="flex justify-between items-center">

            {{-- Logo --}}
            <a href="{{ route('client.home') }}" class="md:flex md:items-center">
                <img class="h-12 md:h-20" src="{{ asset('storage/uploads/logos/logo-fill.png') }}" alt="">
            </a>
            <ul class="hidden lg:flex lg:items-center mx-auto">
                <li class="mx-10 font-semibold text-sm uppercase hover:text-red-500 transition">
                    <a href="{{ route('client.home') }}">TRANG CHỦ</a>
                </li>
                <li class="mx-10 font-semibold text-sm uppercase hover:text-red-500 transition ">
                    <a href="{{ route('client.product.menu') }}">THỰC ĐƠN</a>
                </li>
                <li class="mx-10 font-semibold text-sm uppercase hover:text-red-500 transition ">
                    <a href="{{ route('client.about-us') }}">VỀ CHÚNG TÔI</a>
                </li>
            </ul>
            <div class="flex items-center gap-4">
                <a href="#" data-modal-target="searchModal" data-modal-toggle="searchModal"
                    class="hidden md:inline-block">@svg('tabler-search')</a>

                {{-- Search Modal --}}
                <div id="searchModal" tabindex="-1" aria-hidden="true"
                    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                    <div class="relative p-4 w-full max-w-2xl max-h-full">
                        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                            <div
                                class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                                <p class="font-semibold text-gray-900 dark:text-white">
                                    Tìm kiếm
                                </p>
                                <button type="button"
                                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                    data-modal-hide="searchModal">
                                    @svg('tabler-x', 'icon-sm')
                                </button>
                            </div>

                            <div class="p-4 md:p-8">
                                <div class="ais-InstantSearch transition">
                                    <div id="searchbox"></div>
                                    <div id="hits"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @if (Auth::user())
                    <a href="{{ route('client.cart.index') }}"> @svg('tabler-heart')</a>
                    <a href="{{ route('client.cart.index') }}"> @svg('tabler-shopping-bag')</a>
                    <a href="{{ route('client.order.index') }}"> @svg('tabler-truck-delivery')</a>

                    <button class="hover:cursor-pointer">
                        <img data-dropdown-toggle="userDropdown" class="img-circle w-8 h-8 object-cover"
                            src="{{ filter_var(Auth::user()->avatar, FILTER_VALIDATE_URL) ? Auth::user()->avatar : asset('storage/uploads/avatars/' . (Auth::user()->avatar ?? 'user-default.png')) }}">
                    </button>

                    {{-- User dropdown --}}
                    <div id="userDropdown"
                        class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-64 font-normal">
                        <div class="px-4 py-3 text-sm text-gray-900 dark:text-white">
                            <p class="font-medium ">{{ Auth::user()->fullname }}</p>
                            <p class="truncate">{{ Auth::user()->email }}</p>
                        </div>
                        <div class="py-2">
                            <a href="{{ route('client.profile.index') }}"
                                class="flex items-center gap-2 px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                @svg('tabler-user', 'icon-sm')
                                Hồ sơ
                            </a>
                        </div>
                        <div class="py-2">
                            <a href="{{ route('client.profile.address') }}"
                                class="flex items-center gap-2 px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                @svg('tabler-location', 'icon-sm')
                                Địa chỉ
                            </a>
                        </div>
                        <div class="py-2">
                            <a href="{{ route('client.profile.settings') }}"
                                class="flex items-center gap-2 px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                @svg('tabler-settings', 'icon-sm')
                                Cài đặt
                            </a>
                        </div>
                        <div class="py-2">
                            <a href="{{ route('client.profile.membership') }}"
                                class="flex items-center gap-2 px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                @svg('tabler-coin', 'icon-sm')
                                Tích điểm
                            </a>
                        </div>
                        <div class="py-2">
                            <a href="{{ route('client.profile.promotion') }}"
                                class="flex items-center gap-2 px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                @svg('tabler-tag', 'icon-sm')
                                Mã giảm giá
                            </a>
                        </div>
                        <div class="py-2">
                            <a href="{{ route('auth.logout') }}"
                                class="flex items-center gap-2 px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                @svg('tabler-logout', 'icon-sm')
                                Đăng xuất
                            </a>
                        </div>
                    </div>
                @else
                    <a href="{{ route('auth.login') }}" class="hidden button-red transition">
                        @svg('tabler-login', 'md:me-2 icon-md')
                        <span class="hidden md:block">Đăng Nhập</span>
                    </a>
                @endif
            </div>
        </nav>
    </div>

</header>
