<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\Membership;
use App\Models\User;
use Carbon\Carbon;

class MembershipSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();
        
        $faker = Faker::create();

        $users = User::where('role_id', 2)->get();

        foreach ($users as $user) {
            Membership::create([
                'user_id' => $user->id,
                'points' => $faker->numberBetween(0, 1000),
                'rank' => $faker->randomElement(['Đồng', 'Bạc', 'Vàng', 'Bạch Kim', 'Kim Cương']),
                'status' => 1,
                'total_spent' => $faker->numberBetween(0, 2000),
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }
    }
}
