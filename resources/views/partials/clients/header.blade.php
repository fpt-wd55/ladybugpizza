<header class="border-b border-gray-300">
    <div class="h-auto md:mx-8 lg:mx-20">
        <nav class="flex justify-between items-center p-4">

            {{-- menu --}}
            <div class="lg:hidden hover:cursor-pointer" data-dropdown-toggle="dropdown"
                data-dropdown-toggle="dropdownDistance" data-dropdown-offset-distance="35">
                @svg('tabler-menu-2')
            </div>

            <div id="dropdown" class="z-10 hidden lg:hidden bg-white h-screen w-full px-8 py-4">
                <form class="flex items-center gap-4 mb-8">
                    <input type="text" placeholder="Tìm kiếm..." class="input" />
                    <button type="submit" class="button-icon rounded-lg">
                        @svg('tabler-search', 'icon-sm')
                    </button>
                </form>
                <div class="flex flex-col gap-8 w-full text-sm font-semibold">
                    <a href="{{ route('client.home') }}" class="">TRANG CHỦ</a>
                    <a href="{{ route('client.product.menu') }}" class="">THỰC ĐƠN</a>
                    <a href="{{ route('client.about-us') }}" class="">VỀ CHÚNG TÔI</a>
                </div>
            </div>

            {{-- Logo --}}
            <a href="{{ route('client.home') }}" class="md:flex md:items-center">
                <img class="w-20 h-20" src="{{ asset('storage/uploads/logos/logo-fill.png') }}" alt="">
            </a>
            <ul class="hidden lg:flex lg:items-center mx-auto">
                <li class="mx-10 font-semibold text-base uppercase hover:text-red-500 transition">
                    <a href="{{ route('client.home') }}">TRANG CHỦ</a>
                </li>
                <li class="mx-10 font-semibold text-base uppercase hover:text-red-500 transition ">
                    <a href="{{ route('client.product.menu') }}">THỰC ĐƠN</a>
                </li>
                <li class="mx-10 font-semibold text-base uppercase hover:text-red-500 transition ">
                    <a href="{{ route('client.about-us') }}">VỀ CHÚNG TÔI</a>
                </li>
            </ul>
            <div class="flex items-center gap-4">

                @if (Auth::user())
                    <button class="hidden md:inline-block">@svg('tabler-search')</button>
                    <a href="{{ route('client.cart.index') }}"> @svg('tabler-shopping-bag')</a>

                    <button class="hover:cursor-pointer">
                        <img data-dropdown-toggle="dropdownAvatarName" class="img-circle w-8 h-8"
                            src="{{ filter_var(Auth::user()->avatar, FILTER_VALIDATE_URL) ? Auth::user()->avatar : asset('storage/uploads/avatars/' . (Auth::user()->avatar ?? 'user-default.png')) }}">
                    </button>

                    <div id="dropdownAvatarName"
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
                    <a href="{{ route('auth.login') }}" class="hidden md:inline-block button-icon transition">
                        @svg('tabler-login', 'md:hidden icon-md')
                        <span class="hidden md:block">Đăng Nhập</span>
                    </a>
                @endif
            </div>
        </nav>
    </div>

</header>
