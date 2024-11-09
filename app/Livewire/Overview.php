<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Livewire\Component;

class Overview extends Component
{
    public function render()
    {
        $overview = collect([
            'users' => User::class,
            'products' => Product::class,
            'orders' => Order::class,
            'categories' => Category::class,
        ])->mapWithKeys(function ($model, $key) {
            return [$key => $model::count()];
        })->toArray();

        return view('livewire.overview', compact('overview'));
    }
}
