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
        $this->dispatch('updateChart', [
            'labels' => $this->labels,
            'revenueData' => $this->revenueData,
            'orderData' => $this->orderData,
        ]);
    }

    public function updateChartData()
    {
        switch ($this->timeRange) {
            case '7':
                $this->nameTimeRange = '7 ngày qua';
                $this->labels = ['Thứ 2', 'Thứ 3', 'Thứ 4', 'Thứ 5', 'Thứ 6', 'Thứ 7', 'Chủ nhật'];
                $this->revenueData = [100, 200, 150, 300, 250, 400, 350];
                $this->orderData = [120, 180, 160, 280, 240, 380, 330];
                break;
            case '30':
                $this->nameTimeRange = '30 ngày qua';
                $this->labels = range(1, 30);
                $this->revenueData = array_map(fn() => rand(100, 500), range(1, 30));
                $this->orderData = array_map(fn() => rand(100, 500), range(1, 30));
                break;
            case '90':
                $this->nameTimeRange = '90 ngày qua';
                $this->labels = range(1, 90);
                $this->revenueData = array_map(fn() => rand(100, 500), range(1, 90));
                $this->orderData = array_map(fn() => rand(100, 500), range(1, 90));
                break;
            case '365':
                $this->nameTimeRange = '1 năm qua';
                $this->labels = range(1, 12);
                $this->revenueData = array_map(fn() => rand(1000, 5000), range(1, 12));
                $this->orderData = array_map(fn() => rand(1000, 5000), range(1, 12));
                break;
            default:
                $this->nameTimeRange = '1 năm qua';
                $this->labels = range(1, 12);
                $this->revenueData = array_map(fn() => rand(1000, 5000), range(1, 12));
                $this->orderData = array_map(fn() => rand(1000, 5000), range(1, 12));
                break;
        }
    }

    public function render()
    {
        return view('livewire.statistic-revenue-one');
    }
}
