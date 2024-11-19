<?php

namespace App\Livewire;

use App\Models\Membership;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class StatisticUserThree extends Component
{
    public $selectedTopUser;
    public $topUsers;

    public function mount()
    {
        $this->updateTopUser('mostOrder');
    }

    public function updateTopUser($period)
    {

        switch ($period) {
            case 'mostOrder':
                $this->topUsers = [];
                $this->selectedTopUser = 'Top người dùng mua hàng nhiều nhất';
                $datas = User::join('orders', 'users.id', '=', 'orders.user_id')
                    ->select('users.id', DB::raw('COUNT(orders.id) as total'))
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
                $this->selectedTopUser = 'Top người dùng có điểm tích lũy cao nhất';
                $datas = Membership::select('user_id', 'total_spent')
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

    public function render()
    {
        return view('livewire.statistic-user-three');
    }
}
