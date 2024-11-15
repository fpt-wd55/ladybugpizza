<?php

namespace App\Livewire;

use App\Models\Order;
use Livewire\Component;
use Illuminate\Support\Facades\DB;

class StatisticOrderThree extends Component
{
    public $orderDataStatisticOrderThree;
    public $selectedTimeRangeStatisticOrderThree;


    public function mount()
    {
        $this->updateChartStatisticOrderThree('province');
    }

    public function updateChartStatisticOrderThree($area)
    {
        $this->orderDataStatisticOrderThree = [];
        $this->selectedTimeRangeStatisticOrderThree = $area;


        $datas = Order::join('addresses as a', 'a.user_id', '=', 'orders.user_id')
            ->select('a.' . $area, DB::raw('COUNT(orders.id) as count'))
            ->groupBy('a.' . $area)
            ->orderByDesc(DB::raw('COUNT(orders.id)'))
            ->get();


        $this->orderDataStatisticOrderThree = $datas->take(10)->map(function ($data) use ($area) {
            return [$data->$area, $data->count];
        });


        $this->dispatch('updateChartStatisticOrderThree', [
            'orderDataStatisticOrderThree' => $this->orderDataStatisticOrderThree,
        ]);
    }

    public function render()
    {
        return view('livewire.statistic-order-three');
    }
}
