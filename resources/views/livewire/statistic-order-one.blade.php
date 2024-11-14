<div class="my-4 grid grid-cols-1 xl:grid-cols-3 xl:gap-4 gap-y-4">
    <div class="rounded-lg col-span-2 border border-gray-200 bg-white p-4 shadow-sm sm:p-6 2xl:col-span-2">
        <div class="w-full">
            <h3 class="mb-3 text-base font-bold leading-none text-gray-900 sm:text-xl">
            </h3>
        </div>
        <div wire:ignore class="max-w-full mb-3" id="statistic_order_one">
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
                        <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownLargeButton">
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
<script>
    document.addEventListener('livewire:init', () => {
        const chart = Highcharts.chart('statistic_order_one', {
            chart: {
                type: 'column'
            },
            title: {
                text: 'Tổng đơn hàng theo trạng thái',
            },
            xAxis: {
                categories: ['USA', 'China', 'Brazil', 'EU', 'Argentina', 'India'],
                crosshair: true,
            },
            yAxis: {
                allowDecimals: false,
                title: {
                    text: ''
                }
            },
            tooltip: {
                valueSuffix: ' '
            },
            plotOptions: {
                column: {
                    pointPadding: 0.2,
                    borderWidth: 0
                }
            },
            series: [{
                name: 'Đơn hàng',
                data: [387749, 280000, 129000, 64300, 54000, 34300]
            }]
        });

        Livewire.on('updateChartStatisticRevenueOne', (data) => {
            if (chart.series.length) {
                chart.xAxis[0].setCategories(data[0].labels);
                chart.series[0].update({
                    data: data[0].orderData
                });
                chart.series[1].update({
                    data: data[0].revenueData
                });
            }
        });
    })
</script>
