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
        $faker = Faker::create('vi_VN');
        $users = User::all();

        foreach ($users as $user) {
            for ($i = 0; $i < 10; $i++) {
                Log::create([
                    'user_id' => $user->id,
                    'action' => $faker->randomElement(['create', 'update', 'delete']),
                    'description' => $faker->sentence,
                ]);
            }
            for ($i = 0; $i < 5; $i++) {
                Log::create(
                    [
                        'user_id' => $user->id,
                        'action' => 'receive_points',
                        'description' => 'Nhận điểm thành công +' . rand(100, 1000),
                    ]
                );
                Log::create(
                    [
                        'user_id' => $user->id,
                        'action' => 'exchange_points',
                        'description' => 'Đổi điểm thành công -' . rand(100, 1000),
                    ]
                );
            }
        }
    }
}
