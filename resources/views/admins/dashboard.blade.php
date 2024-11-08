@extends('layouts.admin')
@section('content')
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.9.1/dist/chart.min.js"></script>
    {{ Breadcrumbs::render('admin.dashboard') }}
    {{-- Tổng quan --}}
    <h3 class="my-3 text-base font-bold leading-none text-gray-900 sm:text-xl">Tổng quan</h3>
    <div class="my-4 grid w-full grid-cols-1 gap-4 xl:grid-cols-2 2xl:grid-cols-4">
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

    <div class="grid grid-cols-2 items-center justify-between pb-4 space-y-3 md:space-y-0 md:space-x-4">
        <div class="w-full md:w-1/2">
            <h3 class="my-3 text-base font-bold leading-none text-gray-900 sm:text-xl">Doanh thu</h3>
        </div>
        <div
            class="flex flex-col items-stretch justify-end flex-shrink-0 w-full space-y-2 md:w-auto md:flex-row md:space-y-0 md:items-center md:space-x-3">
            <div class="flex items-center w-full space-x-3 md:w-auto">
                <button id="filterDropdownButton" data-dropdown-toggle="filterDropdown"
                    class="flex items-center justify-center w-full px-4 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg md:w-auto focus:outline-none hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:ring-0"
                    type="button">
                    Filter
                    @svg ('tabler-chevron-down', 'w-4 h-4 ml-2 text-gray-500')
                </button>
                <!-- Dropdown menu -->
                <div id="filterDropdown" class="z-10 hidden w-48 p-3 bg-white rounded-lg shadow">
                    <h6 class="mb-3 text-sm font-medium text-gray-900">
                        Category
                    </h6>
                    <ul class="space-y-2 text-sm" aria-labelledby="dropdownDefault">
                        <li class="flex items-center">
                            <input id="apple" type="checkbox" value=""
                                class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-0" />
                            <label for="apple" class="ml-2 text-sm font-medium text-gray-900">
                                Apple (56)
                            </label>
                        </li>
                        <li class="flex items-center">
                            <input id="fitbit" type="checkbox" value=""
                                class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-0" />
                            <label for="fitbit" class="ml-2 text-sm font-medium text-gray-900">
                                Fitbit (56)
                            </label>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="card max-w-full p-8 mb-3">
        {!! $chart->container() !!}
    </div>

    <div class="my-4 grid grid-cols-1 xl:grid-cols-2 xl:gap-4 gap-y-4">
        <div>
            <div
                class="relative col-span-2 flex flex-col min-w-0 border break-words bg-white shadow-soft-xl rounded-lg bg-clip-border">
                <div class="rounded-lg p-4 sm:p-6 2xl:col-span-2">
                    <div class="grid grid-cols-2 items-center justify-between pb-4 space-y-3 md:space-y-0 md:space-x-4">
                        <div class="w-full md:w-1/2">
                            <h3 class="my-3 text-base font-bold leading-none text-gray-900 sm:text-xl">Doanh thu</h3>
                        </div>
                        <div
                            class="flex flex-col items-stretch justify-end flex-shrink-0 w-full space-y-2 md:w-auto md:flex-row md:space-y-0 md:items-center md:space-x-3">
                            <div class="flex items-center w-full space-x-3 md:w-auto">
                                <button id="filterDropdownButton" data-dropdown-toggle="filterDropdown"
                                    class="flex items-center justify-center w-full px-4 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg md:w-auto focus:outline-none hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:ring-0"
                                    type="button">
                                    Filter
                                    @svg ('tabler-chevron-down', 'w-4 h-4 ml-2 text-gray-500')
                                </button>
                                <!-- Dropdown menu -->
                                <div id="filterDropdown" class="z-10 hidden w-48 p-3 bg-white rounded-lg shadow">
                                    <h6 class="mb-3 text-sm font-medium text-gray-900">
                                        Category
                                    </h6>
                                    <ul class="space-y-2 text-sm" aria-labelledby="dropdownDefault">
                                        <li class="flex items-center">
                                            <input id="apple" type="checkbox" value=""
                                                class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-0" />
                                            <label for="apple" class="ml-2 text-sm font-medium text-gray-900">
                                                Apple (56)
                                            </label>
                                        </li>
                                        <li class="flex items-center">
                                            <input id="fitbit" type="checkbox" value=""
                                                class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-0" />
                                            <label for="fitbit" class="ml-2 text-sm font-medium text-gray-900">
                                                Fitbit (56)
                                            </label>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="max-w-full mb-3">
                        {!! $revenueChart1->container() !!}
                    </div>
                </div>
            </div>
        </div>
        <div class="grid grid-cols-1 xl:grid-cols-2 gap-4">
            <div
                class="relative flex flex-col min-w-0 border break-words bg-white shadow-soft-xl rounded-lg bg-clip-border">
                <div class="rounded-lg p-4 sm:p-6 2xl:col-span-2">
                    <div class="grid grid-cols-2 items-center justify-between pb-4 space-y-3 md:space-y-0 md:space-x-4">
                        <div class="w-full md:w-1/2">
                            <h3 class="my-3 text-sm font-bold leading-none text-gray-900 sm:text-base">Doanh thu</h3>
                        </div>
                        <div
                            class="flex flex-col items-stretch justify-end flex-shrink-0 w-full space-y-2 md:w-auto md:flex-row md:space-y-0 md:items-center md:space-x-3">
                            <div class="flex items-center w-full space-x-3 md:w-auto">
                                <button id="filterDropdownButton" data-dropdown-toggle="filterDropdown"
                                    class="flex items-center justify-center w-full px-4 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg md:w-auto focus:outline-none hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:ring-0"
                                    type="button">
                                    Filter
                                    @svg ('tabler-chevron-down', 'w-4 h-4 ml-2 text-gray-500')
                                </button>
                                <!-- Dropdown menu -->
                                <div id="filterDropdown" class="z-10 hidden w-48 p-3 bg-white rounded-lg shadow">
                                    <h6 class="mb-3 text-sm font-medium text-gray-900">
                                        Category
                                    </h6>
                                    <ul class="space-y-2 text-sm" aria-labelledby="dropdownDefault">
                                        <li class="flex items-center">
                                            <input id="apple" type="checkbox" value=""
                                                class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-0" />
                                            <label for="apple" class="ml-2 text-sm font-medium text-gray-900">
                                                Apple (56)
                                            </label>
                                        </li>
                                        <li class="flex items-center">
                                            <input id="fitbit" type="checkbox" value=""
                                                class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-0" />
                                            <label for="fitbit" class="ml-2 text-sm font-medium text-gray-900">
                                                Fitbit (56)
                                            </label>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="max-w-full mb-3">
                        {!! $revenueChart2->container() !!}
                    </div>
                </div>
            </div>
            <div
                class="relative flex flex-col min-w-0 border break-words bg-white shadow-soft-xl rounded-lg bg-clip-border">
                <div class="rounded-lg p-4 sm:p-6 2xl:col-span-2">
                    <div class="grid grid-cols-2 items-center justify-between pb-4 space-y-3 md:space-y-0 md:space-x-4">
                        <div class="w-full md:w-1/2">
                            <h3 class="my-3 text-sm font-bold leading-none text-gray-900 sm:text-base">Doanh thu</h3>
                        </div>
                        <div
                            class="flex flex-col items-stretch justify-end flex-shrink-0 w-full space-y-2 md:w-auto md:flex-row md:space-y-0 md:items-center md:space-x-3">
                            <div class="flex items-center w-full space-x-3 md:w-auto">
                                <button id="filterDropdownButton" data-dropdown-toggle="filterDropdown"
                                    class="flex items-center justify-center w-full px-4 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg md:w-auto focus:outline-none hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:ring-0"
                                    type="button">
                                    Filter
                                    @svg ('tabler-chevron-down', 'w-4 h-4 ml-2 text-gray-500')
                                </button>
                                <!-- Dropdown menu -->
                                <div id="filterDropdown" class="z-10 hidden w-48 p-3 bg-white rounded-lg shadow">
                                    <h6 class="mb-3 text-sm font-medium text-gray-900">
                                        Category
                                    </h6>
                                    <ul class="space-y-2 text-sm" aria-labelledby="dropdownDefault">
                                        <li class="flex items-center">
                                            <input id="apple" type="checkbox" value=""
                                                class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-0" />
                                            <label for="apple" class="ml-2 text-sm font-medium text-gray-900">
                                                Apple (56)
                                            </label>
                                        </li>
                                        <li class="flex items-center">
                                            <input id="fitbit" type="checkbox" value=""
                                                class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-0" />
                                            <label for="fitbit" class="ml-2 text-sm font-medium text-gray-900">
                                                Fitbit (56)
                                            </label>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="max-w-full mb-3">
                        {!! $revenueChart3->container() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="my-4 grid grid-cols-1 xl:grid-cols-3 xl:gap-4 gap-y-4">
        <div class="rounded-lg col-span-2 border border-gray-200 bg-white p-4 shadow-sm sm:p-6 2xl:col-span-2">
            <div class="grid grid-cols-2 items-center justify-between pb-4 space-y-3 md:space-y-0 md:space-x-4">
                <div class="w-full md:w-1/2">
                    <h3 class="my-3 text-base font-bold leading-none text-gray-900 sm:text-xl">Doanh thu</h3>
                </div>
                <div
                    class="flex flex-col items-stretch justify-end flex-shrink-0 w-full space-y-2 md:w-auto md:flex-row md:space-y-0 md:items-center md:space-x-3">
                    <div class="flex items-center w-full space-x-3 md:w-auto">
                        <button id="filterDropdownButton" data-dropdown-toggle="filterDropdown"
                            class="flex items-center justify-center w-full px-4 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg md:w-auto focus:outline-none hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:ring-0"
                            type="button">
                            Filter
                            @svg ('tabler-chevron-down', 'w-4 h-4 ml-2 text-gray-500')
                        </button>
                        <!-- Dropdown menu -->
                        <div id="filterDropdown" class="z-10 hidden w-48 p-3 bg-white rounded-lg shadow">
                            <h6 class="mb-3 text-sm font-medium text-gray-900">
                                Category
                            </h6>
                            <ul class="space-y-2 text-sm" aria-labelledby="dropdownDefault">
                                <li class="flex items-center">
                                    <input id="apple" type="checkbox" value=""
                                        class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-0" />
                                    <label for="apple" class="ml-2 text-sm font-medium text-gray-900">
                                        Apple (56)
                                    </label>
                                </li>
                                <li class="flex items-center">
                                    <input id="fitbit" type="checkbox" value=""
                                        class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-0" />
                                    <label for="fitbit" class="ml-2 text-sm font-medium text-gray-900">
                                        Fitbit (56)
                                    </label>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="max-w-full mb-3">
                {!! $revenueChart4->container() !!}
            </div>
        </div>
        <!--Tabs widget -->
        <div class="rounded-lg border border-gray-200 bg-white p-4 shadow-sm sm:p-6">
            <div class="grid grid-cols-2 items-center justify-between pb-4 space-y-3 md:space-y-0 md:space-x-4">
                <div class="w-full md:w-1/2">
                    <h3 class="my-3 text-base font-bold leading-none text-gray-900 sm:text-xl">Doanh thu</h3>
                </div>
                <div
                    class="flex flex-col items-stretch justify-end flex-shrink-0 w-full space-y-2 md:w-auto md:flex-row md:space-y-0 md:items-center md:space-x-3">
                    <div class="flex items-center w-full space-x-3 md:w-auto">
                        <button id="dropdownNavbarLink" data-dropdown-toggle="dropdownNavbar"
                            data-dropdown-placement="bottom-start"
                            class="flex items-center justify-center w-full px-4 py-2 text-sm font-medium text-gray-900 md:w-auto focus:outline-none hover:text-primary-700 focus:z-10 focus:ring-0">
                            Filter
                            @svg ('tabler-chevron-down', 'w-4 h-4 ml-2 text-gray-500')
                        </button>
                        <!-- Dropdown menu -->
                        <div id="dropdownNavbar"
                            class="z-10 hidden font-normal bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700 dark:divide-gray-600">
                            <ul class="py-2 text-sm text-gray-700 dark:text-gray-200"
                                aria-labelledby="dropdownLargeButton">
                                <li>
                                    <a href="#"
                                        class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Dashboard</a>
                                </li>
                                <li>
                                    <a href="#"
                                        class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Settings</a>
                                </li>
                                <li>
                                    <a href="#"
                                        class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Earnings</a>
                                </li>
                            </ul>
                            <div class="py-1">
                                <a href="#"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Sign
                                    out</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-2 items-center justify-between pb-4 space-y-3 md:space-y-0 md:space-x-4">
        <div class="w-full md:w-1/2">
            <h3 class="my-3 text-base font-bold leading-none text-gray-900 sm:text-xl">Người dùng</h3>
        </div>
        <div
            class="flex flex-col items-stretch justify-end flex-shrink-0 w-full space-y-2 md:w-auto md:flex-row md:space-y-0 md:items-center md:space-x-3">
            <div class="flex items-center w-full space-x-3 md:w-auto">
                <button id="filterDropdownButton" data-dropdown-toggle="filterDropdown"
                    class="flex items-center justify-center w-full px-4 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg md:w-auto focus:outline-none hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:ring-0"
                    type="button">
                    Filter
                    @svg ('tabler-chevron-down', 'w-4 h-4 ml-2 text-gray-500')
                </button>
                <!-- Dropdown menu -->
                <div id="filterDropdown" class="z-10 hidden w-48 p-3 bg-white rounded-lg shadow">
                    <h6 class="mb-3 text-sm font-medium text-gray-900">
                        Category
                    </h6>
                    <ul class="space-y-2 text-sm" aria-labelledby="dropdownDefault">
                        <li class="flex items-center">
                            <input id="apple" type="checkbox" value=""
                                class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-0" />
                            <label for="apple" class="ml-2 text-sm font-medium text-gray-900">
                                Apple (56)
                            </label>
                        </li>
                        <li class="flex items-center">
                            <input id="fitbit" type="checkbox" value=""
                                class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-0" />
                            <label for="fitbit" class="ml-2 text-sm font-medium text-gray-900">
                                Fitbit (56)
                            </label>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="card max-w-full p-8 mb-3">
        {!! $userChart1->container() !!}
    </div>

    <div class="mt-4 grid w-full grid-cols-1 gap-4 xl:grid-cols-2 2xl:grid-cols-3">
        <div class="rounded-lg border border-gray-200 bg-white p-4 shadow-sm sm:p-6">
            <div class="max-w-full p-8 mb-3">
                {!! $userChart2->container() !!}
            </div>
        </div>
        <div class="rounded-lg border border-gray-200 bg-white p-4 shadow-sm sm:p-6">
            <div class="max-w-full p-8 mb-3">
                {!! $userChart3->container() !!}
            </div>
        </div>
        <div class="rounded-lg border border-gray-200 bg-white p-4 shadow-sm sm:p-6">
            <div class="max-w-full p-8 mb-3">
                {!! $userChart4->container() !!}
            </div>
        </div>
    </div>

    <div class="grid grid-cols-2 items-center justify-between pb-4 space-y-3 md:space-y-0 md:space-x-4 mt-4">
        <div class="w-full md:w-1/2">
            <h3 class="my-3 text-base font-bold leading-none text-gray-900 sm:text-xl">Sản phẩm</h3>
        </div>
        <div
            class="flex flex-col items-stretch justify-end flex-shrink-0 w-full space-y-2 md:w-auto md:flex-row md:space-y-0 md:items-center md:space-x-3">
            <div class="flex items-center w-full space-x-3 md:w-auto">
                <button id="filterDropdownButton" data-dropdown-toggle="filterDropdown"
                    class="flex items-center justify-center w-full px-4 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg md:w-auto focus:outline-none hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:ring-0"
                    type="button">
                    Filter
                    @svg ('tabler-chevron-down', 'w-4 h-4 ml-2 text-gray-500')
                </button>
                <!-- Dropdown menu -->
                <div id="filterDropdown" class="z-10 hidden w-48 p-3 bg-white rounded-lg shadow">
                    <h6 class="mb-3 text-sm font-medium text-gray-900">
                        Category
                    </h6>
                    <ul class="space-y-2 text-sm" aria-labelledby="dropdownDefault">
                        <li class="flex items-center">
                            <input id="apple" type="checkbox" value=""
                                class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-0" />
                            <label for="apple" class="ml-2 text-sm font-medium text-gray-900">
                                Apple (56)
                            </label>
                        </li>
                        <li class="flex items-center">
                            <input id="fitbit" type="checkbox" value=""
                                class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-0" />
                            <label for="fitbit" class="ml-2 text-sm font-medium text-gray-900">
                                Fitbit (56)
                            </label>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="grid w-full grid-cols-1 gap-4 xl:grid-cols-2">
        <div class="rounded-lg border border-gray-200 bg-white p-4 shadow-sm sm:p-6">
            <div class="max-w-full px-8">
                {!! $revenueChart1->container() !!}
            </div>
        </div>
        <div class="rounded-lg border border-gray-200 bg-white p-4 shadow-sm sm:p-6">
            <div class="max-w-full px-8">
                {!! $userChart5->container() !!}
            </div>
        </div>
    </div>

    <div class="grid w-full grid-cols-1 gap-4 xl:grid-cols-2 mt-5">
        <div class="rounded-lg border border-gray-200 bg-white p-4 shadow-sm sm:p-6">
            <div class="max-w-full px-8">
                {!! $userChart1->container() !!}
            </div>
        </div>
        <div class="rounded-lg border border-gray-200 bg-white p-4 shadow-sm sm:p-6">
            <div class="max-w-full px-8">
                {!! $userChart6->container() !!}
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    {{ $chart->script() }}
    {{ $revenueChart1->script() }}
    {{ $revenueChart2->script() }}
    {{ $revenueChart3->script() }}
    {{ $revenueChart4->script() }}
    {{ $userChart1->script() }}
    {{ $userChart2->script() }}
    {{ $userChart3->script() }}
    {{ $userChart4->script() }}
    {{ $userChart5->script() }}
    {{ $userChart6->script() }}
@endsection
