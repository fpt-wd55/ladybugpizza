<div>
    <div wire:ignore class="p-4 bg-white border border-gray-200 rounded-lg shadow-sm 2xl:col-span-2">
        <div class="grid grid-cols-1 lg:grid-cols-3 items-center justify-between pb-4 mt-4">
            <div class="w-full md:w-1/2 col-span-2">
                <div date-rangepicker class="grid items-center grid-cols-3 gap-4 w-full">
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                            @svg('tabler-calendar', 'w-5 h-5 text-gray-500')
                        </div>
                        <input name="start" type="text" class="input pl-10 p-2" placeholder="Từ">
                    </div>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                            @svg('tabler-calendar', 'w-5 h-5 text-gray-500')
                        </div>
                        <input name="end" type="text" class="input pl-10 p-2" placeholder="Đến">
                    </div>
                    <button class="button-red" type="submit">Lọc</button>
                </div>
            </div>
            <div class="flex items-center justify-start lg:justify-end w-full md:w-auto mt-3 lg:m-0">
                <button id="statisticRevenueOne" data-dropdown-toggle="statistic-revenue-one"
                    data-dropdown-placement="bottom"
                    class="flex items-center justify-center w-full px-4 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg md:w-auto focus:outline-none hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:ring-0"
                    type="button">
                    {{ $nameTimeRange }}
                    @svg ('tabler-chevron-down', 'w-4 h-4 ml-2 text-gray-500')
                </button>
                <div id="statistic-revenue-one"
                    class="hidden z-10 w-56 divide-y divide-gray-100 overflow-hidden overflow-y-auto rounded-lg bg-white antialiased shadow">
                    <ul class="p-2 text-start text-sm font-medium text-gray-900">
                        <li>
                            <a href="#" wire:click.prevent="updateChart('7')"
                                class="inline-flex w-full items-center gap-2 rounded-md px-3 py-2 text-sm hover:bg-gray-100">
                                7 ngày qua
                            </a href="#">
                        </li>
                        <li>
                            <a href="#" wire:click.prevent="updateChart('30')"
                                class="inline-flex w-full items-center gap-2 rounded-md px-3 py-2 text-sm hover:bg-gray-100">
                                30 ngày qua
                            </a href="#">
                        </li>
                        <li>
                            <a href="#" wire:click.prevent="updateChart('90')"
                                class="inline-flex w-full items-center gap-2 rounded-md px-3 py-2 text-sm hover:bg-gray-100">
                                90 ngày qua
                            </a href="#">
                        </li>
                        <li>
                            <a href="#" wire:click.prevent="updateChart('365')"
                                class="inline-flex w-full items-center gap-2 rounded-md px-3 py-2 text-sm hover:bg-gray-100">
                                1 năm qua
                            </a href="#">
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="max-w-full mb-3" id="statistic_revenue_one">
        </div>
    </div>
</div> 
<script>
    document.addEventListener('livewire:init', () => {
        const chart = Highcharts.stockChart('statistic_revenue_one', {
            chart: {
                type: 'line'
            },
            colors: ['#f87171', '#60a5fa'],
            title: {
                text: 'Tổng doanh thu và đơn hàng'
            },
            xAxis: {
                categories: @json($this->labels)
            },
            yAxis: {
                title: {
                    text: ''
                },
            },
            plotOptions: {
                series: {
                    allowPointSelect: true
                }
            },
            series: [{
                    name: 'Doanh thu',
                    data: @json($this->revenueData)
                },
                {
                    name: 'Đơn hàng',
                    data: @json($this->orderData)
                }
            ],
            rangeSelector: {
                enabled: false
            },
            scrollbar: {
                enabled: false
            },
            responsive: {
                rules: [{
                    condition: {
                        maxWidth: 500
                    },
                    chartOptions: {
                        legend: {
                            layout: 'horizontal',
                            align: 'center',
                            verticalAlign: 'bottom'
                        }
                    }
                }]
            }
        });

        Livewire.on('updateChart', (data) => {
            chart.update({
                xAxis: {
                    categories: data[0].labels
                },
                series: [{
                        name: 'Doanh thu',
                        data: data[0].revenueData
                    },
                    {
                        name: 'Đơn hàng',
                        data: data[0].orderData
                    }
                ]
            });
        });
    })
</script>
