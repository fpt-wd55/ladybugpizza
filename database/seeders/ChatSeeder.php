<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use App\Models\Conversation;
use App\Models\Message;
use App\Models\User;
use Faker\Factory as Faker;

class ChatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();
        $faker = Faker::create();

        $users = User::getCustomers();
        $admins = User::getAdmins();

        // Kiểm tra xem danh sách người dùng và quản trị viên có rỗng không
        if ($users->isEmpty() || $admins->isEmpty()) {
            // Thoát nếu một trong hai danh sách trống
            return;
        }

        for ($i = 0; $i < 170; $i++) {
            $user = $faker->randomElement($users);
            $admin = $faker->randomElement($admins);
            
            // Tạo mới một cuộc hội thoại
            $conversation = Conversation::create([
                'user_id_1' => $user->id,
                'user_id_2' => $admin->id,
                'created_at' => $now,
                'updated_at' => $now,
            ]);

            for ($j = 0; $j < 7; $j++) {
                // Tạo mới một tin nhắn
                Message::create([
                    'conversation_id' => $conversation->id,
                    'sender_id' => $faker->randomElement([$user->id, $admin->id]),
                    'message' => $faker->sentence,
                    'image' => null,
                    'is_read' => true,
                    'is_typing' => false,
                    'created_at' => $now,
                    'updated_at' => $now,
                ]);
            }
        }
    }
}
