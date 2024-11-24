<?php

namespace App\Livewire;

use App\Models\Membership;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class StatisticUserThree extends Component
{
    public $selectedTopUser;
    public $nameSelectedTopUser;
    public $topUsers;
    public $selectedTimeTopUser;

    public function mount()
    {
        $this->updateTopUser('mostOrder', 'month');
        $this->nameSelectedTopUser = 'Sản phẩm có lượt mua nhiều nhất';
        $this->selectedTopUser = 'mostOrder';
        $this->selectedTimeTopUser = 'month';
    }

    public function updateTopUser($period, $time)
    {
        $timeRange = $this->getTimeRange($time);
        $this->selectedTopUser = $period;
        switch ($period) {
            case 'mostOrder':
                $this->topUsers = [];
                $this->nameSelectedTopUser = 'Top người dùng mua hàng nhiều nhất';
                $datas = User::join('orders', 'users.id', '=', 'orders.user_id')
                    ->select('users.id', DB::raw('COUNT(orders.id) as total'))
                    ->whereBetween('orders.completed_at', $timeRange)
                    ->groupBy('users.id')
                    ->orderBy('total', 'desc')
                    ->limit(10)
                    ->get();
                foreach ($datas as $data) {
                    $this->topUsers[] = User::find($data->id);
                }
                break;

            case 'mostPoint':
                $this->topUsers = [];
                $this->nameSelectedTopUser = 'Top người dùng có điểm tích lũy cao nhất';
                $datas = Membership::select('user_id', 'total_spent')
                    ->whereBetween('created_at', $timeRange)
                    ->orderBy('total_spent', 'desc')
                    ->limit(10)
                    ->get();
                foreach ($datas as $data) {
                    $this->topUsers[] = User::find($data->user_id);
                }
                break;

            default:
                break;
        }
    }

    public function getTimeRange($time)
    {
        $date = now();
        $this->selectedTimeTopUser = $time;
        switch ($time) {
            case 'day':
                return [$date->copy()->startOfDay(), $date->copy()->endOfDay()];
            case 'week':
                return [$date->copy()->startOfWeek(), $date->copy()->endOfWeek()];
            case 'month':
                return [$date->copy()->startOfMonth(), $date->copy()->endOfMonth()];
            case 'year':
                return [$date->copy()->startOfYear(), $date->copy()->endOfYear()];
            default:
                return [null, null];
        }
    }

    public function updateSelectionUser($type, $value)
    {
        if ($type == 'user') {
            $this->updateTopUser($value, $this->selectedTimeTopUser);
        } elseif ($type == 'time') {
            $this->updateTopUser($this->selectedTopUser, $value);
        }
    }

    public function render()
    {
        return view('livewire.statistic-user-three');
    }
}
