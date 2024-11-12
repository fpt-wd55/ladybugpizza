<?php

namespace App\Livewire;

use App\Charts\Highcharts;
use App\Models\Order;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class StatisticRevenueOne extends Component
{
    public $labels = [];
    public $nameTimeRange = '7 ngày qua';
    public $revenueData = [];
    public $orderData = [];

    public function mount()
    {
        $this->updateChart(7);
    }

    public function updateChart($timeRange)
    {
        switch ($timeRange) {
            case '7':
                $this->nameTimeRange = '7 ngày qua';
                $this->labels = $this->getLabels($timeRange);
                $this->revenueData = $this->getRevenueData($this->labels);
                $this->orderData = $this->getOrdersData($this->labels);
                break;
            case '30':
                $this->nameTimeRange = '30 ngày qua';
                $this->labels = $this->getLabels($timeRange);
                $this->revenueData = $this->getRevenueData($this->labels);
                $this->orderData = $this->getOrdersData($this->labels);
                break;
            case '90':
                $this->nameTimeRange = '90 ngày qua';
                $this->labels = $this->getLabels($timeRange);
                $this->revenueData = $this->getRevenueData($this->labels);
                $this->orderData = $this->getOrdersData($this->labels);
                break;
            case '365':
                $this->nameTimeRange = '1 năm qua';
                $this->labels = $this->getLabels($timeRange);
                $this->revenueData = $this->getRevenueData($this->labels);
                $this->orderData = $this->getOrdersData($this->labels);
                break;
            default:
                $this->nameTimeRange = '7 ngày qua';
                $this->labels = $this->getLabels(7);
                $this->revenueData = $this->getRevenueData($this->labels);
                $this->orderData = $this->getOrdersData($this->labels);
                break;
        }
        $this->dispatch('updateChart', [
            'labels' => $this->labels,
            'revenueData' => $this->revenueData,
            'orderData' => $this->orderData,
        ]);
    }

    public function getLabels($timeRange)
    {

        $date = now();
        for ($i = 0; $i < $timeRange; $i++) {
            $this->labels[] = $date->subDays(1)->format('Y-m-d');
        }
        return array_reverse($this->labels);
    }

    public function getRevenueData(array $labels)
    {
        $revenueData = [];
        foreach ($labels as $label) {
            $revenueData[] = DB::table('orders')
            ->whereDate('completed_at', $label)
            ->groupBy('completed_at')
            ->sum('amount');
        } 
        return $revenueData;
    }

    public function getOrdersData(array $labels)
    {
        $orderData = [];
        foreach ($labels as $label) {
            $orderData[] = DB::table('orders')
                ->whereDate('created_at', $label)
                ->orderBy('created_at', 'asc')
                ->count();
        }
        return $orderData;
    }

    public function render()
    {
        return view('livewire.statistic-revenue-one');
    }
}
