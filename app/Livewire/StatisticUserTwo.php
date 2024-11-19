<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;

class StatisticUserTwo extends Component
{
    public function render()
    {
        $dataLabels = [
            1 => "Nam",
            2 => "Nữ",
            3 => "Khác",
        ];

        $dataStatisticUserTwo = [];

        foreach ($dataLabels as $key => $label) {
            $count = User::where('gender', $key)->count();
            $dataStatisticUserTwo[] = [
                'name' => $label,
                'y' => $count,
            ];
        }

        return view('livewire.statistic-user-two', [
            'dataStatisticUserTwo' => $dataStatisticUserTwo,
        ]);
    }
}
