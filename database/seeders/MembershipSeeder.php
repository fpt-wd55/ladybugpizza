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
                'points' => $points = rand(0, 12000),
                'rank_id' => $points <= 1000 ? 1 : ($points <= 3000 ? 2 : ($points <= 10000 ? 3 : 4)),
                'total_spent' => rand(0, 20000),
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }
    }
}
