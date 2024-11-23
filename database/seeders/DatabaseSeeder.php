<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RoleSeeder::class,
            UserSeeder::class,
            LogSeeder::class, 
            CategorySeeder::class,
            AttributeSeeder::class,
            MembershipRankSeeder::class,
            MembershipSeeder::class,
            OrderStatusSeeder::class,
            ProductSeeder::class,
            ToppingSeeder::class,
            CartSeeder::class,
            CartItemSeeder::class, 
            PaymentMethodSeeder::class,
            PromotionSeeder::class,
            PromotionUserSeeder::class,
            OrderSeeder::class,
            BannerSeeder::class,
            EvaluationSeeder::class, 
            EvaluationImageSeeder::class,
            PageSeeder::class, 
            TransactionSeeder::class,
            InvoiceSeeder::class, 
            FavoriteSeeder::class,
            FaqSeeder::class,
            UserSettingSeeder::class,
        ]); 
    }
}
