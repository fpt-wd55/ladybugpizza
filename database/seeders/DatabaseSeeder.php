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
            ChatSeeder::class,
            AttributeSeeder::class,
            CategorySeeder::class,
            MembershipSeeder::class,
            OrderStatusSeeder::class,
            ProductSeeder::class,
            ToppingSeeder::class,
            CartSeeder::class,
            PaymentMethodSeeder::class,
            PromotionSeeder::class,
            OrderSeeder::class,
            BannerSeeder::class,
            EvaluationSeeder::class, 
            PageSeeder::class,
            // ShippingSeeder::class,
            TransactionSeeder::class,
            InvoiceSeeder::class,
            ComboDetailSeeder::class,
            FavoriteSeeder::class,
        ]); 
    }
}
