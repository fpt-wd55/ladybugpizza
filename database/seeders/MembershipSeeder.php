<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class MembershipSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        $users = DB::table('users')->where('role_id', 2)->get();

        foreach ($users as $user) {
            DB::table('memberships')->insert([
                'user_id' => $user->id,
                'points' => $faker->numberBetween(0, 1000),
                'rank' => $faker->randomElement(['Đồng', 'Bạc', 'Vàng', 'Bạch Kim', 'Kim Cương']),
                'status' => 1,
                'total_spent' => $faker->numberBetween(0, 2000),
                'created_at' => $faker->dateTimeThisYear(),
                'updated_at' => $faker->dateTimeThisYear(),
            ]);
        }
    }
} 