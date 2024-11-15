<?php

namespace App\Livewire;

use App\Models\PaymentMethod;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class StatisticOrderTwo extends Component
{
    public $orderDataStatisticOrderTwo;
    public $selectedTimeRangeStatisticOrderTwo;
    public $selectedTopOrder;
    public $topOrders;


    public function mount()
    {
        $this->updateChartStatisticOrderTwo('month');
    }

    public function updateChartStatisticOrderTwo($timeRange)
    {
        $this->orderDataStatisticOrderTwo = [];
        $this->selectedTimeRangeStatisticOrderTwo = $timeRange;


        $dateRange = $this->getDateRange($timeRange);
        $this->fetchData($dateRange);


        $this->dispatch('updateChartStatisticOrderTwo', [
            'orderDataStatisticOrderTwo' => $this->orderDataStatisticOrderTwo,
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

    private function fetchData($dateRange)
    {
        $paymentMethods = PaymentMethod::all();
        foreach ($paymentMethods as $method) {
            $query = DB::table('orders');
            $query->selectRaw('COUNT(id) AS count')
                ->whereBetween('created_at', $dateRange)
                ->where('payment_method_id', $method->id);
            $this->orderDataStatisticOrderTwo[] = [
                'name' => $method->name,
                'y' => $query->first()->count,
            ];
        }
    }

    public function render()
    {
        return view('livewire.statistic-order-two');
    }
}
