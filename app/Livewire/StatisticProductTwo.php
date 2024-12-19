<?php

namespace App\Livewire;

use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class StatisticProductTwo extends Component
{
    public $selectedTopProduct;
    public $nameSelectedTopProduct;
    public $topProducts;
    public $selectedTimeTopProduct;

    public function mount()
    {
        $this->updateTopProduct('mostPurchased', 'month');
        $this->nameSelectedTopProduct = 'Sản phẩm có lượt mua nhiều nhất';
        $this->selectedTopProduct = 'mostPurchased';
        $this->selectedTimeTopProduct = 'month';
    }

    public function updateTopProduct($period, $time)
    {
        $timeRange = $this->getTimeRange($time);
        $this->selectedTopProduct = $period;
        switch ($period) {
            case 'mostPurchased':
                $this->nameSelectedTopProduct = 'Sản phẩm có lượt mua nhiều nhất';
                $this->topProducts = Product::withCount('orderItems')
                    ->whereDate('created_at', '>=', $timeRange[0])
                    ->whereDate('created_at', '<=', $timeRange[1])
                    ->orderBy('order_items_count', 'desc')
                    ->limit(10)
                    ->get();
                break;

            case 'mostInStock':
                $this->nameSelectedTopProduct = 'Sản phẩm tồn kho nhiều nhất';
                $datas = DB::table('products as p')
                    ->leftJoin('categories as c', 'p.category_id', '=', 'c.id')
                    ->leftJoin('attributes as a', 'a.category_id', '=', 'c.id')
                    ->leftJoin('attribute_values as av', 'av.attribute_id', '=', 'a.id')
                    ->select(
                        'p.id',
                        DB::raw('IFNULL(SUM(av.quantity), p.quantity) as total')
                    )
                    ->whereBetween('p.created_at', $timeRange)
                    ->groupBy('p.id', 'p.quantity')
                    ->orderBy('total', 'desc')
                    ->limit(10)
                    ->get();
                foreach ($datas as $data) {
                    $product = Product::find($data->id);
                    $product->total_quantity = $data->total;
                    $this->topProducts[] = $product;
                }
                break;

            case 'mostReviewed':
                $this->nameSelectedTopProduct = 'Sản phẩm có lượt đánh giá cao nhất';
                $this->topProducts = Product::whereBetween('created_at', $timeRange)
                    ->orderBy('total_rating', 'desc')
                    ->limit(10)
                    ->get();
                break;

            case 'highestQuality':
                $this->nameSelectedTopProduct = 'Sản phẩm có chất lượng đánh giá cao nhất';
                $this->topProducts = Product::whereBetween('created_at', $timeRange)
                    ->orderBy('avg_rating', 'desc')
                    ->limit(10)
                    ->get();
                break;

            default:
                break;
        }
    }

    public function getTimeRange($time)
    {
        $date = now();
        $this->selectedTimeTopProduct = $time;
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

    public function updateSelection($type, $value)
    {
        if ($type == 'product') {
            $this->updateTopProduct($value, $this->selectedTimeTopProduct);
        } elseif ($type == 'time') {
            $this->updateTopProduct($this->selectedTopProduct, $value);
        }
    }

    public function render()
    {
        return view('livewire.statistic-product-two');
    }
}
