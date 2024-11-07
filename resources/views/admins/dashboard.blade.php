@extends('layouts.admin')
@section('content')
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.9.1/dist/chart.min.js"></script>
    {{ Breadcrumbs::render('admin.dashboard') }}
    {{-- Tổng quan --}} 
    <h3 class="my-3 text-base font-bold leading-none text-gray-900 sm:text-xl">Tổng quan</h3>
    <div class="mt-4 grid w-full grid-cols-1 gap-4 xl:grid-cols-2 2xl:grid-cols-4">
        <div class="relative flex flex-col min-w-0 border break-words bg-white shadow-soft-xl rounded-lg bg-clip-border">
            <div class="flex-auto p-4">
                <div class="flex flex-row -mx-3 items-center">
                    <div class="flex-none w-2/3 max-w-full px-3">
                        <div>
                            <p class="mb-0 font-sans font-semibold leading-normal text-lg">Tài khoản</p>
                            <h5 class="mb-0 font-bold text-base">
                                2,340
                            </h5>
                        </div>
                    </div>
                    <div class="px-3 text-right basis-1/3 flex items-center justify-end">
                        @svg('tabler-user', 'w-8 h-8 text-gray-500')
                    </div>
                </div>
            </div>
        </div>
        <div class="relative flex flex-col min-w-0 border break-words bg-white shadow-soft-xl rounded-lg bg-clip-border">
            <div class="flex-auto p-4">
                <div class="flex flex-row -mx-3 items-center">
                    <div class="flex-none w-2/3 max-w-full px-3">
                        <div>
                            <p class="mb-0 font-sans font-semibold leading-normal text-lg">Đơn hàng</p>
                            <h5 class="mb-0 font-bold text-base">
                                2,340
                            </h5>
                        </div>
                    </div>
                    <div class="px-3 text-right basis-1/3 flex items-center justify-end">
                        @svg('tabler-package', 'w-8 h-8 text-gray-500')
                    </div>
                </div>
            </div>
        </div>
        <div class="relative flex flex-col min-w-0 border break-words bg-white shadow-soft-xl rounded-lg bg-clip-border">
            <div class="flex-auto p-4">
                <div class="flex flex-row -mx-3 items-center">
                    <div class="flex-none w-2/3 max-w-full px-3">
                        <div>
                            <p class="mb-0 font-sans font-semibold leading-normal text-lg">Sản phẩm</p>
                            <h5 class="mb-0 font-bold text-base">
                                2,340
                            </h5>
                        </div>
                    </div>
                    <div class="px-3 text-right basis-1/3 flex items-center justify-end">
                        @svg('tabler-pizza', 'w-8 h-8 text-gray-500')
                    </div>
                </div>
            </div>
        </div>
        <div class="relative flex flex-col min-w-0 border break-words bg-white shadow-soft-xl rounded-lg bg-clip-border">
            <div class="flex-auto p-4">
                <div class="flex flex-row -mx-3 items-center">
                    <div class="flex-none w-2/3 max-w-full px-3">
                        <div>
                            <p class="mb-0 font-sans font-semibold leading-normal text-lg">Danh mục</p>
                            <h5 class="mb-0 font-bold text-base">
                                2,340
                            </h5>
                        </div>
                    </div>
                    <div class="px-3 text-right basis-1/3 flex items-center justify-end">
                        @svg('tabler-category', 'w-8 h-8 text-gray-500')
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- Doanh thu --}}
    <h3 class="my-3 text-base font-bold leading-none text-gray-900 sm:text-xl">Doanh thu</h3>
    <div class="card max-w-full p-8 mb-3">
        {!! $chart->container() !!}
    </div>
    {{-- Đơn hàng --}}
    {{-- Người dùng --}}
    {{-- Sản phẩm --}}
    {{-- Mã giảm giá --}}
    <!-- Main widget -->
    <div class="grid gap-4 xl:grid-cols-2 2xl:grid-cols-3">
        <div class="rounded-lg border border-gray-200 bg-white p-4 shadow-sm sm:p-6 2xl:col-span-2">
            <div class="mb-4 flex items-center justify-between">
                <div class="flex-shrink-0">
                    <span class="text-base font-bold leading-none text-gray-900 sm:text-2xl">$45,385</span>
                    <h3 class="font-light text-gray-500">Sales this week</h3>
                </div>
                <div class="flex flex-1 items-center justify-end font-medium text-green-500">
                    12.5%
                    @svg('tabler-arrow-narrow-up', 'w-5 h-5 ml-1')
                </div>
            </div>
            <div id="main-chart"></div>
            <!-- Card Footer -->
            <div class="mt-4 flex items-center justify-between border-t border-gray-200 pt-3 sm:pt-6">
                <div>
                    <button
                        class="inline-flex items-center rounded-lg p-2 text-center text-sm font-medium text-gray-500 hover:text-gray-900"
                        data-dropdown-toggle="weekly-sales-dropdown" type="button">Last 7 days
                        @svg('tabler-chevron-down', 'w-5 h-5 ml-1')
                    </button>
                    <!-- Dropdown menu -->
                    <div class="z-50 my-4 hidden list-none divide-y divide-gray-100 rounded bg-white shadow"
                        id="weekly-sales-dropdown">
                        <div class="px-4 py-3" role="none">
                            <p class="truncate text-sm font-medium text-gray-900" role="none">
                                Sep 16, 2021 - Sep 22, 2021
                            </p>
                        </div>
                        <ul class="py-1" role="none">
                            <li>
                                <a class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" href="#"
                                    role="menuitem">Yesterday</a>
                            </li>
                            <li>
                                <a class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" href="#"
                                    role="menuitem">Today</a>
                            </li>
                            <li>
                                <a class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" href="#"
                                    role="menuitem">Last 7 days</a>
                            </li>
                            <li>
                                <a class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" href="#"
                                    role="menuitem">Last 30 days</a>
                            </li>
                            <li>
                                <a class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" href="#"
                                    role="menuitem">Last 90 days</a>
                            </li>
                        </ul>
                        <div class="py-1" role="none">
                            <a class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" href="#"
                                role="menuitem">Custom...</a>
                        </div>
                    </div>
                </div>
                <div class="flex-shrink-0">
                    <a class="text-primary-700 inline-flex items-center rounded-lg p-2 text-xs font-medium uppercase hover:bg-gray-100 sm:text-sm"
                        href="#">
                        Sales Report
                        @svg('tabler-chevron-right', 'w-5 h-5 ml-1')
                    </a>
                </div>
            </div>
        </div>
        <!--Tabs widget -->
        <div class="rounded-lg border border-gray-200 bg-white p-4 shadow-sm sm:p-6">
            <h3 class="mb-4 flex items-center text-lg font-semibold text-gray-900">Statistics this month
            </h3>
            <div class="invisible absolute z-10 inline-block w-72 rounded-lg border border-gray-200 bg-white text-sm font-light text-gray-500 opacity-0 shadow-sm transition-opacity duration-300"
                data-popover id="popover-description" role="tooltip">
                <div data-popper-arrow></div>
            </div>
            <div class="sm:hidden">
                <label class="sr-only" for="tabs">Select tab</label>
                <select
                    class="focus:border-primary-500 block w-full rounded-t-lg border-0 border-b border-gray-200 bg-gray-50 p-2.5 text-sm text-gray-900 focus:ring-0"
                    id="tabs">
                    <option>Top Product</option>
                    <option>Top Customer</option>
                </select>
            </div>
            <ul class="hidden divide-x divide-gray-200 rounded-lg text-center text-sm font-medium text-gray-500 sm:flex"
                data-tabs-toggle="#fullWidthTabContent" id="fullWidthTab" role="tablist">
                <li class="w-full">
                    <button aria-controls="faq" aria-selected="true"
                        class="inline-block w-full rounded-tl-lg bg-gray-50 p-4 hover:bg-gray-100 focus:outline-none"
                        data-tabs-target="#faq" id="faq-tab" role="tab" type="button">Top
                        products</button>
                </li>
                <li class="w-full">
                    <button aria-controls="about" aria-selected="false"
                        class="inline-block w-full rounded-tr-lg bg-gray-50 p-4 hover:bg-gray-100 focus:outline-none"
                        data-tabs-target="#about" id="about-tab" role="tab" type="button">Top
                        Customers</button>
                </li>
            </ul>
            <div class="border-t border-gray-200" id="fullWidthTabContent">
                <div aria-labelledby="faq-tab" class="hidden pt-4" id="faq" role="tabpanel">
                    <ul class="divide-y divide-gray-200" role="list">
                        <li class="py-3 sm:py-4">
                            <div class="flex items-center justify-between">
                                <div class="flex min-w-0 items-center">
                                    <img alt="imac image" class="h-10 w-10 flex-shrink-0" loading="lazy"
                                        src="https://flowbite-admin-dashboard.vercel.app/images/products/iphone.png">
                                    <div class="ml-3">
                                        <p class="truncate font-medium text-gray-900">
                                            iPhone 14 Pro
                                        </p>
                                        <div class="flex flex-1 items-center justify-end text-sm text-green-500">
                                            @svg('tabler-arrow-narrow-up', 'w-4 h-4')
                                            2.5%
                                            <span class="ml-2 text-gray-500">vs last month</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="inline-flex items-center font-semibold text-gray-900">
                                    $445,467
                                </div>
                            </div>
                        </li>
                        <li class="py-3 sm:py-4">
                            <div class="flex items-center justify-between">
                                <div class="flex min-w-0 items-center">
                                    <img alt="imac image" class="h-10 w-10 flex-shrink-0" loading="lazy"
                                        src="https://flowbite-admin-dashboard.vercel.app/images/products/iphone.png">
                                    <div class="ml-3">
                                        <p class="truncate font-medium text-gray-900">
                                            Apple iMac 27"
                                        </p>
                                        <div class="flex flex-1 items-center justify-end text-sm text-green-500">
                                            @svg('tabler-arrow-narrow-up', 'w-4 h-4')
                                            12.5%
                                            <span class="ml-2 text-gray-500">vs last month</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="inline-flex items-center font-semibold text-gray-900">
                                    $256,982
                                </div>
                            </div>
                        </li>
                        <li class="py-3 sm:py-4">
                            <div class="flex items-center justify-between">
                                <div class="flex min-w-0 items-center">
                                    <img alt="watch image" class="h-10 w-10 flex-shrink-0" loading="lazy"
                                        src="https://flowbite-admin-dashboard.vercel.app/images/products/iphone.png">
                                    <div class="ml-3">
                                        <p class="truncate font-medium text-gray-900">
                                            Apple Watch SE
                                        </p>
                                        <div class="flex flex-1 items-center justify-end text-sm text-red-600">
                                            @svg('tabler-arrow-narrow-down', 'w-4 h-4')
                                            1.35%
                                            <span class="ml-2 text-gray-500">vs last month</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="inline-flex items-center font-semibold text-gray-900">
                                    $201,869
                                </div>
                            </div>
                        </li>
                        <li class="py-3 sm:py-4">
                            <div class="flex items-center justify-between">
                                <div class="flex min-w-0 items-center">
                                    <img alt="ipad image" class="h-10 w-10 flex-shrink-0" loading="lazy"
                                        src="https://flowbite-admin-dashboard.vercel.app/images/products/iphone.png">
                                    <div class="ml-3">
                                        <p class="truncate font-medium text-gray-900">
                                            Apple iPad Air
                                        </p>
                                        <div class="flex flex-1 items-center justify-end text-sm text-green-500">
                                            @svg('tabler-arrow-narrow-up', 'w-4 h-4')
                                            12.5%
                                            <span class="ml-2 text-gray-500">vs last month</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="inline-flex items-center font-semibold text-gray-900">
                                    $103,967
                                </div>
                            </div>
                        </li>
                        <li class="py-3 sm:py-4">
                            <div class="flex items-center justify-between">
                                <div class="flex min-w-0 items-center">
                                    <img alt="imac image" class="h-10 w-10 flex-shrink-0" loading="lazy"
                                        src="https://flowbite-admin-dashboard.vercel.app/images/products/iphone.png">
                                    <div class="ml-3">
                                        <p class="truncate font-medium text-gray-900">
                                            Apple iMac 24"
                                        </p>
                                        <div class="flex flex-1 items-center justify-end text-sm text-red-600">
                                            @svg('tabler-arrow-narrow-down', 'w-4 h-4')
                                            2%
                                            <span class="ml-2 text-gray-500">vs last month</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="inline-flex items-center font-semibold text-gray-900">
                                    $98,543
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
                <div aria-labelledby="about-tab" class="hidden pt-4" id="about" role="tabpanel">
                    <ul class="divide-y divide-gray-200" role="list">
                        <li class="py-3 sm:py-4">
                            <div class="flex items-center space-x-4">
                                <div class="flex-shrink-0">
                                    <img alt="Neil image" class="h-8 w-8 rounded-full" loading="lazy"
                                        src="https://flowbite-admin-dashboard.vercel.app/images/users/neil-sims.png">
                                </div>
                                <div class="min-w-0 flex-1">
                                    <p class="truncate font-medium text-gray-900">
                                        Neil Sims
                                    </p>
                                    <p class="truncate text-sm text-gray-500">
                                        email@flowbite.com
                                    </p>
                                </div>
                                <div class="inline-flex items-center font-semibold text-gray-900">
                                    $3320
                                </div>
                            </div>
                        </li>
                        <li class="py-3 sm:py-4">
                            <div class="flex items-center space-x-4">
                                <div class="flex-shrink-0">
                                    <img alt="Neil image" class="h-8 w-8 rounded-full" loading="lazy"
                                        src="https://flowbite-admin-dashboard.vercel.app/images/users/neil-sims.png">
                                </div>
                                <div class="min-w-0 flex-1">
                                    <p class="truncate font-medium text-gray-900">
                                        Bonnie Green
                                    </p>
                                    <p class="truncate text-sm text-gray-500">
                                        email@flowbite.com
                                    </p>
                                </div>
                                <div class="inline-flex items-center font-semibold text-gray-900">
                                    $2467
                                </div>
                            </div>
                        </li>
                        <li class="py-3 sm:py-4">
                            <div class="flex items-center space-x-4">
                                <div class="flex-shrink-0">
                                    <img alt="Neil image" class="h-8 w-8 rounded-full" loading="lazy"
                                        src="https://flowbite-admin-dashboard.vercel.app/images/users/neil-sims.png">
                                </div>
                                <div class="min-w-0 flex-1">
                                    <p class="truncate font-medium text-gray-900">
                                        Michael Gough
                                    </p>
                                    <p class="truncate text-sm text-gray-500">
                                        email@flowbite.com
                                    </p>
                                </div>
                                <div class="inline-flex items-center font-semibold text-gray-900">
                                    $2235
                                </div>
                            </div>
                        </li>
                        <li class="py-3 sm:py-4">
                            <div class="flex items-center space-x-4">
                                <div class="flex-shrink-0">
                                    <img alt="Neil image" class="h-8 w-8 rounded-full" loading="lazy"
                                        src="https://flowbite-admin-dashboard.vercel.app/images/users/neil-sims.png">
                                </div>
                                <div class="min-w-0 flex-1">
                                    <p class="truncate font-medium text-gray-900">
                                        Thomes Lean
                                    </p>
                                    <p class="truncate text-sm text-gray-500">
                                        email@flowbite.com
                                    </p>
                                </div>
                                <div class="inline-flex items-center font-semibold text-gray-900">
                                    $1842
                                </div>
                            </div>
                        </li>
                        <li class="py-3 sm:py-4">
                            <div class="flex items-center space-x-4">
                                <div class="flex-shrink-0">
                                    <img alt="Neil image" class="h-8 w-8 rounded-full" loading="lazy"
                                        src="https://flowbite-admin-dashboard.vercel.app/images/users/neil-sims.png">
                                </div>
                                <div class="min-w-0 flex-1">
                                    <p class="truncate font-medium text-gray-900">
                                        Lana Byrd
                                    </p>
                                    <p class="truncate text-sm text-gray-500">
                                        email@flowbite.com
                                    </p>
                                </div>
                                <div class="inline-flex items-center font-semibold text-gray-900">
                                    $1044
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            <!-- Card Footer -->
            <div class="mt-5 flex items-center justify-between border-t border-gray-200 pt-3 sm:pt-6">
                <div>
                    <button
                        class="inline-flex items-center rounded-lg p-2 text-center text-sm font-medium text-gray-500 hover:text-gray-900"
                        data-dropdown-toggle="stats-dropdown" type="button">Last 7 days
                        @svg('tabler-chevron-down', 'w-5 h-5 ml-1')
                    </button>
                    <!-- Dropdown menu -->
                    <div class="z-50 my-4 hidden list-none divide-y divide-gray-100 rounded bg-white shadow"
                        id="stats-dropdown">
                        <div class="px-4 py-3" role="none">
                            <p class="truncate text-sm font-medium text-gray-900" role="none">
                                Sep 16, 2021 - Sep 22, 2021
                            </p>
                        </div>
                        <ul class="py-1" role="none">
                            <li>
                                <a class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" href="#"
                                    role="menuitem">Hôm qua</a>
                            </li>
                            <li>
                                <a class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" href="#"
                                    role="menuitem">Hôm nay</a>
                            </li>
                            <li>
                                <a class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" href="#"
                                    role="menuitem">Last 7 days</a>
                            </li>
                            <li>
                                <a class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" href="#"
                                    role="menuitem">Last 30 days</a>
                            </li>
                            <li>
                                <a class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" href="#"
                                    role="menuitem">Last 90 days</a>
                            </li>
                        </ul>
                        <div class="py-1" role="none">
                            <a class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" href="#"
                                role="menuitem">Custom...</a>
                        </div>
                    </div>
                </div>
                <div class="flex-shrink-0">
                    <a class="text-primary-700 inline-flex items-center rounded-lg p-2 text-xs font-medium uppercase hover:bg-gray-100 sm:text-sm"
                        href="#">
                        Full Report
                        @svg('tabler-chevron-right', 'w-4 h-4 ml-2')
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="mt-4 grid w-full grid-cols-1 gap-4 xl:grid-cols-2 2xl:grid-cols-3">
        <div class="items-center justify-between rounded-lg border border-gray-200 bg-white p-4 shadow-sm sm:flex sm:p-6">
            <div class="w-full">
                <h3 class="font-normal text-gray-500">New products</h3>
                <span class="text-2xl font-bold leading-none text-gray-900 sm:text-3xl">2,340</span>
                <p class="flex items-center font-normal text-gray-500">
                    <span class="mr-1.5 flex items-center text-sm text-green-500">
                        @svg('tabler-arrow-narrow-up', 'w-4 h-4')
                        12.5%
                    </span>
                    Since last month
                </p>
            </div>
            <div class="w-full" id="new-products-chart"></div>
        </div>
        <div class="items-center justify-between rounded-lg border border-gray-200 bg-white p-4 shadow-sm sm:flex sm:p-6">
            <div class="w-full">
                <h3 class="font-normal text-gray-500">Users</h3>
                <span class="text-2xl font-bold leading-none text-gray-900 sm:text-3xl">2,340</span>
                <p class="flex items-center font-normal text-gray-500">
                    <span class="mr-1.5 flex items-center text-sm text-green-500">
                        @svg('tabler-arrow-narrow-up', 'w-4 h-4')
                        3,4%
                    </span>
                    Since last month
                </p>
            </div>
            <div class="w-full" id="week-signups-chart"></div>
        </div>
        <div class="rounded-lg border border-gray-200 bg-white p-4 shadow-sm sm:p-6">
            <div class="w-full">
                <h3 class="mb-2 font-normal text-gray-500">Audience by age</h3>
                <div class="mb-2 flex items-center">
                    <div class="w-16 text-sm font-medium">50+</div>
                    <div class="h-2.5 w-full rounded-full bg-gray-200">
                        <div class="bg-primary-600 h-2.5 rounded-full" style="width: 18%"></div>
                    </div>
                </div>
                <div class="mb-2 flex items-center">
                    <div class="w-16 text-sm font-medium">40+</div>
                    <div class="h-2.5 w-full rounded-full bg-gray-200">
                        <div class="bg-primary-600 h-2.5 rounded-full" style="width: 15%"></div>
                    </div>
                </div>
                <div class="mb-2 flex items-center">
                    <div class="w-16 text-sm font-medium">30+</div>
                    <div class="h-2.5 w-full rounded-full bg-gray-200">
                        <div class="bg-primary-600 h-2.5 rounded-full" style="width: 60%"></div>
                    </div>
                </div>
                <div class="mb-2 flex items-center">
                    <div class="w-16 text-sm font-medium">20+</div>
                    <div class="h-2.5 w-full rounded-full bg-gray-200">
                        <div class="bg-primary-600 h-2.5 rounded-full" style="width: 30%"></div>
                    </div>
                </div>
            </div>
            <div class="w-full" id="traffic-channels-chart"></div>
        </div>
    </div>
    <div class="my-4 grid grid-cols-1 xl:grid-cols-2 xl:gap-4">
        <div class="mb-4 rounded-lg border border-gray-200 bg-white p-4 shadow-sm sm:p-6 xl:mb-0">
            <div class="mb-4 flex items-center justify-between">
                <h3 class="text-lg font-semibold text-gray-900">Smart chat</h3>
                <a class="text-primary-700 inline-flex items-center rounded-lg p-2 text-sm font-medium hover:bg-gray-100"
                    href="#">
                    View all
                </a>
            </div>
            <!-- Chat -->
            <form class="overflow-y-auto lg:max-h-[60rem] 2xl:max-h-fit">
                <article class="mb-5">
                    <footer class="mb-2 flex items-center justify-between">
                        <div class="flex items-center">
                            <p class="mr-3 inline-flex items-center text-sm font-semibold text-gray-900">
                                <img alt="Michael Gough" class="mr-2 h-6 w-6 rounded-full" loading="lazy"
                                    src="https://flowbite.com/docs/images/people/profile-picture-2.jpg">Michael
                                Gough
                            </p>
                            <p class="text-sm text-gray-600"><time datetime="2022-02-08" pubdate
                                    title="February 8th, 2022">
                                    01/03/2023 4:15 PM</time></p>
                        </div>
                        <button
                            class="inline-flex items-center rounded-lg bg-white p-2 text-center text-sm font-medium text-gray-500 hover:bg-gray-100 focus:ring-0"
                            data-dropdown-toggle="dropdownComment1" id="dropdownComment1Button" type="button">
                            @svg('tabler-dots', 'w-5 h-5')
                            <span class="sr-only">Comment settings</span>
                        </button>
                        <!-- Dropdown menu -->
                        <div class="z-10 hidden w-36 divide-y divide-gray-100 rounded bg-white shadow"
                            id="dropdownComment1">
                            <ul aria-labelledby="dropdownMenuIconHorizontalButton" class="py-1 text-sm text-gray-700">
                                <li>
                                    <a class="block px-4 py-2 hover:bg-gray-100" href="#">Edit</a>
                                </li>
                                <li>
                                    <a class="block px-4 py-2 hover:bg-gray-100" href="#">Remove</a>
                                </li>
                                <li>
                                    <a class="block px-4 py-2 hover:bg-gray-100" href="#">Report</a>
                                </li>
                            </ul>
                        </div>
                    </footer>
                    <p class="mb-2 text-gray-900">
                        Hello <a class="text-primary-600 font-medium hover:underline" href="#">@designteam</a>
                        Let's schedule a kick-off meeting and workshop this week. It would be great to gather everyone
                        involved in the design project. Let me know about your availability in the thread.
                    </p>
                    <p class="mb-3 text-gray-900">Looking forward to it! Thanks.</p>
                    <form>
                        <label class="sr-only" for="chat">Your message</label>
                        <div class="mb-5 flex items-center">
                            <textarea
                                class="focus:ring-primary-0 focus:border-primary-500 mr-4 block w-full rounded-lg border border-gray-300 bg-white p-2.5 text-sm text-gray-900"
                                id="chat" placeholder="Reply in thread..." rows="1"></textarea>
                            <button
                                class="text-primary-600 hover:bg-primary-100 inline-flex cursor-pointer justify-center rounded-lg"
                                type="submit">
                                @svg('tabler-send-2', 'w-7 h-7 text-gray-500')
                                <span class="sr-only">Send message</span>
                            </button>
                        </div>
                    </form>
                </article>
            </form>
        </div>
        <!-- Right Content -->
        <div class="grid gap-4">
            <div class="rounded-lg border border-gray-200 bg-white p-4 shadow-sm sm:p-6">
                <div class="items-center justify-between border-b border-gray-200 pb-4 sm:flex">
                    <div class="mb-4 w-full sm:mb-0">
                        <h3 class="font-normal text-gray-500">Sales by category</h3>
                        <span class="text-2xl font-bold leading-none text-gray-900 sm:text-3xl">Desktop
                            PC</span>
                        <p class="flex items-center font-normal text-gray-500">
                            <span class="mr-1.5 flex items-center text-sm text-green-500">
                                @svg('tabler-arrow-narrow-up', 'w-4 h-4')
                                2.5%
                            </span>
                            Since last month
                        </p>
                    </div>
                    <div class="w-full max-w-lg">
                        <div class="grid grid-cols-2 items-center gap-4" date-rangepicker>
                            <div class="relative">
                                <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                                    @svg('tabler-calendar-week', 'w-5 h-5 text-gray-500')
                                </div>
                                <input
                                    class="focus:border-primary-500 block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 pl-10 text-sm text-gray-900 focus:ring-0"
                                    name="start" placeholder="From" type="text">
                            </div>
                            <div class="relative">
                                <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                                    @svg('tabler-calendar-week', 'w-5 h-5 text-gray-500')
                                </div>
                                <input
                                    class="focus:border-primary-500 block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 pl-10 text-sm text-gray-900 focus:ring-0"
                                    name="end" placeholder="To" type="text">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="w-full" id="sales-by-category"></div>
                <!-- Card Footer -->
                <div class="mt-4 flex items-center justify-between border-t border-gray-200 pt-3 sm:pt-6">
                    <div>
                        <button
                            class="inline-flex items-center rounded-lg p-2 text-center text-sm font-medium text-gray-500 hover:text-gray-900"
                            data-dropdown-toggle="sales-by-category-dropdown" type="button">Last 7 days
                            @svg('tabler-chevron-down', 'w-5 h-5 ml-1')
                        </button>
                        <!-- Dropdown menu -->
                        <div class="z-50 my-4 hidden list-none divide-y divide-gray-100 rounded bg-white shadow"
                            id="sales-by-category-dropdown">
                            <div class="px-4 py-3" role="none">
                                <p class="truncate text-sm font-medium text-gray-900" role="none">
                                    Sep 16, 2021 - Sep 22, 2021
                                </p>
                            </div>
                            <ul class="py-1" role="none">
                                <li>
                                    <a class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" href="#"
                                        role="menuitem">Yesterday</a>
                                </li>
                                <li>
                                    <a class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" href="#"
                                        role="menuitem">Today</a>
                                </li>
                                <li>
                                    <a class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" href="#"
                                        role="menuitem">Last 7 days</a>
                                </li>
                                <li>
                                    <a class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" href="#"
                                        role="menuitem">Last 30 days</a>
                                </li>
                                <li>
                                    <a class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" href="#"
                                        role="menuitem">Last 90 days</a>
                                </li>
                            </ul>
                            <div class="py-1" role="none">
                                <a class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" href="#"
                                    role="menuitem">Custom...</a>
                            </div>
                        </div>
                    </div>
                    <div class="flex-shrink-0">
                        <a class="text-primary-700 inline-flex items-center rounded-lg p-2 text-xs font-medium uppercase hover:bg-gray-100 sm:text-sm"
                            href="#">
                            Sales Report
                            @svg('tabler-chevron-right', 'w-4 h-4 ml-2')
                        </a>
                    </div>
                </div>
            </div>
            <div class="rounded-lg border border-gray-200 bg-white p-4 shadow-sm sm:p-6">
                <div class="mb-4 flex items-center justify-between border-b border-gray-200 pb-4">
                    <div>
                        <h3 class="font-normal text-gray-500">Traffic by device</h3>
                        <span class="text-2xl font-bold leading-none text-gray-900 sm:text-3xl">Desktop</span>
                    </div>
                    <a class="text-primary-700 inline-flex items-center rounded-lg p-2 text-xs font-medium uppercase hover:bg-gray-100 sm:text-sm"
                        href="#">
                        Full report
                        @svg('tabler-chevron-right', 'w-4 h-4 ml-2')
                    </a>
                </div>
                <div id="traffic-by-device"></div>
                <!-- Card Footer -->
                <div class="flex items-center justify-between pt-4 sm:pt-6 lg:justify-evenly">
                    <div>
                        @svg('tabler-device-desktop', 'w-4 h-4 text-green-500')
                        <h3 class="text-gray-500">Desktop</h3>
                        <h4 class="text-base font-bold">
                            234k
                        </h4>
                        <p class="flex items-center text-sm text-gray-500">
                            <span class="mr-1.5 flex items-center text-sm text-green-500">
                                @svg('tabler-arrow-up', 'w-4 h-4')
                                4%
                            </span>
                            vs last month
                        </p>
                    </div>
                    <div>
                        @svg('tabler-device-mobile', 'w-4 h-4 text-green-500')
                        <h3 class="text-gray-500">Phone</h3>
                        <h4 class="text-base font-bold">
                            94k
                        </h4>
                        <p class="flex items-center text-sm text-gray-500">
                            <span class="mr-1.5 flex items-center text-sm text-red-600">
                                @svg('tabler-arrow-down', 'w-4 h-4')
                                1%
                            </span>
                            vs last month
                        </p>
                    </div>
                    <div>
                        @svg('tabler-device-tablet', 'w-4 h-4 text-green-500')
                        <h3 class="text-gray-500">Tablet</h3>
                        <h4 class="text-base font-bold">
                            16k
                        </h4>
                        <p class="flex items-center text-sm text-gray-500">
                            <span class="mr-1.5 flex items-center text-sm text-red-600">
                                @svg('tabler-arrow-down', 'w-4 h-4')
                                0,6%
                            </span>
                            vs last month
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{ $chart->script() }}
@endsection
