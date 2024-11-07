<?php

namespace App\Charts;

use ConsoleTVs\Charts\Classes\Chartjs\Chart;

class RevenueChart2 extends Chart
{
    /**
     * Initializes the chart.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();

        $this->type('doughnut');

        $this->labels(['Tháng 1', 'Tháng 2', 'Tháng 3', 'Tháng 4']);

        $this->dataset('Doanh thu', 'doughnut', [500, 1000, 750, 1250])->options([
            'borderColor' => ['#007bff', '#00aaff', '#005fbb', '#003f7f'],
            'backgroundColor' => [
                'rgba(0, 123, 255, 0.5)', 
                'rgba(0, 170, 255, 0.5)', 
                'rgba(0, 95, 187, 0.5)', 
                'rgba(0, 63, 127, 0.5)' 
            ],
        ]);
    }
}
