<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class ChatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        $users = DB::table('users')->where('role_id', 2)->get();
        $admins = DB::table('users')->where('role_id', 3)->get();

        for ($i = 0; $i < 170; $i++) {
            $user = $faker->randomElement($users);
            $admin = $faker->randomElement($admins);
            $conversation = DB::table('conversations')->insertGetId([
                'user_id_1' => $user->id,
                'user_id_2' => $admin->id,
            ]);

            for ($j = 0; $j < 10; $j++) {
                DB::table('messages')->insert([
                    'conversation_id' => $conversation,
                    'sender_id' => $faker->randomElement([$user->id, $admin->id]),
                    'message' => $faker->sentence,
                    'image' => null,
                    'is_read' => true,
                    'is_typing' => false,
                ]);
            }
        }
    }
}
