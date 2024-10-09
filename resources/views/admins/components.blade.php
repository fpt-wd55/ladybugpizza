@extends('layouts.admin')
@section('content')
    <h3 class="mb-4 font-bold leading-none tracking-tight text-gray-900 text-lg mt-3">Table</h3>
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
                        Lọc theo trạng thái
                        @svg('tabler-chevron-down', 'w-4 h-4 ml-2')
                    </button>
                    <!-- Dropdown menu -->
                    <div id="dropdown" class="z-10 hidden w-56 p-3 bg-white rounded-lg shadow">
                        <h6 class="mb-3 text-sm font-medium text-gray-900">
                            Danh mục
                        </h6>
                        <ul class="space-y-2 text-sm" aria-labelledby="dropdownDefault">
                            <li class="flex items-center">
                                <input id="apple" type="checkbox" value=""
                                    class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-0" />

                                <label for="apple" class="ml-2 text-sm font-medium text-gray-900">
                                    Hoàn thành(56)
                                </label>
                            </li>

                            <li class="flex items-center">
                                <input id="fitbit" type="checkbox" value="" checked
                                    class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-0" />

                                <label for="fitbit" class="ml-2 text-sm font-medium text-gray-900">
                                    Đã hủy(56)
                                </label>
                            </li>

                            <li class="flex items-center">
                                <input id="dell" type="checkbox" value=""
                                    class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-0" />

                                <label for="dell" class="ml-2 text-sm font-medium text-gray-900">
                                    Đang tiến hành (56)
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
                                        class="p-4 font-medium tracking-wider text-left text-gray-500 uppercase">
                                        Transaction
                                    </th>
                                    <th scope="col"
                                        class="p-4 font-medium tracking-wider text-left text-gray-500 uppercase">
                                        Date & Time
                                    </th>
                                    <th scope="col"
                                        class="p-4 font-medium tracking-wider text-left text-gray-500 uppercase">
                                        Amount
                                    </th>
                                    <th scope="col"
                                        class="p-4 font-medium tracking-wider text-left text-gray-500 uppercase">
                                        Reference number
                                    </th>
                                    <th scope="col"
                                        class="p-4 font-medium tracking-wider text-left text-gray-500 uppercase">
                                        Payment method
                                    </th>
                                    <th scope="col"
                                        class="p-4 font-medium tracking-wider text-left text-gray-500 uppercase">
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
                                            class="bg-green-100 text-green-800 font-medium mr-2 px-2.5 py-0.5 rounded-md border border-green-100">Completed</span>
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
                                        0088568934576
                                    </td>
                                    <td
                                        class="inline-flex items-center p-4 space-x-2 text-sm font-normal text-gray-500 whitespace-nowrap">
                                        @svg('tabler-truck-delivery', 'w-5 h-5')
                                        <span>••• 826</span>
                                    </td>
                                    <td class="p-4 whitespace-nowrap">
                                        <span
                                            class="bg-red-100 text-red-800 font-medium mr-2 px-2.5 py-0.5 rounded-md border border-red-100">Cancelled</span>
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
                                            class="bg-purple-100 text-purple-800 font-medium mr-2 px-2.5 py-0.5 rounded-md border border-purple-100">In
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
                                            class="bg-orange-100 text-orange-800 font-medium mr-2 px-2.5 py-0.5 rounded-md border border-orange-100">In
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
                    class="inline-flex items-center p-2 font-medium uppercase rounded-lg text-primary-700 sm:text-sm hover:bg-gray-100">
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
                <thead class="text-gray-700 uppercase bg-gray-50">
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
                <thead class="text-gray-700 uppercase bg-gray-50">
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
                            <img loading="lazy" src="https://flowbite.s3.amazonaws.com/blocks/application-ui/products/imac-front-image.png"
                                alt="iMac Front Image" class="w-auto h-8 mr-3">
                            Apple iMac 27&#34;
                        </th>
                        <td class="px-4 py-2">
                            <span class="bg-primary-100 text-primary-800 font-medium px-2 py-0.5 rounded ">Desktop
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
                            <img loading="lazy" src="https://flowbite.s3.amazonaws.com/blocks/application-ui/products/imac-front-image.png"
                                alt="iMac Front Image" class="w-auto h-8 mr-3">
                            Apple iMac 20&#34;
                        </th>
                        <td class="px-4 py-2">
                            <span class="bg-primary-100 text-primary-800 font-medium px-2 py-0.5 rounded ">Desktop
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
                            <img loading="lazy" src="https://flowbite.s3.amazonaws.com/blocks/application-ui/devices/apple-iphone-14.png"
                                alt="iMac Front Image" class="w-auto h-8 mr-3">
                            Apple iPhone 14
                        </th>
                        <td class="px-4 py-2">
                            <span class="bg-primary-100 text-primary-800 font-medium px-2 py-0.5 rounded ">Phone</span>
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
                            <img loading="lazy" src="https://flowbite.s3.amazonaws.com/blocks/application-ui/devices/apple-ipad-air.png"
                                alt="iMac Front Image" class="w-auto h-8 mr-3">
                            Apple iPad Air
                        </th>
                        <td class="px-4 py-2">
                            <span class="bg-primary-100 text-primary-800 font-medium px-2 py-0.5 rounded ">Tablet</span>
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
    <h3 class="mb-4 font-bold leading-none tracking-tight text-gray-900 text-lg mt-3">Form
    </h3>
    <div class="p-4 mx-auto">
        <h3 class="mb-4 text-lg font-bold text-gray-900 ">Update product</h3>
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
                    <label for="username-success"
                        class="block mb-2 text-sm font-medium text-green-700 dark:text-green-500">Your
                        name</label>
                    <input type="text" id="username-success"
                        class="bg-green-50 border border-green-500 text-green-900 dark:text-green-400 placeholder-green-700 dark:placeholder-green-500 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5 dark:bg-gray-700 dark:border-green-500"
                        placeholder="Bonnie Green">
                    <p class="mt-2 text-sm text-green-600 dark:text-green-500"><span class="font-medium">Alright!</span>
                        Username
                        available!</p>
                </div>
                <div>
                    <label for="username-error" class="block mb-2 text-sm font-medium text-red-700 dark:text-red-500">Your
                        name</label>
                    <input type="text" id="username-error"
                        class="bg-red-50 border border-red-500 text-red-900 placeholder-red-700 text-sm rounded-lg focus:ring-red-500 dark:bg-gray-700 focus:border-red-500 block w-full p-2.5 dark:text-red-500 dark:placeholder-red-500 dark:border-red-500"
                        placeholder="Bonnie Green">
                    <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">Oops!</span> Username
                        already
                        taken!</p>
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
                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="file_input">Upload
                        file</label>
                    <input
                        class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                        aria-describedby="file_input_help" id="file_input" type="file">
                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="file_input_help">SVG, PNG, JPG or GIF
                        (MAX.
                        800x400px).
                    </p>
                </div>
                <div class="sm:col-span-2">
                    <label for="description" class="block mb-2 text-sm font-medium text-gray-900 ">Description</label>
                    <textarea id="description" rows="5"
                        class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500"
                        placeholder="Write a description...">Standard glass, 3.8GHz 8-core 10th-generation Intel Core i7 processor, Turbo Boost up to 5.0GHz, 16GB 2666MHz DDR4 memory, Radeon Pro 5500 XT with 8GB of GDDR6 memory, 256GB SSD storage, Gigabit Ethernet, Magic Mouse 2, Magic Keyboard - US</textarea>
                </div>
                <div class="flex items-center justify-center w-full mt-5 sm:col-span-2">
                    <label for="dropzone-file"
                        class="flex flex-col items-center justify-center w-full h-64 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 ">
                        <div class="flex flex-col items-center justify-center pt-5 pb-6">
                            @svg('tabler-upload', 'w-8 h-8 text-gray-500 dark:text-gray-400')
                            <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span class="font-semibold">Click to
                                    upload</span> or drag and drop</p>
                            <p class="text-gray-500 dark:text-gray-400">SVG, PNG, JPG or GIF (MAX. 800x400px)</p>
                        </div>
                        <input id="dropzone-file" type="file" class="hidden" />
                    </label>
                </div>
                <div>
                    <label for="number-input" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Select
                        a
                        number:</label>
                    <input type="number" id="number-input" aria-describedby="helper-text-explanation"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="90210" required />
                </div>
                <div>
                    <label for="zip-input" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">ZIP
                        code:</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 start-0 top-0 flex items-center ps-3.5 pointer-events-none">
                            <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 20">
                                <path
                                    d="M8 0a7.992 7.992 0 0 0-6.583 12.535 1 1 0 0 0 .12.183l.12.146c.112.145.227.285.326.4l5.245 6.374a1 1 0 0 0 1.545-.003l5.092-6.205c.206-.222.4-.455.578-.7l.127-.155a.934.934 0 0 0 .122-.192A8.001 8.001 0 0 0 8 0Zm0 11a3 3 0 1 1 0-6 3 3 0 0 1 0 6Z" />
                            </svg>
                        </div>
                        <input type="text" id="zip-input" aria-describedby="helper-text-explanation"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="12345 or 12345-6789" pattern="^\d{5}(-\d{4})?$" required />
                    </div>
                    <p id="helper-text-explanation" class="mt-2 text-sm text-gray-500 dark:text-gray-400">Please select a
                        5 digit
                        number from 0 to 9.</p>
                </div>
                <div>
                    <label for="countries" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Select an
                        option</label>
                    <select id="countries"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option selected>Choose a country</option>
                        <option value="US">United States</option>
                        <option value="CA">Canada</option>
                        <option value="FR">France</option>
                        <option value="DE">Germany</option>
                    </select>
                </div>
                <div class="flex items-center">
                    <div class="mr-5">
                        <input id="default-checkbox" type="checkbox" value=""
                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                        <label for="default-checkbox"
                            class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Default
                            checkbox</label>
                    </div>
                    <div class="mr-5">
                        <input id="default-radio-1" type="radio" value="" name="default-radio"
                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                        <label for="default-radio-1"
                            class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Default
                            radio</label>
                    </div>
                </div>
            </div>
            <div class="flex items-center space-x-4">
                <button type="submit"
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-0 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                    Update product
                </button>
            </div>
        </form>
    </div>
    <h3 class="mb-4 font-bold leading-none tracking-tight text-gray-900 text-lg mt-3">Popup
    </h3>
    <div class="p-4 mx-auto">
        <div class="flex">
            <!-- Modal toggle -->
            <button data-modal-target="default-modal" data-modal-toggle="default-modal"
                class="me-5 block text-white bg-blue-700 hover:bg-blue-800 focus:ring-0 font-medium rounded-lg text-sm px-5 py-2.5 text-center"
                type="button">
                Toggle modal
            </button>
            <button data-modal-target="popup-modal" data-modal-toggle="popup-modal"
                class="block text-white bg-red-700 hover:bg-red-800 focus:ring-0 font-medium rounded-lg text-sm px-5 py-2.5 text-center"
                type="button">
                Delete modal
            </button>
        </div>

        <!-- Main modal -->
        <div id="default-modal" tabindex="-1" aria-hidden="true"
            class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative p-4 w-full max-w-2xl max-h-full">
                <!-- Modal content -->
                <div class="relative bg-white rounded-lg shadow">
                    <!-- Modal header -->
                    <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t">
                        <h3 class="text-xl font-semibold text-gray-900">
                            Terms of Service
                        </h3>
                        <button type="button"
                            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center"
                            data-modal-hide="default-modal">
                            @svg('tabler-x', 'w-4 h-4')
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>
                    <!-- Modal body -->
                    <div class="p-4 md:p-5 space-y-4">
                        <p class="text-sm leading-relaxed text-gray-500">
                            With less than a month to go before the European Union enacts new consumer privacy laws for its
                            citizens, companies around the world are updating their terms of service agreements to comply.
                        </p>
                        <p class="text-sm leading-relaxed text-gray-500">
                            The European Union’s General Data Protection Regulation (G.D.P.R.) goes into effect on May 25
                            and is meant to ensure a common set of data rights in the European Union. It requires
                            organizations to notify users as soon as possible of high-risk data breaches that could
                            personally affect them.
                        </p>
                    </div>
                    <!-- Modal footer -->
                    <div class="flex items-center p-4 md:p-5 border-t border-gray-200 rounded-b">
                        <button data-modal-hide="default-modal" type="button"
                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">I
                            accept</button>
                        <button data-modal-hide="default-modal" type="button"
                            class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100">Decline</button>
                    </div>
                </div>
            </div>
        </div>

        <div id="popup-modal" tabindex="-1"
            class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative p-4 w-full max-w-md max-h-full">
                <div class="relative bg-white rounded-lg shadow">
                    <button type="button"
                        class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center"
                        data-modal-hide="popup-modal">
                        @svg('tabler-x', 'w-4 h-4')
                        <span class="sr-only">Close modal</span>
                    </button>
                    <div class="p-4 md:p-5 text-center">
                        <div class="flex justify-center">
                            @svg('tabler-trash', 'w-12 h-12 text-red-600 text-center mb-2')
                        </div>
                        <h3 class="mb-5 font-normal">Are you sure you want to
                            delete this product?</h3>
                        <button data-modal-hide="popup-modal" type="button"
                            class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                            Yes, I'm sure
                        </button>
                        <button data-modal-hide="popup-modal" type="button"
                            class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100">No,
                            cancel</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
