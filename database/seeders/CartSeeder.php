<?php

namespace Database\Seeders;

use App\Models\Cart;
use App\Models\ProductAttribute;
use App\Models\Topping;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class CartSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();

        $users = User::all();

        $carts = [];

        foreach ($users as $user) {
            $carts[] = [
                'user_id' => $user->id,
                'total' => rand(100, 500) * 1000,
                'total_discount' => rand(100, 500) * 1000,
                'created_at' => $now,
                'updated_at' => $now,
            ];
        }

        Cart::insert($carts);
    }
}
