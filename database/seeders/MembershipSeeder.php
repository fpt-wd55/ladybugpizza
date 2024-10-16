<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Membership;
use App\Models\MembershipRank;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class MembershipSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();

        $users = User::all();
        $ranks = MembershipRank::all();
        foreach ($users as $user) {
            Membership::create([
                'user_id' => $user->id,
                'points' => rand(0, 10000),
                'rank_id' => $ranks->random()->id,
                'total_spent' => rand(0, 1000000),
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }
    }
} 