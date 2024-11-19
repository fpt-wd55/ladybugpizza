<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Order;

class StatisticRevenueThree extends Component
{
    public $topOrders;
    public $selectedTopOrder;

    public function mount()
    {
        $this->updateTopOrder('month');
    }

    public function updateTopOrder($timeRange)
    {
        $date = now();
        switch ($timeRange) {
            case 'week':
                $this->selectedTopOrder = 'Tuần';
                $dateRange = [$date->copy()->startOfWeek(), $date->copy()->endOfWeek()];
                $this->topOrders = Order::whereBetween('completed_at', $dateRange)
                    ->orderBy('amount', 'desc')
                    ->limit(10)
                    ->get();
                break;

            case 'month':
                $this->selectedTopOrder = 'Tháng';
                $dateRange = [$date->copy()->startOfMonth(), $date->copy()->endOfMonth()];
                $this->topOrders = Order::whereBetween('completed_at', $dateRange)
                    ->orderBy('amount', 'desc')
                    ->limit(10)
                    ->get();
                break;

            case 'year':
                $this->selectedTopOrder = 'Năm';
                $dateRange = [$date->copy()->startOfYear(), $date->copy()->endOfYear()];
                $this->topOrders = Order::whereBetween('completed_at', $dateRange)
                    ->orderBy('amount', 'desc')
                    ->limit(10)
                    ->get();
                break;

            default:
                break;
        }
    }

    public function render()
    {
        return view('livewire.statistic-revenue-three');
    }
}
