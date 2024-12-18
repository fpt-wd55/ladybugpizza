<div class="p-4 bg-white border border-gray-200 rounded-lg shadow-sm 2xl:col-span-2 mb-4">
    <div class="grid grid-cols-1 lg:grid-cols-3 items-center justify-between pb-4 mt-4">
        <div class="w-full md:w-1/2 col-span-2">
            <div class="grid items-center grid-cols-3 gap-4 w-full">
                <input wire:model="startDateStatisticRevenueOne" autocomplete="off" type="date" class="input">
                <input wire:model="endDateStatisticRevenueOne" autocomplete="off" type="date" class="input">
                <button wire:click="filterByDateRangeStatisticRevenueOne" class="button-red" type="button">Lọc</button>
            </div>
            @if ($errors->has('startDateStatisticRevenueOne') || $errors->has('endDateStatisticRevenueOne'))
                <div class="text-sm text-red-800 py-2">
                    <span>{{ $errors->first('startDateStatisticRevenueOne') ?: $errors->first('endDateStatisticRevenueOne') }}</span>
                </div>
            @endif
        </div>
        <div class="flex items-center justify-start lg:justify-end w-full md:w-auto mt-3 lg:m-0">
            <div class="inline-flex items-center rounded-md bg-slate-100 p-1.5">
                <button wire:click.prevent="updateChartStatisticRevenueOne('week')"
                    class="rounded {{ $selectedTimeRangeStatisticRevenueOne == 'week' ? 'bg-white' : '' }} px-3 py-1 text-xs font-medium text-black shadow-card hover:bg-white me-1">
                    Tuần
                </button>
                <button wire:click.prevent="updateChartStatisticRevenueOne('month')"
                    class="rounded {{ $selectedTimeRangeStatisticRevenueOne == 'month' ? 'bg-white' : '' }} px-3 py-1 text-xs font-medium text-black hover:bg-white me-1">
                    Tháng
                </button>
                <button wire:click.prevent="updateChartStatisticRevenueOne('year')"
                    class="rounded {{ $selectedTimeRangeStatisticRevenueOne == 'year' ? 'bg-white' : '' }} px-3 py-1 text-xs font-medium text-black hover:bg-white me-1">
                    Năm
                </button>
            </div>
        </div>
    </div>
    <div wire:ignore class="max-w-full mb-3" id="statistic_revenue_one">
    </div>
</div>
<script>
    document.addEventListener('livewire:init', () => {
        const statistic_revenue_one = Highcharts.chart('statistic_revenue_one', {
            chart: {},
            credits: {
                enabled: false
            },
            colors: ['#d42020', '#1E429F'],
            title: {
                text: 'Biểu đồ doanh thu và đơn hàng',
            },
            xAxis: [{
                categories: @json($this->labels),
                crosshair: true
            }],
            yAxis: [{
                allowDecimals: false,
                labels: {
                    format: '{value} VNĐ',
                },
                title: {
                    text: '',
                }
            }, {
                allowDecimals: false,
                title: {
                    text: '',
                },
                labels: {
                    format: '{value}',
                },
                opposite: true
            }],
            tooltip: {
                shared: true
            },
            legend: {
                align: 'center',
                verticalAlign: 'top',
            },
            series: [{
                name: 'Đơn hàng',
                type: 'column',
                yAxis: 1,
                data: @json($this->orderDataStatisticRevenueOne),
                tooltip: {
                    valueSuffix: ' đơn'
                }
            }, {
                name: 'Doanh thu',
                type: 'spline',
                data: @json($this->revenueDataStatisticRevenueOne),
                tooltip: {
                    valueSuffix: ' VNĐ'
                }
            }],
            accessibility: {
                enabled: false
            }
        });

        Livewire.on('updateChartStatisticRevenueOne', (data) => {
            if (statistic_revenue_one.series.length) {
                statistic_revenue_one.xAxis[0].setCategories(data[0].labels);
                statistic_revenue_one.series[0].update({
                    data: data[0].orderDataStatisticRevenueOne
                });
                statistic_revenue_one.series[1].update({
                    data: data[0].revenueDataStatisticRevenueOne
                });
            }
        });
    })
</script>
