<div class="rounded-lg border border-gray-200 bg-white p-4 shadow-sm sm:p-6">
    <div wire:ignore class="max-w-full mb-3" id="statistic_user_two">
    </div>
</div>
<script>
    document.addEventListener('livewire:init', () => {
        const statistic_user_two = Highcharts.chart('statistic_user_two', {
            chart: {
                type: 'pie'
            },
            credits: {
                enabled: false
            },
            title: {
                text: 'Tỷ lệ người dùng theo giới tính',
                style: {
                    fontSize: '17px',
                    fontWeight: 'bold'
                }
            },
            tooltip: {
                headerFormat: '',
                pointFormat: '<span style="color:{point.color}">\u25cf</span> ' +
                    '{point.name}: <b>{point.y} người dùng</b>'
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
                data: @json($dataStatisticUserTwo),
            }]
        });
    })
</script>
