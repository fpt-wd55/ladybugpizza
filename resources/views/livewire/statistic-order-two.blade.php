<div class="rounded-lg border border-gray-200 bg-white p-4 shadow-sm sm:p-6">
    <div class="w-full">
        <div class="grid grid-cols-1 items-center justify-between pb-4">
            <div class="w-full">
                <h3 class="font-bold leading-none text-gray-900 text-lg">Tỷ lệ thanh toán theo phương thức</h3>
            </div>
            <div class="flex items-center justify-start w-full mt-3">
                <div class="inline-flex items-center rounded-md bg-slate-100 p-1.5">
                    <button wire:click.prevent="updateChartStatisticOrderTwo('week')"
                        class="rounded {{ $selectedTimeRangeStatisticOrderTwo == 'week' ? 'bg-white' : '' }} px-3 py-1 text-xs font-medium text-black shadow-card hover:bg-white me-1">
                        Tuần
                    </button>
                    <button wire:click.prevent="updateChartStatisticOrderTwo('month')"
                        class="rounded {{ $selectedTimeRangeStatisticOrderTwo == 'month' ? 'bg-white' : '' }} px-3 py-1 text-xs font-medium text-black hover:bg-white me-1">
                        Tháng
                    </button>
                    <button wire:click.prevent="updateChartStatisticOrderTwo('year')"
                        class="rounded {{ $selectedTimeRangeStatisticOrderTwo == 'year' ? 'bg-white' : '' }} px-3 py-1 text-xs font-medium text-black hover:bg-white me-1">
                        Năm
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div wire:ignore class="max-w-full mb-3" id="statistic_order_two">
    </div>
</div>
<script>
    document.addEventListener('livewire:init', () => {
        const statistic_order_two = Highcharts.chart('statistic_order_two', {
            chart: {
                type: 'pie'
            },
            credits: {
                enabled: false
            },
            colors: ['#d42020', '#1E429F'],
            title: {
                text: '',
            },
            tooltip: {
                headerFormat: '',
                pointFormat: '<span style="color:{point.color}">\u25cf</span> ' +
                    '{point.name}: <b>{point.percentage:.1f}%</b>'
            },
            accessibility: {
                enabled: false
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    borderWidth: 2,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: true,
                        format: '<b>{point.name}</b><br>{point.percentage:.1f}%',
                        distance: 20
                    }
                },
            },
            series: [{
                animation: {
                    duration: 1000
                },
                colorByPoint: true,
                data: @json($orderDataStatisticOrderTwo)
            }]
        });
        Livewire.on('updateChartStatisticOrderTwo', (data) => {
            if (statistic_order_two.series.length) {
                const nestedData = data[0].orderDataStatisticOrderTwo
                statistic_order_two.series[0].update({
                    data: nestedData
                });
            }
        });
    })
</script>
