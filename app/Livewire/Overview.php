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
        // Lấy tất cả các đơn hàng và tính tổng doanh thu
        $totalRevenue = Order::all()->reduce(function ($carry, $order) {
            return $carry + $order->total(); // Tính tổng doanh thu
        }, 0);

        // Lấy số lượng của từng mô hình và tổng doanh thu
        $overview = collect([
            'totalRevenue' => $totalRevenue, // Đưa tổng doanh thu vào
            'orders' => Order::count(),
            'users' => User::count(),
            'products' => Product::count(),
            'categories' => Category::count(),
        ]);

        $overview = [
            [
                'route' => route('admin.orders.index'),
                'label' => 'Tổng doanh thu',
                'icon' => 'tabler-wallet',
                'count' => number_format($overview['totalRevenue']) . ' VNĐ',
            ],

            [
                'route' => route('admin.orders.index'),
                'label' => 'Đơn hàng',
                'icon' => 'tabler-package',
                'count' => $overview['orders'],
            ],
            [
                'route' => route('admin.users.index'),
                'label' => 'Tài khoản',
                'icon' => 'tabler-user',
                'count' => $overview['users'],
            ],
            [
                'route' => route('admin.products.index'),
                'label' => 'Sản phẩm',
                'icon' => 'tabler-pizza',
                'count' => $overview['products'],
            ],
            [
                'route' => route('admin.categories.index'),
                'label' => 'Danh mục sản phẩm',
                'icon' => 'tabler-category',
                'count' => $overview['categories'],
            ],
            
        ];

        return view('livewire.overview', [
            'overview' => $overview,
        ]);
    }
}
