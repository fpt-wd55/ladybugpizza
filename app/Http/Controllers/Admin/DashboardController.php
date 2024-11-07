<?php

namespace App\Http\Controllers\Admin;

use App\Charts\RevenueChart1;
use App\Charts\RevenueChart2;
use App\Charts\TestChart;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        $chart = new TestChart();
        $revenueChart1 = new RevenueChart1();
        $revenueChart2 = new RevenueChart2();
        $revenueChart3 = new RevenueChart2();

        return view('admins.dashboard', [
            'chart' => $chart,
            'revenueChart1' => $revenueChart1,
            'revenueChart2' => $revenueChart2,
            'revenueChart3' => $revenueChart3,
        ]);
    } 
}
