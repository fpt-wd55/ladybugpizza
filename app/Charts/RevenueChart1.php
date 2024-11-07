<?php

namespace App\Charts;

use ConsoleTVs\Charts\Classes\Chartjs\Chart;

class RevenueChart1 extends Chart
{
    /**
     * Initializes the chart.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();

        $this->type('bar');

        // Gán nhãn (labels) cho các trục x
        $this->labels(['Tháng 1', 'Tháng 2', 'Tháng 3', 'Tháng 4']);

        // Thêm dữ liệu cho biểu đồ
        $this->dataset('Doanh thu', 'bar', [500, 1000, 750, 1250])->options([
            'borderColor' => '#007bff',
            'backgroundColor' => 'rgba(0, 123, 255, 0.3)',
        ]);

        $this->dataset('Chi phí', 'bar', [600, 800, 1190, 1000])->options([
            'borderColor' => '#ff5733',
            'backgroundColor' => 'rgba(255, 87, 51, 0.3)',
        ]);
    }
}
