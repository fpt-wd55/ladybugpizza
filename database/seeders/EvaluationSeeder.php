<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\Evaluate;
use App\Models\Evaluation;
use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;

class EvaluationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();
        $faker = Faker::create();
        
        $products = Product::pluck('id')->toArray();
        $users = User::pluck('id')->toArray();

        foreach ($products as $product) {
            for ($i = 0; $i < 10; $i++) {
                $user = $faker->randomElement($users);
                
                Evaluation::create([
                    'user_id' => $user,
                    'product_id' => $product,
                    'rating' => $faker->numberBetween(1, 5),
                    'comment' => $faker->sentence,
                    'status' => 1,
                    'created_at' => $now,
                    'updated_at' => $now,
                ]);
            }
        }
    }
}
