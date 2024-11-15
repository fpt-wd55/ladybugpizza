<?php

namespace App\Livewire;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class StatisticRevenueOne extends Component
{
    public $labels = [];
    public $selectedTimeRangeStatisticRevenueOne;
    public $revenueDataStatisticRevenueOne = [];
    public $orderDataStatisticRevenueOne = [];
    public $startDateStatisticRevenueOne;
    public $endDateStatisticRevenueOne;

    public function mount()
    {
        $this->updateChartStatisticRevenueOne('week');
    }

    public function updateChartStatisticRevenueOne($timeRange)
    {
        $this->labels = [];
        $this->revenueDataStatisticRevenueOne = [];
        $this->orderDataStatisticRevenueOne = [];
        $this->selectedTimeRangeStatisticRevenueOne = $timeRange;

        $date = now();
        $dataTimes = [];

        switch ($timeRange) {
            case 'week':
                $start = $date->copy()->startOfWeek();
                $end = $date->copy();
                $format = 'Y-m-d';
                $labelFormat = 'd/m/Y';
                break;
            case 'month':
                $start = $date->copy()->startOfMonth();
                $end = $date->copy();
                $format = 'Y-m-d';
                $labelFormat = 'd/m/Y';
                break;
            case 'year':
                $start = $date->copy()->startOfYear();
                $end = $date->copy();
                $format = 'Y-m';
                $labelFormat = 'm/Y';
                break;
            default:
                break;
        }

        $this->generateLabelsAndDataTimes($start, $end, $timeRange, $format, $labelFormat, $dataTimes);
        $this->fetchData($dataTimes, $timeRange);

        $this->dispatch('updateChartStatisticRevenueOne', [
            'labels' => $this->labels,
            'revenueDataStatisticRevenueOne' => $this->revenueDataStatisticRevenueOne,
            'orderDataStatisticRevenueOne' => $this->orderDataStatisticRevenueOne,
        ]);
    }

    public function filterByDateRangeStatisticRevenueOne()
    {
        $this->labels = [];
        $this->revenueDataStatisticRevenueOne = [];

        $this->validate(
            [
                'startDateStatisticRevenueOne' => 'required|date',
                'endDateStatisticRevenueOne' => 'required|date|after_or_equal:startDateStatisticRevenueOne',
            ],
            [
                'startDateStatisticRevenueOne.required' => 'Vui lòng chọn ngày bắt đầu',
                'startDateStatisticRevenueOne.date' => 'Ngày bắt đầu không hợp lệ',
                'endDateStatisticRevenueOne.required' => 'Vui lòng chọn ngày kết thúc',
                'endDateStatisticRevenueOne.date' => 'Ngày kết thuc không hợp lệ',
                'endDateStatisticRevenueOne.after_or_equal' => 'Ngày kết thúc phải sau hoặc bằng ngày bắt đầu',
            ]
        );

        $start = Carbon::parse($this->startDateStatisticRevenueOne);
        $end = Carbon::parse($this->endDateStatisticRevenueOne);


        $dataTimes = [];
        $this->generateLabelsAndDataTimes($start, $end, 'day', 'Y-m-d', 'd/m/Y', $dataTimes);
        $this->fetchData($dataTimes, 'day');

        $this->dispatch('updateChartStatisticRevenueOne', [
            'labels' => $this->labels,
            'revenueDataStatisticRevenueOne' => $this->revenueDataStatisticRevenueOne,
            'orderDataStatisticRevenueOne' => $this->orderDataStatisticRevenueOne,
        ]);
    }

    private function generateLabelsAndDataTimes($start, $end, $timeRange, $format, $labelFormat, &$dataTimes)
    {
        for ($date = $start; $date->lte($end); $date->add($timeRange === 'year' ? '1 month' : '1 day')) {
            $this->labels[] = $date->format($labelFormat);
            $dataTimes[] = $date->format($format);
        }
    }

    private function fetchData($dataTimes, $timeRange)
    {
        foreach ($dataTimes as $time) {
            $query = DB::table('orders');
            if ($timeRange === 'year') {
                $query->whereYear('completed_at', Carbon::parse($time)->year)
                    ->whereMonth('completed_at', Carbon::parse($time)->month)
                    ->groupBy(DB::raw('YEAR(completed_at), MONTH(completed_at)'));
            } else {
                $query->whereDate('completed_at', $time)
                    ->groupBy('completed_at');
            }
            $this->revenueDataStatisticRevenueOne[] = (int)$query->sum('amount');
            $this->orderDataStatisticRevenueOne[] = $query->count();
        }
    }

    public function render()
    {
        return view('livewire.statistic-revenue-one');
    }
}
