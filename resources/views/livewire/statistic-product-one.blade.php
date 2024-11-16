<div class="rounded-lg border border-gray-200 bg-white p-4 shadow-sm sm:p-6">
    <div wire:ignore class="max-w-full mb-3" id="statistic_product_one">
    </div>
</div>
<script>
    document.addEventListener('livewire:init', () => {
        const statistic_product_one = Highcharts.chart('statistic_product_one', {
            chart: {
                type: 'pie'
            },
            credits: {
                enabled: false
            }, 
            title: {
                text: 'Số lượng sản phẩm theo danh mục',
            },
            tooltip: {
                headerFormat: '',
                pointFormat: '<span style="color:{point.color}">\u25cf</span> ' +
                    '{point.name}: <b>{point.y} sản phẩm</b>'
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
                        format: '<b>{point.name}</b><br>{point.y} sản phẩm',
                        distance: 20
                    }
                },
            },
            series: [{
                animation: {
                    duration: 1000
                },
                colorByPoint: true,
                data: @json($dataStatisticProductOne),
            }]
        });
    })
</script>
