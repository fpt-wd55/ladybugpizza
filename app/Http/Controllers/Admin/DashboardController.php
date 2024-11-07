<?php

namespace App\Http\Controllers\Admin;

use App\Charts\TestChart;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        $chart = new TestChart();

        return view('admins.dashboard', [
            'chart' => $chart
        ]);
    }

    public function components()
    {
        return view('admins.components');
    }
}
