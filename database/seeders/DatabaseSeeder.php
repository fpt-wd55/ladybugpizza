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
            RoleSeeder::class,
            UserSeeder::class,
            AddressSeeder::class,
            CartSeeder::class,
            LogSeeder::class,
            PaymentMethodSeeder::class,
            CategorySeeder::class,
            AttributeSeeder::class,
            MembershipRankSeeder::class,
            MembershipSeeder::class,
            OrderStatusSeeder::class,
            ProductSeeder::class, // Check Check Check
            ToppingSeeder::class,
            PromotionSeeder::class,
            PromotionUserSeeder::class,
            OrderSeeder::class,
            BannerSeeder::class,
            EvaluationSeeder::class,
            PageSeeder::class,
            InvoiceSeeder::class,
            FaqSeeder::class,
            UserSettingSeeder::class,
        ]);
    }
}
