<div class="my-4 grid grid-cols-1 xl:grid-cols-3 xl:gap-4 gap-y-4">
    <div class="rounded-lg col-span-2 border border-gray-200 bg-white p-4 shadow-sm sm:p-6 2xl:col-span-2">
        <div class="w-full">
            <div class="grid grid-cols-1 lg:grid-cols-3 items-center justify-between pb-4">
                <div class="w-full md:w-1/2 col-span-2">
                    <h3 class="font-bold leading-none text-gray-900 text-lg">Biểu đồ tổng đơn hàng theo trạng
                        thái</h3>
                </div>
                <div class="flex items-center justify-start lg:justify-end w-full md:w-auto mt-3 lg:m-0">
                    <div class="inline-flex items-center rounded-md bg-slate-100 p-1.5">
                        <button wire:click.prevent="updateChartStatisticOrderOne('week')"
                            class="rounded {{ $selectedTimeRangeStatisticOrderOne == 'week' ? 'bg-white' : '' }} px-3 py-1 text-xs font-medium text-black shadow-card hover:bg-white me-1">
                            Tuần
                        </button>
                        <button wire:click.prevent="updateChartStatisticOrderOne('month')"
                            class="rounded {{ $selectedTimeRangeStatisticOrderOne == 'month' ? 'bg-white' : '' }} px-3 py-1 text-xs font-medium text-black hover:bg-white me-1">
                            Tháng
                        </button>
                        <button wire:click.prevent="updateChartStatisticOrderOne('year')"
                            class="rounded {{ $selectedTimeRangeStatisticOrderOne == 'year' ? 'bg-white' : '' }} px-3 py-1 text-xs font-medium text-black hover:bg-white me-1">
                            Năm
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div wire:ignore class="max-w-full mb-3" id="statistic_order_one">
        </div>
    </div>
    <!--Tabs widget -->
    <div class="rounded-lg border border-gray-200 bg-white p-4 shadow-sm sm:p-6">
        <div class="grid grid-cols-2 items-center justify-between pb-4 space-y-3 md:space-y-0 md:space-x-4">
            <div class="w-full md:w-1/2">
                <h3 class="font-bold leading-none text-gray-900 text-lg">Top đơn hàng</h3>
            </div>
            <div
                class="flex flex-col items-stretch justify-end flex-shrink-0 w-full space-y-2 md:w-auto md:flex-row md:space-y-0 md:items-center md:space-x-3">
                <div class="flex items-center w-full space-x-3 md:w-auto">
                    <button id="dropdownTopOrderLink" data-dropdown-toggle="dropdownTopOrder"
                        data-dropdown-placement="bottom-start"
                        class="flex items-center justify-end w-full py-2 text-sm font-medium text-gray-900 md:w-auto focus:outline-none hover:text-slate-600 focus:z-10 focus:ring-0">
                        {{ $selectedTopOrder }}
                        @svg ('tabler-chevron-down', 'w-4 h-4 ml-2 text-gray-500')
                    </button>
                    <!-- Dropdown menu -->
                    <div id="dropdownTopOrder"
                        class="z-10 hidden font-normal bg-white divide-y divide-gray-100 rounded-lg shadow w-44">
                        <ul class="py-2 text-sm text-gray-700">
                            <li>
                                <a href="#" wire:click.prevent="updateTopOrder('day')"
                                    class="block px-4 py-2 hover:bg-gray-100">Ngày</a>
                            </li>
                            <li>
                                <a href="#" wire:click.prevent="updateTopOrder('week')"
                                    class="block px-4 py-2 hover:bg-gray-100">Tuần</a>
                            </li>
                            <li>
                                <a href="#" wire:click.prevent="updateTopOrder('month')"
                                    class="block px-4 py-2 hover:bg-gray-100">Tháng</a>
                            </li>
                            <li>
                                <a href="#" wire:click.prevent="updateTopOrder('year')"
                                    class="block px-4 py-2 hover:bg-gray-100">Năm</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="border-t border-gray-200 overflow-y-auto no-scrollbar h-96">
            <div>
                <ul class="divide-y divide-gray-200">
                    @forelse ($topOrders as $order)
                        <li class="py-2">
                            <div class="flex items-center justify-between">
                                <div class="flex min-w-0 items-center">
                                    <div>
                                        <p class="truncate font-medium text-gray-900">
                                            Mã đơn hàng: #{{ $order->id }}
                                        </p>
                                        <span class="text-gray-500">{{ number_format($order->amount) }}₫</span>
                                    </div>
                                </div>
                                <div class="inline-flex items-center font-semibold text-gray-900">
                                    <a href="{{ route('admin.orders.edit', $order) }}"
                                        class="flex w-full items-center justify-center text-sm font-medium text-gray-900 hover:text-slate-600 focus:z-10 focus:ring-0 md:w-auto">
                                        @svg('tabler-external-link', 'h-4 w-4 me-1.5')
                                        Chi tiết
                                    </a>
                                </div>
                            </div>
                        </li>
                    @empty
                        <dl class="w-1/2 sm:w-1/4 sm:flex-1 lg:w-auto">
                            <div class="flex flex-col items-center justify-center p-6 rounded-lg w-full h-80">
                                @svg('tabler-folder-cancel', 'w-20 h-20 text-gray-400')
                                <p class="mt-4 text-gray-500 text-sm">Dữ liệu trống</p>
                            </div>
                        </dl>
                    @endforelse
                </ul>
            </div>
        </div>
    </div>
</div>
<script>
    document.addEventListener('livewire:init', () => {
        const statistic_order_one = Highcharts.chart('statistic_order_one', {
            chart: {
                type: 'column'
            },
            credits: {
                enabled: false
            },
            colors: ['#d42020'],
            title: {
                text: '',
            },
            xAxis: {
                categories: @json($this->labels),
                crosshair: true,
            },
            yAxis: {
                allowDecimals: false,
                title: {
                    text: ''
                }
            },
            tooltip: {
                valueSuffix: ''
            },
            legend: {
                enabled: false
            },
            plotOptions: {
                column: {
                    pointPadding: 0.2,
                    borderWidth: 0
                },
                series: {
                    dataLabels: {
                        enabled: true,
                        format: '{point.y}'
                    }
                }
            },
            series: [{
                name: 'Đơn hàng',
                data: @json($this->orderDataStatisticOrderOne)
            }],
            accessibility: {
                enabled: false
            }
        });
        Livewire.on('updateChartStatisticOrderOne', (data) => {
            if (statistic_order_one.series.length) {
                statistic_order_one.xAxis[0].setCategories(data[0].labels);
                statistic_order_one.series[0].update({
                    data: data[0].orderDataStatisticOrderOne
                });
            }
        });
    })
</script>