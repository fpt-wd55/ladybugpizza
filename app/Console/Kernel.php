<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    protected $commands = [
        'App\Console\Commands\AutoConfirmOrders'
    ];
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        // $schedule->command('inspire')->hourly();
        $schedule->command('update:expired-promotions')->everyMinute();
        // Tự động xác nhận đơn hàng nếu khách hàng không bấm nhận hàng
        $schedule->command('orders:auto-confirm')->everyTenMinutes();
        // Làm mới số lượng sản phẩm hàng ngày
        $schedule->command('reset:daily-quantity')->dailyAt('05:00');
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
