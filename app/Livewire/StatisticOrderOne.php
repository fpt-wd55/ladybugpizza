<?php

namespace App\Livewire;

use App\Models\Order;
use App\Models\OrderStatus;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class StatisticOrderOne extends Component
{
    

    public function render()
    {
        return view('livewire.statistic-order-one');
    }
}
