@extends('layouts.admin')
@section('content')
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
                                    <img class="flex-shrink-0 w-10 h-10"
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
                                    <img class="flex-shrink-0 w-10 h-10"
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
                                    <img class="flex-shrink-0 w-10 h-10"
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
                                    <img class="flex-shrink-0 w-10 h-10"
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
                                    <img class="flex-shrink-0 w-10 h-10"
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
                                    <img class="w-8 h-8 rounded-full"
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
                                    <img class="w-8 h-8 rounded-full"
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
                                    <img class="w-8 h-8 rounded-full"
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
                                    <img class="w-8 h-8 rounded-full"
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
                                    <img class="w-8 h-8 rounded-full"
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
                                <img class="w-6 h-6 mr-2 rounded-full"
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
    <div class="p-4 bg-white border border-gray-200 rounded-lg shadow-sm sm:p-6">
        <!-- Card header -->
        <div class="items-center justify-between lg:flex">
            <div class="mb-4 lg:mb-0">
                <h3 class="mb-2 text-base font-bold text-gray-900">Transactions</h3>
                <span class="font-normal text-gray-500">This is a list of latest
                    transactions</span>
            </div>
            <div class="items-center sm:flex">
                <div class="flex items-center">
                    <button id="dropdownDefault" data-dropdown-toggle="dropdown"
                        class="mb-4 sm:mb-0 mr-4 inline-flex items-center text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-0 font-medium rounded-lg text-sm px-4 py-2.5"
                        type="button">
                        Filter by status
                        @svg('tabler-chevron-down', 'w-4 h-4 ml-2')
                    </button>
                    <!-- Dropdown menu -->
                    <div id="dropdown" class="z-10 hidden w-56 p-3 bg-white rounded-lg shadow">
                        <h6 class="mb-3 text-sm font-medium text-gray-900">
                            Category
                        </h6>
                        <ul class="space-y-2 text-sm" aria-labelledby="dropdownDefault">
                            <li class="flex items-center">
                                <input id="apple" type="checkbox" value=""
                                    class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-0" />

                                <label for="apple" class="ml-2 text-sm font-medium text-gray-900">
                                    Completed (56)
                                </label>
                            </li>

                            <li class="flex items-center">
                                <input id="fitbit" type="checkbox" value="" checked
                                    class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-0" />

                                <label for="fitbit" class="ml-2 text-sm font-medium text-gray-900">
                                    Cancelled (56)
                                </label>
                            </li>

                            <li class="flex items-center">
                                <input id="dell" type="checkbox" value=""
                                    class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-0" />

                                <label for="dell" class="ml-2 text-sm font-medium text-gray-900">
                                    In progress (56)
                                </label>
                            </li>

                            <li class="flex items-center">
                                <input id="asus" type="checkbox" value="" checked
                                    class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-0" />

                                <label for="asus" class="ml-2 text-sm font-medium text-gray-900">
                                    In review (97)
                                </label>
                            </li>
                        </ul>
                    </div>
                </div>
                <div date-rangepicker class="flex items-center space-x-4">
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
        <!-- Table -->
        <div class="flex flex-col mt-6">
            <div class="overflow-x-auto rounded-lg">
                <div class="inline-block min-w-full align-middle">
                    <div class="overflow-hidden shadow sm:rounded-lg">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col"
                                        class="p-4 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                        Transaction
                                    </th>
                                    <th scope="col"
                                        class="p-4 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                        Date & Time
                                    </th>
                                    <th scope="col"
                                        class="p-4 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                        Amount
                                    </th>
                                    <th scope="col"
                                        class="p-4 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                        Reference number
                                    </th>
                                    <th scope="col"
                                        class="p-4 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                        Payment method
                                    </th>
                                    <th scope="col"
                                        class="p-4 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                        Status
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white">
                                <tr>
                                    <td class="p-4 text-sm font-normal text-gray-900 whitespace-nowrap">
                                        Payment from <span class="font-semibold">Bonnie Green</span>
                                    </td>
                                    <td class="p-4 text-sm font-normal text-gray-500 whitespace-nowrap">
                                        Apr 23 ,2021
                                    </td>
                                    <td class="p-4 text-sm font-semibold text-gray-900 whitespace-nowrap">
                                        $2300
                                    </td>
                                    <td class="p-4 text-sm font-normal text-gray-500 whitespace-nowrap">
                                        0047568936
                                    </td>
                                    <td
                                        class="inline-flex items-center p-4 space-x-2 text-sm font-normal text-gray-500 whitespace-nowrap">
                                        @svg('tabler-credit-card-filled', 'w-5 h-5')
                                        <span>••• 475</span>
                                    </td>
                                    <td class="p-4 whitespace-nowrap">
                                        <span
                                            class="bg-green-100 text-green-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded-md border border-green-100">Completed</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="p-4 text-sm font-normal text-gray-900 whitespace-nowrap">
                                        Payment failed from <span class="font-semibold">#087651</span>
                                    </td>
                                    <td class="p-4 text-sm font-normal text-gray-500 whitespace-nowrap">
                                        Apr 18 ,2021
                                    </td>
                                    <td class="p-4 text-sm font-semibold text-gray-900 whitespace-nowrap">
                                        $234
                                    </td>
                                    <td class="p-4 text-sm font-normal text-gray-500 whitespace-nowrap">
                                        0088568934
                                    </td>
                                    <td
                                        class="inline-flex items-center p-4 space-x-2 text-sm font-normal text-gray-500 whitespace-nowrap">
                                        @svg('tabler-truck-delivery', 'w-5 h-5')
                                        <span>••• 826</span>
                                    </td>
                                    <td class="p-4 whitespace-nowrap">
                                        <span
                                            class="bg-red-100 text-red-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded-md border border-red-100">Cancelled</span>
                                    </td>
                                </tr>
                                <tr class="bg-gray-50">
                                    <td class="p-4 text-sm font-normal text-gray-900 whitespace-nowrap">
                                        Payment from <span class="font-semibold">Lana Byrd</span>
                                    </td>
                                    <td class="p-4 text-sm font-normal text-gray-500 whitespace-nowrap">
                                        Apr 15 ,2021
                                    </td>
                                    <td class="p-4 text-sm font-semibold text-gray-900 whitespace-nowrap">
                                        $5000
                                    </td>
                                    <td class="p-4 text-sm font-normal text-gray-500 whitespace-nowrap">
                                        0018568911
                                    </td>
                                    <td
                                        class="inline-flex items-center p-4 space-x-2 text-sm font-normal text-gray-500 whitespace-nowrap">
                                        @svg('tabler-truck-delivery', 'w-5 h-5')
                                        <span>••• 634</span>
                                    </td>
                                    <td class="p-4 whitespace-nowrap">
                                        <span
                                            class="bg-purple-100 text-purple-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded-md border border-purple-100">In
                                            progress</span>
                                    </td>
                                </tr>
                                <tr class="bg-gray-50">
                                    <td class="p-4 text-sm font-normal text-gray-900 whitespace-nowrap">
                                        Refund to <span class="font-semibold">THEMESBERG LLC</span>
                                    </td>
                                    <td class="p-4 text-sm font-normal text-gray-500 whitespace-nowrap">
                                        Apr 11 ,2021
                                    </td>
                                    <td class="p-4 text-sm font-semibold text-gray-900 whitespace-nowrap">
                                        -$560
                                    </td>
                                    <td class="p-4 text-sm font-normal text-gray-500 whitespace-nowrap">
                                        0031568935
                                    </td>
                                    <td
                                        class="inline-flex items-center p-4 space-x-2 text-sm font-normal text-gray-500 whitespace-nowrap">
                                        @svg('tabler-credit-card-filled', 'w-5 h-5')
                                        <span>••• 443</span>
                                    </td>
                                    <td class="p-4 whitespace-nowrap">
                                        <span
                                            class="bg-orange-100 text-orange-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded-md border border-orange-100">In
                                            review</span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- Card Footer -->
        <div class="flex items-center justify-between pt-3 sm:pt-6">
            <div>
                <button
                    class="inline-flex items-center p-2 text-sm font-medium text-center text-gray-500 rounded-lg hover:text-gray-900"
                    type="button" data-dropdown-toggle="transactions-dropdown">Last 7 days <svg class="w-4 h-4 ml-2"
                        fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7">
                        </path>
                    </svg></button>
                <!-- Dropdown menu -->
                <div class="z-50 hidden my-4 list-none bg-white divide-y divide-gray-100 rounded shadow"
                    id="transactions-dropdown">
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
                    Transactions Report
                    @svg('tabler-chevron-right', 'w-4 h-4 ml-2')
                </a>
            </div>
        </div>
    </div>
    <div class="mt-5 bg-white relative shadow sm:rounded-lg overflow-hidden">
        <div class="flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0 md:space-x-4 p-4">
            <div class="w-full md:w-1/2">
                <form class="flex items-center">
                    <label for="simple-search" class="sr-only">Search</label>
                    <div class="relative w-full">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                            <svg aria-hidden="true" class="w-5 h-5 text-gray-500" fill="currentColor"
                                viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>
                        <input type="text" id="simple-search"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-0 block w-full pl-10 p-2 "
                            placeholder="Search" required="">
                    </div>
                </form>
            </div>
            <div
                class="w-full md:w-auto flex flex-col md:flex-row space-y-2 md:space-y-0 items-stretch md:items-center justify-end md:space-x-3 flex-shrink-0">
                <button type="button"
                    class="flex items-center justify-center text-white bg-blue-700 hover:bg-blue-800 focus:ring-0 font-medium rounded-lg text-sm px-4 py-2 focus:outline-none">
                    @svg('tabler-plus', 'w-5 h-5 mr-2')
                    Add product
                </button>
                <div class="flex items-center space-x-3 w-full md:w-auto">
                    <button id="actionsDropdownButton" data-dropdown-toggle="actionsDropdown"
                        class="w-full md:w-auto flex items-center justify-center py-2 px-4 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:ring-0"
                        type="button">
                        @svg('tabler-chevron-down', 'w-5 h-5 mr-2')
                        Actions
                    </button>
                    <div id="actionsDropdown" class="hidden z-10 w-44 bg-white rounded divide-y divide-gray-100 shadow">
                        <ul class="py-1 text-sm text-gray-700" aria-labelledby="actionsDropdownButton">
                            <li>
                                <a href="#" class="block py-2 px-4 hover:bg-gray-100">Mass
                                    Edit</a>
                            </li>
                        </ul>
                        <div class="py-1">
                            <a href="#" class="block py-2 px-4 text-sm text-gray-700 hover:bg-gray-100">Delete
                                all</a>
                        </div>
                    </div>
                    <button id="filterDropdownButton" data-dropdown-toggle="filterDropdown"
                        class="w-full md:w-auto flex items-center justify-center py-2 px-4 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:ring-0"
                        type="button">
                        @svg('tabler-chevron-down', 'w-5 h-5 mr-2')
                        Filter
                        <svg class="-mr-1 ml-1.5 w-5 h-5" fill="currentColor" viewbox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                            <path clip-rule="evenodd" fill-rule="evenodd"
                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" />
                        </svg>
                    </button>
                    <div id="filterDropdown" class="z-10 hidden w-48 p-3 bg-white rounded-lg shadow">
                        <h6 class="mb-3 text-sm font-medium text-gray-900 ">Choose brand</h6>
                        <ul class="space-y-2 text-sm" aria-labelledby="filterDropdownButton">
                            <li class="flex items-center">
                                <input id="apple" type="checkbox" value=""
                                    class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-0">
                                <label for="apple" class="ml-2 text-sm font-medium text-gray-900">Apple
                                    (56)</label>
                            </li>
                            <li class="flex items-center">
                                <input id="fitbit" type="checkbox" value=""
                                    class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-0">
                                <label for="fitbit" class="ml-2 text-sm font-medium text-gray-900">Microsoft
                                    (16)</label>
                            </li>
                            <li class="flex items-center">
                                <input id="razor" type="checkbox" value=""
                                    class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-0">
                                <label for="razor" class="ml-2 text-sm font-medium text-gray-900">Razor
                                    (49)</label>
                            </li>
                            <li class="flex items-center">
                                <input id="nikon" type="checkbox" value=""
                                    class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-0">
                                <label for="nikon" class="ml-2 text-sm font-medium text-gray-900">Nikon
                                    (12)</label>
                            </li>
                            <li class="flex items-center">
                                <input id="benq" type="checkbox" value=""
                                    class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-0">
                                <label for="benq" class="ml-2 text-sm font-medium text-gray-900">BenQ
                                    (74)</label>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left text-gray-500">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                    <tr>
                        <th scope="col" class="px-4 py-3">Product name</th>
                        <th scope="col" class="px-4 py-3">Category</th>
                        <th scope="col" class="px-4 py-3">Brand</th>
                        <th scope="col" class="px-4 py-3">Description</th>
                        <th scope="col" class="px-4 py-3">Price</th>
                        <th scope="col" class="px-4 py-3">
                            <span class="sr-only">Actions</span>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="border-b">
                        <th scope="row" class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap ">Apple
                            iMac 27&#34;</th>
                        <td class="px-4 py-3">PC</td>
                        <td class="px-4 py-3">Apple</td>
                        <td class="px-4 py-3">300</td>
                        <td class="px-4 py-3">$2999</td>
                        <td class="px-4 py-3 flex items-center justify-end">
                            <button id="apple-imac-27-dropdown-button" data-dropdown-toggle="apple-imac-27-dropdown"
                                class="inline-flex items-center p-0.5 text-sm font-medium text-center text-gray-500 hover:text-gray-800 rounded-lg focus:outline-none"
                                type="button">
                                @svg('tabler-dots', 'w-5 h-5')
                            </button>
                            <div id="apple-imac-27-dropdown"
                                class="hidden z-10 w-44 bg-white rounded divide-y divide-gray-100 shadow">
                                <ul class="py-1 text-sm text-gray-700" aria-labelledby="apple-imac-27-dropdown-button">
                                    <li>
                                        <a href="#" class="block py-2 px-4 hover:bg-gray-100">Show</a>
                                    </li>
                                    <li>
                                        <a href="#" class="block py-2 px-4 hover:bg-gray-100">Edit</a>
                                    </li>
                                </ul>
                                <div class="py-1">
                                    <a href="#"
                                        class="block py-2 px-4 text-sm text-gray-700 hover:bg-gray-100">Delete</a>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr class="border-b">
                        <th scope="row" class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap ">Apple
                            iMac 20&#34;</th>
                        <td class="px-4 py-3">PC</td>
                        <td class="px-4 py-3">Apple</td>
                        <td class="px-4 py-3">200</td>
                        <td class="px-4 py-3">$1499</td>
                        <td class="px-4 py-3 flex items-center justify-end">
                            <button id="apple-imac-20-dropdown-button" data-dropdown-toggle="apple-imac-20-dropdown"
                                class="inline-flex items-center p-0.5 text-sm font-medium text-center text-gray-500 hover:text-gray-800 rounded-lg focus:outline-none"
                                type="button">
                                @svg('tabler-dots', 'w-5 h-5')
                            </button>
                            <div id="apple-imac-20-dropdown"
                                class="hidden z-10 w-44 bg-white rounded divide-y divide-gray-100 shadow">
                                <ul class="py-1 text-sm text-gray-700" aria-labelledby="apple-imac-20-dropdown-button">
                                    <li>
                                        <a href="#" class="block py-2 px-4 hover:bg-gray-100">Show</a>
                                    </li>
                                    <li>
                                        <a href="#" class="block py-2 px-4 hover:bg-gray-100">Edit</a>
                                    </li>
                                </ul>
                                <div class="py-1">
                                    <a href="#"
                                        class="block py-2 px-4 text-sm text-gray-700 hover:bg-gray-100">Delete</a>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr class="border-b">
                        <th scope="row" class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap ">Apple
                            iPhone 14</th>
                        <td class="px-4 py-3">Phone</td>
                        <td class="px-4 py-3">Apple</td>
                        <td class="px-4 py-3">1237</td>
                        <td class="px-4 py-3">$999</td>
                        <td class="px-4 py-3 flex items-center justify-end">
                            <button id="apple-iphone-14-dropdown-button" data-dropdown-toggle="apple-iphone-14-dropdown"
                                class="inline-flex items-center p-0.5 text-sm font-medium text-center text-gray-500 hover:text-gray-800 rounded-lg focus:outline-none"
                                type="button">
                                @svg('tabler-dots', 'w-5 h-5')
                            </button>
                            <div id="apple-iphone-14-dropdown"
                                class="hidden z-10 w-44 bg-white rounded divide-y divide-gray-100 shadow">
                                <ul class="py-1 text-sm text-gray-700" aria-labelledby="apple-iphone-14-dropdown-button">
                                    <li>
                                        <a href="#" class="block py-2 px-4 hover:bg-gray-100">Show</a>
                                    </li>
                                    <li>
                                        <a href="#" class="block py-2 px-4 hover:bg-gray-100">Edit</a>
                                    </li>
                                </ul>
                                <div class="py-1">
                                    <a href="#"
                                        class="block py-2 px-4 text-sm text-gray-700 hover:bg-gray-100">Delete</a>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr class="border-b">
                        <th scope="row" class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap ">
                            Monitor BenQ EX2710Q</th>
                        <td class="px-4 py-3">TV/Monitor</td>
                        <td class="px-4 py-3">BenQ</td>
                        <td class="px-4 py-3">354</td>
                        <td class="px-4 py-3">$499</td>
                        <td class="px-4 py-3 flex items-center justify-end">
                            <button id="benq-ex2710q-dropdown-button" data-dropdown-toggle="benq-ex2710q-dropdown"
                                class="inline-flex items-center p-0.5 text-sm font-medium text-center text-gray-500 hover:text-gray-800 rounded-lg focus:outline-none"
                                type="button">
                                @svg('tabler-dots', 'w-5 h-5')
                            </button>
                            <div id="benq-ex2710q-dropdown"
                                class="hidden z-10 w-44 bg-white rounded divide-y divide-gray-100 shadow">
                                <ul class="py-1 text-sm text-gray-700" aria-labelledby="benq-ex2710q-dropdown-button">
                                    <li>
                                        <a href="#" class="block py-2 px-4 hover:bg-gray-100">Show</a>
                                    </li>
                                    <li>
                                        <a href="#" class="block py-2 px-4 hover:bg-gray-100">Edit</a>
                                    </li>
                                </ul>
                                <div class="py-1">
                                    <a href="#"
                                        class="block py-2 px-4 text-sm text-gray-700 hover:bg-gray-100">Delete</a>
                                </div>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="mt-5 bg-white relative shadow sm:rounded-lg overflow-hidden">
        <div
            class="flex flex-col px-4 py-3 space-y-3 lg:flex-row lg:items-center lg:justify-between lg:space-y-0 lg:space-x-4">
            <div class="flex items-center flex-1 space-x-4">
                <h5>
                    <span class="text-gray-500">All Products:</span>
                    <span class="">123456</span>
                </h5>
                <h5>
                    <span class="text-gray-500">Total sales:</span>
                    <span class="">$88.4k</span>
                </h5>
            </div>
            <div
                class="flex flex-col flex-shrink-0 space-y-3 md:flex-row md:items-center lg:justify-end md:space-y-0 md:space-x-3">
                <button type="button"
                    class="flex items-center justify-center px-4 py-2 text-sm font-medium text-white rounded-lg bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-primary-300 focus:outline-none">
                    @svg('tabler-plus', 'w-5 h-5 mr-2')
                    Add new product
                </button>
                <button type="button"
                    class="flex items-center justify-center flex-shrink-0 px-3 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg focus:outline-none hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:ring-4 focus:ring-gray-200">
                    @svg('tabler-rotate-clockwise', 'w-4 h-4 mr-2')
                    Update stocks 1/250
                </button>
                <button type="button"
                    class="flex items-center justify-center flex-shrink-0 px-3 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg focus:outline-none hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:ring-4 focus:ring-gray-200">
                    @svg('tabler-file-export', 'w-4 h-4 mr-2')
                    Export
                </button>
            </div>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left text-gray-500">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                    <tr>
                        <th scope="col" class="p-4">
                            <div class="flex items-center">
                                <input id="checkbox-all" type="checkbox"
                                    class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-0">
                                <label for="checkbox-all" class="sr-only">checkbox</label>
                            </div>
                        </th>
                        <th scope="col" class="px-4 py-3">Product</th>
                        <th scope="col" class="px-4 py-3">Category</th>
                        <th scope="col" class="px-4 py-3">Stock</th>
                        <th scope="col" class="px-4 py-3">Sales/Day</th>
                        <th scope="col" class="px-4 py-3">Sales/Month</th>
                        <th scope="col" class="px-4 py-3">Rating</th>
                        <th scope="col" class="px-4 py-3">Sales</th>
                        <th scope="col" class="px-4 py-3">Revenue</th>
                        <th scope="col" class="px-4 py-3">Last Update</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="border-b hover:bg-gray-100">
                        <td class="w-4 px-4 py-3">
                            <div class="flex items-center">
                                <input id="checkbox-table-search-1" type="checkbox" onclick="event.stopPropagation()"
                                    class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-0">
                                <label for="checkbox-table-search-1" class="sr-only">checkbox</label>
                            </div>
                        </td>
                        <th scope="row"
                            class="flex items-center px-4 py-2 font-medium text-gray-900 whitespace-nowrap ">
                            <img src="https://flowbite.s3.amazonaws.com/blocks/application-ui/products/imac-front-image.png"
                                alt="iMac Front Image" class="w-auto h-8 mr-3">
                            Apple iMac 27&#34;
                        </th>
                        <td class="px-4 py-2">
                            <span class="bg-primary-100 text-primary-800 text-xs font-medium px-2 py-0.5 rounded ">Desktop
                                PC</span>
                        </td>
                        <td class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap ">
                            <div class="flex items-center">
                                <div class="inline-block w-4 h-4 mr-2 bg-red-700 rounded-full"></div>
                                95
                            </div>
                        </td>
                        <td class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap ">1.47</td>
                        <td class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap ">0.47</td>
                        <td class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap ">
                            <div class="flex items-center">
                                @svg('tabler-star-filled', 'w-4 h-4 me-2 text-red-500')
                                @svg('tabler-star-filled', 'w-4 h-4 me-2 text-red-500')
                                @svg('tabler-star-filled', 'w-4 h-4 me-2 text-red-500')
                                @svg('tabler-star-filled', 'w-4 h-4 me-2 text-red-500')
                                @svg('tabler-star-filled', 'w-4 h-4 me-2 text-red-500')
                                <span class="ml-1 text-gray-500">5.0</span>
                            </div>
                        </td>
                        <td class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap ">
                            <div class="flex items-center">
                                @svg('tabler-circle-filled', 'w-4 h-4 me-2 text-yellow-500')
                                1.6M
                            </div>
                        </td>
                        <td class="px-4 py-2">$3.2M</td>
                        <td class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap ">Just now
                        </td>
                    </tr>
                    <tr class="border-b hover:bg-gray-100">
                        <td class="w-4 px-4 py-3">
                            <div class="flex items-center">
                                <input id="checkbox-table-search-1" type="checkbox" onclick="event.stopPropagation()"
                                    class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-0">
                                <label for="checkbox-table-search-1" class="sr-only">checkbox</label>
                            </div>
                        </td>
                        <th scope="row"
                            class="flex items-center px-4 py-2 font-medium text-gray-900 whitespace-nowrap ">
                            <img src="https://flowbite.s3.amazonaws.com/blocks/application-ui/products/imac-front-image.png"
                                alt="iMac Front Image" class="w-auto h-8 mr-3">
                            Apple iMac 20&#34;
                        </th>
                        <td class="px-4 py-2">
                            <span class="bg-primary-100 text-primary-800 text-xs font-medium px-2 py-0.5 rounded ">Desktop
                                PC</span>
                        </td>
                        <td class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap ">
                            <div class="flex items-center">
                                <div class="inline-block w-4 h-4 mr-2 bg-red-700 rounded-full"></div>
                                108
                            </div>
                        </td>
                        <td class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap ">1.15</td>
                        <td class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap ">0.32</td>
                        <td class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap ">
                            <div class="flex items-center">
                                @svg('tabler-star-filled', 'w-4 h-4 me-2 text-red-500')
                                @svg('tabler-star-filled', 'w-4 h-4 me-2 text-red-500')
                                @svg('tabler-star-filled', 'w-4 h-4 me-2 text-red-500')
                                @svg('tabler-star-filled', 'w-4 h-4 me-2 text-red-500')
                                @svg('tabler-star-filled', 'w-4 h-4 me-2 text-red-500')
                                <span class="ml-1 text-gray-500">5.0</span>
                            </div>
                        </td>
                        <td class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap ">
                            <div class="flex items-center">
                                @svg('tabler-circle-filled', 'w-4 h-4 me-2 text-yellow-500')
                                6M
                            </div>
                        </td>
                        <td class="px-4 py-2">$785K</td>
                        <td class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap ">This week
                        </td>
                    </tr>
                    <tr class="border-b hover:bg-gray-100">
                        <td class="w-4 px-4 py-3">
                            <div class="flex items-center">
                                <input id="checkbox-table-search-1" type="checkbox" onclick="event.stopPropagation()"
                                    class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-primary-500 focus:ring-0">
                                <label for="checkbox-table-search-1" class="sr-only">checkbox</label>
                            </div>
                        </td>
                        <th scope="row"
                            class="flex items-center px-4 py-2 font-medium text-gray-900 whitespace-nowrap ">
                            <img src="https://flowbite.s3.amazonaws.com/blocks/application-ui/devices/apple-iphone-14.png"
                                alt="iMac Front Image" class="w-auto h-8 mr-3">
                            Apple iPhone 14
                        </th>
                        <td class="px-4 py-2">
                            <span
                                class="bg-primary-100 text-primary-800 text-xs font-medium px-2 py-0.5 rounded ">Phone</span>
                        </td>
                        <td class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap ">
                            <div class="flex items-center">
                                <div class="inline-block w-4 h-4 mr-2 bg-green-400 rounded-full"></div>
                                24
                            </div>
                        </td>
                        <td class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap ">1.00</td>
                        <td class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap ">0.95</td>
                        <td class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap ">
                            <div class="flex items-center">
                                @svg('tabler-star-filled', 'w-4 h-4 me-2 text-red-500')
                                @svg('tabler-star-filled', 'w-4 h-4 me-2 text-red-500')
                                @svg('tabler-star-filled', 'w-4 h-4 me-2 text-red-500')
                                @svg('tabler-star-filled', 'w-4 h-4 me-2 text-red-500')
                                @svg('tabler-star', 'w-4 h-4 me-2 text-gray-500')
                                <span class="ml-1 text-gray-500">4.0</span>
                            </div>
                        </td>
                        <td class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap ">
                            <div class="flex items-center">
                                @svg('tabler-circle-filled', 'w-4 h-4 me-2 text-red-500')
                                1.2M
                            </div>
                        </td>
                        <td class="px-4 py-2">$3.2M</td>
                        <td class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap ">Just now
                        </td>
                    </tr>
                    <tr class="border-b hover:bg-gray-100">
                        <td class="w-4 px-4 py-3">
                            <div class="flex items-center">
                                <input id="checkbox-table-search-1" type="checkbox" onclick="event.stopPropagation()"
                                    class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-primary-500 focus:ring-0">
                                <label for="checkbox-table-search-1" class="sr-only">checkbox</label>
                            </div>
                        </td>
                        <th scope="row"
                            class="flex items-center px-4 py-2 font-medium text-gray-900 whitespace-nowrap ">
                            <img src="https://flowbite.s3.amazonaws.com/blocks/application-ui/devices/apple-ipad-air.png"
                                alt="iMac Front Image" class="w-auto h-8 mr-3">
                            Apple iPad Air
                        </th>
                        <td class="px-4 py-2">
                            <span
                                class="bg-primary-100 text-primary-800 text-xs font-medium px-2 py-0.5 rounded ">Tablet</span>
                        </td>
                        <td class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap ">
                            <div class="flex items-center">
                                <div class="inline-block w-4 h-4 mr-2 bg-red-500 rounded-full"></div>
                                287
                            </div>
                        </td>
                        <td class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap ">0.47</td>
                        <td class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap ">1.00</td>
                        <td class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap ">
                            <div class="flex items-center">
                                @svg('tabler-star-filled', 'w-4 h-4 me-2 text-red-500')
                                @svg('tabler-star-filled', 'w-4 h-4 me-2 text-red-500')
                                @svg('tabler-star-filled', 'w-4 h-4 me-2 text-red-500')
                                @svg('tabler-star-filled', 'w-4 h-4 me-2 text-red-500')
                                @svg('tabler-star', 'w-4 h-4 me-2 text-gray-500')
                                <span class="ml-1 text-gray-500">4.0</span>
                            </div>
                        </td>
                        <td class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap ">
                            <div class="flex items-center">
                                @svg('tabler-circle-filled', 'w-4 h-4 me-2 text-green-500')
                                298K
                            </div>
                        </td>
                        <td class="px-4 py-2">$425K</td>
                        <td class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap ">Just now
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="max-w-2xl px-4 py-8 mx-auto lg:py-16">
        <h2 class="mb-4 text-xl font-bold text-gray-900 ">Update product</h2>
        <form action="#">
            <div class="grid gap-4 mb-4 sm:grid-cols-2">
                <div>
                    <label for="name" class="block mb-2 text-sm font-medium text-gray-900 ">Name</label>
                    <input type="text" name="name" id="name" value="iPad Air Gen 5th Wi-Fi"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                        placeholder="Ex. Apple iMac 27&ldquo;">
                </div>
                <div>
                    <label for="brand" class="block mb-2 text-sm font-medium text-gray-900 ">Brand</label>
                    <input type="text" name="brand" id="brand" value="Google"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                        placeholder="Ex. Apple">
                </div>
                <div>
                    <label for="price" class="block mb-2 text-sm font-medium text-gray-900 ">Price</label>
                    <input type="number" value="399" name="price" id="price"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                        placeholder="$299">
                </div>
                <div>
                    <label for="category" class="block mb-2 text-sm font-medium text-gray-900 ">Category</label>
                    <select id="category"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5">
                        <option selected="">Electronics</option>
                        <option value="TV">TV/Monitors</option>
                        <option value="PC">PC</option>
                        <option value="GA">Gaming/Console</option>
                        <option value="PH">Phones</option>
                    </select>
                </div>
                <div class="sm:col-span-2">
                    <label for="description" class="block mb-2 text-sm font-medium text-gray-900 ">Description</label>
                    <textarea id="description" rows="5"
                        class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500"
                        placeholder="Write a description...">Standard glass, 3.8GHz 8-core 10th-generation Intel Core i7 processor, Turbo Boost up to 5.0GHz, 16GB 2666MHz DDR4 memory, Radeon Pro 5500 XT with 8GB of GDDR6 memory, 256GB SSD storage, Gigabit Ethernet, Magic Mouse 2, Magic Keyboard - US</textarea>
                </div>
            </div>
            <div class="flex items-center space-x-4">
                <button type="submit"
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-0 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                    Update product
                </button>
                <button type="button"
                    class="text-red-600 inline-flex items-center hover:text-white border border-red-600 hover:bg-red-600 focus:ring-0 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                    @svg('tabler-trash', 'w-4 h-4 mr-2')
                    Delete
                </button>
            </div>
        </form>
    </div>
@endsection
