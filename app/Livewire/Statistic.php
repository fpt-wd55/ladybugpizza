<?php

namespace App\Livewire;

use App\Charts\RevenueChart1;
use App\Charts\RevenueChart2;
use App\Charts\TestChart;
use App\Charts\UserChart1;
use App\Charts\UserChart2;
use Livewire\Component;

class Statistic extends Component
{
    public function render()
    {
        $chart = new TestChart();
        $revenueChart1 = new RevenueChart1();
        $revenueChart2 = new RevenueChart2();
        $revenueChart3 = new RevenueChart2();
        $revenueChart4 = new RevenueChart1();
        $userChart1 = new TestChart();
        $userChart2 = new UserChart1();
        $userChart3 = new UserChart1();
        $userChart4 = new UserChart1();
        $userChart5 = new UserChart2();
        $userChart6 = new UserChart2();

        return view('livewire.statistic', [
            'chart' => $chart,
            'revenueChart1' => $revenueChart1,
            'revenueChart2' => $revenueChart2,
            'revenueChart3' => $revenueChart3,
            'revenueChart4' => $revenueChart4,
            'userChart1' => $userChart1,
            'userChart2' => $userChart2,
            'userChart3' => $userChart3,
            'userChart4' => $userChart4,
            'userChart5' => $userChart5,
            'userChart6' => $userChart6,
        ]);
    }
}
