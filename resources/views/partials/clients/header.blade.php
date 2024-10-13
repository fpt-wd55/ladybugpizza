<header class="sticky top-0 z-40 border-b border-gray-300 bg-gray-100 px-4 py-2 text-black">
    <div class="h-auto md:mx-8 lg:mx-20">
        <nav class="flex items-center justify-between">
            {{-- Logo --}}
            <ul class="flex items-center gap-4">
                <a class="md:flex md:items-center" href="{{ route('client.home') }}">
                    <img alt="" class="img-sm" loading="lazy" src="{{ asset('storage/uploads/logo/logo.svg') }}">
                </a>
                <li class="text-xs uppercase transition hover:text-red-500">
                    <a href="{{ route('client.home') }}">TRANG CHỦ</a>
                </li>
                <li class="text-xs uppercase transition hover:text-red-500">
                    <a href="{{ route('client.product.menu') }}">THỰC ĐƠN</a>
                </li>
                <li class="text-xs uppercase transition hover:text-red-500">
                    <a href="{{ route('client.about-us') }}">VỀ CHÚNG TÔI</a>
                </li>
            </ul>
            <div class="flex items-center gap-4">
                <button class="hidden md:inline-block" data-modal-target="searchModal" data-modal-toggle="searchModal">@svg('tabler-search', 'icon-md')</button>

                @if (Auth::user())
                    <a href="#"> @svg('tabler-heart', 'icon-md')</a>
                    <a href="{{ route('client.cart.index') }}"> @svg('tabler-shopping-bag', 'icon-md')</a>
                    <a href="{{ route('client.order.index') }}"> @svg('tabler-truck-delivery', 'icon-md')</a>

                    <button class="hover:cursor-pointer">
                        <img class="img-circle h-8 w-8 object-cover" data-dropdown-toggle="userDropdown" loading="lazy" src="{{ Auth::user()->avatar() }}">
                    </button>

                    {{-- User dropdown --}}
                    <div class="z-10 hidden w-64 divide-y divide-gray-100 rounded-lg bg-white font-normal shadow" id="userDropdown">
                        <div class="px-4 py-3 text-sm text-gray-900 dark:text-white">
                            <p class="font-medium">{{ Auth::user()->fullname }}</p>
                            <p class="truncate">{{ Auth::user()->email }}</p>
                        </div>
                        <div class="py-2">
                            <a class="flex items-center gap-2 px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" href="{{ route('client.profile.index') }}">
                                @svg('tabler-user', 'icon-sm')
                                Hồ sơ
                            </a>
                        </div>
                        <div class="py-2">
                            <a class="flex items-center gap-2 px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" href="{{ route('client.profile.address') }}">
                                @svg('tabler-location', 'icon-sm')
                                Địa chỉ
                            </a>
                        </div>
                        <div class="py-2">
                            <a class="flex items-center gap-2 px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" href="{{ route('client.profile.settings') }}">
                                @svg('tabler-settings', 'icon-sm')
                                Cài đặt
                            </a>
                        </div>
                        <div class="py-2">
                            <a class="flex items-center gap-2 px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" href="{{ route('client.profile.membership') }}">
                                @svg('tabler-coin', 'icon-sm')
                                Tích điểm
                            </a>
                        </div>
                        <div class="py-2">
                            <a class="flex items-center gap-2 px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" href="{{ route('client.profile.promotion') }}">
                                @svg('tabler-tag', 'icon-sm')
                                Mã giảm giá
                            </a>
                        </div>
                        <div class="py-2">
                            <a class="flex items-center gap-2 px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" data-modal-target="logoutModal" data-modal-toggle="logoutModal" href="#">
                                @svg('tabler-logout', 'icon-sm')
                                Đăng xuất
                            </a>
                        </div>
                    </div>
                @else
                    <a class="" href="{{ route('auth.login') }}">
                        @svg('tabler-login', 'md:me-2 icon-md')
                    </a>
                @endif
            </div>
        </nav>
    </div>


</header>

{{-- logout Modal --}}
<div aria-hidden="true" class="fixed left-0 right-0 top-0 z-50 hidden h-modal w-full items-center justify-center overflow-y-auto overflow-x-hidden md:inset-0 md:h-full" id="logoutModal" tabindex="-1">
    <div class="relative h-auto w-full max-w-2xl p-4">
        <div class="relative rounded-lg bg-white p-4 shadow sm:p-5">
            <div class="mb-4 flex items-center justify-between rounded-t border-b pb-4 sm:mb-5">
                <h3 class="font-semibold text-gray-900 dark:text-white">
                    Đăng xuất
                </h3>
                <button class="ml-auto inline-flex items-center rounded-lg bg-transparent p-1.5 text-sm text-gray-400 hover:bg-gray-200 hover:text-gray-900 dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="logoutModal" type="button">
                    @svg('tabler-x', 'icon-sm')
                </button>
            </div>
            <div class="mb-8 flex flex-col items-center justify-center gap-4 text-sm">
                <div>@svg('tabler-alert-triangle', 'icon-2xl text-red-500')</div>
                <p>Bạn có thực sự muốn đăng xuất</p>
                <p>Bạn sẽ phải đăng nhập để có thể sử dụng một số chức năng</p>
            </div>
            <div class="flex items-center justify-center gap-4">
                <a class="button-red" href="{{ route('auth.logout') }}">
                    Đăng xuất
                </a>
                <button class="button-dark" type="button">
                    Đóng
                </button>
            </div>
        </div>
    </div>
</div>
