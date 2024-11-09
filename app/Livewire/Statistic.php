<?php

namespace App\Livewire;

use App\Charts\Charjs;
use Livewire\Component;

class Statistic extends Component
{
    public function render()
    {
        $chart = new Charjs();
        $chart->type('line');
        $chart->labels(['Tháng 1', 'Tháng 2', 'Tháng 3', 'Tháng 4']);
        $chart->dataset('Doanh thu', 'line', [500, 1000, 750, 1250])->options([
            'borderColor' => '#007bff',
            'backgroundColor' => 'rgba(0, 123, 255, 0.3)',
        ]);
        $chart->dataset('Chi phí', 'line', [600, 800, 1190, 1000])->options([
            'borderColor' => '#ff5733',
            'backgroundColor' => 'rgba(255, 87, 51, 0.3)',
        ]);

        $revenueChart1 = new Charjs();
        $revenueChart1->type('bar');

        // Gán nhãn (labels) cho các trục x
        $revenueChart1->labels(['Tháng 1', 'Tháng 2', 'Tháng 3', 'Tháng 4']);

        // Thêm dữ liệu cho biểu đồ
        $revenueChart1->dataset('Doanh thu', 'bar', [500, 1000, 750, 1250])->options([
            'borderColor' => '#007bff',
            'backgroundColor' => 'rgba(0, 123, 255, 0.3)',
        ]);

        $revenueChart1->dataset('Chi phí', 'bar', [600, 800, 1190, 1000])->options([
            'borderColor' => '#ff5733',
            'backgroundColor' => 'rgba(255, 87, 51, 0.3)',
        ]);

        $revenueChart2 = new Charjs();
        $revenueChart2->type('doughnut');

        $revenueChart2->labels(['Tháng 1', 'Tháng 2', 'Tháng 3', 'Tháng 4']);

        $revenueChart2->dataset('Doanh thu', 'doughnut', [500, 1000, 750, 1250])->options([
            'borderColor' => ['#007bff', '#00aaff', '#005fbb', '#003f7f'],
            'backgroundColor' => [
                'rgba(0, 123, 255, 0.5)',
                'rgba(0, 170, 255, 0.5)',
                'rgba(0, 95, 187, 0.5)',
                'rgba(0, 63, 127, 0.5)'
            ],
        ]);

        $revenueChart3 = new Charjs();
        $revenueChart3->type('doughnut');

        $revenueChart3->labels(['Tháng 1', 'Tháng 2', 'Tháng 3', 'Tháng 4']);

        $revenueChart3->dataset('Doanh thu', 'doughnut', [500, 1000, 750, 1250])->options([
            'borderColor' => ['#007bff', '#00aaff', '#005fbb', '#003f7f'],
            'backgroundColor' => [
                'rgba(0, 123, 255, 0.5)',
                'rgba(0, 170, 255, 0.5)',
                'rgba(0, 95, 187, 0.5)',
                'rgba(0, 63, 127, 0.5)'
            ],
        ]);

        $revenueChart4 = new Charjs();
        $revenueChart4->type('doughnut');

        $revenueChart4->labels(['Tháng 1', 'Tháng 2', 'Tháng 3', 'Tháng 4']);

        $revenueChart4->dataset('Doanh thu', 'doughnut', [500, 1000, 750, 1250])->options([
            'borderColor' => ['#007bff', '#00aaff', '#005fbb', '#003f7f'],
            'backgroundColor' => [
                'rgba(0, 123, 255, 0.5)',
                'rgba(0, 170, 255, 0.5)',
                'rgba(0, 95, 187, 0.5)',
                'rgba(0, 63, 127, 0.5)'
            ],
        ]);

        $userChart1 = new Charjs();
        $userChart1->type('pie');

        // Gán nhãn (labels) cho các trục x
        $userChart1->labels(['Tháng 1', 'Tháng 2', 'Tháng 3', 'Tháng 4']);

        // Thêm dữ liệu cho biểu đồ
        $userChart1->dataset('Doanh thu', 'pie', [500, 1000, 750, 1250])->options([
            'borderColor' => ['rgba(0, 123, 255, 1)', 'rgba(0, 170, 255, 1)', 'rgba(0, 95, 187, 1)', 'rgba(0, 63, 127, 1)'],
            'backgroundColor' => [
                'rgba(0, 123, 255, 0.9)',
                'rgba(0, 170, 255, 0.9)',
                'rgba(0, 95, 187, 0.9)',
                'rgba(0, 63, 127, 0.9)',
            ],
        ]);

        $userChart2 = new Charjs();
        $userChart2->type('pie');

        // Gán nhãn (labels) cho các trục x
        $userChart2->labels(['Tháng 1', 'Tháng 2', 'Tháng 3', 'Tháng 4']);

        // Thêm dữ liệu cho biểu đồ
        $userChart2->dataset('Doanh thu', 'pie', [500, 1000, 750, 1250])->options([
            'borderColor' => ['rgba(0, 123, 255, 1)', 'rgba(0, 170, 255, 1)', 'rgba(0, 95, 187, 1)', 'rgba(0, 63, 127, 1)'],
            'backgroundColor' => [
                'rgba(0, 123, 255, 0.9)',
                'rgba(0, 170, 255, 0.9)',
                'rgba(0, 95, 187, 0.9)',
                'rgba(0, 63, 127, 0.9)',
            ],
        ]);

        $userChart3 = new Charjs();
        $userChart3->type('pie');

        // Gán nhãn (labels) cho các trục x
        $userChart3->labels(['Tháng 1', 'Tháng 2', 'Tháng 3', 'Tháng 4']);

        // Thêm dữ liệu cho biểu đồ
        $userChart3->dataset('Doanh thu', 'pie', [500, 1000, 750, 1250])->options([
            'borderColor' => ['rgba(0, 123, 255, 1)', 'rgba(0, 170, 255, 1)', 'rgba(0, 95, 187, 1)', 'rgba(0, 63, 127, 1)'],
            'backgroundColor' => [
                'rgba(0, 123, 255, 0.9)',
                'rgba(0, 170, 255, 0.9)',
                'rgba(0, 95, 187, 0.9)',
                'rgba(0, 63, 127, 0.9)',
            ],
        ]);

        $userChart4 = new Charjs();
        $userChart4->labels(['Tháng 1', 'Tháng 2', 'Tháng 3', 'Tháng 4']);

        // Thêm dữ liệu cho biểu đồ
        $userChart4->dataset('Doanh thu', 'bar', [500, 1000, 750, 1250])->options([
            'borderColor' => ['rgba(0, 123, 255, 1)', 'rgba(0, 170, 255, 1)', 'rgba(0, 95, 187, 1)', 'rgba(0, 63, 127, 1)'],
            'backgroundColor' => [
                'rgba(0, 123, 255, 0.9)',
                'rgba(0, 170, 255, 0.9)',
                'rgba(0, 95, 187, 0.9)',
                'rgba(0, 63, 127, 0.9)',
            ],
        ]);

        $userChart4->dataset('Doanh thu', 'bar', [500, 1000, 750, 1250])->options([
            'borderColor' => ['rgba(0, 123, 255, 1)', 'rgba(0, 170, 255, 1)', 'rgba(0, 95, 187, 1)', 'rgba(0, 63, 127, 1)'],
            'backgroundColor' => [
                'rgba(0, 123, 255, 0.9)',
                'rgba(0, 170, 255, 0.9)',
                'rgba(0, 95, 187, 0.9)',
                'rgba(0, 63, 127, 0.9)',
            ],
        ]);

        $userChart4->options([
            'indexAxis' => 'y', // Makes the bars horizontal
            'scales' => [
                'x' => [
                    'beginAtZero' => true,
                ],
            ]
        ]);

        $userChart5 = new Charjs();
        $userChart5->labels(['Tháng 1', 'Tháng 2', 'Tháng 3', 'Tháng 4']);

        // Thêm dữ liệu cho biểu đồ
        $userChart5->dataset('Doanh thu', 'bar', [500, 1000, 750, 1250])->options([
            'borderColor' => ['rgba(0, 123, 255, 1)', 'rgba(0, 170, 255, 1)', 'rgba(0, 95, 187, 1)', 'rgba(0, 63, 127, 1)'],
            'backgroundColor' => [
                'rgba(0, 123, 255, 0.9)',
                'rgba(0, 170, 255, 0.9)',
                'rgba(0, 95, 187, 0.9)',
                'rgba(0, 63, 127, 0.9)',
            ],
        ]);

        $userChart5->dataset('Doanh thu', 'bar', [500, 1000, 750, 1250])->options([
            'borderColor' => ['rgba(0, 123, 255, 1)', 'rgba(0, 170, 255, 1)', 'rgba(0, 95, 187, 1)', 'rgba(0, 63, 127, 1)'],
            'backgroundColor' => [
                'rgba(0, 123, 255, 0.9)',
                'rgba(0, 170, 255, 0.9)',
                'rgba(0, 95, 187, 0.9)',
                'rgba(0, 63, 127, 0.9)',
            ],
        ]);

        $userChart5->options([
            'indexAxis' => 'y', // Makes the bars horizontal
            'scales' => [
                'x' => [
                    'beginAtZero' => true,
                ],
            ]
        ]);

        $userChart6 = new Charjs();
        $userChart6->labels(['Tháng 1', 'Tháng 2', 'Tháng 3', 'Tháng 4']);

        // Thêm dữ liệu cho biểu đồ
        $userChart6->dataset('Doanh thu', 'bar', [500, 1000, 750, 1250])->options([
            'borderColor' => ['rgba(0, 123, 255, 1)', 'rgba(0, 170, 255, 1)', 'rgba(0, 95, 187, 1)', 'rgba(0, 63, 127, 1)'],
            'backgroundColor' => [
                'rgba(0, 123, 255, 0.9)',
                'rgba(0, 170, 255, 0.9)',
                'rgba(0, 95, 187, 0.9)',
                'rgba(0, 63, 127, 0.9)',
            ],
        ]);

        $userChart6->dataset('Doanh thu', 'bar', [500, 1000, 750, 1250])->options([
            'borderColor' => ['rgba(0, 123, 255, 1)', 'rgba(0, 170, 255, 1)', 'rgba(0, 95, 187, 1)', 'rgba(0, 63, 127, 1)'],
            'backgroundColor' => [
                'rgba(0, 123, 255, 0.9)',
                'rgba(0, 170, 255, 0.9)',
                'rgba(0, 95, 187, 0.9)',
                'rgba(0, 63, 127, 0.9)',
            ],
        ]);

        $userChart6->options([
            'indexAxis' => 'y', // Makes the bars horizontal
            'scales' => [
                'x' => [
                    'beginAtZero' => true,
                ],
            ]
        ]);


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
