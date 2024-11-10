<?php

namespace App\Livewire;

use App\Charts\Highcharts;
use Livewire\Component;

class StatisticRevenueOne extends Component
{
    public $timeRange = '7';
    public $labels = [];
    public $nameTimeRange = '7 ngày qua';
    public $revenueData = [];
    public $orderData = [];

    public function mount()
    {
        $this->updateChartData();
    }

    public function updateTimeRange($timeRange)
    {
        $this->timeRange = $timeRange;
        $this->updateChartData();
    }

    public function updateChartData()
    {
        $this->labels = $this->getLabels();
        $this->revenueData = $this->getRevenueData();
        $this->orderData = $this->getOrderData();
        $this->nameTimeRange = $this->getNameTimeRange();
    }

    public function chart()
    {
        $chart = new Highcharts();
        $chart->title('Tổng doanh thu và đơn hàng');
        $chart->type('spline');
        $chart->labels($this->labels);

        $chart->dataset('Doanh thu', 'spline', $this->revenueData)->options([
            'borderColor' => '#007bff',
            'backgroundColor' => 'rgba(0, 123, 255, 0.3)',
        ]);

        $chart->dataset('Chi phí', 'spline', $this->orderData)->options([
            'borderColor' => '#ff5733',
            'backgroundColor' => 'rgba(255, 87, 51, 0.3)',
        ]);

        return $chart;
    }

    public function getNameTimeRange()
    {
        switch ($this->timeRange) {
            case '7':
                return '7 ngày qua';
            case '30':
                return '30 ngày qua';
            case '90':
                return '90 ngày qua';
            case '365':
                return '1 năm qua';
            default:
                return '';
        }
    }

    private function getLabels()
    {
        switch ($this->timeRange) {
            case '7':
                return ['Ngày 1', 'Ngày 2', 'Ngày 3', 'Ngày 4', 'Ngày 5', 'Ngày 6', 'Ngày 7'];
            case '30':
                return array_map(fn($i) => "Ngày $i", range(1, 30));
            case '90':
                return array_map(fn($i) => "Ngày $i", range(1, 90));
            case '365':
                return array_map(fn($i) => "Tháng $i", range(1, 12));
            default:
                return [];
        }
    }

    private function getRevenueData()
    {
        switch ($this->timeRange) {
            case '7':
                return [100, 200, 150, 300, 250, 400, 350];
            case '30':
                return array_map(fn() => rand(100, 500), range(1, 30));
            case '90':
                return array_map(fn() => rand(100, 500), range(1, 90));
            case '365':
                return array_map(fn() => rand(1000, 5000), range(1, 12));
            default:
                return [];
        }
    }

    private function getOrderData()
    {
        switch ($this->timeRange) {
            case '7':
                return [120, 180, 160, 280, 240, 380, 330];
            case '30':
                return array_map(fn() => rand(100, 500), range(1, 30));
            case '90':
                return array_map(fn() => rand(100, 500), range(1, 90));
            case '365':
                return array_map(fn() => rand(1000, 5000), range(1, 12));
            default:
                return [];
        }
    }

    public function render()
    {
        $StatisticRevenueOne = $this->chart();
        return view('livewire.statistic-revenue-one', compact('StatisticRevenueOne'));
    }
}
