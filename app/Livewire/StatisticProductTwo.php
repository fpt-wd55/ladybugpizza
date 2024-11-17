<?php

namespace App\Livewire;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class StatisticProductTwo extends Component
{
    public $selectedTopProduct;
    public $topOrders;

    public function mount()
    {
        $this->updateTopProduct('mostPurchased');
    }

    public function updateTopProduct($period)
    {
        $dateRange = [now()->startOfYear(), now()->endOfYear()];
        switch ($period) {
            case 'mostPurchased':
                $this->selectedTopProduct = 'Sản phẩm có lượt mua nhiều nhất';
                $this->topOrders = Order::join('order_items', 'orders.id', '=', 'order_items.order_id')
                    ->join('products', 'products.id', '=', 'order_items.product_id')
                    ->whereBetween('orders.completed_at', $dateRange)
                    ->select(
                        'products.id',
                        DB::raw('COUNT(order_items.id) as amount'),
                        DB::raw('SUM(order_items.quantity) as total')
                    )
                    ->groupBy('products.id')
                    ->orderBy('amount', 'desc')
                    ->limit(10)
                    ->get(); 
                break;

            case 'mostInStock':
                $this->selectedTopProduct = 'Sản phẩm tồn kho nhiều nhất';
                $this->topOrders = Order::whereBetween('completed_at', $dateRange)
                    ->orderBy('amount', 'desc')
                    ->limit(10)
                    ->get();
                break;

            case 'mostReviewed':
                $this->selectedTopProduct = 'Sản phẩm có lượt đánh giá cao nhất';
                $this->topOrders = Order::whereBetween('completed_at', $dateRange)
                    ->orderBy('amount', 'desc')
                    ->limit(10)
                    ->get();
                break;

            case 'highestQuality':
                $this->selectedTopProduct = 'Sản phẩm có chất lượng đánh giá cao nhất';
                $this->topOrders = Order::whereBetween('completed_at', $dateRange)
                    ->orderBy('amount', 'desc')
                    ->limit(10)
                    ->get();
                break;

            default:
                break;
        }
    }

    public function render()
    {
        return view('livewire.statistic-product-two');
    }
}
