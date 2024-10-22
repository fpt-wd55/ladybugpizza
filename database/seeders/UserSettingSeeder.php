<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\UserSetting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::where('role_id', 2)->get();

        foreach ($users as $user) {
            UserSetting::create([
                'user_id' => $user->id,
                'email_order' => 1,
                'email_promotions' => 1,
                'email_security' => 1,
                'push_order' => 1,
                'push_promotions' => 1,
                'push_security' => 1,
            ]);
        }
    }
}
