<?php

namespace App\Livewire;

use App\Models\User;
use Carbon\Carbon; 
use Livewire\Component;

class StatisticUserOne extends Component
{
    public function render()
    {
        $dataLabels = [
            18 => 'Dưới 18 tuổi',
            24 => '18-24 tuổi',
            34 => '25-34 tuổi',
            44 => '35-44 tuổi',
            54 => '45-54 tuổi',
            64 => '55-64 tuổi',
            65 => '65 tuổi trở lên',
        ];

        $currentDate = Carbon::now();
        $dataStatisticUserOne = [];

        foreach ($dataLabels as $age => $label) {
            if ($age == 18) {
                $birthdateEnd = $currentDate->copy()->subYears($age)->format('Y-m-d');
                $count = User::whereDate('date_of_birth', '>=', $birthdateEnd)->count();
            } else if ($age == 65) {
                $birthdateStart = $currentDate->copy()->subYears($age)->format('Y-m-d');
                $count = User::whereDate('date_of_birth', '<=', $birthdateStart)->count();
            } else {
                $birthdateStart = $currentDate->copy()->subYears($age)->format('Y-m-d');
                $birthdateEnd = $currentDate->copy()->subYears($age - 9)->format('Y-m-d');
                $count = User::whereBetween('date_of_birth', [$birthdateStart, $birthdateEnd])->count();
            }
            $dataStatisticUserOne[] = [
                'name' => $label,
                'y' => $count,
            ];
        }

        return view('livewire.statistic-user-one', [
            'dataStatisticUserOne' => $dataStatisticUserOne,
        ]);
    }
}
