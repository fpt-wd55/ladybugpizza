<div class="rounded-lg border border-gray-200 bg-white p-4 shadow-sm sm:p-6">
    <div class="w-full">
        <div class="grid grid-cols-1 items-center justify-between pb-4">
            <div class="w-full">
                <h3 class="font-bold leading-none text-gray-900 text-lg">Biểu đồ tổng đơn hàng theo trạng thái</h3>
            </div>
            <div class="flex items-center justify-start w-full mt-3">
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
                style: {
                    fontSize: '17px',
                    fontWeight: 'bold'
                }
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
