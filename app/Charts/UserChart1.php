<?php

namespace App\Charts;

use ConsoleTVs\Charts\Classes\Chartjs\Chart;

class UserChart1 extends Chart
{
    /**
     * Initializes the chart.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();

        $this->type('pie');

        // Gán nhãn (labels) cho các trục x
        $this->labels(['Tháng 1', 'Tháng 2', 'Tháng 3', 'Tháng 4']);

        // Thêm dữ liệu cho biểu đồ
        $this->dataset('Doanh thu', 'pie', [500, 1000, 750, 1250])->options([
            'borderColor' => ['rgba(0, 123, 255, 1)', 'rgba(0, 170, 255, 1)', 'rgba(0, 95, 187, 1)', 'rgba(0, 63, 127, 1)'],
            'backgroundColor' => [
                'rgba(0, 123, 255, 0.9)',
                'rgba(0, 170, 255, 0.9)',
                'rgba(0, 95, 187, 0.9)',
                'rgba(0, 63, 127, 0.9)',
            ],
        ]);
    }
}
