<div class="rounded-lg border border-gray-200 bg-white p-4 shadow-sm sm:p-6">
    <div class="w-full">
        <div class="grid grid-cols-1 items-center justify-between pb-4">
            <div class="w-full">
                <h3 class="font-bold leading-none text-gray-900 text-lg">Top 10 khu vực đặt hàng nhiều nhất</h3>
            </div>
            <div class="flex items-center justify-start w-full mt-3">
                <div class="inline-flex items-center rounded-md bg-slate-100 p-1.5">
                    <button wire:click.prevent="updateChartStatisticOrderThree('province')"
                        class="rounded {{ $selectedTimeRangeStatisticOrderThree == 'province' ? 'bg-white' : '' }} px-3 py-1 text-xs font-medium text-black shadow-card hover:bg-white me-1">
                        Tỉnh
                    </button>
                    <button wire:click.prevent="updateChartStatisticOrderThree('district')"
                        class="rounded {{ $selectedTimeRangeStatisticOrderThree == 'district' ? 'bg-white' : '' }} px-3 py-1 text-xs font-medium text-black hover:bg-white me-1">
                        Quận/Huyện
                    </button>
                    <button wire:click.prevent="updateChartStatisticOrderThree('ward')"
                        class="rounded {{ $selectedTimeRangeStatisticOrderThree == 'ward' ? 'bg-white' : '' }} px-3 py-1 text-xs font-medium text-black hover:bg-white me-1">
                        Phường
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div wire:ignore class="max-w-full mb-3" id="statistic_order_three">
    </div>
</div>
<script>
    document.addEventListener('livewire:init', () => {
        const statistic_order_three = Highcharts.chart('statistic_order_three', {
            chart: {
                type: 'bar'
            },
            credits: {
                enabled: false
            },
            title: {
                text: ''
            },
            xAxis: {
                type: 'category',
                labels: {
                    autoRotation: [-45, -90],
                }
            },
            yAxis: {
                min: 0,
                title: {
                    text: ''
                }
            },
            legend: {
                enabled: false
            },
            accessibility: {
                enabled: false
            },
            series: [{
                name: 'Đơn hàng',
                colorByPoint: true,
                groupPadding: 0,
                data: @json($orderDataStatisticOrderThree),
                dataLabels: {
                    enabled: true,
                    color: '#FFFFFF',
                    inside: true,
                    verticalAlign: 'top',
                    format: '{point.y} đơn hàng',
                }
            }]
        });
        Livewire.on('updateChartStatisticOrderThree', (data) => {
            if (statistic_order_three.series.length) {
                const nestedData = data[0].orderDataStatisticOrderThree
                statistic_order_three.series[0].update({
                    data: nestedData
                });
            }
        });
    })
</script>
