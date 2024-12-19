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
        $this->updateTopProduct('mostPurchased', 'day');
        $this->nameSelectedTopProduct = 'Sản phẩm có lượt mua nhiều nhất';
        $this->selectedTopProduct = 'mostPurchased';
        $this->selectedTimeTopProduct = 'day';
    }

    public function updateTopProduct($period, $time)
    {
        $timeRange = $this->getTimeRange($time);
        $this->selectedTopProduct = $period;
        $this->topProducts = [];
        switch ($period) {
            case 'mostPurchased':
                $this->nameSelectedTopProduct = 'Sản phẩm có lượt mua nhiều nhất';
                // Lấy ra 10 sản phẩm có "lượt mua" nhiều nhất trong khoảng thời gian đã chọn, điều kiện đơn hàng orders.status = đã hoàn thành

                $datas = Product::join('order_items', 'products.id', '=', 'order_items.product_id')
                    ->join('orders', 'order_items.order_id', '=', 'orders.id')
                    ->where('orders.order_status_id', 5)
                    ->whereBetween('orders.created_at', $timeRange)
                    ->select('products.id', DB::raw('SUM(order_items.quantity) as total_quantity'))
                    ->groupBy('products.id')
                    ->orderByDesc('total_quantity')
                    ->limit(10)
                    ->get();
//                dd($datas);
                foreach ($datas as $data) {
                    $product = Product::find($data->id);
                    $product->total_quantity = $data->total_quantity;
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
