<?php

namespace App\Livewire;

use App\Models\Evaluation;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class StatisticProductTwo extends Component
{
    public $selectedTopProduct;
    public $topProducts;

    public function mount()
    {
        $this->updateTopProduct('mostPurchased');
    }

    public function updateTopProduct($period)
    {
        switch ($period) {
            case 'mostPurchased':
                $this->selectedTopProduct = 'Sản phẩm có lượt mua nhiều nhất';
                $this->topProducts = Product::withCount('orderItems')
                    ->orderBy('order_items_count', 'desc')
                    ->limit(10)
                    ->get();
                break;

            case 'mostInStock':
                $this->selectedTopProduct = 'Sản phẩm tồn kho nhiều nhất';
                $datas = DB::table('products as p')
                    ->leftJoin('categories as c', 'p.category_id', '=', 'c.id')
                    ->leftJoin('attributes as a', 'a.category_id', '=', 'c.id')
                    ->leftJoin('attribute_values as av', 'av.attribute_id', '=', 'a.id')
                    ->select(
                        'p.id',
                        DB::raw('IFNULL(SUM(av.quantity), p.quantity) as total')
                    )
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

                foreach ($datas as $data) {
                    $product = Product::find($data->id);
                    $product->total_quantity = $data->total;
                    $this->topProducts[] = $product;
                }
                break;

            case 'mostReviewed':
                $this->selectedTopProduct = 'Sản phẩm có lượt đánh giá cao nhất';
                $this->topProducts = Product::orderBy('total_rating', 'desc')->limit(10)->get();
                break;

            case 'highestQuality':
                $this->selectedTopProduct = 'Sản phẩm có chất lượng đánh giá cao nhất';
                $this->topProducts = Product::orderBy('avg_rating', 'desc')->limit(10)->get();
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
