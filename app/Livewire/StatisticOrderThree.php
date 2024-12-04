<?php

namespace App\Livewire;

use App\Models\Order;
use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Vanthao03596\HCVN\Models\Province;
use Vanthao03596\HCVN\Models\District;
use Vanthao03596\HCVN\Models\Ward;

class StatisticOrderThree extends Component
{
    public $orderDataStatisticOrderThree;
    public $selectedTimeRangeStatisticOrderThree;


    public function mount()
    {
        $this->updateChartStatisticOrderThree('district');
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

        $areaNames = [];
        if ($area == 'province') {
            $areaNames = Province::pluck('name_with_type', 'code')->toArray();
        } elseif ($area == 'district') {
            $areaNames = District::pluck('name_with_type', 'code')->toArray();
        } elseif ($area == 'ward') {
            $areaNames =  Ward::pluck('name_with_type', 'code')->toArray();
        }

        $datas->transform(function ($item) use ($areaNames, $area) {
            $item->{$area} = $areaNames[$item->{$area}] ?? 'Không xác định';
            return $item;
        });

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
