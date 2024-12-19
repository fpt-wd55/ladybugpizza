<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Artisan::call('hcvn:install');
        $this->call([
            PageSeeder::class,
            OpeningHourSeeder::class,
            RoleSeeder::class,
            UserSeeder::class,
            UserSettingSeeder::class,
            BannerSeeder::class,
            FaqSeeder::class,
            AddressSeeder::class,
            CartSeeder::class,
            LogSeeder::class,
            PaymentMethodSeeder::class,
            CategorySeeder::class,
            AttributeSeeder::class,
            MembershipRankSeeder::class,
            MembershipSeeder::class,
            OrderStatusSeeder::class,
            ProductSeeder::class,
            ToppingSeeder::class,
            PromotionSeeder::class,
            PromotionUserSeeder::class,
            OrderSeeder::class,
            EvaluationSeeder::class,
            InvoiceSeeder::class,
        ]);
    }
}
