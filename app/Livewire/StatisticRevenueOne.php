<?php

namespace App\Livewire;

use App\Charts\Highcharts;
use App\Models\Order;
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
                $this->revenueData = [100, 200, 150, 300, 250, 400, 350];
                $this->orderData = [120, 180, 160, 280, 240, 380, 330];

                $order = Order::query();
                $date = now();
                for ($i = 0; $i < $this->timeRange; $i++) {
                    $this->labels[] = $date->subDays(1)->format('d/m/yy');
                }
                $this->labels = array_reverse($this->labels);

                break;
            case '30':
                $this->nameTimeRange = '30 ngày qua';

                $date = now();
                for ($i = 0; $i < $this->timeRange; $i++) {
                    $this->labels[] = $date->subDays(1)->format('d/m/yy');
                }
                $this->labels = array_reverse($this->labels);

                $this->revenueData = array_map(fn() => rand(100, 500), range(1, 30));
                $this->orderData = array_map(fn() => rand(100, 500), range(1, 30));
                break;
            case '90':
                $this->nameTimeRange = '90 ngày qua';

                $date = now();
                for ($i = 0; $i < $this->timeRange; $i++) {
                    $this->labels[] = $date->subDays(1)->format('d/m/yy');
                }

                $this->labels = array_reverse($this->labels);
                $this->labels = array_reverse($this->labels);
                $this->revenueData = array_map(fn() => rand(100, 500), range(1, 90));
                $this->orderData = array_map(fn() => rand(100, 500), range(1, 90));
                break;
            case '365':
                $this->nameTimeRange = '1 năm qua';

                $date = now();
                for ($i = 0; $i < $this->timeRange; $i++) {
                    $this->labels[] = $date->subWeeks(1)->format('d/m/yy');
                }
                $this->labels = array_reverse($this->labels);

                $this->revenueData = array_map(fn() => rand(1000, 5000), range(1, $this->timeRange));
                $this->orderData = array_map(fn() => rand(1000, 5000), range(1, $this->timeRange));
                break;
            default:
                $this->nameTimeRange = '7 ngày qua';

                $date = now();
                for ($i = 0; $i < 7; $i++) {
                    $this->labels[] = $date->subDays(1)->format('d/m/yy');
                }
                $this->labels = array_reverse($this->labels); 

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
