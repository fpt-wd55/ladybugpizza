<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class LogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        $users = DB::table('users')->get();

        foreach ($users as $user) {
            for ($i = 0; $i < 10; $i++) {
                DB::table('logs')->insert([
                    'user_id' => $user->id,
                    'action' => $faker->randomElement(['create', 'update', 'delete']),
                    'description' => $faker->sentence,
                    'created_at' => $faker->dateTimeThisYear(),
                    'updated_at' => $faker->dateTimeThisYear(),
                ]);
            }
        }
    }
}
