<nav class="fixed top-0 z-50 w-full border-b border-gray-200 bg-white">
    <div class="px-3 py-3 lg:px-5 lg:pl-3">
        <div class="flex items-center justify-between">
            <div class="flex items-center justify-start rtl:justify-end">
                <button aria-controls="logo-sidebar" class="inline-flex items-center rounded-lg p-2 text-gray-500 ring-0 hover:bg-gray-100 focus:outline-none focus:ring-0 sm:hidden" data-drawer-target="logo-sidebar" data-drawer-toggle="logo-sidebar" type="button">
                    <span class="sr-only">Open sidebar</span>
                    @svg('tabler-baseline-density-medium', 'w-6 h-6 text-gray-500')
                </button>
                <a class="ms-2 flex md:me-24" href="{{ route('admin.dashboard') }}">
                    <img alt="" class="img-sm me-3" loading="lazy" src="{{ asset('storage/uploads/logo/logo.svg') }}">
                    <span class="hidden self-center whitespace-nowrap text-lg font-semibold md:block">Ladybug
                        Pizza</span>
                </a>
            </div>
            <div class="flex items-center">
                {{-- <!-- Notifications -->
                <button type="button" data-dropdown-toggle="notification-dropdown"
                    class="p-2 mr-1 text-gray-500 rounded-lg hover:text-gray-900 hover:bg-gray-100 ring-0 focus:ring-0">
                    <span class="sr-only">Xem thông báo</span>
                    <!-- Bell icon -->
                    @svg('tabler-bell', 'w-6 h-6 text-gray-500')
                    @if ($notifications > 0)
                        <span class="top-0 badge-noti">{{ $notifications }}</span>
                    @endif
                </button>
                <!-- Thong bao -->
                <div class="hidden overflow-hidden z-50 my-4 max-w-sm list-none bg-white rounded divide-y divide-gray-100 shadow-lg text-sm"
                    id="notification-dropdown">
                    <div class="block py-2 px-4 text-base font-medium text-center text-gray-700 bg-gray-50">
                        Thông báo
                    </div>
                    <div>
                        <a href="#" class="flex py-3 px-4 border-b hover:bg-gray-100">
                            <div class="flex-shrink-0">
                                <img loading="lazy" class="w-11 h-11 rounded-full object-cover"
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
                                <img loading="lazy" class="w-11 h-11 rounded-full object-cover"
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
                </div> --}}
                <button aria-expanded="false" class="mx-3 flex rounded-full bg-gray-800 ring-0 focus:ring-0 md:mr-0" data-dropdown-toggle="dropdown" id="user-menu-button" type="button">
                    <span class="sr-only">Open user menu</span>
                    <img class="h-10 w-10 rounded-full object-cover" src="{{ Auth::user()->avatar() }}">
                </button>
                <!-- User Dropdown menu -->
                <div class="z-50 my-4 hidden w-56 list-none divide-y divide-gray-100 rounded bg-white text-sm shadow" id="dropdown">
                    <div class="px-4 py-3">
                        <span class="block font-semibold text-gray-900">{{ Auth::user()->fullname }}</span>
                        <span class="block truncate text-gray-500">{{ Auth::user()->email }}</span>
                    </div>
                    <ul aria-labelledby="dropdown" class="py-1 text-gray-500">
                        <li>
                            <a class="block px-4 py-2 hover:bg-gray-100" href="{{ route('client.home') }}" target="_blank">Trang cửa
                                hàng</a>
                        </li>
                        <li>
                            <a class="block px-4 py-2 hover:bg-gray-100" href="{{ route('admin.profiles.index') }}">Tài
                                khoản</a>
                        </li>
                        {{-- <li>
                            <a href="#" class="block py-2 px-4 hover:bg-gray-100">Cài
                                đặt</a>
                        </li> --}}
                    </ul>
                    <ul aria-labelledby="dropdown" class="py-1 text-gray-500">
                        <li>
                            <a class="block px-4 py-2 text-red-500 hover:bg-gray-100" data-modal-target="logoutModal" data-modal-toggle="logoutModal" href="#">Đăng
                                xuất
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</nav>

{{-- Logout Modal --}}
<div aria-hidden="true" class="fixed left-0 right-0 top-0 z-50 hidden h-modal w-full items-center justify-center overflow-y-auto overflow-x-hidden md:inset-0 md:h-full" id="logoutModal" tabindex="-1">
    <div class="relative h-auto w-full max-w-2xl p-4">
        <div class="relative rounded-lg bg-white p-4 shadow sm:p-5">
            <div class="mb-4 flex items-center justify-between rounded-t border-b pb-4 sm:mb-5">
                <h3 class="font-semibold text-gray-900">
                    Đăng xuất
                </h3>
                <button class="ml-auto inline-flex items-center rounded-lg bg-transparent p-1.5 text-sm text-gray-400 hover:bg-gray-200 hover:text-gray-900" data-modal-toggle="logoutModal" type="button">
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
                <button class="button-gray" data-modal-hide="logoutModal" type="button">
                    Huỷ
                </button>
            </div>
        </div>
    </div>
</div>
