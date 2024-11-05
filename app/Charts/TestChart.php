<?php

namespace App\Charts;

use ConsoleTVs\Charts\Classes\Chartjs\Chart;

class TestChart extends Chart
{
    /**
     * Initializes the chart.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();

        $this->type('line');

        // Gán nhãn (labels) cho các trục x
        $this->labels(['Tháng 1', 'Tháng 2', 'Tháng 3', 'Tháng 4']);

        // Thêm dữ liệu cho biểu đồ
        $this->dataset('Doanh thu', 'line', [500, 1000, 750, 1250])->options([
            'borderColor' => '#007bff',
            'backgroundColor' => 'rgba(0, 123, 255, 0.3)',
        ]);
    }
}
