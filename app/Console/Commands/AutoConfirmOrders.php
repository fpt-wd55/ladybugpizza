<?php

namespace App\Console\Commands;

use App\Models\Order;
use Illuminate\Console\Command;
use Carbon\Carbon;

class AutoConfirmOrders extends Command
{
    protected $signature = 'orders:auto-confirm';
    protected $description = 'Tự động xác nhận đơn hàng nếu không ai bấm hoàn thành';

    public function handle()
    {
        // Khoảng thời gian tối đa để đơn hàng ở trạng thái pending (e.g., 24 giờ)
        $timeLimit = now()->subHours(24);

        // Lấy các đơn hàng chưa xử lý (pending) và quá thời gian cho phép
        $orders = Order::where('order_status_id', 'pending')
            ->where('created_at', '<=', $timeLimit)
            ->get();

        foreach ($orders as $order) {
            // Cập nhật trạng thái đơn hàng
            $order->status = 'processing'; // Xác nhận đơn hàng
            $order->save();

            // Log hoặc thông báo
            $this->info("Đơn hàng ID {$order->id} đã được tự động xác nhận.");
        }
    }
}
