<?php

namespace App\Livewire;

use App\Models\Order;
use App\Models\OrderStatus;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class StatisticOrderOne extends Component
{
    public $labels = [];
    public $selectedTimeRangeStatisticOrderOne;
    public $selectedTopOrder;
    public $orderDataStatisticOrderOne = [];
    public $topOrders;

    public function mount()
    {
        $this->updateChartStatisticOrderOne('month');
        $this->updateTopOrder('month');
    }

    public function updateChartStatisticOrderOne($timeRange)
    {
        $this->labels = [];
        $this->orderDataStatisticOrderOne = [];
        $this->selectedTimeRangeStatisticOrderOne = $timeRange;
        $statuses = OrderStatus::all();
        foreach ($statuses as $status) {
            $this->labels[] = $status->name;
        }

        $dateRange = $this->getDateRange($timeRange);
        $this->fetchData($dateRange, $this->labels);
        $this->dispatch('updateChartStatisticOrderOne', [
            'labels' => $this->labels,
            'orderDataStatisticOrderOne' => $this->orderDataStatisticOrderOne,
        ]);
    }

    private function getDateRange($timeRange)
    {
        $date = now();
        switch ($timeRange) {
            case 'week':
                return [$date->copy()->startOfWeek(), $date->copy()->endOfWeek()];
            case 'month':
                return [$date->copy()->startOfMonth(), $date->copy()->endOfMonth()];
            case 'year':
                return [$date->copy()->startOfYear(), $date->copy()->endOfYear()];
            default:
                return [null, null];
        }
    }

    private function fetchData($dateRange, $labels)
    {
        foreach ($labels as $label) {
            $label = OrderStatus::where('name', $label)->first()->id;
            $query = DB::table('orders');
            $query->selectRaw('COUNT(id) AS count')
                ->whereBetween('created_at', $dateRange)
                ->where('order_status_id', $label);
            $this->orderDataStatisticOrderOne[] = $query->get()->pluck('count')->first();
        }
    }

    public function updateTopOrder($timeRange)
    {
        $date = now();
        switch ($timeRange) {
            case 'day':
                $this->selectedTopOrder = 'Ngày';
                $dateRange = [$date->copy()->startOfDay(), $date->copy()->endOfDay()];
                $this->topOrders = Order::whereBetween('completed_at', $dateRange)
                    ->orderBy('amount', 'desc')
                    ->limit(10)
                    ->get();
                break;

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
        return view('livewire.statistic-order-one');
    }
}
