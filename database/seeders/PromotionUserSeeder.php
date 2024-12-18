<?php

namespace Database\Seeders;

use App\Models\Promotion;
use App\Models\PromotionUser;
use App\Models\User; 
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
        $users = User::all();

        for ($i = 0; $i < 50; $i++) {
            PromotionUser::create([
                'promotion_id' => $promotions->random()->id,
                'user_id' => $users->random()->id,
            ]);
        }
    }
}
