<?php

namespace App\Livewire;

use App\Models\Category;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class StatisticProductOne extends Component
{
    public function render()
    {
        $categories = Category::all();

        foreach ($categories as $category) {
            $query = DB::table('products');
            $query->selectRaw('COUNT(id) AS count')
                ->where('category_id', $category->id);
            $dataStatisticProductOne[] = [
                'name' => $category->name,
                'y' => $query->first()->count,
            ];
        }
        return view('livewire.statistic-product-one', [
            'dataStatisticProductOne' => $dataStatisticProductOne,
        ]);
    }
}
