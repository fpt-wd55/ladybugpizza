<?php

namespace App\Console\Commands;

use App\Models\Promotion;
use Illuminate\Console\Command;

class UpdateExpiredPromotions extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:expired-promotions';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Cập nhật trạng thái của các mã giảm giá đã hết hạn';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $updated = Promotion::where('end_date', '<', now())
            ->where('status', '!=', 2)
            ->update(['status' => 2]);
        $this->info("Có {$updated} mã giảm giá đã hết hạn");
    }
}
