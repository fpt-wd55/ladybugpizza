<?php

namespace Database\Seeders;

use App\Models\Promotion;
use App\Models\PromotionUser;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PromotionUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $promotions = Promotion::all();
        $now = Carbon::now();

        for ($i = 0; $i < 40; $i++) {
            PromotionUser::create([
                'promotion_id' => $promotions->random()->id,
                'user_id' => rand(1, 7),
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }
    }
}
