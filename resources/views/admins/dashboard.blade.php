@extends('layouts.admin')
@section('content')
    {{ Breadcrumbs::render('admin.dashboard') }}
    <h3 class="text-base font-bold leading-none text-gray-900 sm:text-xl mb-3">Đơn hàng</h3>
    <div class="grid gap-4 xl:grid-cols-2 2xl:grid-cols-3">
        <!-- Main widget -->

        <div class="p-4 bg-white border border-gray-200 rounded-lg shadow-sm 2xl:col-span-2 sm:p-6">
            <div class="flex items-center justify-between mb-4">
                <div class="flex-shrink-0">
                    <span class="text-base font-bold leading-none text-gray-900 sm:text-2xl">$45,385</span>
                    <h3 class="font-light text-gray-500">Sales this week</h3>
                </div>
                <div class="flex items-center justify-end flex-1 font-medium text-green-500">
                    12.5%
                    @svg('tabler-arrow-narrow-up', 'w-5 h-5 ml-1')
                </div>
            </div>
            <div id="main-chart"></div>
            <!-- Card Footer -->
            <div class="flex items-center justify-between pt-3 mt-4 border-t border-gray-200 sm:pt-6">
                <div>
                    <button
                        class="inline-flex items-center p-2 text-sm font-medium text-center text-gray-500 rounded-lg hover:text-gray-900"
                        type="button" data-dropdown-toggle="weekly-sales-dropdown">Last 7 days
                        @svg('tabler-chevron-down', 'w-5 h-5 ml-1')
                    </button>
                    <!-- Dropdown menu -->
                    <div class="z-50 hidden my-4 list-none bg-white divide-y divide-gray-100 rounded shadow"
                        id="weekly-sales-dropdown">
                        <div class="px-4 py-3" role="none">
                            <p class="text-sm font-medium text-gray-900 truncate" role="none">
                                Sep 16, 2021 - Sep 22, 2021
                            </p>
                        </div>
                        <ul class="py-1" role="none">
                            <li>
                                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                                    role="menuitem">Yesterday</a>
                            </li>
                            <li>
                                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                                    role="menuitem">Today</a>
                            </li>
                            <li>
                                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                                    role="menuitem">Last 7 days</a>
                            </li>
                            <li>
                                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                                    role="menuitem">Last 30 days</a>
                            </li>
                            <li>
                                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                                    role="menuitem">Last 90 days</a>
                            </li>
                        </ul>
                        <div class="py-1" role="none">
                            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                                role="menuitem">Custom...</a>
                        </div>
                    </div>
                </div>
                <div class="flex-shrink-0">
                    <a href="#"
                        class="inline-flex items-center p-2 text-xs font-medium uppercase rounded-lg text-primary-700 sm:text-sm hover:bg-gray-100">
                        Sales Report
                        @svg('tabler-chevron-right', 'w-5 h-5 ml-1')
                    </a>
                </div>
            </div>
        </div>
        <!--Tabs widget -->
        <div class="p-4 bg-white border border-gray-200 rounded-lg shadow-sm sm:p-6">
            <h3 class="flex items-center mb-4 text-lg font-semibold text-gray-900">Statistics this month
            </h3>
            <div data-popover id="popover-description" role="tooltip"
                class="absolute z-10 invisible inline-block text-sm font-light text-gray-500 transition-opacity duration-300 bg-white border border-gray-200 rounded-lg shadow-sm opacity-0 w-72">
                <div data-popper-arrow></div>
            </div>
            <div class="sm:hidden">
                <label for="tabs" class="sr-only">Select tab</label>
                <select id="tabs"
                    class="bg-gray-50 border-0 border-b border-gray-200 text-gray-900 text-sm rounded-t-lg focus:ring-0 focus:border-primary-500 block w-full p-2.5">
                    <option>Top Product</option>
                    <option>Top Customer</option>
                </select>
            </div>
            <ul class="hidden text-sm font-medium text-center text-gray-500 divide-x divide-gray-200 rounded-lg sm:flex"
                id="fullWidthTab" data-tabs-toggle="#fullWidthTabContent" role="tablist">
                <li class="w-full">
                    <button id="faq-tab" data-tabs-target="#faq" type="button" role="tab" aria-controls="faq"
                        aria-selected="true"
                        class="inline-block w-full p-4 rounded-tl-lg bg-gray-50 hover:bg-gray-100 focus:outline-none">Top
                        products</button>
                </li>
                <li class="w-full">
                    <button id="about-tab" data-tabs-target="#about" type="button" role="tab" aria-controls="about"
                        aria-selected="false"
                        class="inline-block w-full p-4 rounded-tr-lg bg-gray-50 hover:bg-gray-100 focus:outline-none">Top
                        Customers</button>
                </li>
            </ul>
            <div id="fullWidthTabContent" class="border-t border-gray-200">
                <div class="hidden pt-4" id="faq" role="tabpanel" aria-labelledby="faq-tab">
                    <ul role="list" class="divide-y divide-gray-200">
                        <li class="py-3 sm:py-4">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center min-w-0">
                                    <img loading="lazy" class="flex-shrink-0 w-10 h-10"
                                        src="https://flowbite-admin-dashboard.vercel.app/images/products/iphone.png"
                                        alt="imac image">
                                    <div class="ml-3">
                                        <p class="font-medium text-gray-900 truncate">
                                            iPhone 14 Pro
                                        </p>
                                        <div class="flex items-center justify-end flex-1 text-sm text-green-500">
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
                                <div class="flex items-center min-w-0">
                                    <img loading="lazy" class="flex-shrink-0 w-10 h-10"
                                        src="https://flowbite-admin-dashboard.vercel.app/images/products/iphone.png"
                                        alt="imac image">
                                    <div class="ml-3">
                                        <p class="font-medium text-gray-900 truncate">
                                            Apple iMac 27"
                                        </p>
                                        <div class="flex items-center justify-end flex-1 text-sm text-green-500">
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
                                <div class="flex items-center min-w-0">
                                    <img loading="lazy" class="flex-shrink-0 w-10 h-10"
                                        src="https://flowbite-admin-dashboard.vercel.app/images/products/iphone.png"
                                        alt="watch image">
                                    <div class="ml-3">
                                        <p class="font-medium text-gray-900 truncate">
                                            Apple Watch SE
                                        </p>
                                        <div class="flex items-center justify-end flex-1 text-sm text-red-600">
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
                                <div class="flex items-center min-w-0">
                                    <img loading="lazy" class="flex-shrink-0 w-10 h-10"
                                        src="https://flowbite-admin-dashboard.vercel.app/images/products/iphone.png"
                                        alt="ipad image">
                                    <div class="ml-3">
                                        <p class="font-medium text-gray-900 truncate">
                                            Apple iPad Air
                                        </p>
                                        <div class="flex items-center justify-end flex-1 text-sm text-green-500">
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
                                <div class="flex items-center min-w-0">
                                    <img loading="lazy" class="flex-shrink-0 w-10 h-10"
                                        src="https://flowbite-admin-dashboard.vercel.app/images/products/iphone.png"
                                        alt="imac image">
                                    <div class="ml-3">
                                        <p class="font-medium text-gray-900 truncate">
                                            Apple iMac 24"
                                        </p>
                                        <div class="flex items-center justify-end flex-1 text-sm text-red-600">
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
                <div class="hidden pt-4" id="about" role="tabpanel" aria-labelledby="about-tab">
                    <ul role="list" class="divide-y divide-gray-200">
                        <li class="py-3 sm:py-4">
                            <div class="flex items-center space-x-4">
                                <div class="flex-shrink-0">
                                    <img loading="lazy" class="w-8 h-8 rounded-full"
                                        src="https://flowbite-admin-dashboard.vercel.app/images/users/neil-sims.png"
                                        alt="Neil image">
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="font-medium text-gray-900 truncate">
                                        Neil Sims
                                    </p>
                                    <p class="text-sm text-gray-500 truncate">
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
                                    <img loading="lazy" class="w-8 h-8 rounded-full"
                                        src="https://flowbite-admin-dashboard.vercel.app/images/users/neil-sims.png"
                                        alt="Neil image">
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="font-medium text-gray-900 truncate">
                                        Bonnie Green
                                    </p>
                                    <p class="text-sm text-gray-500 truncate">
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
                                    <img loading="lazy" class="w-8 h-8 rounded-full"
                                        src="https://flowbite-admin-dashboard.vercel.app/images/users/neil-sims.png"
                                        alt="Neil image">
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="font-medium text-gray-900 truncate">
                                        Michael Gough
                                    </p>
                                    <p class="text-sm text-gray-500 truncate">
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
                                    <img loading="lazy" class="w-8 h-8 rounded-full"
                                        src="https://flowbite-admin-dashboard.vercel.app/images/users/neil-sims.png"
                                        alt="Neil image">
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="font-medium text-gray-900 truncate">
                                        Thomes Lean
                                    </p>
                                    <p class="text-sm text-gray-500 truncate">
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
                                    <img loading="lazy" class="w-8 h-8 rounded-full"
                                        src="https://flowbite-admin-dashboard.vercel.app/images/users/neil-sims.png"
                                        alt="Neil image">
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="font-medium text-gray-900 truncate">
                                        Lana Byrd
                                    </p>
                                    <p class="text-sm text-gray-500 truncate">
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
            <div class="flex items-center justify-between pt-3 mt-5 border-t border-gray-200 sm:pt-6">
                <div>
                    <button
                        class="inline-flex items-center p-2 text-sm font-medium text-center text-gray-500 rounded-lg hover:text-gray-900"
                        type="button" data-dropdown-toggle="stats-dropdown">Last 7 days @svg('tabler-chevron-down', 'w-5 h-5 ml-1')
                    </button>
                    <!-- Dropdown menu -->
                    <div class="z-50 hidden my-4 list-none bg-white divide-y divide-gray-100 rounded shadow"
                        id="stats-dropdown">
                        <div class="px-4 py-3" role="none">
                            <p class="text-sm font-medium text-gray-900 truncate" role="none">
                                Sep 16, 2021 - Sep 22, 2021
                            </p>
                        </div>
                        <ul class="py-1" role="none">
                            <li>
                                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                                    role="menuitem">Hôm qua</a>
                            </li>
                            <li>
                                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                                    role="menuitem">Hôm nay</a>
                            </li>
                            <li>
                                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                                    role="menuitem">Last 7 days</a>
                            </li>
                            <li>
                                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                                    role="menuitem">Last 30 days</a>
                            </li>
                            <li>
                                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                                    role="menuitem">Last 90 days</a>
                            </li>
                        </ul>
                        <div class="py-1" role="none">
                            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                                role="menuitem">Custom...</a>
                        </div>
                    </div>
                </div>
                <div class="flex-shrink-0">
                    <a href="#"
                        class="inline-flex items-center p-2 text-xs font-medium uppercase rounded-lg text-primary-700 sm:text-sm hover:bg-gray-100">
                        Full Report
                        @svg('tabler-chevron-right', 'w-4 h-4 ml-2')
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="grid w-full grid-cols-1 gap-4 mt-4 xl:grid-cols-2 2xl:grid-cols-3">
        <div class="items-center justify-between p-4 bg-white border border-gray-200 rounded-lg shadow-sm sm:flex sm:p-6">
            <div class="w-full">
                <h3 class="font-normal text-gray-500">New products</h3>
                <span class="text-2xl font-bold leading-none text-gray-900 sm:text-3xl">2,340</span>
                <p class="flex items-center font-normal text-gray-500">
                    <span class="flex items-center mr-1.5 text-sm text-green-500">
                        @svg('tabler-arrow-narrow-up', 'w-4 h-4')
                        12.5%
                    </span>
                    Since last month
                </p>
            </div>
            <div class="w-full" id="new-products-chart"></div>
        </div>
        <div class="items-center justify-between p-4 bg-white border border-gray-200 rounded-lg shadow-sm sm:flex sm:p-6">
            <div class="w-full">
                <h3 class="font-normal text-gray-500">Users</h3>
                <span class="text-2xl font-bold leading-none text-gray-900 sm:text-3xl">2,340</span>
                <p class="flex items-center font-normal text-gray-500">
                    <span class="flex items-center mr-1.5 text-sm text-green-500">
                        @svg('tabler-arrow-narrow-up', 'w-4 h-4')
                        3,4%
                    </span>
                    Since last month
                </p>
            </div>
            <div class="w-full" id="week-signups-chart"></div>
        </div>
        <div class="p-4 bg-white border border-gray-200 rounded-lg shadow-sm sm:p-6">
            <div class="w-full">
                <h3 class="mb-2 font-normal text-gray-500">Audience by age</h3>
                <div class="flex items-center mb-2">
                    <div class="w-16 text-sm font-medium">50+</div>
                    <div class="w-full bg-gray-200 rounded-full h-2.5">
                        <div class="bg-primary-600 h-2.5 rounded-full" style="width: 18%"></div>
                    </div>
                </div>
                <div class="flex items-center mb-2">
                    <div class="w-16 text-sm font-medium">40+</div>
                    <div class="w-full bg-gray-200 rounded-full h-2.5">
                        <div class="bg-primary-600 h-2.5 rounded-full" style="width: 15%"></div>
                    </div>
                </div>
                <div class="flex items-center mb-2">
                    <div class="w-16 text-sm font-medium">30+</div>
                    <div class="w-full bg-gray-200 rounded-full h-2.5">
                        <div class="bg-primary-600 h-2.5 rounded-full" style="width: 60%"></div>
                    </div>
                </div>
                <div class="flex items-center mb-2">
                    <div class="w-16 text-sm font-medium">20+</div>
                    <div class="w-full bg-gray-200 rounded-full h-2.5">
                        <div class="bg-primary-600 h-2.5 rounded-full" style="width: 30%"></div>
                    </div>
                </div>
            </div>
            <div id="traffic-channels-chart" class="w-full"></div>
        </div>
    </div>
    <div class="grid grid-cols-1 my-4 xl:grid-cols-2 xl:gap-4">
        <div class="p-4 mb-4 bg-white border border-gray-200 rounded-lg shadow-sm sm:p-6 xl:mb-0">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-semibold text-gray-900">Smart chat</h3>
                <a href="#"
                    class="inline-flex items-center p-2 text-sm font-medium rounded-lg text-primary-700 hover:bg-gray-100">
                    View all
                </a>
            </div>
            <!-- Chat -->
            <form class="overflow-y-auto lg:max-h-[60rem] 2xl:max-h-fit">
                <article class="mb-5">
                    <footer class="flex items-center justify-between mb-2">
                        <div class="flex items-center">
                            <p class="inline-flex items-center mr-3 text-sm font-semibold text-gray-900">
                                <img loading="lazy" class="w-6 h-6 mr-2 rounded-full"
                                    src="https://flowbite.com/docs/images/people/profile-picture-2.jpg"alt="Michael Gough">Michael
                                Gough
                            </p>
                            <p class="text-sm text-gray-600"><time pubdate datetime="2022-02-08"
                                    title="February 8th, 2022"> 01/03/2023 4:15 PM</time></p>
                        </div>
                        <button id="dropdownComment1Button" data-dropdown-toggle="dropdownComment1"
                            class="inline-flex items-center p-2 text-sm font-medium text-center text-gray-500 bg-white rounded-lg hover:bg-gray-100 focus:ring-0"
                            type="button">
                            @svg('tabler-dots', 'w-5 h-5')
                            <span class="sr-only">Comment settings</span>
                        </button>
                        <!-- Dropdown menu -->
                        <div id="dropdownComment1"
                            class="z-10 hidden bg-white divide-y divide-gray-100 rounded shadow w-36">
                            <ul class="py-1 text-sm text-gray-700" aria-labelledby="dropdownMenuIconHorizontalButton">
                                <li>
                                    <a href="#" class="block px-4 py-2 hover:bg-gray-100">Edit</a>
                                </li>
                                <li>
                                    <a href="#" class="block px-4 py-2 hover:bg-gray-100">Remove</a>
                                </li>
                                <li>
                                    <a href="#" class="block px-4 py-2 hover:bg-gray-100">Report</a>
                                </li>
                            </ul>
                        </div>
                    </footer>
                    <p class="mb-2 text-gray-900">
                        Hello <a href="#" class="font-medium hover:underline text-primary-600">@designteam</a>
                        Let's schedule a kick-off meeting and workshop this week. It would be great to gather everyone
                        involved in the design project. Let me know about your availability in the thread.
                    </p>
                    <p class="mb-3 text-gray-900">Looking forward to it! Thanks.</p>
                    <form>
                        <label for="chat" class="sr-only">Your message</label>
                        <div class="flex items-center mb-5">
                            <textarea id="chat" rows="1"
                                class="block mr-4 p-2.5 w-full text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-primary-0 focus:border-primary-500"
                                placeholder="Reply in thread..."></textarea>
                            <button type="submit"
                                class="inline-flex justify-center rounded-lg cursor-pointer text-primary-600 hover:bg-primary-100">
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
            <div class="p-4 bg-white border border-gray-200 rounded-lg shadow-sm sm:p-6">
                <div class="items-center justify-between pb-4 border-b border-gray-200 sm:flex">
                    <div class="w-full mb-4 sm:mb-0">
                        <h3 class="font-normal text-gray-500">Sales by category</h3>
                        <span class="text-2xl font-bold leading-none text-gray-900 sm:text-3xl">Desktop
                            PC</span>
                        <p class="flex items-center font-normal text-gray-500">
                            <span class="flex items-center mr-1.5 text-sm text-green-500">
                                @svg('tabler-arrow-narrow-up', 'w-4 h-4')
                                2.5%
                            </span>
                            Since last month
                        </p>
                    </div>
                    <div class="w-full max-w-lg">
                        <div date-rangepicker class="grid items-center grid-cols-2 gap-4">
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                    @svg('tabler-calendar-week', 'w-5 h-5 text-gray-500')
                                </div>
                                <input name="start" type="text"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-0 focus:border-primary-500 block w-full pl-10 p-2.5 "
                                    placeholder="From">
                            </div>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                    @svg('tabler-calendar-week', 'w-5 h-5 text-gray-500')
                                </div>
                                <input name="end" type="text"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-0 focus:border-primary-500 block w-full pl-10 p-2.5 "
                                    placeholder="To">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="w-full" id="sales-by-category"></div>
                <!-- Card Footer -->
                <div class="flex items-center justify-between pt-3 mt-4 border-t border-gray-200 sm:pt-6">
                    <div>
                        <button
                            class="inline-flex items-center p-2 text-sm font-medium text-center text-gray-500 rounded-lg hover:text-gray-900"
                            type="button" data-dropdown-toggle="sales-by-category-dropdown">Last 7 days
                            @svg('tabler-chevron-down', 'w-5 h-5 ml-1')
                        </button>
                        <!-- Dropdown menu -->
                        <div class="z-50 hidden my-4 list-none bg-white divide-y divide-gray-100 rounded shadow"
                            id="sales-by-category-dropdown">
                            <div class="px-4 py-3" role="none">
                                <p class="text-sm font-medium text-gray-900 truncate" role="none">
                                    Sep 16, 2021 - Sep 22, 2021
                                </p>
                            </div>
                            <ul class="py-1" role="none">
                                <li>
                                    <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                                        role="menuitem">Yesterday</a>
                                </li>
                                <li>
                                    <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                                        role="menuitem">Today</a>
                                </li>
                                <li>
                                    <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                                        role="menuitem">Last 7 days</a>
                                </li>
                                <li>
                                    <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                                        role="menuitem">Last 30 days</a>
                                </li>
                                <li>
                                    <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                                        role="menuitem">Last 90 days</a>
                                </li>
                            </ul>
                            <div class="py-1" role="none">
                                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                                    role="menuitem">Custom...</a>
                            </div>
                        </div>
                    </div>
                    <div class="flex-shrink-0">
                        <a href="#"
                            class="inline-flex items-center p-2 text-xs font-medium uppercase rounded-lg text-primary-700 sm:text-sm hover:bg-gray-100">
                            Sales Report
                            @svg('tabler-chevron-right', 'w-4 h-4 ml-2')
                        </a>
                    </div>
                </div>
            </div>
            <div class="p-4 bg-white border border-gray-200 rounded-lg shadow-sm sm:p-6">
                <div class="flex items-center justify-between pb-4 mb-4 border-b border-gray-200">
                    <div>
                        <h3 class="font-normal text-gray-500">Traffic by device</h3>
                        <span class="text-2xl font-bold leading-none text-gray-900 sm:text-3xl">Desktop</span>
                    </div>
                    <a href="#"
                        class="inline-flex items-center p-2 text-xs font-medium uppercase rounded-lg text-primary-700 sm:text-sm hover:bg-gray-100">
                        Full report
                        @svg('tabler-chevron-right', 'w-4 h-4 ml-2')
                    </a>
                </div>
                <div id="traffic-by-device"></div>
                <!-- Card Footer -->
                <div class="flex items-center justify-between pt-4 lg:justify-evenly sm:pt-6">
                    <div>
                        @svg('tabler-device-desktop', 'w-4 h-4 text-green-500')
                        <h3 class="text-gray-500">Desktop</h3>
                        <h4 class="text-base font-bold">
                            234k
                        </h4>
                        <p class="flex items-center text-sm text-gray-500">
                            <span class="flex items-center mr-1.5 text-sm text-green-500">
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
                            <span class="flex items-center mr-1.5 text-sm text-red-600">
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
                            <span class="flex items-center mr-1.5 text-sm text-red-600">
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
@endsection
