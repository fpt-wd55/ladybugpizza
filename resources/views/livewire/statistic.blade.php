<div>
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
                            <h3 class="my-3 text-sm font-bold leading-none text-gray-900 sm:text-base">Doanh thu
                            </h3>
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
                            <h3 class="my-3 text-sm font-bold leading-none text-gray-900 sm:text-base">Doanh thu
                            </h3>
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
</div>
