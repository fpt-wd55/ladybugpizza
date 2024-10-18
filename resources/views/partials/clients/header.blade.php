<header class="sticky top-0 z-40 border-b border-gray-300 bg-gray-100 px-4 py-2 text-black">
    <div class="h-auto md:mx-8 lg:mx-20">
        <nav class="flex items-center justify-between">
            {{-- Logo --}}
            <ul class="flex items-center gap-4">
                <a class="md:flex md:items-center" href="{{ route('client.home') }}">
                    <img alt="" class="img-sm" loading="lazy" src="{{ asset('storage/uploads/logo/logo.svg') }}">
                </a>

                <div class="hidden items-center gap-4 lg:flex">
                    <li class="text-xs font-medium uppercase transition hover:text-red-500">
                        <a href="{{ route('client.home') }}">TRANG CHỦ</a>
                    </li>
                    <li class="text-xs font-medium uppercase transition hover:text-red-500">
                        <a href="{{ route('client.product.menu') }}">THỰC ĐƠN</a>
                    </li>
                    <li class="text-xs font-medium uppercase transition hover:text-red-500">
                        <span class="flex items-center gap-1 hover:cursor-pointer"
                            data-dropdown-toggle="aboutUsDropdown">
                            GIỚI THIỆU
                            @svg('tabler-chevron-down', 'w-4')
                        </span>
                    </li>

                    {{-- About us dropdown --}}
                    <div class="z-10 hidden w-64 divide-y divide-gray-100 rounded-lg bg-white font-normal shadow"
                        id="aboutUsDropdown">
                        <div class="py-2">
                            <a class="flex items-center gap-2 px-4 py-2 text-xs font-medium uppercase transition hover:bg-gray-100 hover:text-red-500"
                                href="{{ route('client.about-us') }}">Về chúng tôi</a>
                        </div>
                        <div class="py-2">
                            <a class="flex items-center gap-2 px-4 py-2 text-xs font-medium uppercase transition hover:bg-gray-100 hover:text-red-500"
                                href="{{ route('client.contact') }}">Liên hệ</a>
                        </div>
                        <div class="py-2">
                            <a class="flex items-center gap-2 px-4 py-2 text-xs font-medium uppercase transition hover:bg-gray-100 hover:text-red-500"
                                href="{{ route('client.manual') }}">Hướng dẫn mua hàng</a>
                        </div>
                        <div class="py-2">
                            <a class="flex items-center gap-2 px-4 py-2 text-xs font-medium uppercase transition hover:bg-gray-100 hover:text-red-500"
                                href="{{ route('client.policies') }}">Chính sách và điều khoản</a>
                        </div>
                    </div>
                </div>
            </ul>
            <div class="flex items-center gap-4">
                <button class="hidden md:inline-block" data-modal-target="searchModal"
                    data-modal-toggle="searchModal">@svg('tabler-search', 'icon-md')</button>

                @if (Auth::user())
                    <a data-modal-target="favoriteProductModal" data-modal-toggle="favoriteProductModal" href="#">
                        @svg('tabler-heart', 'icon-md')</a>
                    <a href="{{ route('client.cart.index') }}"> @svg('tabler-shopping-bag', 'icon-md')</a>
                    <a href="{{ route('client.order.index') }}"> @svg('tabler-truck-delivery', 'icon-md')</a>

                    <button class="hover:cursor-pointer">
                        <img class="img-circle h-8 w-8 object-cover" data-dropdown-toggle="userDropdown" loading="lazy"
                            src="{{ Auth::user()->avatar() }}">
                    </button>

                    {{-- User dropdown --}}
                    <div class="z-10 hidden w-64 divide-y divide-gray-100 rounded-lg bg-white font-normal shadow"
                        id="userDropdown">
                        <div class="px-4 py-3 text-sm text-gray-900 dark:text-white">
                            <p class="font-medium">{{ Auth::user()->fullname }}</p>
                            <p class="truncate">{{ Auth::user()->email }}</p>
                        </div>
                        <div class="py-2">
                            <a class="flex items-center gap-2 px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                                href="{{ route('client.profile.index') }}">
                                @svg('tabler-user', 'icon-sm')
                                Hồ sơ
                            </a>
                        </div>
                        <div class="py-2">
                            <a class="flex items-center gap-2 px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                                href="{{ route('client.profile.address') }}">
                                @svg('tabler-location', 'icon-sm')
                                Địa chỉ
                            </a>
                        </div>
                        <div class="py-2">
                            <a class="flex items-center gap-2 px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                                href="{{ route('client.profile.settings') }}">
                                @svg('tabler-settings', 'icon-sm')
                                Cài đặt
                            </a>
                        </div>
                        <div class="py-2">
                            <a class="flex items-center gap-2 px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                                href="{{ route('client.profile.membership') }}">
                                @svg('tabler-coin', 'icon-sm')
                                Tích điểm
                            </a>
                        </div>
                        <div class="py-2">
                            <a class="flex items-center gap-2 px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                                href="{{ route('client.profile.promotion') }}">
                                @svg('tabler-tag', 'icon-sm')
                                Mã giảm giá
                            </a>
                        </div>
                        <div class="py-2">
                            <a class="flex items-center gap-2 px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                                data-modal-target="logoutModal" data-modal-toggle="logoutModal" href="#">
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

{{-- Search Modal --}}
<div aria-hidden="true"
    class="fixed left-0 right-0 top-0 z-50 hidden h-[calc(100%-1rem)] max-h-full w-full items-center justify-center overflow-y-auto overflow-x-hidden md:inset-0"
    id="searchModal" tabindex="-1">
    <div class="relative max-h-full w-full max-w-2xl p-4">
        <div class="relative rounded-lg bg-white shadow dark:bg-gray-700">
            <div class="flex items-center justify-between rounded-t border-b p-4 dark:border-gray-600 md:p-5">
                <p class="font-semibold text-gray-900 dark:text-white">
                    Tìm kiếm
                </p>
                <button
                    class="ms-auto inline-flex h-8 w-8 items-center justify-center rounded-lg bg-transparent text-sm text-gray-400 hover:bg-gray-200 hover:text-gray-900 dark:hover:bg-gray-600 dark:hover:text-white"
                    data-modal-hide="searchModal" type="button">
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

@php
    use App\Models\Favorite;
    $favorites = Favorite::where('user_id', Auth::id())->with('product')->get();
@endphp
{{-- Favorite Product Modal --}}
<div aria-hidden="true"
    class="fixed left-0 right-0 top-0 z-50 hidden h-[calc(100%-1rem)] max-h-full w-full items-center justify-center overflow-y-auto overflow-x-hidden md:inset-0"
    id="favoriteProductModal" tabindex="-1">
    <div class="relative max-h-full w-full max-w-2xl p-4">
        <div class="relative rounded-lg bg-white shadow dark:bg-gray-700">
            <div class="flex items-center justify-between rounded-t border-b p-4 dark:border-gray-600 md:p-5">
                <p class="font-semibold text-gray-900 dark:text-white">Sản phẩm yêu thích của tôi</p>
                <button
                    class="ms-auto inline-flex h-8 w-8 items-center justify-center rounded-lg bg-transparent text-sm text-gray-400 hover:bg-gray-200 hover:text-gray-900 dark:hover:bg-gray-600 dark:hover:text-white"
                    data-modal-hide="favoriteProductModal" type="button">
                    @svg('tabler-x', 'icon-sm')
                </button>
            </div>

            <div class="p-4 md:p-8">
                <div class="mb-8 grid grid-cols-2 gap-4 lg:mb-16 lg:grid-cols-2">
                    @foreach ($favorites as $favorite)
                        <a class="product-card overflow-hidden md:flex"
                            href="{{ route('client.product.show', $favorite->product->slug) }}">
                            <img alt="{{ $favorite->product->image }}"
                                class="h-48 w-full flex-shrink-0 object-cover md:h-full md:w-1/3" loading="lazy"
                                src="{{ asset('storage/uploads/products/' . $favorite->product->image) }}">
                            <div class="p-2 text-sm">
                                <p class="mb-2 font-semibold">{{ $favorite->product->name }}</p>
                                <div class="mb-2 flex items-center gap-1">
                                    <p>{{ $favorite->product->avg_rating }}</p>
                                    <div class="flex items-center gap-1">
                                        @for ($i = 0; $i < 5; $i++)
                                            @svg($i < $favorite->product->avg_rating ? 'tabler-star-filled' : 'tabler-star', 'icon-sm text-red-500')
                                        @endfor
                                    </div>
                                    <p>({{ $favorite->product->avg_rating }})</p>
                                </div>
                                <p class="mb-4 line-clamp-3 h-12">{{ $favorite->product->description }}</p>
                                <div class="bottom-4 flex items-center gap-3">
                                    <p class="text-xs text-gray-500 line-through">
                                        {{ number_format($favorite->product->price) }}đ</p>
                                    <p class="font-semibold">{{ number_format($favorite->product->discount_price) }}đ
                                    </p>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Logout Modal --}}
<div aria-hidden="true"
    class="fixed left-0 right-0 top-0 z-50 hidden h-modal w-full items-center justify-center overflow-y-auto overflow-x-hidden md:inset-0 md:h-full"
    id="logoutModal" tabindex="-1">
    <div class="relative h-auto w-full max-w-2xl p-4">
        <div class="relative rounded-lg bg-white p-4 shadow sm:p-5">
            <div class="mb-4 flex items-center justify-between rounded-t border-b pb-4 sm:mb-5">
                <h3 class="font-semibold text-gray-900 dark:text-white">
                    Đăng xuất
                </h3>
                <button
                    class="ml-auto inline-flex items-center rounded-lg bg-transparent p-1.5 text-sm text-gray-400 hover:bg-gray-200 hover:text-gray-900 dark:hover:bg-gray-600 dark:hover:text-white"
                    data-modal-toggle="logoutModal" type="button">
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
                <button class="button-dark" data-modal-hide="logoutModal" type="button">
                    Huỷ
                </button>
            </div>
        </div>
    </div>
</div>
