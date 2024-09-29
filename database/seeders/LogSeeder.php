<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\Log;
use App\Models\User;
use Carbon\Carbon;

class LogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();
        
        $faker = Faker::create();

        $users = User::all();

        foreach ($users as $user) {
            for ($i = 0; $i < 10; $i++) {
                Log::create([
                    'user_id' => $user->id,
                    'action' => $faker->randomElement(['create', 'update', 'delete']),
                    'description' => $faker->sentence,
                    'created_at' => $now,
                    'updated_at' => $now,
                ]);
            }
        }
    }
}
