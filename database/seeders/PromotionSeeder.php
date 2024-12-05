<?php

namespace Database\Seeders;

use App\Models\MembershipRank;
use Illuminate\Database\Seeder;
use App\Models\Promotion;
use Illuminate\Support\Str;
use Carbon\Carbon;

class PromotionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $ranks = MembershipRank::all();
        $discountNames = [
            'Giảm 10% cho đơn hàng đầu tiên',
            'Cung cấp ưu đãi đặc biệt cho pizza',
            'Giảm giá cho đơn hàng pizza hôm nay',
            'Mua 1 tặng 1 pizza hảo hạng',
            'Giảm 20% cho pizza gia đình',
            'Ưu đãi pizza thập cẩm',
            'Giảm 50k cho đơn hàng trên 300k',
            'Giảm giá 15% cho pizza hải sản',
            'Pizza yêu thích giảm 10%',
            'Giảm 30k cho pizza size lớn',
            'Mua pizza, tặng nước ngọt miễn phí',
            'Giảm giá cho đơn hàng pizza sau 8 giờ tối',
            'Giảm giá 25% cho pizza món mới',
            'Pizza mặn giảm 20%',
            'Giảm giá cho pizza với mã coupon đặc biệt',
            'Giảm 40% cho pizza mùa hè',
            'Chỉ hôm nay, giảm giá 10% cho pizza',
            'Tặng ngay 1 pizza nhỏ cho đơn hàng lớn',
            'Giảm giá cực hot cho pizza gia đình',
            'Mua pizza, tặng voucher 50k cho lần sau'
        ];


        for ($i = 0; $i < 20; $i++) {
            $discount_type = rand(1, 2);
            $discount_value = $discount_type == 1 ? rand(10, 50) : rand(50000, 100000);

            $now = Carbon::now();
            $is_global = rand(1, 2);
            // Tạo mới một khuyến mãi
            Promotion::create([
                'name' => $discountNames[array_rand($discountNames)],
                'code' => Str::random(10),
                'points' => rand(1, 10) * 50,
                'discount_type' => $discount_type,
                'discount_value' => $discount_value,
                'start_date' => $now->subDays(rand(1, 365)),
                'end_date' => $now->addDays(rand(1, 365)),
                'quantity' => rand(1, 100),
                'min_order_total' => rand(100, 500) * 1000,
                'max_discount' => rand(100, 500) * 1000,
                'is_global' => $is_global,
                'rank_id' => $is_global == 1 ? null : $ranks->random()->id,
                'status' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }
    }
}
