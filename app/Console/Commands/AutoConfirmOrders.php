<?php

namespace App\Console\Commands;

use App\Mail\Order as MailOrder;
use App\Models\Invoice;
use App\Models\Order;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class AutoConfirmOrders extends Command
{
    protected $signature = 'orders:auto-confirm';
    protected $description = 'Tự động xác nhận đơn hàng nếu không ai bấm hoàn thành';

    public function handle()
    {   
        // Thời gian giới hạn để xác nhận đơn hàng (24 giờ)
        $timeLimit = now()->subDay();
        // Lấy các đơn hàng đã giao mà chưa hoàn thành
        $orders = Order::where('order_status_id', 4)
            ->where('updated_at', '<=', $timeLimit)
            ->get();

        foreach ($orders as $order) {
            // Cập nhật trạng thái đơn hàng
            $order->order_status_id = 5;
            $order->save();

            // Tạo hóa đơn
            $dataInvoice = [
                'order_id' => $order->id,
                'invoice_number' => 'INV' . now()->format('Ymd') . '-' . $order->id,
                'created_at' => now(),
                'updated_at' => now(),
            ];
            Invoice::create($dataInvoice);

            $userSetting = $order->user->setting;
            if ($userSetting->email_order) {
                Mail::to($order->email)->send(new MailOrder($order, 'Cảm ơn bạn đã mua hàng tại cửa hàng chúng tôi', 'mails.orders.completed'));
            }
        }
    }
}
